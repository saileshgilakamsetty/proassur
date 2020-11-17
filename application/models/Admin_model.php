<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

// function to get the data collection record by id
    public function getMobileNumber($table, $id = "", $num) {
        $this->db->where('id!=', $id);
        $this->db->where('mobile', $num);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->row();
            return $result->mobile;
        } else {
            return '';
        }
    }

    public function setUpdateSetting($table, $data, $id) {
        $array = array('name' => $id);
        $this->db->where($array);
        $this->db->update($table, $data);
        return $id;
    }

    public function getSettingsDataCollection($table) {
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();

            foreach ($result as $datalist) {
                $smtp[trim($datalist->name)] = $datalist->value;
            }
            return $smtp;
        } else {
            return array();
        }
    }

    public function resetPassword($table, $data, $email) {
        $array = array('email' => $email);
        $this->db->where($array);
        $this->db->update($table, $data);
        return true;
    }

    public function checkAdminEmailExists($email) {
        $this->db->where('email', $email);
        $this->db->where('role', 1);
        $query = $this->db->get('tbl_users');
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->row('email');
            return $result;
        } else {
            return array();
        }
    }

    public function setInsertData($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function setMultipleImages($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

// function to get the company id providing the insurance
    public function getCompanyProvidingInsurance($table) {
        $this->db->select('company_id');
        $this->db->group_by('company_id');
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

    // function to get the final Vehicle Insurance Detail
    public function getFinalVehicleInsuranceDetail($table, $vehicle_detail_id) {
        $this->db->where('vehicle_detail_id', $vehicle_detail_id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

    // function to get the final house Insurance Detail
    public function getFinalHouseInsuranceDetail($table, $house_detail_id) {
        $this->db->where('house_detail_id', $house_detail_id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

// function added by Shiv to get the final Credit Insurance Detail
    public function getFinalCreditInsuranceDetail($table, $credit_detail_id) {
        $this->db->where('credit_detail_id', $credit_detail_id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

// function added by Shiv to get the final Proffesional Multi Risk Insurance Detail
    public function getFinalProffesionalMultiRiskInsuranceDetail($table, $proffesional_multirisk_quote_id) {
        $this->db->where('proffesional_multirisk_quote_id', $proffesional_multirisk_quote_id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

// function to get the final Travel Insurance Detail
    public function getFinalTravelInsuranceDetail($table, $travel_id) {
        $this->db->where('travel_id', $travel_id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

// function added by Shiv to get the final Individual Accident Insurance Detail
    public function getFinalIndividualAccidentInsuranceDetail($table, $id) {
        $this->db->where('individual_insurance_option_details_id', $id);
        $query = $this->db->get($table);

        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

// function to get the final Health Insurance Detail
    public function getFinalHealthInsuranceDetail($table, $health_insurance_id) {
        $this->db->where('health_insurance_id', $health_insurance_id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

    // function to get the detail by Designation Id
    public function getdetailsByDesignationId($make_id, $designation_id) {
        $this->db->where('make_id', $make_id);
        $this->db->where('designation_id', $designation_id);
        $query = $this->db->get('tbl_vehicle');
        $count = $query->num_rows();
        if ($count > 0) {
            $result = json_encode($query->row());
            return $result;
        } else {
            return array();
        }
    }

    public function setUpdateData($table, $data, $id) {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
        return $id;
    }

    public function setUpdateQuittanceData($table, $data, $id) {
        $this->db->where('policy_number', $id);
        $this->db->update($table, $data);
        return $id;
    }

    // function added by Shiv to update partner data
    public function setUpdatePartnerData($table, $data, $id) {
        $this->db->where('user_id', $id);
        $this->db->update($table, $data);
        return $id;
    }

    public function dataDelete($table, $id = "") {
        $array = array('id' => $id);
        $this->db->where($array);
        $this->db->delete($table);
        return $id;
    }

// function to delete data by branch Id
    public function dataDeleteByBranchId($table, $id = "") {
        $array = array('branch_id' => $id);
        $this->db->where($array);
        $this->db->delete($table);
        return $id;
    }

// function to delete data by company_question_id
    public function dataDeleteByCompanyQuestionId($table, $id = "") {
        $array = array('company_question_id' => $id);
        $this->db->where($array);
        $this->db->delete($table);
        return $id;
    }

// function to delete data by claim reimbursement Id
    public function dataDeleteByClaimReimbursementId($table, $id = "") {
        $array = array('claim_reimbursement_rate_id' => $id);
        $this->db->where($array);
        $this->db->delete($table);
        return $id;
    }

// function to delete data by Activity Id for Indivudual Accident Insurance
    public function dataDeleteByActivityId($table, $id = "") {
        $array = array('individual_accident_activity_id' => $id);
        $this->db->where($array);
        $this->db->delete($table);
        return $id;
    }

// function to delete data by company Id
    public function dataDeleteByCompanyId($table, $id = "") {
        $array = array('company_id' => $id);
        $this->db->where($array);
        $this->db->delete($table);
        return $id;
    }

    // function to delete data by company Id
    public function dataDeleteByQuestionId($table, $id = "") {
        $array = array('question_id' => $id);
        $this->db->where($array);
        $this->db->delete($table);
        return $id;
    }

    public function getDataCollectionByID($table, $id = "") {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->row();
            return $result;
        } else {
            return array();
        }
    }

    public function getDataCollectionArrayByID($table, $id = "") {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->row_array();
            return $result;
        } else {
            return array();
        }
    }

    public function getCompanyQuestionDataCollectionByQuestionID($table, $id = "") {
        $this->db->select('company_id');
        $this->db->group_by('company_id');
        $this->db->where('question_id', $id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $data = [];
            $i = 0;
            $result = $query->result();
            foreach ($result as $value) {
                $result_array = array();
                $this->db->select('insurance_type_id');
                $this->db->where('company_id', $value->company_id);
                $query = $this->db->get($table);
                $count = $query->num_rows();
                if ($count > 0) {
                    $type_id = $query->result();
                    $data[$i]['company_id'] = $value->company_id;
                    foreach ($type_id as $id) {
                        $result_array[] = $id->insurance_type_id;
                    }
                    $data[$i]['type_id'] = implode(',', $result_array);
                }
                $i++;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getCompanyIdQuestionID($table, $id = "") {
        $this->db->select('company_id');
        $this->db->group_by('company_id');
        $this->db->where('question_id', $id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $data = [];
            $i = 0;
            $result = $query->result();
            foreach ($result as $value) {
                # code...
                $data[] = $value->company_id;
            }
            // implode(',', $data)
            return implode(',', $data);
        } else {
            return array();
        }
    }

    public function getRecentDataUserCollection($table, $limit = "") {
        // $this->db->where('id',$id);
        $this->db->where('role!=1');
        $this->db->limit($limit);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

    public function getApiDataCollectionByID($table, $id = "") {
        $this->db->where('status=1');
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->row();
            return $result;
        } else {
            return array();
        }
    }

    public function getDataCollectionOfBranchCompany($table, $id = "") {
        $this->db->where('branch_id', $id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            foreach ($result as $key => $value) {
                $data[] = $value->company_id;
            }
            return implode(',', $data);
        } else {
            return array();
        }
    }

//
    public function getDataCollectionOfCompanyQuestion($table, $id = "") {
        $this->db->where('company_question_id', $id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            foreach ($result as $key => $value) {
                $data[] = $value->question_id;
            }
            return implode(',', $data);
        } else {
            return array();
        }
    }

    public function getDataCollectionOfCompanyQuestionArray($table, $id = "") {
        $this->db->where('company_question_id', $id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            foreach ($result as $key => $value) {
                $data[] = $value->question_id;
            }
            return $data;
        } else {
            return array();
        }
    }

// function added by Shiv to get the multiple selected company in Claim Reimbursement Rate Edit
    public function getDataCollectionOfClaimReimbursementCompany($table, $id = "") {
        $this->db->where('claim_reimbursement_rate_id', $id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            foreach ($result as $key => $value) {
                $data[] = $value->company_id;
            }
            return implode(',', $data);
        } else {
            return array();
        }
    }

// function added by Shiv to get the multiple selected company in INdividual Accident Activity Management Edit
    public function getDataCollectionOfIndividualAccidentActivityCompany($table, $dataCollection = "") {
        $this->db->where('multiple_companies_activity_id', $dataCollection->id);
        $this->db->where('individual_accident_activity_id', $dataCollection->activity_id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            foreach ($result as $key => $value) {
                $data[] = $value->company_id;
            }
            return implode(',', $data);
        } else {
            return array();
        }
    }

    public function getDataCollectionCompanyInsurance($table, $id = "") {
        $this->db->where('company_id', $id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            foreach ($result as $key => $value) {
                $data[] = $value->insurance_type_id;
            }
            return implode(',', $data);
        } else {
            return array();
        }
    }

    public function dataRatingCollection($table, $id = "") {

        $this->db->select('*');
        $this->db->where('website_id', $id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->row();
            return $result;
        } else {
            return array();
        }
    }

    public function getImagesByID($table, $id = "") {

        $this->db->select('image,id');
        $this->db->where('website_id', $id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

    public function totaluserRecord($table) {
        if (!empty($_GET['first_name'])) {
            $this->db->where('first_name', $_GET['first_name']);
        }
        if (!empty($_GET['last_name'])) {
            $this->db->where('last_name', $_GET['last_name']);
        }
        if (!empty($_GET['address'])) {
            $this->db->where('address', $_GET['address']);
        }
        if (!empty($_GET['role'])) {
            $this->db->where('role', $_GET['role']);
        }
    
        
        if($admin_role == 5)
        {
            $this->db->where_not_in("role",['1','5']);
        }
        else{
            $this->db->where('role!=1');
        }
        
        // $this->db->where('role!=0');
        $query = $this->db->get($table);
            $count = $query->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }
    public function totalRecord($table) {

        if(!empty($_GET['mobile'])) {
            $user_id = getUserIdFromMobile($_GET['mobile']);
            $this->db->where('user_id',$user_id);
        }


        if (!empty($_GET['language_id'])) {
            $this->db->where('language_id', $_GET['language_id']);
        }
        if (!empty($_GET['companyname_id'])) {
            $this->db->where('company_id', $_GET['companyname_id']);
        }
        if (!empty($_GET['company_id'])) {
            $this->db->where('company_id', $_GET['company_id']);
        }
        if(!empty($_GET['branch_id'])) {
            $this->db->where('branch_id',$_GET['branch_id']);
        }
        if (!empty($_GET['risque_id'])) {
            $this->db->where('risque_id', $_GET['risque_id']);
        }
        if (!empty($_GET['risque_name_id'])) {
            $this->db->where('id', $_GET['risque_name_id']);
        }
        if(!empty($_GET['warranty_name_id'])) {
            $this->db->where('id', $_GET['warranty_name_id']);
        }
        if(!empty($_GET['franchise_name_id'])) {
            $this->db->where('id', $_GET['franchise_name_id']);
        }
        if(!empty($_GET['healthcareprovider_name_id'])) {
            $this->db->where('id', $_GET['healthcareprovider_name_id']);
        }
        if(!empty($_GET['region_id'])) {
            $this->db->where('region_id',$_GET['region_id']);
        }
        if(!empty($_GET['commune_id'])) {
            $this->db->where('id', $_GET['commune_id']);
        }
        if(!empty($_GET['activity_name_id'])) {
            $this->db->where('id', $_GET['activity_name_id']);
        }
        if(!empty($_GET['min_days'])) {
            $this->db->where('min_days', $_GET['min_days']);
        }
        if(!empty($_GET['max_days'])) {
            $this->db->where('max_days', $_GET['max_days']);
        }
        if(!empty($_GET['vehicle_make_id'])) {
            $this->db->where('id', $_GET['vehicle_make_id']);
        }
        if(!empty($_GET['vehicle_model_id'])) {
            $this->db->where('id', $_GET['vehicle_model_id']);
        }
        if(!empty($_GET['vehicle_designation_id'])) {
            $this->db->where('id', $_GET['vehicle_designation_id']);
        }
        if(!empty($_GET['insurer_quality_id'])) {
            $this->db->where('id', $_GET['insurer_quality_id']);
        }
        if(!empty($_GET['fiscal_power'])) {
            $this->db->where('fiscal_power', $_GET['fiscal_power']);
        }
         if(!empty($_GET['policy_start_date'])) {
            $this->db->where('policy_creation_date >=',date('Y-m-d H:i:s',strtotime($_GET['policy_start_date'])));
        }
        if(!empty($_GET['policy_end_date'])) {
            $this->db->where('policy_creation_date <=',date('Y-m-d H:i:s',strtotime($_GET['policy_end_date'])));
        }
        if(!empty($_GET['quittance_status'])) {
            if($_GET['quittance_status'] == 3) {
                $this->db->where('status',0);
                $this->db->where('policy_end_date <',date('Y-m-d H:i:s'));
            } else {
                $this->db->where('status', $_GET['quittance_status']);
            }
        }
        if(!empty($_GET['bonus_company_id'])) {
            $this->db->where('company_id', $_GET['bonus_company_id']);
        }
        if(!empty($_GET['bonus_branch_id'])) {
            $this->db->where('branch_id', $_GET['bonus_branch_id']);
        }

        if(!empty($_GET['quittance_policy_number'])) {
            $this->db->where('policy_number', $_GET['quittance_policy_number']);
        }

        if(!empty($_GET['quittance_user_id'])) {
            $this->db->where('user_id', $_GET['quittance_user_id']);
        }

        if(!empty($_GET['quittance_number'])) {
            $this->db->where('id', $_GET['quittance_number']);
        }

        if(!empty($_GET['user_mobile'])){
            $this->db->where('user_mobile',$_GET['user_mobile']);
        }

        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }

    // function added by Shiv to get the total records of quittance
    public function totalRecordOfQuittance($table) {    
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('tbl_payment','tbl_quittance.policy_number = tbl_payment.policy_number','left');
        if(!empty($_GET['policy_start_date'])) {
            $this->db->where('tbl_quittance.policy_start_date >=',date('Y-m-d H:i:s',strtotime($_GET['policy_start_date'])));
        }
        if(!empty($_GET['policy_end_date'])) {
            $this->db->where('tbl_quittance.policy_end_date <=',date('Y-m-d H:i:s',strtotime($_GET['policy_end_date'])));
        }
        $query = $this->db->get();
        $count = $query->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }


    // function added by Shiv to get the total records of slips
    public function totalRecordOfSlip($table) {    
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('tbl_payment','tbl_quittance.policy_number = tbl_payment.policy_number','left');
        if(!empty($_GET['policy_start_date'])) {
            $this->db->where('tbl_quittance.policy_start_date >=',date('Y-m-d H:i:s',strtotime($_GET['policy_start_date'])));
        }
        if(!empty($_GET['policy_end_date'])) {
            $this->db->where('tbl_quittance.policy_end_date <=',date('Y-m-d H:i:s',strtotime($_GET['policy_end_date'])));
        }
        $query = $this->db->get();
        $count = $query->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }


    public function totalRecordSearchContent($table, $search_content) {

        if (!empty($_GET['language_id'])) {
            $this->db->where('language_id', $_GET['language_id']);
        }
        $this->db->like('name', $search_content);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }

    public function totalPublicProfileRecord($table) {

        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }

    public function totalActiveRecord($table) {
        $this->db->where('status', 1);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }

    public function totalActiveUserRecord($table) {
        $this->db->where('status', 1);
        $this->db->where('role!=1');
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }

// function to get all data records
    public function getDataCollection($table, $limit = 10, $start = 0) {

        if(!empty($_GET['mobile'])) {
            $user_id = getUserIdFromMobile($_GET['mobile']);
            $this->db->where('user_id',$user_id);
        }

        if (!empty($limit)) {
            $this->db->limit($limit, $start);
        }
        if (!empty($_GET['language_id'])) {
            $this->db->where('language_id', $_GET['language_id']);
        }

        if (!empty($_GET['companyname_id'])) {
            $this->db->where('company_id', $_GET['companyname_id']);
        }
        if (!empty($_GET['company_id'])) {
            $this->db->where('company_id', $_GET['company_id']);
        }
        if(!empty($_GET['branch_id'])) {
            $this->db->where('branch_id',$_GET['branch_id']);
        }
        if (!empty($_GET['risque_name_id'])) {
            $this->db->where('id', $_GET['risque_name_id']);
        }
        if (!empty($_GET['risque_id'])) {
            $this->db->where('risque_id', $_GET['risque_id']);
        }
        if(!empty($_GET['warranty_name_id'])) {
            $this->db->where('id', $_GET['warranty_name_id']);
        }
        if(!empty($_GET['franchise_name_id'])) {
            $this->db->where('id', $_GET['franchise_name_id']);
        }
        if(!empty($_GET['healthcareprovider_name_id'])) {
            $this->db->where('id', $_GET['healthcareprovider_name_id']);
        }
        if(!empty($_GET['region_id'])) {
            $this->db->where('region_id',$_GET['region_id']);
        }
        if(!empty($_GET['commune_id'])) {
            $this->db->where('id', $_GET['commune_id']);
        }
        if(!empty($_GET['activity_name_id'])) {
            $this->db->where('id', $_GET['activity_name_id']);
        }
        if(!empty($_GET['min_days'])) {
            $this->db->where('min_days', $_GET['min_days']);
        }
        if(!empty($_GET['max_days'])) {
            $this->db->where('max_days', $_GET['max_days']);
        }
        if(!empty($_GET['vehicle_make_id'])) {
            $this->db->where('id', $_GET['vehicle_make_id']);
        }
        if(!empty($_GET['vehicle_model_id'])) {
            $this->db->where('id', $_GET['vehicle_model_id']);
        }
        if(!empty($_GET['vehicle_designation_id'])) {
            $this->db->where('id', $_GET['vehicle_designation_id']);
        }
        if(!empty($_GET['insurer_quality_id'])) {
            $this->db->where('id', $_GET['insurer_quality_id']);
        }
        if(!empty($_GET['fiscal_power'])) {
            $this->db->where('fiscal_power', $_GET['fiscal_power']);
        }
        if(!empty($_GET['policy_start_date'])) {
            $this->db->where('policy_creation_date >=',date('Y-m-d H:i:s',strtotime($_GET['policy_start_date'])));
        }
        if(!empty($_GET['policy_end_date'])) {
            $this->db->where('policy_creation_date <=',date('Y-m-d H:i:s',strtotime($_GET['policy_end_date'])));
        }
        if(!empty($_GET['quittance_status'])) {
            if($_GET['quittance_status'] == 3) {
                $this->db->where('status',0);
                $this->db->where('policy_end_date <',date('Y-m-d H:i:s'));
            } else {
                $this->db->where('status', $_GET['quittance_status']);
            }
        }
        if(!empty($_GET['bonus_company_id'])) {
            $this->db->where('company_id', $_GET['bonus_company_id']);
        }
        if(!empty($_GET['bonus_branch_id'])) {
            $this->db->where('branch_id', $_GET['bonus_branch_id']);
        }

        if(!empty($_GET['quittance_policy_number'])) {
            $this->db->where('policy_number', $_GET['quittance_policy_number']);
        }

        if(!empty($_GET['quittance_user_id'])) {
            $this->db->where('user_id', $_GET['quittance_user_id']);
        }

        if(!empty($_GET['quittance_number'])) {
            $this->db->where('id', $_GET['quittance_number']);
        }

        if(!empty($_GET['user_mobile'])){
            $this->db->where('user_mobile',$_GET['user_mobile']);
        }

        $this->db->order_by('id', 'desc');
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }



// function to get all data records
    public function getDataCollectionOfQuittance($table, $limit = 10, $start = 0) {

        if (!empty($limit)) {
            $this->db->limit($limit, $start);
        }
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('tbl_payment','tbl_quittance.policy_number = tbl_payment.policy_number','left');
        if(!empty($_GET['policy_start_date'])) {
            $this->db->where('tbl_quittance.policy_start_date >=',date('Y-m-d H:i:s',strtotime($_GET['policy_start_date'])));
        }
        if(!empty($_GET['policy_end_date'])) {
            $this->db->where('tbl_quittance.policy_end_date <=',date('Y-m-d H:i:s',strtotime($_GET['policy_end_date'])));
        }
        $this->db->order_by('tbl_quittance.id', 'desc');
        $query = $this->db->get();
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

// function to get all data records
    public function getFranchiseDataCollection($table, $limit = 10, $start = 0) {
        if (!empty($limit)) {
            $this->db->limit($limit, $start);
        }
        if (!empty($_GET['company_id'])) {
            $this->db->where('company_id', $_GET['company_id']);
        }
        if (!empty($_GET['branch_id'])) {
            $this->db->where('branch_id', $_GET['branch_id']);
        }
        if (!empty($_GET['risque_id'])) {
            $this->db->where('risque_id', $_GET['risque_id']);
        }
        if (!empty($_GET['warranty_id'])) {
            $this->db->where('warranty_id', $_GET['warranty_id']);
        }
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

// function to get all data records
    public function getWarrantyDataCollection($table, $limit = 10, $start = 0) {
        if (!empty($limit)) {
            $this->db->limit($limit, $start);
        }
        if (!empty($_GET['company_id'])) {
            $this->db->where('company_id', $_GET['company_id']);
        }
        if (!empty($_GET['branch_id'])) {
            $this->db->where('branch_id', $_GET['branch_id']);
        }
        if (!empty($_GET['risque_id'])) {
            $this->db->where('risque_id', $_GET['risque_id']);
        }
        if (!empty($_GET['warranty_id'])) {
            $this->db->where('warranty_id', $_GET['warranty_id']);
        }
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

// function to get the company quote amount based on the conditions.
    public function getCompanyQuote($data, $table) {
        $this->db->where('fiscal_power', $data['fiscal_power']);
        $this->db->where('fuel_type', $data['fuel_type']);
        $this->db->where('usage', $data['usage']);
        $this->db->where('trailer', $data['trailer']);
        $this->db->where('risque_id', $data['risque']);
        $this->db->where('seats', $data['seats']);
        $this->db->where('status', 1);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $i = 0;
            $result = $query->result();
            // echo $this->db->last_query(); die;
            foreach ($result as $value) {
                $result_data[$i]['id'] = $value->id;
                $result_data[$i]['company_id'] = $value->company_id;
                $result_data[$i]['amount'] = $value->amount;
                $i++;
            }
            return $result_data;
        } else {
            return array();
        }
    }

// function to get the collection data as per the language selected
    public function getDataCollectionSearchContent($table, $limit = 10, $start = 0, $search_content = "") {
        if (!empty($limit)) {
            $this->db->limit($limit, $start);
        }
        if (!empty($_GET['language_id'])) {
            $this->db->where('language_id', $_GET['language_id']);
        }
        $this->db->like('name', $search_content);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

// function to get the data by company id
    public function getDataCollectionByCompanyId($table, $limit = 10, $start = 0) {

        if (!empty($limit)) {
            $this->db->limit($limit, $start);
        }
        $this->db->order_by('id', 'desc');
        $this->db->group_by('question_id');
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

    // function to get user data 
    public function getDataUserCollection($table, $limit = 10, $start = 0, $role = 0) {

        $admin_role = $this->session->userdata("admin_role");
        if (!empty($limit)) {
            $this->db->limit($limit, $start);
        }
    
        if (!empty($_GET['first_name'])) {
            $this->db->where('first_name', $_GET['first_name']);
        }
        if (!empty($_GET['last_name'])) {
            $this->db->where('last_name', $_GET['last_name']);
        }
        if (!empty($_GET['address'])) {
            $this->db->where('address', $_GET['address']);
        }
        if (!empty($_GET['role'])) {
            $this->db->where('role', $_GET['role']);
        }
    
        
        if($admin_role == 5)
        {
            $this->db->where_not_in("role",['1','5']);
        }
        else{
            $this->db->where('role!=1');
        }
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

// function to delete image
    public function deleteImage($table, $id = "") {
        $array = array('id' => $id);
        $this->db->where($array);
        $this->db->delete($table);
        return $id;
    }

// function to resolve password
    public function resolve_password($data = NULL, $id) {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $results = $query->result();
        $current_password = $results[0]->password;
        return $current_password;
    }

// function to get language collection
    public function getLanguageCollection($table) {
        $this->db->where('status', 1);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

// function to check event is added or not, ie, at the time of insert 
    public function checkEventAddedForCompany($event_id, $company_id, $eventclaim) {
        $this->db->where('company_id', $company_id);
        $this->db->where('event_id', $event_id);
        $qwery = $this->db->get($eventclaim);
        $count = $qwery->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }

    // function to check Question is added or not
    public function checkQuestionAdded($company_id, $table, $string) {
        $this->db->where('id!=', $company_id);
        $this->db->where('question', $string);
        $qwery = $this->db->get($table);
        $count = $qwery->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }

    // function to check name is added or not
    public function checkNameAdded($warranty_id, $table, $string) {
        $this->db->where('id!=', $warranty_id);
        $this->db->where('name', $string);
        $qwery = $this->db->get($table);
        $count = $qwery->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }

    // function to check Question is added or not
    public function checkCompanyExists($company_id, $table, $string) {
        $this->db->where('id!=', $company_id);
        $this->db->where('name', $string);
        $qwery = $this->db->get($table);
        $count = $qwery->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }

    // function to check name is added or not
    public function checkNameExists($id, $table, $string) {
        $this->db->where('id!=', $id);
        $this->db->where('name', $string);
        $qwery = $this->db->get($table);
        $count = $qwery->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }

    // function to check Insurance is added or not
    public function checkinsuranceTypeAdded($company_id, $table, $string) {
        $this->db->where('id!=', $company_id);
        $this->db->where('name', $string);
        $qwery = $this->db->get($table);
        $count = $qwery->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }

// function to check event is added or not at the time of edit ie, other than this  
    public function checkEventAddedForCompanyThanthis($id, $event_id, $company_id, $eventclaim) {
        $this->db->where('id!=', $id);
        $this->db->where('company_id', $company_id);
        $this->db->where('company_id', $company_id);
        $this->db->where('event_id', $event_id);
        $qwery = $this->db->get($eventclaim);
        $count = $qwery->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }

// function to get the optional warranty
    public function getOptionalWarranties($company_id, $branch_id, $risque_id) {
        $this->db->where('company_id', $company_id);
        $this->db->where('branch_id', $branch_id);
        $this->db->where('risque_id', $risque_id);
        $query = $this->db->get('tbl_warranty');
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
        } else {
            $result = array();
        }
        return $result;
    }

// function to get the optional warranty
    public function getOptionalFranchices($company_id, $branch_id) {
        $this->db->where('company_id', $company_id);
        $this->db->where('branch_id', $branch_id);
        $query = $this->db->get('tbl_franchise');
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
        } else {
            $result = array();
        }
        return $result;
    }

// function to get the optional warranty
    public function getInsuredTravelOptions($company_id) {
        $this->db->where('company_id', $company_id);
        $query = $this->db->get('tbl_vehicle_trans_person_insurance');
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
        } else {
            $result = array();
        }
        return $result;
    }

    public function checkYearForCompanyBranch($year, $company, $branch) {
        $this->db->where('year', $year);
        $this->db->where('company_id', $company);
        $this->db->where('branch_id', $branch);
        $query = $this->db->get('tbl_bonus');
        $count = $query->num_rows();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getPremiumIdByDays($days, $company_id) {

        $this->db->where('min_days <=', $days);
        $this->db->where('max_days >=', $days);
        $this->db->where('company_id', $company_id);
        $this->db->where('status', 1);
        $query = $this->db->get('tbl_policy_duration');
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->row()->id;
        } else {
            $result = '';
        }
        return $result;
    }

    public function getBounusImage($selected_bonus_id) {

        $this->db->where('id', $selected_bonus_id);
        $query = $this->db->get('tbl_selected_bonus');
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->row()->document_image;
        } else {
            $result = '';
        }
        return $result;
    }

// logic to find the warranties id
    public function getWarrantiesSelected($vehicle_detail_id) {
        $this->db->where('vehicle_detail_id', $vehicle_detail_id);
        $query = $this->db->get('tbl_selected_optional_warranty');
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $value) {
                $this->db->where('id', $value->optional_warranty_id);
                $queryWarranty = $this->db->get('tbl_warranty');
                $count = $queryWarranty->num_rows();
                if ($count > 0) {
                    $record[] = $queryWarranty->row()->warranty_name_id;
                }
            }
            $result = $record;
        } else {
            $result = array();
        }
        return $result;
    }

// logic to find the selected warranties  id for house 
    public function getWarrantiesSelectedHouse($house_detail_id) {
        $this->db->where('house_detail_id', $house_detail_id);
        $query = $this->db->get('tbl_selected_optional_warranty_house');
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $value) {
                $this->db->where('id', $value->optional_warranty_id);
                $queryWarranty = $this->db->get('tbl_warranty');
                $count = $queryWarranty->num_rows();
                if ($count > 0) {
                    $record[] = $queryWarranty->row()->warranty_name_id;
                }
            }
            $result = $record;
        } else {
            $result = array();
        }
        return $result;
    }

// logic to find the selected warranties  id for proffesional multi risk (by Shiv)
    public function getWarrantiesSelectedProffesionalMultiRisk($proffesional_multirisk_quote_id) {
        $this->db->where('proffesional_multirisk_quote_id', $proffesional_multirisk_quote_id);
        $query = $this->db->get('tbl_selected_optional_warranty_proffesional_multirisk');
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $value) {
                $this->db->where('id', $value->optional_warranty_id);
                $queryWarranty = $this->db->get('tbl_warranty');
                $count = $queryWarranty->num_rows();
                if ($count > 0) {
                    $record[] = $queryWarranty->row()->warranty_name_id;
                }
            }
            $result = $record;
        } else {
            $result = array();
        }
        return $result;
    }

// logic to find the selected warranties  id for credit (by Shiv) 
    public function getWarrantiesSelectedCredit($credit_detail_id) {
        $this->db->where('credit_detail_id', $credit_detail_id);
        $query = $this->db->get('tbl_selected_optional_warranty_credit');
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $value) {
                $this->db->where('id', $value->optional_warranty_id);
                $queryWarranty = $this->db->get('tbl_warranty');
                $count = $queryWarranty->num_rows();
                if ($count > 0) {
                    $record[] = array(
                        'warranty_name_id' => $queryWarranty->row()->warranty_name_id,
                        'type_of_warranties_id' => $queryWarranty->row()->type_of_warranties_id
                    );
                }
            }
            $result = $record;
        } else {
            $result = array();
        }
        return $result;
    }

// logic to find the selected warranties  id for credit (by Shiv) 
    public function getWarrantiesSelectedForCredit($credit_detail_id) {
        $this->db->where('credit_detail_id', $credit_detail_id);
        $query = $this->db->get('tbl_selected_optional_warranty_credit');
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $value) {
                $this->db->where('id', $value->optional_warranty_id);
                $queryWarranty = $this->db->get('tbl_warranty');
                $count = $queryWarranty->num_rows();
                if ($count > 0) {
                   $record[] = $queryWarranty->row()->warranty_name_id;
                }
            }
            $result = $record;
        } else {
            $result = array();
        }
        return $result;
    }    

// logic to find the franchise id
    public function getFranchisesSelected($vehicle_detail_id) {
        $record = array();
        $this->db->where('vehicle_detail_id', $vehicle_detail_id);
        $query = $this->db->get('tbl_selected_optional_franchise');
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $value) {
                $this->db->where('id', $value->optional_franchise_id);
                $queryWarranty = $this->db->get('tbl_franchise');
                $count = $queryWarranty->num_rows();
                if ($count > 0) {
                    $record[] = $queryWarranty->row()->franchise_name_id;
                }
            }
            $result = $record;
        } else {
            $result = array();
        }
        return $result;
    }

    // logic to find the franchise id for house
    public function getFranchisesSelectedHouse($house_detail_id) {
        $record = array();
        $this->db->where('house_detail_id', $house_detail_id);
        $query = $this->db->get('tbl_selected_optional_franchise_house');
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $value) {
                $this->db->where('id', $value->optional_franchise_id);
                $queryWarranty = $this->db->get('tbl_franchise');
                $count = $queryWarranty->num_rows();
                if ($count > 0) {
                    $record[] = $queryWarranty->row()->franchise_name_id;
                }
            }
            $result = $record;
        } else {
            $result = array();
        }
        return $result;
    }

// logic to find the franchise id for house (by Shiv)
    public function getFranchisesSelectedProffesionalMultiRisk($proffesional_multirisk_quote_id) {
        $record = array();
        $this->db->where('proffesional_multirisk_quote_id', $proffesional_multirisk_quote_id);
        $query = $this->db->get('tbl_selected_optional_franchise_proffesional_multirisk');
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $value) {
                $this->db->where('id', $value->optional_franchise_id);
                $queryWarranty = $this->db->get('tbl_franchise');
                $count = $queryWarranty->num_rows();
                if ($count > 0) {
                    $record[] = $queryWarranty->row()->franchise_name_id;
                }
            }
            $result = $record;
        } else {
            $result = array();
        }
        return $result;
    }

// logic to find the Transported Person Selected
    public function getTransportedPersonSelected($vehicle_detail_id) {
        $record = array();
        $this->db->where('vehicle_detail_id', $vehicle_detail_id);
        $query = $this->db->get('tbl_selected_vehicle_trans_insurance');
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->row()->vehicle_trans_person_insurance_id;
            // $result = $record;
        } else {
            $result = array();
        }
        return $result;
    }

    public function getSelectedPremiumForVehicleId($vehicle_detail_id) {
        $record = array();
        $this->db->where('vehicle_detail_id', $vehicle_detail_id);
        $query = $this->db->get('tbl_selected_premium');
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->row()->premium_id;
            // $result = $record;
        } else {
            $result = "";
        }
        return $result;
    }

    public function getDataToInsertForSelectedCompany($company_id = "") {
        $record = array();
        $this->db->where('company_id', $company_id);
        $query = $this->db->get('tbl_travel');
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
        } else {
            $result = array();
        }
        return $result;
    }

// function added by Shiv to get the data to be inserted for selected company in for individual accident insurance
    public function getDataOfIndividualAccidentToInsertForSelectedCompany($company_id = "") {
        $record = array();
        $this->db->where('company_id', $company_id);
        $query = $this->db->get('tbl_individual_accident_insurance_options');
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
        } else {
            $result = array();
        }
        return $result;
    }

// function added by Shiv to get the data to insert for Health Insurance for selected company	
    public function getDataOfHealthInsuranceToInsertForSelectedCompany($company_id = "") {
        $record = array();
        $this->db->where('company_id', $company_id);
        $query = $this->db->get('tbl_health_insurance');
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
        } else {
            $result = array();
        }
        return $result;
    }

