<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hospitalizationapprovalmodel extends CI_Model {


	private function _get_datatables_query() {

        $this->table = 'tbl_hospitalization';

        $this->column_order = array('a.id','a.policy_holder_name_id', 'a.policy_number', 'a.the_patient_name', 'a.healthcareprovider_name_id','a.approved_status' ,'CONCAT(c.first_name, " ", c.last_name) as user_name','d.name as healthcareprovidername','e.name as company_name');

        $this->column_search = array('a.policy_holder_name_id', 'a.policy_number', 'a.the_patient_name', 'a.healthcareprovider_name_id','a.approved_status','c.first_name','c.last_name','d.name','e.name');
        $this->order = array('a.id' => 'DESC'); // default order 

        $this->db->select($this->column_order);

        $this->db->from($this->table . ' as a');
        $this->db->join('tbl_payment as b', 'b.id = a.policy_holder_name_id', 'left');
        $this->db->join('tbl_users as c', 'c.id = b.user_id', 'left');
        $this->db->join('tbl_healthcareprovider_name as d', 'd.id = a.healthcareprovider_name_id', 'left');
        $this->db->join('tbl_company as e', 'e.id = a.insurance_company_id', 'left');

        $this->db->where('e.user_id',$this->session->userdata('user_id'));
        $this->db->where('a.status', 1);
        

        if (isset($_POST['start_date']) && $_POST['start_date'] != '') {            
            $this->db->where('DATE(a.created_date)>="' . date('Y-m-d', strtotime($_POST['start_date'])) . '"');
        }
        if (isset($_POST['end_date']) && $_POST['end_date'] != '') {
            $this->db->where('DATE(a.created_date)<="' . date('Y-m-d', strtotime($_POST['end_date'])) . '"');
        }



        $i = 0;

        foreach ($this->column_search as $item) { // loop column 
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }





	function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
       // echo $this->db->last_query(); die;
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->select($this->column_order);
        $this->db->from($this->table . ' as a');
        // $this->db->join($this->payment_method . ' as b', 'b.method_id = a.payment_method', 'left');
        // $this->db->join($this->insurance_type . ' as c', 'c.id = a.insurance_type_id', 'left');

        $this->db->where('a.created_by', $this->session->userdata('role'));
        $this->db->where('a.status', 1);


        if (isset($_POST['start_date']) && $_POST['start_date'] != '') {            
            $this->db->where('DATE(a.created_date)>="' . date('Y-m-d', strtotime($_POST['start_date'])) . '"');
        }
        if (isset($_POST['end_date']) && $_POST['end_date'] != '') {
            $this->db->where('DATE(a.created_date)<="' . date('Y-m-d', strtotime($_POST['end_date'])) . '"');
        }
        
        return $this->db->count_all_results();
    }

}