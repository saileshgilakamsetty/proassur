<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Individualaccident extends CI_Controller {

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

	public $individual_accident_insurance_options      = 'tbl_individual_accident_insurance_options';
	public $individual_accident_activity               = 'tbl_activity';
	public $company_individual_accident_activity       = 'tbl_company_individual_accident_activity';
	public $individual_accident_quote_personal_details = 'tbl_individual_accident_quote_personal_details';
	public $individual_insurance_option_details        = 'tbl_individual_insurance_option_details';
	public $individual_accident_finalize_company 	   = 'tbl_individual_accident_finalize_company';
	public $multiple_companies_activity 			   = 'tbl_multiple_companies_activity';

	// function added by Shiv to add basic info
	public function basic_info() {
		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('address', 'Address ', 'required|trim');		
			$this->form_validation->set_rules('business_address', 'Business Address', 'required|trim');
			$this->form_validation->set_rules('dial_code', 'Dial Code', 'required|trim');		
			$this->form_validation->set_rules('mobile', 'Contact Number', 'required|trim|numeric');
			if($this->form_validation->run() == FALSE) { } else {
				if($_FILES["attach_document"]["name"] != "") {
					$image             = do_upload('individual_accident_quote','attach_document');
				}
				$data = array (
					// 'user_id'		   => $this->session->userdata('user_id'),
					'user_id'		   => $this->input->post('user_id'),
					'name' 			   => $this->input->post('name'),
					'address' 		   => $this->input->post('address'),
					'business_address' => $this->input->post('business_address'),
					'dial_code'		   => $this->input->post('dial_code'),
					'contact_number'   => $this->input->post('mobile'),
					'document'		   => ($image)?$image:'',
					'tacit_policy'     => $this->input->post('tacit_policy'),
					'created_date'     => date('Y-m-d H:i:s')
				);
				$id = $this->front_model->setInsertData($this->individual_accident_quote_personal_details,$data);
				if($id > 0) {
					redirect('individual-accident/individual-accident-quote-activity/'.$id,'refresh');
				}
			}
		}
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/individual_accident/basic_info');
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
	}


	// function to add the basic info by Shiv
	/*function basic_info1() {
    	if (!$this->session->userdata('user_id')) {
    		echo 0;
    	}
    	else {
    		echo $this->session->userdata('user_id');
    	}
    }*/

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

// function added by Shiv to select the activity 
    public function individual_accident_quote_activity() {
    	CheckLoginSession();
    	$individual_accident_quote_id = $this->uri->segment(3);
    	$post_data                    = $this->input->post();
    	if(!empty($post_data)) {
    		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('individual_accident_activity_id', 'Activity', 'required');
			if($this->form_validation->run() == FALSE) { } else {
				$data = array (
					'individual_accident_activity_id' => $post_data['individual_accident_activity_id']
				);
				$this->front_model->setUpdateData($this->individual_accident_quote_personal_details,$data,$individual_accident_quote_id);
				redirect('individual-accident/individual-accident-quote-company/'.$individual_accident_quote_id,'refresh');
			}
    	}
    	$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/individual_accident/individual_accident_quote_activity');
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }


// function added by Shiv to get the list of companies for the selected companies
    public function individual_accident_quote_company() {
    	CheckLoginSession();
    	$data['individual_accident_quote_id']    = $this->uri->segment(3);
		$data['individual_accident_activity_id'] = getIndividualAccidentPersonDetails($data['individual_accident_quote_id']);
		$individual_accident_activity_id = $data['individual_accident_activity_id'];
		$data['company_id_array'] = getCompaniesIdByIndividualAccidentActivityId($individual_accident_activity_id);
    	$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/individual_accident/individual_accident_quote_company',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');	
    }


// function added by Shiv to get the insurance option details for the selected activity and company
    public function insurance_options_details() {
    	CheckLoginSession();
    	$data['individual_accident_quote_id'] = $this->uri->segment(3);
		$quote_id 							  = $data['individual_accident_quote_id'];
		$data['selected_company_id']          = $this->uri->segment(4);
		$company_id 						  = $data['selected_company_id'];
		$post_data 							  = $this->input->post();
		if(!empty($post_data)) {
			$options_data = array (
				'individual_accident_quote_id' => $quote_id,
				'selected_company_id'          => $company_id,
				'individual_accident_insurance_requirement' => $this->input->post('individual_accident_insurance_requirement'),
				'accident_insurance_optionid'  => $this->input->post('accident_insurance_optionid'),
				'amount_to_pay'				   => $this->input->post('amount_to_pay') 
			);
			$id = $this->front_model->setInsertData($this->individual_insurance_option_details,$options_data);
			if($id > 0) {
				redirect('individual-accident/get-estimation/'.$id,'refresh');
			}
		}
		$activity_id 						  = getActivtiyIdByAccidentQuoteId($quote_id);
        $data['insurance_options']            = getAccidentInsuranceOptions($activity_id,$company_id);
    	$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/individual_accident/insurance_options_details',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');	
    }


// function added by Shiv to get the estimation price for the companies
    public function get_estimation() {
    	CheckLoginSession();
    	$data['individual_insurance_option_details_id'] = $this->uri->segment(3);
    	$individual_accident_examination_list_array = getIndividualAccidentExaminationList();
		$company_array                 = getCompanyIds();
		$data['qwerty']                = getIndividualAccidentCompanyComparision($individual_accident_examination_list_array,$company_array);
    	$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/individual_accident/get_individual_accident_estimation',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');	
    }


