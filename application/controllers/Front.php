<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();
        $this->load->model('front_model');
        $this->load->helper('front_helper');
    }

    public $quittance = 'tbl_quittance';
    public $payment   = 'tbl_payment';

// function to load the home page
    public function load_page() {

        //$data = "";
        $data['partners'] = getpartnersList();
        $data['testimonials'] = getTestimonials();
        $data['aboutus'] = $this->front_model->getAboutUsPageData();
        $this->load->view('front/include/head', $data);
        $this->load->view('front/include/header_home', $data);
        $this->load->view('front/home', $data);
        $this->load->view('front/include/footer', $data);
        $this->load->view('front/include/foo', $data);
    }

    /*
      // function to login from front user
      public function load_page(){
      $data = "";
      // $this->load->view('front/include/head',$data);
      // $this->load->view('front/include/header_home',$data);
      $this->load->view('front/login',$data);
      // $this->load->view('front/include/footer',$data);
      // $this->load->view('front/include/foo',$data);
      } */

// function for page not found
    public function pageNotFound() {
        $data = '';
        $this->load->view('front/include/head', $data);
        $this->load->view('front/include/header_aftr_login', $data);
        $this->load->view('front/page_not_found', $data);
        $this->load->view('front/include/footer', $data);
        $this->load->view('front/include/foo', $data);
    }

    public function email_compose($email_template, $templateTags) {
        $templateContents = file_get_contents(dirname(__FILE__) . '/email-templates/' . $email_template);
        return $message = strtr($templateContents, $templateTags);
    }

    public function send_query() {

        $post = $this->input->post();
        if ($post != "") {
            $subject = "Contact Us";
            $email = getAdminEmail();
            $email_template = 'contact.html';
            $templateTags = array(
                '{{user_subject}}' => "Contact Us",
                '{{user_name}}' => $this->input->post('username'),
                '{{user_email}}' => $this->input->post('email'),
                '{{user_phone}}' => $this->input->post('phone'),
                '{{user_comment}}' => $this->input->post('comment')
            );
            $message = $this->email_compose($email_template, $templateTags);
            $result = send_smtp_mail($email, $subject, $message);
            echo '<span class="success">' . getStaticContent('SEND_QUERY_SUCCESSS') . '</span>';
        } else {
            echo getStaticContent('SEND_QUERY_ERROR');
        }
    }

// function to get the slip detail
    /*public function slip_detail() {
        $year = $this->input->post('get_year');
        $month = $this->input->post('get_month');
        $get_created = $this->input->post('get_created');
        $data = $this->front_model->getSlipData($year, $month, $get_created);
        $result = json_encode($data);
        print_r($result);
    }*/


    public function slip_detail() {
        $year = $this->input->post('get_year');
        $month = $this->input->post('get_month');
        $get_created = $this->input->post('get_created');
        $company_id = $this->input->post('company_id');
        $data = $this->front_model->getSlipData($year, $month, $get_created, $company_id);
        $result = json_encode($data);
        print_r($result);
    }

// function to download the file in quittance folder
  public function download_file() {
    if (!empty($_GET['file'])) {
      $fileName = basename($_GET['file']);
      $filePath = 'upload/quittance/' . $fileName;
      if (!empty($fileName) && file_exists($filePath)) {
        // Define headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");

        // Read the file
        readfile($filePath);
        exit;
      } else {
        echo 'The file does not exist.';
      }
    }
  }

// get the quittance of the month
    public function get_quittance_month() {

      $company_id = $this->input->post('company_id');
      $branch_id  = $this->input->post('branch_by_company');
      $start_date = $this->input->post('start_date');
      $end_date   = $this->input->post('end_date');
      $data       = array(
        'role'       => $this->session->userdata('role'),
        'company_id' => $company_id,
        'branch_id'  => $branch_id,
        'start_date' => $start_date,
        'end_date'   => $end_date,
      );
      $year = date("Y"); // get the year part of the current date
      $month = date('m'); // get the month part of the current date
      $record = $this->front_model->quittance_of_month($year, $month, $data);
      if (!empty($record)) {
        print_r($record);
        return $record;
      } else {
        print_r("No records found..!!");
      }
    }


