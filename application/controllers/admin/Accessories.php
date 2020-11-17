<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accessories extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $accessories = 'tbl_accessories';

// function to add a accessories
	public function add() {	
        CheckAdminLoginSession();	
		$post_data             = $this->input->post();

		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');



			$this->form_validation->set_rules('name', ' Name', 'required|trim');
			$this->form_validation->set_rules('minimum_premium', ' MINIMUM PREMIUM', 'required|trim|numeric');
			$this->form_validation->set_rules('maximum_premium', ' MAXIMUM PREMIUM', 'required|trim|numeric|callback_check_max_value_validation');
			$this->form_validation->set_rules('amount', ' Amount', 'required|numeric');
			$this->form_validation->set_rules('admin_share', ' Admin Share', 'required|numeric');
			$this->form_validation->set_rules('company_share', ' Company Share', 'required|numeric');
			$this->form_validation->set_rules('tax_percent', ' Tax Percentage', 'required|numeric');
			$this->form_validation->set_rules('company_id', ' Company', 'required');
			$this->form_validation->set_rules('branch_id', ' Branch', 'required');
			$this->form_validation->set_rules('risque_id', ' Risque', 'required');
			$this->form_validation->set_rules('description', ' Description', 'required|trim');
			$this->form_validation->set_rules('admin_policy_share', ' Admin Policy Commission', 'required|trim');


		
			if($this->form_validation->run() == FALSE) {   } else {
				$data           = array(							
					'name'               => $this->input->post('name'),
					'minimum_premium'    => $this->input->post('minimum_premium'),
					'maximum_premium'    => $this->input->post('maximum_premium'),
					'amount'             => $this->input->post('amount'),
					'admin_share'        => $this->input->post('admin_share'),	
					'company_share'      => $this->input->post('company_share'),
					'company_id'         => $this->input->post('company_id'),
					'branch_id'          => $this->input->post('branch_id'),
					'risque_id'          => $this->input->post('risque_id'),
					'description'        => $this->input->post('description'),
					'admin_policy_share' => $this->input->post('admin_policy_share'),
					'tax_percent'        => $this->input->post('tax_percent'),
					'created_date'       => date('Y-m-d H:i:s'),
					'modified_date'      => date('Y-m-d H:i:s'),
					'status'             => $this->input->post('status')
				); 
				$id = $this->admin_model->setInsertData($this->accessories,$data);
				$this->session->set_flashdata('message','Your accessories has been added successfully');
		        redirect('admin/accessories/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/accessories/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function to edit 
	public function edit() {
		$id           = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data    = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');


			$this->form_validation->set_rules('name', ' Name', 'required|trim');
			$this->form_validation->set_rules('minimum_premium', ' MINIMUM PREMIUM', 'required|trim|numeric');
			$this->form_validation->set_rules('maximum_premium', ' MAXIMUM PREMIUM', 'required|trim|numeric|callback_check_max_value_validation');
			$this->form_validation->set_rules('amount', ' Amount', 'required|numeric');
			$this->form_validation->set_rules('admin_share', ' Admin Share', 'required|numeric');
			$this->form_validation->set_rules('company_share', ' Company Share', 'required|numeric');
			$this->form_validation->set_rules('company_id', ' Company', 'required');
			$this->form_validation->set_rules('branch_id', ' Branch', 'required');
			$this->form_validation->set_rules('risque_id', ' Risque', 'required');
			$this->form_validation->set_rules('description', ' Description', 'required|trim');
			$this->form_validation->set_rules('admin_policy_share', ' Admin Policy Commission', 'required|trim');
			$this->form_validation->set_rules('tax_percent', ' Tax Percentage', 'required|numeric');

			if($this->form_validation->run() == FALSE) {   } else {


				
				$data           = array(							
					'name'               => $this->input->post('name'),
					'minimum_premium'    => $this->input->post('minimum_premium'),
					'maximum_premium'    => $this->input->post('maximum_premium'),
					'amount'             => $this->input->post('amount'),
					'admin_share'        => $this->input->post('admin_share'),	
					'company_share'      => $this->input->post('company_share'),
					'admin_policy_share' => $this->input->post('admin_policy_share'),
					'tax_percent'        => $this->input->post('tax_percent'),
					'company_id'         => $this->input->post('company_id'),
					'branch_id'          => $this->input->post('branch_id'),
					'risque_id'          => $this->input->post('risque_id'),
					'description'        => $this->input->post('description'),
					'created_date'       => date('Y-m-d H:i:s'),
					'modified_date'      => date('Y-m-d H:i:s'),
					'status'             => $this->input->post('status')
				); 

				$id = $this->admin_model->setUpdateData($this->accessories,$data,$id);	
				$this->session->set_flashdata('message','Your accessories has been update successfully');
		        redirect('admin/accessories/lists','refresh');
		    }
        }
		$data['dataCollection']         = $this->admin_model->getDataCollectionByID($this->accessories,$id);
		// print_r($data['dataCollection']);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/accessories/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// callback function to check name exists or not at time of edit 
	public function check_name_exists($string) {
		$accessories_id   = $this->uri->segment(4);
    	$result       = $this->admin_model->checkNameAdded($accessories_id,$this->accessories,$string);
    	if($result>0) {
        $this->form_validation->set_message('check_name_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}




// callback function to check max value is greater than min value 
	public function check_max_value_validation($string) {
    	if($string < $this->input->post('minimum_premium')) {
        $this->form_validation->set_message('check_max_value_validation','The {field} value can not be less than minimum premium. Please try another value.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}



// function to get lists
	public function lists()	{
		CheckAdminLoginSession();
		$per_page            = 20;
        if($this->uri->segment(4)){
        	$page            = ($this->uri->segment(4)) ;
        }
        else {
        	$page            = 1;
        }
        $start                   = ($page-1)*$per_page;
        $limit                   = $per_page;
        $totalCount              = $this->admin_model->totalRecord($this->accessories);
		$data["dataCollection"]  = $this->admin_model->getDataCollection($this->accessories,$limit,$start);
        $totalResult             = count($data['dataCollection']);
		$data["pagination"]      = Jpagination($totalCount,$limit,$start);
		$url                     = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL             = parse_url($url);
		$data["current_link"]    = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/accessories/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete
	public function delete() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->accessories,$id);
		$this->session->set_flashdata('message','Your accessories has been deleted successfully');
        redirect('admin/accessories/lists','refresh');
	}

// function to change status
	public function status()
	{
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->accessories,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/accessories/lists','refresh');		
	}


}