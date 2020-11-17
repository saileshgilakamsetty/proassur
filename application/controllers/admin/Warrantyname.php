<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warrantyname extends CI_Controller {

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

	public $warranty_name     = 'tbl_warranty_name';

// function to add a name of a warranty

	public function add() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[tbl_franchise_name.name]');		

			if($this->form_validation->run() == FALSE) {   } else {
				$slug            = $this->input->post('name');
				$data            = array(									
					'name'       => $this->input->post('name'),					
					'status'     => $this->input->post('status'),									
				);
				$id              = $this->admin_model->setInsertData($this->warranty_name,$data);
				$this->session->set_flashdata('message','Your warranty name has been added successfully');
		        redirect('admin/warranty-name/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/warranty_name/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit a warranty_name

	public function edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		$checked_password  = $this->input->post('checked_password');
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'name', 'required|callback_warranty_name_exists|trim');		
								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug           = $this->input->post('name');
				$data           = array(			
				'name'     	    => $this->input->post('name'),								
				'status'  	    => $this->input->post('status')
				); 

				$id              = $this->admin_model->setUpdateData($this->warranty_name,$data,$id);
				$this->session->set_flashdata('message','Your warranty name has been update successfully');
		        redirect('admin/warranty-name/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->warranty_name,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/warranty_name/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to check warranty name exists
	public function warranty_name_exists($string) {
		$warranty_id  = $this->uri->segment(4);
    	$result       = $this->admin_model->checkNameExists($warranty_id,$this->warranty_name,$string);
    	if($result>0) {
        $this->form_validation->set_message('warranty_name_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}



// function to list all warranty_name

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
        $totalCount             = $this->admin_model->totalRecord($this->warranty_name);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->warranty_name,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$url                     = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL             = parse_url($url);
		$data["current_link"]    = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/warranty_name/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete a warranty_name

	public function delete() {
		CheckAdminLoginSession();
		$id=$this->uri->segment(4);
		$this->admin_model->dataDelete($this->warranty_name,$id);
		$this->session->set_flashdata('message','Your warranty name has been deleted successfully');
        redirect('admin/warranty-name/lists','refresh');
	}

// function to change status of warranty name

	public function status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->warranty_name,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/warranty-name/lists','refresh');		
	}
}