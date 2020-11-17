<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {

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
		// print_r($this->session->all_userdata());
		// $language = $this->db->select("*")->from("tbl_language")->where("default","active")->get()->row();
		// $language_name = (!empty($language)) ? strtolower($language->name) : "english";
		// // if(strtolower($language->name) == "french")
		// $this->config->set_item('language',$language_name);
		// $this->lang->load('form_validation','french');
		// echo $lang("form_validation_required");
		// echo $this->lang->line('form_validation_required');
	}

	public $vehicle_type                    = 'tbl_vehicle_type';
	public $vehicle_make                    = 'tbl_vehicle_make';
	public $vehicle_model                   = 'tbl_vehicle_model';
	public $vehicle_permit                  = 'tbl_vehicle_permit';
	public $vehicle_warranty                = 'tbl_vehicle_warranty';
	public $vehicle_trans_person_insurance  = 'tbl_vehicle_trans_person_insurance';
	public $vehicle_fleet  					= 'tbl_vehicle_fleet';

	public $body_work                    = 'tbl_body_work';
	public $designation                  = 'tbl_vehicle_designation';
	public $category                     = 'tbl_category';
	public $usage                        = 'tbl_usage';
	public $usage_area                   = 'tbl_usage_area';
	public $optional_franchises          = 'tbl_optional_franchises';
	public $fuel_type                    = 'tbl_fuel_type';
	public $vehicle_detail               = 'tbl_vehicle_detail';
	public $vehicle_owner_detail         = 'tbl_vehicle_owner_detail';
	public $secondry_driver              = 'tbl_vehicle_secondry_driver';
	public $selected_optional_warranty   = 'tbl_selected_optional_warranty';
	public $selected_optional_franchise  = 'tbl_selected_optional_franchise';
	public $selected_bonus               = 'tbl_selected_bonus';
	public $selected_premium             = 'tbl_selected_premium';
	public $finalize_vehicle_insurance   = 'tbl_finalize_vehicle_insurance';

	public $selected_vehicle_trans_insurance  = 'tbl_selected_vehicle_trans_insurance';

	// function to get list of vehicles make
	public function vehicle_make() {
		CheckAdminLoginSession();
		$per_page               = 20;
        if($this->uri->segment(4)) {
        	$page               = ($this->uri->segment(4)) ;
        }
        else {
        	$page               = 1;
        }
      
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->vehicle_make);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->vehicle_make,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$url                    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL            = parse_url($url);
		$data["current_link"]   = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_make',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to add a vehicle make
	public function vehicle_make_add() {	
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
				'name'              => $this->input->post('name'),
				'description'       => $this->input->post('description'),
				'status'            => $this->input->post('status'),
				'created_date'      => date('Y-m-d H:i:s'),
				'modified_date'     => date('Y-m-d H:i:s')
				); 
				$id                = $this->admin_model->setInsertData($this->vehicle_make,$data);
				$this->session->set_flashdata('message','Your Vehicle Make has been added successfully');
		        redirect('admin/vehicle/vehicle-make','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_make_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit a vehicle make
	public function vehicle_make_edit() {
        $id             = $this->uri->segment(4);
        CheckAdminLoginSession();		
		$post_data      = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'name'          => $this->input->post('name'),
					'description'   => $this->input->post('description'),
					'status'        => $this->input->post('status'),
					'modified_date' => date('Y-m-d H:i:s')
				); 
				$id             = $this->admin_model->setUpdateData($this->vehicle_make,$data,$id);
				$this->session->set_flashdata('message','Your Vehicle Make has been edited successfully');
		        redirect('admin/vehicle/vehicle-make','refresh');
		    }
        }
        $data['dataCollection'] = $this->admin_model->getDataCollectionByID($this->vehicle_make,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_make_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to change the status of vehicle make
	public function vehicle_make_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status']           = $status;
		$data['modified_date']    = date('Y-m-d H:i:s');	 
		$this->admin_model->setUpdateData($this->vehicle_make,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/vehicle/vehicle-make','refresh');			
	}

	// function to delete vehicle make
	public function vehicle_make_delete() {
		CheckAdminLoginSession();
		$id          = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->vehicle_make,$id);
		$this->session->set_flashdata('message','Your Vehicle Make has been deleted successfully');
        redirect('admin/vehicle/vehicle-make','refresh');
	}


// function to get list of vehicles type
	public function vehicle_type() {
		CheckAdminLoginSession();
		$per_page               = 20;
        if($this->uri->segment(4)) {
        	$page               = ($this->uri->segment(4)) ;
        }
        else {
        	$page               = 1;
        }
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->vehicle_type);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->vehicle_type,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_type',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to add a vehicle type
	public function vehicle_type_add() {	
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[tbl_vehicle_type.name]');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			$this->form_validation->set_rules('usage_id', 'Usage', 'required|trim');				
			$this->form_validation->set_rules('tariff_code', 'Tariff Code', 'required|trim|is_unique[tbl_vehicle_type.tariff_code]');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'name'              => $this->input->post('name'),
					'description'       => $this->input->post('description'),
					'tariff_code'       => $this->input->post('tariff_code'),
					'usage_id'          => $this->input->post('usage_id'),
					'status'            => $this->input->post('status')
				); 
				$id                = $this->admin_model->setInsertData($this->vehicle_type,$data);
				$this->session->set_flashdata('message','Your Vehicle Type(Tariff) has been added successfully');
		        redirect('admin/vehicle/vehicle-type','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_type_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}	




// function to edit a vehicle type
	public function vehicle_type_edit() {
        $id             = $this->uri->segment(4);
        CheckAdminLoginSession();		
		$post_data      = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');			
			$this->form_validation->set_rules('usage_id', 'Usage', 'required|trim');			
			$this->form_validation->set_rules('tariff_code', 'Tariff Code', 'required|trim');	
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
				'name'              => $this->input->post('name'),
				'description'       => $this->input->post('description'),
				'usage_id'          => $this->input->post('usage_id'),
				'tariff_code'       => $this->input->post('tariff_code'),
				'status'            => $this->input->post('status')
				); 
				$id                = $this->admin_model->setUpdateData($this->vehicle_type,$data,$id);
				$this->session->set_flashdata('message','Your Vehicle Type(Tariff) has been edited successfully');
		        redirect('admin/vehicle/vehicle-type','refresh');
		    }
        }
        $data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->vehicle_type,$id);

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_type_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to change the status of vehicle type
	public function vehicle_type_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->vehicle_type,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/vehicle/vehicle-type','refresh');			
	}


// function to delete vehicle type
	public function vehicle_type_delete() {
		CheckAdminLoginSession();
		$id          = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->vehicle_type,$id);
		$this->session->set_flashdata('message','Your Vehicle Type has been deleted successfully');
        redirect('admin/vehicle/vehicle-type','refresh');
	}


// function to get list of vehicles model
	public function vehicle_model() {
		CheckAdminLoginSession();
		$per_page               = 20;
        if($this->uri->segment(4)) {
        	$page               = ($this->uri->segment(4)) ;
        }
        else {
        	$page               = 1;
        }
      
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->vehicle_model);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->vehicle_model,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$url                    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL            = parse_url($url);
		$data["current_link"]   = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_model',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to add a vehicle model
	public function vehicle_model_add() {	
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'name'              => $this->input->post('name'),
					'description'       => $this->input->post('description'),
					'status'            => $this->input->post('status'),
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
				); 
				$id                = $this->admin_model->setInsertData($this->vehicle_model,$data);
				$this->session->set_flashdata('message','Your Vehicle Model has been added successfully');
		        redirect('admin/vehicle/vehicle-model','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_model_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to edit a vehicle model
	public function vehicle_model_edit() {
        $id             = $this->uri->segment(4);
        CheckAdminLoginSession();		
		$post_data      = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
				'name'              => $this->input->post('name'),
				'description'       => $this->input->post('description'),
				'status'            => $this->input->post('status'),
				'modified_date'     => date('Y-m-d H:i:s')
				); 
				$id                = $this->admin_model->setUpdateData($this->vehicle_model,$data,$id);
				$this->session->set_flashdata('message','Your Vehicle Model has been edited successfully');
		        redirect('admin/vehicle/vehicle-model','refresh');
		    }
        }
        $data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->vehicle_model,$id);

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_model_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to change the status of vehicle make
	public function vehicle_model_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status']           = $status;
		$data['modified_date']    = date('Y-m-d H:i:s');				        	             		 
		$this->admin_model->setUpdateData($this->vehicle_model,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/vehicle/vehicle-model','refresh');			
	}


	// function to delete vehicle model
	public function vehicle_model_delete() {
		CheckAdminLoginSession();
		$id          = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->vehicle_model,$id);
		$this->session->set_flashdata('message','Your Vehicle Model has been deleted successfully');
        redirect('admin/vehicle/vehicle-model','refresh');
	}

