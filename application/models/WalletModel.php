<?php

//Author : Arvind Kuamr Singjh
// Date: 17-12-2019


defined('BASEPATH') OR exit('No direct script access allowed');

class WalletModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public $wallet = 'tbl_wallet';
    public $wallet_history = 'tbl_wallet_history';

    public function getdata($id = null) {

        $this->column_order = array('a.id', 'a.amount','CONCAT(b.first_name, " ", b.last_name) AS name', 'DATE_FORMAT(a.created_at, "%d-%m-%Y %H:%i:%s") as created_at', 'a.status'); //set column field database for datatable orderable

        $this->db->order_by('a.id','DESC');
        $this->db->select($this->column_order);
        $this->db->from($this->wallet . ' as a');
        $this->db->join('tbl_users' . ' as b', 'b.id = a.user_id', 'left');
        $query = $this->db->get();
        if($id) {
            $this->db->where('a.user_id',$id);
        }
//        echo $this->db->last_query();        die;
        $result = $query->result();
        if($result){
            return $result;
        } else {
            return array();
        }
    }
    
    public function getHistoryData($id) {

        $this->column_order = array('a.id', 'a.amount','a.summary','CONCAT(b.first_name, " ", b.last_name) AS name', 'DATE_FORMAT(a.created_at, "%d-%m-%Y %H:%i:%s") as created_at', 'a.status'); //set column field database for datatable orderable

        //$this->db->order_by('a.id','DESC');
        $this->db->select($this->column_order);
        $this->db->from($this->wallet_history . ' as a');
        $this->db->join('tbl_users' . ' as b', 'b.id = a.created_by', 'left');
        $this->db->where('wallet_id',$id);
        $query = $this->db->get();
//        echo $this->db->last_query();        die;
        $result = $query->result();
        if($result){
            return $result;
        } else {
            return array();
        }
    }

    public function updateWalletData($table,$data,$id = null) {
        $this->db->where('id',$id);
        $this->db->update($table,$data);
        // echo $this->db->last_query();die;
        return $id;
    }

    public function getWalletDataByUserId($user_id) {
        $this->db->where('user_id',$user_id);
        $this->db->where('status','0');
        $query = $this->db->get('tbl_wallet');
        if($query->num_rows() > 0) {
            $result = $query->row();
        } else {
            $result = '';
        }
        return $result;
    }

}
?>

