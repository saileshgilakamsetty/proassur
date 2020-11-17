<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professionalmultirisk extends CI_Controller {

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

	public $proffesional_multirisk_quote_personal_details        = 'tbl_proffesional_multirisk_quote_personal_details';
	public $selected_optional_warranty_proffesional_multirisk    = 'tbl_selected_optional_warranty_proffesional_multirisk';
	public $selected_optional_franchise_proffesional_multirisk   = 'tbl_selected_optional_franchise_proffesional_multirisk';
	public $finalize_proffesional_multirisk_insurance 			 = 'tbl_finalize_proffesional_multirisk_insurance';


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
					$image             = do_upload('professional_multirisk_quote','attach_document');
				}
				$data = array (
					// 'user_id' 		   => $this->session->userdata('user_id'),
					'user_id' 		   => $this->input->post('user_id'),
					'address' 		   => $this->input->post('address'),
					'business_address' => $this->input->post('business_address'),
					'dial_code'		   => $this->input->post('dial_code'),
					'contact_number'   => $this->input->post('mobile'),
					'document'		   => ($image)?$image:'',
					'tacit_policy'     => $this->input->post('tacit_policy'),
					'created_date'     => date('Y-m-d H:i:s')
				);
				$id = $this->front_model->setInsertData($this->proffesional_multirisk_quote_personal_details,$data);
				if($id > 0) {
					redirect('professional-multirisk/professional-multirisk-quote-activity/'.$id,'refresh');
				}	
			}
		}
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/professional_multirisk/basic_info');
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
    

    public function professional_multirisk_quote_activity() {
    	CheckLoginSession();
    	$professional_multirisk_quote_id = $this->uri->segment(3);
    	$post_data = $this->input->post();
    	if(!empty($post_data)) {
    		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('activity_id', 'Activity', 'required');
			$this->form_validation->set_rules('capital_insured', 'Capital to be insured', 'required|trim|numeric');
			if($this->form_validation->run() == FALSE) { } else {
				$data = array (
					'activity_id' => $this->input->post('activity_id'),
					'capital_insured'  					 => $this->input->post('capital_insured')
				);

				$this->front_model->setUpdateData($this->proffesional_multirisk_quote_personal_details,$data,$professional_multirisk_quote_id);
				redirect('professional-multirisk/professional-multirisk-quote-company/'.$professional_multirisk_quote_id,'refresh');
			}
    	}
    	$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/professional_multirisk/professional_multirisk_quote_activity');
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }

    public function professional_multirisk_quote_company() {
    	CheckLoginSession();
    	$data['professional_multirisk_quote_id'] = $this->uri->segment(3);
		$data['activity_id'] = getProffesionalMultiRiskPersonDetails($data['professional_multirisk_quote_id']);
		$activity_id         = $data['activity_id'];
		$data['company_id_array'] = getCompaniesIdByProffesionalMultiRiskActivityId($activity_id);
    	$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/professional_multirisk/professional_multirisk_quote_company',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }

// function for ajax to set the company proffesional multi risk detail
    public function set_company_professional_multirisk_detail() {
    	CheckLoginSession();
    	$data = array(
			'company_selected' => $this->input->post('company_id')
		);
		$id   	    = $this->input->post('professional_multirisk_quote_id');
		$updated_id = $this->front_model->setUpdateData($this->proffesional_multirisk_quote_personal_details,$data,$id);
		if ($updated_id) {
			echo $updated_id;
		}
		else {
			echo false;
		}	
    }


    public function optional_warranties() {
    	CheckLoginSession();
    	$professional_multirisk_quote_id = $this->uri->segment(3);
		$branch_id         = getProffesionalBranchId();
		$company_id        = getCompanyIdByProffesionalMultiRiskId($professional_multirisk_quote_id);
		$risque_id         = getProffesionalRisqueId();
		
		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_professional_multirisk_warranty', 'Optional warranty', 'required|trim');
			if($this->form_validation->run() == FALSE) { } else {
				$value_selected_professional_multirisk_warranty = explode(',', $this->input->post('value_selected_professional_multirisk_warranty'));
				foreach ($value_selected_professional_multirisk_warranty as $value) {
					$data = array(
					'optional_warranty_id'    		  => $value,
					'proffesional_multirisk_quote_id' => $professional_multirisk_quote_id,
					'created_date'            		  => date('Y-m-d H:i:s'),
					'modified_date'           		  => date('Y-m-d H:i:s')
					);
					$id                = $this->front_model->setInsertData($this->selected_optional_warranty_proffesional_multirisk,$data);
				}
				$this->session->set_flashdata('message','Your Proffesional Multi Risk Optional Warranty has been added.');
		        redirect('professional-multirisk/select-optional-franchises/'.$professional_multirisk_quote_id,'refresh');
			}
		}


		$data['optional_warranties'] = $this->front_model->getOptionalWarranties($company_id,$branch_id,$risque_id);
		
		$data['professional_multirisk_quote_id']   = $professional_multirisk_quote_id;

		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/professional_multirisk/optional_warranties',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }

    public function select_optional_franchises() {
    	CheckLoginSession();
    	$professional_multirisk_quote_id = $this->uri->segment(3);
		$branch_id        				 = getProffesionalBranchId();
		$company_id       				 = getCompanyIdByProffesionalMultiRiskId($professional_multirisk_quote_id);
		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_professional_multirisk_franchise', 'Optional Franchise', 'required|trim');
			if($this->form_validation->run() == FALSE) { } else {
				$value_selected_professional_multirisk_franchise = explode(',', $this->input->post('value_selected_professional_multirisk_franchise'));
				foreach ($value_selected_professional_multirisk_franchise as $value) {
					$data = array(
					'optional_franchise_id'   		  => $value,
					'proffesional_multirisk_quote_id' => $professional_multirisk_quote_id,
					'created_date'            		  => date('Y-m-d H:i:s'),
					'modified_date'         		  => date('Y-m-d H:i:s')
					);
					$id                = $this->front_model->setInsertData($this->selected_optional_franchise_proffesional_multirisk,$data);
				}
				$this->session->set_flashdata('message','Your Professional Multi Risk Optional Franchise has been added.');
		        redirect('professional-multirisk/can-save-more/'.$professional_multirisk_quote_id,'refresh');				
			}
		}


		$data['optional_franchies'] 	         = $this->front_model->getOptionalFranchicies($company_id,$branch_id);
		$data['professional_multirisk_quote_id'] = $professional_multirisk_quote_id;
    	$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/professional_multirisk/select_optional_franchises',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }

    public function can_save_more() {
    	CheckLoginSession();
    	$professional_multirisk_quote_id 		  = $this->uri->segment(3);
		$data['professional_multirisk_quote_id']  = $professional_multirisk_quote_id;
		$branch_id                				  = getProffesionalBranchId();
		$data['company_id']       			      = getCompanyIdByProffesionalMultiRiskId($professional_multirisk_quote_id);
		$data['selected_warranty_name_id']        = $this->front_model->getWarrantiesSelectedProffesionalMultiRisk($professional_multirisk_quote_id);

		$data['selected_franchise_name_id']        = $this->front_model->getFranchisesSelectedProffesionalMultiRisk($professional_multirisk_quote_id);
		
		$post_data = $this->input->post();
		if(empty($this->input->post('company_id'))) {
			$data['companies_id'] = explode(',', $data['company_id']);
		}
		else {
			$data['companies_id'] = $this->input->post('company_id');
		}

		$data['qwerty']       = getSelectedDatRecordsForSelectedCompanyForProffesionalMultiRisk($data['selected_warranty_name_id'],$data['companies_id'],$data['selected_franchise_name_id'],$professional_multirisk_quote_id);
		// print_r($data['qwerty']);
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/professional_multirisk/can_save_more',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }

// function added by Shiv to save the final details and the company
    public function finalize_company() {
    	CheckLoginSession();
    	$warranty           			 = $this->input->post('warranty');
		$franchise          			 = $this->input->post('franchise');
		$professional_multirisk_quote_id = $this->input->post('professional_multirisk_quote_id');
		$company_id         			 = getCompanyIdByProffesionalMultiRiskId($professional_multirisk_quote_id);;
		$user_id            	         = getUserIdFromInsuranceDetails($professional_multirisk_quote_id,$this->proffesional_multirisk_quote_personal_details);
		$final_data        				 = getFinalForSelectedCompanyProffesionalMultiRisk( explode(',', $franchise),explode(',', $warranty) ,explode(',', $company_id),$professional_multirisk_quote_id);
		foreach ($final_data as $value) {
			$data = array(
					'value'        => $value['value'],
					'type'         => $value['type'],
					'name'         => $value['name'],
					'company_id'   => $value['company_id'],
					'company_name' => $value['company_name'],
					'proffesional_multirisk_quote_id'   => $value['professional_multirisk_quote_id']
				);
			$this->front_model->setInsertData($this->finalize_proffesional_multirisk_insurance,$data);
		}

		$payment_data = array(
			// 'policy_number'     => getPolicyId(),
			'policy_number'     => getAutogeneratedPolicyNumber($company_id),
			'insurance_type_id' => 4,
			'user_id'           => $user_id,
			'company_id'        => $company_id,
			'insured_id'        => $professional_multirisk_quote_id,
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


    public function view_finalize_detail() {
    	CheckLoginSession();
    	$professional_multirisk_quote_id = $this->uri->segment(3);
		$user_id            	         = getUserIdFromInsuranceDetails($professional_multirisk_quote_id,$this->proffesional_multirisk_quote_personal_details);
		$data['branch_id']			 = getProffesionalBranchId();
		$data['company_id']       	 = getCompanyIdByProffesionalMultiRiskId($professional_multirisk_quote_id);

		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$data_type = array (
				'net_premium'   => $this->input->post('net_premium'  ),
				'accessories'   => $this->input->post('accessories'),
				'tax'           => $this->input->post('tax'),
				'total_premium' => $this->input->post('total_premium')
			);
			foreach ($data_type as $key => $value) {
				$record = array (
					'value'        => $value,
					'type'         => 'other_required_data',
					'name'         => $key,
					'company_id'   => $data['company_id'],
					'company_name' => getCompanyName($data['company_id']),
					'proffesional_multirisk_quote_id' => $professional_multirisk_quote_id
				);
				$this->front_model->setInsertData($this->finalize_proffesional_multirisk_insurance,$record);
			}
			$insurance_type_id = $this->input->post('insurance_type_id');
			/*$data = array (
				'policy_number'	    => getPolicyId(),
				'user_id'			=> $user_id,
				'insured_id'        => $professional_multirisk_quote_id,
				'insurance_type_id' => $this->input->post('insurance_type_id'),
				'amount'            => $this->input->post('total_premium'),
				'accessories_id'    => $this->input->post('accessories_id')
			);			
			$this->session->set_userdata('user_payment_data',$data);
			redirect('payment/proceed-to-pay/'.$professional_multirisk_quote_id,'refresh');*/
			$payment_id         = getPaymentIdByInsurerIdInsuranceType($professional_multirisk_quote_id,$insurance_type_id);
			$data_payment = array(
	            'amount' 	    => $this->input->post('total_premium'),
	            'modified_date' => date("Y-m-d H:i:s")
	        );
        	$updated_payment_id = $this->front_model->setUpdateData('tbl_payment', $data_payment, $payment_id);
			redirect('questionaries/'.$updated_payment_id);
			//redirect('payment/proceed-to-pay/'.$updated_payment_id);
		}

		$data['final_data']              = $this->front_model->getFinalProffesionalMultiRiskInsuranceDetail($this->finalize_proffesional_multirisk_insurance,$professional_multirisk_quote_id);
    	$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/professional_multirisk/view_finalize_detail',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }
}