// function added by Shiv to get the company quote amount based on the conditions House Tarification Data
    public function getHouseTarificationData($data, $table) {
        $this->db->select('id,company_id,amount');
        $this->db->where('insurer_quality_id', $data['insurer_quality_id']);
        $this->db->where('minimum_room <=',$data['room']);
        $this->db->where('maximum_room >=',$data['room']);

        $this->db->where('minimum_monthly_rent <=',$data['monthly_rent']);
        $this->db->where('maximum_monthly_rent >=',$data['monthly_rent']);
        
        $this->db->where('minimum_content_value <=',$data['content_value']);
        $this->db->where('maximum_content_value >=',$data['content_value']);
        
        $this->db->where('minimum_building_value <=',$data['building_value']);
        $this->db->where('maximum_building_value >=',$data['building_value']);
        
        $this->db->where('minimum_superficy <=',$data['superficy']);
        $this->db->where('maximum_superficy >=',$data['superficy']);        
        
        $this->db->where('house_type_id', $data['house_type_id']);
        $this->db->where('house_category_id', $data['house_category_id']);
        $this->db->where('month_id', $data['month_id']);
        $this->db->where('risque_id', $data['risque_id']);
        $query = CI()->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $i = 0;
            $result = $query->result();
            foreach ($result as $value) {
                $result_data[$i]['id'] = $value->id;
                $result_data[$i]['company_id'] = $value->company_id;
                $result_data[$i]['amount'] = $value->amount;
                $i++;
            }
            return $result_data;
        } else {
            return array();
        }
    }

