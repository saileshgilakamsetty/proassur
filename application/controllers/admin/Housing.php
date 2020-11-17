<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Housing extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $house_type 						  = 'tbl_house_type';
	public $house_category  				  = 'tbl_house_category';
	public $house_detail    				  = 'tbl_house_detail';
	public $insurer_quality 				  = 'tbl_insurer_quality';
	public $house_month     				  = 'tbl_house_month';
	public $selected_optional_warranty_house  = 'tbl_selected_optional_warranty_house';
	public $selected_optional_franchise_house = 'tbl_selected_optional_franchise_house';
	public $finalize_housing_insurance  	  = 'tbl_finalize_housing_insurance';

// function to add a name of a Housing
	public function add_house_type() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[tbl_house_type.name]');		

			if($this->form_validation->run() == FALSE) {   } else {
				$slug            = $this->input->post('name');
				$data            = array(									
					'name'       => $this->input->post('name'),					
					'status'     => $this->input->post('status')			
				);
				$id              = $this->admin_model->setInsertData($this->house_type,$data);
				$this->session->set_flashdata('message','Your Housing Type name has been added successfully');
		        redirect('admin/house-type','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_type/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to view hose type list
	public function house_type() {
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
        $totalCount             = $this->admin_model->totalRecord($this->house_type);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->house_type,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_type/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete house type
	public function delete_house_type() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->house_type,$id);
		$this->session->set_flashdata('message','Your Housing Type Name has been deleted successfully');
        redirect('admin/house-type','refresh');
	}

// function to change status
	public function house_type_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->house_type,$data,$id);
		$this->session->set_flashdata('message','Your status has been updated successfully');
		redirect('admin/house-type','refresh');		
	}

