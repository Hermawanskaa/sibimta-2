<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->library(array('pagination', 'form_validation', 'upload'));
    }

    public function validation()
    {
        if (!$this->session->userdata('is_admin_login')) {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {
        $this->validation();
        $this->load->view('admin/dashboard');
    }

    public function add_admin()
    {
        $this->validation();
        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('nip', 'nip', 'trim|required|is_unique[admin.nip]');
            $this->form_validation->set_rules('nama', 'nama', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('no_hp', 'no_hp', 'trim|required|xss_clean|min_length[10]');
            $this->form_validation->set_rules('alamat', 'alamat', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean|min_length[5]');
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
                    // No file selected - set default image
                    $gambar = 'anonim.png';
                }
                $data = array(
                    'nip' => $this->input->post('nip'),
                    'nama' => $this->input->post('nama'),
                    'password' => $this->input->post('password'),
                    'no_hp' => $this->input->post('no_hp'),
                    'alamat' => $this->input->post('alamat'),
                    'email' => $this->input->post('email'),
                    'foto' => $gambar,
                    'level' => $this->input->post('level'),
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

    public function edit_admin($id = 0)
    {
        $this->validation();
        if ($this->input->post('submit')) {
            $this->validation();


            $this->form_validation->set_rules('nama', 'nama', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('no_hp', 'no_hp', 'trim|required|xss_clean');
            $this->form_validation->set_rules('alamat', 'alamat', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('level', 'level', 'trim|required|xss_clean');

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
                } else {
                    $gambar = 'anonim.png';
                }

                $data = array(
                    'nama' => $this->input->post('nama'),
                    'password' => $this->input->post('password'),
                    'no_hp' => $this->input->post('no_hp'),
                    'alamat' => $this->input->post('alamat'),
                    'email' => $this->input->post('email'),
                    'foto' => $gambar,
                    'level' => $this->input->post('level'),
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

    public function delete_admin($id = 0)
    {
        $this->validation();
        $this->db->delete('admin', array('nip' => $id));
        $this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
        redirect(base_url('admin/admin/list_admin'));
    }

    public function view_admin($id = 0)
    {
        $this->validation();
        $data['user'] = $this->AdminModel->get_admin_by_id($id);
        $data['view'] = 'admin/admin/admin_view';
        $this->load->view('admin/admin/admin_view', $data);
    }

    public function list_admin()
    {
        $this->validation();
        $config['base_url'] = site_url('admin/admin/list_admin/');
        $config['total_rows'] = $this->AdminModel->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = (!empty($_GET)) ? '?' . http_build_query($_GET, '', "&") : '';
        $config['first_url'] = $config['base_url'] . $config['suffix'];
        $config['query_string_segment'] = 'start';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';

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