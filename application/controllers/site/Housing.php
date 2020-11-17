<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Housing extends CI_Controller {

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

	public $house_type 		= 'tbl_house_type';
	public $house_category  = 'tbl_house_category';
	public $house_detail    = 'tbl_house_detail';
	public $insurer_quality = 'tbl_insurer_quality';
	public $house_month     = 'tbl_house_month';
	public $selected_optional_warranty_house  = 'tbl_selected_optional_warranty_house';
	public $selected_optional_franchise_house  = 'tbl_selected_optional_franchise_house';
	public $finalize_housing_insurance  = 'tbl_finalize_housing_insurance';



// function added by Shiv to submit the basic info
	public function basic_info() {

		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('insurer_quality_id', 'Insurer', 'required');		
			$this->form_validation->set_rules('room', 'Room', 'required');		
			$this->form_validation->set_rules('content_value', 'Content Value', 'required|trim');		
			$this->form_validation->set_rules('building_value', 'Building Value', 'required|trim');		
			$this->form_validation->set_rules('monthly_rent', 'Monthly Rent', 'required|trim');		
			$this->form_validation->set_rules('superficy', 'Superficy', 'required|trim');		
			$this->form_validation->set_rules('house_type_id', 'House Type', 'required|trim');		
			$this->form_validation->set_rules('house_category_id', 'House Category', 'required|trim');	
			$this->form_validation->set_rules('month_id', 'House Interval', 'required|trim');		
			$this->form_validation->set_rules('from', 'From', 'required|trim');		
			$this->form_validation->set_rules('to', 'To', 'required|trim');	
			if($this->form_validation->run() == FALSE) { } else {
				$data            = array(
					// 'user_id'			 =>	$this->session->userdata('user_id'),
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
					'from'               => date('Y-m-d H:i:s' ,strtotime($this->input->post('from'))),
					'to'                 => date('Y-m-d H:i:s' ,strtotime($this->input->post('to'))),
					'risque_id'          => getHousingRisqueId(),
					'house_other_info'   => $this->input->post('house_other_info'),
					'created_date'       => date('Y-m-d H:i:s'),	
					'modified_date'      => date('Y-m-d H:i:s')	
				);
				$result              = $this->front_model->getHouseTarificationData($data,'tbl_house_tarification');
				
				if (count($result)>0) {
					$id              = $this->front_model->setInsertData($this->house_detail,$data);
					redirect('housing/housing-company-insurance/'.$id,'refresh');
					//$this->housing_company_insurance($result);
				}
				else {
					$this->session->set_flashdata('message','No records Available');
					redirect('housing', 'refresh'); 
				}
			}
		}

		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/housing/basic_info');
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

// function added by Shiv to get the housing company insurance
    public function housing_company_insurance() {
    	CheckLoginSession();
    	$house_detail_id         = $this->uri->segment(3);
		$house_detail            = $this->front_model->getDataCollectionArrayByID('tbl_house_detail',$house_detail_id);
		$result                  = $this->front_model->getHouseTarificationData($house_detail,'tbl_house_tarification');
		$data['dataCollection']  = $result;
		$data['house_detail_id'] = $house_detail_id;
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/housing/housing_company_list',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }

// function added by Shiv for ajax to set the company house detail
    public function set_company_house_detail() {
    	CheckLoginSession();
    	$data = array(
			'company_selected'      => $this->input->post('company_id'),
			'house_tarification_id' => $this->input->post('house_tarification_id')
		);
		$id         = $this->input->post('house_detail_id');
		$updated_id = $this->front_model->setUpdateData($this->house_detail,$data,$id);
		if ($updated_id) {
			echo $updated_id;
		}
		else {
			echo false;
		}
    }

//function added by Shiv to add the optional warranties for the selected company
    public function optional_warranties() {
    	CheckLoginSession();
    	$house_detail_id             = $this->uri->segment(3);
		$branch_id                   = getHousingBranchId();
		$company_id                  = getCompanyIdByHouseId($house_detail_id);
		$risque_id                   = getRisqueIdByHouseId($house_detail_id);

		$post_data = $this->input->post();
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

					$id                = $this->front_model->setInsertData($this->selected_optional_warranty_house,$data);
				}
				$this->session->set_flashdata('message','Your House Optional Warranty has been added.');
		        redirect('housing/select-optional-franchises/'.$house_detail_id,'refresh');
			}
		}
		$data['optional_warranties'] = $this->front_model->getOptionalWarranties($company_id,$branch_id,$risque_id);
		$data['house_detail_id']     = $house_detail_id;
    	$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/housing/optional_warranties',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }

//function added by Shiv to add the optional franchise for the selected company
    public function select_optional_franchises() {
    	CheckLoginSession();
    	$house_detail_id = $this->uri->segment(3);
		$branch_id       = getHousingBranchId();
		$company_id      = getCompanyIdByHouseId($house_detail_id);
		$post_data       = $this->input->post();
		if(!empty($post_data)) {
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_house_franchise', 'Optional Franchise', 'required|trim');	

			if($this->form_validation->run() == FALSE) {  } else {
				$value_selected_house_franchise = explode(',', $this->input->post('value_selected_house_franchise'));
				foreach ($value_selected_house_franchise as $value) {
					$data = array(
						'optional_franchise_id'   => $value,
						'house_detail_id'         => $house_detail_id,
						'created_date'            => date('Y-m-d H:i:s'),
						'modified_date'           => date('Y-m-d H:i:s')
					);
					$id                = $this->front_model->setInsertData($this->selected_optional_franchise_house,$data);
				}
				$this->session->set_flashdata('message','Your House Optional Franchise has been added.');
		        redirect('housing/can-save-more/'.$house_detail_id,'refresh');
			}
			
		}
		$data['optional_franchises'] = $this->front_model->getOptionalFranchicies($company_id,$branch_id);
		$data['house_detail_id']     = $house_detail_id;
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/housing/select_optional_franchises',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }

    public function can_save_more() {
    	CheckLoginSession();
    	$house_detail_id          = $this->uri->segment(3);
		$data['house_detail_id']  = $house_detail_id;
		$branch_id                = getHousingBranchId();
		$data['company_id']       = getCompanyIdByHouseId($house_detail_id);
		$data['selected_warranty_name_id'] = $this->front_model->getWarrantiesSelectedHouse($house_detail_id);
		$data['selected_franchise_name_id'] = $this->front_model->getFranchisesSelectedHouse($house_detail_id);
		$post_data       		  = $this->input->post();     

		if(empty($this->input->post('company_id'))) {
			$data['companies_id'] = explode(',', $data['company_id']);
		}
		else {
			$data['companies_id'] = $this->input->post('company_id');
		}
		
		$data['qwerty']           = getSelectedDatRecordsForSelectedCompanyForHouse($data['selected_warranty_name_id'],$data['companies_id'],$data['selected_franchise_name_id'],$house_detail_id);
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/housing/can_save_more',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }


    // function to save the final details and the company
	function finalize_company(){
		CheckLoginSession();
		$warranty           = $this->input->post('warranty');
		$franchise          = $this->input->post('franchise');
		$company_id         = $this->input->post('company_id');
		$house_detail_id    = $this->input->post('house_detail_id');

		$final_data         = getFinalForSelectedCompanyHouse( explode(',', $franchise),explode(',', $warranty) ,explode(',', $company_id),$house_detail_id);

		$user_id            = getUserIdFromInsuranceDetails($house_detail_id,$this->house_detail);
		

		foreach ($final_data as $value) {
			$data = array(
				'value'           => $value['value'],
				'type'            => $value['type'],
				'name'            => $value['name'],
				'company_id'      => $value['company_id'],
				'company_name'    => $value['company_name'],
				'house_detail_id' => $value['house_detail_id']
			);
			$this->front_model->setInsertData($this->finalize_housing_insurance,$data);
		}
		$payment_data = array(
			// 'policy_number'     => getPolicyId(),
			'policy_number'     => getAutogeneratedPolicyNumber($company_id),
			'insurance_type_id' => 7,
			'user_id'           => $user_id,
			'company_id'		=> $company_id,
			'insured_id'        => $house_detail_id,
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
		$house_detail_id               = $this->uri->segment(3);
		$user_id            	       = getUserIdFromInsuranceDetails($house_detail_id,$this->house_detail);
		$data['company_id']            = getCompanyIdByHouseId($house_detail_id);
		$data['branch_id']  		   = getHousingBranchId();

		$post_data              = $this->input->post();
		if(!empty($post_data)) {
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
					'company_id'	  => $data['company_id'],
					'company_name'    => $this->input->post('company_name'),
					'house_detail_id' => $house_detail_id
				);
				$this->front_model->setInsertData($this->finalize_housing_insurance,$record);
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
			redirect('payment/proceed-to-pay/'.$house_detail_id,'refresh');*/
			$payment_id         = getPaymentIdByInsurerIdInsuranceType($house_detail_id,$insurance_type_id);
			$data_payment = array(
	            'amount' 	    => $this->input->post('total_premium'),
	            'modified_date' => date("Y-m-d H:i:s")
	        );
        	$updated_payment_id = $this->front_model->setUpdateData('tbl_payment', $data_payment, $payment_id);
			redirect('questionaries/'.$updated_payment_id);
			//redirect('payment/proceed-to-pay/'.$updated_payment_id);
		}



		$data['final_data']            = $this->front_model->getFinalHouseInsuranceDetail($this->finalize_housing_insurance,$house_detail_id);
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/housing/view_finalize_detail',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
	}

}