// ajax function to send Quittance of month to Company
    public function send_month_quittance_company() {
      $quittances_start_interval = $this->input->post('quittances_start_interval');
      $quittances_end_interval   = $this->input->post('quittances_end_interval');
      $creater_role              = $this->session->userdata('role');
      $policy_creater            = $this->session->userdata('user_id');
      $policy_num                = $this->input->post('policy_number_selected');
      $company_pol               = $this->input->post('company_policy_selected');
      $selected_company          = $this->input->post('selected_company');
      $branch_id                 = $this->input->post('selected_branch');
      $policy_numbers            = explode(',', $policy_num);

      // code to upload cheques
      if ($_FILES["image"]["name"] != "") {
        // code to get a slip number
        $slip_number = getSlipNumber() + 1;
        if($creater_role == 4) {
          $slip_name = getCompanyName($selected_company) . '/' . date("Y") . '/' . strtoupper(date("M")) . '/' . $slip_number;
        } else if($creater_role == 3) {
          $slip_name = getUserName($policy_creater) . '/' . date("Y") . '/' . strtoupper(date("M")) . '/' . $slip_number;
        }
        $dataSlip = array(
            'slip_number'               => $slip_number,
            'slip_name'                 => $slip_name,
            'cheque_path'               => do_upload('quittance', 'image'),
            'created_by'                => $creater_role, //'company or partner',
            'company_id'                => $selected_company,
            'month'                     => date("M"),
            'year'                      => date("Y"),
            'quittances_start_interval' => $quittances_start_interval,
            'quittances_end_interval'   => $quittances_end_interval,
            'created_date'              => date('Y-m-d H:i:s')
        );

        $this->front_model->setInsertData('tbl_slip_data', $dataSlip);

        foreach ($policy_numbers as $value) {
          $data['status'] = 2; // Admin share sent by company	
          $data_slip = array(
            'policy_number' => $value,
            'slip_name'     => $slip_name,
            'created_date'  => date('Y-m-d H:i:s')
          );
          $this->front_model->setInsertData('tbl_slip_policy', $data_slip);
          $this->front_model->setUpdateQuittanceData($this->quittance, $data, $value);
        }
        /* $company_pol_option = json_decode($company_pol);
          $total_net_amount   = 0;
          $total_accessories  = 0;
          $total_tax          = 0;
          $total_amount       = 0;
          foreach ($company_pol_option as $company_id => $policy_detail) {
          $email_template    = 'send_policy_to_company.html';
          $data = '';
          $data = '<tr>';
          $data.= '<td style="width:10%">';
          $data.= '<b>Policy</b>';
          $data.= '</td>';
          $data.= '<td>';
          $data.= '<b>Client No</b>';
          $data.= '</td>';
          $data.= '<td>';
          $data.= '<b>User Name</b>';
          $data.= '</td>';
          $data.= '<td>';
          $data.= '<b>Quittance</b>';
          $data.= '</td>';
          $data.= '<td>';
          $data.= '<b>Net Amount</b>';
          $data.= '</td>';
          $data.= '<td>';
          $data.= '<b>tax</b>';
          $data.= '</td>';
          $data.= '<td>';
          $data.= '<b>Accessories</b>';
          $data.= '</td>';
          $data.= '<td>';
          $data.= '<b>Total Amount</b>';
          $data.= '</td>';
          $data.= '</tr>';
          // print_r($policy_detail);

          foreach ($policy_detail as $value) {
          // foreach ($policy_list as  $value) {
          # code...
          $total_net_amount  = $total_net_amount + $value->net_amount;
          $total_accessories = $total_accessories + $value->accessories;
          $total_tax         = $total_tax + $value->tax;
          $total_amount      = $total_amount + $value->total_amount;
          $data.= '<tr>';
          $data.= $value->branch_id;
          $data.= '</tr>';
          $data.= '<tr>';
          $data.= '<td width="20">';
          $data.= $value->policy_number;
          $data.= '</td>';
          $data.= '<td width="20">';
          $data.= $value->user_id;
          $data.= '</td>';
          $data.= '</td>';
          $data.= '<td width="20">';
          $data.= getUserName($value->user_id);
          $data.= '</td>';
          $data.= '<td width="20">';
          $data.= $value->quittance_id;
          $data.= '</td>';
          $data.= '<td width="20">';
          $data.= $value->net_amount;
          $data.= '</td>';
          $data.= '<td width="20">';
          $data.= $value->tax;
          $data.= '</td>';
          $data.= '<td width="20">';
          $data.= $value->accessories;
          $data.= '</td>';
          $data.= '<td width="20">';
          $data.= $value->total_amount;
          $data.= '</td>';
          $data.= '</tr>';
          // }
          }
          $data.= '<tr>';
          $data.= '</tr>';
          $data.= '<tr>';
          $data.= '<td>';
          $data.= '</td>';
          $data.= '<td>';
          $data.= '</td>';
          $data.= '<td>';
          $data.= '</td>';
          $data.= '<td>';
          $data.= 'Total';
          $data.= '</td>';
          $data.= '<td>';
          $data.= $total_net_amount;
          $data.= '</td>';
          $data.= '<td>';
          $data.= $total_tax;
          $data.= '</td>';
          $data.= '<td>';
          $data.= $total_accessories;
          $data.= '</td>';
          $data.= '<td>';
          $data.= $total_amount;
          $data.= '</td>';

          $data.= '</tr>';
          $templateTags      =  array(
          '{{site_name}}'               => 'Proassur.com',
          '{{site_logo}}'               => base_url(),
          '{{site_url}}'                => base_url(),
          '{{team_name}}'               => 'Proassur',
          '{{year}}'                    => date('Y'),
          '{{data}}'                    =>  $data,
          '{{company_name}}'                       => getCompanyName($company_id),
          '{{branch_name}}'                       => getBranchName($branch_id)
          );
          $message           = email_compose($email_template,$templateTags);
          $to      = getCompanyMailId($company_id);
          $subject = "Quittance of the Month";
          send_smtp_mail($to,$subject,$message);
          // print_r($message);
          } */
        echo 1;
      } else {
        print_r("Please select Image first");
      }
    }

    public function get_quote() {

        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $data = array(
            'role' => $this->session->userdata('role'),
            'user_id' => $this->session->userdata('user_id'),
            'start_date' => $start_date,
            'end_date' => $end_date
        );

        $year = date("Y"); // get the year part of the current date
        $month = date('m'); // get the month part of the current date
        $record = $this->front_model->quittance_of_month($year, $month, $data);
        if (!empty($record)) {
           print_r($record);
          // return $record;
        } else {
            print_r("No records found..!!");
        }
    }


