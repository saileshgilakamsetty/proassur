<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Travel extends CI_Controller {

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
    
	public $travel                     = 'tbl_travel';
	public $travel_quote               = 'tbl_travel_quote';
	public $travel_destination_details = 'tbl_travel_destination_details';
	public $travel_people_insured      = 'tbl_travel_people_insured';
	public $travel_people_details      = 'tbl_travel_people_details';
	public $travel_finalize_company    = 'tbl_travel_finalize_company';


    // function to add the basic info by Utkarsh
	public function basic_info() {
		$post_data       = $this->input->post();

		if(!empty($post_data)) {  
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			for($i = 1; $i <= $post_data['people_insured'];$i++) {
				$this->form_validation->set_rules('firstname_'.$i, 'First Name', 'required|trim');
				$this->form_validation->set_rules('lastname_'.$i, 'Last Name', 'required|trim');
				$this->form_validation->set_rules('age_'.$i, 'Age Of Person', 'required');
			}
			$this->form_validation->set_rules('people_insured', 'No of Persons To Be Insured', 'required|trim');
			if($this->form_validation->run() == FALSE) { } 
			else { 
				$data = array(
					// 'user_id'		 => $this->session->userdata('user_id'),
					'user_id'		 => $this->input->post('user_id'),
					'people_insured' => $post_data['people_insured']
				);
				$id = $this->front_model->setInsertData($this->travel_people_insured, $data);
				if($id > 0) {
					for($i = 1; $i <= $post_data['people_insured']; $i++) {
						$people_details = array (
							'people_insured_id' => $id,
							'first_name'    => $post_data['firstname_'.$i],
							'last_name'     => $post_data['lastname_'.$i],
							'age_of_person' => date("Y-m-d H:i:s",strtotime($post_data['age_'.$i])),
							'age'           => date("Y-m-d H:i:s") - date("Y-m-d H:i:s",strtotime($post_data['age_'.$i]))
						);
						$this->front_model->setInsertData($this->travel_people_details, $people_details);
					}
					redirect('travel/destination-detail/'.$id, 'refresh'); 
				}
			}	
		}
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/travel/basic_info');
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

	// function to add travel detail by Utkarsh
	public function destination_detail() {
		CheckLoginSession();
		$post_data = $this->input->post();
		$id = $this->uri->segment(3);
		if(!empty($post_data)) {
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('travel_start_date', 'Travel Start Date', 'required');	
			$this->form_validation->set_rules('travel_end_date', 'Travel End Date', 'required');		
			$this->form_validation->set_rules('destination_of_trip', 'Destination of Trip', 'required');
			$this->form_validation->set_rules('total_travelers', 'Total Number of Travelers', 'required');
			if($this->form_validation->run() == FALSE) { }
			else {
				
				$destination_details = array(
					'people_insured_id'   => $id,
					'travel_start_date'   => date("Y-m-d H:i:s",strtotime($post_data['travel_start_date'])),
					'travel_end_date'     => date("Y-m-d H:i:s",strtotime($post_data['travel_end_date'])),
					'destination_of_trip' => $post_data['destination_of_trip'],
					'total_travelers'     => $post_data['total_travelers']
				);
				$result = $this->front_model->setInsertData($this->travel_destination_details, $destination_details);
				redirect('travel/get-estimation/'.$id, 'refresh');
			}
		}
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/travel/destination_detail');
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
	}

// function added by Shiv to get the estimation price
	public function get_estimation() {
		CheckLoginSession();
		$data['travel_id']             = $this->uri->segment(3);
		$travel_examination_list_array = getTravelExaminationList();
		$company_array                 = getCompanyIds();
		$data['travel_estimation']     = getTravelInsuranceCompanyComparision($travel_examination_list_array,$company_array,$data['travel_id']);

		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/travel/get_travel_estimation',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
	}


// function added by Shiv to get finalize company for travel
	public function finalize_company() {
		CheckLoginSession();
		$company_id = $this->input->post('company_id');
		$travel_id  = $this->input->post('travel_id');
		$record     = $this->front_model->getDataToInsertForSelectedCompany($company_id);
		$user_id    = getUserIdFromInsuranceDetails($travel_id,$this->travel_people_insured);
		foreach ($record as $key => $value) {
			$data = array(
				'travel_id'      => $travel_id,
				'name'           => $value->name,
				'amount'         => $value->amount,
				'company_id'     => $value->company_id,
				'company_name'   => getCompanyName($value->company_id),
				'branch_id'      => $value->branch_id,
				'branch_name'    => getBranchName($value->branch_id),
				'risque_name'    => getRisqueName($value->risque_id),
				'description'    => $value->description
			);
			$this->front_model->setInsertData($this->travel_finalize_company, $data);
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
			'policy_created_by' => getUserRoleIdByUserId($this->session->userdata('user_id')),
			'policy_created_for' => getUserRoleIdByUserId($user_id),
			'policy_creater'     => $this->session->userdata('user_id'),   
		);
		$this->front_model->setInsertData('tbl_payment',$payment_data);
		echo 1;
		//return true;
	}


// function added by Shiv to view finalize detail
	public function view_finalize_detail() {
		CheckLoginSession();
		$travel_id               	  = $this->uri->segment(3);
		$user_id    				  = getUserIdFromInsuranceDetails($travel_id,$this->travel_people_insured);
		$data['branch_id']       	  = getBranchIdByTravelId($travel_id);
		$data['company_id']      	  = getCompanyIdByTravelId($travel_id);
		$company_id              	  = getCompanyIdByTravelId($travel_id);
		$data['travel_id']       	  = $travel_id;
		$data['company_id']      	  = $company_id;

		$post_data 					  = $this->input->post();
		if(!empty($post_data)) {
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
					'branch_name'  => getBranchName($data['branch_id'])
				);
				$this->front_model->setInsertData($this->travel_finalize_company, $record);
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
			redirect('payment/proceed-to-pay/'.$travel_id,'refresh');*/
			$payment_id         = getPaymentIdByInsurerIdInsuranceType($travel_id,$insurance_type_id);
			$data_payment = array(
	            'amount' 	    => $this->input->post('total_premium'),
	            'modified_date' => date("Y-m-d H:i:s")
	        );

        	$updated_payment_id = $this->front_model->setUpdateData('tbl_payment', $data_payment, $payment_id);
			redirect('questionaries/'.$updated_payment_id);
			//redirect('payment/proceed-to-pay/'.$updated_payment_id);
		}


		$data['estimation_data'] 	  = $this->front_model->getFinalTravelInsuranceDetail($this->travel_finalize_company,$travel_id);
		$data['days_to_travel']       = getNumberOfDaysToTravel($travel_id);
		$data['travel_dates']         = getTravelStartEndDate($travel_id);
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/travel/view_finalize_detail',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
	}


}