// function to get list of vehicles permit
	public function vehicle_permit() {
		CheckAdminLoginSession();
		$per_page               = 20;
        if($this->uri->segment(4)) {
        	$page               = ($this->uri->segment(4)) ;
        }
        else {
        	$page               = 1;
        }
      
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->vehicle_permit);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->vehicle_permit,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_permit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to add a vehicle permit
	public function vehicle_permit_add() {	
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'name'              => $this->input->post('name'),
					'description'       => $this->input->post('description'),
					'status'            => $this->input->post('status'),
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
				); 
				
				$id                = $this->admin_model->setInsertData($this->vehicle_permit,$data);
				$this->session->set_flashdata('message','Your Vehicle permit has been added successfully');
		        redirect('admin/vehicle/vehicle-permit','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_permit_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to edit a vehicle permit
	public function vehicle_permit_edit() {
        $id             = $this->uri->segment(4);
        CheckAdminLoginSession();		
		$post_data      = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
				'name'              => $this->input->post('name'),
				'description'       => $this->input->post('description'),
				'status'            => $this->input->post('status'),
				'modified_date'     => date('Y-m-d H:i:s')
				); 

				$id                = $this->admin_model->setUpdateData($this->vehicle_permit,$data,$id);
				$this->session->set_flashdata('message','Your Vehicle permit has been edited successfully');
		        redirect('admin/vehicle/vehicle-permit','refresh');
		    }
        }
        $data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->vehicle_permit,$id);

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_permit_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to change the status of vehicle permit
	public function vehicle_permit_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status']           = $status;
		$data['modified_date']    = date('Y-m-d H:i:s');				        	             		 
		$this->admin_model->setUpdateData($this->vehicle_permit,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/vehicle/vehicle-permit','refresh');			
	}


	// function to delete vehicle permit
	public function vehicle_permit_delete() {
		CheckAdminLoginSession();
		$id          = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->vehicle_permit,$id);
		$this->session->set_flashdata('message','Your Vehicle permit has been deleted successfully');
        redirect('admin/vehicle/vehicle-permit','refresh');
	}

	// function to get list of vehicles permit
	public function vehicle_warranty() {
		CheckAdminLoginSession();
		$per_page               = 20;
        if($this->uri->segment(4)) {
        	$page               = ($this->uri->segment(4)) ;
        }
        else {
        	$page               = 1;
        }
      
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->vehicle_warranty);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->vehicle_warranty,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_warranty',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to add a vehicle permit
	public function vehicle_warranty_add() {	
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			$this->form_validation->set_rules('code', 'Code', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'name'              => $this->input->post('name'),
					'code'              => $this->input->post('code'),
					'description'       => $this->input->post('description'),
					'status'            => $this->input->post('status'),
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
				); 
				
				$id                = $this->admin_model->setInsertData($this->vehicle_warranty,$data);
				$this->session->set_flashdata('message','Your Vehicle warranty has been added successfully');
		        redirect('admin/vehicle/vehicle-warranty','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_warranty_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to edit a vehicle warranty
	public function vehicle_warranty_edit() {
        $id             = $this->uri->segment(4);
        CheckAdminLoginSession();		
		$post_data      = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');	
			$this->form_validation->set_rules('code', 'Code', 'required|trim');				
				
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
				'name'              => $this->input->post('name'),
				'code'              => $this->input->post('code'),
				'description'       => $this->input->post('description'),
				'status'            => $this->input->post('status'),
				'modified_date'     => date('Y-m-d H:i:s')
				); 

				$id                = $this->admin_model->setUpdateData($this->vehicle_warranty,$data,$id);
				$this->session->set_flashdata('message','Your Vehicle warranty has been edited successfully');
		        redirect('admin/vehicle/vehicle-warranty','refresh');
		    }
        }
        $data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->vehicle_warranty,$id);

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_warranty_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to change the status of vehicle warranty
	public function vehicle_warranty_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status']           = $status;
		$data['modified_date']    = date('Y-m-d H:i:s');				        	             		 
		$this->admin_model->setUpdateData($this->vehicle_warranty,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/vehicle/vehicle-warranty','refresh');			
	}


	// function to delete vehicle warranty
	public function vehicle_warranty_delete() {
		CheckAdminLoginSession();
		$id          = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->vehicle_warranty,$id);
		$this->session->set_flashdata('message','Your Vehicle warranty has been deleted successfully');
        redirect('admin/vehicle/vehicle-warranty','refresh');
	}

	// function to get list of vehicle bodywork
	public function body_work() {
		CheckAdminLoginSession();
		$per_page               = 20;
        if($this->uri->segment(4)) {
        	$page               = ($this->uri->segment(4)) ;
        }
        else {
        	$page               = 1;
        }
      
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->body_work);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->body_work,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/body_work',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	// function to add a vehicle bodywork
	public function body_work_add() {
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'name'              => $this->input->post('name'),
					'description'       => $this->input->post('description'),
					'status'            => $this->input->post('status'),
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
				); 
				
				$id                = $this->admin_model->setInsertData($this->body_work,$data);
				$this->session->set_flashdata('message','Your Vehicle Body Work has been added successfully');
		        redirect('admin/vehicle/bodywork','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/body_work_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to edit a vehicle bodywork
	public function body_work_edit() {
        $id             = $this->uri->segment(4);
        CheckAdminLoginSession();		
		$post_data      = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
				'name'              => $this->input->post('name'),
				'description'       => $this->input->post('description'),
				'status'            => $this->input->post('status'),
				'modified_date'     => date('Y-m-d H:i:s')
				); 

				$id                = $this->admin_model->setUpdateData($this->body_work,$data,$id);
				$this->session->set_flashdata('message','Your Vehicle bodywork has been edited successfully');
		        redirect('admin/vehicle/bodywork','refresh');
		    }
        }
        $data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->body_work,$id);

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/body_work_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to change the status of vehicle bodywork
	public function body_work_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status']           = $status;
		$data['modified_date']    = date('Y-m-d H:i:s');				        	             		 
		$this->admin_model->setUpdateData($this->body_work,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/vehicle/bodywork','refresh');			
	}


	// function to delete vehicle bodywork
	public function body_work_delete() {
		CheckAdminLoginSession();
		$id          = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->body_work,$id);
		$this->session->set_flashdata('message','Your Vehicle bodywork has been deleted successfully');
        redirect('admin/vehicle/bodywork','refresh');
	}

	// function to get list of vehicle designation
	public function designation() {
		CheckAdminLoginSession();
		$per_page               = 20;
        if($this->uri->segment(4)) {
        	$page               = ($this->uri->segment(4)) ;
        }
        else {
        	$page               = 1;
        }
      
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->designation);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->designation,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$url                    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL            = parse_url($url);
		$data["current_link"]   = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/designation',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	// function to add a vehicle designation
	public function designation_add() {
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('vehicle_make_id', 'Vehicle Make', 'required|trim');		
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'vehicle_make_id'              => $this->input->post('vehicle_make_id'),
					'name'              => $this->input->post('name'),
					'description'       => $this->input->post('description'),
					'status'            => $this->input->post('status'),
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
				); 
				
				$id                = $this->admin_model->setInsertData($this->designation,$data);
				$this->session->set_flashdata('message','Your Vehicle designation has been added successfully');
		        redirect('admin/vehicle/designation','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/designation_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to edit a vehicle designation
	public function designation_edit() {
        $id             = $this->uri->segment(4);
        CheckAdminLoginSession();		
		$post_data      = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('vehicle_make_id', 'Vehicle Make', 'required|trim');		
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
				'vehicle_make_id'   => $this->input->post('vehicle_make_id'),
				'name'              => $this->input->post('name'),
				'description'       => $this->input->post('description'),
				'status'            => $this->input->post('status'),
				'modified_date'     => date('Y-m-d H:i:s')
				); 

				$id                = $this->admin_model->setUpdateData($this->designation,$data,$id);
				$this->session->set_flashdata('message','Your Vehicle designation has been edited successfully');
		        redirect('admin/vehicle/designation','refresh');
		    }
        }
        $data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->designation,$id);

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/designation_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to change the status of vehicle designation
	public function designation_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status']           = $status;
		$data['modified_date']    = date('Y-m-d H:i:s');				        	             		 
		$this->admin_model->setUpdateData($this->designation,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/vehicle/designation','refresh');			
	}


	// function to delete vehicle designation
	public function designation_delete() {
		CheckAdminLoginSession();
		$id          = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->designation,$id);
		$this->session->set_flashdata('message','Your Vehicle designation has been deleted successfully');
        redirect('admin/vehicle/designation','refresh');
	}

	// function to get list of vehicle category
	public function category() {
		CheckAdminLoginSession();
		$per_page               = 20;
        if($this->uri->segment(4)) {
        	$page               = ($this->uri->segment(4)) ;
        }
        else {
        	$page               = 1;
        }
      
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->category);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->category,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/category',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	// function to add a vehicle category
	public function category_add() {
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'name'              => $this->input->post('name'),
					'description'       => $this->input->post('description'),
					'status'            => $this->input->post('status'),
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
				); 
				
				$id                = $this->admin_model->setInsertData($this->category,$data);
				$this->session->set_flashdata('message','Your Vehicle category has been added successfully');
		        redirect('admin/vehicle/category','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/category_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to edit a vehicle category
	public function category_edit() {
        $id             = $this->uri->segment(4);
        CheckAdminLoginSession();		
		$post_data      = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
				'name'              => $this->input->post('name'),
				'description'       => $this->input->post('description'),
				'status'            => $this->input->post('status'),
				'modified_date'     => date('Y-m-d H:i:s')
				); 

				$id                = $this->admin_model->setUpdateData($this->category,$data,$id);
				$this->session->set_flashdata('message','Your Vehicle category has been edited successfully');
		        redirect('admin/vehicle/category','refresh');
		    }
        }
        $data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->category,$id);

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/category_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to change the status of vehicle category
	public function category_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status']           = $status;
		$data['modified_date']    = date('Y-m-d H:i:s');				        	             		 
		$this->admin_model->setUpdateData($this->category,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/vehicle/category','refresh');			
	}


	// function to delete vehicle category
	public function category_delete() {
		CheckAdminLoginSession();
		$id          = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->category,$id);
		$this->session->set_flashdata('message','Your Vehicle category has been deleted successfully');
        redirect('admin/vehicle/category','refresh');
	}	

	// function to get list of vehicle usage
	public function usage() {

		CheckAdminLoginSession();
		$per_page               = 20;
        if($this->uri->segment(4)) {
        	$page               = ($this->uri->segment(4)) ;
        }
        else {
        	$page               = 1;
        }
      
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->usage);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->usage,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/usage',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	// function to add a vehicle usage
	public function usage_add() {
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'name'              => $this->input->post('name'),
					'description'       => $this->input->post('description'),
					'code'              => $this->input->post('code'),
					'status'            => $this->input->post('status'),
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
				); 
				
				$id                = $this->admin_model->setInsertData($this->usage,$data);
				$this->session->set_flashdata('message','Your Vehicle usage has been added successfully');
		        redirect('admin/vehicle/usage','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/usage_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to edit a vehicle usage
	public function usage_edit() {
        $id             = $this->uri->segment(4);
        CheckAdminLoginSession();		
		$post_data      = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
				'name'              => $this->input->post('name'),
				'code'              => $this->input->post('code'),
				'description'       => $this->input->post('description'),
				'status'            => $this->input->post('status'),
				'modified_date'     => date('Y-m-d H:i:s')
				); 

				$id                = $this->admin_model->setUpdateData($this->usage,$data,$id);
				$this->session->set_flashdata('message','Your Vehicle usage has been edited successfully');
		        redirect('admin/vehicle/usage','refresh');
		    }
        }
        $data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->usage,$id);

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/usage_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to change the status of vehicle usage
	public function usage_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status']           = $status;
		$data['modified_date']    = date('Y-m-d H:i:s');				        	             		 
		$this->admin_model->setUpdateData($this->usage,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/vehicle/usage','refresh');			
	}


	// function to delete vehicle usage
	public function usage_delete() {
		CheckAdminLoginSession();
		$id          = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->usage,$id);
		$this->session->set_flashdata('message','Your Vehicle usage has been deleted successfully');
        redirect('admin/vehicle/usage','refresh');
	}

	// function to get list of vehicle usage_area
	public function usage_area() {

		CheckAdminLoginSession();
		$per_page               = 20;
        if($this->uri->segment(4)) {
        	$page               = ($this->uri->segment(4)) ;
        }
        else {
        	$page               = 1;
        }
      
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->usage_area);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->usage_area,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/usage_area',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	// function to add a vehicle usage_area
	public function usage_area_add() {
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'name'              => $this->input->post('name'),
					'description'       => $this->input->post('description'),
					'status'            => $this->input->post('status'),
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
				); 
				
				$id                = $this->admin_model->setInsertData($this->usage_area,$data);
				$this->session->set_flashdata('message','Your Vehicle usage area has been added successfully');
		        redirect('admin/vehicle/usage-area','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/usage_area_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to edit a vehicle usage area
	public function usage_area_edit() {
        $id             = $this->uri->segment(4);
        CheckAdminLoginSession();		
		$post_data      = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
			$this->form_validation->set_rules('description', 'Description', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
				'name'              => $this->input->post('name'),
				'description'       => $this->input->post('description'),
				'status'            => $this->input->post('status'),
				'modified_date'     => date('Y-m-d H:i:s')
				); 

				$id                = $this->admin_model->setUpdateData($this->usage_area,$data,$id);
				$this->session->set_flashdata('message','Your Vehicle usage area has been edited successfully');
		        redirect('admin/vehicle/usage-area','refresh');
		    }
        }
        $data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->usage_area,$id);

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/usage_area_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to change the status of vehicle usage area
	public function usage_area_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status']           = $status;
		$data['modified_date']    = date('Y-m-d H:i:s');				        	             		 
		$this->admin_model->setUpdateData($this->usage_area,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/vehicle/usage-area','refresh');			
	}


	// function to delete vehicle usage area
	public function usage_area_delete() {
		CheckAdminLoginSession();
		$id          = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->usage_area,$id);
		$this->session->set_flashdata('message','Your Vehicle usage area area has been deleted successfully');
        redirect('admin/vehicle/usage-area','refresh');
	}

	// function to get the transported Person Option 
	public function transported_person() {
		CheckAdminLoginSession();
		$per_page               = 20;
        if($this->uri->segment(4)) {
        	$page               = ($this->uri->segment(4)) ;
        }
        else {
        	$page               = 1;
        }
      
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->vehicle_trans_person_insurance);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->vehicle_trans_person_insurance,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$url                    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL            = parse_url($url);
		$data["current_link"]   = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/transported_person',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}	

	// function to add the transported  Person Option 
	public function transported_person_add() {
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('title', 'Name', 'required|trim');		
			$this->form_validation->set_rules('amount_to_pay', 'Description', 'required|trim');				
			$this->form_validation->set_rules('company_id', 'Company ', 'required|trim');				
			$this->form_validation->set_rules('death', 'Death', 'required|trim');				
			$this->form_validation->set_rules('disability', 'Disability', 'required|trim');				
			$this->form_validation->set_rules('medical_fees', 'Medical Fees', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'title'              => $this->input->post('title'),
					'company_id'         => $this->input->post('company_id'),
					'amount_to_pay'      => $this->input->post('amount_to_pay'),
					'death'              => $this->input->post('death'),
					'disability'         => $this->input->post('disability'),
					'medical_fees'       => $this->input->post('medical_fees'),
					'status'             => $this->input->post('status'),
					'created_date'       => date('Y-m-d H:i:s'),
					'modified_date'      => date('Y-m-d H:i:s')
				); 
				
				$id                = $this->admin_model->setInsertData($this->vehicle_trans_person_insurance,$data);
				$this->session->set_flashdata('message','Your Vehicle Transported Person Insurance has been added successfully');
		        redirect('admin/vehicle/transported-person','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/transported_person_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}	

	// function to add the transported  Person Option 
	public function transported_person_edit() {
    	CheckAdminLoginSession();		
        $id             = $this->uri->segment(4);

		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('title', 'Name', 'required|trim');		
			$this->form_validation->set_rules('amount_to_pay', 'Description', 'required|trim');	
			$this->form_validation->set_rules('company_id', 'Company ', 'required|trim');		
			$this->form_validation->set_rules('death', 'Death', 'required|trim');				
			$this->form_validation->set_rules('disability', 'Disability', 'required|trim');
			$this->form_validation->set_rules('medical_fees', 'Medical Fees', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'title'              => $this->input->post('title'),
					'amount_to_pay'      => $this->input->post('amount_to_pay'),
					'company_id'         => $this->input->post('company_id'),
					'death'              => $this->input->post('death'),
					'disability'         => $this->input->post('disability'),
					'medical_fees'       => $this->input->post('medical_fees'),
					'status'             => $this->input->post('status'),
					'created_date'       => date('Y-m-d H:i:s'),
					'modified_date'      => date('Y-m-d H:i:s')
				); 
				$id                = $this->admin_model->setUpdateData($this->vehicle_trans_person_insurance,$data,$id);
				$this->session->set_flashdata('message','Your Vehicle Transported Person Insurance has been updated successfully');
		        redirect('admin/vehicle/transported-person','refresh');
		    }
        }
        $data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->vehicle_trans_person_insurance,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/transported_person_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function to change the status of vehicle transported person insurance
	public function transported_person_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status']           = $status;
		$data['modified_date']    = date('Y-m-d H:i:s');				        	             		 
		$this->admin_model->setUpdateData($this->vehicle_trans_person_insurance,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/vehicle/transported-person','refresh');			
	}


	// function to delete vehicle transported person insurance
	public function transported_person_delete() {
		CheckAdminLoginSession();
		$id          = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->vehicle_trans_person_insurance,$id);
		$this->session->set_flashdata('message','Your Vehicle Person Insurance has been deleted successfully');
        redirect('admin/vehicle/transported-person','refresh');
	}


	// function to get the vehicle optional franchises 
	public function optional_franchises() {
		CheckAdminLoginSession();
		$per_page               = 20;
        if($this->uri->segment(4)) {
        	$page               = ($this->uri->segment(4)) ;
        }
        else {
        	$page               = 1;
        }
      
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->optional_franchises);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->optional_franchises,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/optional_franchises',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}	

	// function to add the transported  Person Option 
	public function optional_franchises_add() {
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('title', 'Name', 'required|trim');		
			$this->form_validation->set_rules('deductible', 'Deductible', 'required|trim');				
			$this->form_validation->set_rules('rate', 'Rate', 'required|trim');				
					
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');				
			$this->form_validation->set_rules('referent_value', 'Referent Value', 'required|trim');				
			$this->form_validation->set_rules('minimum', 'Minimum', 'required|trim');				
			$this->form_validation->set_rules('maximum', 'Maximum', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'title'              => $this->input->post('title'),
					'deductible'         => $this->input->post('deductible'),
					'rate'               => $this->input->post('rate'),
		
					'amount'             => $this->input->post('amount'),
					'referent_value'     => $this->input->post('referent_value'),
					'minimum'            => $this->input->post('minimum'),
					'maximum'            => $this->input->post('maximum'),
					'status'             => $this->input->post('status'),
					'created_date'       => date('Y-m-d H:i:s'),
					'modified_date'      => date('Y-m-d H:i:s')
				); 

				$id                = $this->admin_model->setInsertData($this->optional_franchises,$data);
				$this->session->set_flashdata('message','Your Vehicle Optional Franchise has been added successfully');
		        redirect('admin/vehicle/optional-franchise','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/optional_franchises_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}	

	// function to edit the vehicle optional franchises 
	public function optional_franchises_edit() {
    	CheckAdminLoginSession();		
        $id             = $this->uri->segment(4);

		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('title', 'Name', 'required|trim');		
			$this->form_validation->set_rules('deductible', 'Deductible', 'required|trim');		
			$this->form_validation->set_rules('rate', 'Rate', 'required|trim');				
			$this->form_validation->set_rules('disability', 'Disability', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');				
			$this->form_validation->set_rules('referent_value', 'Referent Value', 'required|trim');				
			$this->form_validation->set_rules('minimum', 'Minimum', 'required|trim');
			$this->form_validation->set_rules('maximum', 'Maximum', 'required|trim');					
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'title'              => $this->input->post('title'),
					'deductible'         => $this->input->post('deductible'),
					'rate'               => $this->input->post('rate'),
					'disability'         => $this->input->post('disability'),
					'amount'             => $this->input->post('amount'),
					'referent_value'     => $this->input->post('referent_value'),
					'minimum'            => $this->input->post('minimum'),
					'maximum'            => $this->input->post('maximum'),
					'status'             => $this->input->post('status'),
					'created_date'       => date('Y-m-d H:i:s'),
					'modified_date'      => date('Y-m-d H:i:s')
				); 
				$id                = $this->admin_model->setUpdateData($this->optional_franchises,$data,$id);
				$this->session->set_flashdata('message','Your Vehicle Optional franchises has been updated successfully');
		        redirect('admin/vehicle/optional-franchise','refresh');
		    }
        }
        $data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->optional_franchises,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/optional_franchises_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function to change the status of vehicle transported person insurance
	public function optional_franchises_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);

		CheckAdminLoginSession();		
		$data['status']           = $status;
		$data['modified_date']    = date('Y-m-d H:i:s');				        	             		 

		$this->admin_model->setUpdateData($this->optional_franchises,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/vehicle/optional-franchise','refresh');			
	}


	// function to delete vehicle transported person insurance
	public function optional_franchises_delete() {
		CheckAdminLoginSession();
		$id          = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->optional_franchises,$id);
		$this->session->set_flashdata('message','Your Vehicle Person Insurance has been deleted successfully');
        redirect('admin/vehicle/optional-franchise','refresh');
	}

	// function to get the list of fuel type
	public function fuel_type() {
		CheckAdminLoginSession();
		$per_page               = 20;
        if($this->uri->segment(4)) {
        	$page               = ($this->uri->segment(4)) ;
        }
        else {
        	$page               = 1;
        }
      
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->fuel_type);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->fuel_type,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/fuel_type',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	// function to add the fuel type
	public function fuel_type_add() {
    CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');		
						
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'name'               => $this->input->post('name'),
					'description'        => $this->input->post('description'),
					'status'             => $this->input->post('status'),
					'created_date'       => date('Y-m-d H:i:s'),
					'modified_date'      => date('Y-m-d H:i:s')
				); 

				$id                = $this->admin_model->setInsertData($this->fuel_type,$data);
				$this->session->set_flashdata('message','Your Vehicle Fuel Type has been added successfully');
		        redirect('admin/vehicle/fuel-type','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/fuel_type_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	// function to edit the fuel type
	public function fuel_type_edit() {
    	CheckAdminLoginSession();		
        $id             = $this->uri->segment(4);

		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');					
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'name'               => $this->input->post('name'),
					'description'        => $this->input->post('description'),
					'status'             => $this->input->post('status'),
					'modified_date'      => date('Y-m-d H:i:s')
				); 
				$id                = $this->admin_model->setUpdateData($this->fuel_type,$data,$id);
				$this->session->set_flashdata('message','Your Fuel Type has been updated successfully');
		        redirect('admin/vehicle/fuel-type','refresh');
		    }
        }

        $data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->fuel_type,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/fuel_type_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');

	}


