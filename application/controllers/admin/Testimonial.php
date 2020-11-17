<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends CI_Controller {



	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
		
	}

	public $testimonial     = 'tbl_testimonial';

// function to add a testimonial

	public function add() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required');

			if($this->form_validation->run() == FALSE) {   } else {
				$data            = array(									
					'name'         => $this->input->post('name'),
					'designation'  => $this->input->post('designation'),
					'message'      => $this->input->post('message'),
					'status'       => $this->input->post('status'),
					'created_date' => date("Y-m-d H:i:s")
				);
				$id              = $this->admin_model->setInsertData($this->testimonial,$data);
				if($_FILES["image"]["name"] != "") {
					$image             = do_upload('testimonial','image');
					$data_featured_img = array('image' => $image );
					$this->admin_model->setUpdateData($this->testimonial,$data_featured_img,$id);
				}
				$this->session->set_flashdata('message','Your testimonial has been added successfully');
		        redirect('admin/testimonial/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/testimonial/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit a testimonial

	public function edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required');
			if($this->form_validation->run() == FALSE) {   } else {
				$data            = array(									
					'name'         => $this->input->post('name'),
					'designation'  => $this->input->post('designation'),
					'message'      => $this->input->post('message'),
					'status'       => $this->input->post('status'),
					'created_date' => date("Y-m-d H:i:s")
				);

				$id              = $this->admin_model->setUpdateData($this->testimonial,$data,$id);
				if($_FILES["image"]["name"] != "") {

					$image                   = do_upload('testimonial','image');
					$data_featured_img       = array('image' => $image );

					$this->admin_model->setUpdateData($this->testimonial,$data_featured_img,$id);
				}
				$this->session->set_flashdata('message','Your testimonial has been update successfully');
		        redirect('admin/testimonial/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->testimonial,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/testimonial/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to list all testimonial

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
        $totalCount             = $this->admin_model->totalRecord($this->testimonial);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->testimonial,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/testimonial/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete a testimonial

	public function delete() {
		CheckAdminLoginSession();
		$id=$this->uri->segment(4);
		$this->admin_model->dataDelete($this->testimonial,$id);
		$this->session->set_flashdata('message','Your testimonial has been deleted successfully');
        redirect('admin/testimonial/lists','refresh');
	}

// function to change status of testimonial

	public function status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->testimonial,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/testimonial/lists','refresh');		
	}
}