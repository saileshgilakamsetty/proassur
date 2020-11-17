<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Travel extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $travel                     = 'tbl_travel';
	public $travel_quote               = 'tbl_travel_quote';
	public $travel_destination_details = 'tbl_travel_destination_details';
	public $travel_people_insured      = 'tbl_travel_people_insured';
	public $travel_people_details      = 'tbl_travel_people_details';
	public $travel_finalize_company    = 'tbl_travel_finalize_company';


// function to show the list of travel Insurance
	public function travel_conditions_lists() {
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
        $totalCount             = $this->admin_model->totalRecord($this->travel);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->travel,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/travel/condition_lists',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


//function to add the travel condition 
	public function travel_conditions_add() {
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
				$data            = array(									
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
				$id      			  = $this->admin_model->setInsertData($this->travel,$data);
				$this->session->set_flashdata('message','Your Travel Examination has been added successfully');
		        redirect('admin/travel-conditions/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/travel/condition_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit a travel conditions
	public function travel_conditions_edit() {
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

				$id              = $this->admin_model->setUpdateData($this->travel,$data,$id);
				$this->session->set_flashdata('message','Your Travel Examination has been update successfully');
		        redirect('admin/travel-conditions/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->travel,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/travel/condition_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to delete a Travel Insurance Condition

	public function travel_conditions_delete() {
		CheckAdminLoginSession();
		$id=$this->uri->segment(4);
		$this->admin_model->dataDelete($this->travel,$id);
		$this->session->set_flashdata('message','Your Travel Condition has been deleted successfully');
        redirect('admin/travel-conditions/lists','refresh');
	}

// function to change status of Travel Insurance Condition

	public function travel_conditions_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->travel,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/travel-conditions/lists','refresh');		
	}

// function to get the list of travel quote
	public function travel_quote() {
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
        $totalCount             = $this->admin_model->totalRecord($this->travel_quote);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->travel_quote,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/travel/travel_quote',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to add the travel quote
	public function travel_quote_add() {
        CheckAdminLoginSession();	   	
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');	
			$this->form_validation->set_rules('company_id', 'Company', 'required');		
			$this->form_validation->set_rules('zone_id', 'Zone', 'required');
			$this->form_validation->set_rules('min_days', 'Minimum Days', 'required');		
			$this->form_validation->set_rules('max_days', 'Maximum Days', 'required');		
			$this->form_validation->set_rules('area', 'Area', 'required');		
			$this->form_validation->set_rules('child_below_age', 'Child Below Age', 'required');		
			$this->form_validation->set_rules('amount_child_below_age', 'Amount Child Below Age', 'required');		
			$this->form_validation->set_rules('adult_above_age', 'Adult Above Age', 'required');		
			$this->form_validation->set_rules('amount_adult_above_age', 'Amount Adult Above Age', 'required');		
			$this->form_validation->set_rules('surprime_above_age', 'Surprime Above Age', 'required');		
			$this->form_validation->set_rules('amount_surprime_above_age', 'Amount Surprime Above Age', 'required');		
			$this->form_validation->set_rules('description', 'Description', 'required');		
			if($this->form_validation->run() == FALSE) {   } else {
				$data            = array(									
					'company_id'          => $this->input->post('company_id'),		
					'zone_id'             => $this->input->post('zone_id'),		
					'min_days'            => $this->input->post('min_days'),		
					'max_days'            => $this->input->post('max_days'),		
					'area'                => $this->input->post('area'),		
					'amount'              => $this->input->post('amount'),		
					'child_below_age'     => $this->input->post('child_below_age'),		
					'amount_child_below_age'     => $this->input->post('amount_child_below_age'),		
					'adult_above_age'     => $this->input->post('adult_above_age'),		
					'amount_adult_above_age'     => $this->input->post('amount_adult_above_age'),		
					'surprime_above_age'  => $this->input->post('surprime_above_age'),
					'amount_surprime_above_age'  => $this->input->post('amount_surprime_above_age'),
					'description'         => $this->input->post('description'),
					'status'              => $this->input->post('status'),
					'created_date'        => date("Y-m-d H:i:s"),
					'modified_date'       => date("Y-m-d H:i:s")
				);
				$id      = $this->admin_model->setInsertData($this->travel_quote,$data);
				$this->session->set_flashdata('message','Your Travel Quote has been added successfully');
		        redirect('admin/travel-quote/lists','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/travel/travel_quote_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to edit a travel quote
	public function travel_quote_edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		$checked_password  = $this->input->post('checked_password');
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('company_id', 'Company', 'required');		
			$this->form_validation->set_rules('zone_id', 'Zone', 'required');
			$this->form_validation->set_rules('min_days', 'Minimum Days', 'required');		
			$this->form_validation->set_rules('max_days', 'Maximum Days', 'required');		
			$this->form_validation->set_rules('area', 'Area', 'required');		
			$this->form_validation->set_rules('child_below_age', 'Child Below Age', 'required');		
			$this->form_validation->set_rules('amount_child_below_age', 'Amount Child Below Age', 'required');		
			$this->form_validation->set_rules('adult_above_age', 'Adult Above Age', 'required');		
			$this->form_validation->set_rules('amount_adult_above_age', 'Amount Adult Above Age', 'required');		
			$this->form_validation->set_rules('surprime_above_age', 'Surprime Above Age', 'required');		
			$this->form_validation->set_rules('amount_surprime_above_age', 'Amount Surprime Above Age', 'required');	
			$this->form_validation->set_rules('description', 'Description', 'required');		
								
			if($this->form_validation->run() == FALSE) {   } else {			
				$data            = array(									
					'company_id'          => $this->input->post('company_id'),		
					'zone_id'             => $this->input->post('zone_id'),		
					'min_days'            => $this->input->post('min_days'),		
					'max_days'            => $this->input->post('max_days'),		
					'area'                => $this->input->post('area'),		
					'amount'              => $this->input->post('amount'),		
					'child_below_age'     => $this->input->post('child_below_age'),		
					'amount_child_below_age'     => $this->input->post('amount_child_below_age'),		
					'adult_above_age'     => $this->input->post('adult_above_age'),		
					'amount_adult_above_age'     => $this->input->post('amount_adult_above_age'),		
					'surprime_above_age'  => $this->input->post('surprime_above_age'),
					'amount_surprime_above_age'  => $this->input->post('amount_surprime_above_age'),
					'description'         => $this->input->post('description'),
					'status'              => $this->input->post('status'),
					'modified_date'       => date("Y-m-d H:i:s")
				);

				$id              = $this->admin_model->setUpdateData($this->travel_quote,$data,$id);
				$this->session->set_flashdata('message','Your Travel Quote has been update successfully');
		        redirect('admin/travel-quote/lists','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->travel_quote,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/travel/travel_quote_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete a Travel Quote

	public function travel_quote_delete() {
		CheckAdminLoginSession();
		$id=$this->uri->segment(4);
		$this->admin_model->dataDelete($this->travel_quote,$id);
		$this->session->set_flashdata('message','Your Travel Quote has been deleted successfully');
        redirect('admin/travel-quote/lists','refresh');
	}

// function to change status of Travel Quote

	public function travel_quote_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->travel_quote,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/travel-quote/lists','refresh');		
	}


// function to get the travel quote
	public function travel_getquote() {
		CheckAdminLoginSession();
		$travel_id = $this->uri->segment(3); 
		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$current_date        = date("Y-m-d H:i:s");
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			for($i = 1; $i <= $post_data['people_insured'];$i++) {
				$this->form_validation->set_rules('firstname_'.$i, 'First Name', 'required');
				$this->form_validation->set_rules('lastname_'.$i, 'Last Name', 'required');
				$this->form_validation->set_rules('age_'.$i, 'Age of Person', 'required');
			}
			$this->form_validation->set_rules('user_id','Name','required');
			$this->form_validation->set_rules('people_insured', 'People Insured', 'required');	
			$this->form_validation->set_rules('travel_start_date', 'Travel Start Date', 'required');	
			$this->form_validation->set_rules('travel_end_date', 'Travel End Date', 'required');		
			$this->form_validation->set_rules('destination_of_trip', 'Destination of Trip', 'required');
			$this->form_validation->set_rules('total_travelers', 'Total Number of Travelers', 'required');	
			if($this->form_validation->run() == FALSE) {   } else {
				$data = array(
					'user_id'        => $this->input->post('user_id'),
					'people_insured' => $post_data['people_insured'],
				);
				$id = $this->admin_model->setInsertData($this->travel_people_insured, $data);
				if($id > 0) {
					$destination_details = array(
						'people_insured_id'   => $id,
						'travel_start_date'   => date("Y-m-d H:i:s",strtotime($post_data['travel_start_date'])),
						'travel_end_date'     => date("Y-m-d H:i:s",strtotime($post_data['travel_end_date'])),
						'destination_of_trip' => $post_data['destination_of_trip'],
						'total_travelers'     => $post_data['total_travelers']
					);
					$result = $this->admin_model->setInsertData($this->travel_destination_details, $destination_details);
					for($i = 1; $i <= $post_data['people_insured']; $i++) {
						$people_details = array (
							'people_insured_id' => $id,
							'first_name'    => $post_data['firstname_'.$i],
							'last_name'     => $post_data['lastname_'.$i],
							'age_of_person' => date("Y-m-d H:i:s",strtotime($post_data['age_'.$i])),
							'age'           => $current_date - date("Y-m-d H:i:s",strtotime($post_data['age_'.$i]))
						);
						$this->admin_model->setInsertData($this->travel_people_details, $people_details);
					}
					redirect('admin/travel/get-estimation/'.$id,'refresh');		
				}
			}	
		}
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/travel/travel_get_quote');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to get the estimation price
	public function get_estimation() {
		CheckAdminLoginSession();
		$data['travel_id']             = $this->uri->segment(4);
		$travel_examination_list_array = getTravelExaminationList();
		$company_array                 = getCompanyIds();
		$data['qwerty']                = getTravelInsuranceCompanyComparision($travel_examination_list_array,$company_array);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/travel/get_travel_estimation',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to get finalize company for travel
	public function finalize_company() {
		CheckAdminLoginSession();
		$company_id = $this->input->post('company_id');
		$travel_id  = $this->input->post('travel_id');
		$record     = $this->admin_model->getDataToInsertForSelectedCompany($company_id);
		$user_id            	= getUserIdFromInsuranceDetails($travel_id,$this->travel_people_insured);
		// print_r($record);

		foreach ($record as $key => $value) {
			$data = array(
				'travel_id'    => $travel_id,
				'name'         => $value->name,
				'amount'       => $value->amount,
				'company_id'   => $value->company_id,
				'company_name' => getCompanyName($value->company_id),
				'branch_id'    => $value->branch_id,
				'branch_name'  => getBranchName($value->branch_id),
				'risque_name'  => getRisqueName($value->risque_id),
				'description'  => $value->description
			);
			$this->admin_model->setInsertData($this->travel_finalize_company, $data);
		}


		$payment_data = array(
			// 'policy_number'     => getPolicyId(),
			'policy_number'     => getAutogeneratedPolicyNumber($company_id),
			'insurance_type_id' => 3,
			'user_id'           => $user_id,
			'company_id'        => $company_id,
			'insured_id'        => $travel_id,
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

// function to view finalize detail
	public function view_finalize_detail() {
		CheckAdminLoginSession();
		//$data                    = '';
		$travel_id          	= $this->uri->segment(4);
		$user_id            	= getUserIdFromInsuranceDetails($travel_id,$this->travel_people_insured);
		$data['branch_id']  	= getBranchIdByTravelId($travel_id);
		$data['company_id'] 	= getCompanyIdByTravelId($travel_id);
		$company_id         	= getCompanyIdByTravelId($travel_id);
		$data['risque_name']    = getRisqueNameByTravelId($travel_id);
		$data['travel_id']  	= $travel_id;
		$data['company_id'] 	= $company_id;
		$policy_code 			= getPolicyCodeForCompany($data['company_id']);
		$post_data              = $this->input->post();
		if(!empty($post_data)) {
			$policy_code   = $this->input->post('policy_code');
			$policy_prefix = $this->input->post('policy_prefix');
			if(empty($this->input->post('policy_prefix'))) {
				$policy_number = getAutogeneratedPolicyNumber($company_id);
			} else {
				if(checkPolicyNumberExists($policy_code."/".$policy_prefix) > 0) {
					$this->session->set_flashdata('message','Policy Number Already Exists. Please Enter another Policy Number');
					redirect('admin/travel/view-finalize-detail/'.$travel_id);
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
					'travel_id'    => $travel_id,
					'name'         => $key,
					'amount'       => $value,
					'company_id'   => $company_id,
					'company_name' => getCompanyName($company_id),
					'branch_id'    => $data['branch_id'],
					'branch_name'  => getBranchName($data['branch_id']),
					'risque_name'  => $data['risque_name']
				);
				$this->admin_model->setInsertData($this->travel_finalize_company, $record);
			}
			$insurance_type_id  = $this->input->post('insurance_type_id');
			/*$data = array (
				'user_id'			=> $user_id,
				'insured_id'        => $travel_id,
				'insurance_type_id' => $insurance_type_id,
				'amount'            => $this->input->post('total_premium'),
				'accessories_id'    => $this->input->post('accessories_id')
			);
			$this->session->set_userdata('user_payment_data',$data);
			redirect('admin/payment/proceed-to-pay/'.$travel_id,'refresh');*/
			$payment_id         = getPaymentIdByInsurerIdInsuranceType($travel_id,$insurance_type_id);
			$data_payment = array(
				'policy_number' => $policy_number,
	            'amount' 	    => $this->input->post('total_premium'),
	            'modified_date' => date("Y-m-d H:i:s")
	        );

        	$updated_payment_id = $this->admin_model->setUpdateData('tbl_payment', $data_payment, $payment_id);
        	redirect('admin/questionaries/'.$updated_payment_id);
			//redirect('admin/payment/proceed-to-pay/'.$updated_payment_id);
		}
		$data['estimation_data'] = $this->admin_model->getFinalTravelInsuranceDetail($this->travel_finalize_company,$travel_id);
		$data['days_to_travel']  = getNumberOfDaysToTravel($travel_id);
		
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/travel/view_finalize_detail',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


	// function added by Shiv to view the list of insurance pollicies
	public function travel_policies() {
		CheckAdminLoginSession();
		$data['dataCollection'] = $this->admin_model->getPoliciesByInsuranceTypeId(3);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/travel/travel_policies',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


	public function travel_policies_edit() {
		CheckAdminLoginSession();
		$data['policy_number']  = decrypt($this->uri->segment(3));
		// $data['policy_number']  = $this->uri->segment(3);
		$data['travel_id']      = $this->uri->segment(4);
		$data['branch_id']  	= getBranchIdByTravelId($data['travel_id']);
		$data['company_id'] 	= getCompanyIdByTravelId($data['travel_id']);
		$data['risque_name']    = getRisqueNameByTravelId($data['travel_id']);
		$data['risque_id']      = getIdForName($data['risque_name'],'tbl_risque');
		

		$data['travel_people_insured'] = $this->admin_model->getDataCollectionByID($this->travel_people_insured,$data['travel_id']);
	
		$data['travel_people_details'] = getTravelPeopleDetailsByTravelId($this->travel_people_details,$data['travel_id']);

		$data['travel_destination_details'] = getTravelDestinationDetailsByTravelId($this->travel_destination_details,$data['travel_id']);
		
		$post_data = $this->input->post();
		if(!empty($post_data)) {

			$policy_number = $this->input->post('policy_number');
			if($policy_number == $data['policy_number']) {
				$people_insured_to_update = array (
					'people_insured' => $this->input->post('people_insured'),
					'modified_date'  => date("Y-m-d H:i:s")
				);
				$update_travel_id = $this->admin_model->setUpdateData($this->travel_people_insured,$people_insured_to_update,$data['travel_id']);
				if($update_travel_id > 0) {
					$destination_details_to_update = array (
						'travel_start_date' => date("Y-m-d H:i:s",strtotime($this->input->post('travel_start_date'))),
						'travel_end_date' => date("Y-m-d H:i:s",strtotime($this->input->post('travel_end_date'))),
						'modified_date'   => date("Y-m-d H:i:s")
					);

					$this->admin_model->setUpdateData($this->travel_destination_details,$destination_details_to_update,$data['travel_destination_details']->id);
				}
			

				$updated_people_insured = $this->admin_model->getDataCollectionByID($this->travel_people_insured,$data['travel_id']);

				// Delete Insured People Details
				$this->admin_model->deleteInsuredPeopleDetails($this->travel_people_details,array ('people_insured_id' => $data['travel_id']));
				
				// Insert the Insured People Details
				$current_date = date("Y-m-d H:i:s");
				for($i = 1;$i <= $updated_people_insured->people_insured;$i++) {
					$people_details_to_update = array (
						'people_insured_id' => $data['travel_id'],
						'first_name'        => $this->input->post('firstname_'.$i),	
						'last_name'         => $this->input->post('lastname_'.$i),
						'age_of_person'	    => date("Y-m-d H:i:s",strtotime($this->input->post('age_'.$i))),
						'age'           => $current_date - date("Y-m-d H:i:s",strtotime($this->input->post('age_'.$i)))
					);
					$this->admin_model->setInsertData($this->travel_people_details,$people_details_to_update,$data['travel_id']);
				}



				// Calculating No of days to Travel 
				$days_to_travel  = getNumberOfDaysToTravel($data['travel_id']);
				// Getting Travel Quote Record
				$travel_quote_record = getTravelQuoteRecordByCompanyId($data['company_id'],$days_to_travel);
   				$agesOfInsuredPerson = getAgesOfInsuredPersonTravelByTravelId($data['travel_id']);

   				// Calculating Estimation Amount
   				// $estimation_amount = getEstimationAmountByTravelId($this->travel_finalize_company,$data['travel_id']);
   			

   				// Calculating Person Amount
				foreach ($agesOfInsuredPerson as $value) {
					if (!empty($travel_quote_record)) {
					 if($value <= $travel_quote_record->child_below_age  ) {
					    $amount['child'] += $travel_quote_record->amount_child_below_age;
					    // $person['child'] += 1;
					 }
					 else if($value >= $travel_quote_record->adult_above_age && $value <=$travel_quote_record->surprime_above_age) {
					    $amount['adult'] += $travel_quote_record->amount_adult_above_age;
					    // $person['adult'] += 1;
					 }
					 else {
					    $amount['surprime'] += $travel_quote_record->amount_surprime_above_age;
					    // $person['surprime'] += 1;
					 }
					}
					else {
					 $amount['child']    = 0;
					 $amount['adult']    = 0;
					 $amount['surprime'] = 0;
					}
				}

				foreach ($amount as $value) {
					$person_amount += $value;
				}		

				/*echo $person_amount;
				die;*/	

				// Delete the old finalized data of travel
				// $this->admin_model->deleteFinalizedDataTravel($this->travel_finalize_company,$data['travel_id']);
				foreach ($finalized_details as $key => $value) {
					if($value->name == 'person_amount' || $value->name == 'net_premium' || $value->name == 'accessories' || $value->name == 'tax' || $value->name == 'total_premium') {
						$this->admin_model->dataDelete($this->travel_finalize_company,$value->id);		
					}
				}
				$estimation_data = $this->admin_model->getDataToInsertForSelectedCompany($data['company_id']);
				
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
						'travel_id'    => $data['travel_id'],
						'name'         => $key,
						'amount'       => $value,
						'company_id'   => $data['company_id'],
						'company_name' => getCompanyName($data['company_id']),
						'branch_id'    => $data['branch_id'],
						'branch_name'  => getBranchName($data['branch_id']),
						'risque_name'  => $data['risque_name']
					);
					$this->admin_model->setInsertData($this->travel_finalize_company,$record);
				}

				// Update Data into Payment Table
				$payment_id = getPaymentIdByInsurerIdInsuranceType($data['travel_id'],3);
				

				$payment_details = $this->admin_model->getDataCollectionByID('tbl_payment',$payment_id);
				$old_payment_amount = $payment_details->amount;

				$payment_data = array (
					'amount'		=> $total_premium,
					'modified_date' => date("Y-m-d H:i:s")
				);
				$update_payment_id = $this->admin_model->setUpdateData('tbl_payment',$payment_data,$payment_id);



				// Update Data into Quittance Table
				$insurance_details = getFinalizedInsuranceDetails($data['travel_id'],3);
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
				// Insert Travel people insured
				$people_insured_to_insert = array (
					'user_id'        => $data['travel_people_insured']->user_id,
					'people_insured' => $this->input->post('people_insured'),
					'created_date'   => date("Y-m-d H:i:s"),
					'modified_date'  => date("Y-m-d H:i:s")
				);
				$new_travel_id = $this->admin_model->setInsertData($this->travel_people_insured,$people_insured_to_insert);

				// Insert Travel Destination Details
				if($new_travel_id > 0) {
					$destination_details_to_insert = array (
						'people_insured_id'   => $new_travel_id,
						'travel_start_date'   => date("Y-m-d H:i:s",strtotime($this->input->post('travel_start_date'))),
						'travel_end_date'     => date("Y-m-d H:i:s",strtotime($this->input->post('travel_end_date'))),
						'destination_of_trip' => $data['travel_destination_details']->destination_of_trip,
						'total_travelers'     => $data['travel_destination_details']->total_travelers,
						'created_date'        => date("Y-m-d H:i:s"),
						'modified_date'       => date("Y-m-d H:i:s")
					);

					$this->admin_model->setInsertData($this->travel_destination_details,$destination_details_to_insert);
				}


				// Insert the Insured People Details
				$current_date = date("Y-m-d H:i:s");
				for($i = 1;$i <= $this->input->post('people_insured');$i++) {
					$people_details_to_insert = array (
						'people_insured_id' => $new_travel_id,
						'first_name'        => $this->input->post('firstname_'.$i),	
						'last_name'         => $this->input->post('lastname_'.$i),
						'age_of_person'	    => date("Y-m-d H:i:s",strtotime($this->input->post('age_'.$i))),
						'age'           => $current_date - date("Y-m-d H:i:s",strtotime($this->input->post('age_'.$i)))
					);
					$this->admin_model->setInsertData($this->travel_people_details,$people_details_to_insert);
				}


				// Calculating No of days to Travel 
				$days_to_travel  = getNumberOfDaysToTravel($new_travel_id);
				// Getting Travel Quote Record
				$travel_quote_record = getTravelQuoteRecordByCompanyId($data['company_id'],$days_to_travel);
   				$agesOfInsuredPerson = getAgesOfInsuredPersonTravelByTravelId($new_travel_id);

   				// Calculating Person Amount
				foreach ($agesOfInsuredPerson as $value) {
					if (!empty($travel_quote_record)) {
					 if($value <= $travel_quote_record->child_below_age  ) {
					    $amount['child'] += $travel_quote_record->amount_child_below_age;
					    // $person['child'] += 1;
					 }
					 else if($value >= $travel_quote_record->adult_above_age && $value <=$travel_quote_record->surprime_above_age) {
					    $amount['adult'] += $travel_quote_record->amount_adult_above_age;
					    // $person['adult'] += 1;
					 }
					 else {
					    $amount['surprime'] += $travel_quote_record->amount_surprime_above_age;
					    // $person['surprime'] += 1;
					 }
					}
					else {
					 $amount['child']    = 0;
					 $amount['adult']    = 0;
					 $amount['surprime'] = 0;
					}
				}

				foreach ($amount as $value) {
					$person_amount += $value;
				}		

				// echo $person_amount;

				$estimation_data = $this->admin_model->getDataToInsertForSelectedCompany($data['company_id']);

				// Getting Estimation Amount
				$estimation_amount = 0;
				foreach ($estimation_data as $key => $value) {
					$estimation_data_to_insert = array (
						'travel_id'    => $new_travel_id,
						'name'         => $value->name,
						'amount'       => $value->amount,
						'company_id'   => $data['company_id'],
						'company_name' => getCompanyName($data['company_id']),
						'branch_id'    => $data['branch_id'],
						'branch_name'  => getBranchName($data['branch_id']),
						'risque_name'  => $data['risque_name']
					);
					$estimation_amount += $value->amount;
					$this->admin_model->setInsertData($this->travel_finalize_company,$estimation_data_to_insert);
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
						'travel_id'    => $new_travel_id,
						'name'         => $key,
						'amount'       => $value,
						'company_id'   => $data['company_id'],
						'company_name' => getCompanyName($data['company_id']),
						'branch_id'    => $data['branch_id'],
						'branch_name'  => getBranchName($data['branch_id']),
						'risque_name'  => $data['risque_name']
					);
					$this->admin_model->setInsertData($this->travel_finalize_company,$record);
				}


				// Insert Data into Payment Table
				$old_payment_id = getPaymentIdByInsurerIdInsuranceType($data['travel_id'],3);

				$old_payment_details = $this->admin_model->getDataCollectionByID('tbl_payment',$old_payment_id);

				$old_payment_amount = $payment_details->amount;
				
				$payment_data_to_insert = array (
					'policy_number'     => checkUniquePolicyId($policy_number),
					'insurance_type_id' => 3,
					'user_id'           => $old_payment_details->user_id,
					'company_id'        => $old_payment_details->company_id,
					'insured_id'        => $new_travel_id,
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
				$new_insurance_details = getFinalizedInsuranceDetails($new_travel_id,3);

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
			$user_id            	     = getUserIdFromInsuranceDetails($data['travel_id'],$this->travel_people_insured);
			
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
				'{{insurance_type}}'          =>  getInsuranceType(3).' INSURANCE',
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
				'{{insurance_type}}'          =>  getInsuranceType(3).' INSURANCE',
				'{{policy_number}}'           =>  $data['policy_number'],
				'{{amount_difference}}'       =>  $admin_amount_message,
				'{{email}}'                   => getAdminEmail()
			);
			$admin_message     = email_compose($admin_email_template,$admin_templateTags);

			$admin_email       = getAdminEmail();

			$admin_subject     = SEND_POLICY_UPDATION_MAIL;
			if (send_smtp_mail($admin_email,$admin_subject,$admin_message)) {
				$this->session->set_flashdata('message',POLICY_UPDATE_SUCCESS_MESSAGE);
	        	redirect('admin/travel-policies','refresh');
			}
		}



		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/travel/travel_policies_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


}
