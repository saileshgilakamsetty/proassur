<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {

	function __construct() {
    	parent::__construct();
    	$this->load->model('front_model'); 
    	$this->load->helper('front_helper');
	}

	public $vehicle_owner_detail         = 'tbl_vehicle_owner_detail';
	public $vehicle_detail               = 'tbl_vehicle_detail';
	public $secondry_driver              = 'tbl_vehicle_secondry_driver';
	public $selected_optional_warranty   = 'tbl_selected_optional_warranty';

    public $selected_vehicle_trans_insurance  = 'tbl_selected_vehicle_trans_insurance';
	public $selected_optional_franchise  = 'tbl_selected_optional_franchise';
	public $selected_bonus               = 'tbl_selected_bonus';
	public $selected_premium             = 'tbl_selected_premium';
	public $finalize_vehicle_insurance   = 'tbl_finalize_vehicle_insurance';
	


    function index(){
    	$data = "Welcome to vehicle";
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('car_number', 'Car Number', 'required|trim');
			if($this->form_validation->run() == FALSE) {  	 } 
			else {
				$car_number = $this->input->post('car_number');
					$record = getRecordByImmatriculationNumber($car_number);
				if(!empty($record)) {
					redirect('vehicle/vehicle-detail/'.$car_number, 'refresh'); 
				}
				else {
					$this->session->set_flashdata('message',NO_RECORD);
				}
			}	
		}
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/vehicle/new_old');
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }

// function to add the basic info, to get the company list
    function basic_info() {
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('make_id', 'Make/Brand', 'required|trim');
			// $this->form_validation->set_rules('usage', 'Usage', 'required|trim');	
			$this->form_validation->set_rules('designation', 'Designation', 'required|trim');	
			// $this->form_validation->set_rules('registeration_date', 'Registeration Date', 'required|trim');	
			// $this->form_validation->set_rules('seats', 'Seats', 'required|numeric|trim');	
			// $this->form_validation->set_rules('fuel_type', 'Fuel Type', 'required|trim');	
			// $this->form_validation->set_rules('horse_power', 'Horse Power', 'required|trim');	
			// $this->form_validation->set_rules('fiscal_power', 'Fiscal Power', 'required|trim');	
			$this->form_validation->set_rules('term_condition', 'Terms & Condition', 'required|trim');	
			if($this->form_validation->run() == FALSE) {  	 } 
			else {
				CheckUserLoginSession();
				$data                = array(									
					//'user_id'        => $this->session->userdata('user_id'),
					'user_id'        => $this->input->post('user_id'),
					'fuel_type'      => $this->input->post('fuel_type'),
					'fiscal_power'   => $this->input->post('fiscal_power'),
					'usage'          => $this->input->post('usage'),
					'trailer'        => $this->input->post('trailer'),
					'risque'         => $this->input->post('risque'),
					'seats'          => $this->input->post('seats'),
					'make_id'        => $this->input->post('make_id'),
					'designation'    => $this->input->post('designation'),
					'horse_power'    => $this->input->post('horse_power'),
					'register_date'  => $this->input->post('registeration_date'),
					'created_date'   => date('Y-m-d H:i:s'),
					'modified_date'  => date('Y-m-d H:i:s')
				); 
/*				print_r($data);
				die();*/
/*				$id              = $this->front_model->setInsertData('tbl_vehicle_basic_info',$data);
				if ($id>0) {*/
					$result              = $this->front_model->getCompanyQuote($data,'tbl_company_vehicle_quote');
					if (count($result)>0) {
						$id              = $this->front_model->setInsertData('tbl_vehicle_basic_info',$data);
						$this->best_offer($result,$id);
					}
					else {
						$this->session->set_flashdata('message',NO_RECORDS);
						redirect('vehicle/basic-info', 'refresh'); 
					}
/*				}
				else {
					$this->session->set_flashdata('message',TRY_AGAIN);
					redirect('vehicle/basic-info', 'refresh'); 
				}*/
	    	}
        }
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/vehicle/basic_info');
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }

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