// function added by Shiv to get finalize company for individual accident insurance
	public function finalize_company() {
		CheckLoginSession();
		$company_id 							 = $this->input->post('company_id');
		$individual_insurance_option_details_id  = $this->input->post('individual_insurance_option_details_id');
		$individual_accident_quote_id            = getIndividualAccidentQuoteId($individual_insurance_option_details_id);
		$user_id            		             = getUserIdFromInsuranceDetails($individual_accident_quote_id,$this->individual_accident_quote_personal_details);
		$record     = $this->front_model->getDataOfIndividualAccidentToInsertForSelectedCompany($company_id);
		foreach ($record as $key => $value) {
			$data = array(
				'individual_insurance_option_details_id' => $individual_insurance_option_details_id,
				'individual_accident_insurance_options_id' => $value->id,
				'individual_accident_activity_id' => $value->individual_accident_activity_id,
				'title'          => $value->title,
				'amount_to_pay'  => $value->amount_to_pay,
				'company_id'     => $value->company_id,
				'company_name'   => getCompanyName($value->company_id),
				'death'			 => $value->death,
				'disability'	 => $value->disability,
				'medical_fees'	 => $value->medical_fees,
			);
			$this->front_model->setInsertData($this->individual_accident_finalize_company, $data);
		}
		$payment_data = array(
			// 'policy_number'      => getPolicyId(),
			'policy_number'     => getAutogeneratedPolicyNumber($company_id),
			'insurance_type_id'  => 5,
			'user_id'            => $user_id,
			'company_id'		 => $company_id,
			'insured_id'         => $individual_accident_quote_id,
			'payment_status'     => 0,
			'payment_method'     => 5, // no payment
			'policy_created_by'  => getUserRoleIdByUserId($this->session->userdata('user_id')),
			'policy_created_for' => getUserRoleIdByUserId($user_id),
			'policy_creater'     => $this->session->userdata('user_id'),     
		);
		$this->front_model->setInsertData('tbl_payment',$payment_data);
		echo 1;
		//return true;
	}

// function added by Shiv to show the finalized company details
	public function view_finalize_detail() {
		CheckLoginSession();
		$individual_insurance_option_details_id               = $this->uri->segment(3);
		$individual_accident_quote_id           = getIndividualAccidentQuoteId($individual_insurance_option_details_id);
		$individual_accident_activity_id        = getIndividualAccidentPersonDetails($individual_accident_quote_id);
		$user_id            		            = getUserIdFromInsuranceDetails($individual_accident_quote_id,$this->individual_accident_quote_personal_details);
		$data['company_id']      = getCompanyIdByIndividualInsuranceOptionDetailsId($individual_insurance_option_details_id);
		$company_id              = getCompanyIdByIndividualInsuranceOptionDetailsId($individual_insurance_option_details_id);
		$data['individual_insurance_option_details_id'] = $individual_insurance_option_details_id;
		$data['company_id']      = $company_id;
		$data['branch_id']       = getIndividualAccidentBranchId();

		$post_data                              = $this->input->post();
		if(!empty($post_data)) {
			$data_type = array (
				'estimation_amount' => $this->input->post('estimation_amount'),
				'net_premium'       => $this->input->post('net_premium'  ),
				'accessories'       => $this->input->post('accessories'),
				'tax'               => $this->input->post('tax'),
				'total_premium'     => $this->input->post('total_premium')
			);
			foreach($data_type as $key => $value) {
				$record = array(
				'individual_insurance_option_details_id' => $individual_insurance_option_details_id,
				'individual_accident_activity_id' => $individual_accident_activity_id,
				'title'          => $key,
				'amount_to_pay'  => $value,
				'company_id'     => $data['company_id'],
				'company_name'   => getCompanyName($data['company_id'])
				);
			$this->front_model->setInsertData($this->individual_accident_finalize_company, $record);
			}

			$insurance_type_id  = $this->input->post('insurance_type_id');
			/*$data = array (
				'policy_number'         => getPolicyId(),
				'user_id'			=> $user_id,
				'insured_id'        => $individual_accident_quote_id,
				'insurance_type_id' => $insurance_type_id,
				'amount'            => $this->input->post('total_premium'),
				'accessories_id'    => $this->input->post('accessories_id')
			);
			
			$this->session->set_userdata('user_payment_data',$data);
			redirect('payment/proceed-to-pay/'.$individual_insurance_option_details_id,'refresh');*/
			$payment_id         = getPaymentIdByInsurerIdInsuranceType($individual_accident_quote_id,$insurance_type_id);
			$data_payment = array(
	            'amount' 	    => $this->input->post('total_premium'),
	            'modified_date' => date("Y-m-d H:i:s")
	        );

        	$updated_payment_id = $this->front_model->setUpdateData('tbl_payment', $data_payment, $payment_id);
			redirect('questionaries/'.$updated_payment_id);
			//redirect('payment/proceed-to-pay/'.$updated_payment_id);
		}



		$data['estimation_data'] = $this->front_model->getFinalIndividualAccidentInsuranceDetail($this->individual_accident_finalize_company,$individual_insurance_option_details_id);
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/individual_accident/view_finalize_detail',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');	
	}
}
