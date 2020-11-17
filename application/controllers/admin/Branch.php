<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {

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

	public $branch             = 'tbl_branch';
	public $company_branch     = 'tbl_company_branch';

	public function add() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required');			
			$this->form_validation->set_rules('description', 'Description', 'required');			
			$this->form_validation->set_rules('company_id[0]', 'Company', 'required');			

			if($this->form_validation->run() == FALSE) {   } else {
				$slug            = $this->input->post('name');
				$data            = array(									
					'name'             => $this->input->post('name'),
					'status'           => $this->input->post('status'),
					'description'      => $this->input->post('description'),
					'created_date'     => date('Y-m-d H:i:s'),
					'modified_date'    => date('Y-m-d H:i:s')
				);
				$id              = $this->admin_model->setInsertData($this->branch,$data);
				if ($id) {
					foreach ($this->input->post('company_id') as $value) {
						$data = array(
								'company_id'       => $value,
								'branch_id'        => $id,
								'created_date'     => date('Y-m-d H:i:s')
							);
						$this->admin_model->setInsertData($this->company_branch,$data);
					}
				}
				$this->session->set_flashdata('message','Your branch has been added successfully');
		        redirect('admin/branch/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/branch/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	public function edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required');			
			$this->form_validation->set_rules('company_id[0]', 'Company', 'required');			

								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug           = $this->input->post('name');
				$data           = array(			
					'name'             => $this->input->post('name'),
					'status'           => $this->input->post('status'),
					'description'      => $this->input->post('description'),
					'modified_date'    => date('Y-m-d H:i:s')
				); 
				$id                    = $this->admin_model->setUpdateData($this->branch,$data,$id);
				if ($id) {
					$this->admin_model->dataDeleteByBranchId($this->company_branch,$id);
					foreach ($this->input->post('company_id') as $value) {
						$data = array(
							'company_id'       => $value,
							'branch_id'        => $id,
							'created_date'     => date('Y-m-d H:i:s')
							);
						$this->admin_model->setInsertData($this->company_branch,$data);
					}
				}

				$this->session->set_flashdata('message','Your branch has been update successfully');
		        redirect('admin/branch/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->branch,$id);
		$data['dataCollectionForCompany']     = $this->admin_model->getDataCollectionOfBranchCompany($this->company_branch,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/branch/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

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
        $totalCount             = $this->admin_model->totalRecord($this->branch);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->branch,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/branch/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	public function delete() {
		CheckAdminLoginSession();
		$id        = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->branch,$id);
		$this->session->set_flashdata('message','Your branch has been deleted successfully');
        redirect('admin/branch/lists','refresh');
	}

	public function status() {
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->branch,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/branch/lists','refresh');		
	}
}