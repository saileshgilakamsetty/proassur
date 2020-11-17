<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commune extends CI_Controller {

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

	public $commune     = 'tbl_commune';

// function to add a commune

	public function add() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('department_id', 'Department', 'required|trim|is_unique[tbl_commune.name]');		
			$this->form_validation->set_rules('name', 'Name', 'required');		

			if($this->form_validation->run() == FALSE) {   } else {
				$data            = array(									
					'department_id'     => $this->input->post('department_id'),
					'name'              => $this->input->post('name'),	
					'status'            => $this->input->post('status'),
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
				);
				$id              = $this->admin_model->setInsertData($this->commune,$data);

				$this->session->set_flashdata('message','Your commune has been added successfully');
		        redirect('admin/commune/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/commune/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit a commune

	public function edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'name', 'required|trim|callback_commune_name_exists');
			$this->form_validation->set_rules('department_id', 'Department', 'required');		
					
								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug           = $this->input->post('name');
				$data           = array(			
					'department_id'     => $this->input->post('department_id'),
					'name'     	    => $this->input->post('name'),		
					'status'  	    => $this->input->post('status')
				); 


				$id              = $this->admin_model->setUpdateData($this->commune,$data,$id);
				$this->session->set_flashdata('message','Your commune has been update successfully');
		        redirect('admin/commune/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->commune,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/commune/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to check commune exists
	public function commune_name_exists($string) {
		$commune_id = $this->uri->segment(4);
    	$result        = $this->admin_model->checkNameAdded($commune_id,$this->commune,$string);
    	if($result>0) {
        $this->form_validation->set_message('commune_name_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}

// function to list all commune

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
        $totalCount             = $this->admin_model->totalRecord($this->commune);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->commune,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$url                    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL            = parse_url($url);
		$data["current_link"]   = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/commune/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete a commune

	public function delete() {
		CheckAdminLoginSession();
		$id=$this->uri->segment(4);
		$this->admin_model->dataDelete($this->commune,$id);
		$this->session->set_flashdata('message','Your commune has been deleted successfully');
        redirect('admin/commune/lists','refresh');
	}

// function to change status of commune

	public function status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->commune,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/commune/lists','refresh');		
	}
}