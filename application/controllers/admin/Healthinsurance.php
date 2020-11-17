<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Healthinsurance extends CI_Controller {

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

	public $health_insurance 		          = 'tbl_health_insurance';
	public $health_insurance_details 	      = 'tbl_health_insurance_details';
	public $health_insurance_person_details   = 'tbl_health_insurance_person_details';
	public $health_insurance_quote        	  = 'tbl_health_insurance_quote';
	public $health_insurance_finalize_company = 'tbl_health_insurance_finalize_company';
	


// function to show the list of Health Insurance
	public function health_insurance_conditions_lists() {
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
        $totalCount             = $this->admin_model->totalRecord($this->health_insurance);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->health_insurance,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/healthinsurance/condition_lists',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


//function to add the Health Insurance condition 
	public function health_insurance_conditions_add() {
        CheckAdminLoginSession();	   	
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required');		
			$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');		
			$this->form_validation->set_rules('company_id', 'Company', 'required');		
			$this->form_validation->set_rules('branch_id', 'Branch', 'required');		
			$this->form_validation->set_rules('risque_id', 'Risque', 'required');		
			$this->form_validation->set_rules('description', 'Description', 'required');		

			if($this->form_validation->run() == FALSE) {   } else {
				$data            	  = array(
					'name'            => $this->input->post('name'),
					'amount'          => $this->input->post('amount'),
					'company_id'      => $this->input->post('company_id'),	
					'branch_id'       => $this->input->post('branch_id'),
					'risque_id'       => $this->input->post('risque_id'),
					'description'     => $this->input->post('description'),
					'status'          => $this->input->post('status'),
					'created_date'    => date("Y-m-d H:i:s"),
					'modified_date'   => date("Y-m-d H:i:s"),
				);
				$id      = $this->admin_model->setInsertData($this->health_insurance,$data);
				if($id > 0) {
				$this->session->set_flashdata('message','Your Health Insurance Examination has been added successfully');
		        redirect('admin/health-insurance-conditions/lists','refresh');
				}
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/healthinsurance/condition_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function to edit a Health Insurance conditions
	public function health_insurance_conditions_edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		$checked_password  = $this->input->post('checked_password');
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required');		
			$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');	
			$this->form_validation->set_rules('company_id', 'Company', 'required');		
			$this->form_validation->set_rules('branch_id', 'Branch', 'required');		
			$this->form_validation->set_rules('risque_id', 'Risque', 'required');		
			$this->form_validation->set_rules('description', 'Description', 'required');		
								
			if($this->form_validation->run() == FALSE) {   } else {			
				$data            = array(									
					'name'            => $this->input->post('name'),
					'amount'          => $this->input->post('amount'),
					'company_id'      => $this->input->post('company_id'),		
					'branch_id'       => $this->input->post('branch_id'),
					'risque_id'       => $this->input->post('risque_id'),
					'description'     => $this->input->post('description'),
					'status'          => $this->input->post('status'),
					'modified_date'   => date("Y-m-d H:i:s"),
				);

				$id              = $this->admin_model->setUpdateData($this->health_insurance,$data,$id);
				$this->session->set_flashdata('message','Your Health Insurance Examination has been updated successfully');
		        redirect('admin/health-insurance-conditions/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->health_insurance,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/healthinsurance/condition_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}	


// function to delete a Health Insurance Condition

	public function health_insurance_conditions_delete() {
		CheckAdminLoginSession();
		$id=$this->uri->segment(4);
		$this->admin_model->dataDelete($this->health_insurance,$id);
		$this->session->set_flashdata('message','Your Health Insurance Condition has been deleted successfully');
        redirect('admin/health-insurance-conditions/lists','refresh');
	}

// function to change status of Health Insurance Condition

	public function health_insurance_conditions_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->health_insurance,$data,$id);
		$this->session->set_flashdata('message','Your status has been updated successfully');
		redirect('admin/health-insurance-conditions/lists','refresh');		
	}




// function to get the list of Health Insurance quote
	public function health_insurance_quote() {
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
        $totalCount             = $this->admin_model->totalRecord($this->health_insurance_quote);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->health_insurance_quote,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/healthinsurance/health_insurance_quote',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to add the Health Insurance quote
	public function health_insurance_quote_add() {
        CheckAdminLoginSession();	   	
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       

			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');	
			$this->form_validation->set_rules('company_id', 'Company', 'required');		
			$this->form_validation->set_rules('zone_id', 'Zone', 'required');
			$this->form_validation->set_rules('min_days', 'Minimum Days', 'required|numeric');		
			$this->form_validation->set_rules('max_days', 'Maximum Days', 'required|numeric');		
			$this->form_validation->set_rules('area_id', 'Area', 'required');		
			$this->form_validation->set_rules('child_below_age', 'Child Below Age', 'required|numeric');		
			$this->form_validation->set_rules('amount_child_below_age', 'Amount Child Below Age', 'required|numeric');		
			$this->form_validation->set_rules('adult_above_age', 'Adult Above Age', 'required|numeric');		
			$this->form_validation->set_rules('amount_adult_above_age', 'Amount Adult Above Age', 'required|numeric');		
			$this->form_validation->set_rules('surprime_above_age', 'Surprime Above Age', 'required|numeric');		
			$this->form_validation->set_rules('amount_surprime_above_age', 'Amount Surprime Above Age', 'required|numeric');		
			$this->form_validation->set_rules('description', 'Description', 'required');		
			if($this->form_validation->run() == FALSE) {   } else {
				
				$data            = array(									
					'company_id'          		 => $this->input->post('company_id'),		
					'zone_id'             		 => $this->input->post('zone_id'),		
					'min_days'            		 => $this->input->post('min_days'),		
					'max_days'            		 => $this->input->post('max_days'),		
					'area'                		 => $this->input->post('area_id'),		
					'amount'              		 => $this->input->post('amount'),		
					'child_below_age'     		 => $this->input->post('child_below_age'),		
					'amount_child_below_age'     => $this->input->post('amount_child_below_age'),		
					'adult_above_age'            => $this->input->post('adult_above_age'),		
					'amount_adult_above_age'     => $this->input->post('amount_adult_above_age'),		
					'surprime_above_age'         => $this->input->post('surprime_above_age'),
					'amount_surprime_above_age'  => $this->input->post('amount_surprime_above_age'),
					'description'                => $this->input->post('description'),
					'status'                     => $this->input->post('status'),
					'created_date'               => date("Y-m-d H:i:s"),
					'modified_date'              => date("Y-m-d H:i:s")
				);
				$id      = $this->admin_model->setInsertData($this->health_insurance_quote,$data);
				$this->session->set_flashdata('message','Your Health Insurance Quote has been added successfully');
		        redirect('admin/health-insurance-quote/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/healthinsurance/health_insurance_quote_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit a health insurance quote
	public function health_insurance_quote_edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		$checked_password  = $this->input->post('checked_password');
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('company_id', 'Company', 'required');		
			$this->form_validation->set_rules('zone_id', 'Zone', 'required');
			$this->form_validation->set_rules('min_days', 'Minimum Days', 'required|numeric');		
			$this->form_validation->set_rules('max_days', 'Maximum Days', 'required|numeric');		
			$this->form_validation->set_rules('area_id', 'Area', 'required');		
			$this->form_validation->set_rules('child_below_age', 'Child Below Age', 'required|numeric');		
			$this->form_validation->set_rules('amount_child_below_age', 'Amount Child Below Age', 'required|numeric');		
			$this->form_validation->set_rules('adult_above_age', 'Adult Above Age', 'required|numeric');		
			$this->form_validation->set_rules('amount_adult_above_age', 'Amount Adult Above Age', 'required|numeric');		
			$this->form_validation->set_rules('surprime_above_age', 'Surprime Above Age', 'required|numeric');		
			$this->form_validation->set_rules('amount_surprime_above_age', 'Amount Surprime Above Age', 'required|numeric');	
			$this->form_validation->set_rules('description', 'Description', 'required');		
								
			if($this->form_validation->run() == FALSE) {   } else {			
				$data            = array(									
					'company_id'          		 => $this->input->post('company_id'),		
					'zone_id'             		 => $this->input->post('zone_id'),		
					'min_days'            		 => $this->input->post('min_days'),		
					'max_days'            		 => $this->input->post('max_days'),		
					'area'                		 => $this->input->post('area_id'),		
					'amount'              		 => $this->input->post('amount'),		
					'child_below_age'     		 => $this->input->post('child_below_age'),		
					'amount_child_below_age'     => $this->input->post('amount_child_below_age'),		
					'adult_above_age'     		 => $this->input->post('adult_above_age'),		
					'amount_adult_above_age'     => $this->input->post('amount_adult_above_age'),		
					'surprime_above_age'  		 => $this->input->post('surprime_above_age'),
					'amount_surprime_above_age'  => $this->input->post('amount_surprime_above_age'),
					'description'         		 => $this->input->post('description'),
					'status'              		 => $this->input->post('status'),
					'modified_date'      		 => date("Y-m-d H:i:s")
				);

				$id              = $this->admin_model->setUpdateData($this->health_insurance_quote,$data,$id);
				$this->session->set_flashdata('message','Your Health Insurance Quote has been updated successfully');
		        redirect('admin/health-insurance-quote/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->health_insurance_quote,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/healthinsurance/health_insurance_quote_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete a Health Insurance Quote

	public function health_insurance_quote_delete() {
		CheckAdminLoginSession();
		$id=$this->uri->segment(4);
		$this->admin_model->dataDelete($this->health_insurance_quote,$id);
		$this->session->set_flashdata('message','Your Health Insurance Quote has been deleted successfully');
        redirect('admin/health-insurance-quote/lists','refresh');
	}

// function to change status of Health 	Insurance Quote

	public function health_insurance_quote_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->health_insurance_quote,$data,$id);
		$this->session->set_flashdata('message','Your status has been updated successfully');
		redirect('admin/health-insurance-quote/lists','refresh');		
	}




// function to add a policy covrerage area

	public function health_insurance_getquote() {
        CheckAdminLoginSession();		
		$post_data           = $this->input->post();
		$health_insurance_id = $this->uri->segment(3); 
		if(!empty($post_data)) {//print_r($post_data);die;
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('user_id','Name','required');
			$this->form_validation->set_rules('health_insurance_type_id', 'Health Insurance Type', 'required|trim');
			if($post_data['health_insurance_type_id'] == 1) {
				$this->form_validation->set_rules('name_of_chief', 'Name', 'required|trim');
				$this->form_validation->set_rules('age_of_chief', 'Age of Person', 'required|trim');
				$this->form_validation->set_rules('persons_insured', 'No Of Persons to be Insured', 'required|trim');

				for($i = 1; $i <= $post_data['persons_insured'];$i++) {
					$this->form_validation->set_rules('full_name_'.$i, 'Full Name', 'required');
					$this->form_validation->set_rules('age_of_each_person_'.$i, 'Age of Person', 'required');
				}
			} else if($post_data['health_insurance_type_id'] == 2) {
				$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
				$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
				$this->form_validation->set_rules('age_person', 'Age Of Person', 'required|trim');
			} 
			$this->form_validation->set_rules('start_date', 'Start Date', 'required|trim');
			$this->form_validation->set_rules('end_date', 'End Date', 'required|trim');
			$this->form_validation->set_rules('policy_coverage_area_id', 'Policy Coverage Area', 'required|trim');
			
			$this->form_validation->set_rules('claim_reimbursement_rate', 'Claim Reimbursement Rate', 'required|trim|numeric');
			$this->form_validation->set_rules('amount_to_pay', 'Amount To Pay Rate', 'required|trim|numeric');

			if($this->form_validation->run() == FALSE) {   } else {
				//$slug            = $this->input->post('name');
				if($post_data['health_insurance_type_id'] == 2) {
					$data            = array(
						'user_id'                      => $this->input->post('user_id'),                
						'health_insurance_type_id'     => $this->input->post('health_insurance_type_id'),
						'first_name'      			   => $this->input->post('first_name'),	
						'last_name'       			   => $this->input->post('last_name'),
						'age_person'   			   	   => date("Y-m-d H:i:s",strtotime($this->input->post('age_person'))),
						'age'                          => date("Y-m-d H:i:s") - date("Y-m-d H:i:s",strtotime($this->input->post('age_person'))),
						'start_date'      			   => date("Y-m-d H:i:s",strtotime($this->input->post('start_date'))),
						'end_date'      			   => date("Y-m-d H:i:s",strtotime($this->input->post('end_date'))),
						'policy_coverage_area_id'      => $this->input->post('policy_coverage_area_id'),	
						'claim_reimbursement_rate'     => $this->input->post('claim_reimbursement_rate'),
						'amount_to_pay' 			   => $this->input->post('amount_to_pay')
					);	
				} else if($post_data['health_insurance_type_id'] == 1) {
					$data = array (
						'user_id'                      => $this->input->post('user_id'),
						'health_insurance_type_id'     => $this->input->post('health_insurance_type_id'),
						'name_of_chief'      		   => $this->input->post('name_of_chief'),	
						'age_of_chief'       		   => date("Y-m-d H:i:s",strtotime($post_data['age_of_chief'])),
						'age'           			   => date("Y-m-d H:i:s") - date("Y-m-d H:i:s",strtotime($this->input->post('age_of_chief'))),
						'persons_insured'   		   => $this->input->post('persons_insured'),
						'start_date'      			   => date("Y-m-d H:i:s",strtotime($this->input->post('start_date'))),
						'end_date'      			   => date("Y-m-d H:i:s",strtotime($this->input->post('end_date'))),
						'policy_coverage_area_id'      => $this->input->post('policy_coverage_area_id'),	
						'claim_reimbursement_rate'     => $this->input->post('claim_reimbursement_rate'),
						'amount_to_pay' 			   => $this->input->post('amount_to_pay')
					);	
				}
				$id               = $this->admin_model->setInsertData($this->health_insurance_details,$data);
				if ($id > 0 && $post_data['health_insurance_type_id'] == 1) {
					
						for($i = 1; $i <= $post_data['persons_insured']; $i++) {
							$person_details = array (
								'persons_insured_id' => $id,
								'full_name'    => $post_data['full_name_'.$i],
								'age_of_each_person' => date("Y-m-d H:i:s",strtotime($post_data['age_of_each_person_'.$i])),
								'age'           => date("Y-m-d H:i:s") - date("Y-m-d H:i:s",strtotime($post_data['age_of_each_person_'.$i]))
							);
							$this->admin_model->setInsertData($this->health_insurance_person_details, $person_details);
						}
				}
		        redirect('admin/health-insurance/get-estimation/'.$id,'refresh');
		    }
        }

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/healthinsurance/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function added by Shiv to get Rate and Amount by Policy Coverage Area

	public function getDataByPolicyCoveargeAreaId() {
        $data    = '';
        $data    = 'class="control-group" id="claim_reimbursement_rate" ';
        $rate    =  form_dropdown('claim_reimbursement_rate', getRateByPolicyCoveargeAreaId($this->input->post('policy_coverage_area_id')),set_value('claim_reimbursement_rate'),$data);
        $amount  = getAmountByPolicyCoveargeAreaId($this->input->post('policy_coverage_area_id')); 
        $result  = print json_encode(array (
        	'rate'   => $rate,
        	'amount' => $amount
        ));
        return $result;
	}


	// function to added by Shiv to get the estimation price for Health Insurance
	public function get_estimation() {
		$data['health_insurance_id']              = $this->uri->segment(4);
		$health_insurance_examination_list_array  = getHealthInsuranceExaminationList();
		$company_array                            = getCompanyIds();
		$data['qwerty']                           = getHealthInsuranceCompanyComparision($health_insurance_examination_list_array,$company_array);
		$data['policy_coverage_area_id']          = getPolicyCoveargeAreaIdByHealthInsuranceId($data['health_insurance_id']);
		$data['claim_reimbursement_rate_details'] = getClaimReimbursementRateIdByPolicyCoveargeAreaId($data['policy_coverage_area_id']);
		$data['claim_reimbursement_rate_array']   = getClaimReimbursementRates($health_insurance_examination_list_array,$data['claim_reimbursement_rate_details'],$company_array);

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/healthinsurance/get_health_insurance_estimation',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function added by Shiv to get finalize company for Health Insurance
	public function finalize_company() {
		$company_id          = $this->input->post('company_id');
		$health_insurance_id = $this->input->post('health_insurance_id');
		$record              = $this->admin_model->getDataOfHealthInsuranceToInsertForSelectedCompany($company_id);
		$user_id             = getUserIdFromInsuranceDetails($health_insurance_id,$this->health_insurance_details);
		foreach ($record as $key => $value) {
			$data = array(
				'health_insurance_id' => $health_insurance_id,
				'name'          	  => $value->name,
				'amount'         	  => $value->amount,
				'company_id'     	  => $value->company_id,
				'company_name'   	  => getCompanyName($value->company_id),
				'branch_id'      	  => $value->branch_id,
				'branch_name'    	  => getBranchName($value->branch_id),
				'risque_name'   	  => getRisqueName($value->risque_id),
				'description'    	  => $value->description
			);
			$this->admin_model->setInsertData($this->health_insurance_finalize_company, $data);
		}

		$payment_data = array(
			'policy_number'     => getPolicyId(),
			'insurance_type_id' => 2,
			'user_id'           => $user_id,
			'company_id'        => $company_id,
			'insured_id'        => $health_insurance_id,
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


// function added by Shiv to view finalize detail
	public function view_finalize_detail() {
		$health_insurance_id = $this->uri->segment(4);
		$user_id             = getUserIdFromInsuranceDetails($health_insurance_id,$this->health_insurance_details);
		$data['branch_id']   = getBranchIdByHealthInsuranceId($health_insurance_id);
		$data['company_id']  = getCompanyIdByHealthInsuranceId($health_insurance_id);
		$data['risque_name'] = getRisqueNameByHealthInsuranceId($health_insurance_id);
		$policy_code     	 = getPolicyCodeForCompany($data['company_id']);
		$post_data           = $this->input->post();
		if(!empty($post_data)) {
			$policy_code   = $this->input->post('policy_code');
			$policy_prefix = $this->input->post('policy_prefix');
			if(empty($this->input->post('policy_prefix'))) {
				$policy_number = getAutogeneratedPolicyNumber($data['company_id']);
			} else {
				if(checkPolicyNumberExists($policy_code."/".$policy_prefix) > 0) {
					$this->session->set_flashdata('message','Policy Number Already Exists. Please Enter another Policy Number');
					redirect('admin/health-insurance/view-finalize-detail/'.$health_insurance_id);
				} else {
					$policy_number = $policy_code."/".$policy_prefix;
				}
			}
			$data_type = array (
				'person_amount'     => $this->input->post('person_amount'),
				'estimation_amount' => $this->input->post('estimation_amount'),
				'net_premium'       => $this->input->post('net_premium'  ),
				'accessories'       => $this->input->post('accessories'),
				'tax'               => $this->input->post('tax'),
				'total_premium'     => $this->input->post('total_premium')
			);

			foreach($data_type as $key => $value) {
				$record = array(
					'health_insurance_id' => $health_insurance_id,
					'name'          	  => $key,
					'amount'         	  => $value,
					'company_id'     	  => $data['company_id'],
					'company_name'   	  => getCompanyName($data['company_id']),
					'branch_id'      	  => $data['branch_id'],
					'branch_name'    	  => getBranchName($data['branch_id']),
					'risque_name'         => $data['risque_name']
				);
				$this->admin_model->setInsertData($this->health_insurance_finalize_company, $record);
			}
			$insurance_type_id  = $this->input->post('insurance_type_id');
			/*$data = array (
				'user_id'			=> $user_id,
				'insured_id'        => $health_insurance_id,
				'insurance_type_id' => $insurance_type_id,
				'amount'            => $this->input->post('total_premium'),
				'accessories_id'    => $this->input->post('accessories_id')
			);
			$this->session->set_userdata('user_payment_data',$data);
			redirect('admin/payment/proceed-to-pay/'.$health_insurance_id,'refresh');*/

			$payment_id         = getPaymentIdByInsurerIdInsuranceType($health_insurance_id,$insurance_type_id);
			$data_payment = array(
				'policy_number' => $policy_number,
	            'amount' 	    => $this->input->post('total_premium'),
	            'modified_date' => date("Y-m-d H:i:s")
	        );

        	$updated_payment_id = $this->admin_model->setUpdateData('tbl_payment', $data_payment, $payment_id);
        	redirect('admin/questionaries/'.$updated_payment_id);
			// redirect('admin/payment/proceed-to-pay/'.$updated_payment_id);

		}
		
		$data['health_insurance_id'] = $health_insurance_id;
		$data['estimation_data'] 	 = $this->admin_model->getFinalHealthInsuranceDetail($this->health_insurance_finalize_company,$health_insurance_id);
		$data['days_to_health_insurance']      = getNumberOfDaysToHealthInsurance($health_insurance_id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/healthinsurance/view_finalize_detail',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function added by Shiv to get Area Zone Id
	public function getAreaByZoneId() {
        $data    = '';
        $data    = 'class="control-group  " id="area_id" ';
        $result  = form_dropdown('area_id', getAreaByZoneId($this->input->post('zone_id')),set_value('area_id'),$data); 
        print_r($result);
        // return $result;
	}

	public function health_insurance_policies() {
		CheckAdminLoginSession();
		$data['dataCollection'] = $this->admin_model->getPoliciesByInsuranceTypeId(2);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/healthinsurance/health_insurance_policies',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


	public function health_insurance_policies_edit() {
		CheckAdminLoginSession();
		$data['policy_number'] 	   	 = decrypt($this->uri->segment(3));
		$data['health_insurance_id'] = $this->uri->segment(4);
		$data['branch_id']           = getBranchIdByHealthInsuranceId($data['health_insurance_id']);
		$data['company_id']          = getCompanyIdByHealthInsuranceId($data['health_insurance_id']);
		$data['risque_name']         = getRisqueNameByHealthInsuranceId($data['health_insurance_id']);
		$data['risque_id']		     = getIdForName($data['risque_name'],'tbl_risque');

		$data['health_insurance_details'] = $this->admin_model->getDataCollectionByID($this->health_insurance_details,$data['health_insurance_id']);
		// print_r($data['health_insurance_details']);
		$data['health_insurance_person_details'] = getHealthPersonDetailsByHealthInsuranceId($this->health_insurance_person_details,$data['health_insurance_id']);
		// print_r($data['health_insurance_person_details']);

		$post_data 		   = $this->input->post();
		$policy_number	   = $this->input->post('policy_number');
		$insurance_type_id = $this->input->post('health_insurance_type_id');
		if(!empty($post_data)) {
			if($policy_number == $data['policy_number']) {
				if($insurance_type_id == 2) { // Individual  
					$health_insurance_details_to_update = array (
						'health_insurance_type_id' => $insurance_type_id,
						'first_name'      		   => $this->input->post('first_name'),	
						'last_name'       		   => $this->input->post('last_name'),
						'age_person'   			   => date("Y-m-d H:i:s",strtotime($this->input->post('age_person'))),
						'age'                      => date("Y-m-d H:i:s") - date("Y-m-d H:i:s",strtotime($this->input->post('age_person'))),
						'start_date'   			   => date("Y-m-d H:i:s",strtotime($this->input->post('start_date'))),
						'end_date'   			   => date("Y-m-d H:i:s",strtotime($this->input->post('end_date')))
					);				
				} else {
					$health_insurance_details_to_update = array (
						'health_insurance_type_id'     => $insurance_type_id,
						'name_of_chief'      		   => $this->input->post('name_of_chief'),	
						'age_of_chief'       		   => date("Y-m-d H:i:s",strtotime($this->input->post('age_of_chief'))),
						'age'           			   => date("Y-m-d H:i:s") - date("Y-m-d H:i:s",strtotime($this->input->post('age_of_chief'))),
						'persons_insured'   		   => $this->input->post('persons_insured'),
						'start_date'      			   => date("Y-m-d H:i:s",strtotime($this->input->post('start_date'))),
						'end_date'      			   => date("Y-m-d H:i:s",strtotime($this->input->post('end_date'))),
						'modified_date'                => date("Y-m-d H:i:s")
					);
				}
				// Updating the Health Insurance Details
				$update_health_insurance_id = $this->admin_model->setUpdateData($this->health_insurance_details,$health_insurance_details_to_update,$data['health_insurance_id']);
				
				$update_health_insurance_details = $this->admin_model->getDataCollectionByID($this->health_insurance_details,$update_health_insurance_id);
				if($update_health_insurance_details->persons_insured > 0) {

					// Delete Insured Person Details
					$this->admin_model->deleteInsuredPeopleDetails($this->health_insurance_person_details,array ('persons_insured_id' => $data['health_insurance_id']));

					// Insert the insured persons details
					$current_date = date("Y-m-d H:i:s");
					for($i = 1;$i <= $update_health_insurance_details->persons_insured;$i++) {
						$persons_details_to_update = array (
							'persons_insured_id' => $data['health_insurance_id'],
							'full_name'    		 => $this->input->post('full_name_'.$i),
							'age_of_each_person' => date("Y-m-d H:i:s",strtotime($this->input->post('age_of_each_person_'.$i))),
							'age'                => date("Y-m-d H:i:s") - date("Y-m-d H:i:s",strtotime($this->input->post('age_of_each_person_'.$i))),
							'created_date'       => date("Y-m-d H:i:s"),
							'modified_date'      => date("Y-m-d H:i:s")
						);
						$this->admin_model->setInsertData($this->health_insurance_person_details,$persons_details_to_update,$data['health_insurance_id']);
					}
				}
				
				$days_to_health_insurance = getNumberOfDaysToHealthInsurance($data['health_insurance_id']);
				
				$health_quote_record      = getHealthInsuranceQuoteRecordByCompanyId($data['company_id'],$days_to_health_insurance);
				
				$agesOfInsuredPerson      = getAgesOfInsuredPersonHealthByHealthId($data['health_insurance_id']);
				
				// Calculating Person Amount
			    foreach ($agesOfInsuredPerson as $value) {
					if (!empty($health_quote_record)) {
					 	if($value <= $health_quote_record->child_below_age  ) {
						    $amount['child'] += $health_quote_record->amount_child_below_age;
						    // $person['child'] += 1;
					 	} else if($value >= $health_quote_record->adult_above_age && $value <=$health_quote_record->surprime_above_age) {
				    		$amount['adult'] += $health_quote_record->amount_adult_above_age;
				    		// $person['adult'] += 1;
				 		} else {
					    	$amount['surprime'] += $health_quote_record->amount_surprime_above_age;
					   	 	// $person['surprime'] += 1;
					 	}
					} else {
					 	$amount['child']    = 0;
						$amount['adult']    = 0;
					 	$amount['surprime'] = 0;
					}
				}

				foreach ($amount as $value) {
					$person_amount += $value;
				}

				$finalized_details = $this->admin_model->getFinalHealthInsuranceDetail($this->health_insurance_finalize_company,$data['health_insurance_id']);

				// Delete the old finalized data
				foreach ($finalized_details as $key => $value) {
					if($value->name == 'person_amount' || $value->name == 'net_premium' || $value->name == 'accessories' || $value->name == 'tax' || $value->name == 'total_premium') {
						$this->admin_model->dataDelete($this->health_insurance_finalize_company,$value->id);		
					}
				}
				/*// Delete the old finalized data of health 
				$this->admin_model->deleteFinalizedDataHealth($this->health_insurance_finalize_company,$data['health_insurance_id']);*/

				$estimation_data = $this->admin_model->getDataOfHealthInsuranceToInsertForSelectedCompany($data['company_id']);

				// Getting Estimation Amount
				$estimation_amount = 0;
				foreach ($estimation_data as $key => $value) {
					$estimation_amount += $value->amount;
				}

				// Calculating Other Finalized Amounts
				$net_premium       = $estimation_amount + $person_amount;
				$accessories_id    = getAccessoriesId($net_premium,$data['company_id'],$branch_id);
				$accessories_value = getAccessoriesValue($net_premium,$company_id,$branch_id);
				$tax_amount        = getTaxAmount(($accessories_value + $estimation_amount + $person_amount),$data['company_id'],$data['branch_id']);
				$total_premium     = $estimation_amount + $person_amount + $accessories_value + $tax_amount;

				// Update the finalized details
				$finalized_data_type = array (
					'estimation_amount' => $estimation_amount,
					'person_amount' 	=> $person_amount,
					'net_premium'   	=> $net_premium,
					'accessories'   	=> $accessories_value,
					'tax'           	=> $tax_amount,
					'total_premium' 	=> $total_premium
				);

				foreach($finalized_data_type as $key => $value) {
					$record = array (
						'health_insurance_id' => $data['health_insurance_id'],
						'name'         => $key,
						'amount'       => $value,
						'company_id'   => $data['company_id'],
						'company_name' => getCompanyName($data['company_id']),
						'branch_id'    => $data['branch_id'],
						'branch_name'  => getBranchName($data['branch_id']),
						'risque_name'  => $data['risque_name']
					);
					$this->admin_model->setInsertData($this->health_insurance_finalize_company,$record);
				}

				// Update Data into Payment Table
				$payment_id = getPaymentIdByInsurerIdInsuranceType($data['health_insurance_id'],2);
				

				$payment_details = $this->admin_model->getDataCollectionByID('tbl_payment',$payment_id);
				$old_payment_amount = $payment_details->amount;

				$payment_data = array (
					'amount'		=> $total_premium,
					'modified_date' => date("Y-m-d H:i:s")
				);
				$update_payment_id = $this->admin_model->setUpdateData('tbl_payment',$payment_data,$payment_id);
				
				// Update Data into Quittance Table
				$insurance_details = getFinalizedInsuranceDetails($data['health_insurance_id'],2);
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
					'policy_start_date'         => $insurance_details['policy_start_date'],
            		'policy_end_date'           => $insurance_details['policy_end_date'],
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

				if($insurance_type_id == 2) { // Individual  
					$health_insurance_details_to_insert = array (
						'user_id'                  => $data['health_insurance_details']->user_id,
						'health_insurance_type_id' => $insurance_type_id,
						'first_name'      		   => $this->input->post('first_name'),	
						'last_name'       		   => $this->input->post('last_name'),
						'age_person'   			   => date("Y-m-d H:i:s",strtotime($this->input->post('age_person'))),
						'age'                      => date("Y-m-d H:i:s") - date("Y-m-d H:i:s",strtotime($this->input->post('age_person'))),
						'start_date'   			   => date("Y-m-d H:i:s",strtotime($this->input->post('start_date'))),
						'end_date'   			   => date("Y-m-d H:i:s",strtotime($this->input->post('end_date'))),
						'policy_coverage_area_id'  => $data['health_insurance_details']->policy_coverage_area_id,
						'claim_reimbursement_rate' => $data['health_insurance_details']->claim_reimbursement_rate,
						'amount_to_pay'            => $data['health_insurance_details']->amount_to_pay,
						'created_date'             => date("Y-m-d H:i:s"),
						'modified_date'            => date("Y-m-d H:i:s")
					);				
				} else {
					$health_insurance_details_to_insert = array (
						'user_id'                      => $data['health_insurance_details']->user_id,
						'health_insurance_type_id'     => $insurance_type_id,
						'name_of_chief'      		   => $this->input->post('name_of_chief'),	
						'age_of_chief'       		   => date("Y-m-d H:i:s",strtotime($this->input->post('age_of_chief'))),
						'age'           			   => date("Y-m-d H:i:s") - date("Y-m-d H:i:s",strtotime($this->input->post('age_of_chief'))),
						'persons_insured'   		   => $this->input->post('persons_insured'),
						'start_date'      			   => date("Y-m-d H:i:s",strtotime($this->input->post('start_date'))),
						'end_date'      			   => date("Y-m-d H:i:s",strtotime($this->input->post('end_date'))),
						'policy_coverage_area_id'      => $data['health_insurance_details']->policy_coverage_area_id,
						'claim_reimbursement_rate'     => $data['health_insurance_details']->claim_reimbursement_rate,
						'amount_to_pay'                => $data['health_insurance_details']->amount_to_pay,
						'created_date'                 => date("Y-m-d H:i:s"),
						'modified_date'                => date("Y-m-d H:i:s")
					);
				}
				// Insert the updated Health Insurance Details
				$new_health_insurance_id      = $this->admin_model->setInsertData($this->health_insurance_details,$health_insurance_details_to_insert);
				$new_health_insurance_details = $this->admin_model->getDataCollectionByID($this->health_insurance_details,$new_health_insurance_id);
				

				if($new_health_insurance_details->persons_insured > 0) {

					// Insert the insured persons details
					for($i = 1;$i <= $new_health_insurance_details->persons_insured;$i++) {
						$persons_details_to_insert = array (
							'persons_insured_id' => $new_health_insurance_id,
							'full_name'    		 => $this->input->post('full_name_'.$i),
							'age_of_each_person' => date("Y-m-d H:i:s",strtotime($this->input->post('age_of_each_person_'.$i))),
							'age'                => date("Y-m-d H:i:s") - date("Y-m-d H:i:s",strtotime($this->input->post('age_of_each_person_'.$i))),
							'created_date'       => date("Y-m-d H:i:s"),
							'modified_date'      => date("Y-m-d H:i:s")
						);
						$this->admin_model->setInsertData($this->health_insurance_person_details,$persons_details_to_insert);
					}
				}




				$days_to_health_insurance = getNumberOfDaysToHealthInsurance($new_health_insurance_id);
				
				$health_quote_record      = getHealthInsuranceQuoteRecordByCompanyId($data['company_id'],$days_to_health_insurance);
				
				$agesOfInsuredPerson      = getAgesOfInsuredPersonHealthByHealthId($new_health_insurance_id);
				
				// Calculating Person Amount
			    foreach ($agesOfInsuredPerson as $value) {
					if (!empty($health_quote_record)) {
					 	if($value <= $health_quote_record->child_below_age  ) {
						    $amount['child'] += $health_quote_record->amount_child_below_age;
						    // $person['child'] += 1;
					 	} else if($value >= $health_quote_record->adult_above_age && $value <=$health_quote_record->surprime_above_age) {
				    		$amount['adult'] += $health_quote_record->amount_adult_above_age;
				    		// $person['adult'] += 1;
				 		} else {
					    	$amount['surprime'] += $health_quote_record->amount_surprime_above_age;
					   	 	// $person['surprime'] += 1;
					 	}
					} else {
					 	$amount['child']    = 0;
						$amount['adult']    = 0;
					 	$amount['surprime'] = 0;
					}
				}

				foreach ($amount as $value) {
					$person_amount += $value;
				}

				$estimation_data = $this->admin_model->getDataOfHealthInsuranceToInsertForSelectedCompany($data['company_id']);

				// Getting Estimation Amount
				$estimation_amount = 0;
				foreach ($estimation_data as $key => $value) {
					$estimation_data_to_insert = array (
						'health_insurance_id' => $new_health_insurance_id,
						'name'         => $value->name,
						'amount'       => $value->amount,
						'company_id'   => $data['company_id'],
						'company_name' => getCompanyName($data['company_id']),
						'branch_id'    => $data['branch_id'],
						'branch_name'  => getBranchName($data['branch_id']),
						'risque_name'  => $data['risque_name']
					);
					$estimation_amount += $value->amount;
					$this->admin_model->setInsertData($this->health_insurance_finalize_company,$estimation_data_to_insert);
				}

				// Calculating Other Finalized Amounts
				$net_premium       = $estimation_amount + $person_amount;
				$accessories_id    = getAccessoriesId($net_premium,$data['company_id'],$branch_id);
				$accessories_value = getAccessoriesValue($net_premium,$company_id,$branch_id);
				$tax_amount        = getTaxAmount(($accessories_value + $estimation_amount + $person_amount),$data['company_id'],$data['branch_id']);
				$total_premium     = $estimation_amount + $person_amount + $accessories_value + $tax_amount;

				// Update the finalized details
				$finalized_data_type = array (
					'estimation_amount' => $estimation_amount,
					'person_amount' 	=> $person_amount,
					'net_premium'   	=> $net_premium,
					'accessories'   	=> $accessories_value,
					'tax'           	=> $tax_amount,
					'total_premium' 	=> $total_premium
				);

				foreach($finalized_data_type as $key => $value) {
					$record = array (
						'health_insurance_id' => $new_health_insurance_id,
						'name'         => $key,
						'amount'       => $value,
						'company_id'   => $data['company_id'],
						'company_name' => getCompanyName($data['company_id']),
						'branch_id'    => $data['branch_id'],
						'branch_name'  => getBranchName($data['branch_id']),
						'risque_name'  => $data['risque_name']
					);
					$this->admin_model->setInsertData($this->health_insurance_finalize_company,$record);
				}


				// Insert Data into Payment Table
				$old_payment_id = getPaymentIdByInsurerIdInsuranceType($data['health_insurance_id'],2);
				
				$old_payment_details = $this->admin_model->getDataCollectionByID('tbl_payment',$old_payment_id);

				$old_payment_amount = $payment_details->amount;
				
				$payment_data_to_insert = array (
					'policy_number'     => checkUniquePolicyId($policy_number),
					'insurance_type_id' => 2,
					'user_id'           => $old_payment_details->user_id,
					'company_id'        => $old_payment_details->company_id,
					'insured_id'        => $new_health_insurance_id,
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
				$old_quittance_id      = getQuittanceId($data['policy_number']);

				$old_quittance_details = $this->admin_model->getDataCollectionByID('tbl_quittance',$old_quittance_id);
				$new_insurance_details = getFinalizedInsuranceDetails($new_health_insurance_id,2);

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
					'policy_start_date'         => $new_insurance_details['policy_start_date'],
            		'policy_end_date'           => $new_insurance_details['policy_end_date'],
					'total_amount'              => $new_insurance_details['total_premium'],
					'created_date'              => date('Y-m-d H:i:s'),
					'modified_date'             => date('Y-m-d H:i:s'),
					'status'                    => 0
				); 
				$updated_quittance_id = $this->admin_model->setInsertData('tbl_quittance',$quittance_data_to_insert);
				$new_quittance_details = $this->admin_model->getDataCollectionByID('tbl_quittance',$updated_quittance_id);


				// Calculating Difference of Old and New Amount
				$amount_difference = ($new_quittance_details->total_amount - $old_payment_amount);
			}

			// Sending Email to End User and Admin Regarding the Updation of Policy
			if($amount_difference > 0) {
				$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You have to pay the amount of ".abs($amount_difference)." to the Admin";
			} else if($amount_difference < 0){
				$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You have to recieve the amount of <b>".abs($amount_difference)."</b> from the Admin";
			} else {
				$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You don't have to pay/recieve any amount from the Admin";
			}
			// $amount_difference = diffPolicyTotalAmount($old_payment_amount,$insurance_details['total_premium']);
			$user_id            	     = getUserIdFromInsuranceDetails($data['health_insurance_id'],$this->health_insurance_details);
			
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
				'{{insurance_type}}'          =>  getInsuranceType(2).' INSURANCE',
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
				'{{insurance_type}}'          =>  getInsuranceType(2).' INSURANCE',
				'{{policy_number}}'           =>  $data['policy_number'],
				'{{amount_difference}}'       =>  $admin_amount_message,
				'{{email}}'                   => getAdminEmail()
			);
			$admin_message     = email_compose($admin_email_template,$admin_templateTags);
			$admin_email       = getAdminEmail();
			$admin_subject     = SEND_POLICY_UPDATION_MAIL;
			if (send_smtp_mail($admin_email,$admin_subject,$admin_message)) {
				$this->session->set_flashdata('message',POLICY_UPDATE_SUCCESS_MESSAGE);
	        	redirect('admin/health-insurance-policies','refresh');
			}
		}


 		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/healthinsurance/health_insurance_policies_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}
	
	// function added by Shiv to get the Card Details for an user
    public function card_details($policy_number = null) {
        if(!empty($policy_number)) {
            $data['card_details'] = getInsuranceCardDetails(decrypt($policy_number)); 
            if(!empty($data['card_details'])) { 
                $html =  $this->load->view('front/users/card_details', $data,true);
                $data = [];        
                
                $pdfFilePath = date('dmYhis').".pdf";
                $this->load->library('m_pdf');
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
