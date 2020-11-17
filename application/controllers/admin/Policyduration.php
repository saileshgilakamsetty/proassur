<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policyduration extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $policy_duration  = 'tbl_policy_duration';

// function to add a Polict Duration
	public function add() {	
        CheckAdminLoginSession();		
		$post_data             = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('min_days', 'Min Days', 'required|trim');				
			$this->form_validation->set_rules('max_days', 'Max Days', 'required|trim');				
			$this->form_validation->set_rules('premium_rate', 'Rate', 'required|trim|numeric');				
			$this->form_validation->set_rules('company_id[0]', 'Company', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
				foreach ($this->input->post('company_id') as $value) {
					$data           = array(							
						'min_days'         => $this->input->post('min_days'),
						'max_days'         => $this->input->post('max_days'),
						'premium_rate'     => $this->input->post('premium_rate'),
						'company_id'       => $value,		
						'status'           => $this->input->post('status'),		
						'created_date'     => date('Y-m-d H:i:s'),
						'modified_date'    => date('Y-m-d H:i:s')	             
					); 
					$id = $this->admin_model->setInsertData($this->policy_duration,$data);
				}
				$this->session->set_flashdata('message','Your Policy Duration has been added successfully');
		        redirect('admin/policy-duration/lists','refresh');
		    }
        }
        $data='';
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/policy_duration/add',$data);
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
			$this->form_validation->set_rules('min_days', 'Min Days', 'required|trim');				
			$this->form_validation->set_rules('max_days', 'Max Days', 'required|trim');				
			$this->form_validation->set_rules('premium_rate', 'Rate', 'required|trim|numeric');				
			$this->form_validation->set_rules('company_id', 'Company', 'required|trim');	
			if($this->form_validation->run() == FALSE) {   } else {
				$data           = array(							
					'min_days'         => $this->input->post('min_days'),
					'max_days'         => $this->input->post('max_days'),
					'premium_rate'     => $this->input->post('premium_rate'),
					'company_id'       => $this->input->post('company_id'),
					'status'           => $this->input->post('status'),
					'modified_date'    => date('Y-m-d H:i:s')	             
				); 
				$id = $this->admin_model->setUpdateData($this->policy_duration,$data,$id);
				
				$this->session->set_flashdata('message','Your Policy Duration has been update successfully');
		        redirect('admin/policy-duration/lists','refresh');
		    }
        }
		$data['dataCollection']            = $this->admin_model->getDataCollectionByID($this->policy_duration,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/policy_duration/edit',$data);
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
        $totalCount              = $this->admin_model->totalRecord($this->policy_duration);
		$data["dataCollection"]  = $this->admin_model->getDataCollection($this->policy_duration,$limit,$start);
        $totalResult             = count($data['dataCollection']);
		$data["pagination"]      = Jpagination($totalCount,$limit,$start);
		$url                     = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL             = parse_url($url);
		$data["current_link"]    = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/policy_duration/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete
	public function delete() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->policy_duration,$id);
		$this->session->set_flashdata('message','Your Policy Duration has been deleted successfully');
        redirect('admin/policy-duration/lists','refresh');
	}

// function to change the status
	public function status() {
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->policy_duration,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/policy-duration/lists','refresh');		
	}
}