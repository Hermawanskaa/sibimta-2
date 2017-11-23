<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MahasiswaModel');
    }

    public function validation(){
        if(!$this->session->userdata('is_admin_login')){
            redirect('login','refresh');
        }
    }

    public function index(){
        $this->validation();
        $this->load->view('admin/mahasiswa/mahasiswa_list');
    }

    public function add_mahasiswa()
    {
        $this->validation();
        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('nim', 'nim', 'trim|required|is_unique[mahasiswa.nim]');
            $this->form_validation->set_rules('nama', 'nama', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('no_hp', 'no_hp', 'trim|required|xss_clean|min_length[10]');
            $this->form_validation->set_rules('alamat', 'alamat', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean|min_length[5]');

            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            $upload = 'avatar';
            $foto = preg_replace("/^(.+?);.*$/", "\\1", $_FILES['avatar']['name']);
            $config['upload_path'] = './uploads/foto/mahasiswa/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2000;
            $config['file_name'] = $foto;
            $config['overwrite'] = false;
            $this->load->library('upload', $config);

            if ($this->form_validation->run() == FALSE || (!$this->upload->do_upload($upload) && !empty($_FILES['avatar']['name']))) {
                $data['view'] = 'admin/mahasiswa/mahasiswa_add';
                $this->load->view('admin/mahasiswa/mahasiswa_add', $data);
            } else {

                if (!empty($foto)) {
                    $gambar = $foto;
                } else {
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
                );
                $data = $this->security->xss_clean($data);
                $result = $this->MahasiswaModel->add_mahasiswa($data);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
                    redirect(base_url('admin/mahasiswa/add_mahasiswa'));
                }
            }
        } else {
            $data['view'] = 'admin/mahsiswa/mahasiswa_add';
            $this->load->view('admin/mahasiswa/mahasiswa_add', $data);
        }
    }

    public function edit_mahasiswa($id = 0)
    {
        $this->validation();
        if ($this->input->post('submit')) {
            $this->validation();

            $this->form_validation->set_rules('nama', 'nama', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('no_hp', 'no_hp', 'trim|required|xss_clean|min_length[10]');
            $this->form_validation->set_rules('alamat', 'alamat', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean|min_length[5]');

            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            $upload = 'avatar';
            $foto = preg_replace("/^(.+?);.*$/", "\\1", $_FILES['avatar']['name']);
            $config['upload_path'] = './uploads/foto/mahasiswa/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2000;
            $config['file_name'] = $foto;
            $config['overwrite'] = false;
            $this->load->library('upload', $config);


            if ($this->form_validation->run() == FALSE || (!$this->upload->do_upload($upload) && !empty($_FILES['avatar']['name']))) {
                $data['user'] = $this->MahasiswaModel->get_mahasiswa_by_id($id);
                $data['view'] = 'admin/mahasiswa/mahasiswa_edit';
                $this->load->view('admin/mahasiswa/mahasiswa_edit', $data);
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
                );

                $data = $this->security->xss_clean($data);
                $result = $this->MahasiswaModel->edit_mahasiswa($data, $id);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Diperbaharui !');
                    redirect(base_url('admin/mahasiswa/edit_mahasiwa'));
                }
            }
        } else {
            $data['user'] = $this->MahasiswaModel->get_mahasiswa_by_id($id);
            $data['view'] = 'admin/mahasiswa/mahasiswa_edit';
            $this->load->view('admin/mahasiswa/mahasiswa_edit', $data);
        }
    }

    public function delete_mahasiswa($id = 0)
    {
        $this->validation();
        $this->db->delete('mahasiswa', array('nip' => $id));
        $this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
        redirect(base_url('admin/mahasiswa/list_mahasiswa'));
    }

    public function view_mahasiswa($id = 0)
    {
        $this->validation();
        $data['user'] = $this->MahasiswaModel->get_mahasiswa_by_id($id);
        $data['view'] = 'admin/mahasiswa/mahasiswa_view';
        $this->load->view('admin/mahasiswa/mahasiswa_view', $data);
    }

    public function list_mahasiswa()
    {
        $this->validation();
        $config['base_url'] = site_url('admin/mahasiswa/list_mahasiswa/');
        $config['total_rows'] = $this->MahasiswaModel->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = (!empty($_GET)) ? '?' . http_build_query($_GET, '', "&") : '';
        $config['first_url'] = $config['base_url'] . $config['suffix'];
        $config['query_string_segment'] = 'start';

        $this->pagination->initialize($config);
        $start = $this->uri->segment(4, 0);
        $confirm = $this->MahasiswaModel->index_limit($config['per_page'], $start);
        if ($confirm) {
            $this->data['mahasiswa_data'] = $confirm;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['start'] = $start;

            $this->load->view('admin/mahasiswa/mahasiswa_list', $this->data);
        } else {
            $this->data['pesan_warning'] = 'Data Not Found';
            $this->load->view('admin/mahasiswa/mahasiswa_list', $this->data);
        }
    }

}


?>