// function to view and select the best offer
    function best_offer($result,$id) {
		$data['dataCollection']        = $result;
		$data['vehicle_basic_info_id'] = $id;
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/vehicle/best_offer',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }

// function to save the vehicle details
    function vehicle_detail() {
    	// echo "string";
    	CheckLoginSession();

		$post_data       = $this->input->post();
		if(!empty($post_data)) {  

    	if($this->uri->segment(3)) {
			$this->session->set_flashdata('message',RECORD_ALREADY_EXISTS);
    	}
    	else {

			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('registeration_number', 'Registeration Number', 'required|trim');
			$this->form_validation->set_rules('immatriclulation', 'Immatriclulation', 'required|trim');
			//$this->form_validation->set_rules('registeration_date', 'Registeration Date', 'required|trim');
			$this->form_validation->set_rules('catalogue_value', 'Catalouge Value', 'required|trim|numeric');
			$this->form_validation->set_rules('current_value', 'Current Value', 'required|trim|numeric');
			//$this->form_validation->set_rules('engine_displacement', 'Engine Displacement', 'required|trim|numeric');
			//$this->form_validation->set_rules('vehicle_category', 'Vehicle Category', 'required|trim');
			//$this->form_validation->set_rules('tariff_code', 'Tariff Code', 'required|trim');
			$this->form_validation->set_rules('vehicle_identification', 'Vehicle Identification', 'required|trim');
			$this->form_validation->set_rules('previous_register_date', 'Previous Register Date', 'required|trim');
			//$this->form_validation->set_rules('date_release_certificate', 'Date Release Certificate', 'required|trim');
			//$this->form_validation->set_rules('date_first_release', 'Date First Release', 'required|trim');
			//$this->form_validation->set_rules('engine_number', 'Engine Number', 'required|trim');
			//$this->form_validation->set_rules('usage', 'Usage', 'required|trim');
			//$this->form_validation->set_rules('body_work', 'Body Work', 'required|trim');
			//$this->form_validation->set_rules('vehicle_type', 'Terif', 'required|trim');
			//$this->form_validation->set_rules('gear_box', 'Gear Box', 'required|trim');
			//$this->form_validation->set_rules('authroise_weight', 'Authroise Weight', 'trim|numeric');
			//$this->form_validation->set_rules('load_weight', 'Load Weight', 'trim|numeric');
			//$this->form_validation->set_rules('chasis_number', 'Chasis Number', 'trim|numeric');
			// $this->form_validation->set_rules('seating_capacity', 'Seating Capacity', 'required|trim');
			// $this->form_validation->set_rules('tax_bonus', 'Tax Bonus', 'required|trim');

			if($this->form_validation->run() == FALSE) {  	 } 
			else {
				$data        = array(	
					'user_id'  						     => $this->session->userdata('user_id'),
					'vehicle_basic_info_id'              => $this->input->post('vehicle_basic_info_id'),
					'registeration_number'               => $this->input->post('registeration_number'),
					'risque_id'                          => $this->input->post('risque_id'),
					'insurance_registeration_date'       => $this->input->post('insurance_registeration_date'),
					'tvv'                                => $this->input->post('tvv'),
					'company_vehicle_quote_id'           => $this->input->post('company_vehicle_quote_id'),
					'catalogue_value'                    => $this->input->post('catalogue_value'),
					'vehicle_identification'             => $this->input->post('vehicle_identification'),
					'date_release_certificate'           => $this->input->post('date_release_certificate'),
					'engine_displacement'                => $this->input->post('engine_displacement'),
					'vehicle_category'                   => $this->input->post('vehicle_category'),
					'chasis_number'                      => $this->input->post('chasis_number'),
					'authroise_weight'                   => $this->input->post('authroise_weight'),
					'vehicle_type'                       => $this->input->post('vehicle_type'),
					'gear_box'                           => $this->input->post('gear_box'),
					'tax_bonus'                          => $this->input->post('tax_bonus'),
					'registeration_date'                 => $this->input->post('registeration_date'),
					'immatriclulation'                   => $this->input->post('immatriclulation'),
					'current_value'                      => $this->input->post('current_value'),
					'previous_register_date'             => $this->input->post('previous_register_date'),
					'date_first_release'                 => $this->input->post('date_first_release'),
					'engine_number'                      => $this->input->post('engine_number'),
					'usage'                              => $this->input->post('usage'),
					'body_work'                          => $this->input->post('body_work'),
					'load_weight'                        => $this->input->post('load_weight'),
					'tariff_code'                        => $this->input->post('tariff_code'),
					'seating_capacity'                   => $this->input->post('seating_capacity'),
					'modified_date'                      => date('Y-m-d H:i:s')
				);
/*				print_r($data);
				die();*/
				$id                = $this->front_model->setInsertData($this->vehicle_detail,$data);
				$this->session->set_flashdata('message','Your Vehicle Details has been added');
		        redirect('vehicle/owner-detail/'.$id,'refresh');
			}
		}
		}
		$record = getRecordByImmatriculationNumber($this->uri->segment(3));
		$data['dataCollection'] = $record;
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/include/motar_menu_options');
		$this->load->view('front/vehicle/vehicle_detail',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
    }

// function to save the vehicle owner detail 
    function owner_detail() {
    	CheckLoginSession();
		$vehicle_detail_id = $this->uri->segment(3);
		$post_data       = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('user_id', 'Name', 'required|trim');	
			$this->form_validation->set_rules('address', 'Address', 'required|trim');
			$this->form_validation->set_rules('region_id', 'Region', 'required|trim');
			$this->form_validation->set_rules('address', 'Address', 'required|trim');
			$this->form_validation->set_rules('department_id', 'Department', 'required|trim');
			$this->form_validation->set_rules('commune_id', 'Commune', 'required|trim');
			/*if(empty($_FILES["image"]["name"])) {
				$this->form_validation->set_rules('image', 'Image', 'required');
			}*/
			if($this->form_validation->run() == FALSE) {  	 } 
			else {
				$data = array(
				'vehicle_detail_id' => $vehicle_detail_id,
				'owner'             => $this->input->post('owner'),
				'user_id'           => $this->input->post('user_id'),
				'address'           => $this->input->post('address'),
				'region_id'         => $this->input->post('region_id'),
				'department_id'     => $this->input->post('department_id'),
				'commune_id'        => $this->input->post('commune_id'),
				'created_date'      => date('Y-m-d H:i:s'),
				'modified_date'     => date('Y-m-d H:i:s')
				);
				if($_FILES["image"]["name"] != "") {
					$image             = do_upload_images('owner_detail','image');
				} else {
					$image 			   = '';
				}
				
				$data['document']      = $image;
				$id                    = $this->front_model->setInsertData($this->vehicle_owner_detail,$data);
				$this->session->set_flashdata('message','Your Vehicle Owner Details has been added');
        		redirect('vehicle/secondary-driver/'.$vehicle_detail_id,'refresh');
				//$data_featured_img = $image;
			}
		}	
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/include/motar_menu_options');
		$this->load->view('front/vehicle/owner_detail');
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');    	
    }

// function to set the driver details
    function secondary_driver() {
    	CheckLoginSession();
		$vehicle_detail_id = $this->uri->segment(3);
		$post_data       = $this->input->post();
		$data['vehicle_detail_id']   = $vehicle_detail_id;
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');
			$this->form_validation->set_rules('issue_date_license', 'Date of Issue license', 'required|trim');
			$this->form_validation->set_rules('year_license_expire', 'Years for license expire', 'required|trim|numeric');
			$this->form_validation->set_rules('license_number', 'License Number', 'required|trim');
			$this->form_validation->set_rules('permit_id', 'Permit', 'required|trim');
			if($this->form_validation->run() == FALSE) {  	 } 
			else {
				$data = array(
				'vehicle_detail_id'       => $vehicle_detail_id,
				'owner'                   => $this->input->post('owner'),
				'name'                    => $this->input->post('name'),
				'issue_date_license'      => $this->input->post('issue_date_license'),
				'year_license_expire'     => $this->input->post('year_license_expire'),
				'license_number'          => $this->input->post('license_number'),
				'permit_id'               => $this->input->post('permit_id'),
				'double_command'          => $this->input->post('double_command'),
				'created_date'            => date('Y-m-d H:i:s'),
				'modified_date'           => date('Y-m-d H:i:s')
				);

				$id                = $this->front_model->setInsertData($this->secondry_driver,$data);
				$this->session->set_flashdata('message','Your Vehicle Secondary Details has been added');
				redirect('vehicle/optional-warranties/'.$vehicle_detail_id,'refresh');
			}	
		}	
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/vehicle/secondary_driver',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');    	
    }

