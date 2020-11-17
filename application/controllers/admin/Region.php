<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Region extends CI_Controller {

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

	public $region     = 'tbl_region';

// function to add a region

	public function add() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[tbl_region.name]');		

			if($this->form_validation->run() == FALSE) {   } else {
				$data            = array(									
					'name'              => $this->input->post('name'),	
					'status'            => $this->input->post('status'),
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
				);
				$id              = $this->admin_model->setInsertData($this->region,$data);

				$this->session->set_flashdata('message','Your Region has been added successfully');
		        redirect('admin/region/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/region/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit a region

	public function edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'name', 'required|trim|callback_region_name_exists');		
								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug           = $this->input->post('name');
				$data           = array(			
					'name'     	    => $this->input->post('name'),		
					'status'  	    => $this->input->post('status')
				); 

				$id              = $this->admin_model->setUpdateData($this->region,$data,$id);
				$this->session->set_flashdata('message','Your region has been update successfully');
		        redirect('admin/region/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->region,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/region/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to check region exists
	public function region_name_exists($string) {
		$region_id    = $this->uri->segment(4);
    	$result       = $this->admin_model->checkNameAdded($region_id,$this->region,$string);
    	if($result>0) {
        $this->form_validation->set_message('region_name_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}

// function to list all region

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
        $totalCount             = $this->admin_model->totalRecord($this->region);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->region,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/region/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete a region

	public function delete() {
		CheckAdminLoginSession();
		$id=$this->uri->segment(4);
		$this->admin_model->dataDelete($this->region,$id);
		$this->session->set_flashdata('message','Your region has been deleted successfully');
        redirect('admin/region/lists','refresh');
	}

// function to change status of region

	public function status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->region,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/region/lists','refresh');		
	}

// function to get Department By Region Id of risque
	public function getDepartmentByRegionId() {
        $data    = '';
        $data    = 'class="control-group  " id="department_by_region" ';
        $result  =  form_dropdown('department_id', getDepartmentByRegionId($this->input->post('region_id')),set_value('department_id'),$data); 
        print_r($result);
        return $result;
	}

}