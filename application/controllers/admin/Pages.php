<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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
        $this->load->model('admin_model');
        $this->load->helper('admin_helper');
    }

    public $pages = 'tbl_pages';

    public function add() {

        CheckAdminLoginSession();
        
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('name', ' Name', 'required|trim');
            $this->form_validation->set_rules('langusge_id', ' Langusge', 'required|trim');
            $this->form_validation->set_rules('description', 'Description', 'required|trim');

            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $slug_str = $this->input->post('name');
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
                $data = array(
                    'slug' => $slug,
                    'name' => $this->input->post('name'),
                    'langusge_id' => $this->input->post('langusge_id'),
                    'description' => $this->input->post('description'),
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_key' => $this->input->post('meta_key'),
                    'created' => date('Y-m-d H:i:s'),
                    'status' => $this->input->post('status'),
                    'meta_description' => $this->input->post('meta_description')
                );
                $id = $this->admin_model->setInsertData($this->pages, $data);
                if ($_FILES["featured_img"]["name"] != "") {
                    $featured_img = do_upload('page', 'featured_img');
                    $data_featured_img = array('featured_img' => $featured_img);
                    $this->admin_model->setUpdateData($this->pages, $data_featured_img, $id);
                }
                $this->session->set_flashdata('message', 'Your pages has been added successfully');
                redirect('admin/pages/lists', 'refresh');
            }
        }

        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/pages/add');
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    public function edit() {
        $id = $this->uri->segment(4);
        CheckAdminLoginSession();
        $post_data = $this->input->post();
        //print_r($post_data);
        if (!empty($post_data)) {
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            $this->form_validation->set_rules('name', ' Name', 'required|trim');
            $this->form_validation->set_rules('langusge_id', ' Langusge', 'required|trim');
            $this->form_validation->set_rules('description', 'Description', 'required|trim');

            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $slug_str = $this->input->post('name');
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_str)));
                $data = array(
                    'slug' => getNewSlug($id, $slug, $this->pages),
                    'name' => $this->input->post('name'),
                    'langusge_id' => $this->input->post('langusge_id'),
                    'description' => $this->input->post('description'),
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_key' => $this->input->post('meta_key'),
                    'status' => $this->input->post('status'),
                    'meta_description' => $this->input->post('meta_description')
                );
                $id = $this->admin_model->setUpdateData($this->pages, $data, $id);
                if ($_FILES["image"]["name"] != "") {
                    $image = do_upload('page', 'image');
                    $data_featured_img = array('featured_img' => $image);
                    $this->admin_model->setUpdateData($this->pages, $data_featured_img, $id);
                }
                $this->session->set_flashdata('message', 'Your pages has been update successfully');
                redirect('admin/pages/lists', 'refresh');
            }
        }
        $data['dataCollection'] = $this->admin_model->getDataCollectionByID($this->pages, $id);
        $data['id'] = $this->uri->segment(4);
        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/pages/edit', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    public function lists() {
        CheckAdminLoginSession();
        $per_page = 20;
        if ($this->uri->segment(4)) {
            $page = ($this->uri->segment(4));
        } else {
            $page = 1;
        }

        $start = ($page - 1) * $per_page;
        $limit = $per_page;
        $totalCount = $this->admin_model->totalRecord($this->pages);
        $data["dataCollection"] = $this->admin_model->getDataCollection($this->pages, $limit, $start);
        $totalResult = count($data['dataCollection']);
        $data["pagination"] = Jpagination($totalCount, $limit, $start);
        $this->load->view('admin/include/head');
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/pages/list', $data);
        $this->load->view('admin/include/footer');
        $this->load->view('admin/include/foot');
    }

    public function delete() {
        CheckAdminLoginSession();
        $id = $this->uri->segment(4);
        $this->admin_model->dataDelete($this->pages, $id);
        $this->session->set_flashdata('message', 'Your pages has been deleted successfully');
        redirect('admin/pages/lists', 'refresh');
    }

    public function status() {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        CheckAdminLoginSession();
        $data['status'] = $status;
        $this->admin_model->setUpdateData($this->pages, $data, $id);
        $this->session->set_flashdata('message', 'Your status has been update successfully');
        redirect('admin/pages/lists', 'refresh');
    }

    public function getDataCollectionBySlug($table, $request) {
        $this->db->select('name,description');
        $this->db->where('slug', $request->slug);
        $query = $this->db->get($table);
        $countRow = $query->num_rows();
        if ($countRow > 0) {
            $result = $query->row_array();
            return $result;
        } else {
            return array();
        }
    }

}
