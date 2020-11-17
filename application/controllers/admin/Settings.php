<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public $table = "tbl_settings";
    public $smtp = "tbl_smtp_settings";
    public $static_content = "tbl_static_content";
    public $language = "tbl_language";
    public $miscellaneous = "tbl_miscellaneous";

    function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->helper('admin_helper');
        $this->load->library('excel');
        $this->load->library('csvreader');
    }

    // function for social detail
    public function social() {
        CheckAdminLoginSession();
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('facebook', 'facebook', 'required');
            $this->form_validation->set_rules('twitter', 'twitter', 'required');
            $this->form_validation->set_rules('instagram', 'instagram', 'required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $dataArr['twitter'] = $this->input->post('twitter');
                $dataArr['facebook'] = $this->input->post('facebook');
                $dataArr['instagram'] = $this->input->post('instagram');
                foreach ($dataArr as $key => $value) {
                    $data = array('value' => $value);
                    $this->admin_model->setUpdateSetting($this->table, $data, $key);
                }
                $this->session->set_flashdata('message', 'Your advance settings has been update successfully');
                redirect('admin/settings/social', 'refresh');
            }
        }
        $data['settingsData'] = $this->admin_model->getSettingsDataCollection($this->table);
        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/settings/social', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    // function for miscellaneous
    public function miscellaneous() {
        CheckAdminLoginSession();
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('tax_percent', 'tax_percent', 'required');
            $this->form_validation->set_rules('area_code', 'Area Code', 'required');
            $this->form_validation->set_rules('video_url', 'Video Url', 'required|prep_url');

            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $dataArr['tax_percent'] = $this->input->post('tax_percent');
                $dataArr['area_code'] = $this->input->post('area_code');
                $dataArr['video_url'] = $this->input->post('video_url');

                foreach ($dataArr as $key => $value) {
                    $data = array('value' => $value);
                    $this->admin_model->setUpdateSetting($this->table, $data, $key);
                }
                $this->session->set_flashdata('message', 'Your Miscellaneous settings has been update successfully');
                redirect('admin/settings/miscellaneous', 'refresh');
            }
        }
        $data['settingsData'] = $this->admin_model->getSettingsDataCollection($this->table);
        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/settings/miscellaneous', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    // function for support detail
    public function support() {
        CheckAdminLoginSession();
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('support_email', 'email', 'required|trim');
            $this->form_validation->set_rules('support_contact_code', 'contact code', 'required');
            $this->form_validation->set_rules('support_contact', 'contact', 'required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $dataArr['support_email'] = $this->input->post('support_email');
                $dataArr['support_contact'] = $this->input->post('support_contact');
                $dataArr['support_contact_code'] = $this->input->post('support_contact_code');
                foreach ($dataArr as $key => $value) {
                    $data = array('value' => $value);
                    $this->admin_model->setUpdateSetting($this->table, $data, $key);
                }
                $this->session->set_flashdata('message', 'Your Support settings has been update successfully');
                redirect('admin/settings/support', 'refresh');
            }
        }
        $data['settingsData'] = $this->admin_model->getSettingsDataCollection($this->table);
        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/settings/support', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    // function for smtp detail
    public function smtp() {
        CheckAdminLoginSession();
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="textdanger">', '</span>');
            $this->form_validation->set_rules('smtp_user', ' smtp user', 'required');
            $this->form_validation->set_rules('smtp_pass', 'smtp password', 'required');
            $this->form_validation->set_rules('smtp_host', ' smtp host', 'required');
            $this->form_validation->set_rules('smtp_port', 'smtp port', 'required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $dataArr = array(
                    'smtp_user' => $this->input->post('smtp_user'),
                    'smtp_pass' => $this->input->post('smtp_pass'),
                    'smtp_host' => $this->input->post('smtp_host'),
                    'smtp_port' => $this->input->post('smtp_port')
                );
                foreach ($dataArr as $key => $value) {
                    $data = array('value' => $value);
                    $this->admin_model->setUpdateSetting($this->smtp, $data, $key);
                }
                $this->session->set_flashdata('message', 'Your smtp settings has been update successfully');
                redirect('admin/settings/smtp', 'refresh');
            }
        }
        $data['smtpData'] = $this->admin_model->getSettingsDataCollection($this->smtp);
        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/settings/smtp', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    //function for advance settings
    public function advance() {
        CheckAdminLoginSession();
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('currency', 'currency', 'required');

            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $dataArr = array(
                    'currency' => $this->input->post('currency')
                );
                foreach ($dataArr as $key => $value) {
                    $data = array('value' => $value);
                    $this->admin_model->setUpdateSetting($this->table, $data, $key);
                }
                $this->session->set_flashdata('message', 'Your Advance settings has been update successfully');
                redirect('admin/settings/advance', 'refresh');
            }
        }
        $data = '';
        $data['advanceData'] = $this->admin_model->getSettingsDataCollection($this->table);
        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/settings/advance', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    //function for advance settings
    public function static_content() {
        CheckAdminLoginSession();
        $search_content = $this->input->post('search_content');
        $per_page = 10;
        if ($this->uri->segment(4)) {
            $page = ($this->uri->segment(4));
        } else {
            $page = 1;
        }

        $start = ($page - 1) * $per_page;
        $limit = $per_page;
        if (!empty($search_content)) {
            $totalCount = $this->admin_model->totalRecordSearchContent($this->static_content, $search_content);
            $data["dataCollection"] = $this->admin_model->getDataCollectionSearchContent($this->static_content, $limit, $start, $search_content);
            $totalResult = count($data['dataCollection']);
        } else {
            $totalCount = $this->admin_model->totalRecord($this->static_content);
            $data["dataCollection"] = $this->admin_model->getDataCollection($this->static_content, $limit, $start);
        }
        $totalResult = count($data['dataCollection']);
        $data["pagination"] = Jpagination($totalCount, $limit, $start);
        //$data['dataCollection'] = $this->admin_model->getDataCollection($this->static_content);
        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/static_content/content', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    public function edit_content() {
        CheckAdminLoginSession();
        $id = $this->uri->segment(4);
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('description', 'description', 'required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $data['description'] = $this->input->post('description');
                // $data['language_id']    = $this->input->post('language_id');           
                $this->admin_model->setUpdateData($this->static_content, $data, $id);
                $this->session->set_flashdata('message', 'Your Content has been update successfully');
                redirect('admin/settings/static_content', 'refresh');
            }
        }
        $data = [];
        
        $data['dataCollection'] = $this->admin_model->getDataCollectionByID($this->static_content, $id);
        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/static_content/edit_content', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    public function add_content() {
        CheckAdminLoginSession();
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('language_id', 'Language', 'required|trim');
            $this->form_validation->set_rules('description', 'Description', 'required');
            if ($this->form_validation->run() == FALSE) {
                
            } else {

                for ($i = 1; $i <= 2; $i++) {
                    $data['name'] = $this->input->post('name');
                    $data['description'] = $this->input->post('description');
                    $data['language_id'] = $i;
                    $this->admin_model->setInsertData($this->static_content, $data);
                }
                $this->session->set_flashdata('message', 'Your Content has been update successfully');
                redirect('admin/settings/static_content', 'refresh');
            }
        }
        $data = '';
        $data['dataCollection'] = $this->admin_model->getDataCollectionByID($this->static_content);
        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/static_content/add_content', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    public function language() {
        CheckAdminLoginSession();
        $per_page = 10;
        if ($this->uri->segment(4)) {
            $page = ($this->uri->segment(4));
        } else {
            $page = 1;
        }

        $start = ($page - 1) * $per_page;
        $limit = $per_page;
        $totalCount = $this->admin_model->totalRecord($this->language);
        $data["dataCollection"] = $this->admin_model->getDataCollection($this->language, $limit, $start);
        $totalResult = count($data['dataCollection']);
        $data["pagination"] = Jpagination($totalCount, $limit, $start);

        //$data['dataCollection'] = $this->admin_model->getDataCollection($this->static_content);
        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/language', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

