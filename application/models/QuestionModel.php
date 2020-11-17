<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class QuestionModel extends CI_Model {

    private function _get_datatables_query() {
        $this->question = 'tbl_question';
        $this->insurance_type = 'tbl_insurance_type';

        $this->column_order = array('a.id', 'a.question', 'b.type as instype','DATE_FORMAT(a.created_at, "%d-%m-%Y %H:%i:%s") as created_at',  'a.status'); //set column field database for datatable orderable
        $this->column_search = array('a.question', 'b.type','DATE_FORMAT(a.created_at, "%d-%m-%Y %H:%i:%s")', 'a.status'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'DESC'); // default order 

        $this->db->select($this->column_order);
        $this->db->from($this->question . ' as a');
        $this->db->join($this->insurance_type . ' as b', 'b.id = a.ins_type_id', 'left');
//        $this->db->where(['a.status'=>'0']);
        if ($this->input->post('ins_type_id')) {
            $this->db->where(['a.ins_type_id' => $this->input->post('ins_type_id')]);
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
//        echo $this->db->last_query();        die;
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->select($this->column_order);
        $this->db->from($this->question . ' as a');
        $this->db->join($this->insurance_type . ' as b', 'b.id = a.ins_type_id', 'left');
//         $this->db->where(['a.status'=>'0']);
         if ($this->input->post('ins_type_id')) {
            $this->db->where(['a.ins_type_id' => $this->input->post('ins_type_id')]);
        }
        return $this->db->count_all_results();
    }

    public function Getstatus($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->question);
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
        $this->db->update($this->question, array('status' => $status));
        //echo $this->db->last_query(); die;
        $result = $this->db->affected_rows();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

}
