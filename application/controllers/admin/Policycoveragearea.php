<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policycoveragearea extends CI_Controller {

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

	public $policycoverage_area     = 'tbl_policycoverage_area';

// function to add a policy covrerage area

	public function add() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) { 
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('zone_id', 'Zone', 'required');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim|numeric');
			$this->form_validation->set_rules('description', 'Description', 'required|trim');		

			if($this->form_validation->run() == FALSE) {   } else {
				$slug            = $this->input->post('name');
				$data            = array(									
					'name'        => $this->input->post('name'),
					'zone_id'     => $this->input->post('zone_id'),
					'amount' 	  => $this->input->post('amount'),	
					'description' => $this->input->post('description'),	
					'status'      => $this->input->post('status')
				);
				$id               = $this->admin_model->setInsertData($this->policycoverage_area,$data);
				$this->session->set_flashdata('message','Your policy coverage area has been added successfully');
		        redirect('admin/policycoverage-area/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/policycoverage_area/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit a policy coverage area

	public function edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		$checked_password  = $this->input->post('checked_password');
		if(!empty($post_data)) {     
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('zone_id', 'Zone', 'required');
			$this->form_validation->set_rules('name', 'Name', 'required|callback_policycoverage_area_exists|trim');	
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim|numeric');
			$this->form_validation->set_rules('description','Description','required');	
								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug           = $this->input->post('name');
				$data           = array(	
				'zone_id'       => $this->input->post('zone_id'),
				'name'     	    => $this->input->post('name'),
				'amount' 	    => $this->input->post('amount'),
				'description'   => $this->input->post('description'),
				'status'  	    => $this->input->post('status')
				); 
				$id             = $this->admin_model->setUpdateData($this->policycoverage_area,$data,$id);
				$this->session->set_flashdata('message','Your policy coverage area has been updated successfully');
		        redirect('admin/policycoverage-area/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->policycoverage_area,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/policycoverage_area/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to check policycoverage_area exists

	public function policycoverage_area_exists($string) {
		$policycoveragearea_id  = $this->uri->segment(4);
    	$result       = $this->admin_model->checkNameExists($policycoveragearea_id,$this->policycoverage_area,$string);
    	if($result>0) {
        $this->form_validation->set_message('policycoverage_area_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}



// function to list all policycoverage_area

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
        $totalCount             = $this->admin_model->totalRecord($this->policycoverage_area);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->policycoverage_area,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/policycoverage_area/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete a policycoverage_area

	public function delete() {
		CheckAdminLoginSession();
		$id = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->policycoverage_area,$id);
		$this->session->set_flashdata('message','Your policy coverage area has been deleted successfully');
        redirect('admin/policycoverage-area/lists','refresh');
	}

// function to change status of policycoverage_area

	public function status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->policycoverage_area,$data,$id);
		$this->session->set_flashdata('message','Your status has been updated successfully');
		redirect('admin/policycoverage-area/lists','refresh');		
	}
}