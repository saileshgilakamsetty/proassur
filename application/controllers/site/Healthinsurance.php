<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Healthinsurance extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
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

    public $health_insurance = 'tbl_health_insurance';
    public $health_insurance_details = 'tbl_health_insurance_details';
    public $health_insurance_person_details = 'tbl_health_insurance_person_details';
    public $health_insurance_quote = 'tbl_health_insurance_quote';
    public $health_insurance_finalize_company = 'tbl_health_insurance_finalize_company';

// function added by Shiv to submit the basic info
    public function basic_info() {
         
        $post_data = $this->input->post();

        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('health_insurance_type_id', 'Insurance Type', 'required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $data = array(
                    //'user_id' 				   => $this->session->userdata('user_id'),
                    'user_id' => $this->input->post('user_id'),
                    'health_insurance_type_id' => $this->input->post('health_insurance_type_id')
                );
                $id = $this->front_model->setInsertData($this->health_insurance_details, $data);
                if ($id > 0) {
                    redirect('health-insurance/health-insurance-details/' . $id, 'refresh');
                }
            }
        }
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_aftr_login');
        $this->load->view('front/health_insurance/basic_info');
        $this->load->view('front/include/footer');
        $this->load->view('front/include/foo');
    }

    // function to add the basic info by Shiv
    /* function basic_info1() {
      if (!$this->session->userdata('user_id')) {
      echo 0;
      }
      else {
      echo $this->session->userdata('user_id');
      }
      } */

    function basic_info1() {
        if (!$this->session->userdata('user_id')) {
            echo 0;
        } else {
            $loggedin_user_role = getUserRoleIdByUserId($this->session->userdata('user_id'));
            if ($loggedin_user_role == 3) { // Partner
                echo 1;
            } else {
                echo $this->session->userdata('user_id');
            }
        }
    }

// function added by Shiv to get the health insurance details as per the selected option (individual/family)
    public function health_insurance_details() {
        CheckLoginSession();
        $health_insurance_id = $this->uri->segment(3);
        $health_insurance_type_id = getHealthInsuranceTypeId($health_insurance_id);
        if ($health_insurance_type_id == 2) {
            redirect('health-insurance/health-insurance-individual-details/' . $health_insurance_id);
        } else if ($health_insurance_type_id == 1) {
            redirect('health-insurance/health-insurance-family-details/' . $health_insurance_id);
        }
    }

// function added by Shiv to get the individual health insurance details
    public function health_insurance_individual_details() {
        CheckLoginSession();
        $data['health_insurance_id'] = $this->uri->segment(3);
        $health_insurance_id = $data['health_insurance_id'];
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('age_person', 'Age Of Person', 'required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'age_person' => date("Y-m-d H:i:s", strtotime($this->input->post('age_person'))),
                    'age' => date("Y-m-d H:i:s") - date("Y-m-d H:i:s", strtotime($this->input->post('age_person')))
                );
                $update_id = $this->front_model->setUpdateData($this->health_insurance_details, $data, $health_insurance_id);
                if ($update_id) {
                    redirect('health-insurance/health-insurance-dates/' . $update_id);
                }
            }
        }
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_aftr_login');
        $this->load->view('front/health_insurance/health_insurance_individual_details');
        $this->load->view('front/include/footer');
        $this->load->view('front/include/foo');
    }

