<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventclaim extends CI_Controller {

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

	public $eventclaim     = 'tbl_event_claim';

// function to add a event claim

	public function add() {

        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('company_id', 'Company', 'required');		
			$this->form_validation->set_rules('event_id', 'Event', 'required|callback_isEventAdded');		
			$this->form_validation->set_rules('judicial_fee', 'Judicial Fee', 'required');
			$this->form_validation->set_rules('claim_raised', 'Claim', 'required');		

			if($this->form_validation->run() == FALSE) {   } else {
				$slug            = $this->input->post('company_id');
				$data            = array(									
					'company_id'    => $this->input->post('company_id'),	
					'event_id'      => $this->input->post('event_id'),	
					'judicial_fee'  => $this->input->post('judicial_fee'),	
					'claim_raised'  => $this->input->post('claim_raised'),	
					'created_date'  => date('Y-m-d H:i:s'),	
					'modified_date' => date('Y-m-d H:i:s'),	
					'status'        => $this->input->post('status')
				);

				$id              = $this->admin_model->setInsertData($this->eventclaim,$data);
				$this->session->set_flashdata('message','Your event claim has been added successfully');
		        redirect('admin/eventclaim/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/eventclaim/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// call back function at the time of insert to check if the same event is added for the same company
	public function isEventAdded($event_id) {
    	$company_id   = $this->input->post('company_id');
    	$result       = $this->admin_model->checkEventAddedForCompany($event_id,$company_id,$this->eventclaim);
    	if($result>0) {
        $this->form_validation->set_message('isEventAdded','The {field} selected is already been added for '.getCompanyName($company_id).'. Please try an other event.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	}    
	}

// function to edit a eventclaim
	public function edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('company_id', 'Company', 'required');		
			$this->form_validation->set_rules('event_id', 'Event', 'required|callback_isEventAddedThanThis');		
			$this->form_validation->set_rules('judicial_fee', 'Judicial Fee', 'required');
			$this->form_validation->set_rules('claim_raised', 'Claim', 'required');	
								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug            = $this->input->post('name');
				$data            = array(									
					'company_id'    => $this->input->post('company_id'),	
					'event_id'      => $this->input->post('event_id'),	
					'judicial_fee'  => $this->input->post('judicial_fee'),	
					'claim_raised'  => $this->input->post('claim_raised'),
					'modified_date' => date('Y-m-d H:i:s'),	
					'status'        => $this->input->post('status')
				);

				$id              = $this->admin_model->setUpdateData($this->eventclaim,$data,$id);
				if($_FILES["image"]["name"] != "") {

					$image                   = do_upload('user','image');
					$data_featured_img       = array('image' => $image );

					$this->admin_model->setUpdateData($this->eventclaim,$data_featured_img,$id);
				}
				$this->session->set_flashdata('message','Your eventclaim has been update successfully');
		        redirect('admin/eventclaim/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->eventclaim,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/eventclaim/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// call back function to check that event is added other than this
	public function isEventAddedThanThis($event_id) {
		$id           = $this->uri->segment(4);
    	$company_id   = $this->input->post('company_id');
    	$result       = $this->admin_model->checkEventAddedForCompanyThanthis($id,$event_id,$company_id,$this->eventclaim);
    	if($result>0) {
        $this->form_validation->set_message('isEventAddedThanThis','The {field} selected is already been added for '.getCompanyName($company_id).'. Please try an other event.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 

	}

// function to list all eventclaim
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
        $totalCount             = $this->admin_model->totalRecord($this->eventclaim);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->eventclaim,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/eventclaim/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete a eventclaim
	public function delete() {
		CheckAdminLoginSession();
		$id   = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->eventclaim,$id);
		$this->session->set_flashdata('message','Your eventclaim has been deleted successfully');
        redirect('admin/event-claim/lists','refresh');
	}

// function to change status of eventclaim
	public function status() {
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->eventclaim,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/event-claim/lists','refresh');		
	}
}