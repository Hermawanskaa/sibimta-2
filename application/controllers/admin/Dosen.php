<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

    public $data = array(
        'view' => 'dosen_list',
        'title' => 'List Dosen',
        'link' => 'admin/dosen/dosen_list'
    );

    public function __construct() {
        parent::__construct();
        $this->load->model('DosenModel');

    }

    public function validation(){
        if(!$this->session->userdata('is_admin_login')){
            redirect('login','refresh');

        }
    }

    public function index(){
        $this->validation();
        $this->load->view('admin/dosen/dosen_list');
    }

    public function add_dosen()
    {
        $this->validation();
        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('nip', 'NIP', 'trim|required|is_unique[dosen.dsn_nip]');
            $this->form_validation->set_rules('nama', 'NAMA', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('password', 'PASSWORD', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('no_hp', 'NOMOR HP', 'trim|required|xss_clean|min_length[10]');
            $this->form_validation->set_rules('alamat', 'ALAMAT', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|xss_clean|min_length[5]');


            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            $upload = 'avatar';
            $foto = preg_replace("/^(.+?);.*$/", "\\1", $_FILES['avatar']['name']);
            $config['upload_path'] = './uploads/foto/dosen/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2000;
            $config['file_name'] = $foto;
            $config['overwrite'] = false;
            $this->load->library('upload', $config);

            if ($this->form_validation->run() == FALSE || (!$this->upload->do_upload($upload) && !empty($_FILES['avatar']['name']))) {
                $data['view'] = 'admin/dosen/dosen_add';
                $this->load->view('admin/dosen/dosen_add', $data);
            } else {

                if (!empty($foto)) {
                    $gambar = $foto;
                } else {
                    $gambar = 'anonim.png';
                }
                $data = array(
                    'dsn_nip' => $this->input->post('nip'),
                    'dsn_nama' => $this->input->post('nama'),
                    'dsn_password' => $this->input->post('password'),
                    'dsn_nohp' => $this->input->post('no_hp'),
                    'dsn_alamat' => $this->input->post('alamat'),
                    'dsn_email' => $this->input->post('email'),
                    'dsn_foto' => $gambar,
                );
                $data = $this->security->xss_clean($data);
                $result = $this->DosenModel->add_dosen($data);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
                    redirect(base_url('admin/dosen/add_dosen'));
                }
            }
        } else {
            $data['view'] = 'admin/dosen/dosen_add';
            $this->load->view('admin/dosen/dosen_add', $data);
        }
    }

    public function edit_dosen($id = 0)
    {
        $this->validation();
        if ($this->input->post('submit')) {
            $this->validation();

            $this->form_validation->set_rules('nama', 'NAMA', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('password', 'PASSWORD', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('no_hp', 'NOMOR HP', 'trim|required|xss_clean|min_length[10]');
            $this->form_validation->set_rules('alamat', 'ALAMAT', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|xss_clean|min_length[5]');

            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            $upload = 'avatar';
            $foto = preg_replace("/^(.+?);.*$/", "\\1", $_FILES['avatar']['name']);
            $config['upload_path'] = './uploads/foto/dosen/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2000;
            $config['file_name'] = $foto;
            $config['overwrite'] = false;
            $this->load->library('upload', $config);


            if ($this->form_validation->run() == FALSE || (!$this->upload->do_upload($upload) && !empty($_FILES['avatar']['name']))) {
                $data['user'] = $this->DosenModel->get_dosen_by_id($id);
                $data['view'] = 'admin/dosen/dosen_edit';
                $this->load->view('admin/dosen/dosen_edit', $data);
            } else {
                if (!empty($foto)) {
                    $gambar = $foto;
                } else {
                    $gambar = 'anonim.png';
                }

                $data = array(
                    'dsn_nama' => $this->input->post('nama'),
                    'dsn_password' => $this->input->post('password'),
                    'dsn_nohp' => $this->input->post('no_hp'),
                    'dsn_alamat' => $this->input->post('alamat'),
                    'dsn_email' => $this->input->post('email'),
                    'dsn_foto' => $gambar,
                );

                $data = $this->security->xss_clean($data);
                $result = $this->DosenModel->edit_dosen($data, $id);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Diperbaharui !');
                    redirect(base_url('admin/dosen/edit_dosen'));
                }
            }
        } else {
            $data['user'] = $this->DosenModel->get_dosen_by_id($id);
            $data['view'] = 'admin/dosen/dosen_edit';
            $this->load->view('admin/dosen/dosen_edit', $data);
        }
    }

    public function delete_dosen($id = 0)
    {
        $this->validation();
        $this->db->delete('dosen', array('dsn_nip' => $id));
        $this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
        redirect(base_url('admin/dosen/list_dosen'));
    }

    public function view_dosen($id = 0)
    {
        $this->validation();
        $data['user'] = $this->DosenModel->get_dosen_by_id($id);
        $data['view'] = 'admin/dosen/dosen_view';
        $this->load->view('admin/dosen/dosen_view', $data);
    }

    public function list_dosen()
    {
        $this->validation();
        $config['base_url'] = site_url('admin/dosen/list_dosen/');
        $config['total_rows'] = $this->DosenModel->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = (!empty($_GET)) ? '?' . http_build_query($_GET, '', "&") : '';
        $config['first_url'] = $config['base_url'] . $config['suffix'];
        $config['query_string_segment'] = 'start';

        $this->pagination->initialize($config);
        $start = $this->uri->segment(4, 0);
        $confirm = $this->DosenModel->index_limit($config['per_page'], $start);
        if ($confirm) {
            $this->data['dosen_data'] = $confirm;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['start'] = $start;

            $this->load->view('admin/dosen/dosen_list', $this->data);
        } else {
            $this->data['pesan_warning'] = 'Data Not Found';
            $this->load->view('admin/dosen/dosen_list', $this->data);
        }
    }

}


?>