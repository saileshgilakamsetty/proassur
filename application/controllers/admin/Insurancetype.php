<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insurancetype extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $insurance_type = 'tbl_insurance_type';

// function to add a name
	public function add() {	
        CheckAdminLoginSession();		
		$post_data             = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', ' name', 'required|is_unique[tbl_insurance_type.name]|trim');
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
				$data           = array(							
				'name'              => $this->input->post('name'),				
				'description'       => $this->input->post('description'),				
				'created_date'      => date('Y-m-d H:i:s'),
				'modified_date'     => date('Y-m-d H:i:s'),
				'status'            => $this->input->post('status')	             
				); 
				$id = $this->admin_model->setInsertData($this->insurance_type,$data);
				$this->session->set_flashdata('message','Your insurance type has been added successfully');
		        redirect('admin/insurance-type/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/insurance_type/add');
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

			$this->form_validation->set_rules('name', ' name', 'required|callback_check_name_exists');
			$this->form_validation->set_rules('description', 'Description', 'required|trim');					
			if($this->form_validation->run() == FALSE) {   } else {
				$data                = array(							
					'name'           => $this->input->post('name'),				
					'description'  		 => $this->input->post('description'),
					'status'             => $this->input->post('status'),
					'modified_date'      => date('Y-m-d H:i:s')
				); 
				$id = $this->admin_model->setUpdateData($this->insurance_type,$data,$id);
				
				$this->session->set_flashdata('message','Your insurance type has been update successfully');
		        redirect('admin/insurance-type/lists','refresh');
		    }
        }
		$data['dataCollection']         = $this->admin_model->getDataCollectionByID($this->insurance_type,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/insurance_type/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// callback function to check name exists or not at time of edit 
	public function check_name_exists($string) {
		$insurance_type_id   = $this->uri->segment(4);
		// print_r($company_id)
    	$result       = $this->admin_model->checkinsuranceTypeAdded($insurance_type_id,$this->insurance_type,$string);
    	if($result>0) {
        $this->form_validation->set_message('check_name_exists','The {field} selected is already been added. Please try another name.');
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
        $totalCount              = $this->admin_model->totalRecord($this->insurance_type);
		$data["dataCollection"]  = $this->admin_model->getDataCollection($this->insurance_type,$limit,$start);
        $totalResult             = count($data['dataCollection']);
		$data["pagination"]      = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/insurance_type/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete
	public function delete() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->insurance_type,$id);
		$this->session->set_flashdata('message','Your name has been deleted successfully');
        redirect('admin/insurance-type/lists','refresh');
	}

// function to delete
	public function status()
	{
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->insurance_type,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/insurance-type/lists','refresh');		
	}
}