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
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
		
	}

	public $individual_accident_insurance_options      = 'tbl_individual_accident_insurance_options';
	public $individual_accident_activity               = 'tbl_activity';
	public $company_individual_accident_activity       = 'tbl_company_individual_accident_activity';
	public $individual_accident_quote_personal_details = 'tbl_individual_accident_quote_personal_details';
	public $individual_insurance_option_details        = 'tbl_individual_insurance_option_details';
	public $individual_accident_finalize_company 	   = 'tbl_individual_accident_finalize_company';
	public $multiple_companies_activity 			   = 'tbl_multiple_companies_activity';


// function to get the transported Person Option 
	public function accident_insurance_options() {
		CheckAdminLoginSession();
		$per_page               = 20;
        if($this->uri->segment(4)) {
        	$page               = ($this->uri->segment(4)) ;
        }
        else {
        	$page               = 1;
        }
      
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->individual_accident_insurance_options);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->individual_accident_insurance_options,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/individual_accident/transported_person',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}





// function to add the transported  Person Option 
	public function accident_insurance_options_add() {
        CheckAdminLoginSession();		
		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('title', 'Name', 'required|trim');		
			$this->form_validation->set_rules('amount_to_pay', 'Amount', 'required|trim');				
			$this->form_validation->set_rules('company_id', 'Company ', 'required|trim');				
			$this->form_validation->set_rules('death', 'Death', 'required|trim');				
			$this->form_validation->set_rules('disability', 'Disability', 'required|trim');				
			$this->form_validation->set_rules('medical_fees', 'Medical Fees', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'individual_accident_activity_id' => $this->input->post('individual_accident_activity_id'),
					'company_id'         			  => $this->input->post('company_id'),
					'title'              			  => $this->input->post('title'),
					'amount_to_pay'      			  => $this->input->post('amount_to_pay'),
					'death'              			  => $this->input->post('death'),
					'disability'         			  => $this->input->post('disability'),
					'medical_fees'       			  => $this->input->post('medical_fees'),
					'status'             			  => $this->input->post('status'),
					'created_date'       			  => date('Y-m-d H:i:s'),
					'modified_date'      			  => date('Y-m-d H:i:s')
				); 
				$id                = $this->admin_model->setInsertData($this->individual_accident_insurance_options,$data);
				$this->session->set_flashdata('message','Your Accident Insurance Option has been added successfully');
		        redirect('admin/individual-accident/accident-insurance-options','refresh');
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/individual_accident/accident_insurance_options_add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}	


// function to edit the transported Person Option 
	public function accident_insurance_options_edit() {
    	CheckAdminLoginSession();		
        $id             = $this->uri->segment(4);

		$post_data=$this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('individual_accident_activity_id', 'Activity ', 'required|trim');
			$this->form_validation->set_rules('company_id', 'Company ', 'required|trim');		
			$this->form_validation->set_rules('title', 'Name', 'required|trim');		
			$this->form_validation->set_rules('amount_to_pay', 'Amount', 'required|trim');	
			$this->form_validation->set_rules('death', 'Death', 'required|trim');				
			$this->form_validation->set_rules('disability', 'Disability', 'required|trim');
			$this->form_validation->set_rules('medical_fees', 'Medical Fees', 'required|trim');				
			if($this->form_validation->run() == FALSE) {   } else {
                $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
				$data        = array(									
					'company_id'         			  => $this->input->post('company_id'),
					'individual_accident_activity_id' => $this->input->post('individual_accident_activity_id'),
					'title'              			  => $this->input->post('title'),
					'amount_to_pay'      			  => $this->input->post('amount_to_pay'),
					'death'              			  => $this->input->post('death'),
					'disability'         			  => $this->input->post('disability'),
					'medical_fees'       			  => $this->input->post('medical_fees'),
					'status'             			  => $this->input->post('status'),
					'created_date'       			  => date('Y-m-d H:i:s'),
					'modified_date'      			  => date('Y-m-d H:i:s')
				); 
				$id                = $this->admin_model->setUpdateData($this->individual_accident_insurance_options,$data,$id);
				$this->session->set_flashdata('message','Your Accident Insurance Option has been updated successfully');
		        redirect('admin/individual-accident/accident-insurance-options','refresh');
		    }
        }
        $data['dataCollection']      = $this->admin_model->getDataCollectionByID($this->individual_accident_insurance_options,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/individual_accident/accident_insurance_options_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function to change the status of individual accident transported person insurance
	public function accident_insurance_options_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status']           = $status;
		$data['modified_date']    = date('Y-m-d H:i:s');				        	             		 
		$this->admin_model->setUpdateData($this->individual_accident_insurance_options,$data,$id);
		$this->session->set_flashdata('message','Your status has been updated successfully');
		redirect('admin/individual-accident/accident-insurance-options','refresh');			
	}


