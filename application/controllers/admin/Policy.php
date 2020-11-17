<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policy extends CI_Controller {

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

	public function add()
	{
		
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_users.email]|trim|valid_email');				
			$this->form_validation->set_rules('first_name', 'First Name', 'required');		
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');		
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|trim|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('dob', 'Date of Birth', 'required|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|trim');		
			$this->form_validation->set_rules('gender', 'Gender', 'required|trim');		
			$this->form_validation->set_rules('re_password', 'Confirm Password', 'required|matches[password]|trim');		
			$this->form_validation->set_rules('site_location', ' Address', 'required');
			// $this->form_validation->set_rules('interested_in', ' Interested In', 'required');
			$this->form_validation->set_rules('country', ' Country', 'required');
			$this->form_validation->set_rules('state', ' State', 'required');
			$this->form_validation->set_rules('city', ' City', 'required');
			$this->form_validation->set_rules('postal_code', ' Zip Code', 'required');	
								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug_str    = $this->input->post('first_name').'-'.$this->input->post('last_name');
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
				'first_name'       => $this->input->post('first_name'),								
				'last_name'        => $this->input->post('last_name'),								
				'email'            => $this->input->post('email'),				
				'dob'              => $this->input->post('dob'),				
				'mobile'           => $this->input->post('mobile'),				
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
				); 
				$id                = $this->admin_model->setInsertData($this->users,$data);
				if($_FILES["image"]["name"] != "") {
					$image             = do_upload('user','image');
					$data_featured_img = array('image' => $image );
					$this->admin_model->setUpdateData($this->users,$data_featured_img,$id);
				}
				$this->session->set_flashdata('message','Your user has been added successfully');
		        redirect('admin/policy/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/policy/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	public function edit() {
		$id               = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data        = $this->input->post();
		$checked_password = $this->input->post('checked_password');
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
			$this->form_validation->set_rules('first_name', 'First Name', 'required');		
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');		
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|trim|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('dob', 'Date of Birth', 'required|trim');	
			$this->form_validation->set_rules('gender', 'Gender', 'required|trim');				
			$this->form_validation->set_rules('site_location', ' Address', 'required');
			$this->form_validation->set_rules('country', ' Country', 'required');
			$this->form_validation->set_rules('state', ' State', 'required');
			$this->form_validation->set_rules('city', ' City', 'required');
			$this->form_validation->set_rules('postal_code', ' Zip Code', 'required');	
								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug_str   = $this->input->post('first_name').'-'.$this->input->post('last_name');
                $slug       = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data       = array(						
				'first_name' 	=> $this->input->post('first_name'),								
				'last_name'  	=> $this->input->post('last_name'),								
				'email'      	=> $this->input->post('email'),				
				'dob'        	=> $this->input->post('dob'),				
				'mobile'     	=> $this->input->post('mobile'),				
				'status'     	=> $this->input->post('status'),			        	             
				'gender'     	=> $this->input->post('gender'),			        	             
				'role'          => $this->input->post('id'),
				'latitude'      => $this->input->post('latitude'),
				'longitude'     => $this->input->post('longitude'),
				'address'       => $this->input->post('site_location'),
				'country'       => $this->input->post('country'),
				'state'         => $this->input->post('state'),
				'city'          => $this->input->post('city'),
				'postal_code'   => $this->input->post('postal_code'),
				); 

				$id             = $this->admin_model->setUpdateData($this->users,$data,$id);
				if($_FILES["image"]["name"] != "") {
					$image             = do_upload('user','image');
					$data_featured_img = array('image' => $image );
					$this->admin_model->setUpdateData($this->users,$data_featured_img,$id);
				}
				$this->session->set_flashdata('message','Your user has been update successfully');
		        redirect('admin/policy/lists','refresh');
		    }
        }
		$data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->users,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/policy/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	public function lists()	{
		CheckAdminLoginSession();
		$per_page=20;
        if($this->uri->segment(4)) {
        	$page = ($this->uri->segment(4)) ;
        }
        else {
        	$page = 1;
        }
      
        $start=($page-1)*$per_page;
        $limit=$per_page;
        $totalCount=$this->admin_model->totaluserRecord($this->users);
		$data["dataCollection"]=$this->admin_model->getDataUserCollection($this->users,$limit,$start);
        $totalResult= count($data['dataCollection']);
		$data["pagination"] = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/policy/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	public function delete()
	{
		CheckAdminLoginSession();
		$id=$this->uri->segment(4);
		$this->admin_model->dataDelete($this->users,$id);
		$this->session->set_flashdata('message','Your users has been deleted successfully');
        redirect('admin/policy/lists','refresh');
	}

	public function status()
	{
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->users,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/policy/lists','refresh');		
	}
}