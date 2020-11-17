<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
	public $tbl_users           = 'tbl_users';
	public $tbl_pages           = 'tbl_pages';
	public $tbl_risque          = 'tbl_risque';
	public $tbl_policy          = 'tbl_policy';
	public $tbl_branch          = 'tbl_branch';
	public $tbl_company         = 'tbl_company';


	public function index() {
		CheckAdminLoginSession();
		$data['dataUserCollection']       = $this->admin_model->totalActiveUserRecord($this->tbl_users);
		$data['dataCompanyCollection']       = $this->admin_model->totalActiveRecord($this->tbl_company);
		$data['dataPagesCollection']      = $this->admin_model->totalActiveRecord($this->tbl_pages);
		$data['dataRisqueCollection']     = $this->admin_model->totalActiveRecord($this->tbl_risque);
		// $data['dataPolicyCollection']     = $this->admin_model->totalActiveRecord($this->tbl_policy);
		$data['dataBranchCollection']     = $this->admin_model->totalActiveRecord($this->tbl_branch);
		$data['recentUserDataCollection'] = $this->admin_model->getRecentDataUserCollection($this->tbl_users,5);

		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/dashboard',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}
}