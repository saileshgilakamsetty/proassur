<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questionnaries extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $questionnaries = 'tbl_questionnaries';

// function to add a question
	public function add() {	
        CheckAdminLoginSession();		
		$post_data             = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('question', ' Question', 'required|is_unique[tbl_questionnaries.question]|trim');
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
				$data           = array(							
				'question'          => $this->input->post('question'),				
				'description'       => $this->input->post('description'),				
				'created_date'      => date('Y-m-d H:i:s'),
				'modified_date'     => date('Y-m-d H:i:s'),
				'status'            => $this->input->post('status')	             
				); 
				$id = $this->admin_model->setInsertData($this->questionnaries,$data);
				$this->session->set_flashdata('message','Your question has been added successfully');
		        redirect('admin/questionnaries/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/questionnaries/add');
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
			$this->form_validation->set_rules('question', ' Question', 'required|callback_check_question_exists');
			$this->form_validation->set_rules('description', 'Description', 'required|trim');					
			if($this->form_validation->run() == FALSE) {   } else {
				$data                = array(							
					'question'           => $this->input->post('question'),				
					'description'  		 => $this->input->post('description'),
					'status'             => $this->input->post('status'),
					'modified_date'      => date('Y-m-d H:i:s')
				); 
				$id = $this->admin_model->setUpdateData($this->questionnaries,$data,$id);
				
				$this->session->set_flashdata('message','Your questionnaries has been update successfully');
		        redirect('admin/questionnaries/lists','refresh');
		    }
        }
		$data['dataCollection']         = $this->admin_model->getDataCollectionByID($this->questionnaries,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/questionnaries/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// callback function to check question exists or not at time of edit 
	public function check_question_exists($string) {
		$company_id   = $this->uri->segment(4);
    	$result       = $this->admin_model->checkQuestionAdded($company_id,$this->questionnaries,$string);
    	if($result>0) {
        $this->form_validation->set_message('check_question_exists','The {field} selected is already been added. Please try another Question.');
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
        $totalCount              = $this->admin_model->totalRecord($this->questionnaries);
		$data["dataCollection"]  = $this->admin_model->getDataCollection($this->questionnaries,$limit,$start);
        $totalResult             = count($data['dataCollection']);
		$data["pagination"]      = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/questionnaries/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete
	public function delete() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->questionnaries,$id);
		$this->session->set_flashdata('message','Your question has been deleted successfully');
        redirect('admin/questionnaries/lists','refresh');
	}

// function to delete
	public function status()
	{
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->questionnaries,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/questionnaries/lists','refresh');		
	}
}