// function added by Shiv to get the family health insurance details
    public function health_insurance_family_details() {
        CheckLoginSession();
        $data['health_insurance_id'] = $this->uri->segment(3);
        $health_insurance_id = $data['health_insurance_id'];
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('name_of_chief', 'Name', 'required');
            $this->form_validation->set_rules('age_of_chief', 'Age Of Person', 'required');
            $this->form_validation->set_rules('persons_insured', 'No Of Persons To Be Insured', 'required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $data = array(
                    'name_of_chief' => $this->input->post('name_of_chief'),
                    'age_of_chief' => date("Y-m-d H:i:s", strtotime($this->input->post('age_of_chief'))),
                    'age' => date("Y-m-d H:i:s") - date("Y-m-d H:i:s", strtotime($this->input->post('age_of_chief'))),
                    'persons_insured' => $this->input->post('persons_insured')
                );
                $update_id = $this->front_model->setUpdateData($this->health_insurance_details, $data, $health_insurance_id);
                if ($update_id) {
                    redirect('health-insurance/health-insurance-persons-insured-details/' . $update_id);
                }
            }
        }
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_aftr_login');
        $this->load->view('front/health_insurance/health_insurance_family_details');
        $this->load->view('front/include/footer');
        $this->load->view('front/include/foo');
    }

    public function health_insurance_persons_insured_details() {
        CheckLoginSession();
        $data['health_insurance_id'] = $this->uri->segment(3);
        $health_insurance_id = $data['health_insurance_id'];
        $data['persons_insured'] = getNumberOfPersonsInsuredByHealthInsuranceId($health_insurance_id);
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            for ($i = 1; $i <= $data['persons_insured']; $i++) {
                $this->form_validation->set_rules('full_name_' . $i, 'Full Name', 'required');
                $this->form_validation->set_rules('age_of_each_person_' . $i, 'Age of Person', 'required');
            }

            if ($this->form_validation->run() == FALSE) {
                
            } else {
                for ($j = 1; $j <= $data['persons_insured']; $j++) {
                    $person_details = array(
                        'persons_insured_id' => $health_insurance_id,
                        'full_name' => $post_data['full_name_' . $j],
                        'age_of_each_person' => date("Y-m-d H:i:s", strtotime($post_data['age_of_each_person_' . $j])),
                        'age' => date("Y-m-d H:i:s") - date("Y-m-d H:i:s", strtotime($post_data['age_of_each_person_' . $j]))
                    );
                    $this->front_model->setInsertData($this->health_insurance_person_details, $person_details);
                }
                redirect('health-insurance/health-insurance-dates/' . $health_insurance_id);
            }
        }
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_aftr_login');
        $this->load->view('front/health_insurance/health_insurance_persons_insured_details', $data);
        $this->load->view('front/include/footer');
        $this->load->view('front/include/foo');
    }

    public function health_insurance_dates() {
        CheckLoginSession();
        $data['health_insurance_id'] = $this->uri->segment(3);
        $health_insurance_id = $data['health_insurance_id'];
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('health_insurance_start_date', 'Start Date', 'required');
            $this->form_validation->set_rules('health_insurance_end_date', 'End Date', 'required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $data = array(
                    'start_date' => date("Y-m-d H:i:s", strtotime($this->input->post('health_insurance_start_date'))),
                    'end_date' => date("Y-m-d H:i:s", strtotime($this->input->post('health_insurance_end_date')))
                );
                $update_id = $this->front_model->setUpdateData($this->health_insurance_details, $data, $health_insurance_id);
                if ($update_id) {
                    redirect('health-insurance/health-insurance-other-details/' . $update_id);
                }
            }
        }
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_aftr_login');
        $this->load->view('front/health_insurance/health_insurance_dates');
        $this->load->view('front/include/footer');
        $this->load->view('front/include/foo');
    }

    public function health_insurance_other_details() {
        CheckLoginSession();
        $data['health_insurance_id'] = $this->uri->segment(3);
        $health_insurance_id = $data['health_insurance_id'];
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('policy_coverage_area_id', 'Policy Coverage Area', 'required');
            $this->form_validation->set_rules('claim_reimbursement_rate', 'Claim Reimbursement Rate', 'required');
            $this->form_validation->set_rules('amount_to_pay', 'Amount To Pay', 'required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $data = array(
                    'policy_coverage_area_id' => $this->input->post('policy_coverage_area_id'),
                    'claim_reimbursement_rate' => $this->input->post('claim_reimbursement_rate'),
                    'amount_to_pay' => $this->input->post('amount_to_pay')
                );
                $update_id = $this->front_model->setUpdateData($this->health_insurance_details, $data, $health_insurance_id);
                if ($update_id) {
                    redirect('health-insurance/get-estimation/' . $update_id);
                }
            }
        }
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_aftr_login');
        $this->load->view('front/health_insurance/health_insurance_other_details');
        $this->load->view('front/include/footer');
        $this->load->view('front/include/foo');
    }

    // function added by Shiv to get Rate and Amount by Policy Coverage Area
    public function getDataByPolicyCoveargeAreaId() {
        $data = '';
        $data = 'class="control-group" id="claim_reimbursement_rate" ';
        $rate = form_dropdown('claim_reimbursement_rate', getRateByPolicyCoveargeAreaId($this->input->post('policy_coverage_area_id')), set_value('claim_reimbursement_rate'), $data);
        $amount = getAmountByPolicyCoveargeAreaId($this->input->post('policy_coverage_area_id'));
        $result = print json_encode(array(
            'rate' => $rate,
            'amount' => $amount
        ));
        return $result;
    }

// function added by Shiv to get the estimation price for the companies
    public function get_estimation() {
        CheckLoginSession();
        $data['health_insurance_id'] = $this->uri->segment(3);
        $health_insurance_examination_list_array = getHealthInsuranceExaminationList();
        $company_array = getCompanyIds();

        $data['qwerty'] = getHealthInsuranceCompanyComparision($health_insurance_examination_list_array, $company_array, $data['health_insurance_id']);
        $data['policy_coverage_area_id'] = getPolicyCoveargeAreaIdByHealthInsuranceId($data['health_insurance_id']);
        $data['claim_reimbursement_rate_details'] = getClaimReimbursementRateIdByPolicyCoveargeAreaId($data['policy_coverage_area_id']);
        $data['claim_reimbursement_rate_array'] = getClaimReimbursementRates($health_insurance_examination_list_array, $data['claim_reimbursement_rate_details'], $company_array);
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_aftr_login');
        $this->load->view('front/health_insurance/get_health_insurance_estimation', $data);
        $this->load->view('front/include/footer');
        $this->load->view('front/include/foo');
    }

