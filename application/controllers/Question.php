<?php

/* Question Controller
 * Author: Arvind Kumar Singh
 * Date: 11-12-2019
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model(array('QuestionModel', 'login_model'));
        $this->load->model('front_model');
        $this->load->helper('front_helper');
    }

    public $question = 'tbl_question';

    public function index() {

        $data = array(
            'title' => 'Question List',
            'result' => $result,
        );


        $this->load->view('front/include/head');
        $this->load->view('front/include/header_dashboard');
        $this->load->view('front/include/sidebar');
//        $this->load->view('front/include/policy_head');
        $this->load->view('front/question/list', $data);
        $this->load->view('front/include/script_foo');
    }

    public function DataList() {
        $list = $this->QuestionModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {
            $no++;

            $row = array();
            $row[] = $no;
            $row[] = $value->question;
            $row[] = $value->instype;
            $row[] = $value->created_at;
            $row[] = ($value->status == '0' ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">In-Active</span>');
            $row[] = '<a class="btn btn-primary btn-xs" data-toggle="tooltip" title="Edit" data-placement="top"  href="question/edit/' . base64_encode($value->id) . '">
                          <i class="fa fa-edit"></i></a> 
                          <span class="btn btn-danger btn-xs del" data-toggle="tooltip" title="Delete" data-placement="top"  data-delete=' . $value->id . '>
                          <i class="fa fa-trash"></i></span>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->QuestionModel->count_all(),
            "recordsFiltered" => $this->QuestionModel->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function Add() {
        $data = array(
            'title' => 'Add Question',
            'result' => $result,
        );


        if ($this->input->post()) {

            foreach ($this->input->post('question') as $val) {
                $dataArray[] = [
                    'company_id' => getCompanyIdByUserId($this->session->userdata('user_id')),
                    'ins_type_id' => $this->input->post('ins_type_id'),
                    'question' => $val,
                    'created_by' => $this->session->userdata('user_id'),
                ];
            }
            $res = $this->db->insert_batch($this->question, $dataArray);
            if ($res) {
                $this->session->set_flashdata('success', 'Question Add Successfully');
                redirect('question');
            } else {
                $this->session->set_flashdata('error', 'Somethong went wrong please try again!');
                redirect('question/add');
            }
        } else {

            $this->load->view('front/include/head');
            $this->load->view('front/include/header_dashboard');
            $this->load->view('front/include/sidebar');
            $this->load->view('front/question/add', $data);
            $this->load->view('front/include/script_foo');
        }
    }

    public function Update($id) {

        if ($this->input->post()) {


            foreach ($this->input->post('question') as $val) {
                $dataArray = [
                    'ins_type_id' => $this->input->post('ins_type_id'),
                    'question' => $val,
                    'updated_by' => $this->session->userdata('user_id'),
                ];
            }
            $res = $this->db->update($this->question, $dataArray, ['id' => $id]);
            //echo $this->db->last_query(); die;

            if ($res) {
                $this->session->set_flashdata('success', 'Question Update Successfully');
                redirect('question');
            } else {
                $this->session->set_flashdata('error', 'Somethong went wrong please try again!');
                redirect('question/edit/' . $this->input->post('id'));
            }
        }
    }

    public function Edit($id) {

        $result = $this->auth_model->getDataCollectionByID($this->question, base64_decode($id));
//        echo '<pre>';
//        print_r($result); die;

        $data = array(
            'title' => 'Edit Question',
            'result' => $result,
        );
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_dashboard');
        $this->load->view('front/include/sidebar');
        $this->load->view('front/question/add', $data);
        $this->load->view('front/include/script_foo');
    }

    public function Ajaxdelete() {
        if ($this->input->post('id')) {
            $status = $this->QuestionModel->getstatus($this->input->post('id'));
            $res = $this->QuestionModel->deletedata($this->input->post('id'), $status);
            if ($res) {
                echo '1';
            } else {
                echo '0';
            }
        }
    }

    public function addQuestionexcel() {
        $this->load->library('excel');

        if ($this->input->post()) {
            $path = APPPATH . 'upload/questions/';
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls';
            $config['remove_spaces'] = TRUE;
            $this->upload->initialize($config);
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('importfile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }

//            echo '<pre>';
//            print_r($data);

            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }

            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
//            echo '<pre>';
//            print_r($allDataInSheet);
            $arrayCount = count($allDataInSheet);
            $flag = 0;
            $createArray = array('Question');
            $makeArray = array('Question' => 'Question');
            $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    } else {
                        
                    }
                }
            }
            $data = array_diff_key($makeArray, $SheetDataKey);

            if (empty($data)) {
                $flag = 1;
            }
            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {
                    $addresses = array();
                    $question = $SheetDataKey['Question'];

                    $question = filter_var(trim($allDataInSheet[$i][$question]), FILTER_SANITIZE_STRING);

                    $fetchData[] = array(
                        'company_id' => getCompanyIdByUserId($this->session->userdata('user_id')),
                        'ins_type_id' => $this->input->post('ins_type_id'),
                        'question' => $question,
                        'created_by' => $this->session->userdata('user_id'),
                    );
                }
//                echo '<pre>';
//                print_r($fetchData);
//                die;

                $res = $this->db->insert_batch($this->question, $fetchData);
                if ($res) {
                    $this->session->set_flashdata('success', 'Question Add Successfully');
                    redirect('question');
                } else {
                    $this->session->set_flashdata('error', 'Somethong went wrong please try again!');
                    redirect('question/add');
                }
            } else {
                echo "Please import correct file";
            }
        } else {
            redirect('dashboard');
        }
    }

}

?>