// function added by Shiv to get the company quote amount based on the conditions House Tarification Data and the selected company
    public function getHouseTarificationDataForSelectedCompany($data, $table) {
        $this->db->select('id,company_id,amount');
        $this->db->where('company_id', $data['company_selected']);
        $this->db->where('insurer_quality_id', $data['insurer_quality_id']);
        
        $this->db->where('minimum_room <',$data['room']);
        $this->db->where('maximum_room >',$data['room']);

        $this->db->where('minimum_monthly_rent <',$data['monthly_rent']);
        $this->db->where('maximum_monthly_rent >',$data['monthly_rent']);
        
        $this->db->where('minimum_content_value <',$data['content_value']);
        $this->db->where('maximum_content_value >',$data['content_value']);
        
        $this->db->where('minimum_building_value <',$data['building_value']);
        $this->db->where('maximum_building_value >',$data['building_value']);
        
        $this->db->where('minimum_superficy <',$data['superficy']);
        $this->db->where('maximum_superficy >',$data['superficy']); 

        $this->db->where('house_type_id', $data['house_type_id']);
        $this->db->where('house_category_id', $data['house_category_id']);
        $this->db->where('month_id', $data['month_id']);
        $this->db->where('risque_id', $data['risque_id']);
        $query = CI()->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $i = 0;
            $result = $query->result();
            foreach ($result as $value) {
                $result_data[$i]['id'] = $value->id;
                $result_data[$i]['company_id'] = $value->company_id;
                $result_data[$i]['amount'] = $value->amount;
                $i++;
            }
            return $result_data;
        } else {
            return array();
        }
    }

