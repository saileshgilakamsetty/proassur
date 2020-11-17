<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
        $this->load->model('auth_model');
        $this->load->model('login_model');
        $this->load->model('front_model');
        $this->load->helper('front_helper');
    }

    public $users = 'tbl_users';
    public $partner_share = 'tbl_partner_share';

// function for login 
    public function login() {
        //$data = '';
        $user_id = $this->session->userdata('user_id');
        if (!empty($user_id)) {
            redirect('dashboard', 'refresh');
        } else {
            $post_data = $this->input->post();
            if (!empty($post_data)) {

                $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'required|callback_password_check');
                if ($this->form_validation->run() == FALSE) {
                    
                } else {
                    $data = array(
                        'email' => $this->input->post('email'),
                        'role' => getUserRoleIdByEmail($this->input->post('email')),
                        'password' => md5($this->input->post('password'))
                    );
                    $id = $this->auth_model->UserLogin('tbl_users', $data);
                    if ($id == 2) {
                        $this->session->set_flashdata('error', RECHECK_CREDENTIALS);
                    } else if ($id == 0) {
                        $this->session->set_flashdata('error', VERIFY_BEFORE_LOGIN);
                    } else {
                        $this->session->set_flashdata('message', LOGIN_SUCCESSFULL);
                        /* 						if ($this->uri->segment(3) == 'vehicle') {
                          redirect('vehicle','refresh');
                          }
                          else { */
                        redirect('dashboard', 'refresh');
                        // }
                    }
                }
            }
        }
        $this->load->view('front/include/head', $data);
        $this->load->view('front/login');
    }

// function for login 
    public function login_by_modal() {
        $data = '';
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $data = array(
                'email' => $this->input->post('email'),
                'role' => getUserRoleId(),
                'password' => md5($this->input->post('password'))
            );
            $id = $this->auth_model->UserLogin('tbl_users', $data);
            if ($id == 2) {
                echo 2;
                // $this->session->set_flashdata('error',RECHECK_CREDENTIALS);
            } else if ($id == 0) {
                echo 0;
                // $this->session->set_flashdata('error',VERIFY_BEFORE_LOGIN);
            } else {
                echo 1;
                // $this->session->set_flashdata('message',LOGIN_SUCCESSFULL);
            }
        }
    }

// function to signup
    public function signup() {
        $data = "";
        $post_data = $this->input->post();


        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('first_name', 'First Name', 'required|callback_name_check|trim');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|callback_name_check|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[tbl_users.email]|is_unique[tbl_company.email]|trim|valid_email');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('mobile_code', 'Mobile Code', 'required|trim|regex_match[/^(\+?\d{1,3}|\d{1,4})$/]');
            $this->form_validation->set_rules('password', 'Password', 'required|callback_password_check');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]|callback_password_check');
            $this->form_validation->set_rules('site_location', ' Address', 'required|callback_address_check');
            $this->form_validation->set_rules('role', 'Role', 'required');
            $this->form_validation->set_rules('terms_condition[]', 'Terms & Condition', 'required');

            if ($this->input->post('role') == 3) {
                $this->form_validation->set_rules('license_id', 'License Id', 'required');
                $this->form_validation->set_rules('percent_commission', 'Percent Commission', 'required');
            }


            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),
                    'mobile' => $this->input->post('mobile'),
                    'dial_code' => $this->input->post('mobile_code'),
                    'role' => $this->input->post('role'),
                    'password' => md5($this->input->post('password')),
                    'latitude' => $this->input->post('latitude'),
                    'longitude' => $this->input->post('longitude'),
                    'address' => $this->input->post('site_location'),
                    'country' => $this->input->post('country'),
                    'state' => $this->input->post('state'),
                    'city' => $this->input->post('city'),
                    'postal_code' => $this->input->post('postal_code'),
                    'created' => date("Y-m-d H:i:s")
                );
