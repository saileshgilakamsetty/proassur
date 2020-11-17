<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approve extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
	}

	public $selected_premium = 'tbl_selected_premium';
	public $selected_bonus   = 'tbl_selected_bonus';

// get the bonus records for admin to approve 
	public function bonus() {
		CheckAdminLoginSession();
		$per_page            = 20;
        if($this->uri->segment(4)) {
        	$page            = ($this->uri->segment(4)) ;
        }
        else {
        	$page            = 1;
        }

        $company_id 	  = $this->input->get('bonus_company_id');
        $branch_id  	  = $this->input->get('bonus_branch_id');

        $start                  = ($page-1)*$per_page;
        $limit                  = $per_page;
        $totalCount             = $this->admin_model->totalRecord($this->selected_bonus);
		$data["dataCollection"] = $this->admin_model->getDataCollection($this->selected_bonus,$limit,$start);
        $totalResult            = count($data['dataCollection']);
		$data["pagination"]     = Jpagination($totalCount,$limit,$start);
		$url                    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$explodedURL            = parse_url($url);
		$data["current_link"]   = $explodedURL['scheme'].'://'.$explodedURL['host'].$explodedURL['path'];
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/approve/approve_bonus',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}


// function to view the image in a pop-up
	public function view_bonus_image() {
		$url     = $this->input->post('url');
		$result  = '<image class="img-responsive" src="'.$url.'"></image>';
		print_r($result);
	}


// function to approve the bonus by admin
	public function approve() {
		$id             = $this->uri->segment(4);
		$status         = $this->uri->segment(5);
		CheckAdminLoginSession();		
		$data['approved_status'] = $status;				        	             		 
		$this->admin_model->setUpdateData($this->selected_bonus,$data,$id);
		$this->session->set_flashdata('message','Your status has been update successfully');
		redirect('admin/approve/bonus','refresh');	
	}
}