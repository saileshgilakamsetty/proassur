<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

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

	public $department     = 'tbl_department';

// function to add a department

	public function add() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('region_id', 'Region', 'required|trim|is_unique[tbl_department.name]');		
			$this->form_validation->set_rules('name', 'Name', 'required');		

			if($this->form_validation->run() == FALSE) {   } else {
				$data            = array(									
					'region_id'         => $this->input->post('region_id'),
					'name'              => $this->input->post('name'),	
					'status'            => $this->input->post('status'),
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
				);
				$id              = $this->admin_model->setInsertData($this->department,$data);

				$this->session->set_flashdata('message','Your Department has been added successfully');
		        redirect('admin/department/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/department/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit a department

	public function edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'name', 'required|trim|callback_department_name_exists');
			$this->form_validation->set_rules('region_id', 'Region', 'required');		

								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug           = $this->input->post('name');
				$data           = array(			
					'region_id'     => $this->input->post('region_id'),
					'name'     	    => $this->input->post('name'),		
					'status'  	    => $this->input->post('status')
				); 

				$id              = $this->admin_model->setUpdateData($this->department,$data,$id);
				$this->session->set_flashdata('message','Your department has been update successfully');
		        redirect('admin/department/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->department,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/department/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to check department exists
	public function department_name_exists($string) {
		$department_id = $this->uri->segment(4);
    	$result        = $this->admin_model->checkNameAdded($department_id,$this->department,$string);
    	if($result>0) {
        $this->form_validation->set_message('department_name_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}

// function to list all department

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
        $totalCount             = $this->admin_model->totalRecord($this->department);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->department,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$url                    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL            = parse_url($url);
		$data["current_link"]   = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/department/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete a department

	public function delete() {
		CheckAdminLoginSession();
		$id=$this->uri->segment(4);
		$this->admin_model->dataDelete($this->department,$id);
		$this->session->set_flashdata('message','Your department has been deleted successfully');
        redirect('admin/department/lists','refresh');
	}

// function to change status of department

	public function status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->department,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/department/lists','refresh');		
	}


// function to get commune By department Id 
	public function getCommuneByDepartmentId() {
        $data    = '';
        $data    = 'class="control-group  " id="commune_by_department" ';
        $result  =  form_dropdown('commune_id', getCommuneByDepartmentId($this->input->post('department_id')),set_value('commune_id'),$data); 
        print_r($result);
        return $result;
	}
}