// function to change the status of a language
    public function language_status() {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        CheckAdminLoginSession();
        $data['status'] = $status;
        $this->admin_model->setUpdateData($this->language, $data, $id);
        $this->session->set_flashdata('message', 'Your status has been update successfully');
        redirect('admin/settings/language', 'refresh');
    }

// function to change the default language
    public function default_lang() {
        CheckAdminLoginSession();
        $id = $this->uri->segment(4);
        $datainfo = $this->admin_model->getLanguageCollection($this->language);
        foreach ($datainfo as $nid) {
            $data1['default'] = '';
            $this->admin_model->setUpdateData($this->language, $data1, $nid->id);
        }
        $data['default'] = 'active';
        $this->admin_model->setUpdateData($this->language, $data, $id);
        $this->session->set_flashdata('message', 'Your language status has been change successfully');
        redirect('admin/settings/language', 'refresh');
    }

// function to change the default language
    public function setDefaultLanguage() {
        // CheckAdminLoginSession();
        $id = $this->input->post('language_id');
        echo $id;


        $datainfo = $this->admin_model->getLanguageCollection($this->language);
        foreach ($datainfo as $nid) {
            $data1['default'] = '';
            $this->admin_model->setUpdateData($this->language, $data1, $nid->id);
        }
        $data['default'] = 'active';
        $this->admin_model->setUpdateData($this->language, $data, $id);
        echo true;
        return true;
    }

