<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Orangepay extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        // $this->load->helper('admin_helper');
        $this->load->helper('front_helper');
        $this->load->helper('string_helper');
    }



    public $payment = 'tbl_payment';
    

    public function get_failed_response () {
        if(!empty($this->input->post())) {
            $id = $this->input->post('ref_commande');
            $status = $this->input->post('statut');
            if($status == 375) {
                $insert_data = $this->update_payment_status($id,1);
                $user_data = $this->session->userdata();
                $message   = getContentLanguageSelected('ORANGEPAY_PAYMENT_FAILED_MESSAGE', defaultSelectedLanguage()); 
                $this->session->set_flashdata('message',$message);
                if(array_key_exists('admin_role', $user_data) && ($user_data['admin_email'] != '') ) {
					redirect('admin/settings/view_policies','refresh');
				} else if(array_key_exists('role', $user_data) && ($user_data['email'] != '') ){
					redirect('dashboard','refresh');
				}
            }
        }
    }

    public function get_cancel_response() {
        if(!empty($this->input->post())) {
            $id = $this->input->post('ref_commande');
            $insert_data = $this->update_payment_status($id,4);
            $user_data = $this->session->userdata();
            $message   = getContentLanguageSelected('ORANGEPAY_PAYMENT_CANCELED_MESSAGE', defaultSelectedLanguage());   
            $this->session->set_flashdata('message',$message);
            if(array_key_exists('admin_role', $user_data) && ($user_data['admin_email'] != '') ) {
					redirect('admin/settings/view_policies','refresh');
				} else if(array_key_exists('role', $user_data) && ($user_data['email'] != '') ){
					redirect('dashboard','refresh');
				}
        }
    }

    public function get_ipn_response() {
        if(!empty($this->input->post())) {
            $status = $this->input->post('statut');
            $amount = $this->input->post('montant');
            $ref_commande = $this->input->post('ref_commande');
            $hmac = $this->input->post('hmac');
            $message = $status."<br>".$amount."<br>".$ref_commande."<br>".$hmac;
            send_smtp_mail('shiv.prakash@sourcesoftsolutions.com','Orange Pay',$message);
            die('ipn');
        }
    }


    public function get_success_response() {
        if(!empty($this->input->post())) {
            $id     = $this->input->post('ref_commande');
            $status = $this->input->post('statut');
            $amount = $this->input->post('montant');
            $reference_transaction = $this->input->post('ref_transaction');
            if($status == 200) {
                $payment_details_to_update = array (
                    'transaction_id_by_payment' => $reference_transaction,
                    'payment_status'            => 2,
                    'modified_date'             => date('Y-m-d H:i:s')
                );
                $updated_id      = $this->admin_model->setUpdateData($this->payment,$payment_details_to_update,$id);
                $response        = $this->update_payment_status($payment_id,2);
                $payment_details = $this->admin_model->getDataCollectionArrayByID($this->payment,$updated_id);
                $this->send_policy_report($payment_details);
                $message         = getContentLanguageSelected('ORANGEPAY_PAYMENT_SUCCESS_MESSAGE', defaultSelectedLanguage());
                $this->session->set_flashdata('message',$message);
                $user_data = $this->session->userdata();
                if(array_key_exists('admin_role', $user_data) && ($user_data['admin_email'] != '') ) {
					redirect('admin/settings/view_policies','refresh');
				} else if(array_key_exists('role', $user_data) && ($user_data['email'] != '') ){
					redirect('dashboard','refresh');
				}
            }
        } 
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
    
    
    function send_policy_report($payment_data,$to = "", $subject = "", $message = "") {
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
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = getSmtp('smtp_host'); //'ssl://smtp.gmail.com';
        $config['smtp_port']    = getSmtp('smtp_port');  //'465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = getSmtp('smtp_user');  //'sourcesoft.developer@gmail.com';
        $config['smtp_pass']    = getSmtp('smtp_pass');  //'!!#$124><RTTq1';
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $this->email->initialize($config);
        $this->email->from('info@sourcesoftsolutions.com', 'Proassur Website');
        $this->email->to($to =  getUserMailId($payment_data['user_id']));
        $this->email->subject($subject = SEND_POLICY_INFORMATION_MAIL);
        $this->email->message($html);
        if (!$this->email->send()) {
            
        }
        return true;
    }
}
