<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Franchise extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $franchise = 'tbl_franchise';

// function to add a franchise
	public function add() {	
        CheckAdminLoginSession();	
		$post_data             = $this->input->post();

		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('franchise_name_id', ' Franchise Name', 'required|trim');
			$this->form_validation->set_rules('company_id', ' Company', 'required');
			$this->form_validation->set_rules('branch_id', ' Branch', 'required');
			$this->form_validation->set_rules('warranty_id', ' Warranty', 'required');
			$this->form_validation->set_rules('risque_id', ' Risque', 'required');
			$this->form_validation->set_rules('fixed', ' Amount Mode', 'required');

			if ($this->input->post('fixed') == 0) {
				$this->form_validation->set_rules('type_value_vehicle', ' Type Value Vehicle', 'required');
				$this->form_validation->set_rules('percent', ' Percent', 'required');
				$this->form_validation->set_rules('min_percent', 'Minimum Percent', 'required');
				$this->form_validation->set_rules('max_percent', 'Maximum Percent', 'required|callback_check_max_percent_validation');
			}
			else if($this->input->post('fixed') == 1) {
				$this->form_validation->set_rules('fixed_value', ' Fixed Value', 'required');
				$this->form_validation->set_rules('min_fixed_value', ' Minimum Fixed Value', 'required');
				$this->form_validation->set_rules('max_fixed_value', ' Maximum Fixed Value', 'required|callback_check_max_fixed_value_validation');
			}

			$this->form_validation->set_rules('description', 'Description', 'required|trim');	
		
			if($this->form_validation->run() == FALSE) {   } else {
				
			if ($this->input->post('fixed') == 0 ) {
					$fixed     = 0;
					$actual_catalogue  = 1;
				}
				else {
					$actual_catalogue  = 0;
					$fixed     = 1;
				}

				$data           = array(							
				'franchise_name_id'      => $this->input->post('franchise_name_id'),				
				'fixed'          => $fixed,
				'actual_catalogue'       => $actual_catalogue,
				'percent'                => $this->input->post('percent'),				
				'type_value_vehicle'     => $this->input->post('type_value_vehicle'),				
				'min_percent'            => $this->input->post('min_percent'),				
				'max_percent'            => $this->input->post('max_percent'),				
				'min_fixed_value'        => $this->input->post('min_fixed_value'),
				'max_fixed_value'        => $this->input->post('max_fixed_value'),				
				'fixed_value'            => $this->input->post('fixed_value'),
				'company_id'             => $this->input->post('company_id'),
				'branch_id'              => $this->input->post('branch_id'),
				'risque_id'              => $this->input->post('risque_id'),
				'warranty_id'            => $this->input->post('warranty_id'),
				'description'            => $this->input->post('description'),
				'created_date'           => date('Y-m-d H:i:s'),
				'modified_date'          => date('Y-m-d H:i:s'),
				'status'                 => $this->input->post('status')	             
				); 


				$id = $this->admin_model->setInsertData($this->franchise,$data);
				$this->session->set_flashdata('message','Your franchise has been added successfully');
		        redirect('admin/franchise/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/franchise/add');
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
			$this->form_validation->set_rules('franchise_name_id', ' Franchise Name', 'required|trim');
			$this->form_validation->set_rules('company_id', ' Company', 'required');
			$this->form_validation->set_rules('branch_id', ' Branch', 'required');
			$this->form_validation->set_rules('risque_id', ' Risque', 'required');
			$this->form_validation->set_rules('warranty_id', ' Warranty', 'required');
			$this->form_validation->set_rules('fixed', ' Amount Mode', 'required');

			if ($this->input->post('fixed') == 0) {
				$this->form_validation->set_rules('percent', ' Percent', 'required');
				$this->form_validation->set_rules('type_value_vehicle', ' Type Value Vehicle', 'required');
				$this->form_validation->set_rules('min_percent', 'Minimum Percent', 'required');
				$this->form_validation->set_rules('max_percent', 'Maximum Percent', 'required|callback_check_max_percent_validation');
			}
			else if($this->input->post('fixed') == 1) {
				$this->form_validation->set_rules('fixed_value', ' Fixed Value', 'required');
				$this->form_validation->set_rules('min_fixed_value', ' Minimum Fixed Value', 'required');
				$this->form_validation->set_rules('max_fixed_value', ' Maximum Fixed Value', 'required|callback_check_max_fixed_value_validation');
			}
			$this->form_validation->set_rules('description', 'Description', 'required|trim');	

			if($this->form_validation->run() == FALSE) {   } else {

			if ($this->input->post('fixed') == 0 ) {
					$fixed     = 0;
					$actual_catalogue  = 1;
				}
				else {
					$actual_catalogue  = 0;
					$fixed     = 1;
				}
				
				$data           = array(							
				'franchise_name_id'      => $this->input->post('franchise_name_id'),				
				'fixed'          => $fixed,
				'actual_catalogue'       => $actual_catalogue,
				'percent'                => $this->input->post('percent'),		
				'type_value_vehicle'                => $this->input->post('type_value_vehicle'),				
				'min_percent'            => $this->input->post('min_percent'),
				'max_percent'            => $this->input->post('max_percent'),
				'min_fixed_value'        => $this->input->post('min_fixed_value'),
				'max_fixed_value'        => $this->input->post('max_fixed_value'),				
				'fixed_value'            => $this->input->post('fixed_value'),
				'company_id'             => $this->input->post('company_id'),
				'branch_id'              => $this->input->post('branch_id'),
				'warranty_id'            => $this->input->post('warranty_id'),
				'risque_id'              => $this->input->post('risque_id'),
				'description'            => $this->input->post('description'),
				'modified_date'          => date('Y-m-d H:i:s'),
				'status'                 => $this->input->post('status')	             
				); 
				$id = $this->admin_model->setUpdateData($this->franchise,$data,$id);	
				$this->session->set_flashdata('message','Your franchise has been update successfully');
		        redirect('admin/franchise/lists','refresh');
		    }
        }
		$data['dataCollection']         = $this->admin_model->getDataCollectionByID($this->franchise,$id);
		// print_r($data['dataCollection']);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/franchise/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// callback function to check name exists or not at time of edit 
	public function check_name_exists($string) {
		$franchise_id   = $this->uri->segment(4);
    	$result       = $this->admin_model->checkNameAdded($franchise_id,$this->franchise,$string);
    	if($result>0) {
        $this->form_validation->set_message('check_name_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}


// callback function to check max percent value is less than percent value 
	public function check_max_percent_validation($string) {
    	if($string > $this->input->post('percent')) {
        $this->form_validation->set_message('check_max_percent_validation','The {field} value can not be greater than percent value. Please try another value.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}

// callback function to check max percent value is less than percent value 
	public function check_max_fixed_value_validation($string) {
    	if($string > $this->input->post('fixed_value')) {
        $this->form_validation->set_message('check_max_fixed_value_validation','The {field} value can not be greater than fixed value. Please try another value.');
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
        $totalCount              = $this->admin_model->totalRecord($this->franchise);
		$data["dataCollection"]  = $this->admin_model->getFranchiseDataCollection($this->franchise,$limit,$start);
        $totalResult             = count($data['dataCollection']);
		$data["pagination"]      = Jpagination($totalCount,$limit,$start);
        $url                     = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL             = parse_url($url);
		$data["current_link"]    = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/franchise/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete
	public function delete() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->franchise,$id);
		$this->session->set_flashdata('message','Your franchise has been deleted successfully');
        redirect('admin/franchise/lists','refresh');
	}

// function to change status
	public function status()
	{
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->franchise,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/franchise/lists','refresh');		
	}

// function to get Risque By Branch Id of risque

	public function getRisqueByBranchId() {
        $data    = '';
        $data    = 'class="control-group  " id="risque_by_branch" ';
        $result  =  form_dropdown('risque_id', getRisqueByBranchId($this->input->post('branch_id')),set_value('risque_id'),$data); 
        print_r($result);
        // return $result;
	}
}