// function to change the status of fuel type
	public function fuel_type_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);

		CheckAdminLoginSession();		
		$data['status']           = $status;
		$data['modified_date']    = date('Y-m-d H:i:s');				        	             		 

		$this->admin_model->setUpdateData($this->fuel_type,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/vehicle/fuel-type','refresh');			
	}


	// function to delete fuel type
	public function fuel_type_delete() {
		CheckAdminLoginSession();
		$id          = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->fuel_type,$id);
		$this->session->set_flashdata('message','Your Fuel Type has been deleted successfully');
        redirect('admin/vehicle/fuel-type','refresh');
	}

	public function get_company_quote_for_vehicle() {
		CheckAdminLoginSession();
		$data = '';
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('make_id', 'Make/Brand', 'required|trim');	
			$this->form_validation->set_rules('usage', 'Usage', 'required|trim');	
			$this->form_validation->set_rules('designation', 'Designation', 'required|trim');	
			$this->form_validation->set_rules('registeration_date', 'Registeration Date', 'required|trim');	
			$this->form_validation->set_rules('seats', 'Seats', 'required|trim');	

			$this->form_validation->set_rules('fuel_type', 'Fuel Type', 'required|trim');	
			$this->form_validation->set_rules('horse_power', 'Horse Power', 'required|trim');	
			$this->form_validation->set_rules('fiscal_power', 'Fiscal Power', 'required|trim');	
			$this->form_validation->set_rules('risque', 'Risque', 'required|trim');	
			$this->form_validation->set_rules('seats', 'Seats', 'required|numeric|trim');	
			$this->form_validation->set_rules('fuel_type', 'Fuel Type', 'required|trim');
			if($this->form_validation->run() == FALSE) {  
				$this->load->view('admin/include/head');
				$this->load->view('admin/include/header');
				$this->load->view('admin/include/sidebar');
				$this->load->view('admin/vehicle/company_quote_vehicle',$data);
				$this->load->view('admin/include/footer');
				$this->load->view('admin/include/foot');	 
			} 
			else {
				$data                = array(									
					'fuel_type'      => $this->input->post('fuel_type'),
					'fiscal_power'   => $this->input->post('fiscal_power'),
					'usage'          => $this->input->post('usage'),
					'trailer'        => $this->input->post('trailer'),
					'risque'         => $this->input->post('risque'),
					'seats'          => $this->input->post('seats'),
					'make_id'        => $this->input->post('make_id'),
					'designation'    => $this->input->post('designation'),
					'horse_power'    => $this->input->post('horse_power'),
					'register_date'  => $this->input->post('registeration_date'),
					'immatriclulation' => $this->input->post('immatriclulation')
				); 
				$result              = $this->admin_model->getCompanyQuote($data,'tbl_company_vehicle_quote');
				if (count($result)>0) {
					$id              = $this->admin_model->setInsertData('tbl_vehicle_basic_info',$data);
					$this->vehicle_company_insurance($result,$id);
				}
				else {
					$this->session->set_flashdata('message','No records Available');
					redirect('admin/vehicle/vehicle-company-quote', 'refresh'); 
				}
	    	}
        }
        else {
			$this->load->view('admin/include/head');
			$this->load->view('admin/include/header');
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/vehicle/company_quote_vehicle',$data);
			$this->load->view('admin/include/footer');
			$this->load->view('admin/include/foot');		
        }
	}