// function to select the multiple warranties
    function optional_warranties() {
    	CheckLoginSession();
		$vehicle_detail_id = $this->uri->segment(3);
		$branch_id         = getBranchIdByName();
		$company_id        = getCompanyIdByVehicleDetailId($vehicle_detail_id);
		$risque_id         = getRisqueIdByVehicleDetailId($vehicle_detail_id);
		$post_data         = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected', 'Optional warranty', 'required|trim');	
			if($this->form_validation->run() == FALSE) {  } else {
				$value_selected = explode(',', $this->input->post('value_selected'));
				foreach ($value_selected as $value) {
					$data = array(
					'optional_warranty_id'    => $value,
					'vehicle_detail_id'       => $vehicle_detail_id,
					'created_date'            => date('Y-m-d H:i:s'),
					'modified_date'           => date('Y-m-d H:i:s')
					);
					$id                = $this->front_model->setInsertData($this->selected_optional_warranty,$data);
				}
				$this->session->set_flashdata('message','Your Vehicle Optional Warranty has been added.');
		        redirect('/vehicle/transport-person-insurance/'.$vehicle_detail_id,'refresh');
			}
		}

		$data['optional_warranties'] = $this->front_model->getOptionalWarranties($company_id,$branch_id,$risque_id);

		$data['vehicle_detail_id']   = $vehicle_detail_id;

		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/include/motar_menu_options');
		$this->load->view('front/vehicle/optional_warranties',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');    	
    }