//                echo  'Password: '.$changedPassword = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
//                die;

                $CONSUMER_KEY = $this->auth_model->generateRandomString();
                $CONSUMER_SECRET = $this->config->item("CONSUMER_SECRET");

                $id = $this->auth_model->setInsertData('tbl_users', $data);
                if ($id > 0) {
                    $data1 = array(
                        'user_id' => $id,
                        'userSecret' => $CONSUMER_KEY,
                        'firstName' => $this->input->post('first_name'),
                        'lastName' => $this->input->post('last_name'),
                        'userEmail' => $this->input->post('email'),
                        'userPassword' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                        'userAddress' => $this->input->post('site_location'),
                        'userMobile' => $this->input->post('mobile'),
                        'userMobile' => $this->input->post('mobile'),
                        'userType' => 1,
                        'userStatus' => 1,
                        'userVerification' => 1,
                        'lastModified' => date('Y-m-d G:i:s'),
                    );
                    $this->auth_model->setInsertData('users', $data1);
                    // $this->auth_model->insert_entry($id, $CONSUMER_KEY, $this->post('first_name'), $this->post('last_name'), $this->post('email'), $this->post('password'), $this->post('address'), $this->post('mobile'), 0, 0);
                }


                if ($id > 0) {
                    if ($this->input->post('role') == 3) { // partner
                        $data_partner = array(
                            'user_id' => $id,
                            'license_id' => $this->input->post('license_id'),
                            'motar_commission' => $this->input->post('percent_commission'),
                            'travel_commission' => $this->input->post('percent_commission'),
                            'health_commission' => $this->input->post('percent_commission'),
                            'credit_commission' => $this->input->post('percent_commission'),
                            'house_commission' => $this->input->post('percent_commission'),
                            'professional_commission' => $this->input->post('percent_commission'),
                            'individual_accident_commission' => $this->input->post('percent_commission'),
                            'created_date' => date('Y-m-d H:i:s ')
                        );

                        $partner_share_data_id = $this->front_model->setInsertData($this->partner_share, $data_partner);


                        $email_template = 'send_company_password.html';
                        $templateTags = array(
                            '{{site_name}}' => 'Proassur.com',
                            '{{site_logo}}' => base_url(),
                            '{{site_url}}' => base_url(),
                            '{{team_name}}' => 'Proassur',
                            '{{user_name}}' => $this->input->post('first_name'),
                            '{{year}}' => date('Y'),
                            '{{company_name}}' => 'Proassur.com',
                            '{{password}}' => $this->input->post('password'),
                            '{{email}}' => $this->input->post('email')
                        );
                        $message = email_compose($email_template, $templateTags);
                        $to = $this->input->post('email');
                        $subject = SEND_PARTNER_PASSWORD_SUBJECT;
                        if (send_smtp_mail($to, $subject, $message)) {
                            $this->session->set_flashdata('message', 'Your Partner has been added successfully and password has been send to the registered mail id.');
                            redirect('auth/login', 'refresh');
                        }
                    }
                }


                if ($this->input->post('role') != 3) {
                    // $id = 14;
                    $email_template = 'send_user_verification_mail.html';
                    $link = base_url() . 'auth/verify/' . base64_encode($id);
                    $templateTags = array(
                        '{{site_name}}' => 'Proassur.com',
                        '{{site_logo}}' => base_url(),
                        '{{site_url}}' => base_url(),
                        '{{team_name}}' => 'Proassur',
                        '{{first_name}}' => $this->input->post('first_name'),
                        '{{year}}' => date('Y'),
                        '{{company_name}}' => 'Proassur.com',
                        '{{verification_link}}' => $link,
                        '{{email}}' => $this->input->post('email')
                    );
                    $message = email_compose($email_template, $templateTags);
                    $to = $this->input->post('email');
                    $subject = SEND_VERIFICATION_MAIL;
                    if (send_smtp_mail($to, $subject, $message)) {
                        $this->session->set_flashdata('message', VERIFICATION_MESSAGE);
                        redirect('auth/login', 'refresh');
                    }
                }
            }
        }
        $this->load->view('front/include/head', $data);
        $this->load->view('front/signup');
    }