// function to get the vehicle company insurance
	function vehicle_company_insurance($result,$id) {
		$data['dataCollection']        = $result;
		$data['vehicle_basic_info_id'] = $id;
		$data['vehicle_basic_info']    = $this->admin_model->getDataCollectionByID('tbl_vehicle_basic_info',$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_company_list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to get the vehicle details
	function vehicle_details() {
		$post_data = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('user_id','Name','required');	
			$this->form_validation->set_rules('registeration_number', 'Registeration Number', 'required|trim');
			$this->form_validation->set_rules('catalogue_value', 'Value', 'required|trim');					
			$this->form_validation->set_rules('vehicle_identification', 'Identification Number', 'required|trim');
			// $this->form_validation->set_rules('date_release_certificate', 'Date Release', 'required|trim');			
			// $this->form_validation->set_rules('engine_displacement', 'Engine Displacement', 'required|trim');					
			// $this->form_validation->set_rules('vehicle_category', 'Vehicle Category', 'required|trim');					
			// $this->form_validation->set_rules('chasis_number', 'Chasis Number', 'required|trim');					
			// $this->form_validation->set_rules('authroise_weight', 'Authroise Weight ', 'required|trim');					
			// $this->form_validation->set_rules('vehicle_type', 'Vehicle Type ', 'required|trim');					
			// $this->form_validation->set_rules('gear_box', 'Gear Box ', 'required|trim');					
			// $this->form_validation->set_rules('tax_bonus', 'Tax Bonus ', 'required|trim');					
			$this->form_validation->set_rules('registeration_date', 'Registeration Date ', 'required|trim');					
			$this->form_validation->set_rules('immatriclulation', 'Immatriclulation ', 'required|trim');					
			$this->form_validation->set_rules('current_value', 'Current Value ', 'required|trim');					
			$this->form_validation->set_rules('previous_register_date', 'Previous Register Date ', 'required|trim');					
			// $this->form_validation->set_rules('date_first_release', 'Date First Release ', 'required|trim');					
			// $this->form_validation->set_rules('engine_number', 'Engine Number ', 'required|trim');					
			$this->form_validation->set_rules('usage', 'Usage ', 'required|trim');					
			// $this->form_validation->set_rules('body_work', 'Body Work ', 'required|trim');					
			// $this->form_validation->set_rules('load_weight', 'Load Weight ', 'required|trim');					
			// $this->form_validation->set_rules('tariff_code', 'Tariff Code ', 'required|trim');					
			// $this->form_validation->set_rules('seating_capacity', 'Seating Capacity ', 'required|trim');					
			if($this->form_validation->run() == FALSE) {   } else {

				$data        = array(	
					'user_id'                            => $this->input->post('user_id'),
					'vehicle_basic_info_id'              => $this->input->post('vehicle_basic_info_id'),
					'registeration_number'               => $this->input->post('registeration_number'),
					'risque_id'                          => $this->input->post('risque_id'),
					'insurance_registeration_date'       => $this->input->post('insurance_registeration_date'),
					'tvv'                                => $this->input->post('tvv'),
					'company_vehicle_quote_id'           => $this->input->post('company_vehicle_quote_id'),
					'catalogue_value'                    => $this->input->post('catalogue_value'),
					'vehicle_identification'             => $this->input->post('vehicle_identification'),
					'date_release_certificate'           => $this->input->post('date_release_certificate'),
					'engine_displacement'                => $this->input->post('engine_displacement'),
					'vehicle_category'                   => $this->input->post('vehicle_category'),
					'chasis_number'                      => $this->input->post('chasis_number'),
					'authroise_weight'                   => $this->input->post('authroise_weight'),
					'vehicle_type'                       => $this->input->post('vehicle_type'),
					'gear_box'                           => $this->input->post('gear_box'),
					'tax_bonus'                          => $this->input->post('tax_bonus'),
					'registeration_date'                 => $this->input->post('registeration_date'),
					'immatriclulation'                   => $this->input->post('immatriclulation'),
					'current_value'                      => $this->input->post('current_value'),
					'previous_register_date'             => $this->input->post('previous_register_date'),
					'date_first_release'                 => $this->input->post('date_first_release'),
					'engine_number'                      => $this->input->post('engine_number'),
					'usage'                              => $this->input->post('usage'),
					'body_work'                          => $this->input->post('body_work'),
					'load_weight'                        => $this->input->post('load_weight'),
					'tariff_code'                        => $this->input->post('tariff_code'),
					'seating_capacity'                   => $this->input->post('seating_capacity'),
					'modified_date'                      => date('Y-m-d H:i:s')
				); 
				
				$id                = $this->admin_model->setInsertData($this->vehicle_detail,$data);
				$this->session->set_flashdata('message','Your Vehicle Details has been added');
		        redirect('admin/vehicle/owner-detail/'.$id,'refresh');
		    }
		}	
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_details');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to save the owner detail
	function owner_detail() {
		CheckAdminLoginSession();
		$vehicle_detail_id = $this->uri->segment(4);
		//$data = '';
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('user_id', 'Name', 'required|trim');	
			$this->form_validation->set_rules('address', 'Address', 'required|trim');
			$this->form_validation->set_rules('region_id', 'Region', 'required|trim');
			$this->form_validation->set_rules('department_id', 'Department', 'required|trim');
			$this->form_validation->set_rules('commune_id', 'Commune', 'required|trim');
			if($this->form_validation->run() == FALSE) {  } else {
				// echo "string";
				$data = array(
				'vehicle_detail_id' => $vehicle_detail_id,
				'owner'             => $this->input->post('owner'),
				'user_id'           => $this->input->post('user_id'),
				'address'           => $this->input->post('address'),
				'region_id'         => $this->input->post('region_id'),
				'department_id'     => $this->input->post('department_id'),
				'commune_id'        => $this->input->post('commune_id'),
				'created_date'      => date('Y-m-d H:i:s'),
				'modified_date'     => date('Y-m-d H:i:s')
				);
				$id                = $this->admin_model->setInsertData($this->vehicle_owner_detail,$data);
				$this->session->set_flashdata('message','Your Vehicle Owner Details has been added');
		        redirect('admin/vehicle/secondary-driver/'.$vehicle_detail_id,'refresh');
				// die();
			}
		}
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/owner_detail');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');	
	}


// function to save the owner detail
	function secondary_driver() {
		CheckAdminLoginSession();
		$vehicle_detail_id = $this->uri->segment(4);
		$data['vehicle_detail_id']   = $vehicle_detail_id;
		// $data = '';
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('owner', 'owner', 'required|trim');	
			$this->form_validation->set_rules('name', 'Name', 'required|trim');	
			$this->form_validation->set_rules('issue_date_license', 'Name', 'required|trim');
			$this->form_validation->set_rules('year_license_expire', 'Years for license expire', 'required|trim');
			$this->form_validation->set_rules('license_number', 'License Number', 'required|trim');
			$this->form_validation->set_rules('permit_id', 'Permit Id', 'required|trim');
			if($this->form_validation->run() == FALSE) {  } else {
				// echo "string";
				$data = array(
				'vehicle_detail_id'       => $vehicle_detail_id,
				'owner'                   => $this->input->post('owner'),
				'name'                    => $this->input->post('name'),
				'issue_date_license'      => $this->input->post('issue_date_license'),
				'year_license_expire'     => $this->input->post('year_license_expire'),
				'license_number'          => $this->input->post('license_number'),
				'permit_id'               => $this->input->post('permit_id'),
				'double_command'          => $this->input->post('double_command'),
				'created_date'            => date('Y-m-d H:i:s'),
				'modified_date'           => date('Y-m-d H:i:s')
				);
				$id                = $this->admin_model->setInsertData($this->secondry_driver,$data);
				$this->session->set_flashdata('message','Your Vehicle Secondary Details has been added');
		        redirect('admin/vehicle/optional-warranties/'.$vehicle_detail_id,'refresh');
				// die();
			}
		}
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/secondry_driver',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');	
	}