// function added by Shiv to get the company quote amount based on the conditions Credit Tarification Data
    public function getCreditTarificationData($data, $table) {
        $this->db->select('id,company_id,insurance_rate');
        $this->db->where('min_loan_amount <=', $data['credit_insurance_loan_amount']);
        $this->db->where('max_loan_amount >=', $data['credit_insurance_loan_amount']);

        $this->db->where('loan_duration', $data['credit_insurance_loan_duration']);

        // $this->db->where('insurance_rate',$data['credit_insurance_rate']);

        $this->db->where('loan_size', $data['credit_insurance_loan_size']);

        $this->db->where('min_age <=', $data['credit_insurance_customer_age']);
        $this->db->where('max_age >=', $data['credit_insurance_customer_age']);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $i = 0;
            $result = $query->result();
            foreach ($result as $value) {
                $result_data[$i]['id'] = $value->id;
                $result_data[$i]['company_id'] = $value->company_id;
                $result_data[$i]['insurance_rate'] = $value->insurance_rate;
                $i++;
            }
            return $result_data;
        } else {
            return array();
        }
    }


    // function added by Shiv to get the company quote amount based on the conditions Credit Tarification Data and the selected company
    public function getCreditTarificationDataForSelectedCompany($data, $table) {
        $this->db->select('id,company_id,insurance_rate');
        $this->db->where('company_id', $data['company_selected']);
        $this->db->where('min_loan_amount <=', $data['credit_insurance_loan_amount']);
        $this->db->where('max_loan_amount >=', $data['credit_insurance_loan_amount']);

        $this->db->where('loan_duration', $data['credit_insurance_loan_duration']);

        // $this->db->where('insurance_rate',$data['credit_insurance_rate']);

        $this->db->where('loan_size', $data['credit_insurance_loan_size']);

        $this->db->where('min_age <=', $data['credit_insurance_customer_age']);
        $this->db->where('max_age >=', $data['credit_insurance_customer_age']);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $i = 0;
            $result = $query->result();
            foreach ($result as $value) {
                $result_data[$i]['id'] = $value->id;
                $result_data[$i]['company_id'] = $value->company_id;
                $result_data[$i]['insurance_rate'] = $value->insurance_rate;
                $i++;
            }
            return $result_data;
        } else {
            return array();
        }
    }


    public function getPolicyListCount($policy_nos = null) {
        if(!empty($_GET['user_id'])) {
            $this->db->where('user_id',$_GET['user_id']);
        }
        if(!empty($_GET['policy_creation_date'])) {
            $this->db->where_in('policy_number',$policy_nos);
        }
        if(!empty($_GET['insurance_type_id'])) {
            $this->db->where('insurance_type_id',$_GET['insurance_type_id']);
        }
        if(!empty($_GET['company_id'])) {
            $this->db->where('company_id',$_GET['company_id']);
        }
        if(!empty($_GET['policy_number'])) {
            $this->db->where('policy_number',$_GET['policy_number']);
        }
        $query = $this->db->get('tbl_payment');
        $count = $query->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }



    public function getPolicyList($limit = 10, $start = 10,$policy_nos = null) {
        if (!empty($limit)) {
            $this->db->limit($limit, $start);
        }
        if(!empty($_GET['policy_creation_date'])) {
            $this->db->where_in('policy_number',$policy_nos);
        }
        if(!empty($_GET['user_id'])) {
            $this->db->where('user_id',$_GET['user_id']);
        }
        if(!empty($_GET['insurance_type_id'])) {
            $this->db->where('insurance_type_id',$_GET['insurance_type_id']);
        }
        if(!empty($_GET['company_id'])) {
            $this->db->where('company_id',$_GET['company_id']);
        }
        if(!empty($_GET['policy_number'])) {
            $this->db->where('policy_number',$_GET['policy_number']);
        }
        //	$this->db->where('user_id',$user_id);
        $this->db->order_by('id', desc);

        $query = $this->db->get('tbl_payment');
        $count = $query->num_rows();
        if ($count > 0) {
            //$result = [];
            $res = $query->result();
            $i = 0;
            foreach ($res as $value) {

                $result[$i]['id']             = $value->id;
                $result[$i]['amount']         = $value->amount;
                $result[$i]['insurance_type_id'] = $value->insurance_type_id;
                $result[$i]['insured_id']     = $value->insured_id;
                $result[$i]['payment_status'] = $value->payment_status;
                $result[$i]['user_id']        = $value->user_id;
                $result[$i]['payment_method'] = $value->payment_method;
                $result[$i]['policy_cheque']  = $value->policy_cheque;
                if ($value->insurance_type_id == 1) {// vehicle
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_finalize_vehicle_insurance');
                } else if ($value->insurance_type_id == 2) { //HEALTH
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_health_insurance_finalize_company');
                } else if ($value->insurance_type_id == 3) { //TRAVEL
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_travel_finalize_company');
                } else if ($value->insurance_type_id == 4) { //PROFESSIONAL MULTIRISK
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_finalize_proffesional_multirisk_insurance');
                } else if ($value->insurance_type_id == 5) { //INDIVIDUAL ACCIDENT
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_individual_accident_finalize_company');
                } else if ($value->insurance_type_id == 6) { //CREDIT
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_finalize_credit_insurance');
                } else if ($value->insurance_type_id == 7) { //HOUSING
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_finalize_housing_insurance');
                }

                $i++;
            }
            return $result;
        } else {
            return array();
        }
    }

