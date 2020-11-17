<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet extends CI_Controller {

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
        $this->load->model(array('admin_model', 'WalletModel'));
        $this->load->helper('admin_helper');
    }

    public $wallet = 'tbl_wallet';

    public function index() {
        CheckAdminLoginSession();
        $data['result'] = $this->WalletModel->getData();

        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/wallet/list', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    public function add($id = NULL) {
        CheckAdminLoginSession();
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('user_id', 'Partner Name', 'required');
            $this->form_validation->set_rules('amount', 'Wallet Amount', 'required|trim|numeric');
            // $this->form_validation->set_rules('wallet_money', 'Wallet Money', 'is_unique[tbl_company.email]|trim|valid_email');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $wallet_info = array(
                    'user_id' => $this->input->post('user_id'),
                    'amount' => $this->input->post('amount'),
                );
                if ($id) {
                    $old_wallet = $this->db->get_where('tbl_wallet', ['id' => $id])->row();
                    if ($old_wallet->amount > $this->input->post('amount')) {
                        $summary = $old_wallet->amount - $this->input->post('amount');
                        $status = '1';
                    } else {
                        $summary = $this->input->post('amount') - $old_wallet->amount;
                        $status = '0';
                    }

                    $wallet_history = [
                        'wallet_id' => $id,
                        'user_id' => $old_wallet->user_id,
                        'amount' => $this->input->post('amount'),
                        'summary' => $summary,
                        'created_by' => $this->session->userdata('admin_id'),
                        'status' => $status,
                    ];
                    $this->admin_model->setInsertData('tbl_wallet_history', $wallet_history);

                    $sArray = array(
                        'updated_by' => $this->session->userdata('admin_id'),
                    );
                    $msg = 'Wallet has been update successfully';
                    $DataArray = array_merge($wallet_info, $sArray);
                    $res = $this->admin_model->setUpdateData($this->wallet, $DataArray, $id);
                } else {

                    $sArray = array(
                        'created_by' => $this->session->userdata('admin_id'),
                    );
                    $msg = 'Wallet has been add successfully';
                    $DataArray = array_merge($wallet_info, $sArray);
                    $res = $this->admin_model->setInsertData($this->wallet, $DataArray);


                    $wallet_history = [
                        'wallet_id' => $res,
                        'user_id' => $this->input->post('user_id'),
                        'amount' => $this->input->post('amount'),
                        'summary' => $this->input->post('amount'),
                        'created_by' => $this->session->userdata('admin_id'),
                        'status' => '0',
                    ];
                    $this->admin_model->setInsertData('tbl_wallet_history', $wallet_history);
                }

                if ($res) {
                    $this->session->set_flashdata('success', $msg);
                    redirect('admin/wallet', 'refresh');
                }
            }
        }
        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/wallet/add');
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    public function edit($id) {
        CheckAdminLoginSession();
        $data['result'] = $this->admin_model->getDataCollectionById($this->wallet, $id);


        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/wallet/add', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    public function History($id) {
        CheckAdminLoginSession(); //
        $data['result'] = $this->WalletModel->getHistoryData($id);

        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/wallet/history', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    public function delete($id) {
        $data = $this->admin_model->getDataCollectionById($this->wallet, $id);
       
        if ($data->status == 0) {
            $status = '1';
        } else if ($data->status == 1) {
            $status = '0';
        }
        
        $this->db->update($this->wallet, ['status' => $status], ['id' => $id]);
//       echo $this->db->last_query();        die;
        $this->session->set_flashdata('success', 'Wallet delete successfully!');
        redirect('admin/wallet', 'refresh');
    }

}
