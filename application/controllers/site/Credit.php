<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credit extends CI_Controller {

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
    	$this->load->model('login_model'); 
    	$this->load->model('front_model'); 
    	$this->load->helper('front_helper');
	}


	public $credit_tarification 		 	  = 'tbl_credit_tarification';
	public $credit_detail 		              = 'tbl_credit_detail';
	public $selected_optional_warranty_credit = 'tbl_selected_optional_warranty_credit';
	public $credit_calculation_rate_details   = 'tbl_credit_calculation_rate_details';
	public $finalize_credit_insurance 		  = 'tbl_finalize_credit_insurance';
	public $credit_calculation_rate_details_by_year = 'tbl_credit_calculation_rate_details_by_year';

	// function to add the basic info by Shiv
	public function basic_info() {
		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('credit_insurance_start_date', ' Insurance Start Date', 'required');
			$this->form_validation->set_rules('credit_insurance_loan_amount', ' Amount Of The Loan', 'required|trim|numeric');
			$this->form_validation->set_rules('credit_insurance_customer_dob', ' Date Of Birth Of Customer', 'required');
			$this->form_validation->set_rules('credit_insurance_expiry_date', ' Insurance Expiry Date', 'required');
			$this->form_validation->set_rules('credit_insurance_loan_duration', ' Duration Of The Loan', 'required|trim|numeric');
			$this->form_validation->set_rules('credit_insurance_loan_size', ' Loan Size', 'required|trim|numeric');
			$this->form_validation->set_rules('credit_bank_loan_monthly_payment',' Bank Loan Monthly Payment','required|trim|numeric');

			if($this->form_validation->run() == FALSE) {   } else {
				$current_date = date("Y-m-d H:i:s");
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
				$result = $this->front_model->getCreditTarificationData($data,$this->credit_tarification);
				if (count($result)>0) {
					$id              = $this->front_model->setInsertData($this->credit_detail,$data);
					redirect('credit/credit-company-insurance/'.$id,'refresh');
				}
				else {
					$this->session->set_flashdata('message','No records Available');
					redirect('credit', 'refresh'); 
				}
			}
		}
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/credit/basic_info');
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
	}


	function basic_info1() {
    	if (!$this->session->userdata('user_id')) {
    		echo 0;
    	}
    	else {
    		$loggedin_user_role = getUserRoleIdByUserId($this->session->userdata('user_id'));
    		if($loggedin_user_role == 3) { // Partner
    			echo 1;
    		} else {
    			echo $this->session->userdata('user_id');
    		}
    	}
    }

    public function credit_company_insurance() {
    	CheckLoginSession();
    	$credit_detail_id           = $this->uri->segment(3);
		$credit_detail              = $this->front_model->getDataCollectionArrayByID($this->credit_detail,$credit_detail_id);
		$result             	    = $this->front_model->getCreditTarificationData($credit_detail,'tbl_credit_tarification');
		$data['dataCollection']     = $result;
		$data['credit_detail_id']   = $credit_detail_id;
    	$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/credit/insurance_company_list',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
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
		$updated_id = $this->front_model->setUpdateData($this->credit_detail,$data,$id);
		if ($updated_id > 0) {
			echo $updated_id;
		}
		else {
			echo false;
		}
	}


	public function optional_warranties() {
		CheckLoginSession();
		$credit_detail_id      = $this->uri->segment(3);
		$branch_id             = getCreditBranchId();
		$company_id            = getCompanyIdByCreditId($credit_detail_id);
		$risque_id             = getRisqueIdByCreditId($credit_detail_id);

		$post_data = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_credit_warranty', 'Optional warranty', 'required|trim');	
			if($this->form_validation->run() == FALSE) {  } else {
				$value_selected_credit_warranty = explode(',', $this->input->post('value_selected_credit_warranty'));
				foreach ($value_selected_credit_warranty as $value) {
					$data = array(
						'optional_warranty_id'    => $value,
						'credit_detail_id'        => $credit_detail_id,
						'created_date'            => date('Y-m-d H:i:s'),
						'modified_date'           => date('Y-m-d H:i:s')
					);

					$id                = $this->front_model->setInsertData($this->selected_optional_warranty_credit,$data);
				}
				$this->session->set_flashdata('message','Your Credit Optional Warranty has been added.');
		        redirect('credit/rate-calculation/'.$credit_detail_id,'refresh');
			}
		}


		$data['optional_warranties'] = $this->front_model->getOptionalWarranties($company_id,$branch_id,$risque_id);
		$data['credit_detail_id']    = $credit_detail_id;
		

		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/credit/optional_warranties',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
	}


