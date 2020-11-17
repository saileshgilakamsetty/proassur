<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'/third_party/jula/JulaMarchandSend.php');

class Payment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->helper('admin_helper');
        $this->load->helper('string_helper');
    }

    public $payment = 'tbl_payment';
    public $travel_finalize_company = 'tbl_travel_finalize_company';

// function added by Shiv to proceed to payment after view finalize detail
    public function proceed_to_pay() {
        CheckAdminLoginSession();
        // $data['user_payment_data'] = $this->session->userdata('user_payment_data');
        $payment_id                = $this->uri->segment(4);
        $data['user_payment_data'] = $this->admin_model->getDataCollectionArrayByID($this->payment,$payment_id);
        $data['payment_id'] = $payment_id;
        $montant          = '2000';
        $currency         = 'XOF';
        $url_retour       = base_url('admin/payment/get_jularesponse/'.$payment_id);
        $url_cancel       = base_url('admin/payment/cancel_julapayment/'.$payment_id);
        //$url_notification = 'http://localhost:8888/prestashop/fr/confirmation-commande?key=31108b91d43f6890887881dace70fb65&id_cart=10&id_module=80';
        $url_notification = base_url('admin/payment/proceed-to-pay/'.$payment_id);
        //$num_transaction  = '34546435756545';
        $num_transaction  = $data['user_payment_data']['transaction_id'];
        $email_client     = 'ngom.ksk@gmail.com';
        $id_marchand      = '188';
        $data["jula_form"] = getFrom(
            array(
                'id_marchand'        => $id_marchand,
                'montant'            => $montant,
                'email'              => $email_client,
                'numero_transaction' => $num_transaction,
                'url_retour'         => $url_retour,
                'url_notification'   => $url_notification,
                'url_annulation'     => $url_cancel,
                'currency'           => $currency
            )
        );
   // die;

        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/payment/user_payment_data', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }


    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function do_payment() {
        CheckAdminLoginSession();
        $post_data          = $this->input->post();
        $insured_id         = $post_data['insured_id'];
        $insurance_type_id  = $post_data['insurance_type_id'];
        //$post_data['transaction_id'] = random_string('numeric', 5);
        $payment_id         = getPaymentIdByInsurerIdInsuranceType($insured_id, $insurance_type_id);

        $payment_data       = $this->admin_model->getDataCollectionByID($this->payment, $payment_id);
        $insurance_details  = getFinalizedInsuranceDetails($insured_id, $insurance_type_id);
        $accessories_id     = getAccessoriesId($insurance_details['net_premium'],$insurance_details['company_id'],$insurance_details['branch_id']);
        $accessories_data   = getAccessoriesAmountShare($accessories_id);
        $admin_policy_share = getAdminPolicyShare($accessories_id);
        if($payment_data->insurance_type_id == 1) {
				$days 			   = getDaysFromVehicleDetailId($insured_id,'tbl_selected_premium');
				$premium_rate      = getPremiumRateViaCompanyDays($days,getCompanyIdByVehicleDetailId($insured_id));
				$estimation_amount = getEstimationAmountByInsurerIdInsuranceType($insured_id, $payment_data->insurance_type_id);
				$amt =($premium_rate*$estimation_amount)/100;
				$insurance_details['net_premium'] = $amt;
		}
        if($payment_data->payment_status == 3) {
            $current =  strtotime(date('Y-m-d H:i:s'))."<br>";
            $start   = strtotime(date('Y-m-d H:i:s',strtotime($insurance_details['policy_start_date'])));
            $end     = strtotime(date('Y-m-d H:i:s',strtotime($insurance_details['policy_end_date'])));

            $final   = $current + $end - $start;
            $policy_start_date = date('Y-m-d H:i:s');
            $policy_end_date   =  date('Y-m-d H:i:s',$final);
            if($payment_data->insurance_type_id == 1) { // Vehicle
                $dates_to_update = array (
                    'insurance_registeration_date' => $policy_start_date,
                );
                $id_array = array ('id' => $insured_id);
                $table = 'tbl_vehicle_detail';
            } else if($payment_data->insurance_type_id == 2) { // Health
                $dates_to_update = array (
                    'start_date' => $policy_start_date,
                    'end_date'   => $policy_end_date
                );
                $id_array = array ('id' => $insured_id);
                $table = 'tbl_health_insurance_details';
            } else if($payment_data->insurance_type_id == 3) { // Travel
                $dates_to_update = array (
                    'travel_start_date' => $policy_start_date,
                    'travel_end_date'   => $policy_end_date
                );
                $id_array = array ('people_insured_id' => $insured_id);
                $table = 'tbl_travel_destination_details';
            } else if($payment_data->insurance_type_id == 6) { // Credit
                $dates_to_update = array (
                    'start_date' => $policy_start_date,
                    'end_date'   => $policy_end_date
                );
                $id_array = array ('credit_detail_id' => $insured_id);
                $table = 'tbl_credit_detail';
            }
            $this->admin_model->setUpdateDates($table,$dates_to_update,$id_array);
        }
        $data = array(
            'amount'         => $post_data['amount'],
            'payment_method' => $post_data['payment_method'],
            //'transaction_id' => $post_data['transaction_id'],
            'created_date'   => date("Y-m-d H:i:s")
        );
        $update_id               = $this->admin_model->setUpdateData($this->payment, $data, $payment_id);

        // Insert Data in quittance table (by Shiv)
        $admin_policy_commission = ($admin_policy_share * $insurance_details['net_premium']) / 100;
        $quittance_data = array(
            'policy_number'             => $payment_data->policy_number,
            'company_id'                => $insurance_details['company_id'],
            'branch_id'                 => $insurance_details['branch_id'],
            'risque_id'                 => $insurance_details['risque_id'],
            'user_id'                   => $insurance_details['user_id'],
            'amount'                    => $insurance_details['net_premium'],
            'tax'                       => $insurance_details['tax'],
            'accessories'               => $insurance_details['accessories'],
            'accessories_id'            => $accessories_id,
            'accessories_admin_share'   => $accessories_data['accessories_admin_share'],
            'accessories_company_share' => $accessories_data['accessories_company_share'],
            'admin_policy_commission'   => $admin_policy_commission,
            'policy_start_date'         => $insurance_details['policy_start_date'],
            'policy_end_date'           => $insurance_details['policy_end_date'],
            'policy_creation_date'      => date('Y-m-d H:i:s'),
            'total_amount'              => $insurance_details['total_premium'],
            'created_date'              => date('Y-m-d H:i:s'),
            'modified_date'             => date('Y-m-d H:i:s'),
            'status'                    => 1
        );
        $this->admin_model->setInsertData('tbl_quittance', $quittance_data);

        /* print_r($quittance_data);
          die; */
        if ($update_id > 0) {
            echo $update_id;
        }
        die;
    }

    public function payment_details() {
        CheckAdminLoginSession();
        die('sdgjhgjh');
    }

    // function added by Shiv to get quittance report
    public function quittance_report() {

        // for vehicle
        $insurance_type_id = 1;
        $insured_id = 45;

        // for health
        /* $insurance_type_id = 2;
          $insured_id = 32; */

        // for travel
        /* $insurance_type_id = 3;
          $insured_id = 35; */

        // for professional multirisk
        /* $insurance_type_id = 4;
          $insured_id = 13; */

        // for individual accident
        /* $insurance_type_id = 5;
          $insured_id = 20; */


        // for credit
        /* $insurance_type_id = 6;
          $insured_id = 16; */

        // for house
        /* $insurance_type_id = 7;
          $insured_id = 22; */
        $payment_data = getPaymentData($insurance_type_id, $insured_id);
        print_r($payment_data);
        die;
    }



    public function get_jularesponse() {

        $payment_id = $this->uri->segment(4);
        
        /*// Transaction Id sent by merchant 
        $transaction1 = $this->input->get('transaction1');

        // Transaction Id sent by jula/postecash
        $transaction2 = $this->input->get('transaction2');
*/
        //The hash parameter is the encryption of the concatenation of the number of the transaction provided by the merchant, the number of the transaction provided by the API and the merchant key

        //$hash         = $this->input->get('hash');

        global $JULA_MERCHANT_KEY;
        if(isset($_GET['transaction1'], $_GET['transaction2'], $_GET['hash'])){

            // Hash key generated from merchant side
            $cle_hachage = sha1($_GET['transaction1'].$_GET['transaction2'].$JULA_MERCHANT_KEY);


            if($_GET['hash'] === $cle_hachage){ // Payment Success
                //echo 'Paiement ok';
                $payment_details_to_update = array (
                    'transaction_id_by_payment' => $_GET['transaction2'],
                    'payment_status'            => 2,
                    'modified_date'             => date('Y-m-d H:i:s')
                );
                $updated_id = $this->admin_model->setUpdateData($this->payment,$payment_details_to_update,$payment_id);
                if($updated_id > 0) {
                    $response = $this->update_payment_status($payment_id,2);
                    $payment_details = $this->admin_model->getDataCollectionArrayByID($this->payment,$updated_id);
                    $this->send_policy_report($payment_details);
                    $message = getContentLanguageSelected('YOUR_PAYMENT_HAS_BEEN_DONE_SUCCESSFULLY', defaultSelectedLanguage());
                    $this->session->set_flashdata('message',$message);
                    redirect('admin/settings/view_policies','refresh'); 
                }
            }
            else{
                echo 'Paiement ko';
            }
        }
        else{
            echo 'Paiement nok';
        }
    }

    public function cancel_julapayment($payment_id) {
        $payment_data = $this->admin_model->getDataCollectionArrayByID($this->payment,$payment_id);
        $response = $this->update_payment_status($payment_id,4);
        if($response) {
            $message = getContentLanguageSelected('YOUR_PAYMENT_HAS_BEEN_CANCELLED SUCCESSFULLY', defaultSelectedLanguage());
        } else {
            $message = getContentLanguageSelected('SOMETHING_WENT_WRONG', defaultSelectedLanguage());
        }
        $this->session->set_flashdata('message',$message);
        redirect('admin/payment/proceed-to-pay/'.$payment_id);
    }

    public function jula_notification() {
        print_r($this->input->get());
    }


    public function update_payment_status($payment_id,$status = NULL) {

        $payment_data = $this->admin_model->getDataCollectionArrayByID($this->payment,$payment_id);
        $data_to_insert = array (
            'payment_id'     => $payment_id,
            'user_id'        => $payment_data['user_id'],
            'policy_number'  => $payment_data['policy_number'],
            'amount'         => $payment_data['amount'],
            'payment_method' => $payment_data['payment_method'],
            'payment_status' => $status,
            'transaction_id' => $payment_data['transaction_id'],
            'transaction_id_by_payment' => $payment_data['transaction_id_by_payment']
        );
        $id = $this->admin_model->setInsertData('tbl_payment_status',$data_to_insert);
       
        if($id > 0) {
            return true;
        } else {
            return false;
        }
    }



    /*public function send_policy_report($payment_data) {
       
        // Send Email to End User Regarding Policy Update
        $email_template    = 'send_policy_information.html';
        $templateTags      =  array(
            '{{site_name}}'         => 'Proassur.com',
            '{{site_logo}}'         => base_url(),
            '{{site_url}}'          => base_url(),
            '{{team_name}}'         => 'Proassur',
            '{{first_name}}'        => getUserName($payment_data['user_id']),
            '{{year}}'              => date('Y'),
            '{{company_name}}'      => 'Proassur.com',
            '{{insurance_type}}'    => getInsuranceType($payment_data["insurance_type_id"]).' INSURANCE',
            '{{policy_number}}'     => $payment_data['policy_number'],
            '{{email}}'             => getUserMailId($payment_data['user_id'])
        );

        if($payment_data['insurance_type_id'] == 1 || $payment_data['insurance_type_id'] == 2) {
            $templateTags['{{card}}'] = '<a href="'.base_url('user/card_details/'.encrypt($payment_data['policy_number'])).'">Download Your Card</a>';
        }
        //print_r($templateTags);die;
        $message           = email_compose($email_template,$templateTags);

        $to                = getUserMailId($payment_data['user_id']);
        $subject           = SEND_POLICY_INFORMATION_MAIL;
        if (send_smtp_mail($to,$subject,$message)) {
            
        }
    }*/

    public function get_cashpayment() {
        $payment_id = $this->uri->segment(4);

        $payment_details_to_update = array (
            'payment_status' => 0,
            'modified_date'  => date('Y-m-d H:i:s')
        );
        $updated_id = $this->admin_model->setUpdateData($this->payment,$payment_details_to_update,$payment_id);
        if($updated_id > 0) { 
            $response = $this->update_payment_status($payment_id,3);
            $payment_details = $this->admin_model->getDataCollectionArrayByID($this->payment,$updated_id);
            $this->send_policy_report($payment_details);
            $message = getContentLanguageSelected('YOUR_PAYMENT_HAS_BEEN_INITIATED SUCCESSFULLY', defaultSelectedLanguage());
            $this->session->set_flashdata('message',$message);
            redirect('admin/settings/view_policies','refresh'); 
        }

    }


    public function get_chequepayment() {
        $payment_id = $this->uri->segment(4);
        if($payment_id > 0) {
            $response = $this->update_payment_status($payment_id,3);
            $payment_details = $this->admin_model->getDataCollectionArrayByID($this->payment,$payment_id);
            $this->send_policy_report($payment_details);
            $message = getContentLanguageSelected('YOUR_PAYMENT_HAS_BEEN_INITIATED SUCCESSFULLY', defaultSelectedLanguage());
            $this->session->set_flashdata('message',$message);
            redirect('admin/settings/view_policies','refresh');
        }
    }
    

    function send_policy_report($payment_data,$to = "", $subject = "", $message = "") {
        //$CI = & get_instance();
        $html = '<style>@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,300,700,900); </style>
            <div>
              <table width="650" border="0" style="padding:20px;margin:0 auto;border:5px solid #347ea3;">
                <tbody>
                  <tr>
                    <td>
                      Dear '.getUserName($payment_data['user_id']).',
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                  <tr>
                    <td>
                      &nbsp;
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p>Your <b>'.getInsuranceType($payment_data['insurance_type_id']).' Policy</b> having Policy Number <b>'. $payment_data['policy_number'].'</b> with Proassur.com has been created</p>

                      <p>Please find your Policy Report </p>';


                        if($payment_data['insurance_type_id'] == 1 || $payment_data['insurance_type_id'] == 2) { 
                            $html .= '<p><a href="'.base_url('user/card_details/'.encrypt($payment_data['policy_number'])).'">Download Your Card</a></p>';
                        }

                    $html .=  '<p>For further query, Please contact to Admin</p>

                      <p>This is an auto generated verification email.</p>
                   </td>
                  </tr> 
                  <tr><td>
                      &nbsp;
                    </td></tr>
                  
                  <!-- <tr>
                    <td style="border-bottom:30px solid #0099CC;"></td>
                  </tr> -->
                  <tr>
                    <td>
                      <p>Thanks & regards</p>

                      <p>Team, Proassur</p>
                      <p><a href="'.base_url().'"><img style="height:70px;" src="'.base_url().'"></a> </p>
                      
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align:center;font-family:roboto;font-size:11px;padding:0px;">
                      <p>Copyright@'.date("Y").' Proassur.com</p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>';
        $config = array(
            'mailtype' => 'html',
            'charset'  => 'utf-8',
            'priority' => '1',
            'newline'  => '\r\n'
        );
        $config['protocol']     = 'mail';
        $config['smtp_host']    = getSmtp('smtp_host'); //'ssl://smtp.gmail.com';
        $config['smtp_port']    = getSmtp('smtp_port');  //'465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = getSmtp('smtp_user');  //'sourcesoft.developer@gmail.com';
        $config['smtp_pass']    = getSmtp('smtp_pass');  //'!!#$124><RTTq1';
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $this->email->initialize($config);
        $this->email->from('developers@sourcesoftsolutions.com', 'Proassur Website');
        $this->email->to($to =  getUserMailId($payment_data['user_id']));
        $this->email->subject($subject = SEND_POLICY_INFORMATION_MAIL);
        $this->email->message($html);
        if (!$this->email->send()) {
            
        }
        return true;
    }


    public function cancalTrans() {
        die('sssss');
    }

}
