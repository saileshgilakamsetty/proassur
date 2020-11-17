<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospitalization extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $hospitalization 		  = 'tbl_hospitalization';
	public $hospitalization_documents = 'tbl_hospitalization_documents';

// function to add a warranty
	public function add() {	
        CheckAdminLoginSession();	
		$post_data             = $this->input->post();

		if(!empty($post_data)) { 
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('policy_holder_name', ' Policy Holder Name', 'required|trim');
			$this->form_validation->set_rules('insurance_company_id', ' Insurance Company', 'required|trim');
			$this->form_validation->set_rules('the_patient_name', ' Patient Name', 'required|trim');
			$this->form_validation->set_rules('contact_number', ' Contact Number', 'required|trim');
			$this->form_validation->set_rules('healthcareprovider_name_id', ' Healthcare Provider Name', 'required|trim');
			$this->form_validation->set_rules('dial_code', ' Dial Code', 'required');
			$this->form_validation->set_rules('provider_contact_number', ' Provider Contact Number', 'required|trim');
			$this->form_validation->set_rules('description', ' Description', 'required');
			$this->form_validation->set_rules('provider_person_name', ' Provider Person Name', 'required');
			$this->form_validation->set_rules('provider_address', ' Provider Address', 'required');
			if (empty($_FILES['images']['name'][0])) {
				$this->form_validation->set_rules('images', 'Document', 'required');
			}
			if($this->form_validation->run() == FALSE) {   } else {
				$data = array (
					'policy_holder_name_id' 	 => $post_data['policy_holder_name'],
					'insurance_company_id' 		 => $post_data['insurance_company_id'],
					'policy_number'              => $post_data['hospitalization_policy_number'],
					'the_patient_name' 			 => $post_data['the_patient_name'],
					'contact_dial_code' 		 => $post_data['contact_dial_code'],
					'contact_number' 			 => $post_data['contact_number'],
					'healthcareprovider_name_id' => $post_data['healthcareprovider_name_id'],
					'provider_person_name' 	     => $post_data['provider_person_name'],
					'dial_code'                  => $post_data['dial_code'],
					'provider_contact_number'    => $post_data['provider_contact_number'],
					'provider_address' 			 => $post_data['provider_address'],
					'country'          			 => $post_data['country'],
					'state'            			 => $post_data['state'],
					'city'             			 => $post_data['city'],
					//'postal_code'      			 => $post_data['postal_code'],
					'latitude'         			 => $post_data['latitude'],
					'longitude'        			 => $post_data['longitude'],
					'description'	   			 => $post_data['description'],
					// 'attach_document'  			 => ($image)?$image:'',
					'created_by'                 => 1, // admin
					'status'		   			 => $post_data['status'],
					'approved_status'  			 => 0
				);
				$id = $this->admin_model->setInsertData($this->hospitalization,$data);
				if($id > 0) {
					$images = multiple_files_upload('hospitalization',$_FILES["images"]);
					if(!array_key_exists('error', $images)) {
						foreach ($images as $key => $value) {
							$data_to_insert = array (
								'hospitalization_id' => $id,
								'document' => $value
							);
							$this->admin_model->setInsertData($this->hospitalization_documents,$data_to_insert);
						}
					}	
				}
				$this->session->set_flashdata('message','Your Hospitalization has been added successfully');
		        redirect('admin/hospitalization/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/hospitalization/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit 
	public function edit() {
		$id           = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data    = $this->input->post();
		if(!empty($post_data)) { 
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('policy_holder_name', ' Policy Holder Name', 'required|trim');
			$this->form_validation->set_rules('insurance_company_id', ' Insurance Company', 'required|trim');
			$this->form_validation->set_rules('the_patient_name', ' Patient Name', 'required|trim');
			$this->form_validation->set_rules('contact_number', ' Contact Number', 'required|trim');
			$this->form_validation->set_rules('healthcareprovider_name_id', ' Healthcare Provider Name', 'required|trim');
			$this->form_validation->set_rules('dial_code', ' Dial Code', 'required');
			$this->form_validation->set_rules('provider_contact_number', ' Provider Contact Number', 'required|trim');
			$this->form_validation->set_rules('description', ' Description', 'required');
			$this->form_validation->set_rules('provider_person_name', ' Provider Person Name', 'required');
			$this->form_validation->set_rules('provider_address', ' Provider Address', 'required');

			if($this->form_validation->run() == FALSE) {   } else {
				if($_FILES["attach_document"]["name"] != "") {
					//$image             = do_upload('hospitalization','attach_document');
					//$data_featured_img = array('image' => $image );
				} else {
					$data_collection = $this->admin_model->getDataCollectionByID($this->hospitalization,$id);
					//$image = $data_collection->attach_document;
				}
				$data = array (
					'policy_holder_name_id' 	 => $post_data['policy_holder_name'],
					'insurance_company_id' 		 => $post_data['insurance_company_id'],
					'the_patient_name' 			 => $post_data['the_patient_name'],
					'contact_dial_code' 		 => $post_data['contact_dial_code'],
					'contact_number' 			 => $post_data['contact_number'],
					'healthcareprovider_name_id' => $post_data['healthcareprovider_name_id'],
					'provider_person_name' 	     => $post_data['provider_person_name'],
					'dial_code'                  => $post_data['dial_code'],
					'provider_contact_number'    => $post_data['provider_contact_number'],
					'provider_address' => $post_data['provider_address'],
					'country'          => $post_data['country'],
					'state'            => $post_data['state'],
					'city'             => $post_data['city'],
					'postal_code'      => $post_data['postal_code'],
					'latitude'         => $post_data['latitude'],
					'longitude'        => $post_data['longitude'],
					'description'	   => $post_data['description'],
					//'attach_document'  => ($image)?$image:'',
					'status'		   => $post_data['status']
				);
				
				$update_id = $this->admin_model->setUpdateData($this->hospitalization,$data,$id);
				$this->session->set_flashdata('message','Your Hospitalization has been updated successfully');
		        redirect('admin/hospitalization/lists','refresh');
		    }
        }
		$data['dataCollection']         = $this->admin_model->getDataCollectionByID($this->hospitalization,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/hospitalization/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// callback function to check max percent value is less than percent value 
	public function check_max_percent_validation($string) {
    	if($string > $this->input->post('percent')) {
        $this->form_validation->set_message('check_max_percent_validation','The {field} value can not be greater than percent value. Please try another value.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}
	
// callback function to check name exists or not at time of edit 
	public function check_name_exists($string) {
		$warranty_id   = $this->uri->segment(4);
    	$result       = $this->admin_model->checkNameAdded($warranty_id,$this->warranty,$string);
    	if($result>0) {
        $this->form_validation->set_message('check_name_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}

// function to get lists
	public function lists()	{
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
        $totalCount              = $this->admin_model->totalRecord($this->hospitalization);
		$data["dataCollection"]  = $this->admin_model->getDataCollection($this->hospitalization,$limit,$start);
        $totalResult             = count($data['dataCollection']);
		$data["pagination"]      = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/hospitalization/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete
	public function delete() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->hospitalization,$id);
		$this->session->set_flashdata('message','Your hospitalization has been deleted successfully');
        redirect('admin/hospitalization/lists','refresh');
	}

// function to change status
	public function status()
	{
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->hospitalization,$data,$id);
		$this->session->set_flashdata('message','Your status has been updated successfully');
		redirect('admin/hospitalization/lists','refresh');		
	}

// function to get Risque By Branch Id of risque

	public function getRisqueByBranchId() {
        $data    = '';
        $data    = 'class="control-group  " id="risque_by_branch" ';
        $result  =  form_dropdown('risque_id', getRisqueByBranchId($this->input->post('branch_id')),set_value('risque_id'),$data); 
        print_r($result);
        // return $result;
	}

// function added by Shiv

	function getCompanyid() {
		$payment_id   = $this->input->post('id');
		$payment_data = $this->admin_model->getDataCollectionByID('tbl_payment',$payment_id);
		$result = json_encode(array (
			'company_id' => $payment_data->company_id,
			'policy_number' => $payment_data->policy_number
		));
		print_r($result);
	}
}