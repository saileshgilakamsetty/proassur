<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class InsuranceSettingsModel extends CI_Model {

    private function _get_datatables_query() {
        $this->table          = 'tbl_quittance';
        $this->payment        = 'tbl_payment';
        $this->insurance_type = 'tbl_insurance_type';
        $this->users          = 'tbl_users';
        $this->warranty       = 'tbl_warranty';


        $this->column_order = array('a.total_amount','a.admin_policy_commission','a.company_id','a.branch_id','a.risque_id', 'CONCAT(d.first_name, " ", d.last_name) as policy_creater_name', 'DATE_FORMAT(a.created_date, "%d-%m-%Y %H:%i:%s") as created_at');
        // $this->column_order = array('a.id', 'a.amount', 'b.name as method_name', 'c.type as ins_type', 'DATE_FORMAT(a.created_date, "%d-%m-%Y %H:%i:%s") as created_at');
        $this->column_search = array('a.total_amount', 'a.admin_policy_commission', 'd.first_name', 'd.last_name', 'c.type', 'DATE_FORMAT(a.created_date, "%d-%m-%Y %H:%i:%s")');
        $this->order = array('a.id' => 'DESC'); // default order 

        $this->db->select($this->column_order);

        $this->db->from($this->table . ' as a');
        $this->db->join($this->payment . ' as b', 'b.policy_number = a.policy_number', 'left');
        $this->db->join($this->insurance_type . ' as c', 'c.id = b.insurance_type_id', 'left');
        $this->db->join($this->users .' as d','d.id = b.policy_creater','left');

        $this->db->where('a.company_id', $this->session->userdata('company_id'));
        $this->db->where('a.status', '0');
        
        if (isset($_POST['insurance_type_id']) && $_POST['insurance_type_id'] != '') {
            $this->db->where(['b.insurance_type_id' => $this->input->post('insurance_type_id')]);
        }

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
        $this->db->join($this->payment . ' as b', 'b.policy_number = a.policy_number', 'left');
        $this->db->join($this->insurance_type . ' as c', 'c.id = b.insurance_type_id', 'left');
        $this->db->join($this->users .' as d','d.id = b.policy_creater','left');

        $this->db->join($this->warranty . ' as e', 'e.risque_id = a.risque_id','left');

        $this->db->where('a.company_id', $this->session->userdata('company_id'));
        $this->db->where('a.status', '0');

        if (isset($_POST['insurance_type_id']) && $_POST['insurance_type_id'] != '') {
            $this->db->where(['b.insurance_type_id' => $this->input->post('insurance_type_id')]);
        }

        if (isset($_POST['start_date']) && $_POST['start_date'] != '') {            
            $this->db->where('DATE(a.created_date)>="' . date('Y-m-d', strtotime($_POST['start_date'])) . '"');
        }
        if (isset($_POST['end_date']) && $_POST['end_date'] != '') {
            $this->db->where('DATE(a.created_date)<="' . date('Y-m-d', strtotime($_POST['end_date'])) . '"');
        }
        
        return $this->db->count_all_results();
    }

    public function Getstatus($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        // echo $this->db->last_query(); die;  
        $result = $query->result();
        return $result[0]->status;
    }

    public function Deletedata($id, $status) {
        if ($status == '0') {
            $status = '1';
        } else {
            $status = '0';
        }
        $this->db->where('id', $id);
        $this->db->update($this->table, array('status' => $status));
        //echo $this->db->last_query(); die;
        $result = $this->db->affected_rows();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

}
