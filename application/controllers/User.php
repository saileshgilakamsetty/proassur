<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
        $this->load->model('auth_model');
        $this->load->model(array('TransactionModel', 'login_model','Hospitalizationmodel','Hospitalizationapprovalmodel','CompanyTransactionModel','InsuranceSettingsModel','CompanyQuittancesModel'));
        $this->load->model('front_model');
        $this->load->helper('front_helper');
    }

    public $users = 'tbl_users';
    public $quittance = 'tbl_quittance';
    public $payment = 'tbl_payment';

    function profile() {
        $user_id = $this->session->userdata('user_id');
        $post_data = $this->input->post();
        // print_r($post_data);
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim');
            $this->form_validation->set_rules('address', 'Address', 'required|trim');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');

            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name'  => $this->input->post('last_name'),
                    'email'      => $this->input->post('email'),
                    'address'    => $this->input->post('address'),
                    'mobile'     => $this->input->post('mobile')
                );
                if ($_FILES["image"]["name"] != "") {
                    // echo $_FILES["image"]["name"];
                    $image = do_upload('user', 'image');
                    if (!$image) {
                        $this->session->set_flashdata('message', 'Your Profile has been updated successfully');
                    } else {
                        $data['image'] = $image;
                        $id = $this->front_model->setUpdateData('tbl_users', $data, $user_id);
                        $this->session->set_flashdata('message', 'Your Profile has been updated successfully');
                        redirect('user/profile', 'refresh');
                    }
                    // die();
                    // $data_featured_img = array('image' => $image );
                    // $this->admin_model->setUpdateData($this->users,$data_featured_img,$user_id);
                }
            }
        }
        $dataCollection['user_data'] = getUserDetailByUserId($user_id);
        if (getUserRoleIdByUserId($user_id) == 3) {
            $record = getPartnerCommissionShareByUserId($user_id);
            $dataCollection['partner_commission'] = getPartnerCommissionShareByUserId($user_id);
        }
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_dashboard');
        $this->load->view('front/include/sidebar');
        $this->load->view('front/include/policy_head');
        $this->load->view('front/users/profile', $dataCollection);
        $this->load->view('front/include/script_foo');
    }

    function report() {
        
        $insurance_type_id = $this->uri->segment(3);
        $insured_id = $this->uri->segment(4);
        
        $this->load->library('ciqrcode');
        CheckUserLoginSession();

            $data['img_url'] = "";
        
            $qr_image = rand() . '.png';
           // $params['data'] = base_url('user/downloadReport/'.$insurance_type_id.'/'. $insured_id);
            $params['data'] = base_url("user/downloadReport/".$insurance_type_id.'/'. $insured_id);
            $params['level'] = 'H';
            $params['size'] = 8;
            $params['savename'] = FCPATH . "upload/qr_image/" . $qr_image;
            if ($this->ciqrcode->generate($params)) {
//                echo $qr_image;
                 // echo '<img src='.base_url("upload/qr_image/".$qr_image).'>';
                 $data['qrcode'] = $qr_image;
            }
            //die;
        
        // $data = '';
        $user_id = $this->session->userdata('user_id');
        
        $data['payment_data'] = getPaymentData($insurance_type_id, $insured_id);
        $data['insurance_type_id'] = $this->uri->segment(3);
        $data['insured_id'] = $this->uri->segment(4);
        $this->load->view('front/include/head');
        $this->load->view('front/report', $data);
        $this->load->view('front/include/script_foo');
    }
    public function downloadReport(){
         $this->load->library('ciqrcode');
         $data['img_url'] = "";
        
            $qr_image = rand() . '.png';
             $params['data'] = base_url("user/downloadReport/".$insurance_type_id.'/'. $insured_id);
            $params['level'] = 'H';
            $params['size'] = 8;
            $params['savename'] = FCPATH . "upload/qr_image/" . $qr_image;
            if ($this->ciqrcode->generate($params)) {
//                echo $qr_image;
                 // echo '<img src='.base_url("upload/qr_image/".$qr_image).'>';
                 $data['qrcode'] = $qr_image;
            }
            //die;
        
        // $data = '';
        $user_id = $this->session->userdata('user_id');
        $insurance_type_id = $this->uri->segment(3);
        $insured_id = $this->uri->segment(4);
        $data['payment_data'] = getPaymentData($insurance_type_id, $insured_id);
        $data['insurance_type_id'] = $this->uri->segment(3);
        $data['insured_id'] = $this->uri->segment(4);
        $html =  $this->load->view('front/report', $data,true); 
        
        $data = [];        
        
        $pdfFilePath = date('dmYhis').".pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->SetHeader('Proassur is the one-stop destnition of all your insurance needs');
        $this->m_pdf->pdf->setFooter('{DATE j-m-Y} Page: {PAGENO}');
        $this->m_pdf->pdf->WriteHTML($html);
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");

    }



    // function added by Shiv to manage policies for the user of role partner
    function policies_management() {
        $user_data = $this->session->userdata();
        $data['user_role'] = $user_data['role'];
        //$data['user_policies'] = getUserPolicyRecord($this->quittance,$this->payment,$user_data);
        // $data['user_policies'] = getPartnerPolicyRecord($user_data);
        $data['policies'] = $this->front_model->getPartnerPolicyList($user_data, 'all');
        $data['active_policies']  = $this->front_model->getPartnerPolicyList($user_data, 'active');
        $data['expired_policies'] = $this->front_model->getPartnerPolicyList($user_data, 'expired');
        $data['paid_policies']    = $this->front_model->getPartnerPolicyList($user_data, 'paid');
        $data['unpaid_policies']  = $this->front_model->getPartnerPolicyList($user_data, 'unpaid');
        // die;
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_dashboard');
        $this->load->view('front/include/sidebar', $data);
        $this->load->view('front/include/policy_head', $data);
        $this->load->view('front/users/partner_policies_management', $dataCollection);
        $this->load->view('front/include/script_foo');
    }

    // function added by Shiv for policy claim management
    public function claim_policy() {
        $payment_id = $this->uri->segment(3);
        $policy = json_decode($this->front_model->getDataCollectionByID($this->payment, $payment_id));
        $mgtArray = [
            'policy_id'     => '',
            'customer_id'   => $policy->user_id,
            'company_id'    => $policy->company_id,
            'policy_number' => $policy->policy_number,
            'total_premium' => $policy->total_estimation,
            'total'         => $policy->amount,
            'created_by'    => $policy->policy_created_by,
        ];
        $this->auth_model->setInsertData('tbl_policy_mgt', $mgtArray);
//        echo '<pre>';
//        print_r($mgtArray);
//        die;

        $companyUser_id = getUserIdByCompanyId($policy->company_id);
        $userArray      = ['7', $policy->user_id, $companyUser_id];
        $gname          = $this->db->get_where('im_group', ['name' => $policy->policy_number])->row();

        if (empty($gname)) {

            $dataArray = array(
                'name'       => $policy->policy_number,
                'createdBy'  => 7,
                'type'       => 0,
                'block'      => 0,
                'lastActive' => date('Y-m-d H:i:s')
            );

            $id = $this->auth_model->setInsertData('im_group', $dataArray);
            if ($id > 0) {
                foreach ($userArray as $key => $val) {
                    $this->auth_model->setInsertData('im_group_members', ['g_id' => $id, 'u_id' => $val]);
                }

                $m_id = $this->auth_model->setInsertData('im_message', [
                    'sender'        => 7,
                    'receiver'      => $id,
                    'message'       => 'Welcome to the group',
                    'type'          => 'text',
                    'receiver_type' => 'group',
                    'date'          => date('Y-m-d'),
                    'time'          => date('H:i:s'),
                    'date_time'     => date('Y-m-d H:i:s'),
                ]);
            }
            foreach ($userArray as $key => $val) {
                if ($key != 7) {
                    $this->auth_model->setInsertData('im_receiver', [
                        'g_id'      => $id,
                        'm_id'      => $m_id,
                        'r_id'      => $val,
                        'received'  => 0,
                        'time'      => date('Y-m-d H:i:s'),
                    ]);
                }
            }
        }
        redirect('http://' . $_SERVER['HTTP_HOST'] . '/chat/');
    }

    // Payment Management for End User and Partner
    public function manage_transaction() {
        CheckUserLoginSession();
        $user_data         = $this->session->userdata();
        $data['user_role'] = $user_data['role'];
        //$data['payments']  = $this->front_model->getPolicyPaymentForPartner($user_data['user_id']);
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_dashboard');
        $this->load->view('front/include/sidebar', $data);
        $this->load->view('front/users/partner_transaction_management', $data);
        $this->load->view('front/include/foo');
    }

    // Payment Management for Company
    public function manage_payment() {
        CheckUserLoginSession();
        $user_data         = $this->session->userdata();
        $data['user_role'] = $user_data['role'];
        if($data['user_role'] == 4) {
            $this->session->set_userdata('company_id',getCompanyIdByUserId($user_data['user_id']));
        } else {
            $this->session->unset_userdata('company_id');
        }
        //$data['payments']  = $this->front_model->getPolicyPaymentForPartner($user_data['user_id']);
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_dashboard');
        $this->load->view('front/include/sidebar', $data);
        $this->load->view('front/users/company_transaction_management', $data);
        $this->load->view('front/include/foo');
    }



    public function transactionList() {
        $list = $this->TransactionModel->get_datatables();
        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $value) {
            $no++;

            $row   = array();
            $row[] = $no;
            $row[] = $value->amount;
            $row[] = $value->method_name;
            $row[] = $value->ins_type;
            $row[] = $value->created_at;
            $row[] = '<a href="'.base_url("user/download_payment_receipt/".$value->id).'" data-toggle="tooltip" title="Download" class="btn btn-primary btn-xs"><i class="fa fa-download" aria-hidden="true"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->TransactionModel->count_all(),
            "recordsFiltered" => $this->TransactionModel->count_filtered(),
            "data"            => $data,
        );
        //output to json format
        echo json_encode($output);
    }



    public function company_transactionList() {
        $list = $this->CompanyTransactionModel->get_datatables();
        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $value) {
            $no++;

            $row   = array();
            $row[] = $no;
            $row[] = $value->amount;
            $row[] = $value->method_name;
            $row[] = $value->ins_type;
            $row[] = $value->created_at;
            $row[] = '<a href="'.base_url("user/download_payment_receipt/".$value->id).'" data-toggle="tooltip" title="Download" class="btn btn-primary btn-xs"><i class="fa fa-download" aria-hidden="true"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->CompanyTransactionModel->count_all(),
            "recordsFiltered" => $this->CompanyTransactionModel->count_filtered(),
            "data"            => $data,
        );
        //output to json format
        echo json_encode($output);
    }



    public function company_insurance_settingsList() {
        $list = $this->InsuranceSettingsModel->get_datatables();
        foreach ($list as $key => $value) {
            $optional_warranties = $this->front_model->getOptionalWarranties($value->company_id,$value->branch_id,$value->risque_id);
            if(!empty($optional_warranties)) {
                foreach ($optional_warranties as $keyy => $vallue) {
                    $result[$keyy] = getWarrantyName($vallue->warranty_name_id);
                }    
                $value->optional_warranties = implode(',',$result);
            } else {
                $value->optional_warranties = 'Not Available';
            }
            
            // echo implode(',',$value->optional_warranties);
        }
        $data = array();


        $no   = $_POST['start'];
        foreach ($list as $value) {
            $no++;

            $row   = array();
            $row[] = $no;
            $row[] = $value->optional_warranties;
            $row[] = $value->total_amount;
            $row[] = $value->admin_policy_commission;
            $row[] = ($value->policy_creater_name)?$value->policy_creater_name:'Not Available';
            $data[] = $row;
        }
        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->InsuranceSettingsModel->count_all(),
            "recordsFiltered" => $this->InsuranceSettingsModel->count_filtered(),
            "data"            => $data,
        );
        //output to json format
        echo json_encode($output);
    }


        

    public function test() {
        echo $this->CommonModel->paymentMethod(1);
    }


    // function added by Shiv to manage hospitalization

    public function hospitalization_management() {
        CheckUserLoginSession();
        $user_data         = $this->session->userdata();
        $data['user_role'] = $user_data['role'];
        //$data['hospitalization'] = $this->front_model->getHospitalizationData($user_data['role']);
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_dashboard');
        $this->load->view('front/include/sidebar', $data);
        $this->load->view('front/users/hospitalization_management', $data);
        $this->load->view('front/include/foo');
    }


    // function added by Shiv to show the hospitalization data for end user and partners
    public function hospitalizationList() {
        //echo "string"; die;
        $list = $this->Hospitalizationmodel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {
            // print_r($value);
            $no++;
            // $policy_holder_data = getPolicyHolderData($value->policy_holder_name_id);
            // $user_name          = getUserName($policy_holder_data->user_id);
            $row   = array();
            $row[] = $no;
            $row[] = $value->user_name;
            $row[] = $value->policy_number;
            $row[] = $value->company_name;
            $row[] = $value->the_patient_name;
            $row[] = $value->healthcareprovidername;
            if($value->approved_status) {
                $row[] = '<a title="" href="javascript:void();" data-toggle="tooltip" data-placement="left" class="label-default label label-success">'.getContentLanguageSelected('APPROVED',defaultSelectedLanguage()).'</a>';
                $row[] = '<a href="'.base_url('user/download_file?file='.$value->company_document).'" data-toggle="tooltip" title="Download Company Document" class="btn btn-primary btn-xs"><i class="fa fa-download" aria-hidden="true"></i></a>'. " ".

                    '<a href="'.base_url('user/hospitalization_report/'.$value->id).'" target = "_blank" data-toggle="tooltip" title="Preview Report" class="btn btn-primary btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></a>'. " ".

                    '<a href="'.base_url('user/download_hospitalization_report/'.$value->id).'" target = "_blank" data-toggle="tooltip" title="Download Report" class="btn btn-primary btn-xs"><i class="fa fa-download" aria-hidden="true"></i></a>';
            } else {
                $row[] = '<a title="" href="javascript:void();" data-toggle="tooltip" data-placement="left" class="label-default label label-danger">NOT_APPROVED</a>';
                $row[] = '<a title="" href="javascript:void();" data-toggle="tooltip" data-placement="left" class="label-default label label-success">'.getContentLanguageSelected('NO_ACTION_REQUIRED',defaultSelectedLanguage()).'</a>';
            }
            
            // $row[] = ($value->approved_status)?'APPROVED':'NOT_APPROVED';

            $data[] = $row;
        }
        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Hospitalizationmodel->count_all(),
            "recordsFiltered" => $this->Hospitalizationmodel->count_filtered(),
            "data"            => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    // function added by Shiv for hospitalization approval
    public function hospitalization_approval() {
        $user_data         = $this->session->userdata();
        $data['user_role'] = $user_data['role'];
        //$data['hospitalization'] = $this->front_model->getHospitalizationData($user_data['role']);
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_dashboard');
        $this->load->view('front/include/sidebar', $data);
        $this->load->view('front/users/hospitalization_approval', $data);
        $this->load->view('front/include/foo');
    }


    // function added by Shiv to get the hospitalization data to be approved for companies
    public function hospitalizationApprovalList() {
        //echo "string"; die;
        $list = $this->Hospitalizationapprovalmodel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {
            $no++;
            $row   = array();
            $row[] = $no;
            $row[] = $value->user_name;
            $row[] = $value->policy_number;
            $row[] = $value->the_patient_name;
            $row[] = $value->healthcareprovidername;
            if($value->approved_status) {
                $row[] = '<a title="" href="javascript:void();" data-toggle="tooltip" data-placement="left" class="label-default label label-success">APPROVED</a>';
                $row[] = '<a title="" href="javascript:void();" data-toggle="tooltip" data-placement="left" class="label-default label label-success">NO_ACTION_REQUIRED</a>';
            } else {
                $row[] = '<a title="" href="javascript:void();" data-toggle="tooltip" data-placement="left" class="label-default label label-danger">NOT_APPROVED</a>';
                $row[] = '<a href="#" data-toggle="modal" onclick = "test('.$value->id.')" data-target="#hospitalization_approval" title="Upload Document" class="btn btn-primary btn-xs upload_company_document"><i class="fa fa-upload" aria-hidden="true"></i></a>';
            }
            
            $data[] = $row;
        }
        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Hospitalizationapprovalmodel->count_all(),
            "recordsFiltered" => $this->Hospitalizationapprovalmodel->count_filtered(),
            "data"            => $data,
        );
        //output to json format
        echo json_encode($output);
    }




    // function added by Shiv to get the Card Details for an user

    public function card_details($policy_number = null) {
        if(!empty($policy_number)) {
            $data['card_details'] = getInsuranceCardDetails(decrypt($policy_number)); 
            if(!empty($data['card_details'])) { 
                $html =  $this->load->view('front/users/card_details', $data,true);
                $data = [];        
                
                $pdfFilePath = date('dmYhis').".pdf";
                $this->load->library('m_pdf');
                $this->m_pdf->pdf->SetHeader('Proassur is the one-stop destnition of all your insurance needs');
                $this->m_pdf->pdf->setFooter('{DATE j-m-Y} Page: {PAGENO}');
                $this->m_pdf->pdf->WriteHTML($html);
                $this->m_pdf->pdf->Output($pdfFilePath, "I");
            } else {
                echo ACCESS_DENIED;
            }
        } else {
            echo ACCESS_DENIED;
        }
    }


    // function to download the file in quittance folder
    public function download_file() {
        if (!empty($_GET['file'])) {
            $fileName = basename($_GET['file']);
            $filePath = APPPATH.'upload/hospitalization/' . $fileName;
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



    // function added by Shiv to view the Hospitalzation Report
    public function hospitalization_report() {
        $hospitalization_id      = $this->uri->segment(3);
        $data['hospitalization'] = getHospitalizationDataForReport($hospitalization_id);
        $this->load->view('front/include/head');
        $this->load->view('front/users/hospitalization_report', $data);
        $this->load->view('front/include/script_foo');
    }


    // function added by Shiv to download the Hospitalization Report
    public function download_hospitalization_report() {
        $user_id = $this->session->userdata('user_id');
        $hospitalization_id      = $this->uri->segment(3);
        $data['hospitalization'] = getHospitalizationDataForReport($hospitalization_id);
        $html = $this->load->view('front/users/hospitalization_report', $data,true);
        $data = [];        
        $pdfFilePath = date('dmYhis').".pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->SetHeader('Proassur is the one-stop destnition of all your insurance needs');
        $this->m_pdf->pdf->setFooter('{DATE j-m-Y} Page: {PAGENO}');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }


    // function added by Shiv 
    public function insurance_settings() {
        CheckUserLoginSession();
        $user_data         = $this->session->userdata();
        $data['user_role'] = $user_data['role'];
        if($data['user_role'] == 4) {
            $this->session->set_userdata('company_id',getCompanyIdByUserId($user_data['user_id']));
        } else {
            $this->session->unset_userdata('company_id');
        }
        $company_id = getCompanyIdByUserId($user_data['user_id']);
        $data['insurance_settings'] = $this->front_model->getInsuranceSettingsDataForCompany($company_id);
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_dashboard');
        $this->load->view('front/include/sidebar', $data);
        $this->load->view('front/users/company_insurance_settings', $data);
        $this->load->view('front/include/foo');
    }
    
    
    // function added by Shiv to view the Hospitalzation Report
    public function company_quittances() {
        $user_data         = $this->session->userdata();
        $data['user_role'] = $user_data['role'];
        if($data['user_role'] == 4) {
            $this->session->set_userdata('company_id',getCompanyIdByUserId($user_data['user_id']));
        } else {
            $this->session->unset_userdata('company_id');
        }
        // $hospitalization_id      = $this->uri->segment(3);
        // $data['hospitalization'] = getHospitalizationDataForReport($hospitalization_id);
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_dashboard');
        $this->load->view('front/include/sidebar', $data);
        $this->load->view('front/users/company_quittances', $data);
        $this->load->view('front/include/foo');
    }
    
    public function company_quittancesList() {
        $list = $this->CompanyQuittancesModel->get_datatables();
        $data = array();
        // print_r($list);

        $no   = $_POST['start'];
        foreach ($list as $value) {
            $no++;

            $row   = array();
            $row[] = $no;
            $row[] = getUserName($value->user_id);
            $row[] = $value->policy_number;
            $row[] = (getBranchName($value->branch_id))?getBranchName($value->branch_id):'Not Available';
            $row[] = (getRisqueName($value->risque_id))?getRisqueName($value->risque_id):'Not Available';
            $row[] = $value->amount;
            $row[] = $value->tax;
            $row[] = $value->accessories;
            $row[] = date('d M, Y',strtotime($value->policy_creation_date));
            $row[] = $value->admin_policy_commission;
            $row[] = $value->total_amount;
            // $row[] = $value->insurance_type_id;
            $row[] = '<a href="'.base_url('user/report/'.$value->insurance_type_id.'/'.$value->insured_id).'" target = "_blank" data-toggle="tooltip" title="Preview Report" class="btn btn-primary btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></a>';

            $row[] = '<a href="'.base_url('user/downloadReport/'.$value->insurance_type_id.'/'.$value->insured_id).'" target = "_blank" data-toggle="tooltip" title="Download Report" class="btn btn-primary btn-xs"><i class="fa fa-download" aria-hidden="true"></i></a>';
            

            // $row[] = ($value->policy_creater_name)?$value->policy_creater_name:'Not Available';
            $data[] = $row;
        }
        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->CompanyQuittancesModel->count_all(),
            "recordsFiltered" => $this->CompanyQuittancesModel->count_filtered(),
            "data"            => $data
        );
        //output to json format
        echo json_encode($output);
    }
	
	// function to get all the quittances for a specific company
    public function all_company_quittancesList() { 
        $user_data         = $this->session->userdata();
        $data['user_role'] = $user_data['role'];

        if($data['user_role'] == 4) {
            $this->session->set_userdata('company_id',getCompanyIdByUserId($user_data['user_id']));
        } else {
            $this->session->unset_userdata('company_id');
        }
        $data['list'] = $this->CompanyQuittancesModel->get_datatables();
        $this->load->view('front/include/head');
        $this->load->view('front/include/header_dashboard');
        $this->load->view('front/include/sidebar', $data);
        $this->load->view('front/users/print_all_company_quittances', $data);
        $this->load->view('front/include/foo');
    }



    // function added by Shiv to download payment receipt 
    public function download_payment_receipt() {
        $id   = $this->uri->segment(3);
        $data['payment_data'] = json_decode($this->front_model->getDataCollectionByID('tbl_payment',$id));
        $html = $this->load->view('front/users/payment_receipt',$data,true);
        $data = [];        
        $pdfFilePath = date('dmYhis').".pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->SetHeader('Proassur is the one-stop destnition of all your insurance needs');
        $this->m_pdf->pdf->setFooter('{DATE j-m-Y} Page: {PAGENO}');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }
    
}



    