//function to add the optional warranties for the selected vehicle
	function optional_warranties() {
		CheckAdminLoginSession();
		$vehicle_detail_id = $this->uri->segment(4);
		$branch_id         = getBranchIdByName();
		$company_id        = getCompanyIdByVehicleDetailId($vehicle_detail_id);
		$risque_id         = getRisqueIdByVehicleDetailId($vehicle_detail_id);
		// $data              = '';
		$post_data         = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected', 'Optional warranty', 'required|trim');	

			if($this->form_validation->run() == FALSE) {  } else {
				// echo "string";
				$value_selected = explode(',', $this->input->post('value_selected'));
				foreach ($value_selected as $value) {
					$data = array(
					'optional_warranty_id'    => $value,
					'vehicle_detail_id'       => $vehicle_detail_id,
					'created_date'            => date('Y-m-d H:i:s'),
					'modified_date'           => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_warranty,$data);
				}
				$this->session->set_flashdata('message','Your Vehicle Optional Warranty has been added.');
		        redirect('admin/vehicle/select-optional-franchises/'.$vehicle_detail_id,'refresh');
				// die();
			}
		}
		$data['optional_warranties'] = $this->admin_model->getOptionalWarranties($company_id,$branch_id,$risque_id);
		//print_r($data['optional_warranties']);
		$data['vehicle_detail_id']   = $vehicle_detail_id;
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/optional_warranties',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

