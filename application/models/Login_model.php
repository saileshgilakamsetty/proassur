<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
    
    public $users='tbl_users';

    public function check_email() {
		
		$user_email = $this->input->post('useremail');
		$this->db->select('*');
	    $this->db->from($this->users);
		$this->db->where('email',$user_email);
	    $query = $this->db->get();
        if($query->num_rows()>0)
        {
            $data=$query->row_array();
            return $data;
               
        }else{        	            
            return array();
        }
    }

    public function AdminLogin()
	{
	    $login        = $this->input->post();
	    $email        = $login['username']; 
		$password     = md5($login['userpass']);
		$this->db->where('email', $email); 
		$this->db->where('password', $password); 
		$this->db->where_in('role',['1','5']);
		$query = $this->db->get($this->users);
		$rowCount=$query->num_rows();
		if($rowCount>0)	{
			$result=$query->row();
			$id=$result->id;
			$userdata = array(
			'admin_id'    => $result->id,
			'admin_name'    => $result->username,
			'admin_email' => $result->email,
			'admin_role' => $result->role
			);
			$this->session->set_userdata($userdata);
			return true;
		} else {
			return false;
		}
	}





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



	public function getWishlistDataCollection()	{
		$userID = $this->session->userdata('user_id');
		$this->db->select('s.*');
		$this->db->where('w.user_id',$userID);
		$this->db->where('s.status',1);
		$this->db->from('tbl_websites as s');
		$this->db->join('tbl_wishlist as w', 'w.website_id = s.id');
		$query = $this->db->get();
		if($query->num_rows()>0) {
	    	$result = $query->result();
			return $result;
		}
		else { 
				return array();
		}
		
	}

	public function IsUserActive() {
        $email=$this->input->post('username');
	    $this->db->where('email',$email);
	    $query = $this->db->get($this->users);
		$count = $query->num_rows();
	    if($count>0){
		    return true;		
		}
		else{
	    	return false;
	    }
	}
	
}