// get the quittance of the month
    function quittance_of_month($year, $month, $data) {
		
        if ($data['role'] == 4) { // Company
            $this->db->where('company_id', $data['company_id']);
            if($data['branch_id'] != '') {
                $this->db->where('branch_id', $data['branch_id']);
            }
            // $this->db->where('risque_id',$data['risque_id']);
            $this->db->where('status', 1);
            // $this->db->like('created_date',$month);
            // $this->db->like('created_date',$year);
            $this->db->where('policy_creation_date >=', $data['start_date']);
            $this->db->where('policy_creation_date <=', $data['end_date']);
            $query = $this->db->get('tbl_quittance');
        } else if ($data['role'] == 3) { // Partner
            $this->db->select('*');
            $this->db->from('tbl_quittance');
            $this->db->join('tbl_payment', 'tbl_quittance.policy_number = tbl_payment.policy_number');
            $this->db->where('tbl_payment.policy_creater', $data['user_id']);
            $this->db->where('tbl_quittance.status', 1);
            $this->db->where('tbl_quittance.policy_creation_date >=', $data['start_date']);
            $this->db->where('tbl_quittance.policy_creation_date <=', $data['end_date']);
            $query = $this->db->get();
        }
        /* $this->db->where('company_id',$data['company_id']);
          $this->db->where('branch_id',$data['branch_id']);
          // $this->db->where('risque_id',$data['risque_id']);
          $this->db->where('status',1);
          // $this->db->like('created_date',$month);
          // $this->db->like('created_date',$year);
          $this->db->where('created_date >=', $data['start_date']);
          $this->db->where('created_date <=', $data['end_date']);
          $query = $this->db->get('tbl_quittance'); */
        $count = $query->num_rows();
        //echo $count;die;
        if ($count > 0) {
            $i = 0;
            $result = $query->result();
            $html = "";
            $html = '<div>';
            $html .= '<table id="example2" class="table table-bordered table-hover">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>';
            $html .= "Serial Number";
            $html .= '</th>';
            $html .= '<th>';
            $html .= "Policy Number";
            $html .= '</th>';
            $html .= '<th>';
            $html .= "Client";
            $html .= '</th>';
            $html .= '<th>';
            $html .= "company Name";
            $html .= '</th>';
            $html .= '<th>';
            $html .= "Branch";
            $html .= '</th>';
            $html .= '<th>';
            $html .= "Accessories Admin Commission";
            $html .= '</th>';
            $html .= '<th>';
            $html .= "Policy Admin Commission";
            $html .= '</th>';
            $html .= '<th>';
            $html .= "Total Commission";
            $html .= '</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            foreach ($result as $value) {
                $html .= '<tr>';
                $html .= '<td>';
                if ($data['role'] == 3) { // Partner
                    $html .= '<input type="checkbox" class="policy_number_check" name="policy_number_check" policy_number=' . $value->policy_number . ' value=' . $value->policy_number . ' company_id=' . $value->company_id . ' branch_id=' . $value->branch_id . '  user_id=' . $value->user_id . ' quittance_id=' . $value->id . ' net_amount=' . $value->amount . ' tax=' . $value->tax . ' accessories=' . $value->accessories . ' total_amount=' . $value->total_amount . ' value=' . $value->policy_number . ' partner_policy_commission=' . $value->partner_policy_commission . '  role=' . $data["role"] . ' policy_creater=' . $value->policy_creater . '>';
                } else if ($data['role'] == 4) { // Company
                    $html .= '<input type="checkbox" class="policy_number_check" name="policy_number_check" policy_number=' . $value->policy_number . ' value=' . $value->policy_number . ' company_id=' . $value->company_id . ' branch_id=' . $value->branch_id . '  user_id=' . $value->user_id . ' quittance_id=' . $value->id . ' role=' . $data['role'] . ' net_amount=' . $value->amount . ' tax=' . $value->tax . ' accessories=' . $value->accessories . ' total_amount=' . $value->total_amount . '>';
                }
                $html .= $value->id;
                $html .= '</td>';
                $html .= '<td>';
                $html .= $value->policy_number;
                $html .= '</td>';
                $html .= '<td>';
                $html .= getUserName($value->user_id);
                $html .= '</td>';
                $html .= '<td>';
                $html .= getCompanyName($value->company_id);
                $html .= '</td>';
                $html .= '<td>';
                $html .= getBranchName($value->branch_id);
                $html .= '</td>';
                $html .= '<td>';
                $html .= $value->accessories_admin_share;
                $html .= '</td>';
                $html .= '<td>';
                $html .= $value->admin_policy_commission;
                $html .= '</td>';
                $html .= '<td>';
                $html .= ($value->admin_policy_commission + $value->accessories_admin_share);
                $html .= '</td>';
                $html .= '</tr>';
                /* $result_data[$i]['id']         	  = $value->id;
                  $result_data[$i]['policy_number'] = $value->policy_number;
                  $result_data[$i]['company_id']    = $value->company_id; */
                $i++;
            }
            $html .= '</table>';
            $html .= '</div>';
            return $html;
        } else {
            return array();
        }
    }

