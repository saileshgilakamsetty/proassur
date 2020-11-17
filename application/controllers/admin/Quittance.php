<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quittance extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $quittance = 'tbl_quittance';

// function to get lists
	public function lists()	{
		CheckAdminLoginSession();
		$per_page            = 20;
        if($this->uri->segment(4)){
        	$page            = ($this->uri->segment(4)) ;
        }
        else {
        	$page            = 1;
        }
        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->quittance);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->quittance,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$url                    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL            = parse_url($url);
		$data["current_link"]   = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/quittance/lists',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// function to add a accessories
	public function add() {	
        CheckAdminLoginSession();	
		$post_data             = $this->input->post();

		if(!empty($post_data)) {      
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('company_id', 'Company', 'required');
			$this->form_validation->set_rules('branch_id', 'Branch', 'required');
			// $this->form_validation->set_rules('risque_id', 'Risque', 'required');
			//$this->form_validation->set_rules('policy_number', 'Policy Number', 'required|is_unique[tbl_payment.policy_number]');
			$this->form_validation->set_rules('policy_number', 'Policy Number', 'required|callback_check_unique_policy_number');
			$this->form_validation->set_rules('user_id', 'User', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
			$this->form_validation->set_rules('accessories','Accessories', 'required');
			$this->form_validation->set_rules('total_amount','Total Amount', 'required');
			$this->form_validation->set_rules('tax','Tax','required');
			$this->form_validation->set_rules('policy_creation_date','Policy Creation Date','required');
			$this->form_validation->set_rules('policy_start_date','Policy Start Date','required');
			$this->form_validation->set_rules('policy_end_date','Policy End Date','required');

			if($this->form_validation->run() == FALSE) {   } else {
				$policy_number = $this->input->post('policy_number');
				$data          = array(							
					'policy_number'     => $this->input->post('policy_number'),
					'policy_creation_date' => date('Y-m-d H:i:s',strtotime($this->input->post('policy_creation_date'))),
					'policy_start_date' => date('Y-m-d H:i:s',strtotime($this->input->post('policy_start_date'))),
					'policy_end_date'   => date('Y-m-d H:i:s',strtotime($this->input->post('policy_end_date'))),
					'company_id'        => $this->input->post('company_id'),
					'branch_id'         => $this->input->post('branch_id'),
					'risque_id'         => $this->input->post('risque_id'),
					'user_id'           => $this->input->post('user_id'),
					'amount'            => $this->input->post('amount'),	
					'tax'               => $this->input->post('tax'),	
					'accessories'       => $this->input->post('accessories'),
					'total_amount'      => $this->input->post('total_amount'),
					'created_date'      => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s'),
					'status'            => 1
				); 

				$id = $this->admin_model->setInsertData($this->quittance,$data);
				if($id > 0) {
					$this->session->set_flashdata('message','Your quittance has been added successfully');
		        	redirect('admin/quittance/lists','refresh');
				}
		    }
        }
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/quittance/add');
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}



// function to edit 
	public function edit() {
		$id           = $this->uri->segment(4);
		CheckAdminLoginSession();		
		$post_data    = $this->input->post();
		if(!empty($post_data)) {        	
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('company_id', 'Company', 'required');
			$this->form_validation->set_rules('branch_id', 'Branch', 'required');
			// $this->form_validation->set_rules('risque_id', 'Risque', 'required');
			$this->form_validation->set_rules('policy_number', 'Policy Number', 'required|callback_check_unique_policy_number');
			$this->form_validation->set_rules('user_id', 'User', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
			$this->form_validation->set_rules('accessories','Accessories', 'required');
			$this->form_validation->set_rules('total_amount','Total Amount', 'required');
			$this->form_validation->set_rules('tax','Tax','required');
			$this->form_validation->set_rules('policy_number','Policy Number','required');
			$this->form_validation->set_rules('policy_creation_date','Policy Creation Date','required');
			$this->form_validation->set_rules('policy_start_date','Policy Start Date','required');
			$this->form_validation->set_rules('policy_end_date','Policy End Date','required');


			if($this->form_validation->run() == FALSE) {   } else {
				$data           = array(							
					'policy_number'     => $this->input->post('policy_number'),
					'policy_creation_date' => date('Y-m-d H:i:s',strtotime($this->input->post('policy_creation_date'))),
					'policy_start_date' => date('Y-m-d H:i:s',strtotime($this->input->post('policy_start_date'))),
					'policy_end_date'   => date('Y-m-d H:i:s',strtotime($this->input->post('policy_end_date'))),
					'company_id'        => $this->input->post('company_id'),
					'branch_id'         => $this->input->post('branch_id'),
					'risque_id'         => $this->input->post('risque_id'),
					'user_id'           => $this->input->post('user_id'),
					'amount'            => $this->input->post('amount'),	
					'tax'               => $this->input->post('tax'),	
					'accessories'       => $this->input->post('accessories'),
					'total_amount'      => $this->input->post('total_amount'),
					// 'created_date'   => date('Y-m-d H:i:s'),
					'modified_date'     => date('Y-m-d H:i:s'),
					'status'            => 1
				); 

				$id = $this->admin_model->setUpdateData($this->quittance,$data,$id);	
				$this->session->set_flashdata('message','Your quittance has been update successfully');
		        redirect('admin/quittance/lists','refresh');
		    }
        }
		$data['dataCollection']         = $this->admin_model->getDataCollectionByID($this->quittance,$id);
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/quittance/edit',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

// callback function to check name exists or not at time of edit 
	public function check_name_exists($string) {
		$accessories_id   = $this->uri->segment(4);
    	$result       = $this->admin_model->checkNameAdded($accessories_id,$this->accessories,$string);
    	if($result>0) {
        	$this->form_validation->set_message('check_name_exists','The {field} selected is already been added. Please try another Name.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}




// callback function to check max value is greater than min value 
	public function check_max_value_validation($string) {
    	if($string < $this->input->post('minimum_premium')) {
        $this->form_validation->set_message('check_max_value_validation','The {field} value can not be less than minimum premium. Please try another value.');
        	return FALSE;
    	}
    	else {
    		return TRUE;
    	} 
	}

// callback function to check for the existing policy number while generating the quittance for a policy
	public function check_unique_policy_number($string) {
		if($string == '') {
			$this->form_validation->set_message('check_unique_policy_number','The {field} is required.');
			return FALSE;
		} else {
			$required_id = checkPolicyNumberExists($string);
			if($required_id > 0) {
				return TRUE;
			} else {
				$this->form_validation->set_message('check_unique_policy_number','The mentioned {field} does not exist. Please try the another Policy Number.');
				return FALSE;
			}
		}
	}





// function to delete
	public function delete() {
		CheckAdminLoginSession();
		$id               = $this->uri->segment(4);
		$this->admin_model->dataDelete($this->quittance,$id);
		$this->session->set_flashdata('message','Your quittance has been deleted successfully');
        redirect('admin/quittance/lists','refresh');
	}

// function to change status
	public function status()
	{
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->quittance,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/quittance/lists','refresh');		
	}

	public function getAccessoriesAndTotalPremium() {
		$total_amount = $this->input->post('total_amount');
		$company_id   = $this->input->post('company_id');
		$branch_id    = $this->input->post('branch_id');
		$risque_id    = $this->input->post('risque_id');

	   	$accessories_id    = getAccessoriesId($total_amount,$company_id);
	  	$accessories_value = getAccessoriesValue($total_amount,$company_id,$branch_id);
	   	$tax_amount        = getTaxAmount($accessories_value + $total_amount);
	   	$total_premium     = $total_amount + $accessories_value + $tax_amount;

	   	$record = array(
	   				'accessories_value' => $accessories_value,
	   				'tax_amount' => $tax_amount,
	   				'total_premium' => $total_premium
	   			);
	   	print_r(json_encode($record));
	   	return json_encode($record);
	}

// get the quittance of the month
	public function get_quittance_month() {
		$role = $this->input->post('role');
		if($role == 3) {
			$user_id    = $this->input->post('user_id');
			$start_date = $this->input->post('start_date');
			$end_date   = $this->input->post('end_date');
			$data       = array(
				'role'       => $role,
				'user_id'    => $user_id,
				'start_date' => $start_date,
				'end_date'   => $end_date
			);
		} else if($role == 4) {
			$company_id = $this->input->post('company_id');
			$branch_id  = $this->input->post('branch_by_company');
			$risque_id  = $this->input->post('risque_by_branch');
			$start_date = $this->input->post('start_date');
			$end_date   = $this->input->post('end_date');
			$data       = array(
				'role'       => $role,
				'company_id' => $company_id,
				'branch_id'  => $branch_id,
				'risque_id'  => $risque_id,
				'start_date' => $start_date,
				'end_date'   => $end_date
			);
		}

		$year     = date("Y"); // get the year part of the current date
		$month    = date('m'); // get the month part of the current date
		$record   = $this->admin_model->quittance_of_month($year,$month,$data);
		if (!empty($record)) {
			print_r($record);
			return $record;
		}
		else {
			print_r("No records found..!!");
		}
	}


// ajax function to send Quittance of month to Company
	public function send_month_quittance_company() {
		$quittances_start_interval = $this->input->post('quittances_start_interval');
		$quittances_end_interval   = $this->input->post('quittances_end_interval');
		$creater_role   		   = $this->input->post('creater_role');
		$policy_creater 		   = $this->input->post('policy_creater');
		$policy_num     		   = $this->input->post('policy_number_selected');
		$company_pol    		   = $this->input->post('company_policy_selected');
		$selected_company 		   = $this->input->post('selected_company');
		$branch_id      		   = $this->input->post('selected_branch');
		$policy_numbers 		   = explode(',',$policy_num);
		// code to upload cheques
		if($_FILES["image"]["name"] != "") {
			// code to get a slip number
			$slip_number      = getSlipNumber() + 1;
			if($creater_role == 4) {
				$slip_name     = getCompanyName($selected_company).'/'.date("Y").'/'.strtoupper(date("M")).'/'.$slip_number;
			} else if($creater_role == 3) {
				$slip_name     = getUserName($policy_creater).'/'.date("Y").'/'.strtoupper(date("M")).'/'.$slip_number;
			}
			$dataSlip = array(
				'slip_number'  				=> $slip_number,
				'slip_name'    				=> $slip_name,
				'cheque_path'  				=> do_upload('quittance','image'),
				'created_by'   				=> 1, //'admin',
				'company_id'                => $selected_company,
				'month'        				=> date("M"),
				'year'         				=> date("Y"),
				'quittances_start_interval' => $quittances_start_interval,
				'quittances_end_interval' 	=> $quittances_end_interval,
				'status'                    => 0, // Pending
				'created_date' 				=> date('Y-m-d H:i:s')
			);
			$this->admin_model->setInsertData('tbl_slip_data',$dataSlip);

			foreach ($policy_numbers as $value) {
				$data['status']   = 0; // Active	
				$data_slip        = array(
				'policy_number'   => $value,
				'slip_name'       => $slip_name,
				'created_date'    => date('Y-m-d H:i:s')

				);	 
				$this->admin_model->setInsertData('tbl_slip_policy',$data_slip);
				$this->admin_model->setUpdateQuittanceData($this->quittance,$data,$value);
			}
			if($creater_role == 4) {
				$company_pol_option = json_decode($company_pol);
				$total_net_amount   = 0;
				$total_accessories  = 0;
				$total_tax          = 0;
				$total_amount       = 0;
				foreach ($company_pol_option as $company_id => $policy_detail) {
					$email_template    = 'send_policy_to_company.html';
						$data = '';
						$data = '<tr>';
						$data.= '<td style="width:10%">';
						$data.= '<b>Policy</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>Client No</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>User Name</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>Quittance</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>Net Amount</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>Tax</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>Accessories</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>Total Amount</b>';
						$data.= '</td>';
						$data.= '</tr>';
						// print_r($policy_detail);

					foreach ($policy_detail as $value) {
						// foreach ($policy_list as  $value) {
							# code...
							$total_net_amount  = $total_net_amount + $value->net_amount;
							$total_accessories = $total_accessories + $value->accessories;
							$total_tax         = $total_tax + $value->tax;
							$total_amount      = $total_amount + $value->total_amount;
							$data.= '<tr>';
							$data.= $value->branch_id;
							$data.= '</tr>';
							$data.= '<tr>';
							$data.= '<td width="20">';
							$data.= $value->policy_number;
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= $value->user_id;
							$data.= '</td>';
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= getUserName($value->user_id);
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= $value->quittance_id;
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= $value->net_amount;
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= $value->tax;
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= $value->accessories;
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= $value->total_amount;
							$data.= '</td>';
							$data.= '</tr>';
						// }
					}
					$data.= '<tr>';
					$data.= '</tr>';
					$data.= '<tr>';
					$data.= '<td>';
					$data.= '</td>';
					$data.= '<td>';
					$data.= '</td>';
					$data.= '<td>';
					$data.= '</td>';
					$data.= '<td>';
					$data.= '<b>Total</b>';
					$data.= '</td>';
					$data.= '<td>';
					$data.= $total_net_amount;
					$data.= '</td>';
					$data.= '<td>';
					$data.= $total_tax;
					$data.= '</td>';
					$data.= '<td>';
					$data.= $total_accessories;
					$data.= '</td>';
					$data.= '<td>';
					$data.= $total_amount;
					$data.= '</td>';

					$data.= '</tr>';
						$templateTags      =  array(
							'{{site_name}}'               => 'Proassur.com',
							'{{site_logo}}'               => base_url(),
							'{{site_url}}'                => base_url(),
							'{{team_name}}'               => 'Proassur',
							'{{year}}'                    => date('Y'),
							'{{data}}'                    =>  $data,
							'{{company_name}}'                       => getCompanyName($company_id),
							'{{branch_name}}'                       => getBranchName($branch_id)
						);
						$message    = email_compose($email_template,$templateTags);
						$to      = 'shiv.prakash@sourcesoftsolutions.com';
						// $to      = getCompanyMailId($company_id);
						$subject = "Quittance of the Month";
						send_smtp_mail($to,$subject,$message);
						// print_r($message);
				}
			} else if($creater_role == 3) {

				$company_pol_option = json_decode($company_pol);
				$total_net_amount   = 0;
				$total_accessories  = 0;
				$total_tax          = 0;
				$total_amount       = 0;
				$total_partner_commission = 0;
				foreach ($company_pol_option as $company_id => $policy_detail) {
					$email_template    = 'send_policy_to_company.html';
						$data = '';
						$data = '<tr>';
						$data.= '<td style="width:10%">';
						$data.= '<b>Policy</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>Client No</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>User Name</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>Quittance</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>Net Amount</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>Tax</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>Accessories</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>Total Amount</b>';
						$data.= '</td>';
						$data.= '<td>';
						$data.= '<b>Partner Policy Commission</b>';
						$data.= '</td>';
						$data.= '</tr>';
						// print_r($policy_detail);

					foreach ($policy_detail as $value) {
						// foreach ($policy_list as  $value) {
							# code...
							$total_net_amount  = $total_net_amount + $value->net_amount;
							$total_accessories = $total_accessories + $value->accessories;
							$total_tax         = $total_tax + $value->tax;
							$total_amount      = $total_amount + $value->total_amount;
							$total_partner_commission = $total_partner_commission + $value->partner_policy_commission;
							$data.= '<tr>';
							$data.= $value->branch_id;
							$data.= '</tr>';
							$data.= '<tr>';
							$data.= '<td width="20">';
							$data.= $value->policy_number;
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= $value->user_id;
							$data.= '</td>';
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= getUserName($value->user_id);
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= $value->quittance_id;
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= $value->net_amount;
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= $value->tax;
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= $value->accessories;
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= $value->total_amount;
							$data.= '</td>';
							$data.= '<td width="20">';
							$data.= $value->partner_policy_commission;
							$data.= '</td>';
							$data.= '</tr>';
						// }
					}
					$data.= '<tr>';
					$data.= '</tr>';
					$data.= '<tr>';
					$data.= '<td>';
					$data.= '</td>';
					$data.= '<td>';
					$data.= '</td>';
					$data.= '<td>';
					$data.= '</td>';
					$data.= '<td>';
					$data.= '<b>Total</b>';
					$data.= '</td>';
					$data.= '<td>';
					$data.= $total_net_amount;
					$data.= '</td>';
					$data.= '<td>';
					$data.= $total_tax;
					$data.= '</td>';
					$data.= '<td>';
					$data.= $total_accessories;
					$data.= '</td>';
					$data.= '<td>';
					$data.= $total_amount;
					$data.= '</td>';
					$data.= '<td>';
					$data.= $total_partner_commission;
					$data.= '</td>';

					$data.= '</tr>';
						$templateTags      =  array(
							'{{site_name}}'    => 'Proassur.com',
							'{{site_logo}}'    => base_url(),
							'{{site_url}}'     => base_url(),
							'{{team_name}}'    => 'Proassur',
							'{{year}}'         => date('Y'),
							'{{data}}'         =>  $data,
							'{{company_name}}' => getCompanyName($company_id),
							'{{branch_name}}'  => getBranchName($branch_id)
						);
						$message = email_compose($email_template,$templateTags);
						$to      = getUserMailId($policy_creater);
						$subject = "Quittance of the Month";
						send_smtp_mail($to,$subject,$message);
						// print_r($message);
				}
			}
			echo 1;	
		} else { 
			print_r("Please select Image first");
		}
	}



	// function added by Shiv
	function report() {
        
        $insurance_type_id = $this->uri->segment(4);
        $insured_id        = $this->uri->segment(5);
        $quittance_id      = $this->uri->segment(6);
        $this->load->library('ciqrcode');
        CheckAdminLoginSession();

            $data['img_url'] = "";
        
            $qr_image = rand() . '.png';
           // $params['data'] = base_url('user/downloadReport/'.$insurance_type_id.'/'. $insured_id);
            // $params['data'] = base_url("user/downloadReport/".$insurance_type_id.'/'. $insured_id);
            $params['level'] = 'H';
            $params['size'] = 8;
            $params['savename'] = FCPATH . "upload/qr_image/" . $qr_image;
            if ($this->ciqrcode->generate($params)) {
//                echo $qr_image;
                 // echo '<img src='.base_url("upload/qr_image/".$qr_image).'>';
                 $data['qrcode'] = $qr_image;
            }
            //die;
        
        // $data = '';
        $user_id = $this->session->userdata('user_id');
        
        $data['payment_data'] 	   = getPaymentDataForReport($insurance_type_id, $insured_id, $quittance_id);
        $data['insurance_type_id'] = $this->uri->segment(4);
        $data['insured_id'] 	   = $this->uri->segment(5);
        // print_r($data);
        $this->load->view('admin/include/head');
        $this->load->view('admin/quittance/report', $data);
        $this->load->view('admin/include/foot');
    }

    public function downloadReport(){
		$this->load->library('ciqrcode');
		$data['img_url'] = "";
        
        $qr_image = rand() . '.png';
        $params['data'] = base_url("admin/quittance/downloadReport/".$insurance_type_id.'/'. $insured_id);
        $params['level'] = 'H';
        $params['size'] = 8;
        $params['savename'] = FCPATH . "upload/qr_image/" . $qr_image;
        if ($this->ciqrcode->generate($params)) {
			//  echo $qr_image;
            // echo '<img src='.base_url("upload/qr_image/".$qr_image).'>';
            $data['qrcode'] = $qr_image;
        }
        //die;
        
        // $data = '';
        $user_id 				   = $this->session->userdata('user_id');
        $insurance_type_id 		   = $this->uri->segment(4);
        $insured_id 			   = $this->uri->segment(5);
        $quittance_id              = $this->uri->segment(6);
        $data['payment_data'] 	   = getPaymentDataForReport($insurance_type_id, $insured_id, $quittance_id);
        $policy_number = $data['payment_data']['payment_details']['Policy Number'];
        $selected_company = $data['payment_data']['data_final']['Selected Company'];
        $data['insurance_type_id'] = $this->uri->segment(4);
        $data['insured_id'] 	   = $this->uri->segment(5);
        $data['quittance_id']      = $this->uri->segment(6);
        $html 					   = $this->load->view('admin/quittance/report', $data,true); 
        
        $data = [];        
        // $pdfFilePath = date('dmYhis').".pdf";
        $pdfFilePath = $policy_number." + ".$selected_company.".pdf";
        $this->load->library('m_pdf');
        //$this->m_pdf->pdf->SetHeader('Proassur is the one-stop destnition of all your insurance needs');
        $this->m_pdf->pdf->SetHeader("Société de courtage d'assurances - toutes branches - www.assurancesenegal.com S.A. au capital de F CFA 10.000.000 - Agrément du Ministère des Finances n°06062/MEF/DA POINT E, avenue Birago Diop X Mosquée - DAKAR - Tél.: 33 825 50 50 - proassur@orange.sn");
        $this->m_pdf->pdf->setFooter('{DATE j-m-Y} Page: {PAGENO}');
        $this->m_pdf->pdf->WriteHTML($html);
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");

    }


    public function slips() {
    	CheckAdminLoginSession();
		$per_page            = 10;
        if($this->uri->segment(4)){
        	$page            = ($this->uri->segment(4)) ;
        }
        else {
        	$page            = 1;
        }

        $start                   = ($page-1)*$per_page;
        $limit                   = $per_page;
        
        $totalCount              = $this->admin_model->getSlipDataCount();
		$data['dataCollection']  = $this->admin_model->getSlipData($limit,$start);
        $totalResult             = count($data['dataCollection']);
		$data["pagination"]      = Jpagination($totalCount,$limit,$start);
		$url                     = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL             = parse_url($url);
		$data["current_link"]    = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
    	$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/quittance/slips',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
    }


    // function to download the file in quittance folder
    public function download_file() {
        if (!empty($_GET['file'])) {
            $fileName = basename($_GET['file']);
            $filePath = 'upload/quittance/' . $fileName;
            if (!empty($fileName) && file_exists($filePath)) {
                // Define headers
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$fileName");
                header("Content-Type: application/zip");
                header("Content-Transfer-Encoding: binary");

                // Read the file
                readfile($filePath);
                exit;
            } else {
                echo 'The file does not exist.';
            }
        }
    }

    public function view_slip() {
    	CheckAdminLoginSession();
    	if(!empty($this->input->get('slip_name'))) {
	    	$slip_name 				= $this->input->get('slip_name');
	        $data['policy_numbers'] = getPolicyNumbersForSlip($slip_name);
	        $data['slip_details'] 	= getSlipDetailByName($slip_name);
	        foreach ($data['policy_numbers'] as $key => $value) {
	            $data['policy_data'][$key] = $this->admin_model->getQuittanceDataForSlip($value);   
	        }
	        $data['slip_name'] 		= $slip_name;
	        // print_r($data['policy_numbers']);
		    $this->load->view('admin/quittance/slip_report', $data); 
    	}
    }

    public function downloadSlipReport() {
        if(!empty($this->input->get('slip_name'))) {
        	$slip_name 				= $this->input->get('slip_name');
        	$data['policy_numbers'] = getPolicyNumbersForSlip($slip_name);
            $data['slip_details'] 	= getSlipDetailByName($slip_name);
            foreach ($data['policy_numbers'] as $key => $value) {
                $data['policy_data'][$key] = $this->admin_model->getQuittanceDataForSlip($value);   
            }
            $data['slip_name'] 		= $slip_name;
            $html 					= $this->load->view('admin/quittance/slip_report', $data,true); 
	        $data = [];        
	        
	        $pdfFilePath = date('dmYhis').".pdf";
	        $this->load->library('m_pdf');
	        $this->m_pdf->pdf->SetHeader('Proassur is the one-stop destnition of all your insurance needs');
	        $this->m_pdf->pdf->setFooter('{DATE j-m-Y} Page: {PAGENO}');
	        $this->m_pdf->pdf->WriteHTML($html);
	        //download it.
	        $this->m_pdf->pdf->Output($pdfFilePath, "I");
        }
    }

    // function added by Shiv to view the quittances report (paid/unpaid/arrears types of quittances)
    public function preview_quittances() {
    	$data['result'] = $this->admin_model->getDataCollection($this->quittance,$limit = '',$start = '');
    	foreach ($data['result'] as $key => $value) {
    		//$res[$value->policy_number] = $value->policy_number;
			$res[$value->id] = $value->id;  
    	}
    	
    	foreach ($res as $key => $value) {
            $data['policy_data'][$key] = $this->admin_model->getQuittanceDataForSlip($value);   
        }
	$this->load->view('admin/quittance/preview_quittances', $data); 
    }


    // function added by Shiv to get the Data of Policy by Policy Number
   	public function getPolicyDataByPolicyNumber() {
   		$policy_number = $this->input->post('policy_number');
   		$payment_id    = checkPolicyNumberExists($policy_number);
		$payment_data  = $this->admin_model->getDataCollectionByID('tbl_payment',$payment_id);
		$record 	   = getFinalizedInsuranceDetails($payment_data->insured_id,$payment_data->insurance_type_id);
		if(!empty($payment_data)) {
			if( ($payment_data->insurance_type_id == 2) || ($payment_data->insurance_type_id == 3) ) {
				$branch_id  = $record['branch_id'];
				$risque_id  = getRisqueIdForHealth($record['risque_id']);
				$start_date = $record['policy_start_date'];
				$end_date   = $record['policy_end_date'];
			} else {
				$branch_id  = $record['branch_id'];
				$risque_id  = $record['risque_id'];
				$start_date = $record['policy_start_date'];
				$end_date   = $record['policy_end_date'];
			}
			$data = print json_encode(array(
				'company_id' => $payment_data->company_id,
				'branch_id'  => $branch_id,
				'risque_id'  => $risque_id,
				'user_id'    => $payment_data->user_id,
				'start_date' => date('m/d/Y',strtotime($start_date)),
				'end_date'   => date('m/d/Y',strtotime($end_date))
			));
			return $data;
		} else {
			return FALSE;
		}
   	}

   	// function added by Shiv to delete a slip
   	public function delete_slip($id) {
   		CheckAdminLoginSession();
   		$id 	   = $this->uri->segment(4);
   		$slip_data = $this->admin_model->dataDelete('tbl_slip_data',$id);
   		$this->session->set_flashdata('message','Your slip has been deleted successfully');
        redirect('admin/quittance/slips','refresh');
   	}

}
