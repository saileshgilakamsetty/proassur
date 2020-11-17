<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Front_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public $users = 'tbl_users';

// function to get the data collection record by id
    public function getDataCollectionByID($table, $id = "") {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = json_encode($query->row());
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

// function to get the company quote amount based on the conditions.
    public function getCompanyQuote($data, $table) {
        $this->db->where('fiscal_power', $data['fiscal_power']);
        $this->db->where('fuel_type', $data['fuel_type']);
        $this->db->where('usage', $data['usage']);
        $this->db->where('trailer', $data['trailer']);
        $this->db->where('risque_id', $data['risque']);
        //$this->db->where('seats',$data['seats']);
        $this->db->where('status', 1);

        $query = $this->db->get($table);
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

    public function setInsertData($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
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

// function to get the optional franchise
    public function getOptionalFranchicies($company_id, $branch_id) {
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
            $result = array();

            // $result = '';
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

// logic to find the selected warranties  id for proffesional multi risk (by Shiv)
    public function getWarrantiesSelectedProffesionalMultiRisk($professional_multirisk_quote_id) {
        $this->db->where('proffesional_multirisk_quote_id', $professional_multirisk_quote_id);
        $query = $this->db->get('tbl_selected_optional_warranty_proffesional_multirisk');
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $value) {
                $this->db->where('id', $value->optional_warranty_id);
                $queryWarranty = $this->db->get('tbl_warranty');
                $countWarranty = $queryWarranty->num_rows();
                if ($countWarranty > 0) {
                    $record[] = $queryWarranty->row()->warranty_name_id;
                }
            }
            $result = $record;
        } else {
            $result = array();
        }
        return $result;
    }

    // logic to find the selected warranties  id for house (by Shiv) 
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

// logic to find the franchise id for house
    public function getFranchisesSelectedHouse($house_detail_id) {
        // $record = array();
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

// function added by Shiv to get the data of finalize company for tarvel examination
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

// function added by Shiv to get the final Vehicle Insurance Detail
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

    // function added by Shiv to get the final house Insurance Detail
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

    // function added by Shiv to get the final Health Insurance Detail
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

    // function added by Shiv to get the final Proffesional Multi Risk Insurance Detail
    public function getFinalProffesionalMultiRiskInsuranceDetail($table, $professional_multirisk_quote_id) {
        $this->db->where('proffesional_multirisk_quote_id', $professional_multirisk_quote_id);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
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

    public function getPolicyList($user_id, $type) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', asc);
        if ($type == "active") {
            $this->db->where('payment_status', 2);
        } else if ($type == "expired") {
            $this->db->where('payment_status', 3);
        } else if ($type == "paid") {
            $this->db->where('payment_status', 2);
        } else if ($type == "unpaid") {
            $this->db->where('payment_status', 0);
        }
        $query = $this->db->get('tbl_payment');
        $count = $query->num_rows();
        if ($count > 0) {
            //$result = [];
            $res = $query->result();

            $i = 0;
            foreach ($res as $value) {
                $result[$i]['id'] = $value->id;
                $result[$i]['amount'] = $value->amount;
                $result[$i]['policy_number'] = $value->policy_number;
                $result[$i]['insurance_type_id'] = $value->insurance_type_id;
                $result[$i]['insured_id'] = $value->insured_id;
                $result[$i]['payment_status'] = $value->payment_status;
                $result[$i]['policy_created_by'] = getUserRoleName($value->policy_created_by);
                $result[$i]['policy_creater'] = getUserName($value->policy_creater);
                if ($value->insurance_type_id == 1) {// vehicle
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_finalize_vehicle_insurance');
                } else if ($value->insurance_type_id == 2) { //HEALTH
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_health_insurance_finalize_company');
                } else if ($value->insurance_type_id == 3) { //TRAVEL
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_travel_finalize_company');
                } else if ($value->insurance_type_id == 4) { //PROFESSIONAL MULTIRISK
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_finalize_proffesional_multirisk_insurance');
                } else if ($value->insurance_type_id == 5) { //INDIVIDUAL ACCIDENT
                    $individual_insurance_option_details_id = getIndividualInsuranceOptionDetailId($value->insured_id);
                    $result[$i]['company_name'] = getCompanyInsuredFor($individual_insurance_option_details_id, $value->insurance_type_id, 'tbl_individual_accident_finalize_company');
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

// function added by Shiv to get policy list for the specific company
    public function getPolicyListForCompany($company_id, $type) {
        $this->db->where('company_id', $company_id);
        $this->db->where('status', 0);
        $this->db->order_by('created_date', desc);
        $query = $this->db->get('tbl_quittance');
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $key => $value) {
                $result[$key]['date'] = date('d/m/Y', strtotime($value->created_date));
                $result[$key]['policy_number']             = $value->policy_number;
                $result[$key]['net_premium']               = $value->amount;
                $result[$key]['accessories']               = $value->accessories;
                $result[$key]['admin_policy_commission']   = $value->admin_policy_commission;
                $result[$key]['accessories_admin_share']   = $value->accessories_admin_share;
                $result[$key]['tax']                       = $value->tax;
                $result[$key]['total_premium']             = $value->total_amount;
            }
            return $result;
        } else {
            return array();
        }
    }


    // function added by Shiv to get policy list for the specific company
    public function getPolicyListForCompanyByDate($company_id,$strId,$endId,$searchkey){
        if($strId){
            $this->db->where('policy_start_date >=', $strId);
            $this->db->where('policy_end_date <=', $endId);
        }
        if($searchkey){
            $this->db->where('policy_number',$searchkey);
            // $this->db->where('company_id',$searchkey);
            // $this->db->where('branch_id',$searchkey);
        }
        if($strId !="" && $searchkey !=""){
            $this->db->where('policy_start_date >=', $strId);
            $this->db->where('policy_end_date <=', $endId);
            $this->db->where('policy_number',$searchkey);
        }    
        $this->db->where('company_id', $company_id);
        //$this->db->where('status', 0);
        $this->db->order_by('created_date', desc);
        $query = $this->db->get('tbl_quittance');
        // print_r($query->result());die;
        // print_r($this->db->last_query());die;
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $key => $value) {
                $result[$key]['date'] = date('d/m/Y', strtotime($value->created_date));
                $result[$key]['policy_number']             = $value->policy_number;
                $result[$key]['net_premium']               = $value->amount;
                $result[$key]['accessories']               = $value->accessories;
                $result[$key]['admin_policy_commission']   = $value->admin_policy_commission;
                $result[$key]['accessories_admin_share']   = $value->accessories_admin_share;
                $result[$key]['tax']                       = $value->tax;
                $result[$key]['total_premium']             = $value->total_amount;
            }
            return $result;
        } else {
            return array();
        }
    }


    // function added by Shiv to get the 
    public function getPolicyListForCompanyByPaymentStatus($company_id,$pymnts_id) {
        // print_r($post_data);
        
        $this->db->select('quit.*,pay.payment_status,pay.policy_number as Payment_Policy_No');
		$this->db->join('tbl_payment pay','quit.policy_number = pay.policy_number','LEFT');
		$this->db->from('tbl_quittance quit');
		$this->db->where('quit.company_id',$company_id);
		$this->db->where('pay.payment_status',$pymnts_id);
		$this->db->order_by('quit.id',"DESC");
        
        // $this->db->select('*');
        // $this->db->from('tbl_quittance');
		// $this->db->join('tbl_payment', 'tbl_quittance.policy_number = tbl_payment.policy_number');
        // $this->db->where('tbl_quittance.company_id', 0);
        // $this->db->where('tbl_payment.payment_status', $pymnts_id);
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        
        $res   = $query->result();
        // echo"pre";
        // print_r($res);die;
        $count = $query->num_rows();
        if($count > 0) {
        	foreach ($res as $key => $value) {
                $result[$key]['date'] = date('d/m/Y', strtotime($value->created_date));
                $result[$key]['policy_number']             = $value->policy_number;
                $result[$key]['net_premium']               = $value->amount;
                $result[$key]['accessories']               = $value->accessories;
                $result[$key]['admin_policy_commission']   = $value->admin_policy_commission;
                $result[$key]['accessories_admin_share']   = $value->accessories_admin_share;
                $result[$key]['tax']                       = $value->tax;
                $result[$key]['total_premium']             = $value->total_amount;
            }
            return $result;
        } else {
            return array();
        }
    }


    // function added by Shiv to get the Insurance Settings Options
    public function getInsuranceSettingsDataForCompany($company_id) {
        // print_r($post_data);
    	$this->db->select('*');
        $this->db->from('tbl_quittance');
		$this->db->join('tbl_payment', 'tbl_quittance.policy_number = tbl_payment.policy_number');
        $this->db->where('tbl_payment.company_id', $company_id);
        $this->db->where('tbl_quittance.status', 0);
        $query = $this->db->get();
        $res   = $query->result();
        $count = $query->num_rows();
        if($count > 0) {
        	foreach ($res as $key => $value) {
        		$optional_warranties = $this->getOptionalWarranties($value->company_id,$value->branch_id,$value->risque_id);
        		if(!empty($optional_warranties)) {
	        		foreach ($optional_warranties as $keyy => $vallue) {
	        			$result[$key]['optional_warranties'][$keyy] = getWarrantyName($vallue->warranty_name_id);
	        		}
        		} else {
        			$result[$key]['optional_warranties'][0] = 'Not Available';
        		}
        		$result[$key]['total_premium']         = $value->total_amount;
        		$result[$key]['commission_percentage'] = $value->admin_policy_commission;
        		$result[$key]['policy_creater']        = ($value->policy_creater>0)?getUserName($value->policy_creater):'Not Available';
        	}
        } /*else {
        	$result[$key]['optional_warranties']   = 'Not Available';
        	$result[$key]['total_premium']         = 0;
    		$result[$key]['commission_percentage'] = 0;
        	$result[$key]['policy_creater']        = 'Not Available';
        }*/
        return $result;
    }




    /* public function getTodaysPolicyForCompany($company_id) {
      $this->db->where('company_id',$company_id);
      $this->db->order_by('created_date',desc);
      $query = $this->db->get('tbl_payment');
      $res = $query->result();
      if($query->num_rows() > 0) {
      // $result = '';
      foreach ($res as $key => $value) {
      if(date('Y-m-d') == date('Y-m-d',strtotime($value->created_date))) {
      $result[] = $value->insurance_type_id;
      }
      // $i = 0;
      }
      print_r($result);
      }
      } */

    public function getTodaysPolicyCountForCompany($company_id, $type) {
        $insurance_type_ids = getInsuranceTypeIds();
        foreach ($insurance_type_ids as $id) {
            $this->db->select('*');
            $this->db->from('tbl_quittance');
            $this->db->join('tbl_payment', 'tbl_quittance.policy_number = tbl_payment.policy_number');
            $this->db->where('tbl_payment.company_id', $company_id);
            $this->db->where('tbl_payment.insurance_type_id', $id);
            //$this->db->where('tbl_quittance.status', 0);
            $this->db->where('tbl_quittance.created_date >', date('Y-m-d 00:00:00'));
            $this->db->where('tbl_quittance.created_date <', date('Y-m-d 23:59:59'));

            if ($type == 'paid') {
                $this->db->where('tbl_payment.payment_status',2);
                $query = $this->db->get();
                $res = $query->result_array();
                $count = $query->num_rows();
                if ($count > 0) {
                    // $result['insurance_policy'][$id] = $count;
                    foreach ($res as $key => $value) {
                        $result['Total Revenue'] += $value['total_amount'];
                    }
                } else {
                    //$result['Total Revenue'] = 0;
                }
                $result['Total Sold Policies'] += $count;
                // print_r($result);die;
            } else if ($type == 'pending') {
                $this->db->where('tbl_payment.payment_status',0);
                $query = $this->db->get();
                $res   = $query->result_array();
                $count = $query->num_rows();
                $result['Pending Slips'] += $count;
                //echo $count;
            } else {
                $query = $this->db->get();
                $res = $query->result_array();
                $count = $query->num_rows();
                if ($count > 0) {
                    $result['insurance_policy'][$id] = $count;
                }
                $result['total_policies_issued'] += $count;
            }
        }
        return $result;
    }

    public function getPolicyPaymentForCompany($company_id) {
        $this->db->where('company_id', $company_id);
        $this->db->where('payment_status', 2);
        $query = $this->db->get('tbl_payment');
        if ($query->num_rows() > 0) {
            $res = $query->result();
            foreach ($res as $key => $value) {
                $result[$key]['total_amount'] = $value->amount;
                $result[$key]['payment_date'] = date('d/m/Y', strtotime($value->created_date));
                $result[$key]['payment_mode'] = getPaymentMode($value->payment_method);
            }
        } else {
            $result = '';
        }
        return $result;
    }


    public function getPolicyPaymentForPartner($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('payment_status', 2);
        if($_GET['insurance_type_id']) {
            $this->db->where('insurance_type_id',$_GET['insurance_type_id']);
        }
        $query = $this->db->get('tbl_payment');
        if ($query->num_rows() > 0) {
            $res = $query->result();
            foreach ($res as $key => $value) {
                $result[$key]['total_amount'] = $value->amount;
                $result[$key]['payment_date'] = date('d/m/Y', strtotime($value->created_date));
                $result[$key]['payment_mode'] = getPaymentMode($value->payment_method);
            }
        } else {
            $result = '';
        }
        return $result;
    }
    

// function added by Shiv to view the policies created by Partner
    public function getPartnerPolicyList($user_data, $type) {
        $this->db->where('policy_created_by', $user_data['role']);
        $this->db->order_by('id', asc);
        if ($type == "active") {
            $this->db->where('payment_status', 2);
        } else if ($type == "expired") {
            $this->db->where('payment_status', 3);
        } else if ($type == "paid") {
            $this->db->where('payment_status', 2);
        } else if ($type == "unpaid") {
            $this->db->where('payment_status', 0);
        }
        $query = $this->db->get('tbl_payment');
        $count = $query->num_rows();
        if ($count > 0) {
            //$result = [];
            $res = $query->result();
            $i = 0;
            foreach ($res as $value) {
                $result[$i]['id']                 = $value->id;
                $result[$i]['amount']             = $value->amount;
                $result[$i]['policy_number']      = $value->policy_number;
                $result[$i]['insurance_type_id']  = $value->insurance_type_id;
                $result[$i]['insured_id']         = $value->insured_id;
                $result[$i]['payment_status']     = $value->payment_status;
                $result[$i]['policy_created_for'] = getUserRoleName($value->policy_created_for);
                $result[$i]['customer_name']      = getUserName($value->user_id);
                if ($value->insurance_type_id == 1) {// vehicle
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_finalize_vehicle_insurance');
                } else if ($value->insurance_type_id == 2) { //HEALTH
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_health_insurance_finalize_company');
                } else if ($value->insurance_type_id == 3) { //TRAVEL
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_travel_finalize_company');
                } else if ($value->insurance_type_id == 4) { //PROFESSIONAL MULTIRISK
                    $result[$i]['company_name'] = getCompanyInsuredFor($value->insured_id, $value->insurance_type_id, 'tbl_finalize_proffesional_multirisk_insurance');
                } else if ($value->insurance_type_id == 5) { //INDIVIDUAL ACCIDENT
                    $individual_insurance_option_details_id = getIndividualInsuranceOptionDetailId($value->insured_id);
                    $result[$i]['company_name'] = getCompanyInsuredFor($individual_insurance_option_details_id, $value->insurance_type_id, 'tbl_individual_accident_finalize_company');
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

// get slip data
    public function getSlipData($year, $month, $get_created,$company_id = NULL) {
        $this->db->where('year', $year);
        $this->db->where('month', $month);
        $this->db->where('created_by', $get_created);
        $this->db->where('company_id',$company_id);
        $this->db->order_by('id', desc);
        $query = $this->db->get('tbl_slip_data');
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->result();
            foreach ($res as $key => $value) {
                $result[$key]['cheque_path'] = $value->cheque_path;
                $result[$key]['slip_name'] = $value->slip_name;
                $result[$key]['policy_numbers'] = getPolicyNumbersForSlip($value->slip_name);
                $i = 0;
                foreach (getPolicyNumbersForSlip($value->slip_name) as $keyy => $valuee) {
                    $result[$key]['policy_data'][$i] = $this->getQuittanceData($valuee); 
                    $i++;
                }
            }
            /*$res = $query->row();
            $result['cheque_path'] = $res->cheque_path;
            $result['slip_name'] = $res->slip_name;
            $result['policy_numbers'] = getPolicyNumbersForSlip($res->slip_name);
            $i = 0;
            foreach (getPolicyNumbersForSlip($res->slip_name) as $key => $value) {
                $result['policy_data'][$i] = $this->getQuittanceData($value);   
                $i++;
            }*/
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






// get the quittance of the month
    function quittance_of_month($year, $month, $data) {
        if ($data['role'] == 4) { // Company
           
            $this->db->where('company_id', $data['company_id']);
            if($data['branch_id'] != '') {
                $this->db->where('branch_id', $data['branch_id']);
            }
            // $this->db->where('risque_id',$data['risque_id']);
            $this->db->where('status', 0);
            // $this->db->like('created_date',$month);
            // $this->db->like('created_date',$year);
            $this->db->where('policy_creation_date >=', $data['start_date']);
            $this->db->where('policy_creation_date <=', $data['end_date']);
            $query = $this->db->get('tbl_quittance');
        } else if ($data['role'] == 3) {
            $this->db->select('*');
            $this->db->from('tbl_quittance');
            $this->db->join('tbl_payment', 'tbl_quittance.policy_number = tbl_payment.policy_number');
            $this->db->where('tbl_payment.policy_creater', $data['user_id']);
            $this->db->where('tbl_quittance.status', 0);
            $this->db->where('tbl_quittance.policy_creation_date >=', $data['start_date']);
            $this->db->where('tbl_quittance.policy_creation_date <=', $data['end_date']);
            $query = $this->db->get();
        }
        // echo $this->db->last_query();die;
        $count = $query->num_rows();
        if ($count > 0) {
            $i = 0;
            $result = $query->result();
            $html = "";
            $policy_number_selected = "";

            foreach ($result as $value) {
                if ($policy_number_selected != "") {

                    $policy_number_selected = $policy_number_selected . "," . $value->policy_number;
                } else {
                    $policy_number_selected = $value->policy_number;
                }
            }
            $html .= '<input type="hidden" id="selected_branch" value="' . $data['branch_id'] . '">
                <input type="hidden" id="selected_company" value="' . $data['company_id'] . '">
                <input type="hidden" id="policy_number_selected" value="' . $policy_number_selected . '">
                ';


            $html .= '<div>';
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
            $html .= "Total Commision";
            $html .= '</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $total_commision_amount = 0;
            foreach ($result as $key => $value) {
                $total_commision = $value->accessories_admin_share + $value->admin_policy_commission;
                $html .= '<tr>';
                $html .= '<td>';
                if ($data['role'] == 4) {
                    $html .= '<input type="checkbox" class="policy_number_check" id="policy_number_check_' . $key . '" checked="true" name="policy_number_check" policy_number=' . $value->policy_number . ' value=' . $value->policy_number . ' company_id=' . $value->company_id . ' branch_id=' . $value->branch_id . '  user_id=' . $value->user_id . ' quittance_id=' . $value->id . ' net_amount=' . $value->amount . ' tax=' . $value->tax . ' accessories=' . $value->accessories . ' total_amount=' . $value->total_amount . ' total_commision=' . $total_commision . ' role=' . $data["role"] . '>';
                } else if ($data['role'] == 3) {
                    $html .= '<input type="checkbox" class="policy_number_check" id="policy_number_check_' . $key . '"  name="policy_number_check" policy_number=' . $value->policy_number . ' value=' . $value->policy_number . ' company_id=' . $value->company_id . ' branch_id=' . $value->branch_id . '  user_id=' . $value->user_id . ' quittance_id=' . $value->id . ' net_amount=' . $value->amount . ' tax=' . $value->tax . ' accessories=' . $value->accessories . ' total_amount=' . $value->total_amount . ' value=' . $value->policy_number . ' partner_policy_commission=' . $value->partner_policy_commission . '  role=' . $data["role"] . ' policy_creater=' . $value->policy_creater . '>';
                }
                $html .= $value->id;
                $html .= '</td>';
                $html .= '<td>';
                $html .= $value->policy_number;
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
                $html .= '<td policy_number=' . $value->policy_number . '>';
                $html .= $value->accessories_admin_share + $value->admin_policy_commission;
                $html .= '</td>';
                $html .= '</tr>';
                $total_commision_amount = $total_commision_amount + $value->accessories_admin_share + $value->admin_policy_commission;
                /* $result_data[$i]['id']         	  = $value->id;
                  $result_data[$i]['policy_number'] = $value->policy_number;
                  $result_data[$i]['company_id']    = $value->company_id; */
                $i++;
            }
            $html .= '</table>';
            $html .= '</div>';
            $html .= '<input type="hidden" id="total_commision_amount" value = ' . $total_commision_amount . '>';
            $html .= '<div>';
            $html .= '<label>';
            $html .= 'Total Amount';
            $html .= '</label>';
            $html .= '<p id="final_commision_amount">';
            $html .= $total_commision_amount;
            $html .= '</p>';

            $html .= '</div>';
            return $html;
        } else {
            return array();
        }
    }

    public function getpagedata() {

        $this->db->where(['slug' => $this->uri->segment(1), 'langusge_id' => defaultSelectedLanguage()]);
        $result = $this->db->get('tbl_pages')->row();
//        echo $this->db->last_query(); die;
        if (count($result) > 0) {
            return $result;
        } else {
            return [];
        }
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


    public function getHospitalizationData($user_role) {
        $this->db->where('created_by', $user_role);
        $query = $this->db->get('tbl_hospitalization');
        if ($query->num_rows() > 0) {
            $res = $query->result();
           
            /*foreach ($res as $key => $value) {
                $result[$key]['total_amount'] = $value->amount;
                $result[$key]['payment_date'] = date('d/m/Y', strtotime($value->created_date));
                $result[$key]['payment_mode'] = getPaymentMode($value->payment_method);
            }*/
        } else {
            $result = '';
        }
        return $result;
    }



    // function added by Shiv to get the Expired Policies
    public function getExpiredPolicies() {
        $this->db->select('*');
        $this->db->from('tbl_quittance');
        $this->db->join('tbl_payment','tbl_payment.policy_number = tbl_quittance.policy_number');
        $this->db->where('tbl_payment.payment_status !=',3);
        $query = $this->db->get(); 
        $res   = $query->result();
        if($query->num_rows() > 0) {
            foreach ($res as $key => $value) {
                $result[$key]['id']                         = $value->id;
                $result[$key]['insurance_type_id']          = $value->insurance_type_id;              
                $result[$key]['user_id']                    = $value->user_id;
                $result[$key]['policy_number']              = $value->policy_number;
                $result[$key]['policy_end_date']            = $value->policy_end_date;
                $result[$key]['expiry_notification_status'] = $value->expiry_notification_status;
                $result[$key]['expiry_email_sent']          = $value->expiry_email_sent;

            }
        } else {
            $result = array ();
        }
        return $result;
    }




// function added by Shiv 

    public function getAboutUsPageData() {
        $this->db->where(['slug' => 'about-us', 'langusge_id' => defaultSelectedLanguage()]);
        $query = $this->db->get('tbl_pages');
        if($query->num_rows() > 0) {
            $result = $query->row();
        } else {
            $result = '';
        }
        return $result;
    }


// function added by Shiv to get Pending Slips 

    public function getPendingSlips($status = NULL) {
        $this->db->where('status',$status);
        $this->db->where('created_date >', date('Y-m-d 00:00:00'));
        $this->db->where('created_date <', date('Y-m-d 23:59:59'));
        $query = $this->db->get('tbl_slip_data');
        $count = $query->num_rows();
        return $count;
    } 


    // function added by Shiv to update insurance dates
    public function setUpdateDates($table, $data, $array) {
        $this->db->where($array);
        $this->db->update($table, $data);
        return $id;
    }

}
