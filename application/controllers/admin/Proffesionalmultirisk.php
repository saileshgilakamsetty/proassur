<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proffesionalmultirisk extends CI_Controller {

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


	public $proffesional_multirisk_quote_personal_details        = 'tbl_proffesional_multirisk_quote_personal_details';
	public $selected_optional_warranty_proffesional_multirisk    = 'tbl_selected_optional_warranty_proffesional_multirisk';
	public $selected_optional_franchise_proffesional_multirisk   = 'tbl_selected_optional_franchise_proffesional_multirisk';
	public $finalize_proffesional_multirisk_insurance 			 = 'tbl_finalize_proffesional_multirisk_insurance';


// function added by Shiv to add proffesional multi risk quote
	public function proffesional_multi_risk_quote() {
		CheckAdminLoginSession();
		$proffesional_multirisk_quote_id = $this->uri->segment(3);
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('user_id', 'Name', 'required|trim');
			$this->form_validation->set_rules('address', 'Address ', 'required|trim');		
			$this->form_validation->set_rules('business_address', 'Business Address', 'required|trim');
			$this->form_validation->set_rules('dial_code', 'Dial Code', 'required|trim');		
			$this->form_validation->set_rules('mobile', 'Contact Number', 'required|trim|numeric');
			if($this->form_validation->run() == FALSE) { } else {
				if($_FILES["attach_document"]["name"] != "") {
					$image             = do_upload('proffesional_multirisk_quote','attach_document');
				}
				$data = array (
					'user_id' 		   => $this->input->post('user_id'),
					'address' 		   => $this->input->post('address'),
					'business_address' => $this->input->post('business_address'),
					'dial_code'		   => $this->input->post('dial_code'),
					'contact_number'   => $this->input->post('mobile'),
					'document'		   => ($image)?$image:'',
					'tacit_policy'     => $this->input->post('tacit_policy'),
					'created_date'     => date('Y-m-d H:i:s')
				);
				
				$id = $this->admin_model->setInsertData($this->proffesional_multirisk_quote_personal_details,$data);
				
				if($id > 0) {
					redirect('admin/proffesional-multirisk-quote-activity/'.$id,'refresh');
				}	
			}
		}
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/proffesional_multirisk/get_proffesional_multi_risk_quote');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function added by Shiv to select the activity and company
	public function proffesional_multirisk_quote_activity() {
		CheckAdminLoginSession();
		$proffesional_multirisk_quote_id = $this->uri->segment(3);
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
				$this->admin_model->setUpdateData($this->proffesional_multirisk_quote_personal_details,$data,$proffesional_multirisk_quote_id);
				redirect('admin/proffesional-multirisk-quote-company/'.$proffesional_multirisk_quote_id,'refresh');

			}
		}
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/proffesional_multirisk/proffesional_multirisk_quote_activity',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');	
	}

	public function proffesional_multirisk_quote_company() {
		CheckAdminLoginSession();	
		$data['proffesional_multirisk_quote_id'] = $this->uri->segment(3);
		$data['activity_id'] = getProffesionalMultiRiskPersonDetails($data['proffesional_multirisk_quote_id']);
		$activity_id         = $data['activity_id'];
		$data['company_id_array'] = getCompaniesIdByProffesionalMultiRiskActivityId($activity_id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/proffesional_multirisk/proffesional_multirisk_quote_company',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


	// function for ajax to set the company proffesional multi risk detail
	public function set_company_proffesional_multirisk_detail() {
		$data = array(
			'company_selected'	    => $this->input->post('company_id')
		);
		$id   	    = $this->input->post('proffesional_multirisk_quote_id');
		$updated_id = $this->admin_model->setUpdateData($this->proffesional_multirisk_quote_personal_details,$data,$id);
		if ($updated_id) {
			echo $updated_id;
		}
		else {
			echo false;
		}
	}




//function added by Shiv to add the optional warranties for the selected company
	public function optional_warranties() {
		CheckAdminLoginSession();
		$proffesional_multirisk_quote_id = $this->uri->segment(4);
		$branch_id         = getProffesionalBranchId();
		$company_id        = getCompanyIdByProffesionalMultiRiskId($proffesional_multirisk_quote_id);
		$risque_id         = getProffesionalRisqueId();
		$post_data         = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_proffesional_multirisk_warranty', 'Optional warranty', 'required|trim');	
			if($this->form_validation->run() == FALSE) {  } else {
				$value_selected_proffesional_multirisk_warranty = explode(',', $this->input->post('value_selected_proffesional_multirisk_warranty'));
				foreach ($value_selected_proffesional_multirisk_warranty as $value) {
					$data = array(
					'optional_warranty_id'    		  => $value,
					'proffesional_multirisk_quote_id' => $proffesional_multirisk_quote_id,
					'created_date'            		  => date('Y-m-d H:i:s'),
					'modified_date'           		  => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_warranty_proffesional_multirisk,$data);
				}
				$this->session->set_flashdata('message','Your Proffesional Multi Risk Optional Warranty has been added.');
		        redirect('admin/proffesionalmultirisk/select_optional_franchises/'.$proffesional_multirisk_quote_id,'refresh');
			}
		}
		$data['optional_warranties'] = $this->admin_model->getOptionalWarranties($company_id,$branch_id,$risque_id);
		
		$data['proffesional_multirisk_quote_id']   = $proffesional_multirisk_quote_id;
		
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/proffesional_multirisk/optional_warranties',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



	//function to add the optional franchise for the selected company
	public function select_optional_franchises() {
		CheckAdminLoginSession();
		$proffesional_multirisk_quote_id = $this->uri->segment(4);
		$branch_id        				 = getProffesionalBranchId();
		$company_id       				 = getCompanyIdByProffesionalMultiRiskId($proffesional_multirisk_quote_id);
		//$data              = '';
		$post_data         = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_franchise_proffesional_multirisk', 'Optional Franchise', 'required|trim');	
			if($this->form_validation->run() == FALSE) {  } else {
				$value_selected_franchise_proffesional_multirisk = explode(',', $this->input->post('value_selected_franchise_proffesional_multirisk'));
				foreach ($value_selected_franchise_proffesional_multirisk as $value) {
					$data = array(
					'optional_franchise_id'   		  => $value,
					'proffesional_multirisk_quote_id' => $proffesional_multirisk_quote_id,
					'created_date'            		  => date('Y-m-d H:i:s'),
					'modified_date'         		  => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_franchise_proffesional_multirisk,$data);
				}
				$this->session->set_flashdata('message','Your Proffesional Multi Risk Optional Franchise has been added.');
		        redirect('admin/proffesionalmultirisk/can_save_more/'.$proffesional_multirisk_quote_id,'refresh');
			}
		}
		$data['optional_franchies'] 			 = $this->admin_model->getOptionalFranchices($company_id,$branch_id);
		$data['proffesional_multirisk_quote_id'] = $proffesional_multirisk_quote_id;
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/proffesional_multirisk/select_optional_franchises',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function added by Shiv to show the different price range for each company
	function can_save_more() {
		CheckAdminLoginSession();
		$proffesional_multirisk_quote_id 		  = $this->uri->segment(4);
		$data['proffesional_multirisk_quote_id']  = $this->uri->segment(4);
		$branch_id                				  = getProffesionalBranchId();
		$data['company_id']       			      = getCompanyIdByProffesionalMultiRiskId($proffesional_multirisk_quote_id);
		$data['selected_warranty_name_id']        = $this->admin_model->getWarrantiesSelectedProffesionalMultiRisk($proffesional_multirisk_quote_id);
		$data['selected_franchise_name_id']        = $this->admin_model->getFranchisesSelectedProffesionalMultiRisk($proffesional_multirisk_quote_id);
		$post_data       						  = $this->input->post();     
		$post_data = $this->input->post();
		if(empty($this->input->post('company_id'))) {
			$data['companies_id'] = explode(',', $data['company_id']);
		}
		else {
			$data['companies_id'] = $this->input->post('company_id');
		}
		$data['qwerty']       = getSelectedDatRecordsForSelectedCompanyForProffesionalMultiRisk($data['selected_warranty_name_id'],$data['companies_id'],$data['selected_franchise_name_id'],$proffesional_multirisk_quote_id);

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/proffesional_multirisk/can_save_more',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function added by Shiv to save the final details and the company
	function finalize_company(){
		CheckAdminLoginSession();
		$warranty           			 = $this->input->post('warranty');
		$franchise          			 = $this->input->post('franchise');
		$company_id         			 = $this->input->post('company_id');
		$proffesional_multirisk_quote_id = $this->input->post('proffesional_multirisk_quote_id');
		$user_id            	     = getUserIdFromInsuranceDetails($proffesional_multirisk_quote_id,$this->proffesional_multirisk_quote_personal_details);
		$final_data        				 = getFinalForSelectedCompanyProffesionalMultiRisk( explode(',', $franchise),explode(',', $warranty) ,explode(',', $company_id),$proffesional_multirisk_quote_id);
		foreach ($final_data as $value) {
			$data = array(
					'value'        => $value['value'],
					'type'         => $value['type'],
					'name'         => $value['name'],
					'company_id'   => $value['company_id'],
					'company_name' => $value['company_name'],
					'proffesional_multirisk_quote_id'   => $value['proffesional_multirisk_quote_id']
				);
			$this->admin_model->setInsertData($this->finalize_proffesional_multirisk_insurance,$data);
		}

		$payment_data = array(
			'policy_number'     => getPolicyId(),
			'insurance_type_id' => 4,
			'user_id'           => $user_id,
			'company_id'        => $company_id,
			'insured_id'        => $proffesional_multirisk_quote_id,
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


	// function to get the finalize vehicle details
	function view_finalize_detail() {
		//$data = "";
		$proffesional_multirisk_quote_id = $this->uri->segment(4);
		$user_id            	     = getUserIdFromInsuranceDetails($proffesional_multirisk_quote_id,$this->proffesional_multirisk_quote_personal_details);
		$data['branch_id']			 = getProffesionalBranchId();
		$post_data              	 = $this->input->post();
		$company_id 				 = $this->input->post('company_id');
		$policy_code 				 = getPolicyCodeForCompany($company_id);

		if(!empty($post_data)) {
			$policy_code   = $this->input->post('policy_code');
			$policy_prefix = $this->input->post('policy_prefix');
			if(empty($this->input->post('policy_prefix'))) {
				$policy_number = getAutogeneratedPolicyNumber($company_id);
			} else {
				if(checkPolicyNumberExists($policy_code."/".$policy_prefix) > 0) {
					$this->session->set_flashdata('message','Policy Number Already Exists. Please Enter another Policy Number');
					redirect('admin/proffesional-multirisk/view-finalize-detail/'.$proffesional_multirisk_quote_id);
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
					'value'        => $value,
					'type'         => 'other_required_data',
					'name'         => $key,
					'company_id'   => $this->input->post('company_id'),
					'company_name' => getCompanyName($this->input->post('company_id')),
					'proffesional_multirisk_quote_id' => $proffesional_multirisk_quote_id
				);
				$this->admin_model->setInsertData($this->finalize_proffesional_multirisk_insurance,$record);
			}

			$insurance_type_id  = $this->input->post('insurance_type_id');
			/*$data = array (
				'user_id'			=> $user_id,
				'insured_id'        => $proffesional_multirisk_quote_id,
				'insurance_type_id' => $insurance_type_id,
				'amount'            => $this->input->post('total_premium'),
				'accessories_id'    => $this->input->post('accessories_id')
			);
			
			$this->session->set_userdata('user_payment_data',$data);
			redirect('admin/payment/proceed-to-pay/'.$proffesional_multirisk_quote_id,'refresh');*/
			$payment_id         = getPaymentIdByInsurerIdInsuranceType($proffesional_multirisk_quote_id,$insurance_type_id);
			$data_payment = array(
				'policy_number' => $policy_number,
	            'amount' 	    => $this->input->post('total_premium'),
	            'modified_date' => date("Y-m-d H:i:s")
	        );

        	$updated_payment_id = $this->admin_model->setUpdateData('tbl_payment', $data_payment, $payment_id);
			redirect('admin/questionaries/'.$updated_payment_id);
			// redirect('admin/payment/proceed-to-pay/'.$updated_payment_id);
		}

		$data['final_data']              = $this->admin_model->getFinalProffesionalMultiRiskInsuranceDetail($this->finalize_proffesional_multirisk_insurance,$proffesional_multirisk_quote_id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/proffesional_multirisk/view_finalize_detail',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function added by Shiv to view the list of insurance pollicies
	public function proffesional_multi_risk_policies() {
		CheckAdminLoginSession();
		$data['dataCollection'] = $this->admin_model->getPoliciesByInsuranceTypeId(4);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/proffesional_multirisk/proffesional_multirisk_policies',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function added by Shiv to update the insurance policy
	public function proffesional_multi_risk_policies_edit() {
		CheckAdminLoginSession();
		$data['policy_number'] 	   = decrypt($this->uri->segment(3));
		$data['proffesional_multirisk_quote_id'] = $this->uri->segment(4);
		$data['branch_id']         = getProffesionalBranchId();
		$data['company_id']        = getCompanyIdByProffesionalMultiRiskId($data['proffesional_multirisk_quote_id']);
		$data['risque_id']         = getProffesionalRisqueId();

		$array_id = array ('proffesional_multirisk_quote_id' => $data['proffesional_multirisk_quote_id']);

		$data['proffesional_multirisk_detail'] = $this->admin_model->getDataCollectionByID($this->proffesional_multirisk_quote_personal_details,$data['proffesional_multirisk_quote_id']);

		$data['optional_warranties'] = $this->admin_model->getOptionalWarranties($data['company_id'],$data['branch_id'],$data['risque_id']);
		$data['selected_warranties'] = getSelectedOptionalWarranties($this->selected_optional_warranty_proffesional_multirisk,$array_id);
		$data['selected_franchises'] = getSelectedOptionalFranchises($this->selected_optional_franchise_proffesional_multirisk,$array_id);
		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$policy_number       = $this->input->post('policy_number');
			$capital_insured     = $this->input->post('capital_insured');
			$optional_warranties = $this->input->post('optional_warranties_proffesional_multirisk');
			$optional_franchises = $this->input->post('optional_franchises_proffesional_multirisk');
			$company_array[0]    = $data['company_id'];

			$update_capital_insured = array (
				'capital_insured' => $capital_insured
			);
				
			$updated_id = $this->admin_model->setUpdateData($this->proffesional_multirisk_quote_personal_details,$update_capital_insured,$data['proffesional_multirisk_quote_id']);
			
			if($policy_number == $data['policy_number']) {

				// Delete Optional Warranties
				$this->admin_model->deleteOptionalWarranties($this->selected_optional_warranty_proffesional_multirisk,$array_id);

				// Insert Optional Warranties
				foreach ($optional_warranties as $value) {
					$inserted_warranties = array(
						'optional_warranty_id'    		  => $value,
						'proffesional_multirisk_quote_id' => $data['proffesional_multirisk_quote_id'],
						'created_date'            		  => date('Y-m-d H:i:s'),
						'modified_date'           		  => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_warranty_proffesional_multirisk,$inserted_warranties);
				}


				// Delete Optional Franchises
				$this->admin_model->deleteOptionalFranchises($this->selected_optional_franchise_proffesional_multirisk,$array_id);


				// Insert Optional Franchises
				foreach ($optional_franchises as $value) {
					$inserted_franchises = array(
						'optional_franchise_id'   		  => $value,
						'proffesional_multirisk_quote_id' => $data['proffesional_multirisk_quote_id'],
						'created_date'            		  => date('Y-m-d H:i:s'),
						'modified_date'         		  => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_franchise_proffesional_multirisk,$inserted_franchises);
				}

				$data['selected_warranty_name_id']        = $this->admin_model->getWarrantiesSelectedProffesionalMultiRisk($data['proffesional_multirisk_quote_id']);
				$data['selected_franchise_name_id']        = $this->admin_model->getFranchisesSelectedProffesionalMultiRisk($data['proffesional_multirisk_quote_id']);


				// Delete finalized data
				$proff_multirisk_id = array (
					'proffesional_multirisk_quote_id' => $data['proffesional_multirisk_quote_id']
				);
				$this->admin_model->deleteFinalizedData($this->finalize_proffesional_multirisk_insurance,$proff_multirisk_id);

				// Insert Finalized Data
				$final_data = getFinalForSelectedCompanyProffesionalMultiRisk($data['selected_franchise_name_id'],$data['selected_warranty_name_id'],$company_array,$data['proffesional_multirisk_quote_id']);


				foreach ($final_data as $value) {
					$data_final = array(
						'value'        => $value['value'],
						'type'         => $value['type'],
						'name'         => $value['name'],
						'company_id'   => $value['company_id'],
						'company_name' => $value['company_name'],
						'proffesional_multirisk_quote_id'   => $value['proffesional_multirisk_quote_id']
					);
					$this->admin_model->setInsertData($this->finalize_proffesional_multirisk_insurance,$data_final);
				}

				// Get the inserted finalized data
				$data['finalized_details']              = $this->admin_model->getFinalProffesionalMultiRiskInsuranceDetail($this->finalize_proffesional_multirisk_insurance,$data['proffesional_multirisk_quote_id']);

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
						'value'        => $value,
						'type'         => 'other_required_data',
						'name'         => $key,
						'company_id'   => $data['company_id'],
						'company_name' => getCompanyName($data['company_id']),
						'proffesional_multirisk_quote_id' => $data['proffesional_multirisk_quote_id']
					);
					$this->admin_model->setInsertData($this->finalize_proffesional_multirisk_insurance,$record);
				}

				// Update Data into Payment Table
				$payment_id = getPaymentIdByInsurerIdInsuranceType($data['proffesional_multirisk_quote_id'],4);
				$payment_details = $this->admin_model->getDataCollectionByID('tbl_payment',$payment_id);
				$old_payment_amount = $payment_details->amount;

				$payment_data = array (
					'amount'		=> $total_premium,
					'modified_date' => date("Y-m-d H:i:s")
				);
				$update_payment_id = $this->admin_model->setUpdateData('tbl_payment',$payment_data,$payment_id);


				// Update Data into Quittance Table
				$insurance_details = getFinalizedInsuranceDetails($data['proffesional_multirisk_quote_id'],4);
				$accessories_data  = getAccessoriesAmountShare($accessories_id);
				$quittance_id = getQuittanceId($policy_number);
				$quittance_data    = array (		
					'policy_number'             => $data['policy_number'],
					'company_id'                => $data['company_id'],
					'branch_id'                => $data['branch_id'],
					'risque_id'                => $data['risque_id'],
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
		
				$updated_quittance_id = $this->admin_model->setUpdateData('tbl_quittance',$quittance_data,$quittance_id);
				$updated_insurance_details = $this->admin_model->getDataCollectionByID('tbl_quittance',$updated_quittance_id);
				

				// Calculating Difference of Old and New Amount
				$amount_difference = ($updated_insurance_details->total_amount - $old_payment_amount);
			} else {

				// Insert Optional Warranties
				foreach ($optional_warranties as $value) {
					$inserted_warranties = array(
						'optional_warranty_id'    		  => $value,
						'proffesional_multirisk_quote_id' => $data['proffesional_multirisk_quote_id'],
						'created_date'            		  => date('Y-m-d H:i:s'),
						'modified_date'           		  => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_warranty_proffesional_multirisk,$inserted_warranties);
				}

				// Insert Optional Franchises
				foreach ($optional_franchises as $value) {
					$inserted_franchises = array(
						'optional_franchise_id'   		  => $value,
						'proffesional_multirisk_quote_id' => $data['proffesional_multirisk_quote_id'],
						'created_date'            		  => date('Y-m-d H:i:s'),
						'modified_date'         		  => date('Y-m-d H:i:s')
					);
					$id                = $this->admin_model->setInsertData($this->selected_optional_franchise_proffesional_multirisk,$inserted_franchises);
				}


				$data['selected_warranty_name_id']        = $this->admin_model->getLatestWarrantiesSelectedForInsurance($this->selected_optional_warranty_proffesional_multirisk,$data['proffesional_multirisk_quote_id'],4);


				$data['selected_franchise_name_id']        = $this->admin_model->getLatestFranchisesSelectedForInsurance($this->selected_optional_franchise_proffesional_multirisk,$data['proffesional_multirisk_quote_id'],4);


				// Insert Finalized Data
				$final_data = getFinalForSelectedCompanyProffesionalMultiRisk($data['selected_franchise_name_id'],$data['selected_warranty_name_id'],$company_array,$data['proffesional_multirisk_quote_id']);

				foreach ($final_data as $value) {
					$data_final = array(
						'value'        => $value['value'],
						'type'         => $value['type'],
						'name'         => $value['name'],
						'company_id'   => $value['company_id'],
						'company_name' => $value['company_name'],
						'proffesional_multirisk_quote_id'   => $value['proffesional_multirisk_quote_id']
					);

					$this->admin_model->setInsertData($this->finalize_proffesional_multirisk_insurance,$data_final);
				}


				// Get the inserted finalized data
				$data['finalized_details']              = $this->admin_model->getLatestFinalInsuranceDetail($this->finalize_proffesional_multirisk_insurance,$data['proffesional_multirisk_quote_id'],4);

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
						'value'        => $value,
						'type'         => 'other_required_data',
						'name'         => $key,
						'company_id'   => $data['company_id'],
						'company_name' => getCompanyName($data['company_id']),
						'proffesional_multirisk_quote_id' => $data['proffesional_multirisk_quote_id']
					);
					$this->admin_model->setInsertData($this->finalize_proffesional_multirisk_insurance,$record);
				}

				// Insert Data into Payment Table
				$payment_id = getPaymentIdByInsurerIdInsuranceType($data['proffesional_multirisk_quote_id'],4);
				$payment_details = $this->admin_model->getDataCollectionByID('tbl_payment',$payment_id);
				$old_payment_amount = $payment_details->amount;
				
				$payment_data = array (
					'policy_number'     => checkUniquePolicyId($policy_number),
					'insurance_type_id' => 4,
					'user_id'           => $payment_details->user_id,
					'company_id'        => $payment_details->company_id,
					'insured_id'        => $data['proffesional_multirisk_quote_id'],
					'payment_status'    => $payment_details->payment_status,
					'payment_method'    => $payment_details->payment_method, // no payment
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
				);
				$updated_payment_id = $this->admin_model->setInsertData('tbl_payment',$payment_data);


				$payment_amount_data = array (
					'amount'		=> $total_premium,
					'modified_date' => date("Y-m-d H:i:s")
				);
				$update_payment_id = $this->admin_model->setUpdateData('tbl_payment',$payment_amount_data,$updated_payment_id);


				// Update Data into Quittance Table
				$data['finalized_details']              = $this->admin_model->getLatestFinalInsuranceDetail($this->finalize_proffesional_multirisk_insurance,$data['proffesional_multirisk_quote_id'],4);



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
				$tax_amount        = getTaxAmount(($accessories_value + $estimation_amount + $person_amount),$data['company_id'],$data['branch_id']);
				$total_premium     = $total_amount + $accessories_value + $tax_amount;


				// $old_insurance_details = getFinalizedInsuranceDetails($data['proffesional_multirisk_quote_id'],4);
				$old_quittance_id = getQuittanceId($data['policy_number']);
				$old_quittance_details = $this->admin_model->getDataCollectionByID('tbl_quittance',$old_quittance_id);
				$accessories_data  = getAccessoriesAmountShare($accessories_id);

				$new_payment_details = $this->admin_model->getDataCollectionByID('tbl_payment',$update_payment_id);

				$new_quittance_data    = array (		
					'policy_number'             => $new_payment_details->policy_number,
					'company_id'                => $data['company_id'],
					'branch_id'                 => $data['branch_id'],
					'risque_id'                 => $data['risque_id'],
					'user_id'                   => $old_quittance_details->user_id,
					'amount'                    => $total_amount,
					'tax'                       => $tax_amount,	
					'accessories'               => $accessories_value,
					'accessories_id'            => $accessories_id,
					'accessories_admin_share'   => $accessories_data['accessories_admin_share'],
					'accessories_company_share' => $accessories_data['accessories_company_share'],
					'policy_start_date'         => $old_quittance_details->policy_start_date,
            		'policy_end_date'           => $old_quittance_details->policy_end_date,
					'total_amount'              => $total_premium,
					'created_date'              => date('Y-m-d H:i:s'),
					'modified_date'             => date('Y-m-d H:i:s'),
					'status'                    => 0
				); 
				$updated_quittance_id = $this->admin_model->setInsertData('tbl_quittance',$new_quittance_data);
				$updated_insurance_details = $this->admin_model->getDataCollectionByID('tbl_quittance',$updated_quittance_id);


				// Calculating Difference of Old and New Amount
				$amount_difference = ($updated_insurance_details->total_amount - $old_payment_amount);
			}


			if($amount_difference > 0) {
				$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You have to pay the amount of ".abs($amount_difference)." to the Admin";
			} else if($amount_difference < 0){
				$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You have to recieve the amount of <b>".abs($amount_difference)."</b> from the Admin";
			} else {
				$amount_message = "Your Reflected Amount is <b>" .abs($amount_difference)."</b> i.e, You don't have to pay/recieve any amount from the Admin";
			}
			// $amount_difference = diffPolicyTotalAmount($old_payment_amount,$insurance_details['total_premium']);
			$user_id            	     = getUserIdFromInsuranceDetails($data['proffesional_multirisk_quote_id'],$this->proffesional_multirisk_quote_personal_details);
			
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
				'{{insurance_type}}'          =>  getInsuranceType(4).' INSURANCE',
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
				'{{insurance_type}}'          =>  getInsuranceType(4).' INSURANCE',
				'{{policy_number}}'           =>  $data['policy_number'],
				'{{amount_difference}}'       =>  $admin_amount_message,
				'{{email}}'                   => getAdminEmail()
			);
			$admin_message     = email_compose($admin_email_template,$admin_templateTags);

			$admin_email       = getAdminEmail();

			$admin_subject     = SEND_POLICY_UPDATION_MAIL;
			if (send_smtp_mail($admin_email,$admin_subject,$admin_message)) {
				$this->session->set_flashdata('message',POLICY_UPDATE_SUCCESS_MESSAGE);
	        	redirect('admin/proffesional-multi-risk-policies','refresh');
			}
		}

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/proffesional_multirisk/proffesional_multirisk_policies_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');

	}
 
}