// function to signup
    public function signup_by_modal() {
        $data = "";
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'email'      => $this->input->post('email'),
                'mobile'     => $this->input->post('mobile'),
                'dial_code'  => $this->input->post('mobile_code'),
                'role'       => 2,
                'password'   => md5($this->input->post('password')),
                'latitude'   => $this->input->post('latitude'),
                'longitude'  => $this->input->post('longitude'),
                'address'    => $this->input->post('site_location'),
                'country'    => $this->input->post('country'),
                'state'      => $this->input->post('state'),
                'city'       => $this->input->post('city'),
                'postal_code' => $this->input->post('postal_code'),
                'created'    => date("Y-m-d H:i:s")
            );
            $id              = $this->auth_model->setInsertData('tbl_users', $data);
            $CONSUMER_KEY    = $this->auth_model->generateRandomString();
            $CONSUMER_SECRET = $this->config->item("CONSUMER_SECRET");

            if ($id > 0) {
                $data1 = array(
                    'user_id'          => $id,
                    'userSecret'       => $CONSUMER_KEY,
                    'firstName'        => $this->input->post('first_name'),
                    'lastName'         => $this->input->post('last_name'),
                    'userEmail'        => $this->input->post('email'),
                    'userPassword'     => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'userAddress'      => $this->input->post('site_location'),
                    'userMobile'       => $this->input->post('mobile'),
                    'userMobile'       => $this->input->post('mobile'),
                    'userType'         => 1,
                    'userStatus'       => 1,
                    'userVerification' => 1,
                    'lastModified'     => date('Y-m-d G:i:s'),
                );
                $this->auth_model->setInsertData('users', $data1);
            }

            if($id > 0) {
                if($this->input->post('user_role') == 3) {
                    $data_partner = array(
                        'user_id'                 => $id,
                        'license_id'              => $this->input->post('license_id'),
                        'motar_commission'        => $this->input->post('percent_commission'),
                        'travel_commission'       => $this->input->post('percent_commission'),
                        'health_commission'       => $this->input->post('percent_commission'),
                        'credit_commission'       => $this->input->post('percent_commission'),
                        'house_commission'        => $this->input->post('percent_commission'),
                        'professional_commission' => $this->input->post('percent_commission'),
                        'individual_accident_commission' => $this->input->post('percent_commission'),
                        'created_date'            => date('Y-m-d H:i:s ')
                    );

                    $partner_share_data_id = $this->front_model->setInsertData($this->partner_share, $data_partner);


                    $email_template = 'send_company_password.html';
                    $templateTags = array(
                        '{{site_name}}'    => 'Proassur.com',
                        '{{site_logo}}'    => base_url(),
                        '{{site_url}}'     => base_url(),
                        '{{team_name}}'    => 'Proassur',
                        '{{user_name}}'    => $this->input->post('first_name'),
                        '{{year}}'         => date('Y'),
                        '{{company_name}}' => 'Proassur.com',
                        '{{password}}'     => $this->input->post('password'),
                        '{{email}}'        => $this->input->post('email')
                    );
                    $message = email_compose($email_template, $templateTags);
                    $to      = $this->input->post('email');
                    $subject = SEND_PARTNER_PASSWORD_SUBJECT;
                    if (send_smtp_mail($to, $subject, $message)) {
                        $this->session->set_flashdata('message', 'Your Partner has been added successfully and password has been send to the registered mail id.');
                        redirect('auth/login', 'refresh');
                    }
                }

                if($this->input->post('user_role') != 3) {
                    // $id = 14;
                    $email_template = 'send_user_verification_mail.html';
                    $link = base_url() . 'auth/verify/' . base64_encode($id);
                    $templateTags = array(
                        '{{site_name}}'         => 'Proassur.com',
                        '{{site_logo}}'         => base_url(),
                        '{{site_url}}'          => base_url(),
                        '{{team_name}}'         => 'Proassur',
                        '{{first_name}}'        => $this->input->post('first_name'),
                        '{{year}}'              => date('Y'),
                        '{{company_name}}'      => 'Proassur.com',
                        '{{verification_link}}' => $link,
                        '{{email}}'             => $this->input->post('email')
                    );
                    $message = email_compose($email_template, $templateTags);
                    $to      = $this->input->post('email');
                    $subject = SEND_VERIFICATION_MAIL;
                    if (send_smtp_mail($to, $subject, $message)) {
                        echo true;
                        return true;
                        //$this->session->set_flashdata('message',VERIFICATION_MESSAGE);
                    }
                }
            }
        }
        $this->load->view('front/include/head', $data);
        $this->load->view('front/signup');
    }