// function to delete individual accident transported person insurance
	public function accident_insurance_options_delete() {
		CheckAdminLoginSession();
		$id          = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->individual_accident_insurance_options,$id);
		$this->session->set_flashdata('message','Your Accident Insurance Option Insurance has been deleted successfully');
        redirect('admin/individual-accident/accident-insurance-options','refresh');
	}




// function added by Shiv to add the activity for Individual Accident Management
	public function individual_accident_activity_add() {
        CheckAdminLoginSession();		
		$post_data       = $this->input->post();
		if(!empty($post_data)) {
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('activity_id', 'Activity', 'required|trim');
			
			$this->form_validation->set_rules('company_id[0]', 'Company', 'required');

			if($this->form_validation->run() == FALSE) {   } else {
				$data = array (
					'activity_id' => $this->input->post('activity_id'),
					'status'	  => $this->input->post('status')
				);
				$id = $this->admin_model->setInsertData($this->multiple_companies_activity,$data);
				if($id > 0) {
					foreach ($this->input->post('company_id') as $value) {
						$data_companies = array(
							'multiple_companies_activity_id'  => $id,
							'individual_accident_activity_id' => $this->input->post('activity_id'),
							'company_id'                      => $value,
							'created_date' 					  => date('Y-m-d H:i:s')
						);
						$this->admin_model->setInsertData($this->company_individual_accident_activity,$data_companies);
					}

					$this->session->set_flashdata('message','Your Activity has been added successfully');
			        redirect('admin/individual-accident/individual-accident-activity-list','refresh');
		    	}
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/individual_accident/add_activity');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}




// function added by Shiv to show the list of activities for individual accident management
	public function individual_accident_activity_list() {
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
        $totalCount             = $this->admin_model->totalRecord($this->multiple_companies_activity);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->multiple_companies_activity,$limit,$start);
		// $data["dataCollection"] = $this->admin_model->getDataCollection($this->individual_accident_activity,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/individual_accident/activity_list',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


	
// function added by Shiv to change the status of the activity for Individual Accident Management
	public function individual_accident_activity_status() {
		$id      = $this->uri->segment(4);
		$status  = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		// $this->admin_model->setUpdateData($this->individual_accident_activity,$data,$id);
		$this->admin_model->setUpdateData($this->multiple_companies_activity,$data,$id);
		$this->session->set_flashdata('message','Your status has been updated successfully');
		redirect('admin/individual-accident/individual-accident-activity-list','refresh');		
	}



// function added by Shiv to update the activity for Individual Accident Management
	public function individual_accident_activity_edit() {
		$id                = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data         = $this->input->post();
		$checked_password  = $this->input->post('checked_password');
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('activity_id', 'Activity', 'required');
			$this->form_validation->set_rules('company_id[0]', 'Company', 'required');
								
			if($this->form_validation->run() == FALSE) {   } else {
				$data = array (
					'activity_id'   => $this->input->post('activity_id'),
					'status'     	=> $this->input->post('status'),
					'modified_date' => date('Y-m-d H:i:s')
				);
				$this->admin_model->setUpdateData($this->multiple_companies_activity,$data,$id);

				$this->admin_model->dataDeleteByActivityId($this->company_individual_accident_activity,$this->input->post('activity_id'));
				foreach ($this->input->post('company_id') as $value) {
					$data_company = array(
						'multiple_companies_activity_id'  => $id,
						'individual_accident_activity_id' => $this->input->post('activity_id'),
						'company_id'             => $value,
						'created_date'           => date('Y-m-d H:i:s')
					);
					$this->admin_model->setInsertData($this->company_individual_accident_activity,$data_company);
				}	
				

				$this->session->set_flashdata('message','Your Activity has been updated successfully');
				redirect('admin/individual-accident/individual-accident-activity-list','refresh');
		    }
        }
		$data['dataCollection']               = $this->admin_model->getDataCollectionByID($this->multiple_companies_activity,$id);
		$dataCollection 					  = $data['dataCollection'];
		$data['dataCollectionForCompany']     = $this->admin_model->getDataCollectionOfIndividualAccidentActivityCompany($this->company_individual_accident_activity,$dataCollection);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/individual_accident/edit_activity',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


	
// function added by Shiv to delete the activity for Individual Accident Management
	public function individual_accident_activity_delete() {
		CheckAdminLoginSession();
		$id = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->multiple_companies_activity,$id);
		$this->session->set_flashdata('message','Your Activity has been deleted successfully');
		redirect('admin/individual-accident/individual-accident-activity-list','refresh');
	}



// function added by Shiv to get Company By Individual Activity Id 
	public function getCompanyByIndividualAccidentActivityId() {
	    //$data    = '';
	    $data    = 'class="control-group  " id="company_by_individual_activity" ';
	    $result  =  form_dropdown('company_id', getCompanyByIndividualAccidentActivityId($this->input->post('individual_accident_activity_id')),set_value('company_id'),$data);
	    print_r($result);
	    //return $result;
	}





// function added by Shiv to get individual accident quote
	public function individual_accident_getquote() {
		CheckAdminLoginSession();

		$post_data=$this->input->post();
		if(!empty($post_data)) {    
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('user_id', 'User Name', 'required|trim');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');
			$this->form_validation->set_rules('address', 'Address ', 'required|trim');		
			$this->form_validation->set_rules('business_address', 'Business Address', 'required|trim');
			$this->form_validation->set_rules('dial_code', 'Dial Code', 'required|trim');		
			$this->form_validation->set_rules('mobile', 'Contact Number', 'required|trim|numeric');
			if($this->form_validation->run() == FALSE) { } else {
				if($_FILES["attach_document"]["name"] != "") {
					$image             = do_upload('individual_accident_quote','attach_document');
				}
				$data = array (
					'user_id'          => $this->input->post('user_id'),
					'name' 			   => $this->input->post('name'),
					'address' 		   => $this->input->post('address'),
					'business_address' => $this->input->post('business_address'),
					'dial_code'		   => $this->input->post('dial_code'),
					'contact_number'   => $this->input->post('mobile'),
					'document'		   => ($image)?$image:'',
					'tacit_policy'     => $this->input->post('tacit_policy'),
					'created_date'     => date('Y-m-d H:i:s')
				);
				$id = $this->admin_model->setInsertData($this->individual_accident_quote_personal_details,$data);
				if($id > 0) {
					redirect('admin/individual-accident/individual-accident-quote-activity/'.$id,'refresh');
				}	
			}
		}
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/individual_accident/get_individual_accident_quote');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}





// function added by Shiv to select the activity 
	public function individual_accident_quote_activity() {
		CheckAdminLoginSession();
		$individual_accident_quote_id = $this->uri->segment(4);
		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('individual_accident_activity_id', 'Activity', 'required');
			if($this->form_validation->run() == FALSE) { } else {
				$data = array (
					'individual_accident_activity_id' => $post_data['individual_accident_activity_id']
				);
				$this->admin_model->setUpdateData($this->individual_accident_quote_personal_details,$data,$individual_accident_quote_id);
				redirect('admin/individual-accident/individual-accident-quote-company/'.$individual_accident_quote_id,'refresh');
			}
		}
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/individual_accident/individual_accident_quote_activity',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');	
	}

// function added by Shiv to get the list of companies for the selected companies
	public function individual_accident_quote_company() {
		CheckAdminLoginSession();
		$data['individual_accident_quote_id'] = $this->uri->segment(4);
		$data['individual_accident_activity_id'] = getIndividualAccidentPersonDetails($data['individual_accident_quote_id']);
		$individual_accident_activity_id = $data['individual_accident_activity_id'];
		$data['company_id_array'] = getCompaniesIdByIndividualAccidentActivityId($individual_accident_activity_id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/individual_accident/individual_accident_quote_company',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function added by Shiv to get the insurance option details for the selected activity and company
	public function insurance_options_details() {
		CheckAdminLoginSession();
		$data['individual_accident_quote_id'] = $this->uri->segment(4);
		$quote_id 							  = $data['individual_accident_quote_id'];
		$data['selected_company_id']          = $this->uri->segment(5);
		$company_id 						  = $data['selected_company_id'];
		$post_data = $this->input->post();
		if(!empty($post_data)) {
			$options_data = array (
				'individual_accident_quote_id' => $quote_id,
				'selected_company_id'          => $company_id,
				'individual_accident_insurance_requirement' => $this->input->post('individual_accident_insurance_requirement'),
				'accident_insurance_optionid'  => $this->input->post('accident_insurance_optionid'),
				'amount_to_pay'				   => $this->input->post('amount_to_pay') 
			);
			$id = $this->admin_model->setInsertData($this->individual_insurance_option_details,$options_data);
			if($id > 0) {
				redirect('admin/individual-accident/get-estimation/'.$id,'refresh');
			}
		}
		$activity_id 						  = getActivtiyIdByAccidentQuoteId($quote_id);
        $data['insurance_options']            = getAccidentInsuranceOptions($activity_id,$company_id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/individual_accident/insurance_options_details',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


	public function get_estimation() {
		$data['individual_insurance_option_details_id'] = $this->uri->segment(4);
		$individual_accident_examination_list_array = getIndividualAccidentExaminationList();
		$company_array                 = getCompanyIds();
		$data['qwerty']                = getIndividualAccidentCompanyComparision($individual_accident_examination_list_array,$company_array);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/individual_accident/get_individual_accident_estimation',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}




// function added by Shiv to get finalize company for individual accident insurance
	public function finalize_company() {
		$company_id 							 = $this->input->post('company_id');
		$individual_insurance_option_details_id  = $this->input->post('individual_insurance_option_details_id');
		$individual_accident_quote_id           = getIndividualAccidentQuoteId($individual_insurance_option_details_id);
		$user_id            		            = getUserIdFromInsuranceDetails($individual_accident_quote_id,$this->individual_accident_quote_personal_details);
		$record     = $this->admin_model->getDataOfIndividualAccidentToInsertForSelectedCompany($company_id);
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
			$this->admin_model->setInsertData($this->individual_accident_finalize_company, $data);
		}
		$payment_data = array(
			'policy_number'     => getPolicyId(),
			'insurance_type_id' => 5,
			'user_id'           => $user_id,
			'company_id'        => $company_id,
			'insured_id'        => $individual_accident_quote_id,
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
		$individual_insurance_option_details_id = $this->uri->segment(4);
		$individual_accident_quote_id           = getIndividualAccidentQuoteId($individual_insurance_option_details_id);
		$individual_accident_activity_id        = getIndividualAccidentPersonDetails($individual_accident_quote_id);
		$user_id            		            = getUserIdFromInsuranceDetails($individual_accident_quote_id,$this->individual_accident_quote_personal_details);
		$data['company_id']                     = getCompanyIdByIndividualInsuranceOptionDetailsId($individual_insurance_option_details_id);
		$data['branch_id']                      = getIndividualAccidentBranchId();
		$post_data                              = $this->input->post();
		if(!empty($post_data)) {
			$policy_code   = $this->input->post('policy_code');
			$policy_prefix = $this->input->post('policy_prefix');
			if(empty($this->input->post('policy_prefix'))) {
				$policy_number = getAutogeneratedPolicyNumber($data['company_id']);
			} else {
				if(checkPolicyNumberExists($policy_code."/".$policy_prefix) > 0) {
					$this->session->set_flashdata('message','Policy Number Already Exists. Please Enter another Policy Number');
					redirect('admin/individual-accident/view-finalize-detail/'.$individual_insurance_option_details_id);
				} else {
					$policy_number = $policy_code."/".$policy_prefix;
				}
			}
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
			$this->admin_model->setInsertData($this->individual_accident_finalize_company, $record);
			}

			$insurance_type_id  = $this->input->post('insurance_type_id');
			/*$data = array (
				'user_id'			=> $user_id,
				'insured_id'        => $individual_accident_quote_id,
				'insurance_type_id' => $insurance_type_id,
				'amount'            => $this->input->post('total_premium'),
				'accessories_id'    => $this->input->post('accessories_id')
			);
			
			$this->session->set_userdata('user_payment_data',$data);
			redirect('admin/payment/proceed-to-pay/'.$individual_insurance_option_details_id,'refresh');*/
			$payment_id         = getPaymentIdByInsurerIdInsuranceType($individual_accident_quote_id,$insurance_type_id);
			$data_payment = array(
				'policy_number' => $policy_number,
	            'amount' 	    => $this->input->post('total_premium'),
	            'modified_date' => date("Y-m-d H:i:s")
	        );

        	$updated_payment_id = $this->admin_model->setUpdateData('tbl_payment', $data_payment, $payment_id);
			redirect('admin/questionaries/'.$updated_payment_id);
			//redirect('admin/payment/proceed-to-pay/'.$updated_payment_id);
		}

		$company_id              = getCompanyIdByIndividualInsuranceOptionDetailsId($individual_insurance_option_details_id);
		$data['individual_insurance_option_details_id'] = $individual_insurance_option_details_id;
		$data['company_id']      = $company_id;
		$data['estimation_data'] = $this->admin_model->getFinalIndividualAccidentInsuranceDetail($this->individual_accident_finalize_company,$individual_insurance_option_details_id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/individual_accident/view_finalize_detail',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


	public function individual_accident_policies() {
		CheckAdminLoginSession();
		$data['dataCollection'] = $this->admin_model->getPoliciesByInsuranceTypeId(5);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/individual_accident/individual_accident_policies',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

	public function individual_accident_policies_edit() {
		CheckAdminLoginSession();

		$data['policy_number'] 	     = decrypt($this->uri->segment(4));
		$data['individual_accident_quote_id'] = $this->uri->segment(5);
		$data['individual_insurance_option_details_id'] = getIndividualAccidentOptionDetailsId($data['individual_accident_quote_id']);

		$data['company_id']           = getCompanyIdByIndividualInsuranceOptionDetailsId($data['individual_insurance_option_details_id']);
		$data['branch_id']            = getIndividualAccidentBranchId();
		$data['risque_id']            = getIndividualAccidentRisqueId();
		$data['activity_id'] 	      = getActivtiyIdByAccidentQuoteId($data['individual_accident_quote_id']);
        $data['insurance_options']    = getAccidentInsuranceOptions($data['activity_id'],$data['company_id']);
        $data['insurance_options_id'] = getIndividualInsuranceOptionId($data['individual_insurance_option_details_id']);
        $post_data 					  = $this->input->post();
       	if(!empty($post_data)) {
       		$policy_number = $this->input->post('policy_number');

       		if($policy_number == $data['policy_number']) {

       			$insurance_option_details_to_update = array (
       				'accident_insurance_optionid' => $this->input->post('accident_insurance_optionid')
       			);
       			$update_option_details_id = $this->admin_model->setUpdateData($this->individual_insurance_option_details,$insurance_option_details_to_update,$data['individual_insurance_option_details_id']);
       		} else {

       		}
       		$this->session->set_flashdata('message',POLICY_UPDATE_SUCCESS_MESSAGE);
        	redirect('admin/individual-accident/individual-accident-policies','refresh');
       	}
       /* print_r($data['insurance_options']);

		die;*/
		/*$data['branch_id']         = getProffesionalBranchId();
		$data['company_id']        = getCompanyIdByProffesionalMultiRiskId($data['proffesional_multirisk_quote_id']);
		$data['risque_id']         = getProffesionalRisqueId();

		$array_id = array ('proffesional_multirisk_quote_id' => $data['proffesional_multirisk_quote_id']);*/


		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/individual_accident/individual_accident_policies_edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}
}