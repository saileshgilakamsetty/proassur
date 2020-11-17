<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Optionalwarranty extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $optional_warranty  = 'tbl_optional_warranty';
	public $company_insurance = 'tbl_company_insurance';

// function to add a question
	public function add() {	
        CheckAdminLoginSession();		
		$post_data             = $this->input->post();
		
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', ' Name', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
		foreach ($this->input->post('company_id') as $key => $company_id) {
			foreach ($company_id as  $insurance_type_id) {
				$data           = array(							
				'name'       => $this->input->post('name'),				
				'company_id'        => $key,				
				'insurance_type_id' => $insurance_type_id,				
				'created_date'      => date('Y-m-d H:i:s'),
				'modified_date'     => date('Y-m-d H:i:s'),
				'status'            => $this->input->post('status')	             
				); 
				$id = $this->admin_model->setInsertData($this->optional_warranty,$data);
			}
		}
				$this->session->set_flashdata('message','Your Optional Warranty has been added successfully');
		        redirect('admin/optional-warranty/lists','refresh');
		    }
        }
        $data='';
        $data['companyProvidingInsurance'] = $this->admin_model->getCompanyProvidingInsurance($this->company_insurance);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/optional_warranty/add',$data);
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
			$this->form_validation->set_rules('name', ' Question', 'required');
			if($this->form_validation->run() == FALSE) {   } else {
				$data                = array(							
					'question'           => $this->input->post('question'),				
					'description'  		 => $this->input->post('description'),
					'status'             => $this->input->post('status'),
					'modified_date'      => date('Y-m-d H:i:s')
				); 
				$id = $this->admin_model->setUpdateData($this->questionnaries,$data,$id);
				
				$this->session->set_flashdata('message','Your company question has been update successfully');
		        redirect('admin/optional-warranty/lists','refresh');
		    }
        }
		$data['dataCollection']            = $this->admin_model->getDataCollectionOptionaWarrantyByName($this->optional_warranty,$id);
        $data['companyProvidingInsurance'] = $this->admin_model->getCompanyProvidingInsurance($this->company_insurance);
		print_r($data['dataCollection']);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/optional_warranty/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
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
        $totalCount              = $this->admin_model->totalRecord($this->optional_warranty);
		$data["dataCollection"]  = $this->admin_model->getDataCollection($this->optional_warranty,$limit,$start);
        $totalResult             = count($data['dataCollection']);
		$data["pagination"]      = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/optional_warranty/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete
	public function delete() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->optional_warranty,$id);
		$this->session->set_flashdata('message','Your Optional Warrantyhas been deleted successfully');
        redirect('admin/optional-warranty/lists','refresh');
	}

// function to delete
	public function status()
	{
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->optional_warranty,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/optional-warranty/lists','refresh');		
	}
}