// function for termcondition
    public function termcondition() {

        $data['page_data'] = $this->front_model->getpagedata();
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_aftr_login');
        $this->load->view('front/terms', $data);
        $this->load->view('front/include/footer');
        $this->load->view('front/include/foo');
    }


// function for privacypolicy
    public function privacypolicy() {

        $data['page_data'] = $this->front_model->getpagedata();
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_aftr_login');
        $this->load->view('front/privacy', $data);
        $this->load->view('front/include/footer');
        $this->load->view('front/include/foo');
    }


// function for newsletter
    public function newsletter() {

      /*$config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'mail.sourcesoftsolutions.com',
        'smtp_port' => 587,
        'smtp_user' => 'developers@sourcesoftsolutions.com', 
        'smtp_pass' => 'developers!pass@345',
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE,
        'protocol' => 'sendmail',
        'protocol' => 'mail',
      );*/

      $message = 'You email has been successfully subscribed to our Newsletter';
      
      
      if ($this->input->post()) {
        $check_email = checkEmailSubscribed($this->input->post('email'));
        /*if($check_email) {
          echo '<div class="alert alert-danger"><strong>Error!</strong> Your Email Address is already subscribed to our Newsletter.</div>';
        } else {
          $res       = $this->front_model->setInsertData('tbl_news_letter', ['email' => $this->input->post('email')]);
          if ($res) {
            send_smtp_mail($this->input->post('email'),'Proassur Newsletter',$message);
            echo '<div class="alert alert-success" id="success"><strong>Success!</strong> You have Successfully Subscribe.</div>';
          } else {
            echo '<div class="alert alert-danger"><strong>Error!</strong> Some thing went wrong please after some time.</div>';
          }

        }*/


        if($check_email) {
          $message = array (
            'status'        => 'failed',
            'error_message' => '<div class="alert alert-danger"><strong>Error!</strong> Your Email Address is already subscribed to our Newsletter.</div>'
          );
          // echo '<div class="alert alert-danger"><strong>Error!</strong> Your Email Address is already subscribed to our Newsletter.</div>';
        } else {
          $res       = $this->front_model->setInsertData('tbl_news_letter', ['email' => $this->input->post('email')]);
          if ($res) {
            send_smtp_mail($this->input->post('email'),'Proassur Newsletter',$message);
            $message = array (
              'status'          => 'success',
              'success_message' => '<div class="alert alert-success" id="success"><strong>Success!</strong> You have Successfully Subscribe.</div>'
            );
            // echo '<div class="alert alert-success" id="success"><strong>Success!</strong> You have Successfully Subscribe.</div>';
          } else {
            $message = array (
              'status'        => 'failed',
              'error_message' => '<div class="alert alert-danger"><strong>Error!</strong> Some thing went wrong please after some time.</div>'
            );
            // echo '<div class="alert alert-danger"><strong>Error!</strong> Some thing went wrong please after some time.</div>';
          }
        }
        print json_encode($message);

      }
    }


