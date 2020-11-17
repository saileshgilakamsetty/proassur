<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
    
    public $users='tbl_users';


    public function setUpdateData($table, $data, $id) {
		$array = array('id' => $id);
		$this->db->where($array);  
		$this->db->update($table, $data);
		return $id;
	}
    
    public function setInsertData($table, $data){
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}



	
}