// function added by Shiv to get the quittance of month for partner 
    public function get_quittance_of_month_partner($year, $month, $data) {
        print_r($data);
        print_r($month);
        print_r($year);
        die;
    }

// 
    public function getPoliciesByInsuranceTypeId($insurance_type_id) {

        $this->db->select('*');
        $this->db->from('tbl_quittance');
        $this->db->join('tbl_payment', 'tbl_quittance.policy_number = tbl_payment.policy_number');
        $this->db->where('tbl_payment.insurance_type_id', $insurance_type_id);
        // $this->db->order_by('max(tbl_quittance.created_date)','desc');



        $query = $this->db->get();
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            // echo $this->db->last_query(); die;
            /* print_r($res);
              die; */
            foreach ($res as $key => $value) {
                $result[$key]['insured_id'] = $value->insured_id;
                $result[$key]['date'] = date('d/m/Y', strtotime($value->created_date));
                $result[$key]['policy_number'] = $value->policy_number;
                $result[$key]['net_premium'] = $value->amount;
                $result[$key]['accessories'] = $value->accessories;
                $result[$key]['tax'] = $value->tax;
                $result[$key]['total_premium'] = $value->total_amount;
            }
        } else {
            $result = '';
        }
        return $result;
        die;
    }

    // function added by Shiv to get the payment data 
    /* public function getPaymentData($table) {
      $query = $this->db->get($table);
      if($query->num_rows() > 0) {
      $result = $query->result();
      } else {
      $result = '';
      }
      return $result;
      } */

    // function added by Shiv to delete optional warranties
    public function deleteOptionalWarranties($table, $array) {
        $this->db->where($array);
        $this->db->delete($table);
        return true;
    }

    // function added by Shiv to delete optional franchises
    public function deleteOptionalFranchises($table, $array) {
        $this->db->where($array);
        $this->db->delete($table);
        return true;
    }

    // function added by Shiv to delete the finalize data of insurance 
    public function deleteFinalizedData($table, $array) {
        $this->db->where($array);
        $this->db->delete($table);
        return true;
    }

    // function added by Shiv
    public function deleteFinalizedDataTravel($table, $travel_id) {
        $this->db->where('travel_id', $travel_id);
        $this->db->delete($table);
        return true;
    }

    // function added by Shiv
    public function deleteFinalizedDataHealth($table, $health_insurance_id) {
        $this->db->where('health_insurance_id', $health_insurance_id);
        $this->db->delete($table);
        return true;
    }

    // function added by Shiv to delete the insured people details
    public function deleteInsuredPeopleDetails($table, $array) {
        $this->db->where($array);
        $this->db->delete($table);
        return true;
    }

    // logic to find the selected warranties  id for proffesional multi risk (by Shiv)
    public function getLatestWarrantiesSelectedForInsurance($table, $insured_id, $type) {
        if ($type == 1) {
            $sql = 'SELECT * FROM ' . $table . ' where created_date = (select MAX(created_date) from ' . $table . ' where vehicle_detail_id = ' . $insured_id . ')';
        } else if ($type == 4) {
            $sql = 'SELECT * FROM ' . $table . ' where created_date = (select MAX(created_date) from ' . $table . ' where proffesional_multirisk_quote_id = ' . $insured_id . ')';
        }
        $query = $this->db->query($sql);
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $value) {
                $this->db->where('id', $value->optional_warranty_id);
                $queryWarranty = $this->db->get('tbl_warranty');
                $count = $queryWarranty->num_rows();
                if ($count > 0) {
                    $record[] = $queryWarranty->row()->warranty_name_id;
                }
            }
            $result = $record;
        } else {
            $result = array();
        }
        return $result;
    }

    // logic to find the franchise id for house (by Shiv)
    public function getLatestFranchisesSelectedForInsurance($table, $insured_id, $type) {
        $record = array();
        if ($type == 1) {
            $sql = 'SELECT * FROM ' . $table . ' where created_date = (select MAX(created_date) from ' . $table . ' where vehicle_detail_id = ' . $insured_id . ')';
        } else if ($type == 4) {
            $sql = 'SELECT * FROM ' . $table . ' where created_date = (select MAX(created_date) from ' . $table . ' where proffesional_multirisk_quote_id = ' . $insured_id . ')';
        }
        $query = $this->db->query($sql);
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $value) {
                $this->db->where('id', $value->optional_franchise_id);
                $queryWarranty = $this->db->get('tbl_franchise');
                $count = $queryWarranty->num_rows();
                if ($count > 0) {
                    $record[] = $queryWarranty->row()->franchise_name_id;
                }
            }
            $result = $record;
        } else {
            $result = array();
        }
        return $result;
    }

    // function added by Shiv
    public function getLatestFinalInsuranceDetail($table, $insured_id, $type) {
        if ($type == 1) {
            $sql = 'SELECT * FROM ' . $table . ' where created_date = (select MAX(created_date) from ' . $table . ' where vehicle_detail_id = ' . $insured_id . ')';
        } else if ($type == 3) {
            $sql = 'SELECT * FROM ' . $table . ' where travel_id = ' . $insured_id;
        } else if ($type == 4) {
            $sql = 'SELECT * FROM ' . $table . ' where created_date = (select MAX(created_date) from ' . $table . ' where proffesional_multirisk_quote_id = ' . $insured_id . ')';
        }
        $query = $this->db->query($sql);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

    // function added by Shiv to get the data of Partner 
    public function getPartnerData($table, $user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $result = $query->row();
        } else {
            $result = '';
        }
        return $result;
    }



    // function added to generate random string
    function generateRandomString($length = 10) {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    // new code added by Sushant on 9-12-2019
    function getVehicleFleetData($vehicle_detail_id){
        $data = $this->db->select("*")->from("tbl_vehicle_fleet")->where("vehicle_detail_id",$vehicle_detail_id)->get()->row();
        return $data;
    }

    // to get vehicle data and its children vehicle under one policy
    function getVehicleDetailDataWithChild($vehicle_detail_id) {
        $data = $this->db->select("id,tvv,registeration_number,insurance_registeration_date,chasis_number")->from("tbl_vehicle_detail")->where("parent_id",$vehicle_detail_id)->get()->result();
        return $data;
    }

    function getVehicleDetailData($vehicle_detail_id) {
        $data = $this->db->select("*")->from("tbl_vehicle_detail")->where("id",$vehicle_detail_id)->get()->row();
        return $data;
    }

    // function added by Shiv to get the questions added by a company
    function getQuestionariesData($table,$company_id,$insurance_type_id) {
        $this->db->where('company_id',$company_id);
        $this->db->where('ins_type_id',$insurance_type_id);
        $this->db->where('status','1');
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if($count > 0) {
            $result = $query->result();
        } else {
            $result = array ();
        }
        return $result;
    }



    // function added by Shiv to get the bonus option ids by company id and branch id
    function getBonusOptionId($company_id,$branch_id) {
        if($company_id != "") {
            $this->db->where('company_id', $company_id);
        } 
        if($branch_id != "") {
            $this->db->where('branch_id', $branch_id);
        }
        $query = $this->db->get('tbl_bonus');
        $res   = $query->result();
        if ($query->num_rows() > 0) {
            foreach ($res as $key => $value) {
                $result[$key] = $value->id;
            }
        } else {
            $result = '';
        }
        return $result;
    }
    

    // function added by Shiv    
    function getPolicyByCreationDate($creation_date) {
        $this->db->select('policy_number');
        $this->db->from('tbl_quittance');
        $this->db->where('policy_creation_date >',date('Y-m-d 00:00:00',strtotime($creation_date)));
        $this->db->where('policy_creation_date <',date('Y-m-d 23:59:59',strtotime($creation_date)));
        $query = $this->db->get();
        $res = $query->result();
        if($query->num_rows() > 0) {
            foreach ($res as $key => $value) {
                $result[$key] = $value->policy_number;
            }
        } else {
            $result = '';
        }
        return $result;
    }


    public function getSlipDataCount() {
        $this->db->order_by('id', desc);
        $query = $this->db->get('tbl_slip_data');
        $count = $query->num_rows();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }



    // get slip data
    public function getSlipData($limit = 10, $start = 10) {
        if(!empty($limit)) {
            $this->db->limit($limit,$start);
        }
        /*$this->db->where('year', $year);
        $this->db->where('month', $month);*/
        $this->db->order_by('id', desc);
        $query = $this->db->get('tbl_slip_data');
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $key => $value) {
                $result[$key]['id']             = $value->id;
                $result[$key]['cheque_path']    = $value->cheque_path;
                $result[$key]['slip_name']      = $value->slip_name;
                $result[$key]['policy_numbers'] = getPolicyNumbersForSlip($value->slip_name);
                /*$i = 0;
                foreach (getPolicyNumbersForSlip($value->slip_name) as $key => $value) {
                    $result[$key]['policy_data'][$i] = $this->getQuittanceData($value);   
                    $i++;
                }*/
            }
            return $result;
        } else {
            return "No Record Found";
        }
    }



    // function added by Shiv to get the quittance data

        public function getQuittanceData($policy_number) {
            $this->db->where('policy_number',$policy_number);
            $query = $this->db->get('tbl_quittance');
            if($query->num_rows() > 0) {
                $res = $query->row();
                $result->user_name    = getUserName($res->user_id);
                $result->policy_number = $res->policy_number;
                $result->net_premium  = $res->amount;
                $result->tax          = $res->tax;
                $result->accessories  = $res->accessories;
                $result->total_amount = $res->total_amount;
            } else {
                $result = '';
            }
        return $result;
    }



    // function added by Shiv to get the quittance data
    public function getQuittanceDataForSlip($policy_number) {
        //$this->db->where('policy_number',$policy_number);
        $this->db->where('id',$policy_number);
        $query = $this->db->get('tbl_quittance');
        if($query->num_rows() > 0) {
            $res = $query->row();
            $result->id                      = $res->id;
            $result->company_id              = $res->company_id;
            $result->branch_id               = $res->branch_id;
            $result->risque_id               = $res->risque_id;
            $result->user_name               = getUserName($res->user_id);
            $result->policy_number           = $res->policy_number;
            $result->net_premium             = $res->amount;
            $result->tax                     = $res->tax;
            $result->accessories             = $res->accessories;
            $result->total_amount            = $res->total_amount;
            $result->admin_policy_commission = $res->admin_policy_commission;
            //$result->partner_policy_commission = $res->partner_policy_commission;
    		$result->policy_start_date       = $res->policy_start_date;
    		$result->policy_end_date      	 = $res->policy_end_date;
            $result->policy_creation_date    = $res->policy_creation_date;
            $result->total_amount            = $res->total_amount;
        } else {
            $result = '';
        }
        return $result;
    }


    // function added by Shiv to update insurance dates
    public function setUpdateDates($table, $data, $array) {
        $this->db->where($array);
        $this->db->update($table, $data);
        return $id;
    }
}