// function to select the transported person insurance
    function trnsprt_prsn_insurance() {
    	CheckLoginSession();
		$vehicle_detail_id = $this->uri->segment(3);
		$branch_id         = getBranchIdByName();
		$company_id        = getCompanyIdByVehicleDetailId($vehicle_detail_id);
		//$data              = '';  
		$post_data         = $this->input->post();  	
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_travel_insure', 'Option', 'required|trim');	

			if($this->form_validation->run() == FALSE) {  } else {
					$data = array(
					'vehicle_trans_person_insurance_id'   => $this->input->post('value_selected_travel_insure'),
					'vehicle_detail_id'       => $vehicle_detail_id,
					'created_date'            => date('Y-m-d H:i:s'),
					'modified_date'           => date('Y-m-d H:i:s')
					);
					$id                = $this->front_model->setInsertData($this->selected_vehicle_trans_insurance,$data);
				$this->session->set_flashdata('message','Your option for Vehicle Transported person has been added.');
    			redirect('vehicle/optional-deductibles/'.$vehicle_detail_id,'refresh');
			}
		}
		$data['options']     = $this->front_model->getInsuredTravelOptions($company_id);
		$data['vehicle_detail_id']   = $vehicle_detail_id;
		$data['vehicle_detail_id'];
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/include/motar_menu_options',$data);
		$this->load->view('front/vehicle/trnsprt_prsn_insurance',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');    	
    }