//function to add the optional franchise for the selected vehicle
	function select_optional_franchises() {
		CheckAdminLoginSession();
		$vehicle_detail_id = $this->uri->segment(4);
		$branch_id         = getBranchIdByName();
		$company_id        = getCompanyIdByVehicleDetailId($vehicle_detail_id);
		// $data              = '';
		$post_data         = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_franchise', 'Optional Franchise', 'required|trim');	

			if($this->form_validation->run() == FALSE) {  } else {
				// echo "string";
				$value_selected_franchise = explode(',', $this->input->post('value_selected_franchise'));
				foreach ($value_selected_franchise as $value) {
					$data = array(
					'optional_franchise_id'   => $value,
					'vehicle_detail_id'       => $vehicle_detail_id,
					'created_date'            => date('Y-m-d H:i:s'),
					'modified_date'           => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_franchise,$data);
				}
				$this->session->set_flashdata('message','Your Vehicle Optional Franchise has been added.');
		        redirect('admin/vehicle/transported-person-insurance/'.$vehicle_detail_id,'refresh');
			}
		}
		$data['optional_franchies'] = $this->admin_model->getOptionalFranchices($company_id,$branch_id);
		$data['vehicle_detail_id']   = $vehicle_detail_id;
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/select_optional_franchises',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to select the transported person insurance
	function select_transported_person_insurance() {
		CheckAdminLoginSession();
		$vehicle_detail_id = $this->uri->segment(4);
		$branch_id         = getBranchIdByName();
		$company_id        = getCompanyIdByVehicleDetailId($vehicle_detail_id);
		// $data              = '';
		$post_data         = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_travel_insure', 'Option', 'required|trim');	

			if($this->form_validation->run() == FALSE) {  } else {
					$data = array(
					'vehicle_trans_person_insurance_id'   => $this->input->post('value_selected_travel_insure'),
					'vehicle_detail_id'       => $vehicle_detail_id,
					'created_date'            => date('Y-m-d H:i:s'),
					'modified_date'           => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_vehicle_trans_insurance,$data);
				$this->session->set_flashdata('message','Your option for Vehicle Transported person has been added.');
		        redirect('admin/vehicle/bounus-reduction/'.$vehicle_detail_id,'refresh');
			}
		}
		$data['options']     = $this->admin_model->getInsuredTravelOptions($company_id);
		$data['vehicle_detail_id']   = $vehicle_detail_id;
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/select_transported_person_insurance',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to add the bonus or reductions
	function bounus_reduction() {
		CheckAdminLoginSession();
		$vehicle_detail_id  = $this->uri->segment(4);
		$branch_id          = getBranchIdByName();
		// print_r($branch_id);
		$company_id         = getCompanyIdByVehicleDetailId($vehicle_detail_id);
		// $data               = '';
		$post_data          = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_bounus_option', 'Option', 'required|trim');	

			if($this->form_validation->run() == FALSE) {  } else {
					$data = array(
					'value_selected_bounus_option' => $this->input->post('value_selected_bounus_option'),
					'vehicle_detail_id' => $vehicle_detail_id,
					'company_id'        => $company_id,
					'branch_id'         => $branch_id,
					'approved_status'   => 0,
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
					);
					// print_r($data);
					$id                = $this->admin_model->setInsertData($this->selected_bonus,$data);
				if($_FILES["image"]["name"] != "") {
					$image             = do_upload_images('bonus_documents','image');
					$data_featured_img = array('document_image' => $image );
					$this->admin_model->setUpdateData($this->selected_bonus,$data_featured_img,$id);
				}
				// new code added by Sushant on 09-12-2019
				if($this->input->post("fleet_option") == '1')
				{
					$data2 = array(
						'fleet_option'  		  => $this->input->post('fleet_option'),
						'fleet_percentage' 		  => $this->input->post('fleet_percentage'),
						'vehicle_detail_id'       => $vehicle_detail_id,
						'created_date'            => date('Y-m-d H:i:s'),
						'modified_date'           => date('Y-m-d H:i:s')
						);
					$this->admin_model->setInsertData($this->vehicle_fleet,$data2);
				}
				$this->session->set_flashdata('message','Your option for Bonus Has been recorded. It will be effected once admin will approve it.For futher details please contact to admin.');
		        redirect('admin/vehicle/premium-duration/'.$vehicle_detail_id,'refresh');
			}
		}
		$data['discount_year']       = getDiscountAndYear($company_id,$branch_id);
		$data['vehicle_detail_id']   = $vehicle_detail_id;
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/bounus_reduction',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to add the premium duration
	public function premium_duration() {
		CheckAdminLoginSession();
		$vehicle_detail_id  = $this->uri->segment(4);
		$branch_id          = getBranchIdByName();
		$company_id         = getCompanyIdByVehicleDetailId($vehicle_detail_id);
		// $data               = '';
		$post_data          = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('from', 'From', 'required|trim');	
			$this->form_validation->set_rules('to', 'To', 'required|trim');	

			if($this->form_validation->run() == FALSE) {  } else {
				$from          = new DateTime($this->input->post('from'));
				$to            = new DateTime($this->input->post('to'));
				$days          = $to->diff($from)->format("%a");

				$premium_id = $this->admin_model->getPremiumIdByDays($days,$company_id);
				if (!empty($premium_id)) {
					$data = array(
						'from_'            => date_format(date_create($this->input->post('from')),"Y-m-d H:i:s"),
						'to_'               => date_format(date_create($this->input->post('to')),"Y-m-d H:i:s"),
						'vehicle_detail_id' => $vehicle_detail_id,
						'premium_id'        => $premium_id,
						'tacit_policy'    => $this->input->post('tacit_policy'),
						'created_date'    => date('Y-m-d H:i:s'),
						'modified_date'   => date('Y-m-d H:i:s')
					);
					$id       = $this->admin_model->setInsertData($this->selected_premium,$data);
					$this->session->set_flashdata('message','Your record has been saved successfully.');
					redirect('admin/vehicle/get-all-selected-options/'.$vehicle_detail_id,'refresh');
				}
				else {
					$this->session->set_flashdata('message','Please select the valid date. As the record for selected date does not exists.');
				}	
			}
		}
		$data = '';
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/premium_duration',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}	

	public function get_all_selected_options() {
		CheckAdminLoginSession();
		$vehicle_detail_id                 = $this->uri->segment(4);
		$data['vehicle_detail_id']         = $this->uri->segment(4);
		$data['company_id']                = getCompanyIdByCompanyVehicleQuoteId(getCompanyVehicleQuoteId($vehicle_detail_id));
		$data['selected_warranty_name_id'] = $this->admin_model->getWarrantiesSelected($vehicle_detail_id);
		$data['selected_francise_name_id'] = $this->admin_model->getFranchisesSelected($vehicle_detail_id);
		$data['selected_transported_person_insurance_id'] = $this->admin_model->getTransportedPersonSelected($vehicle_detail_id);
		$post_data       = $this->input->post();     

		if(empty($this->input->post('company_id'))) {
			$data['companies_id'] = explode(',', $data['company_id']);
		}
		else {
			$data['companies_id'] = $this->input->post('company_id');
		}
		$data['qwerty']       = getSelectedDatRecordsForSelectedCompany($data['selected_warranty_name_id'],$data['companies_id'],$data['selected_francise_name_id'],$data['selected_transported_person_insurance_id'],$vehicle_detail_id);
			

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/can_save_more',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to save the final details and the company
	function finalize_company(){
		$warranty           = $this->input->post('warranty');
		$franchise          = $this->input->post('franchise');
		$company_id         = $this->input->post('company_id');
		$vehicle_detail_id  = $this->input->post('vehicle_id');
		$total_estimation   = $this->input->post('total_estimation');
		$user_id 					     = getUserIdFromInsuranceDetails($vehicle_detail_id,$this->vehicle_detail);

		$final_data         = getFinalForSelectedCompany( explode(',', $franchise),explode(',', $warranty) ,explode(',', $company_id),$vehicle_detail_id);
		foreach ($final_data as $value) {
			$data = array(
				'value'             => $value['value'],
				'type'              => $value['type'],
				'name'              => $value['name'],
				'company_id'		=> $value['company_id'],
				'company_name'      => $value['company_name'],
				'vehicle_detail_id' => $value['vehicle_detail_id']
			);
			$this->admin_model->setInsertData($this->finalize_vehicle_insurance,$data);
		}
		$payment_data = array(
			'policy_number'     => getPolicyId(),
			'insurance_type_id' => 1,
			'total_estimation'  => $total_estimation,
			'user_id'           => $user_id,
			'company_id'        => $company_id,
			'insured_id'        => $vehicle_detail_id,
			'payment_status'    => 0,
			'payment_method'    => 5, // no payment
			'policy_created_by' => 1,
            'policy_created_for' => getUserRoleIdByUserId($user_id),
            'policy_creater'	 => $this->session->userdata('admin_id')
		);
		$this->admin_model->setInsertData('tbl_payment',$payment_data);

		echo 1;
		return true;	
	}

// function to get the finalize vehicle details
	function view_finalize_detail() {
		CheckAdminLoginSession();
		$vehicle_detail_id    = $this->uri->segment(4);
		$data['branch_id']    = getBranchIdByName();
		$data['company_id']   = getCompanyIdByVehicleDetailId($vehicle_detail_id);
		$user_id 			  = getUserIdFromInsuranceDetails($vehicle_detail_id,$this->vehicle_detail);
		$days 	              = getDaysFromVehicleDetailId($vehicle_detail_id,'tbl_selected_premium');
		$data['premium_rate'] = getPremiumRateViaCompanyDays($days,getCompanyIdByVehicleDetailId($vehicle_detail_id));
		$data['estimation_amount'] = getEstimationAmountByInsurerIdInsuranceType($vehicle_detail_id, 1);
		$policy_code 		  = getPolicyCodeForCompany($data['company_id']);
		$post_data            = $this->input->post();
		if(!empty($post_data)) {
			$policy_code   = $this->input->post('policy_code');
			$policy_prefix = $this->input->post('policy_prefix');
			if(empty($this->input->post('policy_prefix'))) {
				$policy_number = getAutogeneratedPolicyNumber($data['company_id']);
			} else {
				if(checkPolicyNumberExists($policy_code."/".$policy_prefix) > 0) {
					$this->session->set_flashdata('message','Policy Number Already Exists. Please Enter another Policy Number');
					redirect('admin/vehicle/view-finalize-detail/'.$vehicle_detail_id);
				} else {
					$policy_number = $policy_code."/".$policy_prefix;
				}
			}
	
			$data_type = array (
				'net_premium'       => $this->input->post('net_premium'),
				'accessories'       => $this->input->post('accessories'),
				'tax'               => $this->input->post('tax'),
				'total_premium'     => $this->input->post('total_premium')
			);
			//print_r($data_type);
			//die;
			foreach($data_type as $key => $value) {
				$record = array(
					'value'             =>$value,
					'type'              => 'other_required_data',
					'name'              => $key,
					'company_id'		=>$this->input->post('company_id'),
					'company_name'      => $this->input->post('company_name'),
					'vehicle_detail_id' => $vehicle_detail_id
				);
				$this->admin_model->setInsertData($this->finalize_vehicle_insurance, $record);
			}


			$insurance_type_id  = $this->input->post('insurance_type_id');
			/*$data = array (
				'user_id'			=> $user_id,
				'insured_id'        => $vehicle_detail_id,
				'insurance_type_id' => $insurance_type_id,
				'amount'            => $this->input->post('total_premium'),
				'accessories_id'    => $this->input->post('accessories_id')
			);
			$this->session->set_userdata('user_payment_data',$data);
			redirect('admin/payment/proceed-to-pay/'.$vehicle_detail_id,'refresh');*/

			$payment_id         = getPaymentIdByInsurerIdInsuranceType($vehicle_detail_id,$insurance_type_id);
			$data_payment = array(
				'policy_number' => $policy_number,
	            'amount' 	    => $this->input->post('total_premium'),
	            'modified_date' => date("Y-m-d H:i:s")
	        );

        	$updated_payment_id = $this->admin_model->setUpdateData('tbl_payment', $data_payment, $payment_id);
        	redirect('admin/questionaries/'.$updated_payment_id);
			// redirect('admin/payment/proceed-to-pay/'.$updated_payment_id);
		}


		$data['final_data']              = $this->admin_model->getFinalVehicleInsuranceDetail($this->finalize_vehicle_insurance,$vehicle_detail_id);

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/view_finalize_detail',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to get the designation by id
	public function getDesignationById() {
        $data    = '';
        $data    = 'class="control-group  "';
        $result  =  form_dropdown('designation_id', getDesignationByBrandId($this->input->post('make_id')),set_value('designation_id'),$data); 
        print_r($result);
        // return $result;
	}

// ajax function to get the details of vehicle like the fuel type and others
	public function getdetailsByDesignationId() {
		$make_id        = $this->input->post('make_id');
		$designation_id = $this->input->post('designation_id');
		$result         = $this->admin_model->getdetailsByDesignationId($make_id,$designation_id);
		print_r($result);
		return $result;
	}

// function added by Shiv to view the list of insurance pollicies
	public function vehicle_policies() {
		CheckAdminLoginSession();
		$data['dataCollection'] = $this->admin_model->getPoliciesByInsuranceTypeId(1);
		/*print_r($data['dataCollection']);
		die;*/
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_policies',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function added by Shiv to update the insurance policy
	public function vehicle_policies_edit() {
		CheckAdminLoginSession();
		$data['policy_number'] 	   = decrypt($this->uri->segment(4));
		$data['vehicle_detail_id'] = $this->uri->segment(5);
		$data['branch_id']         = getBranchIdByName();
		$data['company_id']        = getCompanyIdByVehicleDetailId($data['vehicle_detail_id']);
		$data['risque_id']         = getRisqueIdByVehicleDetailId($data['vehicle_detail_id']);

		$array_id = array ('vehicle_detail_id' => $data['vehicle_detail_id']);

		$data['selected_warranties'] = getSelectedOptionalWarranties($this->selected_optional_warranty,$array_id);
		$data['selected_franchises'] = getSelectedOptionalFranchises($this->selected_optional_franchise,$array_id);

		$data['transported_person_insurance'] = $this->admin_model->getInsuredTravelOptions($data['company_id']);
		// print_r($data['transported_person_insurance']);
		// $data['selected_vehicle_trans_insurance'] = getTransPersonInsuranceData($this->selected_vehicle_trans_insurance,$array_id);
		$data['selected_vehicle_trans_insurance'] = getLatestTransPersonInsuranceData($this->selected_vehicle_trans_insurance,$array_id);
		/*print_r($data['selected_vehicle_trans_insurance']);
		die;*/
		// new code added by Sushant on 9-12-2019
		$data["fleetData"] = $this->admin_model->getVehicleFleetData($data["vehicle_detail_id"]);
		$data["otherVehicleDetailData"] = $this->admin_model->getVehicleDetailDataWithChild($data['vehicle_detail_id']);
		

		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$policy_number       = $this->input->post('policy_number');
			$optional_warranties = $this->input->post('optional_warranties_vehicle');
			$optional_franchises = $this->input->post('optional_franchises_vehicle');
			$company_array[0]    = $data['company_id'];

			if($policy_number == $data['policy_number']) {
				// Delete Optional Warranties
				$this->admin_model->deleteOptionalWarranties($this->selected_optional_warranty,$array_id);

				// Insert Optional Warranties
				foreach ($optional_warranties as $value) {
					$inserted_warranties = array(
						'optional_warranty_id'    		  => $value,
						'vehicle_detail_id'               => $data['vehicle_detail_id'],
						'created_date'            		  => date('Y-m-d H:i:s'),
						'modified_date'           		  => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_warranty,$inserted_warranties);
				}


				// Delete Optional Franchises
				$this->admin_model->deleteOptionalFranchises($this->selected_optional_franchise,$array_id);


				// Insert Optional Franchises
				foreach ($optional_franchises as $value) {
					$inserted_franchises = array(
						'optional_franchise_id'   		  => $value,
						'vehicle_detail_id' 		 	  => $data['vehicle_detail_id'],
						'created_date'            		  => date('Y-m-d H:i:s'),
						'modified_date'         		  => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_franchise,$inserted_franchises);
				}

				$data['selected_warranty_name_id']        = $this->admin_model->getWarrantiesSelected($data['vehicle_detail_id']);
				$data['selected_franchise_name_id']        = $this->admin_model->getFranchisesSelected($data['vehicle_detail_id']);
				$vehicle_trans_person_insurance_details = array (
					'vehicle_trans_person_insurance_id' => $this->input->post('selected_option_transport_person'),
					'modified_date' => date('Y-m-d H:i:s')
				);
				$update_vehicle_trans_person_insurance_id = $this->admin_model->setUpdateData($this->selected_vehicle_trans_insurance,$vehicle_trans_person_insurance_details,$data['selected_vehicle_trans_insurance']->id);


				// Delete finaized data
				$this->admin_model->deleteFinalizedData($this->finalize_vehicle_insurance,$array_id);

				// Insert Finalized Data
				$final_data = getFinalForSelectedCompany($data['selected_franchise_name_id'],$data['selected_warranty_name_id'],$company_array,$data['vehicle_detail_id']);
				// print_r($final_data);
				// die;
				foreach ($final_data as $value) {
					$data_final = array(
						'value'        => $value['value'],
						'type'         => $value['type'],
						'name'         => $value['name'],
						'company_id'   => $value['company_id'],
						'company_name' => $value['company_name'],
						'vehicle_detail_id' => $value['vehicle_detail_id']
					);
					$this->admin_model->setInsertData($this->finalize_vehicle_insurance,$data_final);
				}

				// Get the inserted finalized data
				$data['finalized_details']              = $this->admin_model->getFinalVehicleInsuranceDetail($this->finalize_vehicle_insurance,$data['vehicle_detail_id']);
				

				// Calculate Net Premium and Accessories
				foreach ($data['finalized_details'] as $record) {
			      if ($record->type == 'warranties') {
			        $total_amount +=$record->value;
			        $warranties_name[] = $record->name;
			      }
			      else if($record->type == 'franchise') {
			        $total_amount -=$record->value;
			        $franchise_name[] = $record->name;
			      }
			      else if($record->type == 'trans_person') {
			        $total_amount +=$record->value;
			        $trans_person_name[] = $record->name;
			      }
			      else if($record->type == 'required_data') {
			        $total_amount +=$record->value;
			      }     
			    }

			    
			    // Insert Other finalized details
			    $accessories_id    = getAccessoriesId($total_amount,$data['company_id'],$data['branch_id']);
				$accessories_value = getAccessoriesValue($total_amount,$data['company_id'],$data['branch_id']);
				$tax_amount        = getTaxAmount(($accessories_value + $estimation_amount + $person_amount),$data['company_id'],$data['branch_id']);
				$total_premium     = $total_amount + $accessories_value + $tax_amount;
				
				$finalized_data_type = array (
					'net_premium'   => $total_amount,
					'accessories'   => $accessories_value,
					'tax'           => $tax_amount,
					'total_premium' => $total_premium
				);

				foreach($finalized_data_type as $key => $value) {
					$record = array (
						'value'             => $value,
						'type'              => 'other_required_data',
						'name'              => $key,
						'company_id'        => $data['company_id'],
						'company_name'      => getCompanyName($data['company_id']),
						'vehicle_detail_id' => $data['vehicle_detail_id']
					);
					$this->admin_model->setInsertData($this->finalize_vehicle_insurance,$record);
				}


				// Update Data into Payment Table
				$payment_id = getPaymentIdByInsurerIdInsuranceType($data['vehicle_detail_id'],1);
				$payment_details = $this->admin_model->getDataCollectionByID('tbl_payment',$payment_id);
				$old_payment_amount = $payment_details->amount;

				$payment_data = array (
					'amount'		=> $total_premium,
					'modified_date' => date("Y-m-d H:i:s")
				);
				$update_payment_id = $this->admin_model->setUpdateData('tbl_payment',$payment_data,$payment_id);

				// Update Data into Quittance Table
				$insurance_details = getFinalizedInsuranceDetails($data['vehicle_detail_id'],1);
				$accessories_data  = getAccessoriesAmountShare($accessories_id);
				$quittance_id = getQuittanceId($policy_number);
				$quittance_data    = array (		
					'policy_number'             => $data['policy_number'],
					'company_id'                => $data['company_id'],
					'branch_id'                 => $data['branch_id'],
					'risque_id'                 => $data['risque_id'],
					'user_id'                   => $insurance_details['user_id'],
					'amount'                    => $insurance_details['net_premium'],
					'tax'                       => $insurance_details['tax'],	
					'accessories'               => $insurance_details['accessories'],
					'accessories_id'            => $accessories_id,
					'accessories_admin_share'   => $accessories_data['accessories_admin_share'],
					'accessories_company_share' => $accessories_data['accessories_company_share'],
					'total_amount'              => $insurance_details['total_premium'],
					'created_date'              => date('Y-m-d H:i:s'),
					'modified_date'             => date('Y-m-d H:i:s'),
					'status'                    => 0
				); 
		
				$updated_quittance_id = $this->admin_model->setUpdateData('tbl_quittance',$quittance_data,$quittance_id);
				$updated_insurance_details = $this->admin_model->getDataCollectionByID('tbl_quittance',$updated_quittance_id);

				// Calculating Difference of Old and New Amount
				$amount_difference = ($updated_insurance_details->total_amount - $old_payment_amount);
			} else {
				// Insert Optional Warranties
				foreach ($optional_warranties as $value) {
					$inserted_warranties = array(
						'optional_warranty_id'  => $value,
						'vehicle_detail_id'     => $data['vehicle_detail_id'],
						'created_date'          => date('Y-m-d H:i:s'),
						'modified_date'         => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_warranty,$inserted_warranties);
				}

				// Insert Optional Franchises
				foreach ($optional_franchises as $value) {
					$inserted_franchises = array(
						'optional_franchise_id' => $value,
						'vehicle_detail_id'     => $data['vehicle_detail_id'],
						'created_date'          => date('Y-m-d H:i:s'),
						'modified_date'         => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_franchise,$inserted_franchises);
				}


				$data['selected_warranty_name_id']        = $this->admin_model->getLatestWarrantiesSelectedForInsurance($this->selected_optional_warranty,$data['vehicle_detail_id'],1);


				$data['selected_franchise_name_id']        = $this->admin_model->getLatestFranchisesSelectedForInsurance($this->selected_optional_franchise,$data['vehicle_detail_id'],1);

				$vehicle_transperson_details = $data['selected_vehicle_trans_insurance'];
				if($vehicle_transperson_details->vehicle_trans_person_insurance_id != $this->input->post('selected_option_transport_person')) {
					$transperson_data_to_insert = array (
						'vehicle_trans_person_insurance_id' => $this->input->post('selected_option_transport_person'),
						'vehicle_detail_id'       => $data['vehicle_detail_id'],
						'created_date'            => date('Y-m-d H:i:s'),
						'modified_date'           => date('Y-m-d H:i:s')
					);
					$this->admin_model->setInsertData($this->selected_vehicle_trans_insurance,$transperson_data_to_insert);
				}




				// Insert Finalized Data
				$final_data = getFinalForSelectedCompany($data['selected_franchise_name_id'],$data['selected_warranty_name_id'],$company_array,$data['vehicle_detail_id']);


				foreach ($final_data as $value) {
					$data_final = array(
						'value'             => $value['value'],
						'type'              => $value['type'],
						'name'              => $value['name'],
						'company_id'        => $value['company_id'],
						'company_name'      => $value['company_name'],
						'vehicle_detail_id' => $value['vehicle_detail_id']
					);

					$this->admin_model->setInsertData($this->finalize_vehicle_insurance,$data_final);
				}

				// Get the inserted finalized data
				$data['finalized_details']              = $this->admin_model->getLatestFinalInsuranceDetail($this->finalize_vehicle_insurance,$data['vehicle_detail_id'],1);


				// Calculate Net Premium and Accessories
				// $total_amount = 0;
			    foreach ($data['finalized_details'] as $record) {
			      if ($record->type == 'warranties') {
			        $total_amount +=$record->value;
			        $warranties_name[] = $record->name;
			      }
			      else if($record->type == 'franchise') {
			        $total_amount -=$record->value;
			        $franchise_name[] = $record->name;
			      }
			      else if($record->type == 'trans_person') {
			        $total_amount +=$record->value;
			        $required_data[] = $record->name;
			      }
			      else if($record->type == 'required_data') {
			        $total_amount +=$record->value;
			      }     
			    }

			 	// Insert Other finalized details
			    $accessories_id    = getAccessoriesId($total_amount,$data['company_id'],$data['branch_id']);
				$accessories_value = getAccessoriesValue($total_amount,$data['company_id'],$data['branch_id']);
				$tax_amount        = getTaxAmount(($accessories_value + $estimation_amount + $person_amount),$data['company_id'],$data['branch_id']);
				$total_premium     = $total_amount + $accessories_value + $tax_amount;


				$finalized_data_type = array (
					'net_premium'   => $total_amount,
					'accessories'   => $accessories_value,
					'tax'           => $tax_amount,
					'total_premium' => $total_premium
				);


				foreach($finalized_data_type as $key => $value) {
					$record = array (
						'value'        => $value,
						'type'         => 'other_required_data',
						'name'         => $key,
						'company_id'   => $data['company_id'],
						'company_name' => getCompanyName($data['company_id']),
						'vehicle_detail_id' => $data['vehicle_detail_id']
					);
					$this->admin_model->setInsertData($this->finalize_vehicle_insurance,$record);
				}



				// Insert Data into Payment Table
				$payment_id = getPaymentIdByInsurerIdInsuranceType($data['vehicle_detail_id'],1);

				$payment_details = $this->admin_model->getDataCollectionByID('tbl_payment',$payment_id);
				$old_payment_amount = $payment_details->amount;
				
				$payment_data = array (
					'policy_number'     => checkUniquePolicyId($policy_number),
					'insurance_type_id' => 1,
					'user_id'           => $payment_details->user_id,
					'company_id'        => $payment_details->company_id,
					'insured_id'        => $data['vehicle_detail_id'],
					'payment_status'    => $payment_details->payment_status,
					'payment_method'    => $payment_details->payment_method, // no payment
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
				);

				$updated_payment_id = $this->admin_model->setInsertData('tbl_payment',$payment_data);


				$payment_amount_data = array (
					'amount'		=> $total_premium,
					'modified_date' => date("Y-m-d H:i:s")
				);
				$update_payment_id = $this->admin_model->setUpdateData('tbl_payment',$payment_amount_data,$updated_payment_id);


				// Update Data into Quittance Table
				$data['finalized_details']              = $this->admin_model->getLatestFinalInsuranceDetail($this->finalize_vehicle_insurance,$data['vehicle_detail_id'],1);



				// Calculate Net Premium and Accessories
				// $total_amount = 0;
			    foreach ($data['finalized_details'] as $record) {
			      if ($record->type == 'warranties') {
			        $total_amount +=$record->value;
			        $warranties_name[] = $record->name;
			      }
			      else if($record->type == 'franchise') {
			        $total_amount -=$record->value;
			        $franchise_name[] = $record->name;
			      }
			      else if($record->type == 'trans_person') {
			        $total_amount +=$record->value;
			        $required_data[] = $record->name;
			      }
			      else if($record->type == 'required_data') {
			        $total_amount +=$record->value;
			      }     
			    }

			 	// Insert Other finalized details
			    $accessories_id    = getAccessoriesId($total_amount,$data['company_id'],$data['branch_id']);
				$accessories_value = getAccessoriesValue($total_amount,$data['company_id'],$data['branch_id']);
				$tax_amount        = getTaxAmount(($accessories_value + $estimation_amount + $person_amount),$data['company_id'],$data['branch_id']);
				$total_premium     = $total_amount + $accessories_value + $tax_amount;


				// $old_insurance_details = getFinalizedInsuranceDetails($data['proffesional_multirisk_quote_id'],4);
				$old_quittance_id = getQuittanceId($data['policy_number']);
				$old_quittance_details = $this->admin_model->getDataCollectionByID('tbl_quittance',$old_quittance_id);
				$accessories_data  = getAccessoriesAmountShare($accessories_id);

				$new_payment_details = $this->admin_model->getDataCollectionByID('tbl_payment',$update_payment_id);

				$new_quittance_data    = array (		
					'policy_number'             => $new_payment_details->policy_number,
					'company_id'                => $data['company_id'],
					'branch_id'                 => $data['branch_id'],
					'risque_id'                 => $data['risque_id'],
					'user_id'                   => $old_quittance_details->user_id,
					'amount'                    => $total_amount,
					'tax'                       => $tax_amount,	
					'accessories'               => $accessories_value,
					'accessories_id'            => $accessories_id,
					'accessories_admin_share'   => $accessories_data['accessories_admin_share'],
					'accessories_company_share' => $accessories_data['accessories_company_share'],
					'policy_start_date'         => $old_quittance_details->policy_start_date,
            		'policy_end_date'           => $old_quittance_details->policy_end_date,
					'total_amount'              => $total_premium,
					'created_date'              => date('Y-m-d H:i:s'),
					'modified_date'             => date('Y-m-d H:i:s'),
					'status'                    => 0
				); 
				$updated_quittance_id = $this->admin_model->setInsertData('tbl_quittance',$new_quittance_data);
				$updated_insurance_details = $this->admin_model->getDataCollectionByID('tbl_quittance',$updated_quittance_id);


				// Calculating Difference of Old and New Amount
				$amount_difference = ($updated_insurance_details->total_amount - $old_payment_amount);
			}




			if($amount_difference > 0) {
				$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You have to pay the amount of ".abs($amount_difference)." to the Admin";
			} else if($amount_difference < 0){
				$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You have to recieve the amount of <b>".abs($amount_difference)."</b> from the Admin";
			} else {
				$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You don't have to pay/recieve any amount from the Admin";
			}
			// $amount_difference = diffPolicyTotalAmount($old_payment_amount,$insurance_details['total_premium']);
			$user_id            	     = getUserIdFromInsuranceDetails($data['vehicle_detail_id'],$this->vehicle_detail);
			
			$user_data = $this->admin_model->getDataCollectionByID('tbl_users',$user_id);
			

			// Send Email to End User Regarding Policy Update
			$email_template    = 'send_policy_updation_information.html';
			$templateTags      =  array(
				'{{site_name}}'               => 'Proassur.com',
				'{{site_logo}}'               => base_url(),
				'{{site_url}}'                => base_url(),
				'{{team_name}}'               => 'Proassur',
				'{{first_name}}'              => $user_data->first_name,
				'{{year}}'                    => date('Y'),
				'{{company_name}}'            => 'Proassur.com',
				'{{insurance_type}}'          =>  getInsuranceType(1).' INSURANCE',
				'{{policy_number}}'           =>  $data['policy_number'],
				'{{amount_difference}}'       =>  $amount_message,
				'{{email}}'                   => $user_data->email
			);
			$message           = email_compose($email_template,$templateTags);

			$to                = $user_data->email;
			$subject           = SEND_POLICY_UPDATION_MAIL;
			if (send_smtp_mail($to,$subject,$message)) {
				// $this->session->set_flashdata('message',VERIFICATION_MESSAGE);
	        	// redirect('auth/login','refresh');
			}


			if($amount_difference > 0) {
				$admin_amount_message = "You have to recieve the amount of <b>".abs($amount_difference)."</b> from ".$user_data->first_name;
			} else if($amount_difference < 0){
				$admin_amount_message = "You have to pay the amount of ".abs($amount_difference)." to ".$user_data->first_name;
			} else {
				$admin_amount_message = "You don't have to pay recieve any amount from ".$user_data->first_name;
			}



			// Send Email to Admin Regarding Policy Update
			$admin_email_template    = 'send_policy_updation_information_admin.html';
			$admin_templateTags      =  array(
				'{{site_name}}'               => 'Proassur.com',
				'{{site_logo}}'               => base_url(),
				'{{site_url}}'                => base_url(),
				'{{team_name}}'               => 'Proassur',
				'{{first_name}}'              => 'Admin',
				'{{year}}'                    => date('Y'),
				'{{company_name}}'            => 'Proassur.com',
				'{{insurance_type}}'          =>  getInsuranceType(1).' INSURANCE',
				'{{policy_number}}'           =>  $data['policy_number'],
				'{{amount_difference}}'       =>  $admin_amount_message,
				'{{email}}'                   => getAdminEmail()
			);
			$admin_message     = email_compose($admin_email_template,$admin_templateTags);

			$admin_email       = getAdminEmail();
			$admin_subject     = SEND_POLICY_UPDATION_MAIL;
			if (send_smtp_mail($admin_email,$admin_subject,$admin_message)) {
				$this->session->set_flashdata('message',POLICY_UPDATE_SUCCESS_MESSAGE);
	        	redirect('admin/vehicle/vehicle-policies','refresh');
			}

		}

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/vehicle_policies_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	// new code added on 10-12-2019
	public function addMoreVehicle($policy_number, $vehicleDetail_id) {
		CheckAdminLoginSession();
		$data["vehicle_detail_id"] = $vehicleDetail_id;
		$data["policy_number"] = $policy_number;
		$vehicleDetailData = $this->admin_model->getVehicleDetailData($vehicleDetail_id);
		$user_id = $vehicleDetailData->user_id;
		$company_vehicle_quote_id = $vehicleDetailData->company_vehicle_quote_id;
		// print_r($data); die;
		$post_data=$this->input->post();
		if(!empty($post_data)) {
			// print_r($_POST); die;
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('make_id', 'Make/Brand', 'required|trim');
			$this->form_validation->set_rules('usage', 'Usage', 'required|trim');	
			$this->form_validation->set_rules('designation', 'Designation', 'required|trim');	
			$this->form_validation->set_rules('insurance_registeration_date', 'Insurance Registeration Date', 'required|trim');	
			$this->form_validation->set_rules('seats', 'Seats', 'required|trim');	

			$this->form_validation->set_rules('fuel_type', 'Fuel Type', 'required|trim');	
			$this->form_validation->set_rules('horse_power', 'Horse Power', 'required|trim');	
			$this->form_validation->set_rules('fiscal_power', 'Fiscal Power', 'required|trim');	
			$this->form_validation->set_rules('risque', 'Risque', 'required|trim');	
			$this->form_validation->set_rules('seats', 'Seats', 'required|numeric|trim');	
			$this->form_validation->set_rules('fuel_type', 'Fuel Type', 'required|trim');

			// vehicle detail form
			$this->form_validation->set_rules('registeration_number', 'Registration Number', 'required|trim');
			$this->form_validation->set_rules('catalogue_value', 'Value', 'required|trim');	
			$this->form_validation->set_rules('vehicle_identification', 'Identification Number', 'required|trim');
			$this->form_validation->set_rules('date_release_certificate', 'Date Release', 'required|trim');
			$this->form_validation->set_rules('engine_displacement', 'Engine Displacement', 'required|trim');
			$this->form_validation->set_rules('vehicle_category', 'Vehicle Category', 'required|trim');
			$this->form_validation->set_rules('chasis_number', getContentLanguageSelected('CHASIS_NUMBER',defaultSelectedLanguage()), 'required|trim');
			$this->form_validation->set_rules('authorise_weight', 'Authorise Weight ', 'required|trim');
			$this->form_validation->set_rules('vehicle_type', 'Vehicle Type ', 'required|trim');
			$this->form_validation->set_rules('gear_box', 'Gear Box ', 'required|trim');
			$this->form_validation->set_rules('tax_bonus', 'Tax Bonus ', 'required|trim');
			$this->form_validation->set_rules('registeration_date', 'Registeration Date ', 'required|trim');
			$this->form_validation->set_rules('immatriclulation', 'Immatriclulation ', 'required|trim');
			$this->form_validation->set_rules('current_value', 'Current Value ', 'required|trim');
			$this->form_validation->set_rules('previous_register_date', 'Previous Register Date ', 'required|trim');
			$this->form_validation->set_rules('date_first_release', 'Date First Release ', 'required|trim');
			$this->form_validation->set_rules('engine_number', 'Engine Number ', 'required|trim');
			$this->form_validation->set_rules('body_work', 'Body Work ', 'required|trim');
			$this->form_validation->set_rules('load_weight', 'Load Weight ', 'required|trim');
			$this->form_validation->set_rules('tariff_code', 'Tariff Code ', 'required|trim');
			$this->form_validation->set_rules('seating_capacity', 'Seating Capacity ', 'required|trim');

			if($this->form_validation->run() == TRUE) {
				/*$data2                = array(									
					'fuel_type'      => $this->input->post('fuel_type'),
					'fiscal_power'   => $this->input->post('fiscal_power'),
					'usage'          => $this->input->post('usage'),
					'trailer'        => $this->input->post('trailer'),
					'risque'         => $this->input->post('risque'),
					'seats'          => $this->input->post('seats')
				); 
				$result              = $this->admin_model->getCompanyQuote($data2,'tbl_company_vehicle_quote');
				if (count($result)>0) {
				}*/
				// echo "<pre>"; print_r($_POST); die;
				if(!empty($this->input->post("tvv")) && !empty($vehicleDetail_id))
				{
					$data2        = array(	
						'user_id'                            => $user_id,
						'registeration_number'               => $this->input->post('registeration_number'),
						'risque_id'                          => $this->input->post('risque'),
						'insurance_registeration_date'       => $this->input->post('insurance_registeration_date'),
						'tvv'                                => $this->input->post('tvv'),
						'company_vehicle_quote_id'           => $company_vehicle_quote_id,
						'catalogue_value'                    => $this->input->post('catalogue_value'),
						'vehicle_identification'             => $this->input->post('vehicle_identification'),
						'date_release_certificate'           => $this->input->post('date_release_certificate'),
						'engine_displacement'                => $this->input->post('engine_displacement'),
						'vehicle_category'                   => $this->input->post('vehicle_category'),
						'chasis_number'                      => $this->input->post('chasis_number'),
						'authroise_weight'                   => $this->input->post('authroise_weight'),
						'vehicle_type'                       => $this->input->post('vehicle_type'),
						'gear_box'                           => $this->input->post('gear_box'),
						'tax_bonus'                          => $this->input->post('tax_bonus'),
						'registeration_date'                 => $this->input->post('registeration_date'),
						'immatriclulation'                   => $this->input->post('immatriclulation'),
						'current_value'                      => $this->input->post('current_value'),
						'previous_register_date'             => $this->input->post('previous_register_date'),
						'date_first_release'                 => $this->input->post('date_first_release'),
						'engine_number'                      => $this->input->post('engine_number'),
						'usage'                              => $this->input->post('usage'),
						'body_work'                          => $this->input->post('body_work'),
						'load_weight'                        => $this->input->post('load_weight'),
						'tariff_code'                        => $this->input->post('tariff_code'),
						'seating_capacity'                   => $this->input->post('seating_capacity'),
						'parent_id'							 => $vehicleDetail_id,
						'modified_date'                      => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->vehicle_detail,$data2);
					$this->session->set_flashdata('message','Your Vehicle Details has been added');
			        redirect(base_url('admin/vehicle/vehicle-policies-edit/'.$policy_number.'/'.$vehicleDetail_id),'refresh');
			    }
	    	}
        }

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/vehicle/add_more_vehicle',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');		
    
	}

	
	// function added by Shiv to get the Card Details for an user
    public function card_details($policy_number = null) {
        if(!empty($policy_number)) {
            $data['card_details'] = getInsuranceCardDetails(decrypt($policy_number));
            $company_name = $data['card_details']->company_name;
            $vehicle_plate = $data['card_details']->vehicle_plate;
            if(!empty($data['card_details'])) { 
		
                $html =  $this->load->view('front/users/vehicle_card_details', $data,true);
                
                $data = [];        
		        
                // $abc = date('dmYhis').".pdf";
				$abc = $vehicle_plate." + ".$company_name.".pdf";
				$pdfFilePath = $abc;
                $this->load->library('m_pdf', array('orientation' => 2));
                $this->m_pdf->pdf->SetHeader('Proassur is the one-stop destnition of all your insurance needs');
                $this->m_pdf->pdf->setFooter('{DATE j-m-Y} Page: {PAGENO}');
                $this->m_pdf->pdf->WriteHTML($html);
		
                $this->m_pdf->pdf->Output($pdfFilePath, "I");
            } else {
                echo ACCESS_DENIED;
            }
        } else {
            echo ACCESS_DENIED;
        }
    }


}
