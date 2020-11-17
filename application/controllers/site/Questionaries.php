<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questionaries extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('front_model');
		$this->load->model('login_model');
		$this->load->helper('front_helper');
		$this->load->helper('string_helper');
	}

	public $payment  = 'tbl_payment';
	public $question = 'tbl_question';
	public $insurance_questionaries = 'tbl_insurance_questionaries';

	public function index() {
		CheckLoginSession();
		$payment_id   = $this->uri->segment(2);
		$payment_data = json_decode($this->front_model->getDataCollectionByID($this->payment,$payment_id));
			
		$post_data = $this->input->post();
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
				$this->front_model->setInsertData($this->insurance_questionaries,$data_to_insert);
			}
			redirect('payment/proceed-to-pay/'.$payment_id);
		}

		$payment_update = array (
			'transaction_id' => random_string('numeric', 5)
		);
		$this->front_model->setUpdateData($this->payment,$payment_update,$payment_id);
		$data['questionaries_data'] = $this->front_model->getQuestionariesData($this->question,$payment_data->company_id,$payment_data->insurance_type_id);
	
		if(empty($data['questionaries_data'])) {
			redirect('payment/proceed-to-pay/'.$payment_id);
		}

		$this->load->view('front/include/head');
		$this->load->view('front/include/header_aftr_login');
		$this->load->view('front/questionaries/add_questionaries',$data);
		$this->load->view('front/include/footer');
		$this->load->view('front/include/foo');
	}
}