// function to select the optional-deductibles
    function optional_deductibles() {
    	CheckLoginSession();
		$vehicle_detail_id = $this->uri->segment(3);
		$branch_id         = getBranchIdByName();
		$company_id        = getCompanyIdByVehicleDetailId($vehicle_detail_id);
		//$data              = '';
		$post_data         = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_franchise', 'Optional Franchise', 'required|trim');	

			if($this->form_validation->run() == FALSE) {  } else {
				$value_selected_franchise = explode(',', $this->input->post('value_selected_franchise'));
				foreach ($value_selected_franchise as $value) {
					$data = array(
					'optional_franchise_id'   => $value,
					'vehicle_detail_id'       => $vehicle_detail_id,
					'created_date'            => date('Y-m-d H:i:s'),
					'modified_date'           => date('Y-m-d H:i:s')
					);
					$id                = $this->front_model->setInsertData($this->selected_optional_franchise,$data);
				}
				$this->session->set_flashdata('message','Your Vehicle Optional Franchise has been added.');
		        redirect('vehicle/bonus-reductions/'.$vehicle_detail_id,'refresh');
			}
		}
		$data['optional_franchies'] = $this->front_model->getOptionalFranchicies($company_id,$branch_id);
		$data['vehicle_detail_id']   = $vehicle_detail_id;

		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/include/motar_menu_options');
		$this->load->view('front/vehicle/optional_deductibles',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');    	
    }

// function to select the Bonus and Reductions
    function bonus_reductions() {
    	CheckLoginSession();
		$vehicle_detail_id  = $this->uri->segment(3);
		$branch_id          = getBranchIdByName();
		$company_id         = getCompanyIdByVehicleDetailId($vehicle_detail_id);
		//$data               = '';
		$post_data          = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('value_selected_bounus_option', 'Option', 'required|trim');	

			if($this->form_validation->run() == FALSE) {  } else {
					$data = array(
					'value_selected_bounus_option' => $this->input->post('value_selected_bounus_option'),
					'vehicle_detail_id' => $vehicle_detail_id,
					'company_id'        => $company_id,
					'branch_id'         => $branch_id,
					'approved_status'   => 0,
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s')
					);

				if($_FILES["image"]["name"] != "") {
					$image             = do_upload_images('bonus_documents','image');
					if($image) {
						$data['document_image'] = $image ;
						$id                = $this->front_model->setInsertData($this->selected_bonus,$data);
						$this->session->set_flashdata('message','Your option for Bonus Has been recorded. It will be effected once admin will approve it.For futher details please contact to admin.');
		        		redirect('vehicle/premium-duration/'.$vehicle_detail_id,'refresh');
					}
				}
				else {
					$id                = $this->front_model->setInsertData($this->selected_bonus,$data);
					$this->session->set_flashdata('message','Your option for Bonus Has been recorded. It will be effected once admin will approve it.For futher details please contact to admin.');
		        	redirect('vehicle/premium-duration/'.$vehicle_detail_id,'refresh');
				}
			}
		}
		$data['discount_year']     = getDiscountAndYear($company_id,$branch_id);
		$data['vehicle_detail_id'] = $vehicle_detail_id;

		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/include/motar_menu_options');
		$this->load->view('front/vehicle/bonus_reductions',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');    	
    }

// function to select the Bonus and Reductions
    function premium_duration() {
    	CheckLoginSession();
		$vehicle_detail_id  = $this->uri->segment(3);
		$branch_id          = getBranchIdByName();
		$company_id         = getCompanyIdByVehicleDetailId($vehicle_detail_id);
		//$data               = '';
		$post_data          = $this->input->post();
		if(!empty($post_data)) {       
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('from', 'From', 'required|trim');	
			$this->form_validation->set_rules('to', 'To', 'required|trim');	

			if($this->form_validation->run() == FALSE) {  } else {
				$from          = new DateTime($this->input->post('from'));
				$to            = new DateTime($this->input->post('to'));
				$days          = $to->diff($from)->format("%a");

				$premium_id = $this->front_model->getPremiumIdByDays($days,$company_id);
				if (!empty($premium_id)) {
					$data = array(
						'from_'            => date_format(date_create($this->input->post('from')),"Y-m-d H:i:s"),
						'to_'               => date_format(date_create($this->input->post('to')),"Y-m-d H:i:s"),
						'vehicle_detail_id' => $vehicle_detail_id,
						'premium_id'        => $premium_id,
						'tacit_policy'    => $this->input->post('tacit_policy'),
						'created_date'    => date('Y-m-d H:i:s'),
						'modified_date'   => date('Y-m-d H:i:s')
					);
/*					print_r($data);
					die();*/
					$id       = $this->front_model->setInsertData($this->selected_premium,$data);
					$this->session->set_flashdata('message','Your record has been saved successfully.');
					redirect('vehicle/get-all-selected-options/'.$vehicle_detail_id,'refresh');
				}
				else {
					$this->session->set_flashdata('message','Please select the valid date. As the record for selected date does not exists.');
				}
			}
		}
		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/include/motar_menu_options');
		$this->load->view('front/vehicle/premium_duration');
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');    	
    }