// function to check name
    public function name_check($str) {
        if (strlen($str) > 25) {
            $this->form_validation->set_message('name_check', 'The {field} field can not have more than 25 character');
            return FALSE;
        } else {
            return TRUE;
        }
    }

// function to check password
    public function password_check($str) {
        if (strlen($str) < 8) {
            $this->form_validation->set_message('password_check', 'The {field} field should not have less than 8 character');
            return FALSE;
        }
        if (!preg_match('/[A-Z]/', $str)) {
            $this->form_validation->set_message('password_check', 'The {field} field does not have uppercase character');
            return FALSE;
        }
        if (1 != preg_match('~[0-9]~', $str)) {
            $this->form_validation->set_message('password_check', 'The {field} field does not have Number');
            return FALSE;
        } else {
            return TRUE;
        }
    }

// function to check address
    public function address_check($str) {
        if (strlen($str) > 120) {
            $this->form_validation->set_message('address_check', 'The {field} field can not have more than 120 character');
            return FALSE;
        } else {
            return TRUE;
        }
    }

// function to verify the user account
    function verify() {
        $id = base64_decode($this->uri->segment('3'));
        if (checkUserExists($id)) {
            if (checkUserStatus($id) == 1) {
                $data['message'] = ALREADY_VERIFIED;
            } else {
                $data = array('status' => 1);
                $this->auth_model->setUpdateData('tbl_users', $data, $id);
                $data['message'] = VERIFIED_SUCCESS_MESSAGE;
            }
        } else {
            $data['message'] = USER_NOT_FOUND;
        }
        $this->load->view('front/include/head', $data);
        $this->load->view('front/verification_page');
    }

