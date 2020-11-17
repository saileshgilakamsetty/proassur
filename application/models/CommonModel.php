<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CommonModel extends CI_Model {

    public function paymentMethod($id) {
       
        $this->db->where(['method_id' => $id]);
        $result = $this->db->get('tbl_payment_method')->row();
       // echo  $this->db->last_query(); die;
        if (count($result) > 0) {
            return $result->name;
        } else {
            return FALSE;
        }
    }

}
