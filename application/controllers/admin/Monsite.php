<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Monsite extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->helper('admin_helper');
        $this->load->helper('string_helper');
        include APPPATH . 'third_party/monsite/monsite/index.php';
    }

    public $payment = 'tbl_payment';

    public function index() {

    }
}