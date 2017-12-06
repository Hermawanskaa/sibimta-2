<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->library(array('pagination', 'form_validation', 'upload'));
    }

    public function validation(){
        if (!$this->session->userdata('is_admin_login')) {
            redirect('login', 'refresh');
        }
    }

    public function index(){
        $this->validation();
        $this->load->view('admin/admin/admin_list');
    }

    public function add_admin(){
        $this->validation();
        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('nip', 'NIP', 'trim|required|is_unique[admin.adm_nip]');
            $this->form_validation->set_rules('nama', 'NAMA', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('password', 'PASSWORD', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('no_hp', 'NOMOR HP', 'trim|required|xss_clean|min_length[10]');
            $this->form_validation->set_rules('alamat', 'ALAMAT', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|xss_clean|min_length[5]');

            $this->form_validation->set_rules('level', 'level', 'trim|required|xss_clean');
            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            $upload = 'avatar';
            $foto = preg_replace("/^(.+?);.*$/", "\\1", $_FILES['avatar']['name']);
            $config['upload_path'] = './uploads/foto/admin/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2000;
            $config['file_name'] = $foto;
            $config['overwrite'] = false;
            $this->load->library('upload', $config);

            if ($this->form_validation->run() == FALSE || (!$this->upload->do_upload($upload) && !empty($_FILES['avatar']['name']))) {
                $data['view'] = 'admin/admin/admin_add';
                $this->load->view('admin/admin/admin_add', $data);
            } else {

                if (!empty($foto)) {
                    $gambar = $foto;
                } else {
                    $gambar = 'anonim.png';
                }
                $data = array(
                    'adm_nip' => $this->input->post('nip'),
                    'adm_nama' => $this->input->post('nama'),
                    'adm_password' => $this->input->post('password'),
                    'adm_nohp' => $this->input->post('no_hp'),
                    'adm_alamat' => $this->input->post('alamat'),
                    'adm_email' => $this->input->post('email'),
                    'adm_foto' => $gambar,
                    'adm_level' => $this->input->post('level'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->AdminModel->add_admin($data);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
                    redirect(base_url('admin/admin/add_admin'));
                }
            }
        } else {
            $data['view'] = 'admin/admin/admin_add';
            $this->load->view('admin/admin/admin_add', $data);
        }
    }

    public function edit_admin($id = 0){
        $this->validation();
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('nama', 'NAMA', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('password', 'PASSWORD', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('no_hp', 'NOMOR HP', 'trim|required|xss_clean|min_length[10]');
            $this->form_validation->set_rules('alamat', 'ALAMAT', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|xss_clean|min_length[5]');

            $this->form_validation->set_rules('level', 'level', 'trim|required|xss_clean');
            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            $upload = 'avatar';
            $foto = preg_replace("/^(.+?);.*$/", "\\1", $_FILES['avatar']['name']);
            $config['upload_path'] = './uploads/foto/admin/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2000;
            $config['file_name'] = $foto;
            $config['overwrite'] = false;
            $this->load->library('upload', $config);

            if ($this->form_validation->run() == FALSE || (!$this->upload->do_upload($upload) && !empty($_FILES['avatar']['name']))) {
                $data['user'] = $this->AdminModel->get_admin_by_id($id);
                $data['view'] = 'admin/admin/admin_edit';
                $this->load->view('admin/admin/admin_edit', $data);
            } else {
                if (!empty($foto)) {
                    $gambar = $foto;
                }else{
                    $gambar = 'anonim.png';
                }
                $data = array(
                    'adm_nama' => $this->input->post('nama'),
                    'adm_password' => $this->input->post('password'),
                    'adm_nohp' => $this->input->post('no_hp'),
                    'adm_alamat' => $this->input->post('alamat'),
                    'adm_email' => $this->input->post('email'),
                    'adm_foto' => $gambar,
                    'adm_level' => $this->input->post('level'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->AdminModel->edit_admin($data, $id);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Diperbaharui !');
                    redirect(base_url('admin/admin/edit_admin'));
                }
            }
        } else {
            $data['user'] = $this->AdminModel->get_admin_by_id($id);
            $data['view'] = 'admin/admin/admin_edit';
            $this->load->view('admin/admin/admin_edit', $data);
        }
    }

    public function delete_admin($id = 0){
        $this->validation();
        $this->db->delete('admin', array('adm_nip' => $id));
        $this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
        redirect(base_url('admin/admin/list_admin'));
    }

    public function view_admin($id = 0){
        $this->validation();
        $data['user'] = $this->AdminModel->get_admin_by_id($id);
        $data['view'] = 'admin/admin/admin_view';
        $this->load->view('admin/admin/admin_view', $data);
    }

    public function list_admin(){
        $this->validation();
        $config['base_url'] = site_url('admin/admin/list_admin/');
        $config['total_rows'] = $this->AdminModel->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = (!empty($_GET)) ? '?' . http_build_query($_GET, '', "&") : '';
        $config['first_url'] = $config['base_url'] . $config['suffix'];
        $config['query_string_segment'] = 'start';

        $this->pagination->initialize($config);
        $start = $this->uri->segment(4, 0);
        $confirm = $this->AdminModel->index_limit($config['per_page'], $start);
        if ($confirm) {
            $this->data['admin_data'] = $confirm;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['start'] = $start;

            $this->load->view('admin/admin/admin_list', $this->data);
        } else {
            $this->data['pesan_warning'] = 'Data Not Found';
            $this->load->view('admin/admin/admin_list', $this->data);
        }
    }
}

?>