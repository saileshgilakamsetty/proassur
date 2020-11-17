<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public $users = 'tbl_users';

    public function UserLogin($table, $data) {
        $this->db->where($data);
        $query = $this->db->get($table);
        $rowCount = $query->num_rows();
        if ($rowCount > 0) {
            $result = $query->row();
            $id = $result->id;
            $userdata = array(
                'user_id' => $result->id,
                'name' => $result->first_name . ' ' . $result->last_name,
                'role' => $result->role,
                'email' => $result->email
            );
            if ($result->status == 1) {
                $this->session->set_userdata($userdata);
                return 1;
            } else if ($result->status == 0) {
                return 0;
            }
            /* 			else{				
              return 2;
              } */
        } else {
            return 2;
        }
    }

// get user data by email to send link for reset password
    public function UserForgot($email) {
        // $email = 'utkarsh@sourcesoftsolutions.com';
        $this->db->where('email', $email);
        $query = $this->db->get($this->users);
        $rowCount = $query->num_rows();
        if ($rowCount > 0) {
            $result = $query->row();
            return $result;
        } else {
            return 0;
        }
    }

    public function getDataCollectionByID($table, $id) {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        $result = $query->row_array();
        return $result;
    }

    public function setUpdateData($table, $data, $id) {
        $array = array('id' => $id);
        $this->db->where($array);
        $this->db->update($table, $data);
        return $id;
    }

    public function setInsertData($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    public function insert_entry($user_id,$clientSecret, $firstName, $lastName, $userEmail, $userPassword, $userAddress, $userMobile, $userType, $userStatus) {
        if ($userPassword == null) {
            $changedPassword = null;
        } else {
            $changedPassword = password_hash($userPassword, PASSWORD_BCRYPT); // default cost for BCRYPT to 12
        }
        echo 'dasdsa'; die;
        $this->user_id = $user_id;
        $this->userSecret = $clientSecret;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userEmail = $userEmail;
        $this->userPassword = $changedPassword;
        $this->userAddress = $userAddress;
        $this->userMobile = $userMobile;
        $this->userType = 1;
        $this->userStatus = 1;
        $this->userVerification = 1;
        $this->lastModified = date('Y-m-d G:i:s');
        $this->db->insert("users", $this);
        echo $this->db->last_query();die;
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

}
