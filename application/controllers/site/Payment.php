<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'/third_party/jula/JulaMarchandSend.php');
class Payment extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */



	function __construct() {
    	parent::__construct();
    	$this->load->model('login_model'); 
    	$this->load->model('front_model'); 
        $this->load->model('WalletModel');
    	$this->load->helper('front_helper');
    	$this->load->helper('string_helper');
	}

	public $payment = 'tbl_payment';

	// function added by Shiv to proceed to payment after view finalize detail
	public function proceed_to_pay() {
		CheckLoginSession();
		//$data['user_payment_data'] = $this->session->userdata('user_payment_data');
        $payment_id 	  = $this->uri->segment(3);
        $data['user_payment_data'] = $this->front_model->getDataCollectionArrayByID($this->payment,$payment_id);
        $data['payment_id'] = $payment_id;
        $montant          = '2000';
        $currency         = 'XOF';
        $url_retour       = base_url('payment/get_jularesponse/'.$payment_id);
        $url_cancel       = base_url('payment/cancel_julapayment/'.$payment_id);
        //$url_notification = 'http://localhost:8888/prestashop/fr/confirmation-commande?key=31108b91d43f6890887881dace70fb65&id_cart=10&id_module=80';
        $url_notification = base_url('payment/proceed-to-pay/'.$payment_id);
        // $num_transaction  = '34546435756545';
        $num_transaction  = $data['user_payment_data']['transaction_id'];
        $email_client     = 'ngom.ksk@gmail.com';
        $id_marchand      = '188';

        $data['jula_form'] = getFrom(
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
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/payment/user_payment_data',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
	}


	public function get_jularesponse() {

        $payment_id = $this->uri->segment(3);
        
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
                $updated_id = $this->front_model->setUpdateData($this->payment,$payment_details_to_update,$payment_id);
                if($updated_id > 0) {
                    $response = $this->update_payment_status($payment_id,2);
                    $message = getContentLanguageSelected('YOUR_PAYMENT_HAS_BEEN_DONE SUCCESSFULLY', defaultSelectedLanguage());
                    $this->session->set_flashdata('message',$message);
                    redirect('dashboard','refresh'); 
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

    public function cancel_julapayment() {
    	$payment_id = $this->uri->segment(3);
        $payment_data = $this->front_model->getDataCollectionArrayByID($this->payment,$payment_id);
        $response 	  = $this->update_payment_status($payment_id,4);
        if($response) {
            $message  = getContentLanguageSelected('YOUR_PAYMENT_HAS_BEEN_CANCELLED SUCCESSFULLY', defaultSelectedLanguage());
        } else {
            $message  = getContentLanguageSelected('SOMETHING_WENT_WRONG', defaultSelectedLanguage());
        }
        $this->session->set_flashdata('message',$message);
        redirect('payment/proceed-to-pay/'.$payment_id,'refresh');
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
		CheckLoginSession();
		$post_data 		    = $this->input->post();
		$insured_id 	    = $post_data['insured_id'];
		$insurance_type_id  = $post_data['insurance_type_id'];
		$accessories_id     = $post_data['accessories_id'];
		$accessories_data   = getAccessoriesAmountShare($accessories_id);
		$admin_policy_share = getAdminPolicyShare($accessories_id);
		//$post_data['transaction_id'] = random_string('numeric',5);
		$payment_id 	    = getPaymentIdByInsurerIdInsuranceType($insured_id,$insurance_type_id);
		$payment_data       = $this->front_model->getDataCollectionByID($this->payment,$payment_id);
		$payment_details    = json_decode($payment_data);

		// Partner Policy Share
		$partner_policy_share = getPartnerPolicyShare($insurance_type_id,$payment_details->policy_creater);

		$data = array (
			'amount'		 => $post_data['amount'],
			'payment_method' => $post_data['payment_method'],
			//'transaction_id' => $post_data['transaction_id'],
			'created_date'   => date("Y-m-d H:i:s")
		);
		$update_id = $this->front_model->setUpdateData($this->payment,$data,$payment_id);

		// Insert Data in quittance table (by Shiv)
		$insurance_details        = getFinalizedInsuranceDetails($insured_id,$insurance_type_id);


        if($payment_details->payment_status == 3) {
            $current =  strtotime(date('Y-m-d H:i:s'))."<br>";
            $start   = strtotime(date('Y-m-d H:i:s',strtotime($insurance_details['policy_start_date'])));
            $end     = strtotime(date('Y-m-d H:i:s',strtotime($insurance_details['policy_end_date'])));

            $final   = $current + $end - $start;
            $policy_start_date = date('Y-m-d H:i:s');
            $policy_end_date   =  date('Y-m-d H:i:s',$final);
            if($payment_details->insurance_type_id == 1) { // Vehicle
                $dates_to_update = array (
                    'insurance_registeration_date' => $policy_start_date,
                );
                $id_array = array ('id' => $insured_id);
                $table = 'tbl_vehicle_detail';
            } else if($payment_details->insurance_type_id == 2) { // Health
                $dates_to_update = array (
                    'start_date' => $policy_start_date,
                    'end_date'   => $policy_end_date
                );
                $id_array = array ('id' => $insured_id);
                $table = 'tbl_health_insurance_details';
            } else if($payment_details->insurance_type_id == 3) { // Travel
                $dates_to_update = array (
                    'travel_start_date' => $policy_start_date,
                    'travel_end_date'   => $policy_end_date
                );
                $id_array = array ('people_insured_id' => $insured_id);
                $table = 'tbl_travel_destination_details';
            } else if($payment_details->insurance_type_id == 6) { // Credit
                $dates_to_update = array (
                    'start_date' => $policy_start_date,
                    'end_date'   => $policy_end_date
                );
                $id_array = array ('credit_detail_id' => $insured_id);
                $table = 'tbl_credit_detail';
            }
            $this->front_model->setUpdateDates($table,$dates_to_update,$id_array);
        }



		$admin_policy_commission  = ($admin_policy_share*$insurance_details['net_premium'])/100;
		

        // Getting Insurance Policy Dates

		// Total Policy Commission of Admin
		$admin_total_policy_commission = $admin_policy_commission + $accessories_data['accessories_admin_share'];

		// Partner Policy Commision
		$partner_policy_commision = ($admin_total_policy_commission*$partner_policy_share)/100;
		$quittance_data          = array (		
			'policy_number' 		    => $payment_details->policy_number,
			'company_id'    		    => $insurance_details['company_id'],
			'branch_id'     		    => $insurance_details['branch_id'],
			'risque_id'     		    => $insurance_details['risque_id'],
			'user_id'       		    => $insurance_details['user_id'],
			'amount'        		    => $insurance_details['net_premium'],
			'tax'           		    => $insurance_details['tax'],	
			'accessories'   		    => $insurance_details['accessories'],
			'total_amount'  		    => $insurance_details['total_premium'],
			'accessories_id'            => $post_data['accessories_id'],
			'accessories_admin_share'   => $accessories_data['accessories_admin_share'],
			'accessories_company_share' => $accessories_data['accessories_company_share'],
			'admin_policy_commission'   => $admin_policy_commission,
			'partner_policy_commission' => $partner_policy_commision,
            'policy_start_date'         => $insurance_details['policy_start_date'],
            'policy_end_date'           => $insurance_details['policy_end_date'],
            'policy_creation_date'      => date('Y-m-d H:i:s'),
			'created_date'              => date('Y-m-d H:i:s'),
			'modified_date'             => date('Y-m-d H:i:s'),
			'status'                    => 1
		); 
		/*print_r($quittance_data); 
		die;*/

		$this->front_model->setInsertData('tbl_quittance',$quittance_data);

		if($update_id > 0) {
			echo $update_id;
		}
		die;
	}

	public function payment_details() {
		CheckLoginSession();
		die('sdgjhgjh');
	}


	public function update_payment_status($payment_id,$status = NULL) {

        $payment_data = $this->front_model->getDataCollectionArrayByID($this->payment,$payment_id);
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
        $id = $this->front_model->setInsertData('tbl_payment_status',$data_to_insert);
       
        if($id > 0) {
            return true;
        } else {
            return false;
        }
    }


    // function added by Shiv to make the payment from wallet for partner

    public function wallet_payment() {
        CheckLoginSession();
        $user_id        = $this->session->userdata('user_id');
        $payment_id     = $this->input->post('payment_id');
        $payment_amount = 10000;
        // $payment_amount = $this->input->post('payment_amount');
        $wallet_data    = $this->WalletModel->getWalletDataByUserId($user_id);

        if($wallet_data->amount < $payment_amount) {
            $message = getContentLanguageSelected('INSUFFICIENT_AMOUNT_IN WALLET', defaultSelectedLanguage());
            $this->session->set_flashdata('message',$message);
            redirect('payment/proceed-to-pay/'.$payment_id,'refresh');
        } else {
            $wallet_data_to_update = array (
                'amount'      => ($wallet_data->amount - $payment_amount),
                'updated_by'  => $user_id
            );

            $updated_wallet_id = $this->WalletModel->updateWalletData('tbl_wallet',$wallet_data_to_update,$wallet_data->id);

            $wallet_history = array (
                'wallet_id' => $updated_wallet_id,
                'user_id'   => $user_id,
                'amount'    => ($wallet_data->amount - $payment_amount),
                'summary'   => $payment_amount,
                'created_by' => $user_id,
                'status'     => '1',
            );
            
            $this->front_model->setInsertData('tbl_wallet_history',$wallet_history);

            $payment_details_to_update = array (
                'payment_status' => 2,
                'modified_date'  => date('Y-m-d H:i:s')
            );
            $updated_id = $this->front_model->setUpdateData($this->payment,$payment_details_to_update,$payment_id);
            
            if($updated_id > 0) {
                $response = $this->update_payment_status($updated_id,2);
                $message  = getContentLanguageSelected('YOUR_PAYMENT_HAS_BEEN_DONE SUCCESSFULLY', defaultSelectedLanguage());
                $this->session->set_flashdata('message',$message);
                redirect('dashboard','refresh'); 
            }
        }
    }

}