// functio to save the record of xls vehicules_commercialises_europe
    public function xls() {
        $data = '';
        $post_data = $this->input->post();
        // print_r($_FILES);die;
        if (!empty($post_data)) {
            if ($_FILES["image"]["name"] != "") {
                $image = do_upload('xls_upload', 'image');
                // print_r($image);
                // die();
                $file = $image;
                $fileData = explode("\n", strtolower(file_get_contents($file)));
                $tempArr = array();

                unset($fileData[0]);
                unset($fileData[1]);
                foreach ($fileData as $key => $val) {
                    if (!empty($val)) {
                        $tempArr[] = array_map('trim', str_getcsv($val));
                    }
                }

                $i = 0;
                foreach ($tempArr as $name) {
                    if (!empty($name[5])) {
                        echo "<br>";
                        // print_r($name);
                        isExists($name[0], 'make');
                        isExists($name[2], 'model');
                        isExists($name[3], 'designation', $name[0]);
                        // isExists($name[5],'tvv');
                        if ($name[7] == 'non hybride') {
                            $hybrid = 0;
                        } else {
                            $hybrid = 1;
                        }
                        isExists($name[6], 'fuel_type');
                        $vehicle_data = array(
                            'make_id' => getIdForName($name[0], 'tbl_vehicle_make'),
                            'designation_id' => getIdForName($name[3], 'tbl_vehicle_designation'),
                            'tvv' => $name[5],
                            'fuel_type_id' => getIdForName($name[6], 'tbl_fuel_type'),
                            'hybrid' => $hybrid,
                            'fiscal_power' => $name[8],
                            'horse_power' => $name[9],
                            'status' => 1,
                            'created_date' => date('Y-m-d H:i:s'),
                            'modified_date' => date('Y-m-d H:i:s')
                        );
                        if (!tvvExists($name[5], 'tbl_vehicle')) {
                            $this->db->insert('tbl_vehicle', $vehicle_data);
                        }
                        // print_r($vehicle_data);
                        // saveVehicleData($name[0],$name[2],$name[3],$name[5],$name[6]);
                        // isExists($name[5],'tvv');
                        // isExists($name,$arrayName[$i])
                        $i++;
                    }
                }
            }
        }

        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/xls_upload', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    public function view_policies() {
        CheckAdminLoginSession();
        $per_page = 20;
        if ($this->uri->segment(4)) {
            $page = ($this->uri->segment(4));
        } else {
            $page = 1;
        }

        $start = ($page - 1) * $per_page;
        $limit = $per_page;
        if(!empty($_GET['policy_creation_date'])) {
            $policyno_array = $this->admin_model->getPolicyByCreationDate($_GET['policy_creation_date']);
            $policy_nos     = implode(',',$policyno_array);
        }
        $totalCount         = $this->admin_model->getPolicyListCount($policy_nos);
        $data['dataCollection'] = $this->admin_model->getPolicyList($limit,$start,$policy_nos);
        $totalResult        = count($data['dataCollection']);
        $data["pagination"] = Jpagination($totalCount, $limit, $start);
        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/view_policies_list', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    public function pay_cash() {
        $id = $this->uri->segment(4);
        CheckAdminLoginSession();
        $data['payment_status'] = 2;
        $data['payment_method'] = 3;
        $this->admin_model->setUpdateData('tbl_payment', $data, $id);
        $this->session->set_flashdata('message', 'Your Payment has been Done successfully');
        redirect('admin/settings/view_policies', 'refresh');
    }

    public function pay_by_cheque() {
        $id = $this->uri->segment(4);
        CheckAdminLoginSession();
        if(!empty($_FILES)) {
            $image = single_file_upload('policy_cheque',$_FILES['image']);
            $data['policy_cheque'] = $image;
            $data['payment_status'] = 2;
            $updated_id = $this->admin_model->setUpdateData('tbl_payment',$data,$id);
            if($updated_id > 0) {
                $this->session->set_flashdata('message', 'Your Payment has been Done successfully');
                redirect('admin/settings/view_policies', 'refresh');
            }
        }
        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/manage_cheque_payment', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }


        // function to download the file in quittance folder
    public function download_file() {
        if (!empty($_GET['file'])) {
            $fileName = basename($_GET['file']);
            $filePath = APPPATH.'upload/policy_cheque/' . $fileName;
            if (!empty($fileName) && file_exists($filePath)) {
                // Define headers
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$fileName");
                header("Content-Type: application/zip");
                header("Content-Transfer-Encoding: binary");

                // Read the file
                readfile($filePath);
                exit;
            } else {
                echo 'The file does not exist.';
            }
        }
    }

    // function to download payment receipt
    public function download_payment_receipt() {
        $id = $this->uri->segment(4);
        CheckAdminLoginSession();
        // echo $id;   
        $data['payment_data'] = $this->admin_model->getDataCollectionByID('tbl_payment',$id);
        print_r($data['payment_data']);
        $this->load->view('admin/payment_receipt',$data);
    }

    // function added to delete a policy
    public function delete_policy($id) {
        CheckAdminLoginSession();
        $id             = $this->uri->segment(4);
        $data_to_delete = $this->admin_model->dataDelete('tbl_payment',$id);
        if($data_to_delete) {
            $this->session->set_flashdata('message','Your Policy has been deleted successfully');
            redirect('admin/settings/view_policies','refresh');
        }
    }

}
