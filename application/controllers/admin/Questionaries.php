<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questionaries extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_helper');
		$this->load->helper('string_helper');
	}


	public $payment  = 'tbl_payment';
	public $question = 'tbl_question';
	public $insurance_questionaries = 'tbl_insurance_questionaries';

	public function index() {
		CheckAdminLoginSession();
		$payment_id   = $this->uri->segment(3);
		$payment_data = $this->admin_model->getDataCollectionByID($this->payment,$payment_id);
		$post_data    = $this->input->post();
		if(!empty($post_data)) {
			$questions = $this->input->post('question_id');
			$answers   = $this->input->post('answer');
			$ques_data = array ();

			foreach ($questions as $key => $value) {
				$ques_data[$key]['question_id'] = $value;
			}

			foreach ($answers as $key => $value) {
				$ques_data[$key]['answer']     = $value;
			}

			foreach ($ques_data as $key => $value) {
				$data_to_insert = array (
					'payment_id'  => $payment_id,
					'user_id'     => $payment_data->user_id,
					'question_id' => $value['question_id'],
					'answer'      => $value['answer']
				);
				$this->admin_model->setInsertData($this->insurance_questionaries,$data_to_insert);
			}
			redirect('admin/payment/proceed-to-pay/'.$payment_id);
		}

		$payment_update = array (
			'transaction_id' => random_string('numeric', 5)
		);
		$this->admin_model->setUpdateData($this->payment,$payment_update,$payment_id);
		$data['questionaries_data'] = $this->admin_model->getQuestionariesData($this->question,$payment_data->company_id,$payment_data->insurance_type_id);
		if(empty($data['questionaries_data'])) {
			redirect('admin/payment/proceed-to-pay/'.$payment_id);
		}
		
		$this->load->view('admin/include/head');
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/questionaries/add_questionaries',$data);
		$this->load->view('admin/include/footer');
		$this->load->view('admin/include/foot');
	}

}