// function to get all selected options
    public function get_all_selected_options() {
    	CheckLoginSession();
		$vehicle_detail_id                 = $this->uri->segment(3);
		$data['vehicle_detail_id']         = $this->uri->segment(3);
		$data['company_id']                = getCompanyIdByCompanyVehicleQuoteId(getCompanyVehicleQuoteId($vehicle_detail_id));
		$data['selected_warranty_name_id'] = $this->front_model->getWarrantiesSelected($vehicle_detail_id);
		$data['selected_francise_name_id'] = $this->front_model->getFranchisesSelected($vehicle_detail_id);
		$data['selected_transported_person_insurance_id'] = $this->front_model->getTransportedPersonSelected($vehicle_detail_id);
		$data['selected_premium'] = $this->front_model->getSelectedPremiumForVehicleId($vehicle_detail_id);
		$post_data                = $this->input->post();     

		if(empty($this->input->post('company_id'))) {
			$data['companies_id'] = explode(',', $data['company_id']);
		}		

		else {
			$data['companies_id'] = $this->input->post('company_id');	
		}
		$data['qwerty']       = getSelectedDatRecordsForSelectedCompany($data['selected_warranty_name_id'],$data['companies_id'],$data['selected_francise_name_id'],$data['selected_transported_person_insurance_id'],$vehicle_detail_id);

		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/include/motar_menu_options');
		$this->load->view('front/vehicle/get_all_selected_options',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');  
    }

// function to get the designation by id
	public function getDesignationById() {
        $data    = '';
        $data    = 'class="control-group  "';
        $result  =  form_dropdown('designation_id', getDesignationByBrandId($this->input->post('make_id')),set_value('designation_id'),$data); 
        print_r($result);
	}

// ajax function to get the details of vehicle like the fuel type and others
	public function getdetailsByDesignationId() {
		$make_id        = $this->input->post('make_id');
		$designation_id = $this->input->post('designation_id');
		$result         = $this->front_model->getdetailsByDesignationId($make_id,$designation_id);
		print_r($result);
		return $result;
	}


// function to get Department By Region Id of risque
	public function getDepartmentByRegionId() {
        $data    = '';
        $data    = 'class="control-group  " id="department_by_region" ';
        $result  =  form_dropdown('department_id', getDepartmentByRegionId($this->input->post('region_id')),set_value('department_id'),$data); 
        print_r($result);
        return $result;
	}

// function to get commune By department Id 
	public function getCommuneByDepartmentId() {
        $data    = '';
        $data    = 'class="control-group  " id="commune_by_department" ';
        $result  =  form_dropdown('commune_id', getCommuneByDepartmentId($this->input->post('department_id')),set_value('commune_id'),$data); 
        print_r($result);
        return $result;
	}


// function to save the final details and the company
	function finalize_company(){
		$warranty           = $this->input->post('warranty');
		$franchise          = $this->input->post('franchise');
		$company_id         = $this->input->post('company_id');
		$vehicle_detail_id  = $this->input->post('vehicle_id');
		$total_estimation   = $this->input->post('total_estimation');
		$user_id 			= getUserIdFromInsuranceDetails($vehicle_detail_id,$this->vehicle_detail);

		$final_data = getFinalForSelectedCompany( explode(',', $franchise),explode(',', $warranty) ,explode(',', $company_id),$vehicle_detail_id);
		

		foreach ($final_data as $value) {
			$data = array(
				'value'             => $value['value'],
				'type'              => $value['type'],
				'name'              => $value['name'],
				'company_id'        => $value['company_id'],
				'company_name'      => $value['company_name'],
				'vehicle_detail_id' => $value['vehicle_detail_id']
			);
			$this->front_model->setInsertData($this->finalize_vehicle_insurance,$data);
		}

		$payment_data = array(
			// 'policy_number'     => getPolicyId(),
			'policy_number'     => getAutogeneratedPolicyNumber($company_id),
			'insurance_type_id' => 1,
			'total_estimation'  => $total_estimation,
			'user_id'           => $user_id,
			'company_id'        => $company_id,
			'insured_id'        => $vehicle_detail_id,
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

	function view_finalize_detail() {
		CheckLoginSession();
		$vehicle_detail_id               = $this->uri->segment(3);
		$data['branch_id']               = getBranchIdByName();
		$data['company_id']              = getCompanyIdByVehicleDetailId($vehicle_detail_id);
		$user_id 					     = getUserIdFromInsuranceDetails($vehicle_detail_id,$this->vehicle_detail);
		$days 					         = getDaysFromVehicleDetailId($vehicle_detail_id,'tbl_selected_premium');
		$data['premium_rate']            = getPremiumRateViaCompanyDays($days,getCompanyIdByVehicleDetailId($vehicle_detail_id));


		$data['estimation_amount'] = getEstimationAmountByInsurerIdInsuranceType($vehicle_detail_id, 1);

		// print_r($premium_rate);
		// die();
		
		$post_data              = $this->input->post();
		if(!empty($post_data)) {
			
			$data_type = array (
				'net_premium'       => $this->input->post('net_premium'),
				'accessories'       => $this->input->post('accessories'),
				'tax'               => $this->input->post('tax'),
				'policy_premium'    => $this->input->post('policy_premium'),
				'total_premium'     => $this->input->post('total_premium')
			);
			foreach($data_type as $key => $value) {
				$record = array(
					'value'             => $value,
					'type'              => 'other_required_data',
					'name'              => $key,
					'company_id'        => $data['company_id'],
					'company_name'      => getCompanyName($data['company_id']),
					'vehicle_detail_id' => $vehicle_detail_id
				);
				$this->front_model->setInsertData($this->finalize_vehicle_insurance, $record);
			}


			$insurance_type_id  = $this->input->post('insurance_type_id');
			/*$data = array (
				'user_id'			=> $user_id,
				'insured_id'        => $vehicle_detail_id,
				'insurance_type_id' => $insurance_type_id,
				'amount'            => $this->input->post('total_premium'),
				'accessories_id'    => $this->input->post('accessories_id')
			);
			$this->session->set_userdata('user_payment_data',$data);
			redirect('payment/proceed-to-pay/'.$vehicle_detail_id,'refresh');*/
			$payment_id         = getPaymentIdByInsurerIdInsuranceType($vehicle_detail_id,$insurance_type_id);
			$data_payment = array(
	            'amount' 	    => $this->input->post('total_premium'),
	            'modified_date' => date("Y-m-d H:i:s")
	        );

        	$updated_payment_id = $this->front_model->setUpdateData('tbl_payment', $data_payment, $payment_id);
			redirect('questionaries/'.$updated_payment_id);
			// redirect('payment/proceed-to-pay/'.$updated_payment_id);
		}


		$data['final_data']              = $this->front_model->getFinalVehicleInsuranceDetail($this->finalize_vehicle_insurance,$vehicle_detail_id);

		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/include/motar_menu_options');
		$this->load->view('front/vehicle/view_finalize_detail',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');		
	}


// function to get the vehicle basic info from it's id
	function getVehicleBasicInfo() {
		$id =  $this->input->post('vehicle_basic_info_id');
		$vehicle_basic_info      = $this->front_model->getDataCollectionByID('tbl_vehicle_basic_info',$id);	
		print_r($vehicle_basic_info);
		return $vehicle_basic_info;
	}
}
