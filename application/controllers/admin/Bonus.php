<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bonus extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $bonus = 'tbl_bonus';

// function to add a bonus
	public function add() {	
        CheckAdminLoginSession();
		$post_data             = $this->input->post();

		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('company_id', ' Company', 'required');
			$this->form_validation->set_rules('branch_id', ' Branch', 'required');
			$this->form_validation->set_rules('risque_id', ' Risque', 'required');
			$this->form_validation->set_rules('year', ' Year', 'required|callback_check_year_for_company_branch');
			$this->form_validation->set_rules('discount', ' Discount', 'required');


			if($this->form_validation->run() == FALSE) {   } else {
				$data           = array(							

				'company_id'             => $this->input->post('company_id'),
				'branch_id'              => $this->input->post('branch_id'),
				'risque_id'              => $this->input->post('risque_id'),
				'year'                   => $this->input->post('year'),
				'discount'               => $this->input->post('discount'),
				'created_date'           => date('Y-m-d H:i:s'),
				'modified_date'          => date('Y-m-d H:i:s'),
				'status'                 => $this->input->post('status')
				); 

				$id = $this->admin_model->setInsertData($this->bonus,$data);
				$this->session->set_flashdata('message','Your Warranty has been added successfully');
		        redirect('admin/bonus/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/bonus/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	public function check_year_for_company_branch($year) {
		$company = $this->input->post('company_id');
		$branch  = $this->input->post('branch_id');
		$result  = $this->admin_model->checkYearForCompanyBranch($year,$company,$branch);
    	if($result) {
/*		echo $result;
		echo "string";
		die();*/
        $this->form_validation->set_message('check_year_for_company_branch','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 

	}

// function to edit 
	public function edit() {
		$id           = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data    = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('company_id', ' Company', 'required');
			$this->form_validation->set_rules('branch_id', ' Branch', 'required');
			$this->form_validation->set_rules('risque_id', ' Risque', 'required');
			$this->form_validation->set_rules('year', ' Year', 'required');
			$this->form_validation->set_rules('discount', ' Discount', 'required');




			if($this->form_validation->run() == FALSE) {   } else {

				$data           = array(							

				'company_id'             => $this->input->post('company_id'),
				'branch_id'              => $this->input->post('branch_id'),
				'risque_id'              => $this->input->post('risque_id'),
				'year'                   => $this->input->post('year'),
				'discount'               => $this->input->post('discount'),
				'created_date'           => date('Y-m-d H:i:s'),
				'modified_date'          => date('Y-m-d H:i:s'),
				'status'                 => $this->input->post('status')
				); 

/*				print_r($data);
				die();*/
				$id = $this->admin_model->setUpdateData($this->bonus,$data,$id);	
				$this->session->set_flashdata('message','Your bonus has been update successfully');
		        redirect('admin/bonus/lists','refresh');
		    }
        }
		$data['dataCollection']         = $this->admin_model->getDataCollectionByID($this->bonus,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/bonus/edit',$data);
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
        $totalCount              = $this->admin_model->totalRecord($this->bonus);
		$data["dataCollection"]  = $this->admin_model->getDataCollection($this->bonus,$limit,$start);
        $totalResult             = count($data['dataCollection']);
		$data["pagination"]      = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/bonus/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete
	public function delete() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->bonus,$id);
		$this->session->set_flashdata('message','Your bonus has been deleted successfully');
        redirect('admin/bonus/lists','refresh');
	}

// function to change status
	public function status()
	{
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->bonus,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/bonus/lists','refresh');		
	}

}