// function to edit house type
	public function house_type_edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'name', 'required|callback_house_type_exists|trim');		
								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug      = $this->input->post('name');
				$data      = array(			
					'name'   => $this->input->post('name'),
					'status' => $this->input->post('status')
				); 

				$id        = $this->admin_model->setUpdateData($this->house_type,$data,$id);
				$this->session->set_flashdata('message','Your Housing  Type Name has been updated successfully');
		        redirect('admin/house-type','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->house_type,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_type/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to check house type name exists
	public function house_type_exists($string) {
		$id           = $this->uri->segment(4);
    	$result       = $this->admin_model->checkNameExists($id,$this->house_type,$string);
    	if($result>0) {
        $this->form_validation->set_message('house_type_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}



// function added by Shiv to add a name of a Housing
	public function add_house_category() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[tbl_house_category.name]');		

			if($this->form_validation->run() == FALSE) {   } else {
				$slug            = $this->input->post('name');
				$data            = array(									
					'name'       => $this->input->post('name'),					
					'status'     => $this->input->post('status')			
				);
				$id              = $this->admin_model->setInsertData($this->house_category,$data);
				$this->session->set_flashdata('message','Your Housing Category Name has been added successfully');
		        redirect('admin/house-category','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_category/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function added by Shiv to view hose category list
	public function house_category() {
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
        $totalCount             = $this->admin_model->totalRecord($this->house_type);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->house_category,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_category/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function added by Shiv to delete house category
	public function delete_house_category() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->house_category,$id);
		$this->session->set_flashdata('message','Your Housing Category Name has been deleted successfully');
        redirect('admin/house-category','refresh');
	}


// function added by Shiv to change status
	public function house_category_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->house_category,$data,$id);
		$this->session->set_flashdata('message','Your status has been updated successfully');
		redirect('admin/house-category','refresh');		
	}


// function added by Shiv to edit the house category
	public function house_category_edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'name', 'required|callback_house_category_exists|trim');		
								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug           = $this->input->post('name');
				$data           = array(			
					'name'     	    => $this->input->post('name'),
					'status'  	    => $this->input->post('status')
				); 

				$id              = $this->admin_model->setUpdateData($this->house_category,$data,$id);
				$this->session->set_flashdata('message','Your Housing Category Name has been updated successfully');
		        redirect('admin/house-category','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->house_category,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_category/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function added by Shiv to check house category name exists
	public function house_category_exists($string) {
		$id           = $this->uri->segment(4);
    	$result       = $this->admin_model->checkNameExists($id,$this->house_category,$string);
    	if($result>0) {
        $this->form_validation->set_message('house_category_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}	




	
// function added by Shiv to add the insurer quality of a Housing
	public function add_house_insurer_quality() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[tbl_insurer_quality.name]');		

			if($this->form_validation->run() == FALSE) {   } else {
				$slug            = $this->input->post('name');
				$data            = array(									
					'name'       => $this->input->post('name'),					
					'status'     => $this->input->post('status')			
				);
				$id              = $this->admin_model->setInsertData($this->insurer_quality,$data);
				$this->session->set_flashdata('message','Your Insurer Quality has been added successfully');
		        redirect('admin/house-insurer-quality','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_insurer_quality/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}




// function added by Shiv to view insurer quality list
	public function house_insurer_quality() {
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
        $totalCount             = $this->admin_model->totalRecord($this->insurer_quality);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->insurer_quality,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_insurer_quality/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function added by Shiv to delete house insurer quality
	public function delete_house_insurer_quality() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->insurer_quality,$id);
		$this->session->set_flashdata('message','Your Insurer Quality has been deleted successfully');
        redirect('admin/house-insurer-quality','refresh');
	}


// function added by Shiv to change status
	public function house_insurer_quality_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->insurer_quality,$data,$id);
		$this->session->set_flashdata('message','Your status has been updated successfully');
		redirect('admin/house-insurer-quality','refresh');		
	}




// function added by Shiv to edit the house category
	public function house_insurer_quality_edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'name', 'required|callback_house_insurer_quality_exists|trim');		
								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug           = $this->input->post('name');
				$data           = array(			
				'name'     	    => $this->input->post('name'),
				'status'  	    => $this->input->post('status')
				); 

				$id              = $this->admin_model->setUpdateData($this->insurer_quality,$data,$id);
				$this->session->set_flashdata('message','Your Insurer Quality has been updated successfully');
		        redirect('admin/house-insurer-quality','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->insurer_quality,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_insurer_quality/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function added by Shiv to check house insurer quality exists
	public function house_insurer_quality_exists($string) {
		$id           = $this->uri->segment(4);
    	$result       = $this->admin_model->checkNameExists($id,$this->insurer_quality,$string);
    	if($result>0) {
        $this->form_validation->set_message('house_insurer_quality_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}	




// function added by Shiv to add a name of a Housing Month
	public function add_house_month() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[tbl_house_month.name]');		

			if($this->form_validation->run() == FALSE) {   } else {
				$slug            = $this->input->post('name');
				$data            = array(									
					'name'       => $this->input->post('name'),					
					'status'     => $this->input->post('status')			
				);
				$id              = $this->admin_model->setInsertData($this->house_month,$data);
				$this->session->set_flashdata('message','Your Housing Month Name has been added successfully');
		        redirect('admin/house-month','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_month/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function added by Shiv to view Housing Month list
	public function house_month() {
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
        $totalCount             = $this->admin_model->totalRecord($this->house_month);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->house_month,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_month/list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function added by Shiv to delete Housing Month
	public function delete_house_month() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->house_month,$id);
		$this->session->set_flashdata('message','Your Housing Month Name has been deleted successfully');
        redirect('admin/house-month','refresh');
	}

// function added by Shiv to change status
	public function house_month_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->house_month,$data,$id);
		$this->session->set_flashdata('message','Your status has been updated successfully');
		redirect('admin/house-month','refresh');		
	}



// function added by Shiv to edit Housing Month
	public function house_month_edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'name', 'required|callback_house_month_exists|trim');		
								
			if($this->form_validation->run() == FALSE) {   } else {
				$slug           = $this->input->post('name');
				$data           = array(			
				'name'     	    => $this->input->post('name'),
				'status'  	    => $this->input->post('status')
				); 

				$id              = $this->admin_model->setUpdateData($this->house_month,$data,$id);
				$this->session->set_flashdata('message','Your Housing  Month Name has been updated successfully');
		        redirect('admin/house-month','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->house_month,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_month/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function added by Shiv to check Housing Month name exists
	public function house_month_exists($string) {
		$id           = $this->uri->segment(4);
    	$result       = $this->admin_model->checkNameExists($id,$this->house_month,$string);
    	if($result>0) {
        $this->form_validation->set_message('house_month_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}

// function to add house multi risk quote
	public function house_multi_risk_quote() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('user_id','Name','required');
			$this->form_validation->set_rules('insurer_quality_id', 'Insurer', 'required');		
			$this->form_validation->set_rules('room', 'Room', 'required');		
			$this->form_validation->set_rules('content_value', 'Content Value', 'required|trim');		
			$this->form_validation->set_rules('building_value', 'Building Value', 'required|trim');		
			$this->form_validation->set_rules('monthly_rent', 'Monthly Rent', 'required|trim');		
			$this->form_validation->set_rules('superficy', 'Superficy', 'required|trim');		
			$this->form_validation->set_rules('house_type_id', 'House Type', 'required|trim');		
			$this->form_validation->set_rules('house_category_id', 'House Category', 'required|trim');		
			$this->form_validation->set_rules('from', 'From', 'required|trim');		
			$this->form_validation->set_rules('to', 'To', 'required|trim');		
	
			if($this->form_validation->run() == FALSE) {   } else {	
				$data            = array(

					'user_id'			 =>	$this->input->post('user_id'),
					'insurer_quality_id' => $this->input->post('insurer_quality_id'),
					'room'               => $this->input->post('room'),				
					'monthly_rent'       => $this->input->post('monthly_rent'),
					'content_value'      => $this->input->post('content_value'),
					'building_value'     => $this->input->post('building_value'),
					'superficy'          => $this->input->post('superficy'),
					'house_type_id'      => $this->input->post('house_type_id'),
					'house_category_id'  => $this->input->post('house_category_id'),
					'month_id'           => $this->input->post('month_id'),
					'from'               => date('Y-m-d H:i:s',strtotime($this->input->post('from'))),
					'to'                 => date('Y-m-d H:i:s',strtotime($this->input->post('to'))),
					'risque_id'          => getHousingRisqueId(),
					'house_other_info'   => $this->input->post('house_other_info'),
					'created_date'       => date('Y-m-d H:i:s'),	
					'modified_date'      => date('Y-m-d H:i:s')	
				);
				$result              = $this->admin_model->getHouseTarificationData($data,'tbl_house_tarification');
				if (count($result)>0) {
					$id              = $this->admin_model->setInsertData('tbl_house_detail',$data);
						redirect('admin/housing_company_insurance/'.$id,'refresh');
					//$this->housing_company_insurance($result);
				}
				else {
					$this->session->set_flashdata('message','No records Available');
					redirect('admin/house-multi-risk-quote', 'refresh'); 
				}
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_type/get_house_multi_risk_quote');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function to get the housing company insurance
	function housing_company_insurance() {
		$house_detail_id         = $this->uri->segment(3);
		$house_detail            = $this->admin_model->getDataCollectionArrayByID('tbl_house_detail',$house_detail_id);
		$result              	 = $this->admin_model->getHouseTarificationData($house_detail,'tbl_house_tarification');
		$data['dataCollection']  = $result;
		$data['house_detail_id'] = $house_detail_id;
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/housing_insurance_company/housing_insurance_company_list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}	


// function for ajax to set the company house detail
	function set_company_house_detail() {
		CheckAdminLoginSession();
		$data = array(
					'company_selected' => $this->input->post('company_id'),
					'house_tarification_id' => $this->input->post('house_tarification_id'),
					);
		$id   = $this->input->post('house_detail_id');
		$updated_id = $this->admin_model->setUpdateData('tbl_house_detail',$data,$id);
		if ($updated_id) {
			echo $updated_id;
		}
		else {
			echo false;
		}
	}

//function to add the optional warranties for the selected company
	function optional_warranties() {
		CheckAdminLoginSession();
		$house_detail_id   = $this->uri->segment(4);
		$branch_id         = getHousingBranchId();
		$company_id        = getCompanyIdByHouseId($house_detail_id);
		$risque_id         = getRisqueIdByHouseId($house_detail_id);
		$post_data         = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_house_warranty', 'Optional warranty', 'required|trim');	
			if($this->form_validation->run() == FALSE) {  } else {
				$value_selected_house_warranty = explode(',', $this->input->post('value_selected_house_warranty'));
				foreach ($value_selected_house_warranty as $value) {
					$data = array(
						'optional_warranty_id'    => $value,
						'house_detail_id'         => $house_detail_id,
						'created_date'            => date('Y-m-d H:i:s'),
						'modified_date'           => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_warranty_house,$data);
				}
				$this->session->set_flashdata('message','Your House Optional Warranty has been added.');
		        redirect('admin/housing/select_optional_franchises/'.$house_detail_id,'refresh');
			}
		}
		$data['optional_warranties'] = $this->admin_model->getOptionalWarranties($company_id,$branch_id,$risque_id);
		// print_r($data['optional_warranties']);
		$data['house_detail_id']   = $house_detail_id;
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_type/optional_warranties',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

//function to add the optional franchise for the selected company
	function select_optional_franchises() {
		CheckAdminLoginSession();
		$house_detail_id   = $this->uri->segment(4);
		$branch_id         = getHousingBranchId();
		$company_id        = getCompanyIdByHouseId($house_detail_id);
		$post_data         = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_franchise_house', 'Optional Franchise', 'required|trim');	

			if($this->form_validation->run() == FALSE) {  } else {
				$value_selected_franchise_house = explode(',', $this->input->post('value_selected_franchise_house'));
				foreach ($value_selected_franchise_house as $value) {
					$data = array(
					'optional_franchise_id'   => $value,
					'house_detail_id'         => $house_detail_id,
					'created_date'            => date('Y-m-d H:i:s'),
					'modified_date'           => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_franchise_house,$data);
				}
				$this->session->set_flashdata('message','Your House Optional Franchise has been added.');
		        redirect('admin/housing/can_save_more/'.$house_detail_id,'refresh');
			}
		}
		$data['optional_franchies'] = $this->admin_model->getOptionalFranchices($company_id,$branch_id);
		$data['house_detail_id']   = $house_detail_id;
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_type/select_optional_franchises',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to show the different price range for each company
	function can_save_more() {
		CheckAdminLoginSession();
		$house_detail_id          = $this->uri->segment(4);
		$data['house_detail_id']  = $house_detail_id;
		$branch_id                = getHousingBranchId();
		$data['company_id']       = getCompanyIdByHouseId($house_detail_id);
		$data['selected_warranty_name_id'] = $this->admin_model->getWarrantiesSelectedHouse($house_detail_id);
		$data['selected_francise_name_id'] = $this->admin_model->getFranchisesSelectedHouse($house_detail_id);
		$post_data       = $this->input->post();     

		if(empty($this->input->post('company_id'))) {
			$data['companies_id'] = explode(',', $data['company_id']);
		}
		else {
			$data['companies_id'] = $this->input->post('company_id');
		}
		// print_r($data['companies_id']);
		$data['qwerty']       = getSelectedDatRecordsForSelectedCompanyForHouse($data['selected_warranty_name_id'],$data['companies_id'],$data['selected_francise_name_id'],$house_detail_id);
			

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_type/can_save_more',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to save the final details and the company
	function finalize_company(){
		CheckAdminLoginSession();
		$warranty           = $this->input->post('warranty');
		$franchise          = $this->input->post('franchise');
		$company_id         = $this->input->post('company_id');
		$house_detail_id    = $this->input->post('house_detail_id');

		$final_data         = getFinalForSelectedCompanyHouse( explode(',', $franchise),explode(',', $warranty) ,explode(',', $company_id),$house_detail_id);

		$user_id            	       = getUserIdFromInsuranceDetails($house_detail_id,$this->house_detail);

		foreach ($final_data as $value) {
			$data = array(
				'value'           => $value['value'],
				'type'            => $value['type'],
				'name'            => $value['name'],
				'company_id'      => $value['company_id'],
				'company_name'    => $value['company_name'],
				'house_detail_id' => $value['house_detail_id']
			);
			$this->admin_model->setInsertData($this->finalize_housing_insurance,$data);
		}

		$payment_data = array(
			'policy_number'     => getPolicyId(),
			'insurance_type_id' => 7,
			'user_id'           => $user_id,
			'company_id'        => $company_id,
			'insured_id'        => $house_detail_id,
			'payment_status'    => 0,
			'payment_method'    => 5, // no payment
			'policy_created_by' => 1,
            'policy_created_for' => getUserRoleIdByUserId($user_id),
            'policy_creater'     => $this->session->userdata('admin_id')
		);
		$this->admin_model->setInsertData('tbl_payment',$payment_data);

		echo 1;
		return true;	
	}

// function to get the finalize vehicle details
	function view_finalize_detail() {
		CheckAdminLoginSession();
		//$data = "";
		$house_detail_id        = $this->uri->segment(4);
		$user_id            	= getUserIdFromInsuranceDetails($house_detail_id,$this->house_detail);
		$data['company_id']     = getCompanyIdByHouseId($house_detail_id);
		$data['branch_id']      = getHousingBranchId();
		$policy_code 			= getPolicyCodeForCompany($data['company_id']);
		$post_data              = $this->input->post();
		if(!empty($post_data)) {
			$policy_prefix = $this->input->post('policy_prefix');
			if(empty($this->input->post('policy_prefix'))) {
				$policy_number = getAutogeneratedPolicyNumber($data['company_id']);
			} else {
				if(checkPolicyNumberExists($policy_code."/".$policy_prefix) > 0) {
					$this->session->set_flashdata('message','Policy Number Already Exists. Please Enter another Policy Number');
					redirect('admin/housing/view-finalize-detail/'.$house_detail_id);
				} else {
					$policy_number = $policy_code."/".$policy_prefix;
				}
			}
			$data_type = array (
				'net_premium'   => $this->input->post('net_premium'  ),
				'accessories'   => $this->input->post('accessories'),
				'tax'           => $this->input->post('tax'),
				'total_premium' => $this->input->post('total_premium')
			);
			foreach($data_type as $key => $value) {
				$record = array (
					'value'           => $value,
					'type'            => 'other_required_data',
					'name'            => $key,
					'company_id'      => $this->input->post('company_id'),
					'company_name'    => $this->input->post('company_name'),
					'house_detail_id' => $house_detail_id
				);
				$this->admin_model->setInsertData($this->finalize_housing_insurance,$record);
			}
			$insurance_type_id  = $this->input->post('insurance_type_id');
			/*$data = array (
				'user_id'			=> $user_id,
				'insured_id'        => $house_detail_id,
				'insurance_type_id' => $insurance_type_id,
				'amount'            => $this->input->post('total_premium'),
				'accessories_id'    => $this->input->post('accessories_id')
			);
			
			$this->session->set_userdata('user_payment_data',$data);
			redirect('admin/payment/proceed-to-pay/'.$house_detail_id,'refresh');*/
			$payment_id         = getPaymentIdByInsurerIdInsuranceType($house_detail_id,$insurance_type_id);
			$data_payment = array(
				'policy_number' => $policy_number,
	            'amount' 	    => $this->input->post('total_premium'),
	            'modified_date' => date("Y-m-d H:i:s")
	        );

        	$updated_payment_id = $this->admin_model->setUpdateData('tbl_payment', $data_payment, $payment_id);
			redirect('admin/questionaries/'.$updated_payment_id);
			//redirect('admin/payment/proceed-to-pay/'.$updated_payment_id);
		}


		$data['final_data']            = $this->admin_model->getFinalHouseInsuranceDetail($this->finalize_housing_insurance,$house_detail_id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_type/view_finalize_detail',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


	// function added by Shiv to get the house insurance policies
	public function house_policies() {
		CheckAdminLoginSession();
		$data['dataCollection'] = $this->admin_model->getPoliciesByInsuranceTypeId(7);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_type/house_policies',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	} 


	public function house_policy_detail() {
		CheckAdminLoginSession();
		$data['policy_number']       = $this->uri->segment(3);
		$data['house_detail_id']     = $this->uri->segment(4);
		$array_id 				     = array ('house_detail_id' => $data['house_detail_id']);
		$data['house_detail']        = $this->admin_model->getDataCollectionArrayByID($this->house_detail,$data['house_detail_id']);

		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$policy_number = $this->input->post('policy_number');
			if($policy_number == $data['policy_number']) {
				$house_details = array (
					'insurer_quality_id' => $this->input->post('insurer_quality_id'),
					'room'               => $this->input->post('room'),				
					'monthly_rent'       => $this->input->post('monthly_rent'),
					'content_value'      => $this->input->post('content_value'),
					'building_value'     => $this->input->post('building_value'),
					'superficy'          => $this->input->post('superficy'),
					'house_type_id'      => $this->input->post('house_type_id'),
					'house_category_id'  => $this->input->post('house_category_id'),
					'month_id'           => $this->input->post('month_id'),
					'risque_id'          => $data['house_detail']['risque_id'],
					'company_selected'   => $data['house_detail']['company_selected'],
					'modified_date'      => date('Y-m-d H:i:s')
				);

				$result              = $this->admin_model->getHouseTarificationDataForSelectedCompany($house_details,'tbl_house_tarification');
				
				if(count($result) > 0) {   
					$id = $this->admin_model->setUpdateData($this->house_detail,$house_details,$data['house_detail_id']);
					redirect('admin/house-policies-edit/'.$policy_number.'/'.$id);
				} else {
					$this->session->set_flashdata('message','No records Available');
					redirect('admin/house-policy-detail/'.$data['policy_number'].'/'.$data['house_detail_id'], 'refresh');
				}
			} else {
				$house_details_to_insert = array (
					'user_id'               => $data['house_detail']['user_id'],
					'insurer_quality_id'    => $this->input->post('insurer_quality_id'),
					'room'                  => $this->input->post('room'),				
					'monthly_rent'          => $this->input->post('monthly_rent'),
					'content_value'         => $this->input->post('content_value'),
					'building_value'        => $this->input->post('building_value'),
					'superficy'             => $this->input->post('superficy'),
					'house_type_id'         => $this->input->post('house_type_id'),   
					'house_category_id'     => $this->input->post('house_category_id'),
					'month_id'              => $this->input->post('month_id'),
					'from'                  => $data['house_detail']['from'],
					'to'                    => $data['house_detail']['to'],
					'risque_id'             => $data['house_detail']['risque_id'],
					'company_selected'      => $data['house_detail']['company_selected'],
					'house_tarification_id' => $data['house_detail']['house_tarification_id'],
					'house_other_info'      => $data['house_detail']['house_other_info'],
					'created_date'          => date('Y-m-d H:i:s'),
					'modified_date'         => date('Y-m-d H:i:s')
				);
				$result              = $this->admin_model->getHouseTarificationDataForSelectedCompany($house_details_to_insert,'tbl_house_tarification');

				if(count($result) > 0) {
					$house_insurance_old_info = array (
						'old_policy_number' => $data['policy_number'],
						'old_insured_id'    => $data['house_detail_id']
					);   
					$this->session->set_userdata('old_house_insurance_info',$house_insurance_old_info);
					$id = $this->admin_model->setInsertData($this->house_detail,$house_details_to_insert);
					redirect('admin/house-policies-edit/'.$policy_number.'/'.$id);
				} else {
					$this->session->set_flashdata('message','No records Available');
					redirect('admin/house-policy-detail/'.$data['policy_number'].'/'.$data['house_detail_id'], 'refresh');
				}
			}
		}
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_type/house_policy_detail',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



	// function added by Shiv to edit the house insurance policy
	public function house_policies_edit() {
		CheckAdminLoginSession();
		$house_old_info = $this->session->userdata('old_house_insurance_info');
		$data['policy_number']       = $this->uri->segment(3);
		$data['house_detail_id']     = $this->uri->segment(4);
		$data['branch_id']           = getHousingBranchId();
		$data['company_id']          = getCompanyIdByHouseId($data['house_detail_id']);
		$data['risque_id']           = getRisqueIdByHouseId($data['house_detail_id']);
		$array_id 				     = array ('house_detail_id' => $data['house_detail_id']);
		$company_array[0]            = $data['company_id'];
		$data['optional_warranties'] = $this->admin_model->getOptionalWarranties($data['company_id'],$data['branch_id'],$data['risque_id']);


		if(!empty($house_old_info)) {
			$data['selected_warranties'] = getSelectedOptionalWarranties($this->selected_optional_warranty_house,array ('house_detail_id' => $house_old_info['old_insured_id']));
			$data['selected_franchises'] = getSelectedOptionalFranchises($this->selected_optional_franchise_house,array ('house_detail_id' => $house_old_info['old_insured_id']));
		} else {
			$data['selected_warranties'] = getSelectedOptionalWarranties($this->selected_optional_warranty_house,$array_id);
			$data['selected_franchises'] = getSelectedOptionalFranchises($this->selected_optional_franchise_house,$array_id);	
		}
		$data['house_detail']        = $this->admin_model->getDataCollectionArrayByID($this->house_detail,$data['house_detail_id']);

		$data['house_insurance_company'] = $this->admin_model->getHouseTarificationDataForSelectedCompany($data['house_detail'],'tbl_house_tarification');
		
		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('house_tarification_id', 'Amount', 'required|trim');
			if($this->form_validation->run() == FALSE) {} else {
				$policy_number 		 = $this->input->post('policy_number');
				$optional_warranties = $this->input->post('optional_warranties_house');
				$optional_franchises = $this->input->post('optional_franchises_house');
				if($policy_number == $data['policy_number']) {

					if(empty($house_old_info)) {

						// Update the amount of the company
						$house_detail_to_update = array (
							'house_tarification_id' => $this->input->post('house_tarification_id'),
							'modified_date'         => date('Y-m-d H:i:s')
						);
						$this->admin_model->setUpdateData($this->house_detail,$house_detail_to_update,$data['house_detail_id']);


						// Delete Optional Warranties
						$this->admin_model->deleteOptionalWarranties($this->selected_optional_warranty_house,$array_id);

						// Insert Optional Warranties
						foreach ($optional_warranties as $value) {
							$inserted_warranties = array(
								'optional_warranty_id' => $value,
								'house_detail_id'      => $data['house_detail_id'],
								'created_date'         => date('Y-m-d H:i:s'),
								'modified_date'        => date('Y-m-d H:i:s')
							);
							$id                = $this->admin_model->setInsertData($this->selected_optional_warranty_house,$inserted_warranties);
						}


						// Delete Optional Franchises
						$this->admin_model->deleteOptionalFranchises($this->selected_optional_franchise_house,$array_id);


						// Insert Optional Franchises
						foreach ($optional_franchises as $value) {
							$inserted_franchises = array(
								'optional_franchise_id' => $value,
								'house_detail_id'       => $data['house_detail_id'],
								'created_date'          => date('Y-m-d H:i:s'),
								'modified_date'         => date('Y-m-d H:i:s')
							);
							$id                = $this->admin_model->setInsertData($this->selected_optional_franchise_house,$inserted_franchises);
						}

						$data['selected_warranty_name_id']        = $this->admin_model->getWarrantiesSelectedHouse($data['house_detail_id']);
						$data['selected_franchise_name_id']        = $this->admin_model->getFranchisesSelectedHouse($data['house_detail_id']);
						
						// Delete finalized data
						$this->admin_model->deleteFinalizedData($this->finalize_housing_insurance,$array_id);

						// Insert Finalized Data
						$final_data = getFinalForSelectedCompanyHouse($data['selected_franchise_name_id'],$data['selected_warranty_name_id'],$company_array,$data['house_detail_id']);

						foreach ($final_data as $value) {
							$data_final = array(
								'value'           => $value['value'],
								'type'            => $value['type'],
								'name'            => $value['name'],
								'company_id'      => $value['company_id'],
								'company_name'    => $value['company_name'],
								'house_detail_id' => $value['house_detail_id']
							);
							$this->admin_model->setInsertData($this->finalize_housing_insurance,$data_final);
						}

						// Get the inserted finalized data
						$data['finalized_details']              = $this->admin_model->getFinalHouseInsuranceDetail($this->finalize_housing_insurance,$data['house_detail_id']);

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
					      else if($record->type == 'required_data') {
					        $total_amount +=$record->value;
					        $required_data[] = $record->name;
					      }
					      else if($record->type == 'required_data') {
					        $total_amount +=$record->value;
					      }     
					    }

					    $accessories_id    = getAccessoriesId($total_amount,$data['company_id'],$data['branch_id']);
					   	$accessories_value = getAccessoriesValue($total_amount,$data['company_id'],$data['branch_id']);
						$tax_amount        = getTaxAmount(($accessories_value + $estimation_amount + $person_amount),$data['company_id'],$data['branch_id']);
					   	$total_premium     = $total_amount + $accessories_value + $tax_amount;

					   	// Inserting the finalized data
					   	$finalized_data_type = array (
							'net_premium'   => $total_amount,
							'accessories'   => $accessories_value,
							'tax'           => $tax_amount,
							'total_premium' => $total_premium
						);

						foreach($finalized_data_type as $key => $value) {
							$record = array (
								'value'           => $value,
								'type'            => 'other_required_data',
								'name'            => $key,
								'company_id'      => $data['company_id'],
								'company_name'    => getCompanyName($data['company_id']),
								'house_detail_id' => $data['house_detail_id']
							);
							$this->admin_model->setInsertData($this->finalize_housing_insurance,$record);
						}

						// Update Data into Payment Table
						$payment_id = getPaymentIdByInsurerIdInsuranceType($data['house_detail_id'],7);
						$payment_details = $this->admin_model->getDataCollectionByID('tbl_payment',$payment_id);
						$old_payment_amount = $payment_details->amount;
						$payment_data = array (
							'amount'		=> $total_premium,
							'modified_date' => date("Y-m-d H:i:s")
						);
						$update_payment_id = $this->admin_model->setUpdateData('tbl_payment',$payment_data,$payment_id);

						// Update Data into Quittance Table
						$insurance_details = getFinalizedInsuranceDetails($data['house_detail_id'],7);
						$accessories_data  = getAccessoriesAmountShare($accessories_id);
						$quittance_id      = getQuittanceId($policy_number);
						
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
				
						$updated_quittance_id      = $this->admin_model->setUpdateData('tbl_quittance',$quittance_data,$quittance_id);
						$updated_insurance_details = $this->admin_model->getDataCollectionByID('tbl_quittance',$updated_quittance_id);
						
						// Calculating Difference of Old and New Amount
						$amount_difference = ($updated_insurance_details->total_amount - $old_payment_amount);
					} else {
						
						// Update the amount of the company
						$house_detail_to_update = array (
							'house_tarification_id' => $this->input->post('house_tarification_id'),
							'modified_date'         => date('Y-m-d H:i:s')
						);
						$this->admin_model->setUpdateData($this->house_detail,$house_detail_to_update,$data['house_detail_id']);


						// Insert Optional Warranties
						foreach ($optional_warranties as $value) {
							$inserted_warranties = array(
								'optional_warranty_id' => $value,
								'house_detail_id'      => $data['house_detail_id'],
								'created_date'         => date('Y-m-d H:i:s'),
								'modified_date'        => date('Y-m-d H:i:s')
							);
							$id                = $this->admin_model->setInsertData($this->selected_optional_warranty_house,$inserted_warranties);
						}

						// Insert Optional Franchises
						foreach ($optional_franchises as $value) {
							$inserted_franchises = array(
								'optional_franchise_id' => $value,
								'house_detail_id'       => $data['house_detail_id'],
								'created_date'          => date('Y-m-d H:i:s'),
								'modified_date'         => date('Y-m-d H:i:s')
							);
							$id                = $this->admin_model->setInsertData($this->selected_optional_franchise_house,$inserted_franchises);
						}


						$data['selected_warranty_name_id']        = $this->admin_model->getWarrantiesSelectedHouse($data['house_detail_id']);


						$data['selected_franchise_name_id']        = $this->admin_model->getFranchisesSelectedHouse($data['house_detail_id']);

						// Insert Finalized Data
						$final_data = getFinalForSelectedCompanyHouse($data['selected_franchise_name_id'],$data['selected_warranty_name_id'],$company_array,$data['house_detail_id']);

						foreach ($final_data as $value) {
							$data_final = array(
								'value'           => $value['value'],
								'type'            => $value['type'],
								'name'            => $value['name'],
								'company_id'      => $value['company_id'],
								'company_name'    => $value['company_name'],
								'house_detail_id' => $value['house_detail_id']
							);

							$this->admin_model->setInsertData($this->finalize_housing_insurance,$data_final);
						}


						// Get the inserted finalized data
						$data['finalized_details']              = $this->admin_model->getFinalHouseInsuranceDetail($this->finalize_housing_insurance,$data['house_detail_id']);
						

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
					      else if($record->type == 'required_data') {
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
						$tax_amount        = getTaxAmount($accessories_value + $total_amount);
						$total_premium     = $total_amount + $accessories_value + $tax_amount;


						$finalized_data_type = array (
							'net_premium'   => $total_amount,
							'accessories'   => $accessories_value,
							'tax'           => $tax_amount,
							'total_premium' => $total_premium
						);


						foreach($finalized_data_type as $key => $value) {
							$record = array (
								'value'           => $value,
								'type'            => 'other_required_data',
								'name'            => $key,
								'company_id'      => $data['company_id'],
								'company_name'    => getCompanyName($data['company_id']),
								'house_detail_id' => $data['house_detail_id']
							);
							$this->admin_model->setInsertData($this->finalize_housing_insurance,$record);
						}

						// Insert Data into Payment Table
						$old_payment_id = getPaymentIdByInsurerIdInsuranceType($house_old_info['old_insured_id'],7);
						
						$old_payment_details = $this->admin_model->getDataCollectionByID('tbl_payment',$old_payment_id);
						$old_payment_amount = $old_payment_details->amount;
						

						$payment_data_to_insert = array (
							'policy_number'     => checkUniquePolicyId($policy_number),
							'insurance_type_id' => 7,
							'user_id'           => $old_payment_details->user_id,
							'company_id'        => $old_payment_details->company_id,
							'insured_id'        => $data['house_detail_id'],
							'payment_status'    => $old_payment_details->payment_status,
							'payment_method'    => $old_payment_details->payment_method, // no payment
							'created_date'      => date('Y-m-d H:i:s'),
							'modified_date'     => date('Y-m-d H:i:s')
						);

						$new_payment_id = $this->admin_model->setInsertData('tbl_payment',$payment_data_to_insert);
						$payment_amount_data = array (
							'amount'		=> $total_premium,
							'modified_date' => date("Y-m-d H:i:s")
						);
						$update_payment_id = $this->admin_model->setUpdateData('tbl_payment',$payment_amount_data,$new_payment_id);
						$new_payment_details   = $this->admin_model->getDataCollectionByID('tbl_payment',$update_payment_id);

						// Getting Old Quittance Data
						$old_quittance_id      = getQuittanceId($house_old_info['old_policy_number']);
						$old_quittance_details = $this->admin_model->getDataCollectionByID('tbl_quittance',$old_quittance_id);
						$new_insurance_details = getFinalizedInsuranceDetails($data['house_detail_id'],7);


						// Getting Accessories Data
						$accessories_id    = getAccessoriesId($new_insurance_details['net_premium'],$data['company_id'],$data['branch_id']);
						$accessories_value = getAccessoriesValue($new_insurance_details['net_premium'],$data['company_id'],$data['branch_id']);
						$new_accessories_data  = getAccessoriesAmountShare($accessories_id);


						// Insert Data into Quittance Table
						$quittance_data_to_insert    = array (		
							'policy_number'             => $new_payment_details->policy_number,
							'company_id'                => $data['company_id'],
							'branch_id'                 => $data['branch_id'],
							'risque_id'                 => $data['risque_id'],
							'user_id'                   => $old_quittance_details->user_id,
							'amount'                    => $new_insurance_details['net_premium'],
							'tax'                       => $new_insurance_details['tax'],	
							'accessories'               => $accessories_value,
							'accessories_id'            => $accessories_id,
							'accessories_admin_share'   => $new_accessories_data['accessories_admin_share'],
							'accessories_company_share' => $new_accessories_data['accessories_company_share'],
							'total_amount'              => $new_insurance_details['total_premium'],
							'policy_start_date'         => $new_insurance_details['policy_start_date'],
							'policy_end_date'           => $new_insurance_details['policy_end_date'],
							'created_date'              => date('Y-m-d H:i:s'),
							'modified_date'             => date('Y-m-d H:i:s'),
							'status'                    => 0
						); 
						$updated_quittance_id = $this->admin_model->setInsertData('tbl_quittance',$quittance_data_to_insert);
						$new_quittance_details = $this->admin_model->getDataCollectionByID('tbl_quittance',$updated_quittance_id);


						// Calculating Difference of Old and New Amount
						$amount_difference = ($new_quittance_details->total_amount - $old_payment_amount);
					}

					$this->session->unset_userdata('old_house_insurance_info');
				} 

				if($amount_difference > 0) {
					$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You have to pay the amount of ".abs($amount_difference)." to the Admin";
				} else if($amount_difference < 0){
					$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You have to recieve the amount of <b>".abs($amount_difference)."</b> from the Admin";
				} else {
					$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You don't have to pay/recieve any amount from the Admin";
				}
				// $amount_difference = diffPolicyTotalAmount($old_payment_amount,$insurance_details['total_premium']);
				$user_id            	     = getUserIdFromInsuranceDetails($data['house_detail_id'],$this->house_detail);
				
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
					'{{insurance_type}}'          =>  getInsuranceType(7).' INSURANCE',
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
					'{{insurance_type}}'          =>  getInsuranceType(7).' INSURANCE',
					'{{policy_number}}'           =>  $data['policy_number'],
					'{{amount_difference}}'       =>  $admin_amount_message,
					'{{email}}'                   => getAdminEmail()
				);
				$admin_message     = email_compose($admin_email_template,$admin_templateTags);
				$admin_email       = getAdminEmail();
				$admin_subject     = SEND_POLICY_UPDATION_MAIL;
				if (send_smtp_mail($admin_email,$admin_subject,$admin_message)) {
					$this->session->set_flashdata('message',POLICY_UPDATE_SUCCESS_MESSAGE);
		        	redirect('admin/house-policies','refresh');
				}
			}	
		}

 		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/house_type/house_policies_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	// function to get Risque By Branch Id of risque

	public function getHousingRisqueByBranchId() {
        $data    = '';
        $data    = 'class="control-group  " id="risque_by_branch" ';
        $result  =  form_dropdown('risque_id', getHousingRisqueByBranchId($this->input->post('branch_id')),set_value('risque_id'),$data); 
        print_r($result);
        // return $result;
	}

}
