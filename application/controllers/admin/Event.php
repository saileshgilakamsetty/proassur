<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

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

	public $event     = 'tbl_event';

// function to add a event
	public function add() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required');
			if($this->form_validation->run() == FALSE) {   } else {
				$slug            = $this->input->post('name');
				$data            = array(									
					'name'              => $this->input->post('name'),
					'description'       => $this->input->post('description'),
					'status'            => $this->input->post('status'),
					'created_date'      => date('Y-m-d H:i:s '),
					'modified_date'     => date('Y-m-d H:i:s')
				);
				$id              = $this->admin_model->setInsertData($this->event,$data);
				$this->session->set_flashdata('message','Your Event has been added successfully');
		        redirect('admin/event/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/event/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit a event

	public function edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'name', 'required|trim');			
			if($this->form_validation->run() == FALSE) {   } else {
				$slug           = $this->input->post('name');
				$data           = array(			
					'name'     	    => $this->input->post('name'),
					'description'   => $this->input->post('description'),
					'status'  	    => $this->input->post('status'),
					'modified_date' => date('Y-m-d H:i:s')
				); 

				$id              = $this->admin_model->setUpdateData($this->event,$data,$id);
				$this->session->set_flashdata('message','Your Event has been update successfully');
		        redirect('admin/event/lists','refresh');
		    }
        }
		$data['dataCollection']  = $this->admin_model->getDataCollectionByID($this->event,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/event/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to list all event

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
        $totalCount             = $this->admin_model->totalRecord($this->event);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->event,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/event/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete event
	public function delete() {
		CheckAdminLoginSession();
		$id      = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->event,$id);
		$this->session->set_flashdata('message','Your event has been deleted successfully');
        redirect('admin/event/lists','refresh');
	}

// function to change status of event
	public function status() {
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->event,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/event/lists','refresh');		
	}
}