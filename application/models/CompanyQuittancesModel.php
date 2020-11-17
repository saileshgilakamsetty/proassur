<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyquittancesModel extends CI_Model {

    private function _get_datatables_query() {
        $this->table   = 'tbl_quittance';
        $this->branch  = 'tbl_branch';
        $this->risque  = 'tbl_risque';
        $this->users   = 'tbl_users';
        $this->payment = 'tbl_payment';


        $this->column_order = array('a.user_id','a.policy_number','a.admin_policy_commission','a.branch_id','a.risque_id', 'a.amount','a.total_amount','a.tax','a.accessories','DATE_FORMAT(a.policy_creation_date,"%d-%m-%Y %H:%i:%s") as policy_creation_date', 'e.insurance_type_id','e.insured_id','DATE_FORMAT(a.created_date, "%d-%m-%Y %H:%i:%s") as created_at');
        $this->column_search = array('d.first_name','d.last_name','CONCAT(d.first_name, " ", d.last_name)', 'a.policy_number','b.name','c.name','a.total_amount' ,'a.admin_policy_commission', 'DATE_FORMAT(a.created_date, "%d-%m-%Y %H:%i:%s")');
        $this->order = array('a.id' => 'DESC'); // default order 

        $this->db->select($this->column_order);

        $this->db->from($this->table . ' as a');
        $this->db->join($this->branch . ' as b', 'b.id = a.branch_id', 'left');
        $this->db->join($this->risque . ' as c', 'c.id = a.risque_id', 'left');
        $this->db->join($this->users .' as d','d.id = a.user_id','left');
        $this->db->join($this->payment . ' as e', 'e.policy_number = a.policy_number', 'left');

        $this->db->where('a.company_id', $this->session->userdata('company_id'));
        // $this->db->where('a.status', '0');
        
        if (isset($_POST['quittance_status']) && $_POST['quittance_status'] != '') {
            $this->db->where(['a.status' => $this->input->post('quittance_status')]);
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
        // print_r($query->result());
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table . ' as a');
        $this->db->join($this->branch . ' as b', 'b.id = a.branch_id', 'left');
        $this->db->join($this->risque . ' as c', 'c.id = a.risque_id', 'left');
        $this->db->join($this->users .' as d','d.id = a.user_id','left');
        $this->db->join($this->payment . ' as e', 'e.policy_number = a.policy_number', 'left');
        
        $this->column_order = array('a.user_id','a.policy_number','a.admin_policy_commission','a.branch_id','a.risque_id', 'a.amount','a.total_amount','a.tax','a.accessories','DATE_FORMAT(a.policy_creation_date,"%d-%m-%Y %H:%i:%s") as policy_creation_date', 'e.insurance_type_id','e.insured_id','DATE_FORMAT(a.created_date, "%d-%m-%Y %H:%i:%s") as created_at');
        $this->column_search = array('d.first_name','d.last_name','CONCAT(d.first_name, " ", d.last_name)', 'a.policy_number','b.name','c.name','a.total_amount' ,'a.admin_policy_commission', 'DATE_FORMAT(a.created_date, "%d-%m-%Y %H:%i:%s")');
        $this->order = array('a.id' => 'DESC'); 
        $this->db->where('a.company_id', $this->session->userdata('company_id'));
        //$this->db->where('a.status', '0');

        if (isset($_POST['quittance_status']) && $_POST['quittance_status'] != '') {
            $this->db->where(['a.status' => $this->input->post('quittance_status')]);
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