// function added by Shiv to get the details of the selected company to finalize 
    public function finalize_company() {
        CheckLoginSession();
        $company_id = $this->input->post('company_id');
        $health_insurance_id = $this->input->post('health_insurance_id');
        $record = $this->front_model->getDataOfHealthInsuranceToInsertForSelectedCompany($company_id);
        $user_id = getUserIdFromInsuranceDetails($health_insurance_id, $this->health_insurance_details);

        foreach ($record as $key => $value) {
            $data = array(
                'health_insurance_id' => $health_insurance_id,
                'name' => $value->name,
                'amount' => $value->amount,
                'company_id' => $value->company_id,
                'company_name' => getCompanyName($value->company_id),
                'branch_id' => $value->branch_id,
                'branch_name' => getBranchName($value->branch_id),
                'risque_name' => getRisqueName($value->risque_id),
                'description' => $value->description
            );
            $this->front_model->setInsertData($this->health_insurance_finalize_company, $data);
        }

        $payment_data = array(
            // 'policy_number' => getPolicyId(),
            'policy_number'     => getAutogeneratedPolicyNumber($company_id),
            'insurance_type_id' => 2,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'insured_id' => $health_insurance_id,
            'payment_status' => 0,
            'payment_method' => 5, // no payment
            'policy_created_by' => getUserRoleIdByUserId($this->session->userdata('user_id')),
            'policy_created_for' => getUserRoleIdByUserId($user_id),
            'policy_creater' => $this->session->userdata('user_id'),
        );
        $this->front_model->setInsertData('tbl_payment', $payment_data);
        echo 1;
        //return true;
    }

// function added by Shiv to view the details of finalize company
    public function view_finalize_detail() {
        CheckLoginSession();
        $health_insurance_id = $this->uri->segment(3);
        $user_id = getUserIdFromInsuranceDetails($health_insurance_id, $this->health_insurance_details);
        $data['branch_id'] = getBranchIdByHealthInsuranceId($health_insurance_id);
        $data['company_id'] = getCompanyIdByHealthInsuranceId($health_insurance_id);
        $data['health_insurance_id'] = $health_insurance_id;

        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $data_type = array(
                'person_amount' => $this->input->post('person_amount'),
                'estimation_amount' => $this->input->post('estimation_amount'),
                'net_premium' => $this->input->post('net_premium'),
                'accessories' => $this->input->post('accessories'),
                'tax' => $this->input->post('tax'),
                'total_premium' => $this->input->post('total_premium')
            );

            foreach ($data_type as $key => $value) {
                $record = array(
                    'health_insurance_id' => $health_insurance_id,
                    'name'                => $key,
                    'amount'              => $value,
                    'company_id'          => $data['company_id'],
                    'company_name'        => getCompanyName($data['company_id']),
                    'branch_id'           => $data['branch_id'],
                    'branch_name'         => getBranchName($data['branch_id'])
                );
                $this->front_model->setInsertData($this->health_insurance_finalize_company, $record);
            }
            $insurance_type_id = $this->input->post('insurance_type_id');
            /*$data = array(
                'policy_number' => getPolicyId(),
                'user_id' => $user_id,
                'insured_id' => $health_insurance_id,
                'insurance_type_id' => $insurance_type_id,
                'amount' => $this->input->post('total_premium'),
                'accessories_id' => $this->input->post('accessories_id')
            );
            $this->session->set_userdata('user_payment_data', $data);
            redirect('payment/proceed-to-pay/' . $health_insurance_id, 'refresh');*/
            $payment_id         = getPaymentIdByInsurerIdInsuranceType($health_insurance_id,$insurance_type_id);
            $data_payment = array(
                'amount'        => $this->input->post('total_premium'),
                'modified_date' => date("Y-m-d H:i:s")
            );
            $updated_payment_id = $this->front_model->setUpdateData('tbl_payment', $data_payment, $payment_id);
            redirect('questionaries/'.$updated_payment_id);
            //redirect('payment/proceed-to-pay/'.$updated_payment_id);
        }

        $data['estimation_data'] = $this->front_model->getFinalHealthInsuranceDetail($this->health_insurance_finalize_company, $health_insurance_id);
        $data['days_to_health_insurance'] = getNumberOfDaysToHealthInsurance($health_insurance_id);
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_aftr_login');
        $this->load->view('front/health_insurance/view_finalize_detail', $data);
        $this->load->view('front/include/footer');
        $this->load->view('front/include/foo');
    }

}
