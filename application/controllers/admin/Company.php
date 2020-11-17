<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

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

	public $company               = 'tbl_company';
	public $users                 = 'tbl_users';
	public $company_vehicle_quote = 'tbl_company_vehicle_quote';

// function to add the company
	public function add() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {  
			// $insurance_type = $this->input->post('insurance_type');
   
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required');$this->form_validation->set_rules('dial_code', 'Dial Code', 'required|trim|regex_match[/^[0-9]{3}$/]');
			$this->form_validation->set_rules('mobile', 'Phone Number', 'required|trim|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_company.email]|is_unique[tbl_users.email]|trim|valid_email');
			// $this->form_validation->set_rules('insurance_type[0]', ' Insurance Type', 'required');
			$this->form_validation->set_rules('site_location', ' Address', 'required');
			$this->form_validation->set_rules('country', ' Country', 'required');
			$this->form_validation->set_rules('state', ' State', 'required');
			$this->form_validation->set_rules('city', ' City', 'required');		
			$this->form_validation->set_rules('description', 'Description', 'required');			
			$this->form_validation->set_rules('password', 'Password', 'required|trim');			
			$this->form_validation->set_rules('re_password', ' Comfirm password', 'required|trim|matches[password]');			

			if($this->form_validation->run() == FALSE) {   } else {
				$slug            = $this->input->post('name');


				$user_data          = array(
					'first_name'       => $this->input->post('name'),
					'last_name'        => $this->input->post('name'),
					'dial_code'        => $this->input->post('dial_code'),
					'mobile'           => $this->input->post('mobile'),
					'email'            => $this->input->post('email'),
					'password'         => md5($this->input->post('password')),
					'status'           => $this->input->post('status'),
					'address'          => $this->input->post('site_location'),
					'country'          => $this->input->post('country'),
					'state'            => $this->input->post('state'),
					'city'             => $this->input->post('city'),
					'role'             => 4,
					'postal_code'      => $this->input->post('postal_code'),
					'latitude'         => $this->input->post('latitude'),
					'longitude'        => $this->input->post('longitude'),
					'created'          => date('Y-m-d H:i:s')
				);
				$user_id              = $this->admin_model->setInsertData($this->users,$user_data);

				if($_FILES["image"]["name"] != "") {
					$image             = do_upload('user','image');
					$data_featured_img = array('image' => $image );
					$this->admin_model->setUpdateData($this->users,$data_featured_img,$user_id);
				}



				// Insert user data for chat 
				$CONSUMER_KEY    = $this->admin_model->generateRandomString();
                $CONSUMER_SECRET = $this->config->item("CONSUMER_SECRET");

                if ($user_id > 0) {
                    $data1 = array(
                        'user_id'          => $user_id,
                        'userSecret'       => $CONSUMER_KEY,
                        'firstName'        => $this->input->post('name'),
                        'lastName'         => $this->input->post('name'),
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
                    $this->admin_model->setInsertData('users', $data1);
                    // $this->auth_model->insert_entry($id, $CONSUMER_KEY, $this->post('first_name'), $this->post('last_name'), $this->post('email'), $this->post('password'), $this->post('address'), $this->post('mobile'), 0, 0);
                }








				if ($user_id > 0) {
					$company_data          = array(
						'user_id'          => $user_id,
						'name'             => $this->input->post('name'),
						'mobile'           => $this->input->post('mobile'),
						'dial_code'        => $this->input->post('dial_code'),
						'email'            => $this->input->post('email'),
						'status'           => $this->input->post('status'),
						'description'      => $this->input->post('description'),
						'address'          => $this->input->post('site_location'),
						'country'          => $this->input->post('country'),
						'state'            => $this->input->post('state'),
						'city'             => $this->input->post('city'),
						'postal_code'      => $this->input->post('postal_code'),
						'latitude'         => $this->input->post('latitude'),
						'longitude'        => $this->input->post('longitude'),
						'created_date'     => date('Y-m-d H:i:s'),
						'modified_date'    => date('Y-m-d H:i:s')
					);
					$company_id              = $this->admin_model->setInsertData($this->company,$company_data);

					if($_FILES["image"]["name"] != "") {
						$image             = do_upload('company','image');
						$data_featured_img = array('image' => $image );
						$this->admin_model->setUpdateData($this->company,$data_featured_img,$company_id);
					}

// send credentials to user (entered email id)
					$email_template    = 'send_company_password.html';
					$templateTags      =  array(
						'{{site_name}}'    => 'Proassur.com',
						'{{site_logo}}'    => base_url(),
						'{{site_url}}'     => base_url(),
						'{{team_name}}'    => 'Proassur',
						'{{user_name}}'    => $this->input->post('name'),
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
				        redirect('admin/company/lists','refresh');
					}
				}
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/company/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit the company
	public function edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {       
			// $insurance_type = $this->input->post('insurance_type');

			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'name', 'required|callback_company_name_exists');	
			$this->form_validation->set_rules('mobile', 'Phone Number', 'required|trim|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
			// $this->form_validation->set_rules('insurance_type[0]', ' Insurance Type', 'required');
			$this->form_validation->set_rules('site_location', ' Address', 'required');
			$this->form_validation->set_rules('country', ' Country', 'required');
			$this->form_validation->set_rules('state', ' State', 'required');
			$this->form_validation->set_rules('city', ' City', 'required');		
			$this->form_validation->set_rules('description', 'Description', 'required');

								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug           = $this->input->post('name');
				$data           = array(			
					'name'             => $this->input->post('name'),
					'dial_code'        => $this->input->post('dial_code'),
					'mobile'           => $this->input->post('mobile'),
					'email'            => $this->input->post('email'),
					'status'           => $this->input->post('status'),
					'description'      => $this->input->post('description'),
					'address'          => $this->input->post('site_location'),
					'country'          => $this->input->post('country'),
					'state'            => $this->input->post('state'),
					'city'             => $this->input->post('city'),
					'postal_code'      => $this->input->post('postal_code'),
					'latitude'         => $this->input->post('latitude'),
					'longitude'        => $this->input->post('longitude'),
					'modified_date'    => date('Y-m-d H:i:s')
				); 

				$id              = $this->admin_model->setUpdateData($this->company,$data,$id);
				if($_FILES["image"]["name"] != "") {

					$image                   = do_upload('company','image');
					$data_featured_img       = array('image' => $image );
					$this->admin_model->setUpdateData($this->company,$data_featured_img,$id);
				}


				$this->session->set_flashdata('message','Your company has been update successfully');
		        redirect('admin/company/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->company,$id);
		$data['dataCollectionImage']          = getImage($this->company,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/company/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to check company exists
	public function company_name_exists($string) {
		$company_id   = $this->uri->segment(4);
    	$result       = $this->admin_model->checkCompanyExists($company_id,$this->company,$string);
    	if($result>0) {
        $this->form_validation->set_message('company_name_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}

// function to get the company list
	public function lists()	{
		CheckAdminLoginSession();
		$per_page           = 20;
        if($this->uri->segment(4)) {
        	$page           = ($this->uri->segment(4)) ;
        }
        else {
        	$page           = 1;
        }
      
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->company);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->company,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/company/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete the company
	public function delete() {
		CheckAdminLoginSession();
		$id         = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->company,$id);
		$this->session->set_flashdata('message','Your company has been deleted successfully');
        redirect('admin/company/lists','refresh');
	}

// function to change the status
	public function status() {
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->company,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/company/lists','refresh');		
	}

// function to get list of the quote for company insuring vehicle 
	public function company_quote() {
		CheckAdminLoginSession();
		$per_page           = 20;
        if($this->uri->segment(4)) {
        	$page           = ($this->uri->segment(4)) ;
        }
        else {
        	$page           = 1;
        }
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;

        $totalCount             = $this->admin_model->totalRecord($this->company_vehicle_quote);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->company_vehicle_quote,$limit,$start);
        $totalResult            = count($data['dataCollection']);

        
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		//$data["current_link"]   = $_SERVER[REQUEST_URI];
		$data["current_link"]   = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/company/company_quote',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');		
	}

// function to add the quote for company insuring vehicle 
	public function company_quote_add() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {  
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('company_id', 'Company Id', 'required|trim');
			$this->form_validation->set_rules('fiscal_power', 'Fiscal Power', 'required|trim');	
			$this->form_validation->set_rules('fuel_type', 'Fuel Type', 'required|trim');
			$this->form_validation->set_rules('usage', 'Usage', 'required|trim');		
			$this->form_validation->set_rules('trailer', 'Trailer', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required');			
			// $this->form_validation->set_rules('tariff_id', 'Tariff', 'required');			
			$this->form_validation->set_rules('risque_id', 'Risque', 'required');			

			if($this->form_validation->run() == FALSE) {   } else {
				$slug            = $this->input->post('name');
				$data          = array(
					'company_id'         => $this->input->post('company_id'),
					'fiscal_power'       => $this->input->post('fiscal_power'),
					'fuel_type'          => $this->input->post('fuel_type'),
					'usage'              => $this->input->post('usage'),
					'trailer'            => $this->input->post('trailer'),
					// 'tariff_code'        => getTariffCode($this->input->post('tariff_id')),
					'risque_id'        => $this->input->post('risque_id'),
					'amount'             => $this->input->post('amount'),
					'seats'              => $this->input->post('seats'),
					'status'             => $this->input->post('status'),
					'created_date'       => date('Y-m-d H:i:s'),
					'modified_date'      => date('Y-m-d H:i:s')
				);

			/*	print_r($data);
				die();*/

				$id              = $this->admin_model->setInsertData($this->company_vehicle_quote,$data);
				if ($id>0) {
					$this->session->set_flashdata('message','Your company vehicle amount has been added');
				    redirect('admin/company/company-quote','refresh');
				}
				else {
				    $this->session->set_flashdata('message','Some thing went wrong. Please try again');
				    redirect('admin/company/company-quote','refresh');
				}

			}
		}

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/company/add_company_quote');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');		
	}

	// function to edit the quote for company insuring vehicle
	public function company_quote_edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {       
			$insurance_type = $this->input->post('insurance_type');

			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('company_id', 'Company Id', 'required|trim');
			$this->form_validation->set_rules('fiscal_power', 'Fiscal Power', 'required|trim');	
			$this->form_validation->set_rules('fuel_type', 'Fuel Type', 'required|trim');
			$this->form_validation->set_rules('usage', 'Usage', 'required|trim');		
			$this->form_validation->set_rules('trailer', 'Trailer', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required');			
			// $this->form_validation->set_rules('tariff_id', 'Tariff', 'required');			
			$this->form_validation->set_rules('risque_id', 'Risque', 'required');			

								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug           = $this->input->post('name');
				$data           = array(			
					'company_id'         => $this->input->post('company_id'),
					'fiscal_power'       => $this->input->post('fiscal_power'),
					'fuel_type'          => $this->input->post('fuel_type'),
					'usage'              => $this->input->post('usage'),
					'trailer'            => $this->input->post('trailer'),
					// 'tariff_code'        => getTariffCode($this->input->post('tariff_id')),
					'risque_id'        => $this->input->post('risque_id'),
					'amount'             => $this->input->post('amount'),
					'seats'              => $this->input->post('seats'),
					'status'             => $this->input->post('status'),
					'created_date'       => date('Y-m-d H:i:s')
				); 

/*print_r($id);
die();*/
				$id              = $this->admin_model->setUpdateData($this->company_vehicle_quote,$data,$id);

				$this->session->set_flashdata('message','Your company Quote has been update successfully');
		        redirect('admin/company/company-quote','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->company_vehicle_quote,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/company/edit_company_quote',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');		
	}

// function to delete the company
	public function company_quote_delete() {
		CheckAdminLoginSession();
		$id         = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->company_vehicle_quote,$id);
		$this->session->set_flashdata('message','Your company has been deleted successfully');
        redirect('admin/company/company-quote','refresh');
	}

// function to change the status
	public function company_quote_status() {
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->company_vehicle_quote,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/company/company-quote','refresh');		
	}

}