// function to send mail to registered email address to reset password
    public function forget_password() {
        $data = '';
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $data = $this->input->post('email');
            
            // $data             = 'utkarsh@sourcesoftsolutions.com';
            if ($data != '') {
                $userdata = $this->auth_model->UserForgot($data);
                if ($userdata != '0') {
                    $status = $userdata->status;
                    $id = $userdata->id;
                    if ($status == 1) {
                        $this->send_forgot_email($id);
                        $this->session->set_flashdata('message', FORGOT_SUCCESSS);
                        redirect('forget-password', 'refresh');
                    } else {
                        $this->session->set_flashdata('message', INACTIVE_ACCOUNT);
                        redirect('forget-password', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('message', INVALID_FORGOT);
                    redirect('forget-password', 'refresh');
                }
            } else {
                $this->session->set_flashdata('message', EMAIL_REQUIRED);
                redirect('forget-password', 'refresh');
            }
        }
        $this->load->view('front/include/head', $data);
        $this->load->view('front/forget_password');
    }

    public function send_forgot_email($userID) {
        $userdata = $this->auth_model->getDataCollectionByID($this->users, $userID);
        $forgot_link = base_url("reset-password/" . rtrim(base64_encode($userID), "="));
        $email_template = 'user_forget_password.html';
        $templateTags = array(
            '{{site_name}}' => 'Proassur.com',
            '{{site_logo}}' => base_url(),
            '{{site_url}}' => base_url(),
            '{{team_name}}' => 'Proassur',
            '{{first_name}}' => $userdata['first_name'],
            '{{year}}' => date('Y'),
            '{{company_name}}' => 'Proassur.com',
            '{{verification_link}}' => $forgot_link,
            '{{email}}' => $this->input->post('email')
        );
        $message = email_compose($email_template, $templateTags);
        $to = $this->input->post('email');
        $subject = SEND_FORGET_PASSWORD_MAIL;
        if (send_smtp_mail($to, $subject, $message)) {
            // $this->session->set_flashdata('message',VERIFICATION_MESSAGE);
            //redirect('reset-password/'.base64_encode($userID),'refresh');
        }
    }

    public function reset_password() {
        $data = '';
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('new_password', 'Password', 'required|callback_password_check');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]|callback_password_check');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $user_id = $this->uri->segment(2);
                $password = $this->input->post('new_password');
                $confirm_password = $this->input->post('confirm_password');
                $id = base64_decode($user_id);
                if ($id > 0) {
                    $data = array(
                        'password' => md5($this->input->post('new_password'))
                    );
                    $insert_id = $this->auth_model->setUpdateData($this->users, $data, $id);
                    if ($insert_id > 0) {
                        $this->session->set_flashdata('message', RESET_SUCCESSS);
                        redirect('login', 'refresh');
                    };
                } else {
                    echo '<div class="error">' . INVALID_FORGOT . '</div>';
                }
            }
        }
        $this->load->view('front/include/head', $data);
        $this->load->view('front/reset_password');
    }

    function dashboard() {
        CheckUserLoginSession();
        $user_id = $this->session->userdata('user_id');
        $data['user_role'] = $this->session->userdata('role');
        $user_data = $this->session->userdata();
        if ($data['user_role'] == 4) { // company
            $company_id = getCompanyIdByUserId($user_id);

            // Getting Today's Policy Report (by Shiv)
            $data['todays_total_issued_policies'] = $this->front_model->getTodaysPolicyCountForCompany($company_id, 'all');
            $data['todays_total_sold_policies'] = $this->front_model->getTodaysPolicyCountForCompany($company_id, 'paid');
            $data['todays_total_pending_slips'] = $this->front_model->getTodaysPolicyCountForCompany($company_id, 'pending');

            // Getting Insurance Policies (by Shiv) 
            $data['insurance_policies'] = $this->front_model->getPolicyListForCompany($company_id, 'all');

            // Getting Insurance Settings Data (by Shiv)
            // $data['insurance_settings'] = $this->front_model->getInsuranceSettingsDataForCompany($company_id);

            // Getting Payments For Policies
            // $data['payments'] = $this->front_model->getPolicyPaymentForCompany($company_id);
            /* print_r($data['payments']);
              die; */


            /* if($company_id) {
              $data['policies']  		  = $this->front_model->getPolicyListForCompany($company_id, 'all');
              $data['active_policies']  = $this->front_model->getPolicyListForCompany($company_id,'active');
              $data['expired_policies'] = $this->front_model->getPolicyListForCompany($company_id,'expired');
              $data['paid_policies']    = $this->front_model->getPolicyListForCompany($company_id,'paid');
              $data['unpaid_policies']  = $this->front_model->getPolicyListForCompany($company_id,'unpaid');
              die;
              } */
        } else if ($data['user_role'] == 3) { // partner
            // print_r($data['user_role']);
            $data['policies'] = $this->front_model->getPartnerPolicyList($user_data, 'all');
            $data['active_policies'] = $this->front_model->getPartnerPolicyList($user_data, 'active');
            $data['expired_policies'] = $this->front_model->getPartnerPolicyList($user_data, 'expired');
            // $data['paid_policies'] = $this->front_model->getPartnerPolicyList($user_data, 'paid');
            // $data['unpaid_policies'] = $this->front_model->getPartnerPolicyList($user_data, 'unpaid');
        } else {
            $data['policies'] = $this->front_model->getPolicyList($user_id, 'all');
            $data['active_policies'] = $this->front_model->getPolicyList($user_id, 'active');
            $data['expired_policies'] = $this->front_model->getPolicyList($user_id, 'expired');
            // $data['paid_policies'] = $this->front_model->getPolicyList($user_id, 'paid');
            // $data['unpaid_policies'] = $this->front_model->getPolicyList($user_id, 'unpaid'); 
        }
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_dashboard');
        $this->load->view('front/include/sidebar', $data);
        $this->load->view('front/include/policy_head', $data);
        $this->load->view('front/dashboard', $data);
        $this->load->view('front/include/script_foo');
    }

    public function claim() {

        $data['result'] = $this->db->get_where('tbl_policy_mgt', ['customer_id' => $this->session->userdata('user_id')])->result();
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_dashboard');
        $this->load->view('front/include/sidebar', $data);
        $this->load->view('front/claim', $data);
        $this->load->view('front/include/script_foo');
    }

    public function addQuestion() {

        if ($this->input->post()) {

            foreach ($this->input->post('question') as $val) {
                $dataArray[] = [
                    'payment_branch' => $this->input->post(payment_branch),
                    'question' => $val,
                    'created_by' => $this->session->userdata('user_id'),
                ];
            }
            $res = $this->db->insert_batch('tbl_question', $dataArray);
            if ($res) {
                redirect('dashboard');
            }
        } else {
            redirect('dashboard');
        }
    }

    public function addQuestionexcel() {
        $this->load->library('excel');

        if ($this->input->post()) {
            $path = APPPATH . 'upload/questions/';
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls';
            $config['remove_spaces'] = TRUE;
            $this->upload->initialize($config);
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('importfile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }

//            echo '<pre>';
//            print_r($data);

            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }

            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
//            echo '<pre>';
//            print_r($allDataInSheet);
            $arrayCount = count($allDataInSheet);
            $flag = 0;
            $createArray = array('Question');
            $makeArray = array('Question' => 'Question');
            $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    } else {
                        
                    }
                }
            }
            $data = array_diff_key($makeArray, $SheetDataKey);

            if (empty($data)) {
                $flag = 1;
            }
            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {
                    $addresses = array();
                    $question = $SheetDataKey['Question'];

                    $question = filter_var(trim($allDataInSheet[$i][$question]), FILTER_SANITIZE_STRING);

                    $fetchData[] = array(
                        'payment_branch' => $this->input->post('payment_branch'),
                        'question' => $question,
                        'created_by' => $this->session->userdata('user_id'),
                    );
                }
