<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
		
	}

	public $users       = 'tbl_users';
	
	public function index() {
		CheckAdminLoginSession();		
		$id             = $this->session->userdata('admin_id');
		$post_data      = $this->input->post();

		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|trim|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('username', 'User Name', 'required');		
			$this->form_validation->set_rules('first_name', 'First Name', 'required');		
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');		
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|trim');
			$this->form_validation->set_rules('address', 'Address', 'required|trim');
				
			if($this->form_validation->run() == FALSE) {   } else {
				$data = array(											
				'username'       => $this->input->post('username'),								
				'first_name'     => $this->input->post('first_name'),							
				'last_name'      => $this->input->post('last_name'),						
				'email'          => $this->input->post('email'),			
				'address'        => $this->input->post('address'),			
				'mobile'         => $this->input->post('mobile')			        	             
				); 
				$id              = $this->admin_model->setUpdateData($this->users,$data,$id);
				if($_FILES["image"]["name"] != "") {
					$image=do_upload('user','image');
					$data_featured_img = array('image' => $image );
					$this->admin_model->setUpdateData($this->users,$data_featured_img,$id);
				}
				$this->session->set_flashdata('message','Admin has been update successfully.');
		        redirect('admin/profile','refresh');
		    }
        }
		$data['dataCollection']     = $this->admin_model->getDataCollectionByID($this->users,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/profile',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	public function changePassword() {
		CheckAdminLoginSession();		
		$id                          = $this->session->userdata('admin_id');
		$post_data                   = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');	
			$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
			$this->form_validation->set_rules('new_password', 'New Password', 'required|trim');		
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|matches[new_password]');
				
			if($this->form_validation->run() == FALSE) {   } else {
				$data                = array(             
					'password'       => md5($this->input->post('new_password'))             
				); 
				$password             = $this->admin_model->resolve_password($data,$id);
				if ($password != md5($this->input->post('current_password'))) {
					$this->session->set_flashdata('message','Please Enter the correct Current Password.');
				}
				else {
					$id                = $this->admin_model->setUpdateData($this->users,$data,$id);
					$this->session->set_flashdata('message','Password updated successfully.');
				}
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/change_password');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	public function forgetPassword() {
		$data = "";
		$post_data                   = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');	
			$this->form_validation->set_rules('email', 'Email', 'valid_email|required|callback_email_check');
				
			if($this->form_validation->run() == FALSE) {   } 
				else {
					$email_template    = 'admin_forget_password.html';
					$link              = base_url().'admin/reset-password/'.base64_encode($this->input->post('email')) ;
					$templateTags      =  array(
					'{{site_name}}'    => 'Proassur.com',
					'{{site_logo}}'    => base_url(),
					'{{site_url}}'     => base_url(),
					'{{team_name}}'    => 'Proassur',
					'{{user_name}}'    => $this->input->post('email'),
					'{{year}}'         => date('Y'),
					'{{company_name}}' => 'Proassur.com',
					'{{link}}'         => $link
					);


					$message           = email_compose($email_template,$templateTags);
					$to                = $this->input->post('email');
					$subject           = ADMIN_FORGET_PASSWORD_MAIL_SUBJECT;
					if (send_smtp_mail($to,$subject,$message)) {
						$this->session->set_flashdata('message','A password reset link has been send to the email entered');
		        		redirect('admin/forget-password','refresh');	
					}
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/forget_password');
		$this->load->view('admin/include/foot');
	}

// function to check the admin email exists or not
	public function email_check($str) {
		$result = $this->admin_model->checkAdminEmailExists($str);
		if (empty($result)) {
			$this->form_validation->set_message('email_check', 'The email entered doesnot exists for admin.');
			return false;
		}
		else {
			return true;
		}
	}

// function to reset password for admin
	public function reset_password() {
		$admin_mail =  base64_decode($this->uri->segment(3));
		$post_data                   = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');	
			$this->form_validation->set_rules('password', 'Password', 'required|trim');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
				
			if($this->form_validation->run() == FALSE) {   } 
			else {
				$data = array(
					'password' => md5($this->input->post('password'))
				);
				$this->admin_model->resetPassword($this->users,$data,$admin_mail);
				$this->session->set_flashdata('message','Your Password has been update successfully');
		        redirect('admin/login','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/reset_password');
		$this->load->view('admin/include/foot');		
	}

// function to check password
	public function password_check($str)
	{
        if (strlen($str)<8) {
            $this->form_validation->set_message('password_check', 'The {field} field should not have less than 8 character');
            return FALSE;
        }
        if(!preg_match('/[A-Z]/', $str)){
			$this->form_validation->set_message('password_check', 'The {field} field does not have uppercase character');
            return FALSE;	
		}
		if(1 != preg_match('~[0-9]~', $str)){
			$this->form_validation->set_message('password_check', 'The {field} field does not have Number');
            return FALSE;
		}		
        else {
            return TRUE;
        }
	}

}