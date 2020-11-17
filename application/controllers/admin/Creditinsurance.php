<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creditinsurance extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}



}