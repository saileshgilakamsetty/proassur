<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Claimreimbursementrate extends CI_Controller {

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

	public $claimreimbursement_rate     = 'tbl_claim_reimbursement_rate';
	public $companyclaim_reimbursement  = 'tbl_company_claim_reimbursement';

// function to add a policy covrerage area

	public function add() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('policy_coverage_area_id', 'Policy Coverage Area', 'required|trim');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');
			$this->form_validation->set_rules('rate', 'Rate', 'required|trim|numeric|less_than[100]');
			$this->form_validation->set_rules('description', 'Description', 'required|trim');
			// $this->form_validation->set_rules('amount', 'Amount', 'required|trim|numeric');
			$this->form_validation->set_rules('company_id[0]', 'Company', 'required');

			if($this->form_validation->run() == FALSE) {   } else {
				$slug            = $this->input->post('name');
				$data            = array(									
				'policy_coverage_area_id'        => $this->input->post('policy_coverage_area_id'),	
				'name'      		=> $this->input->post('name'),	
				'rate'     			=> $this->input->post('rate'),
				'description'		=> $this->input->post('description'),
				// 'amount' 			=> $this->input->post('amount'),
				'status'    		=> $this->input->post('status')
				);
				$id               = $this->admin_model->setInsertData($this->claimreimbursement_rate,$data);
				if ($id > 0) {
					foreach ($this->input->post('company_id') as $value) {
						$data = array(
							'claim_reimbursement_rate_id' => $id,
							'company_id'             => $value,
							'created_date'           => date('Y-m-d H:i:s')
							);
						$this->admin_model->setInsertData($this->companyclaim_reimbursement,$data);
					}
				}
				$this->session->set_flashdata('message','Your claim reimbursement rate has been added successfully');
		        redirect('admin/claim-reimbursement-rate/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/claimreimbursement_rate/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit a policy coverage area

	public function edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		$checked_password  = $this->input->post('checked_password');
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('policy_coverage_area_id', 'Policy Coverage Area', 'required|trim');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');	
			$this->form_validation->set_rules('rate', 'Rate', 'required|trim|numeric|less_than[100]');
			$this->form_validation->set_rules('description',' Description','required');	
			//$this->form_validation->set_rules('amount', 'Amount', 'required|trim|numeric');
			$this->form_validation->set_rules('company_id[0]', 'Company', 'required');
								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug           = $this->input->post('name');
				$data           = array(			
					'policy_coverage_area_id'        => $this->input->post('policy_coverage_area_id'),	
					'name'      		=> $this->input->post('name'),	
					'rate'     			=> $this->input->post('rate'),
					'description'		=> $this->input->post('description'),
					//'amount' 			=> $this->input->post('amount'),
					'status'    		=> $this->input->post('status'),
				); 

				$id              = $this->admin_model->setUpdateData($this->claimreimbursement_rate,$data,$id);
				if($id) {
					$this->admin_model->dataDeleteByClaimReimbursementId($this->companyclaim_reimbursement,$id);
					foreach ($this->input->post('company_id') as $value) {
						$data_company = array(
							'claim_reimbursement_rate_id' => $id,
							'company_id'             => $value,
							'created_date'           => date('Y-m-d H:i:s')
							);
						$this->admin_model->setInsertData($this->companyclaim_reimbursement,$data_company);
					}	
				}
				

				$this->session->set_flashdata('message','Your claim reimbuirsement rate has been updated successfully');
		        redirect('admin/claim-reimbursement-rate/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->claimreimbursement_rate,$id);
		$data['dataCollectionForCompany']     = $this->admin_model->getDataCollectionOfClaimReimbursementCompany($this->companyclaim_reimbursement,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/claimreimbursement_rate/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to check policycoverage_area exists

	public function policycoverage_area_exists($string) {
		$policycoveragearea_id  = $this->uri->segment(4);
    	$result       = $this->admin_model->checkNameExists($policycoveragearea_id,$this->claimreimbursement_rate,$string);
    	if($result>0) {
        $this->form_validation->set_message('policycoverage_area_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}



// function to list all policycoverage_area

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
        $totalCount             = $this->admin_model->totalRecord($this->claimreimbursement_rate);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->claimreimbursement_rate,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/claimreimbursement_rate/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete a policycoverage_area

	public function delete() {
		CheckAdminLoginSession();
		$id = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->claimreimbursement_rate,$id);
		$this->session->set_flashdata('message','Your claim reimbursement rate has been deleted successfully');
        redirect('admin/claim-reimbursement-rate/lists','refresh');
	}

// function to change status of policycoverage_area

	public function status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->claimreimbursement_rate,$data,$id);
		$this->session->set_flashdata('message','Your status has been updated successfully');
		redirect('admin/claim-reimbursement-rate/lists','refresh');		
	}
}