//                echo '<pre>';
//                print_r($fetchData);
//                die;

                $res = $this->db->insert_batch('tbl_question', $fetchData);
                if ($res) {
                    redirect('dashboard');
                }
            } else {
                echo "Please import correct file";
            }
        } else {
            redirect('dashboard');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        /* 		$userdata = array(
          'user_id'    =>'',
          'role'    =>'',
          'front_name'    =>'',
          'front_email' =>''
          );
          $this->session->set_userdata($userdata); */
        redirect('/', 'refresh');
    }

    public function user_detail_submit() {
        $email = $this->input->post('email');
        $first_name = $this->input->post('first_name');
        $email_exists = checkUserEmailExists($email);
        if ($email_exists) {
            $customer_id = getUserIdByEmail($email);
        } else {
            $data = array(
                'first_name' => $first_name,
                'email' => $email,
                'password' => md5('Enduser@123'),
                'role' => 2, // Customer
                'status' => 0,
                'created' => date("Y-m-d H:i:s")
            );

            $customer_id = $this->front_model->setInsertData($this->users, $data);
            if ($customer_id > 0) {
                $email_template = 'send_company_password.html';
                $templateTags = array(
                    '{{site_name}}' => 'Proassur.com',
                    '{{site_logo}}' => base_url(),
                    '{{site_url}}' => base_url(),
                    '{{team_name}}' => 'Proassur',
                    '{{user_name}}' => $this->input->post('first_name'),
                    '{{year}}' => date('Y'),
                    '{{company_name}}' => 'Proassur.com',
                    '{{password}}' => 'Enduser@123',
                    '{{email}}' => $this->input->post('email')
                );
                $message = email_compose($email_template, $templateTags);
                $to = $this->input->post('email');
                $subject = SEND_CUSTOMER_PASSWORD_SUBJECT;
                send_smtp_mail($to, $subject, $message);
            }
        }
        echo $customer_id;
    }

}
