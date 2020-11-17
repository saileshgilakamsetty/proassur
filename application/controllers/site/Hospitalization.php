<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hospitalization extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('front_model');
        $this->load->helper('front_helper');
    }

    public $hospitalization           = 'tbl_hospitalization';
    public $hospitalization_documents = 'tbl_hospitalization_documents';

    public function basic_info() {
        CheckLoginSession();

        $this->load->view('front/include/head');
        $this->load->view('front/include/header_aftr_login');
        $this->load->view('front/hospitalization/basic_info');
        $this->load->view('front/include/footer');
        $this->load->view('front/include/foo');
    }

    public function policy_number_submit() {
        CheckLoginSession();
        $post_data = $this->input->post();
        if(!empty($post_data)) {
            $policy_number = $this->input->post('hospitalizationn_policy_number');
            $policy_numbercheck = checkUniquePolicyNumber($policy_number);
            if($policy_numbercheck > 0) {
                $payment_data   = $this->front_model->getDataCollectionArrayByID('tbl_payment',$policy_numbercheck);
                $data_to_insert = array (
                    'policy_holder_name_id' => $policy_numbercheck,
                    'insurance_company_id'  => $payment_data['company_id'],
                    'policy_number'         => $policy_number,
                    'created_by'            => $this->session->userdata('role'),
                    'status'                => 1,
                    'approved_status'       => 0
                );
                $id = $this->front_model->setInsertData($this->hospitalization,$data_to_insert);
                if($id > 0) {
                    redirect('hospitalization/contact-details/'.$id,'refresh');
                }
            } else {
                $this->session->set_flashdata('message',HOSPITALIZATION_POLICY_NUMBER_MESSAGE);
                redirect('hospitalization','refresh');
            }
        }   
    }


    public function policy_holder_info_submit() {
        CheckLoginSession();
        $post_data = $this->input->post();
        if(!empty($post_data)) {
            $data_to_insert = array (
                'policy_holder_name_id' => $this->input->post('policy_holder_name'),
                'insurance_company_id'  => $this->input->post('insurance_company_id'),
                'policy_number'         => $this->input->post('hospitalization_policy_number'),
                'created_by'            => $this->session->userdata('role'),
                'status'                => 1,
                'approved_status'       => 0
            );
            $id = $this->front_model->setInsertData($this->hospitalization,$data_to_insert);
            if($id > 0) {
                redirect('hospitalization/contact-details/'.$id,'refresh');
            }

        }
    }

    // function added by Shiv
    public function contact_details() {
        CheckLoginSession();
        $hospitalization_id = $this->uri->segment(3);
        $post_data          = $this->input->post();
        if(!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('the_patient_name',' Patient Name', 'required|trim');
            $this->form_validation->set_rules('contact_number',' Contact Number', 'required|trim|numeric');
            if($this->form_validation->run() == FALSE) { } else {
                $data_to_update = array (
                    'the_patient_name'  => $this->input->post('the_patient_name'),
                    'contact_dial_code' => $this->input->post('contact_dial_code'),
                    'contact_number'    => $this->input->post('contact_number')
                );
                $update_id = $this->front_model->setUpdateData($this->hospitalization,$data_to_update,$hospitalization_id);
                if($update_id > 0) {
                    redirect('hospitalization/other-details/'.$update_id,'refresh');
                }
            }
        }
        $data['hospitalization'] = $this->front_model->getDataCollectionArrayByID($this->hospitalization,$hospitalization_id);
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_aftr_login');
        $this->load->view('front/hospitalization/contact_details',$data);
        $this->load->view('front/include/footer');
        $this->load->view('front/include/foo');
    }

    // function added by Shiv
    public function other_details() {
        CheckLoginSession();
        $hospitalization_id = $this->uri->segment(3);
        $post_data = $this->input->post();
        if(!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('healthcareprovider_name_id', ' Healthcare Provider Name', 'required|trim');
            $this->form_validation->set_rules('provider_contact_number', ' Provider Contact Number', 'required|trim');
            $this->form_validation->set_rules('description', ' Description', 'required');
            $this->form_validation->set_rules('provider_person_name', ' Provider Person Name', 'required');
            $this->form_validation->set_rules('provider_address', ' Provider Address', 'required');
            if (empty($_FILES['images']['name'][0])) {
                $this->form_validation->set_rules('images', 'Document', 'required');
            }
            if($this->form_validation->run() == FALSE) { } else {
                $data_to_update = array (
                    'healthcareprovider_name_id' => $this->input->post('healthcareprovider_name_id'),
                    'provider_person_name'       => $this->input->post('provider_person_name'),
                    'dial_code'                  => $this->input->post('dial_code'),
                    'provider_contact_number'    => $this->input->post('provider_contact_number'),
                    'provider_address'           => $this->input->post('provider_address'),
                    'country'                    => $this->input->post('country'),
                    'state'                      => $this->input->post('state'),
                    'city'                       => $this->input->post('city'),
                    //'postal_code'                  => $post_data['postal_code'],
                    'latitude'                   => $this->input->post('latitude'),
                    'longitude'                  => $this->input->post('longitude'),
                    'description'                => $this->input->post('description')
                );
                $update_id = $this->front_model->setUpdateData($this->hospitalization,$data_to_update,$hospitalization_id);
                if($update_id > 0) {
                    $images = multiple_files_upload('hospitalization',$_FILES["images"]);
                    if(!array_key_exists('error', $images)) {
                        foreach ($images as $key => $value) {
                            $data_to_insert = array (
                                'hospitalization_id' => $update_id,
                                'document'           => $value
                            );
                            $this->front_model->setInsertData($this->hospitalization_documents,$data_to_insert);
                        }
                    }   
                }
                $this->session->set_flashdata('message','Your Hospitalization has been added successfully');
                redirect('dashboard','refresh');
            }
        }
        $data['hospitalization'] = $this->front_model->getDataCollectionArrayByID($this->hospitalization,$hospitalization_id);
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_aftr_login');
        $this->load->view('front/hospitalization/other_details',$data);
        $this->load->view('front/include/footer');
        $this->load->view('front/include/foo');
    }

    public function approve_status() {
        $post_data = $this->input->post();
        if(!empty($post_data)) {
            $hospitalization_id = $this->input->post('hospitalization_id');
            if(!empty($_FILES)) {
                $image = single_file_upload('hospitalization',$_FILES['image']);
                $data['company_document'] = $image;
                $data['approved_status']  = 1;
                $update_id = $this->front_model->setUpdateData($this->hospitalization,$data,$hospitalization_id);
                if($update_id > 0) {
                    $message = 'Hospitalization has been approved successfully';
                    $this->session->set_flashdata('message',$message);
                    redirect('user/hospitalization_approval','refresh');
                }
            }
        }
    }

    // function added by Shiv
    function getCompanyid() {
        $payment_id   = $this->input->post('id');
        $payment_data = json_decode($this->front_model->getDataCollectionByID('tbl_payment',$payment_id));
        $result = json_encode(array (
            'company_id'    => $payment_data->company_id,
            'policy_number' => $payment_data->policy_number
        ));
        print_r($result);
    }

}