<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credit extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $credit_tarification 		 	  = 'tbl_credit_tarification';
	public $credit_detail 		              = 'tbl_credit_detail';
	public $selected_optional_warranty_credit = 'tbl_selected_optional_warranty_credit';
	public $credit_calculation_rate_details   = 'tbl_credit_calculation_rate_details';
	public $finalize_credit_insurance 		  = 'tbl_finalize_credit_insurance';
	public $credit_calculation_rate_details_by_year = 'tbl_credit_calculation_rate_details_by_year';

// function to add a accessories
	public function add_tarification() {	
        CheckAdminLoginSession();	
		$post_data             = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

			$this->form_validation->set_rules('min_loan_amount', ' Minimum Loan Amount', 'required|trim|numeric');
			$this->form_validation->set_rules('max_loan_amount', ' Maximum Loan Amount', 'required|trim|numeric|callback_check_max_loan_amount_validation');
			$this->form_validation->set_rules('loan_duration', ' Duration Of Loan', 'required|trim|numeric');
			$this->form_validation->set_rules('min_customer_age', ' Minimum Customer Age', 'required');
			$this->form_validation->set_rules('max_customer_age', ' Maximum Customer Age', 'required|callback_check_max_customer_age_validation');
			$this->form_validation->set_rules('insurance_rate', ' Insurance Rate', 'required|trim|numeric');
			$this->form_validation->set_rules('loan_size', ' Loan Size', 'required|trim|numeric');
			$this->form_validation->set_rules('company_id', ' Company', 'required');
			$this->form_validation->set_rules('branch_id', ' Branch', 'required');
			$this->form_validation->set_rules('risque_id', ' Risque', 'required');


		
			if($this->form_validation->run() == FALSE) {   } else {
				$current_date = date("Y-m-d H:i:s");
				$data         = array(							
					'min_loan_amount'     => $this->input->post('min_loan_amount'),
					'max_loan_amount'     => $this->input->post('max_loan_amount'),
					'loan_duration'		  => $this->input->post('loan_duration'),
					'min_customer_age'    => date("Y-m-d H:i:s",strtotime($this->input->post('min_customer_age'))),
					'min_age'			  => $current_date - date("Y-m-d H:i:s",strtotime($this->input->post('min_customer_age'))),
					'max_customer_age'    => date("Y-m-d H:i:s",strtotime($this->input->post('max_customer_age'))),
					'max_age'			  => $current_date - date("Y-m-d H:i:s",strtotime($this->input->post('max_customer_age'))),
					'insurance_rate'      => $this->input->post('insurance_rate'),
					'loan_size'           => $this->input->post('loan_size'),
					'company_id'          => $this->input->post('company_id'),
					'branch_id'           => getCreditBranchId(),
					'risque_id'           => getCreditRisqueId(),
					'created_date'        => date('Y-m-d H:i:s'),
					'modified_date'       => date('Y-m-d H:i:s'),
					'status'              => $this->input->post('status')
				); 
				$id = $this->admin_model->setInsertData($this->credit_tarification,$data);
				if($id > 0) {
					$this->session->set_flashdata('message','Your Credit Tarification has been added successfully');
		        	redirect('admin/credit/list_tarification','refresh');
				}
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/credit/add_tarification');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function to edit 
	public function edit_tarification() {
		$id           = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data    = $this->input->post();
		if(!empty($post_data)) {     
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

			$this->form_validation->set_rules('min_loan_amount', ' Minimum Loan Amount', 'required|trim|numeric');
			$this->form_validation->set_rules('max_loan_amount', ' Maximum Loan Amount', 'required|trim|numeric|callback_check_max_loan_amount_validation');
			$this->form_validation->set_rules('loan_duration', 'Loan Duration', 'required|trim|numeric');
			$this->form_validation->set_rules('min_customer_age', ' Minimum Customer Age', 'required');
			$this->form_validation->set_rules('max_customer_age', ' Maximum Customer Age', 'required|callback_check_max_customer_age_validation');
			$this->form_validation->set_rules('insurance_rate', ' Insurance Rate', 'required|trim|numeric');
			$this->form_validation->set_rules('loan_size', ' Loan Size', 'required|trim|numeric');
			$this->form_validation->set_rules('company_id', ' Company', 'required');
			$this->form_validation->set_rules('branch_id', ' Branch', 'required');
			$this->form_validation->set_rules('risque_id', ' Risque', 'required');


			if($this->form_validation->run() == FALSE) {   } else {  
				$current_date = date("Y-m-d H:i:s");
				$data         = array(							
					'min_loan_amount'     => $this->input->post('min_loan_amount'),
					'max_loan_amount'     => $this->input->post('max_loan_amount'),
					'loan_duration' 	  => $this->input->post('loan_duration'),
					'min_customer_age'    => date("Y-m-d H:i:s",strtotime($this->input->post('min_customer_age'))),
					'min_age'			  => $current_date - date("Y-m-d H:i:s",strtotime($this->input->post('min_customer_age'))),
					'max_customer_age'    => date("Y-m-d H:i:s",strtotime($this->input->post('max_customer_age'))),
					'max_age'			  => $current_date - date("Y-m-d H:i:s",strtotime($this->input->post('max_customer_age'))),
					'insurance_rate'      => $this->input->post('insurance_rate'),
					'loan_size'           => $this->input->post('loan_size'),
					'company_id'          => $this->input->post('company_id'),
					'branch_id'           => getCreditBranchId(),
					'risque_id'           => $this->input->post('risque_id'),
					'created_date'        => date('Y-m-d H:i:s'),
					'modified_date'       => date('Y-m-d H:i:s'),
					'status'              => $this->input->post('status')
				); 
				$id = $this->admin_model->setUpdateData($this->credit_tarification,$data,$id);	
				$this->session->set_flashdata('message','Your credit tarification has been updated successfully');
		        redirect('admin/credit/list_tarification','refresh');
		    }
        }
		$data['dataCollection']         = $this->admin_model->getDataCollectionByID($this->credit_tarification,$id);
		// print_r($data['dataCollection']);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/credit/edit_tarification',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}




// callback function added by Shiv to check maximum amount of loan is less than minimum amount of loan  
	public function check_max_loan_amount_validation($string) {
    	if($string < $this->input->post('min_loan_amount')) {
        $this->form_validation->set_message('check_max_loan_amount_validation','The {field} can not be less than Minimum Loan Amount. Please try another value.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}



// callback function added by Shiv to check maximum age of customer is less than minimum age of customer  
	public function check_max_customer_age_validation($string) {
		$max_age = date("Y-m-d H:i:s",strtotime($this->input->post('max_customer_age')));
		$min_age = date("Y-m-d H:i:s",strtotime($this->input->post('min_customer_age')));
    	if($max_age >= $min_age) {
        $this->form_validation->set_message('check_max_customer_age_validation','The {field} can not be less than or equal to Minimum Customer Age. Please try another value. So, Please select the date of birth less than that of in minimum age of customer.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}	


// function added by Shiv to get list of credit tarification
	public function list_tarification()	{
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
        $totalCount              = $this->admin_model->totalRecord($this->credit_tarification);
		$data["dataCollection"]  = $this->admin_model->getDataCollection($this->credit_tarification,$limit,$start);
        $totalResult             = count($data['dataCollection']);
		$data["pagination"]      = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/credit/list_tarification',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to delete
	public function delete() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->credit_tarification,$id);
		$this->session->set_flashdata('message','Your credit tarification has been deleted successfully');
        redirect('admin/credit/list_tarification','refresh');
	}

// function to change status
	public function status()
	{
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->credit_tarification,$data,$id);
		$this->session->set_flashdata('message','Your status has been updated successfully');
		redirect('admin/credit/list_tarification','refresh');		
	}

// function added by Shiv to get credit insurance tenure details
	public function credit_insurance_tenure() {
		CheckAdminLoginSession();
		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('user_id', ' Name', 'required');
			$this->form_validation->set_rules('credit_insurance_start_date', ' Insurance Start Date', 'required');
			$this->form_validation->set_rules('credit_insurance_loan_amount', ' Amount Of The Loan', 'required|trim|numeric');
			$this->form_validation->set_rules('credit_insurance_customer_dob', ' Date Of Birth Of Customer', 'required');
			$this->form_validation->set_rules('credit_insurance_expiry_date', ' Insurance Expiry Date', 'required');
			$this->form_validation->set_rules('credit_insurance_loan_duration', ' Duration Of The Loan', 'required|trim|numeric');
			$this->form_validation->set_rules('credit_insurance_loan_size', ' Loan Size', 'required|trim|numeric');
			$this->form_validation->set_rules('credit_bank_loan_monthly_payment',' Bank Loan Monthly Payment','required|trim|numeric');

			if($this->form_validation->run() == FALSE) { } else {
				$current_date = date('Y-m-d H:i:s');
				$data 		  = array (
					'user_id'						=> $this->input->post('user_id'),
					'credit_insurance_start_date'   => date("Y-m-d H:i:s",strtotime($this->input->post('credit_insurance_start_date'))),
					'credit_insurance_loan_amount'  => $this->input->post('credit_insurance_loan_amount'),
					'credit_insurance_customer_dob' => date("Y-m-d H:i:s",strtotime($this->input->post('credit_insurance_customer_dob'))),
					'credit_insurance_customer_age' => $current_date - date("Y-m-d H:i:s",strtotime($this->input->post('credit_insurance_customer_dob'))),
					'credit_insurance_expiry_date'  => date("Y-m-d H:i:s",strtotime($this->input->post('credit_insurance_expiry_date'))),
					'credit_insurance_loan_duration'=> $this->input->post('credit_insurance_loan_duration'),
					'credit_insurance_loan_size'    => $this->input->post('credit_insurance_loan_size'),
					'credit_bank_loan_monthly_payment' => $this->input->post('credit_bank_loan_monthly_payment')
				);
				$result = $this->admin_model->getCreditTarificationData($data,$this->credit_tarification);
				if(count($result) > 0) {
					$id              = $this->admin_model->setInsertData($this->credit_detail,$data);
					redirect('admin/credit/credit_company_insurance/'.$id,'refresh');
				} else {
					$this->session->set_flashdata('message','No records Available');
					redirect('admin/credit/credit_insurance_tenure', 'refresh'); 
				}
			}
		}
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/credit/insurance_tenure');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	public function credit_company_insurance() {
		CheckAdminLoginSession();
		$credit_detail_id           = $this->uri->segment(4);
		$credit_detail              = $this->admin_model->getDataCollectionArrayByID($this->credit_detail,$credit_detail_id);
		$result             	    = $this->admin_model->getCreditTarificationData($credit_detail,'tbl_credit_tarification');
		$data['dataCollection']     = $result;
		$data['credit_detail_id']   = $credit_detail_id;
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/credit/insurance_company_list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


	// function for ajax to set the company credit detail
	function set_company_credit_detail() {
		$data = array (
			'credit_insurance_rate'  => $this->input->post('credit_insurance_rate'),
			'company_selected'       => $this->input->post('company_id'),
			'risque_id'				 => getCreditRisqueId(),
			'credit_tarification_id' => $this->input->post('credit_tarification_id'),
			'modified_date'			 => date("Y-m-d H:i:s")
		);
		$id   		= $this->input->post('credit_detail_id');
		$updated_id = $this->admin_model->setUpdateData($this->credit_detail,$data,$id);
		if ($updated_id > 0) {
			echo $updated_id;
		}
		else {
			echo false;
		}
	}

// function added by Shiv to get the optional warranties for the selected company, branch and risque id in credit insurance tenure
	public function optional_warranties() {
		CheckAdminLoginSession();
		$credit_detail_id      = $this->uri->segment(4);
		$branch_id             = getCreditBranchId();
		$company_id            = getCompanyIdByCreditId($credit_detail_id);
		$risque_id             = getRisqueIdByCreditId($credit_detail_id);
		$post_data 			   = $this->input->post();
		if(!empty($post_data)) {
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_credit_warranty', 'Optional warranty', 'required|trim');
			if($this->form_validation->run() == FALSE) { } else {
				$value_selected_credit_warranty =  explode(",",$this->input->post('value_selected_credit_warranty'));

				foreach ($value_selected_credit_warranty as $warranty_data) {
					$value = explode("-",$warranty_data);
					$data  = array (
						'credit_detail_id'      => $credit_detail_id,
						'optional_warranty_id'  => $value[0],
						'type_of_warranties_id' => $value[1],
						'created_date'          => date('Y-m-d H:i:s'),
						'modified_date'         => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_warranty_credit,$data);
				}
				$this->session->set_flashdata('message','Your Credit Optional Warranty has been added.');
		        redirect('admin/credit/rate_calculation/'.$credit_detail_id,'refresh');

			}	
		}
		$data['optional_warranties'] = $this->admin_model->getOptionalWarranties($company_id,$branch_id,$risque_id);
		$data['credit_detail_id']    = $credit_detail_id;

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/credit/optional_warranties',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function added by Shiv for Fixed Calculation and Variable Calculation
	public function rate_calculation() {
		CheckAdminLoginSession();
		$credit_detail_id 		  = $this->uri->segment(4);
		$data['credit_detail_id'] = $credit_detail_id;
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/credit/rate_calculation',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');

	}


// function added by Shiv to calculate the selected rate (fixed/variable)
	public function get_rate_calculation() {
		CheckAdminLoginSession();
		$credit_detail_id      = $this->input->post('credit_detail_id');
		$rate_calculation_type = $this->input->post('calculation_type');
		$credit_details        = $this->admin_model->getDataCollectionArrayByID($this->credit_detail,$credit_detail_id);

		if($rate_calculation_type == 0) { // Fixed Rate
			$rate_calculation_amount = ($credit_details['credit_insurance_loan_amount']*$credit_details['credit_insurance_rate'])/100;
		} else { // Variable Rate
			
			$loan_initial_amount = $credit_details['credit_insurance_loan_amount'];
			$loan_duration       = $credit_details['credit_insurance_loan_duration'];
			$loan_monthly_pay    = $credit_details['credit_bank_loan_monthly_payment'];
			$loan_insurance_rate = $credit_details['credit_insurance_rate'];

			$amount_years = 0;
			for($j = 1;$j <= $loan_duration;$j++) {
				$amount_year = 0;
				for($i = 12*($j-1);$i < 12*($j);$i++) {
					$amount_month  = ($loan_initial_amount - ($loan_monthly_pay)*($i))*($loan_insurance_rate/100);
					$amount_year += $amount_month;
				}
				$amount_years += $amount_year;
				$amount_by_year[$j] = $amount_year;
			}

			$rate_calculation_amount = $amount_years;
		}

		$data = array (
			'credit_detail_id'	      => $credit_detail_id,
			'rate_calculation_type'   => $rate_calculation_type,
			'rate_calculation_amount' => $rate_calculation_amount,
			'created_date'			  => date("Y-m-d H:i:s"),
			'modified_date'			  => date("Y-m-d H:i:s")
		);

		$updated_id = $this->admin_model->setInsertData($this->credit_calculation_rate_details,$data);
		if($updated_id) {
			foreach ($amount_by_year as $key => $value) {
				$data_amount = array (
					'credit_calculation_rate_details_id' => $updated_id,
					'credit_detail_id'                   => $credit_detail_id,
					'credit_amount_year'                 => $key,
					'credit_amount_value'                => $value,
					'created_date'						 => date("Y-m-d H:i:s")
				);
				$this->admin_model->setInsertData($this->credit_calculation_rate_details_by_year,$data_amount);
			}
			echo $updated_id;
		} else {
			echo '';
		}
	}

// function added by Shiv to show the different price range for each company
	public function can_save_more() {
		CheckAdminLoginSession();
		$credit_calculation_rate_details_id = $this->uri->segment(4);
		$credit_calculation_rate_details    = $this->admin_model->getDataCollectionArrayByID($this->credit_calculation_rate_details,$credit_calculation_rate_details_id);
		
		$rate_calculation_amount            = $credit_calculation_rate_details['rate_calculation_amount'];
		$credit_detail_id 			        = $credit_calculation_rate_details['credit_detail_id'];
		$data['credit_detail_id'] = $credit_detail_id;
		$branch_id                = getCreditBranchId();
		$data['company_id']       = getCompanyIdByCreditId($credit_detail_id);
		$post_data                = $this->input->post();    

		if(empty($this->input->post('company_id'))) {
			$data['companies_id'] = explode(',', $data['company_id']);
		}
		else {
			$data['companies_id'] = $this->input->post('company_id');
		}

		$data['selected_warranty_name_id'] = $this->admin_model->getWarrantiesSelectedCredit($credit_detail_id);

		$data['qwerty']       = getSelectedDatRecordsForSelectedCompanyForCredit($data['selected_warranty_name_id'],$data['companies_id'],$credit_detail_id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/credit/can_save_more',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function added by Shiv to save the final details and the company
	function finalize_company() {
		CheckAdminLoginSession();
		$warranty                = $this->input->post('warranty');
		$company_id              = $this->input->post('company_id');
		$credit_detail_id 		 = $this->input->post('credit_detail_id');
		$rate_calculation_amount = getRateCalculationAmount($credit_detail_id);
		$final_data              = getFinalForSelectedCompanyCredit( explode(',', $warranty) ,explode(',', $company_id),$credit_detail_id,$rate_calculation_amount);
		
		$user_id            	         = getUserIdFromInsuranceDetails($credit_detail_id,$this->credit_detail);
		
		foreach ($final_data as $value) {
			$data = array(
				'value'            => $value['value'],
				'type'             => $value['type'],
				'name'             => $value['name'],
				'company_id'       => $value['company_id'],
				'company_name'     => $value['company_name'],
				'credit_detail_id' => $value['credit_detail_id']
			);
			$this->admin_model->setInsertData($this->finalize_credit_insurance,$data);
		}

		$payment_data = array(
			'policy_number'     => getPolicyId(),
			'insurance_type_id' => 6,
			'user_id'           => $user_id,
			'company_id'        => $company_id,
			'insured_id'        => $credit_detail_id,
			'payment_status'    => 0,
			'payment_method'    => 5, // no payment
			'policy_created_by' => 1,
            'policy_created_for' => getUserRoleIdByUserId($user_id),
            'policy_creater' => $this->session->userdata('admin_id')
		);
		$this->admin_model->setInsertData('tbl_payment',$payment_data);

		echo 1;
		return true;	
	}

	// function to get the finalize vehicle details
	function view_finalize_detail() {
		CheckAdminLoginSession();
		$credit_detail_id   = $this->uri->segment(4);
		$user_id            = getUserIdFromInsuranceDetails($credit_detail_id,$this->credit_detail);
		$data['company_id'] = getCompanyIdByCreditId($credit_detail_id);
		$data['branch_id']  = getCreditBranchId();
		$policy_code 		= getPolicyCodeForCompany($data['company_id']);
		$post_data          = $this->input->post();
		if(!empty($post_data)) {
			$policy_prefix = $this->input->post('policy_prefix');
			if(empty($this->input->post('policy_prefix'))) {
				$policy_number = getAutogeneratedPolicyNumber($data['company_id']);
			} else {
				if(checkPolicyNumberExists($policy_code."/".$policy_prefix) > 0) {
					$this->session->set_flashdata('message','Policy Number Already Exists. Please Enter another Policy Number');
					redirect('admin/credit/view_finalize_detail/'.$credit_detail_id);
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
				$record = array(
				'value'            => $value,
				'type'             => 'other_required_data',
				'name'             => $key,
				'company_id'       => $this->input->post('company_id'),
				'company_name'     => $this->input->post('company_name'),
				'credit_detail_id' => $credit_detail_id
			);
			$this->admin_model->setInsertData($this->finalize_credit_insurance,$record);
			}
			
			$insurance_type_id  = $this->input->post('insurance_type_id');
			/*$data = array (
				'user_id'			=> $user_id,
				'insured_id'        => $credit_detail_id,
				'insurance_type_id' => $insurance_type_id,
				'amount'            => $this->input->post('total_premium'),
				'accessories_id'    => $this->input->post('accessories_id')
			);
			$this->session->set_userdata('user_payment_data',$data);
			redirect('admin/payment/proceed-to-pay/'.$credit_detail_id,'refresh');*/

			$payment_id         = getPaymentIdByInsurerIdInsuranceType($credit_detail_id,$insurance_type_id);
			$data_payment = array(
				'policy_number' => $policy_number,
	            'amount' 	    => $this->input->post('total_premium'),
	            'modified_date' => date("Y-m-d H:i:s")
	        );

        	$updated_payment_id = $this->admin_model->setUpdateData('tbl_payment', $data_payment, $payment_id);
			redirect('admin/questionaries/'.$updated_payment_id);
			//redirect('admin/payment/proceed-to-pay/'.$updated_payment_id);
		}

		$data['final_data']              = $this->admin_model->getFinalCreditInsuranceDetail($this->finalize_credit_insurance,$credit_detail_id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/credit/view_finalize_detail',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


	// function added by Shiv to show the Credit Insurance Policies
	public function credit_policies() {
		CheckAdminLoginSession();
		$data['dataCollection'] = $this->admin_model->getPoliciesByInsuranceTypeId(6);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/credit/credit_policies',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


	public function credit_policy_detail() {
		CheckAdminLoginSession();
		$data['policy_number']       = $this->uri->segment(4);
		$data['credit_detail_id']    = $this->uri->segment(5);
		$array_id 				     = array ('cerdit_detail_id' => $data['cerdit_detail_id']);
		$data['credit_detail']        = $this->admin_model->getDataCollectionArrayByID($this->credit_detail,$data['credit_detail_id']);

		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$policy_number = $this->input->post('policy_number');
			$current_date  = date('Y-m-d H:i:s');
			if($policy_number == $data['policy_number']) {
				$credit_details 		  = array (
					'credit_insurance_start_date'      => date("Y-m-d H:i:s",strtotime($this->input->post('credit_insurance_start_date'))),
					'credit_insurance_loan_amount'     => $this->input->post('credit_insurance_loan_amount'),
					'credit_insurance_customer_dob'    => date("Y-m-d H:i:s",strtotime($this->input->post('credit_insurance_customer_dob'))),
					'credit_insurance_customer_age'    => $current_date - date("Y-m-d H:i:s",strtotime($this->input->post('credit_insurance_customer_dob'))),
					'credit_insurance_expiry_date'     => date("Y-m-d H:i:s",strtotime($this->input->post('credit_insurance_expiry_date'))),
					'credit_insurance_loan_duration'   => $this->input->post('credit_insurance_loan_duration'),
					'credit_insurance_loan_size'       => $this->input->post('credit_insurance_loan_size'),
					'credit_bank_loan_monthly_payment' => $this->input->post('credit_bank_loan_monthly_payment'),
					'risque_id'          			   => $data['credit_detail']['risque_id'],
					'company_selected'   			   => $data['credit_detail']['company_selected'],
					'modified_date'      			   => date('Y-m-d H:i:s')
				);
				$result = $this->admin_model->getCreditTarificationDataForSelectedCompany($credit_details,$this->credit_tarification);
				if(count($result) > 0) {
					$id = $this->admin_model->setUpdateData($this->credit_detail,$credit_details,$data['credit_detail_id']);
					redirect('admin/credit/credit_policies_edit/'.$policy_number.'/'.$id);
				} else {
					$this->session->set_flashdata('message','No records Available');
					redirect('admin/credit/credit_policy_detail/'.$data['policy_number'].'/'.$data['credit_detail_id'], 'refresh'); 
				}
			} else {
				$credit_details_to_insert 		  = array (
					'user_id'                          => $data['credit_detail']['user_id'],
					'credit_insurance_start_date'      => date("Y-m-d H:i:s",strtotime($this->input->post('credit_insurance_start_date'))),
					'credit_insurance_loan_amount'     => $this->input->post('credit_insurance_loan_amount'),
					'credit_insurance_customer_dob'    => date("Y-m-d H:i:s",strtotime($this->input->post('credit_insurance_customer_dob'))),
					'credit_insurance_customer_age'    => $current_date - date("Y-m-d H:i:s",strtotime($this->input->post('credit_insurance_customer_dob'))),
					'credit_insurance_expiry_date'     => date("Y-m-d H:i:s",strtotime($this->input->post('credit_insurance_expiry_date'))),
					'credit_insurance_loan_duration'   => $this->input->post('credit_insurance_loan_duration'),
					'credit_insurance_loan_size'       => $this->input->post('credit_insurance_loan_size'),
					'credit_bank_loan_monthly_payment' => $this->input->post('credit_bank_loan_monthly_payment'),
					'risque_id'          			   => $data['credit_detail']['risque_id'],
					'company_selected'   			   => $data['credit_detail']['company_selected'],
					'credit_tarification_id'           => $data['credit_detail']['credit_tarification_id'],
					'created_date'                     => date('Y-m-d H:i:s'),
					'modified_date'      			   => date('Y-m-d H:i:s')
				);
				$result = $this->admin_model->getCreditTarificationDataForSelectedCompany($credit_details_to_insert,$this->credit_tarification);

				if(count($result) > 0) {
					$credit_insurance_old_info = array (
						'old_policy_number' => $data['policy_number'],
						'old_insured_id'    => $data['credit_detail_id']
					);   
					$this->session->set_userdata('old_credit_insurance_info',$credit_insurance_old_info);
					$id = $this->admin_model->setInsertData($this->credit_detail,$credit_details_to_insert);
					redirect('admin/credit/credit_policies_edit/'.$policy_number.'/'.$id);
				} else {
					$this->session->set_flashdata('message','No records Available');
					redirect('admin/credit/credit_policy_detail/'.$data['policy_number'].'/'.$data['credit_detail_id'], 'refresh');
				}
			}
		}
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/credit/credit_policy_detail',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


	// function added by Shiv to edit the credit insurance policy
	public function credit_policies_edit() {
		CheckAdminLoginSession();
		$credit_old_info = $this->session->userdata('old_credit_insurance_info');
		$data['policy_number']       = $this->uri->segment(4);
		$data['credit_detail_id']    = $this->uri->segment(5);
		$data['branch_id']           = getCreditBranchId();
		$data['company_id']          = getCompanyIdByCreditId($data['credit_detail_id']);
		$data['risque_id']           = getRisqueIdByCreditId($data['credit_detail_id']);
		$array_id 				     = array ('credit_detail_id' => $data['credit_detail_id']);
		$company_array[0]            = $data['company_id'];
		$data['optional_warranties'] = $this->admin_model->getOptionalWarranties($data['company_id'],$data['branch_id'],$data['risque_id']);

		
		if(!empty($credit_old_info)) {
			$data['selected_warranties'] = getSelectedOptionalWarrantiesCredit($this->selected_optional_warranty_credit,array ('credit_detail_id' => $credit_old_info['old_insured_id']));
		} else {
			$data['selected_warranties'] = getSelectedOptionalWarrantiesCredit($this->selected_optional_warranty_credit,$array_id);	
		}

		$data['credit_detail']             = $this->admin_model->getDataCollectionArrayByID($this->credit_detail,$data['credit_detail_id']);

		$data['credit_insurance_company']  = $this->admin_model->getCreditTarificationDataForSelectedCompany($data['credit_detail'],'tbl_credit_tarification');
		
		$data['credit_rate_calculation_type']  = getCreditRateCalculationType($data['credit_detail_id']);



		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('credit_tarification_id', 'Insurance Rate', 'required|trim');
			if($this->form_validation->run() == FALSE) { } else {
				$policy_number 		   = $this->input->post('policy_number');
				$optional_warranties   = $this->input->post('optional_warranties_credit');
				$calculation_type_edit = $this->input->post('calculation_type_edit');
				$credit_insurance_rate = $this->input->post('insurance_company_rate');
				$credit_insurance_loan_amount = $this->input->post('');
				if($policy_number == $data['policy_number']) {

					if(empty($credit_old_info)) {


						// Update the insurance rate of the company
						$credit_detail_to_update = array (
							'credit_tarification_id' => $this->input->post('credit_tarification_id'),
							'credit_insurance_rate' => $this->input->post('insurance_company_rate_credit'),
							'modified_date'         => date('Y-m-d H:i:s')
						);
						$this->admin_model->setUpdateData($this->credit_detail,$credit_detail_to_update,$data['credit_detail_id']);

						// Delete Optional Warranties
						$this->admin_model->deleteOptionalWarranties($this->selected_optional_warranty_credit,$array_id);

						// Insert Optional Warranties
						foreach ($optional_warranties as $value) {
							$inserted_warranties = array(
								'optional_warranty_id'  => $value,
								'credit_detail_id'      => $data['credit_detail_id'],
								'type_of_warranties_id' => getWarrantyTypeId($value),
								'created_date'          => date('Y-m-d H:i:s'),
								'modified_date'         => date('Y-m-d H:i:s')
							);
							$id                = $this->admin_model->setInsertData($this->selected_optional_warranty_credit,$inserted_warranties);
						}


						$updated_credit_details = $this->admin_model->getDataCollectionByID($this->credit_detail,$data['credit_detail_id']);

						// Updating Rate Calculation Details
						if($calculation_type_edit == 0) { // Fixed Rate
							$rate_calculation_amount = ($updated_credit_details->credit_insurance_loan_amount*$credit_insurance_rate)/100;
						} else { // Variable Rate
							$rate_calculation_amount_data = getVariableRateCalculationAmount($updated_credit_details,$insurance_rate);
							$rate_calculation_amount = $rate_calculation_amount_data['rate_calculation_amount'];
						}

						$credit_calculation_rate_details_id = getCreditRateCalculationId($data['credit_detail_id']);
						$rate_calculation_to_update = array (
							'credit_detail_id'	      => $data['credit_detail_id'],
							'rate_calculation_type'   => $calculation_type_edit,
							'rate_calculation_amount' => $rate_calculation_amount,
							'created_date'			  => date("Y-m-d H:i:s"),
							'modified_date'			  => date("Y-m-d H:i:s")
						);

						$this->admin_model->setUpdateData($this->credit_calculation_rate_details,$rate_calculation_to_update,$credit_calculation_rate_id);
						
						if($calculation_type_edit == 1) {
							// Delete the Old Calculation Rate Details
							$this->admin_model->deleteInsuredPeopleDetails($this->credit_calculation_rate_details_by_year,$array_id);

							// Insert the Calculation Amount by Year
							$rate_calculation_amount_data = getVariableRateCalculationAmount($updated_credit_details,$insurance_rate);
							$amount_by_year = $rate_calculation_amount_data['amount_by_year'];
							foreach ($amount_by_year as $key => $value) {
								$data_amount = array (
									'credit_calculation_rate_details_id' => $credit_calculation_rate_details_id,
									'credit_detail_id'                   => $data['credit_detail_id'],
									'credit_amount_year'                 => $key,
									'credit_amount_value'                => $value,
									'created_date'						 => date("Y-m-d H:i:s")
								);
								$this->admin_model->setInsertData($this->credit_calculation_rate_details_by_year,$data_amount);
							}
						}

						$data['selected_warranty_name_id']        = $this->admin_model->getWarrantiesSelectedForCredit($data['credit_detail_id']);

						// Delete old finalized data
						$this->admin_model->deleteFinalizedData($this->finalize_credit_insurance,$array_id);


						// Insert the Updated Finalized Data
						$final_data              = getFinalForSelectedCompanyCredit( $data['selected_warranty_name_id'],$company_array,$data['credit_detail_id'],$rate_calculation_amount);

						foreach ($final_data as $value) {
							$data_final = array(
								'value'            => $value['value'],
								'type'             => $value['type'],
								'name'             => $value['name'],
								'company_id'       => $value['company_id'],
								'company_name'     => $value['company_name'],
								'credit_detail_id' => $value['credit_detail_id']
							);
							$this->admin_model->setInsertData($this->finalize_credit_insurance,$data_final);
						}

						// Get the inserted finalized data
						$data['finalized_details']              = $this->admin_model->getFinalCreditInsuranceDetail($this->finalize_credit_insurance,$data['credit_detail_id']);

						// Calculate Net Premium and Accessories
					    foreach ($data['finalized_details'] as $record) {
					      if ($record->type == 'warranties') {
					        $total_amount +=$record->value;
					        $warranties_name[] = $record->name;
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
								'value'            => $value,
								'type'             => 'other_required_data',
								'name'             => $key,
								'company_id'       => $data['company_id'],
								'company_name'     => getCompanyName($data['company_id']),
								'credit_detail_id' => $data['credit_detail_id']
							);
							$this->admin_model->setInsertData($this->finalize_credit_insurance,$record);
						}
						// Update Data into Payment Table
						$payment_id         = getPaymentIdByInsurerIdInsuranceType($data['credit_detail_id'],6);
						$payment_details    = $this->admin_model->getDataCollectionByID('tbl_payment',$payment_id);
						$old_payment_amount = $payment_details->amount;

						$payment_data = array (
							'amount'		=> $total_premium,
							'modified_date' => date("Y-m-d H:i:s")
						);
						$update_payment_id = $this->admin_model->setUpdateData('tbl_payment',$payment_data,$payment_id);

						// Update Data into Quittance Table
						$insurance_details = getFinalizedInsuranceDetails($data['credit_detail_id'],6);
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
						$credit_detail_to_update = array (
							'credit_tarification_id' => $this->input->post('credit_tarification_id'),
							'modified_date'         => date('Y-m-d H:i:s')
						);
						$this->admin_model->setUpdateData($this->credit_detail,$credit_detail_to_update,$data['credit_detail_id']);

						// Insert Optional Warranties
						foreach ($optional_warranties as $value) {
							$inserted_warranties = array(
								'optional_warranty_id'  => $value,
								'credit_detail_id'      => $data['credit_detail_id'],
								'type_of_warranties_id' => getWarrantyTypeId($value),
								'created_date'          => date('Y-m-d H:i:s'),
								'modified_date'         => date('Y-m-d H:i:s')
							);
							$id                = $this->admin_model->setInsertData($this->selected_optional_warranty_credit,$inserted_warranties);
						}

						$updated_credit_details = $this->admin_model->getDataCollectionByID($this->credit_detail,$data['credit_detail_id']);
						

						// Updating Rate Calculation Details
						if($calculation_type_edit == 0) { // Fixed Rate
							$rate_calculation_amount = ($updated_credit_details->credit_insurance_loan_amount*$credit_insurance_rate)/100;
						} else { // Variable Rate
							$rate_calculation_amount_data = getVariableRateCalculationAmount($updated_credit_details,$insurance_rate);
							$rate_calculation_amount = $rate_calculation_amount_data['rate_calculation_amount'];
						}

						// Insert Rate Calculation Details
						$rate_calculation_to_insert = array (
							'credit_detail_id'	      => $data['credit_detail_id'],
							'rate_calculation_type'   => $calculation_type_edit,
							'rate_calculation_amount' => $rate_calculation_amount,
							'created_date'			  => date("Y-m-d H:i:s"),
							'modified_date'			  => date("Y-m-d H:i:s")
						);

						$credit_calculation_rate_id = $this->admin_model->setInsertData($this->credit_calculation_rate_details,$rate_calculation_to_insert);
						
						if($calculation_type_edit == 1) {
							// Delete the Old Calculation Rate Details
							$this->admin_model->deleteInsuredPeopleDetails($this->credit_calculation_rate_details_by_year,$array_id);

							// Insert the Calculation Amount by Year
							$rate_calculation_amount_data = getVariableRateCalculationAmount($updated_credit_details,$insurance_rate);
							$amount_by_year = $rate_calculation_amount_data['amount_by_year'];
							foreach ($amount_by_year as $key => $value) {
								$data_amount = array (
									'credit_calculation_rate_details_id' => $credit_calculation_rate_details_id,
									'credit_detail_id'                   => $data['credit_detail_id'],
									'credit_amount_year'                 => $key,
									'credit_amount_value'                => $value,
									'created_date'						 => date("Y-m-d H:i:s")
								);
								$this->admin_model->setInsertData($this->credit_calculation_rate_details_by_year,$data_amount);
							}
						}

						$data['selected_warranty_name_id']        = $this->admin_model->getWarrantiesSelectedForCredit($data['credit_detail_id']);
						// Insert Finalized Data
						$final_data = getFinalForSelectedCompanyCredit($data['selected_warranty_name_id'],$company_array,$data['credit_detail_id'],$rate_calculation_amount);
						foreach ($final_data as $value) {
							$data_final = array(
								'value'            => $value['value'],
								'type'             => $value['type'],
								'name'             => $value['name'],
								'company_id'       => $value['company_id'],
								'company_name'     => $value['company_name'],
								'credit_detail_id' => $value['credit_detail_id']
							);

							$this->admin_model->setInsertData($this->finalize_credit_insurance,$data_final);
						}


						// Get the inserted finalized data
						$data['finalized_details']              = $this->admin_model->getFinalCreditInsuranceDetail($this->finalize_credit_insurance,$data['credit_detail_id']);
						
						// Calculate Net Premium and Accessories
						// $total_amount = 0;
					    foreach ($data['finalized_details'] as $record) {
					      if ($record->type == 'warranties') {
					        $total_amount +=$record->value;
					        $warranties_name[] = $record->name;
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
								'value'           => $value,
								'type'            => 'other_required_data',
								'name'            => $key,
								'company_id'      => $data['company_id'],
								'company_name'    => getCompanyName($data['company_id']),
								'credit_detail_id' => $data['credit_detail_id']
							);
							$this->admin_model->setInsertData($this->finalize_credit_insurance,$record);
						}

						// Insert Data into Payment Table
						$old_payment_id = getPaymentIdByInsurerIdInsuranceType($credit_old_info['old_insured_id'],6);
						$old_payment_details = $this->admin_model->getDataCollectionByID('tbl_payment',$old_payment_id);
						$old_payment_amount = $old_payment_details->amount;

						$payment_data_to_insert = array (
							'policy_number'     => checkUniquePolicyId($policy_number),
							'insurance_type_id' => 6,
							'user_id'           => $old_payment_details->user_id,
							'company_id'        => $old_payment_details->company_id,
							'insured_id'        => $data['credit_detail_id'],
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
						$old_quittance_id      = getQuittanceId($credit_old_info['old_policy_number']);
						$old_quittance_details = $this->admin_model->getDataCollectionByID('tbl_quittance',$old_quittance_id);
						$new_insurance_details = getFinalizedInsuranceDetails($data['credit_detail_id'],6);


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

					$this->session->unset_userdata('old_credit_insurance_info');
				} 


				if($amount_difference > 0) {
					$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You have to pay the amount of ".abs($amount_difference)." to the Admin";
				} else if($amount_difference < 0){
					$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You have to recieve the amount of <b>".abs($amount_difference)."</b> from the Admin";
				} else {
					$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You don't have to pay/recieve any amount from the Admin";
				}
				// $amount_difference = diffPolicyTotalAmount($old_payment_amount,$insurance_details['total_premium']);
				$user_id            	     = getUserIdFromInsuranceDetails($data['credit_detail_id'],$this->credit_detail);
				
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
					'{{insurance_type}}'          =>  getInsuranceType(6).' INSURANCE',
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
					'{{insurance_type}}'          =>  getInsuranceType(6).' INSURANCE',
					'{{policy_number}}'           =>  $data['policy_number'],
					'{{amount_difference}}'       =>  $admin_amount_message,
					'{{email}}'                   => getAdminEmail()
				);
				$admin_message     = email_compose($admin_email_template,$admin_templateTags);

				$admin_email       = getAdminEmail();
				$admin_subject     = SEND_POLICY_UPDATION_MAIL;
				if (send_smtp_mail($admin_email,$admin_subject,$admin_message)) {
					$this->session->set_flashdata('message',POLICY_UPDATE_SUCCESS_MESSAGE);
		        	redirect('admin/credit/credit_policies','refresh');
				}
			}
		}



		//die;
		//die;
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/credit/credit_policies_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}
}
