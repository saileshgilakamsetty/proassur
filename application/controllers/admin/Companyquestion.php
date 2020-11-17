<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Companyquestion extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $company_question        = 'tbl_company_question';
	public $company_risque_question = 'tbl_company_risque_questionid';

public function pdf() {
	// echo "string";
generatePdf();
}
// function to add a question
	public function add() {	
        CheckAdminLoginSession();		
		$post_data             = $this->input->post();
		
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('company_id', 'Company', 'required|trim');
			$this->form_validation->set_rules('branch_id', 'Branch', 'required|trim');			
			$this->form_validation->set_rules('risque_id', 'Risque', 'required|trim');
			$this->form_validation->set_rules('question_id[0]', 'Question', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
				$data           = array(							
				'company_id'        => $this->input->post('company_id'),				
				'branch_id'         => $this->input->post('branch_id'),				
				'risque_id'         => $this->input->post('risque_id'),
				'created_date'      => date('Y-m-d H:i:s'),
				'modified_date'     => date('Y-m-d H:i:s'),
				'status'            => $this->input->post('status')	             
				); 
				$id = $this->admin_model->setInsertData($this->company_question,$data);

				if ($id>0) {
					foreach ($this->input->post('question_id') as $question_id) {
						$data = array(
									'company_question_id' => $id, 
									'question_id'         => $question_id, 
									'created_date'        => date('Y-m-d H:i:s'),
									'modified_date'       => date('Y-m-d H:i:s'),
								);
						$this->admin_model->setInsertData($this->company_risque_question,$data);
					}
				}
				$this->session->set_flashdata('message','Your company question has been added successfully');
		        redirect('admin/company-question/lists','refresh');
		    }
        }
        $data = '';
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/company_question/add',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function to edit 
	public function edit() {
		CheckAdminLoginSession();		
		$company_question           = $this->uri->segment(4);
		$id                         = $this->uri->segment(4);
		// echo $company_question;
		$post_data    = $this->input->post();
		if(!empty($post_data)) {      
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('company_id', 'Company', 'required|trim');
			$this->form_validation->set_rules('branch_id', 'Branch', 'required|trim');			
			$this->form_validation->set_rules('risque_id', 'Risque', 'required|trim');
			$this->form_validation->set_rules('question_id[0]', 'Question', 'required|trim');	
			if($this->form_validation->run() == FALSE) {   } else {

				$data           = array(							
				'company_id'        => $this->input->post('company_id'),				
				'branch_id'         => $this->input->post('branch_id'),				
				'risque_id'         => $this->input->post('risque_id'),
				'created_date'      => date('Y-m-d H:i:s'),
				'modified_date'     => date('Y-m-d H:i:s'),
				'status'            => $this->input->post('status')	             
				); 

				print_r($data);

				$id                 = $this->admin_model->setUpdateData($this->company_question,$data,$id);
					$this->admin_model->dataDeleteByCompanyQuestionId($this->company_risque_question,$company_question);

					foreach ($this->input->post('question_id') as $question_id) {
						$data = array(
									'company_question_id' => $company_question, 
									'question_id'         => $question_id, 
									'created_date'        => date('Y-m-d H:i:s'),
									'modified_date'       => date('Y-m-d H:i:s'),
								);
						$this->admin_model->setInsertData($this->company_risque_question,$data);
					}
		    }
        }
        $data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->company_question,$company_question);
		$data['dataCollectionForCompany']     = $this->admin_model->getDataCollectionOfCompanyQuestion($this->company_risque_question,$company_question);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/company_question/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// callback function to check question exists or not at time of edit 
	public function check_question_exists($string) {
		$company_id   = $this->uri->segment(4);
    	$result       = $this->admin_model->checkQuestionAdded($company_id,$this->company_question,$string);
    	if($result>0) {
        $this->form_validation->set_message('check_question_exists','The {field} selected is already been added. Please try another Question.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}

// function to get list of company question
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
        $totalCount              = $this->admin_model->totalRecord($this->company_question);
		$data["dataCollection"]  = $this->admin_model->getDataCollection($this->company_question,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/company_question/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete a company question
	public function delete() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->company_question,$id);
		$this->session->set_flashdata('message','Your company question has been deleted successfully');
        redirect('admin/company-question/lists','refresh');
	}

// function to change sattus of company question
	public function status()
	{
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->company_question,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/company-question/lists','refresh');		
	}

	public function generatePdf() {
		$company_question_id      = $this->uri->segment(4);
		$filename                 = "proassur";
		$data['question_ids']     = $this->admin_model->getDataCollectionOfCompanyQuestionArray($this->company_risque_question,$company_question_id);
		$html = '';
		$html.=$this->load->view('admin/include/head',true);
		$html=$this->load->view('admin/company_question/pdf_view',$data,true);
		$html.=$this->load->view('admin/include/footer',true);
		$html.=$this->load->view('admin/include/foot',true);
		generatePdf($html,$filename);
	}
}