// function added by Shiv to send the email to users at the time of policy expiration and also 7 days before policy expiration
    public function send_policy_expiration_notification() {
      $file = APPPATH.'views/test.txt';

      $content = stripslashes("Time: " . date('Y-M-d h : i : s A') . "\n");
      $file_data = $content. file_get_contents($file);
      file_put_contents($file, $file_data);
      $data['policies_to_expire'] = $this->front_model->getExpiredPolicies();
      if(!empty($data['policies_to_expire'])) {
        foreach($data['policies_to_expire'] as $key => $value) {
        
          // Sending email 7 days before policy expiration
          if((date('Y-m-d',strtotime($value['policy_end_date'])) == date('Y-m-d',strtotime("-7 days")) ) && ($value['expiry_notification_status'] == 0)) {
            $email1_sent = $this->send_policy_expiry_notifcation($value);
            if($email1_sent) {
              $this->front_model->setUpdateData($this->payment,array ('expiry_notification_status' => 1),$value['id']);
            } 
          }

          // Sending Email at the time of policy expiration
          if((date('Y-m-d',strtotime($value['policy_end_date'])) == date('Y-m-d')) && ($value['expiry_email_sent'] == 0) ) {
            $email2_sent = $this->send_policy_expiry_email($value);
            if($email2_sent) {
              $this->front_model->setUpdateData($this->payment,array ('expiry_email_sent' => 1, 'payment_status' => 3),$value['id']);
            }
          }
        }  
      }
    }



    function send_policy_expiry_notifcation($data,$to = "", $subject = "", $message = "") {
      //$CI = & get_instance();
         $html = '<style>@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,300,700,900); </style>
          <div>
            <table width="650" border="0" style="padding:20px;margin:0 auto;border:5px solid #347ea3;">
              <tbody>
                <tr>
                  <td>
                    Cher '.getUserName($data['user_id']).',
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
                    <p>Votre police '."d'assurance".' <b>'.getInsuranceType($data['insurance_type_id']).'</b> portant le numéro de police <b>'. $data['policy_number'].'</b> auprès de Proassur arrive à expiration dans 7 jours à la date du <b>'.date("d M, yy",strtotime($data['policy_end_date'])).'</b></p>';

                    $html .=  '<p>Pour renouveler votre assurance, veuillez contacter nos services aux numéros 33 825 505 50 ou au 77 928 2087 (whatsapp) ou par email: proassur.accueil@gmail.com</p>
                  </td>
                </tr> 
                <tr><td>
                    &nbsp;
                  </td></tr>
                
                <!-- <tr>
                  <td style="border-bottom:30px solid #0099CC;"></td>
                </tr> -->

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
          'priority' => '1'
          //'newline'  => '\r\n'
      );
      $config['protocol']     = 'mail';
      $config['smtp_host']    = getSmtp('smtp_host'); //'ssl://smtp.gmail.com';
      $config['smtp_port']    = getSmtp('smtp_port');  //'465';
      $config['smtp_timeout'] = '7';
      $config['smtp_user']    = getSmtp('smtp_user');  //'sourcesoft.developer@gmail.com';
      $config['smtp_pass']    = getSmtp('smtp_pass');  //'!!#$124><RTTq1';
      //$config['charset']      = 'utf-8';
      $config['newline']      = "\r\n";
      $this->email->initialize($config);
      $this->email->from('developers@sourcesoftsolutions.com', 'Proassur Website');
      $this->email->to($to =  getUserMailId($data['user_id']));
      $this->email->subject($subject = SEND_POLICY_EXPIRATION_MAIL);
      $this->email->message('$html');
      if (!$this->email->send()) {
          
      }
      return true;
    }



    function send_policy_expiry_email($data,$to = "", $subject = "", $message = "") {
      //$CI = & get_instance();
       $html = '<style>@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,300,700,900); </style>
          <div>
            <table width="650" border="0" style="padding:20px;margin:0 auto;border:5px solid #347ea3;">
              <tbody>
                <tr>
                  <td>
                    Cher '.getUserName($data['user_id']).',
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
                    <p>Votre police '."d'assurance".' <b>'.getInsuranceType($data['insurance_type_id']).'</b> portant le numéro de police <b>'. $data['policy_number'].'</b> auprès de Proassur a expiré le <b>'.date("d M, yy",strtotime($data['policy_end_date'])).'.</b></p>';

                    $html .=  '<p>Pour renouveler votre assurance, veuillez contacter nos services aux numéros 33 825 505 50 ou au 77 928 2087 (whatsapp) ou par email: proassur.accueil@gmail.com </p>
                  </td>
                </tr> 
                <tr><td>
                    &nbsp;
                  </td></tr>
                
                <!-- <tr>
                  <td style="border-bottom:30px solid #0099CC;"></td>
                </tr> -->
  
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
          'priority' => '1'
          //'newline'  => '\r\n'
      );
      
      $config['protocol']     = 'mail';
      $config['smtp_host']    = getSmtp('smtp_host'); //'ssl://smtp.gmail.com';
      $config['smtp_port']    = getSmtp('smtp_port');  //'465';
      $config['smtp_timeout'] = '7';
      $config['smtp_user']    = getSmtp('smtp_user');  //'sourcesoft.developer@gmail.com';
      $config['smtp_pass']    = getSmtp('smtp_pass');  //'!!#$124><RTTq1';
      //$config['charset']      = 'utf-8';
      $config['newline']      = "\r\n";
      $this->email->initialize($config);
      $this->email->from('developers@sourcesoftsolutions.com', 'Proassur Website');
      $this->email->to($to =  getUserMailId($data['user_id']));
      $this->email->subject($subject = SEND_POLICY_EXPIRATION_MAIL);
      $this->email->message($html);
      $this->email->send();  
      if (!$this->email->send()) {

      }
      return true;
    }


}

?>
