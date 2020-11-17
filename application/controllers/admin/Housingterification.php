<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Housingterification extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $house_tarification = 'tbl_house_tarification';

// function to add a name of a Housing
	public function add_house_tarification() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('insurer_quality_id', 'Insurer', 'required');		
			$this->form_validation->set_rules('minimum_room', 'Minimum No of Room', 'required|trim|numeric');		
			$this->form_validation->set_rules('maximum_room', 'Maximum No of Room', 'required|trim|numeric|callback_check_maximum_room_validation');
			$this->form_validation->set_rules('minimum_content_value', 'Minimum Content Value', 'required|trim|numeric');		
			$this->form_validation->set_rules('maximum_content_value', 'Maximum Content Value', 'required|trim|numeric|callback_check_maximum_content_value_validation');
			$this->form_validation->set_rules('minimum_building_value', 'Minimum Building Value', 'required|trim|numeric');		
			$this->form_validation->set_rules('maximum_building_value', 'Maximum Building Value', 'required|trim|numeric|callback_check_maximum_building_value_validation');

			$this->form_validation->set_rules('minimum_monthly_rent', 'Minimum Monthly Rent', 'required|trim|numeric');		
			$this->form_validation->set_rules('maximum_monthly_rent', 'Maximum Monthly Rent', 'required|trim|numeric|callback_check_maximum_monthly_rent_validation');		
			
			$this->form_validation->set_rules('minimum_superficy', 'Minimum Superficy', 'required|trim|numeric');		
			$this->form_validation->set_rules('maximum_superficy', 'Maximum Superficy', 'required|trim|numeric|callback_check_maximum_superficy_validation');
			// $this->form_validation->set_rules('content_value', 'Content Value', 'required|trim');		
			// $this->form_validation->set_rules('building_value', 'Building Value', 'required|trim');		
			// $this->form_validation->set_rules('monthly_rent', 'Monthly Rent', 'required|trim');		
			// $this->form_validation->set_rules('superficy', 'Superficy', 'required|trim');		
			// $this->form_validation->set_rules('house_type_id', 'House Type', 'required|trim');		
			// $this->form_validation->set_rules('house_category_id', 'House Category', 'required|trim');		
			// $this->form_validation->set_rules('from', 'From', 'required|trim');		
			// $this->form_validation->set_rules('to', 'To', 'required|trim');		
			$this->form_validation->set_rules('company_id', 'Company ', 'required|trim');		
			$this->form_validation->set_rules('branch_id', 'Branch ', 'required|trim');		
			$this->form_validation->set_rules('risque_id', 'Risque ', 'required|trim');		

			if($this->form_validation->run() == FALSE) {   } else {	
				$data            = array(									
					'insurer_quality_id' => $this->input->post('insurer_quality_id'),
					'minimum_room'               => $this->input->post('minimum_room'),				
					'maximum_room'               => $this->input->post('maximum_room'),				
					'minimum_monthly_rent'       => $this->input->post('minimum_monthly_rent'),
					'maximum_monthly_rent'       => $this->input->post('maximum_monthly_rent'),
					'minimum_content_value'      => $this->input->post('minimum_content_value'),
					'maximum_content_value'      => $this->input->post('maximum_content_value'),
					'minimum_building_value'     => $this->input->post('minimum_building_value'),
					'maximum_building_value'     => $this->input->post('maximum_building_value'),
					'minimum_superficy'          => $this->input->post('minimum_superficy'),
					'maximum_superficy'          => $this->input->post('maximum_superficy'),
					'house_type_id'      => $this->input->post('house_type_id'),
					'house_category_id'  => $this->input->post('house_category_id'),
					'month_id'           => $this->input->post('month_id'),
					// 'from'               => $this->input->post('from'),
					// 'to'                 => $this->input->post('to'),
					'company_id'         => $this->input->post('company_id'),
					'branch_id'          => getHousingBranchId(),
					'risque_id'          => $this->input->post('risque_id'),
					'amount'             => $this->input->post('amount'),
					'status'             => $this->input->post('status'),
					'created_date'       => date('Y-m-d H:i:s'),
					'modified_date'      => date('Y-m-d H:i:s')			
				);
/*				print_r($data);
				die("sddddddddddddd");*/
				$id              = $this->admin_model->setInsertData($this->house_tarification,$data);
				$this->session->set_flashdata('message','Your Housing Type name has been added successfully');
		        redirect('admin/housingterification/list_house_tarification','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_type/add_house_terification');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function to edit Housing Tarification
	public function edit_house_tarification() {
		$id                = $this->uri->segment(4);

        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('insurer_quality_id', 'Insurer', 'required');	
			$this->form_validation->set_rules('minimum_room', 'Minimum No of Room', 'required|trim|numeric');		
			$this->form_validation->set_rules('maximum_room', 'Maximum No of Room', 'required|trim|numeric|callback_check_maximum_room_validation');
			$this->form_validation->set_rules('minimum_content_value', 'Minimum Content Value', 'required|trim|numeric');		
			$this->form_validation->set_rules('maximum_content_value', 'Maximum Content Value', 'required|trim|numeric|callback_check_maximum_content_value_validation');
			$this->form_validation->set_rules('minimum_building_value', 'Minimum Building Value', 'required|trim|numeric');		
			$this->form_validation->set_rules('maximum_building_value', 'Maximum Building Value', 'required|trim|numeric|callback_check_maximum_building_value_validation');

			$this->form_validation->set_rules('minimum_monthly_rent', 'Minimum Monthly Rent', 'required|trim|numeric');		
			$this->form_validation->set_rules('maximum_monthly_rent', 'Maximum Monthly Rent', 'required|trim|numeric|callback_check_maximum_monthly_rent_validation');		
			
			$this->form_validation->set_rules('minimum_superficy', 'Minimum Superficy', 'required|trim|numeric');		
			$this->form_validation->set_rules('maximum_superficy', 'Maximum Superficy', 'required|trim|numeric|callback_check_maximum_superficy_validation');	
			// $this->form_validation->set_rules('room', 'Room', 'required');		
			// $this->form_validation->set_rules('content_value', 'Content Value', 'required|trim');		
			// $this->form_validation->set_rules('building_value', 'Building Value', 'required|trim');		
			// $this->form_validation->set_rules('monthly_rent', 'Monthly Rent', 'required|trim');		
			// $this->form_validation->set_rules('superficy', 'Superficy', 'required|trim');		
			// $this->form_validation->set_rules('house_type_id', 'House Type', 'required|trim');		
			// $this->form_validation->set_rules('house_category_id', 'House Category', 'required|trim');		
			// $this->form_validation->set_rules('from', 'From', 'required|trim');		
			// $this->form_validation->set_rules('to', 'To', 'required|trim');		
			$this->form_validation->set_rules('company_id', 'Company ', 'required|trim');		
			$this->form_validation->set_rules('branch_id', 'Branch ', 'required|trim');		
			$this->form_validation->set_rules('risque_id', 'Risque ', 'required|trim');		

			if($this->form_validation->run() == FALSE) {   } else {	
				
				$data            = array(									
					'insurer_quality_id' 	 => $this->input->post('insurer_quality_id'),
					'minimum_room'           => $this->input->post('minimum_room'),				
					'maximum_room'           => $this->input->post('maximum_room'),				
					'minimum_monthly_rent'   => $this->input->post('minimum_monthly_rent'),
					'maximum_monthly_rent'   => $this->input->post('maximum_monthly_rent'),
					'minimum_content_value'  => $this->input->post('minimum_content_value'),
					'maximum_content_value'  => $this->input->post('maximum_content_value'),
					'minimum_building_value' => $this->input->post('minimum_building_value'),
					'maximum_building_value' => $this->input->post('maximum_building_value'),
					'minimum_superficy'      => $this->input->post('minimum_superficy'),
					'maximum_superficy'      => $this->input->post('maximum_superficy'),
					'house_type_id'      	 => $this->input->post('house_type_id'),
					'house_category_id'  	 => $this->input->post('house_category_id'),
					'month_id'           	 => $this->input->post('month_id'),
					// 'from'               => $this->input->post('from'),
					// 'to'                 => $this->input->post('to'),
					'company_id'         	 => $this->input->post('company_id'),
					'branch_id'          	 => getHousingBranchId(),
					'risque_id'          	 => $this->input->post('risque_id'),
					'amount'             	 => $this->input->post('amount'),
					'status'        	     => $this->input->post('status'),
					'created_date'   		 => date('Y-m-d H:i:s'),
					'modified_date'     	 => date('Y-m-d H:i:s')			
				);
				$id              = $this->admin_model->setUpdateData($this->house_tarification,$data,$id);

				// $id              = $this->admin_model->setInsertData($this->house_tarification,$data);
				$this->session->set_flashdata('message','Your Housing Tarification name has been updated successfully');
		        redirect('admin/housingterification/list_house_tarification','refresh');
		    }
        }
        $data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->house_tarification,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_type/edit_house_terification',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to get list of house tarification
	public function list_house_tarification()	{
		CheckAdminLoginSession();
		$per_page            = 20;
        if($this->uri->segment(4)){
        	$page            = ($this->uri->segment(4)) ;
        }
        else {
        	$page            = 1;
        }
        $start                   = ($page-1)*$per_page;
        $limit                   = $per_page;
        $totalCount              = $this->admin_model->totalRecord($this->house_tarification);
		$data["dataCollection"]  = $this->admin_model->getDataCollection($this->house_tarification,$limit,$start);
        $totalResult             = count($data['dataCollection']);
		$data["pagination"]      = Jpagination($totalCount,$limit,$start);
		$url                     = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL             = parse_url($url);
		$data["current_link"]    = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_type/list_house_tarification',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete the hosing ractification
	public function delete() {
		CheckAdminLoginSession();
		$id    = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->house_tarification,$id);
		$this->session->set_flashdata('message','Your record has been deleted successfully');
        redirect('admin/housingterification/list_house_tarification','refresh');
	}

// function to change the status of hosing tarification 
	public function status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->house_tarification,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/housingterification/list_house_tarification','refresh');		
	}


	// callback function to check max room value is greater than min room value 
	public function check_maximum_room_validation($string) {
    	if($string < $this->input->post('minimum_room')) {
        $this->form_validation->set_message('check_maximum_room_validation','The {field} value can not be less than Minimum No of Room. Please try another value.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}

	// callback function to check max value is greater than min value 
	public function check_maximum_content_value_validation($string) {
    	if($string < $this->input->post('minimum_content_value')) {
        $this->form_validation->set_message('check_maximum_content_value_validation','The {field} value can not be less than Minimum Content Value. Please try another value.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}

	// callback function to check max value is greater than min value 
	public function check_maximum_building_value_validation($string) {
    	if($string < $this->input->post('minimum_building_value')) {
        $this->form_validation->set_message('check_maximum_building_value_validation','The {field} value can not be less than Minimum Building Value. Please try another value.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}

	// callback function to check max value is greater than min value 
	public function check_maximum_monthly_rent_validation($string) {
    	if($string < $this->input->post('minimum_monthly_rent')) {
        $this->form_validation->set_message('check_maximum_monthly_rent_validation','The {field} value can not be less than Minimum Monthly Rent. Please try another value.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}

	// callback function to check max value is greater than min value 
	public function check_maximum_superficy_validation($string) {
    	if($string < $this->input->post('minimum_superficy')) {
        $this->form_validation->set_message('check_maximum_superficy_validation','The {field} value can not be less than Minimum Superficy. Please try another value.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}
}