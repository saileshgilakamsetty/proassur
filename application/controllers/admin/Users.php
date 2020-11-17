<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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

	public $users     = 'tbl_users';
	public $company   = 'tbl_company';
	public $partner_share   = 'tbl_partner_share';

	public function add()
	{
		
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('email', 'Email', 'is_unique[tbl_company.email]|trim|valid_email');				
			$this->form_validation->set_rules('first_name', 'First Name', 'required|callback_name_check');		
			$this->form_validation->set_rules('last_name', 'Last Name', 'required|callback_name_check');		
			$this->form_validation->set_rules('dial_code', 'Area Code', 'required|trim|regex_match[/^\+?\d{3}$/]');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|trim|regex_match[/^[0-9]{9}$/]|is_unique[tbl_users.mobile]');
			$this->form_validation->set_rules('dob', 'Date of Birth', 'required|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|callback_password_check');		
			$this->form_validation->set_rules('gender', 'Gender', 'required|trim');		
			$this->form_validation->set_rules('re_password', 'Confirm Password', 'required|matches[password]|trim');		
			$this->form_validation->set_rules('site_location', ' Address', 'required|callback_address_check');
			// $this->form_validation->set_rules('interested_in', ' Interested In', 'required');
			$this->form_validation->set_rules('country', ' Country', 'required');
			$this->form_validation->set_rules('state', ' State', 'required');
			$this->form_validation->set_rules('city', ' City', 'required');
			// $this->form_validation->set_rules('postal_code', ' Zip Code', 'required');	
			$this->form_validation->set_rules('account_number', ' Account Number','required|is_numeric');
			$this->form_validation->set_rules('role', 'Role', 'required');

			if($this->input->post('role') == 3) {
				$this->form_validation->set_rules('license_id', 'License Id', 'required');
				$this->form_validation->set_rules('motar_commission', 'Motar Commission', 'required');
				$this->form_validation->set_rules('travel_commission', 'Travel Commission', 'required');
				$this->form_validation->set_rules('health_commission', 'Health Commission', 'required');
				$this->form_validation->set_rules('credit_commission', 'Credit Commission', 'required');
				$this->form_validation->set_rules('house_commission', 'House Commission', 'required');
				$this->form_validation->set_rules('professional_commission', 'Professional Commission', 'required');
				$this->form_validation->set_rules('individual_accident_commission', 'Individual Accident Commission', 'required');
			}	
								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug_str    = $this->input->post('first_name').'-'.$this->input->post('last_name');
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
				'first_name'       => $this->input->post('first_name'),
				'last_name'        => $this->input->post('last_name'),
				'email'            => $this->input->post('email'),	
				'dob'              => $this->input->post('dob'),
				'mobile'           => $this->input->post('mobile'),
				'dial_code'        => $this->input->post('dial_code'),	
				'password'         => md5($this->input->post('password')),
				'status'           => $this->input->post('status'),             
				'gender'           => $this->input->post('gender'),            
				'role'             => $this->input->post('id'),
				'created'          => date('Y-m-d H:i:s'),
				'latitude'         => $this->input->post('latitude'),
				'longitude'        => $this->input->post('longitude'),
				'address'          => $this->input->post('site_location'),
				'country'          => $this->input->post('country'),
				'state'            => $this->input->post('state'),
				'city'             => $this->input->post('city'),
				'postal_code'      => $this->input->post('postal_code'),
				'account_number'   => $this->input->post('account_number'),
				'role'             => $this->input->post('role')
				); 

				$id                = $this->admin_model->setInsertData($this->users,$data);
				if($_FILES["image"]["name"] != "") {
					$image             = do_upload('user','image');
					$data_featured_img = array('image' => $image );
					$this->admin_model->setUpdateData($this->users,$data_featured_img,$id);
				}
				if($id > 0) {
					if($this->input->post('role') == 4) { // company
						$data_company = array(
						'name'       => $this->input->post('first_name').'-'.$this->input->post('last_name'),
						'user_id'          => $id,
						'email'            => $this->input->post('email'),
						'mobile'           => $this->input->post('mobile'),
						'dial_code'        => $this->input->post('dial_code'),
						'status'           => $this->input->post('status'),           
						'created_date'     => date('Y-m-d H:i:s'),
						'modified_date'    => date('Y-m-d H:i:s'),
						'latitude'         => $this->input->post('latitude'),
						'longitude'        => $this->input->post('longitude'),
						'address'          => $this->input->post('site_location'),
						'country'          => $this->input->post('country'),
						'state'            => $this->input->post('state'),
						'city'             => $this->input->post('city'),
						'postal_code'      => $this->input->post('postal_code')
						);
						$company_id      = $this->admin_model->setInsertData($this->company,$data_company);
						// send credentials to user (entered email id)
						$email_template    = 'send_company_password.html';
						$templateTags      =  array(
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
						$message           = email_compose($email_template,$templateTags);
						$to                = $this->input->post('email');
						$subject           = SEND_COMPANY_PASSWORD_SUBJECT;
						if (send_smtp_mail($to,$subject,$message)) {
							$this->session->set_flashdata('message','Your company has been added successfully and password has been send to the registered mail id');
					        // redirect('admin/company/lists','refresh');
						}
						if($_FILES["image"]["name"] != "") {
							$image             = do_upload('company','image');
							$data_featured_img = array('image' => $image );
							$this->admin_model->setUpdateData($this->company,$data_featured_img,$company_id);
						}
					}
					else if($this->input->post('role') == 3) { // partner
						$data_partner = array(
							'user_id'        => $id,
							'license_id'     => $this->input->post('license_id'),
							'motar_commission' => $this->input->post('motar_commission'),
							'travel_commission' => $this->input->post('travel_commission'),
							'health_commission' => $this->input->post('health_commission'),
							'credit_commission' => $this->input->post('credit_commission'),
							'house_commission' => $this->input->post('house_commission'),
							'professional_commission' => $this->input->post('professional_commission'),
							'individual_accident_commission' => $this->input->post('individual_accident_commission'),
							'created_date'      => date('Y-m-d H:i:s ')
						);
						$partner_share_data_id      = $this->admin_model->setInsertData($this->partner_share,$data_partner);

						$email_template    = 'send_company_password.html';
						$templateTags      =  array(
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
						$message           = email_compose($email_template,$templateTags);
						$to                = $this->input->post('email');
						$subject           = SEND_PARTNER_PASSWORD_SUBJECT;
						if (send_smtp_mail($to,$subject,$message)) {
							$this->session->set_flashdata('message','Your Partner has been added successfully and password has been send to the registered mail id.');
					        // redirect('admin/company/lists','refresh');
						}
					}
				}

				$this->session->set_flashdata('message','Your user has been added successfully');
		        redirect('admin/users/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/users/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to check name
    public function name_check($str) {
        if (strlen($str)>25) {
            $this->form_validation->set_message('name_check', 'The {field} field can not have more than 25 character');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

// function to check address
    public function address_check($str) {
        if (strlen($str)>120) {
            $this->form_validation->set_message('address_check', 'The {field} field can not have more than 120 character');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

// function to check mobile number
    public function mobile_number($num) {
    	$id               = $this->uri->segment(4);
    	$number = $this->admin_model->getMobileNumber($this->users,$id,$num);
        if ($number == $num) {
            $this->form_validation->set_message('mobile_number', 'The {field} field exists for one of the user.');
            return FALSE;
        }
        else {
            return TRUE;
        }
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

	public function edit() {
		$id               = $this->uri->segment(4);
		$admin_user_id = $this->session->userdata("admin_id");
		if($id == $admin_user_id)
		{
			redirect(base_url("admin/users/lists"));
		}
		CheckAdminLoginSession();		
		$post_data        = $this->input->post();
		$checked_password = $this->input->post('checked_password');
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
			$this->form_validation->set_rules('first_name', 'First Name', 'required');		
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'callback_mobile_number|required|trim|regex_match[/^[0-9]{9}$/]');
			$this->form_validation->set_rules('dial_code', 'Area Code', 'required|trim|regex_match[/^\+?\d{3}$/]');
			$this->form_validation->set_rules('dob', 'Date of Birth', 'required|trim');	
			$this->form_validation->set_rules('gender', 'Gender', 'required|trim');				
			$this->form_validation->set_rules('site_location', ' Address', 'required|callback_address_check');
			$this->form_validation->set_rules('country', ' Country', 'required');
			$this->form_validation->set_rules('state', ' State', 'required');
			$this->form_validation->set_rules('city', ' City', 'required');
			// $this->form_validation->set_rules('postal_code', ' Zip Code', 'required');	
			$this->form_validation->set_rules('account_number', ' Account Number','required|is_numeric');
			$this->form_validation->set_rules('role', ' User Role', 'required');	
			

			if($this->input->post('role') == 3) {
				$this->form_validation->set_rules('license_id', 'Role', 'required');
				$this->form_validation->set_rules('motar_commission', 'Motar Commission', 'required');
				$this->form_validation->set_rules('travel_commission', 'Travel Commission', 'required');
				$this->form_validation->set_rules('health_commission', 'Health Commission', 'required');
				$this->form_validation->set_rules('credit_commission', 'Credit Commission', 'required');
				$this->form_validation->set_rules('house_commission', 'House Commission', 'required');
				$this->form_validation->set_rules('professional_commission', 'Professional Commission', 'required');
				$this->form_validation->set_rules('individual_accident_commission', 'Individual Accident Commission', 'required');
			}



			if($this->form_validation->run() == FALSE) {   } else {
				$slug_str   = $this->input->post('first_name').'-'.$this->input->post('last_name');
                $slug       = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data       = array(						
				'first_name' 	 => $this->input->post('first_name'),
				'last_name'  	 => $this->input->post('last_name'),
				'email'      	 => $this->input->post('email'),
				'dob'            => $this->input->post('dob'),
				'mobile'     	 => $this->input->post('mobile'),
				'dial_code'      => $this->input->post('dial_code'),
				'status'     	 => $this->input->post('status'),
				'gender'     	 => $this->input->post('gender'),
				'role'           => $this->input->post('id'),
				'latitude'       => $this->input->post('latitude'),
				'longitude'      => $this->input->post('longitude'),
				'address'        => $this->input->post('site_location'),
				'country'        => $this->input->post('country'),
				'state'          => $this->input->post('state'),
				'city'           => $this->input->post('city'),
				'postal_code'    => $this->input->post('postal_code'),
				'account_number' => $this->input->post('account_number'),
				'role'           => $this->input->post('role')
				); 

				$id             = $this->admin_model->setUpdateData($this->users,$data,$id);
				if($_FILES["image"]["name"] != "") {
					$image             = do_upload('user','image');
					$data_featured_img = array('image' => $image );
					$this->admin_model->setUpdateData($this->users,$data_featured_img,$id);
				}


				if($id > 0) {
					if($this->input->post('role') == 3) { // Partner
						$data_partner = array(
							'user_id'        => $id,
							'license_id'       => $this->input->post('license_id'),
							'motar_commission' => $this->input->post('motar_commission'),
							'travel_commission' => $this->input->post('travel_commission'),
							'health_commission' => $this->input->post('health_commission'),
							'credit_commission' => $this->input->post('credit_commission'),
							'house_commission' => $this->input->post('house_commission'),
							'professional_commission' => $this->input->post('professional_commission'),
							'individual_accident_commission' => $this->input->post('individual_accident_commission'),
							'created_date'      => date('Y-m-d H:i:s ')
						);
						$partner_share_data_id      = $this->admin_model->setUpdatePartnerData($this->partner_share,$data_partner,$id);


						$email_template    = 'send_partner_information.html';
						$templateTags      =  array(
							'{{site_name}}'    => 'Proassur.com',
							'{{site_logo}}'    => base_url(),
							'{{site_url}}'     => base_url(),
							'{{team_name}}'    => 'Proassur',
							'{{user_name}}'    => $this->input->post('first_name'),
							'{{year}}'         => date('Y'),
							'{{company_name}}' => 'Proassur.com',
							'{{password}}'     => $this->input->post('password'),
							'{{email}}'        => $this->input->post('email'),
							'{{motor_insurance_commision}}' => $this->input->post('motar_commission'),
							'{{health_insurance_commision}}' => $this->input->post('health_commission'),
							'{{travel_insurance_commision}}' => $this->input->post('travel_commission'),
							'{{professional_insurance_commision}}' => $this->input->post('professional_commission'),
							'{{individual_insurance_commision}}' => $this->input->post('individual_accident_commission'),
							'{{credit_insurance_commision}}' => $this->input->post('credit_commission'),
							'{{house_insurance_commision}}' => $this->input->post('house_commission')
						);
						$message           = email_compose($email_template,$templateTags);
						$to                = $this->input->post('email');
						$subject           = SEND_PARTNER_INFORMATION_SUBJECT;
						if (send_smtp_mail($to,$subject,$message)) {
							$this->session->set_flashdata('message','Your Partner has been updated successfully and the updated details has been send to the registered mail id.');
					        // redirect('admin/company/lists','refresh');
						}

					}
				}








				$this->session->set_flashdata('message','Your user has been update successfully');
		        redirect('admin/users/lists','refresh');
		    }
        }
		$data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->users,$id);
		$data['dataPartner']         = getPartnerCommissionShareByUserId($id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/users/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	public function lists()	{
		CheckAdminLoginSession();
		$per_page = 20;
        if($this->uri->segment(4)) {
        	$page = ($this->uri->segment(4)) ;
        }
        else {
        	$page = 1;
        }
      
        $start                   = ($page-1)*$per_page;
        $limit					 = $per_page;
        $totalCount =$this->admin_model->totaluserRecord($this->users);
       	
		$data["dataCollection"]  = $this->admin_model->getDataUserCollection($this->users,$limit,$start);
        $totalResult             = count($data['dataCollection']);
		$data["pagination"]      = Jpagination($totalCount,$limit,$start);
		$url                     = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL             = parse_url($url);
		$data["current_link"]    = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/users/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	public function delete() {
		CheckAdminLoginSession();
		$id=$this->uri->segment(4);
		$admin_user_id = $this->session->userdata("admin_id");
		if($id == $admin_user_id)
		{
			redirect(base_url("admin/users/lists"));
		}
		$this->admin_model->dataDelete($this->users,$id);
		$this->session->set_flashdata('message','Your users has been deleted successfully');
        redirect('admin/users/lists','refresh');
	}

	public function status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->users,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/users/lists','refresh');		
	}
}