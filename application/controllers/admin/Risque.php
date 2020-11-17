<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Risque extends CI_Controller {

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

	public $risque             = 'tbl_risque';


// function to add a risque
	
	public function add() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[tbl_risque.name]');			
			// $this->form_validation->set_rules('tax_commission', 'Tax Commission', 'required|trim|numeric');
			$this->form_validation->set_rules('company_id', 'Company', 'required|trim');			
			$this->form_validation->set_rules('branch_id', 'Branch', 'required|trim');			
			$this->form_validation->set_rules('description', 'Description', 'required|trim');			

			if($this->form_validation->run() == FALSE) {   } else {
				$data            = array(									
					'name'             => $this->input->post('name'),
					// 'tax_commission'   => $this->input->post('tax_commission'),
					'company_id'       => $this->input->post('company_id'),
					'branch_id'        => $this->input->post('branch_id'),
					'status'           => $this->input->post('status'),
					'description'      => $this->input->post('description'),
					'created_date'     => date('Y-m-d H:i:s'),
					'modified_date'    => date('Y-m-d H:i:s')
				);
				/*print_r($data);
				die();*/
				$id              = $this->admin_model->setInsertData($this->risque,$data);
				if($_FILES["image"]["name"] != "") {
					$image             = do_upload('risque','image');
					$data_featured_img = array('image' => $image );
					$this->admin_model->setUpdateData($this->risque,$data_featured_img,$id);
				}
				$this->session->set_flashdata('message','Your Risque has been added successfully');
		        redirect('admin/risque/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/risque/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit a risque
	public function edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required');			
			// $this->form_validation->set_rules('tax_commission', 'Tax Commission', 'required');
			$this->form_validation->set_rules('company_id', 'Company', 'required');			
			$this->form_validation->set_rules('branch_id', 'Branch', 'required');			
			$this->form_validation->set_rules('description', 'Description', 'required');	
								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug           = $this->input->post('name');
				$data           = array(			
					'name'             => $this->input->post('name'),
					// 'tax_commission'   => $this->input->post('tax_commission'),
					'company_id'       => $this->input->post('company_id'),
					'branch_id'        => $this->input->post('branch_id'),
					'status'           => $this->input->post('status'),
					'description'      => $this->input->post('description'),
					'modified_date'    => date('Y-m-d H:i:s')
				); 
				$id                    = $this->admin_model->setUpdateData($this->risque,$data,$id);
				if($_FILES["image"]["name"] != "") {
					$image                   = do_upload('risque','image');
					$data_featured_img       = array('image' => $image );
					$this->admin_model->setUpdateData($this->risque,$data_featured_img,$id);
				}
				$this->session->set_flashdata('message','Your risque has been update successfully');
		        redirect('admin/risque/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->risque,$id);

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/risque/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to list a risque

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
        $totalCount             = $this->admin_model->totalRecord($this->risque);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->risque,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$url                    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL            = parse_url($url);
		$data["current_link"]   = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/risque/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete a risque

	public function delete() {
		CheckAdminLoginSession();
		$id=$this->uri->segment(4);
		$this->admin_model->dataDelete($this->risque,$id);
		$this->session->set_flashdata('message','Your risque has been deleted successfully');
        redirect('admin/risque/lists','refresh');
	}

// function to change status of risque
	public function status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->risque,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/risque/lists','refresh');		
	}

// function to get Branch By Company Id of risque

	public function getBranchByCompanyId() {
        $data    = '';
        $data    = 'class="control-group  " id="branch_by_company" ';
        $result  =  form_dropdown('branch_id', getBranchByCompanyId($this->input->post('company_id')),set_value('branch_id',!empty($this->input->get('branch_id'))?$this->input->get('branch_id'):'branch_id'),$data); 
        print_r($result);
        return $result;
	}
}