// function added by Shiv for Fixed Calculation and Variable Calculation
	public function rate_calculation() {
		CheckLoginSession();
		$credit_detail_id 		  = $this->uri->segment(3);
		$data['credit_detail_id'] = $credit_detail_id;
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/credit/rate_calculation',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');

	}

	// function added by Shiv to calculate the selected rate (fixed/variable)
	public function get_rate_calculation() {
		CheckLoginSession();
		$credit_detail_id      = $this->input->post('credit_detail_id');
		$rate_calculation_type = $this->input->post('calculation_type');
		$credit_details        = $this->front_model->getDataCollectionArrayByID($this->credit_detail,$credit_detail_id);

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

		$updated_id = $this->front_model->setInsertData($this->credit_calculation_rate_details,$data);
		if($updated_id) {
			foreach ($amount_by_year as $key => $value) {
				$data_amount = array (
					'credit_calculation_rate_details_id' => $updated_id,
					'credit_detail_id'                   => $credit_detail_id,
					'credit_amount_year'                 => $key,
					'credit_amount_value'                => $value,
					'created_date'						 => date("Y-m-d H:i:s")
				);
				$this->front_model->setInsertData($this->credit_calculation_rate_details_by_year,$data_amount);
			}
			echo $updated_id;
		} else {
			echo '';
		}
	}


	public function can_save_more() {
		CheckLoginSession();
		$credit_calculation_rate_details_id = $this->uri->segment(3);
		$credit_calculation_rate_details    = $this->front_model->getDataCollectionArrayByID($this->credit_calculation_rate_details,$credit_calculation_rate_details_id);
		$rate_calculation_amount            = $credit_calculation_rate_details['rate_calculation_amount'];
		$credit_detail_id 			        = $credit_calculation_rate_details['credit_detail_id'];
		$data['credit_detail_id'] = $credit_detail_id;
		$branch_id                = getCreditBranchId();
		$data['company_id']       = getCompanyIdByCreditId($credit_detail_id);
		$post_data = $this->input->post();
		if(empty($this->input->post('company_id'))) {
			$data['companies_id'] = explode(',', $data['company_id']);
		}
		else {
			$data['companies_id'] = $this->input->post('company_id');
		}

		$data['selected_warranty_name_id'] = $this->front_model->getWarrantiesSelectedCredit($credit_detail_id);

		$data['qwerty']       = getSelectedDatRecordsForSelectedCompanyForCredit($data['selected_warranty_name_id'],$data['companies_id'],$credit_detail_id);
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/credit/can_save_more',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
	}


	// function added by Shiv to save the final details and the company
	function finalize_company() {
		CheckLoginSession();
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
			$this->front_model->setInsertData($this->finalize_credit_insurance,$data);
		}

		$payment_data = array(
			// 'policy_number'     => getPolicyId(),
			'policy_number'     => getAutogeneratedPolicyNumber($company_id),
			'insurance_type_id' => 6,
			'user_id'           => $user_id,
			'company_id'        => $company_id,
			'insured_id'        => $credit_detail_id,
			'payment_status'    => 0,
			'payment_method'    => 5, // no payment
			'policy_created_by' => getUserRoleIdByUserId($this->session->userdata('user_id')),
			'policy_created_for' => getUserRoleIdByUserId($user_id),
			'policy_creater'     => $this->session->userdata('user_id'),
		);
		$this->front_model->setInsertData('tbl_payment',$payment_data);

		echo 1;
		//return true;	
	}


// function to get the finalize vehicle details
	function view_finalize_detail() {
		CheckLoginSession();
		$credit_detail_id                = $this->uri->segment(3);
		$user_id            	         = getUserIdFromInsuranceDetails($credit_detail_id,$this->credit_detail);
		$data['company_id']              = getCompanyIdByCreditId($credit_detail_id);
		$data['branch_id']               = getCreditBranchId();
		$post_data              = $this->input->post();
		if(!empty($post_data)) {
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
				'company_id'       => $data['company_id'],
				'company_name'     => $this->input->post('company_name'),
				'credit_detail_id' => $credit_detail_id
			);
			$this->front_model->setInsertData($this->finalize_credit_insurance,$record);
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
			redirect('payment/proceed-to-pay/'.$credit_detail_id,'refresh');*/
			$payment_id         = getPaymentIdByInsurerIdInsuranceType($credit_detail_id,$insurance_type_id);
			$data_payment = array(
	            'amount' 	    => $this->input->post('total_premium'),
	            'modified_date' => date("Y-m-d H:i:s")
	        );

        	$updated_payment_id = $this->front_model->setUpdateData('tbl_payment', $data_payment, $payment_id);
			redirect('questionaries/'.$updated_payment_id);
			//redirect('payment/proceed-to-pay/'.$updated_payment_id);
		}

		$data['final_data']              = $this->front_model->getFinalCreditInsuranceDetail($this->finalize_credit_insurance,$credit_detail_id);

		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/credit/view_finalize_detail',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
	}

}
