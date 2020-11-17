<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slidder extends CI_Controller {



	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
		
	}

	public $slider     = 'tbl_slider';

// function to add a slider

	public function add() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('order','Sequence','required');

			if($this->form_validation->run() == FALSE) {   } else {
				$data            = array(									
					'name'       => $this->input->post('name'),
					'order'      => $this->input->post('order'),
					'status'     => $this->input->post('status')
				);
				$id              = $this->admin_model->setInsertData($this->slider,$data);
				if($_FILES["image"]["name"] != "") {
					$image             = do_upload('slider','image');
					$data_featured_img = array('image' => $image );
					$this->admin_model->setUpdateData($this->slider,$data_featured_img,$id);
				}
				$this->session->set_flashdata('message','Your slider has been added successfully');
		        redirect('admin/slidder/slidder-lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/slider/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit a slider

	public function edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('order','Sequence','required');						
			if($this->form_validation->run() == FALSE) {   } else {
				$data            = array(									
					'name'       => $this->input->post('name'),
					'order'      => $this->input->post('order'),
					'status'     => $this->input->post('status')
				);

				$id              = $this->admin_model->setUpdateData($this->slider,$data,$id);
				if($_FILES["image"]["name"] != "") {

					$image                   = do_upload('user','image');
					$data_featured_img       = array('image' => $image );

					$this->admin_model->setUpdateData($this->slider,$data_featured_img,$id);
				}
				$this->session->set_flashdata('message','Your slider has been update successfully');
		        redirect('admin/slidder/slidder-lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->slider,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/slider/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to list all slider

	public function slidder_lists()	{
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
        $totalCount             = $this->admin_model->totalRecord($this->slider);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->slider,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/slider/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete a slider

	public function delete() {
		CheckAdminLoginSession();
		$id=$this->uri->segment(4);
		$this->admin_model->dataDelete($this->slider,$id);
		$this->session->set_flashdata('message','Your Slider has been deleted successfully');
        redirect('admin/slidder/slidder-lists','refresh');
	}

// function to change status of slider

	public function status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->slider,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/slidder/slidder-lists','refresh');		
	}
}