<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AdminModel');
    }

    public function validation(){
        if(!$this->session->userdata('is_admin_login')){
            redirect('login','refresh');
        }
    }

    public function index(){
        $this->validation();
        $this->load->view('admin/dashboard');
    }

    public function add_admin(){
        $this->validation();
        if($this->input->post('submit')) {

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

                $foto = preg_replace("/^(.+?);.*$/", "\\1", $_FILES['avatar']['name']);
                $config['upload_path'] = './uploads/foto/admin/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = $foto;
                $config['overwrite'] = false;
                $this->load->library('upload', $config);
                $data['avatar'] = $this->upload->data()['file_name'];


            if ($this->form_validation->run() == FALSE || (!$this->upload->do_upload('avatar')&&!empty($_FILES['avatar']['name']))) {
                $data['view'] = 'admin/admin/admin_add';
                $this->load->view('admin/admin/admin_add', $data);
            } else {
                $data = array(
                    'nip' => $this->input->post('nip'),
                    'nama' => $this->input->post('nama'),
                    'password' => $this->input->post('password'),
                    'no_hp' => $this->input->post('no_hp'),
                    'alamat' => $this->input->post('alamat'),
                    'email' => $this->input->post('email'),
                    'foto' => $foto,
                    'level' => $this->input->post('level'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->AdminModel->add_admin($data);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
                    redirect(base_url('admin/admin/add_admin'));
                }
            }
        }else{
            $data['view'] = 'admin/admin/admin_add';
            $this->load->view('admin/admin/admin_add', $data);
        }
    }

    public function edit_admin($id = 0)
    {
        $this->validation();
        if ($this->input->post('submit')) {
            $this->validation();

            if (!empty($_FILES['avatar']['name'])) {
                $foto = preg_replace("/^(.+?);.*$/", "\\1", $_FILES['avatar']['name']);
                $config['upload_path'] = './uploads/foto/admin/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2000;
                $config['file_name'] = $foto;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('avatar')) {
                    exit($this->upload->display_errors());
                }
                $data['avatar'] = $this->upload->data()['file_name'];
            }
                $this->form_validation->set_rules('nama', 'nama', 'trim|required|xss_clean');
                $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
                $this->form_validation->set_rules('no_hp', 'no_hp', 'trim|required|xss_clean');
                $this->form_validation->set_rules('alamat', 'alamat', 'trim|required|xss_clean');
                $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
                $this->form_validation->set_rules('level', 'level', 'trim|required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    $data['user'] = $this->AdminModel->get_admin_by_id($id);
                    $data['view'] = 'admin/admin/admin_edit';
                    $this->load->view('admin/admin/admin_edit', $data);
                } else {
                    $data = array(
                        'nama' => $this->input->post('nama'),
                        'password' => $this->input->post('password'),
                        'no_hp' => $this->input->post('no_hp'),
                        'alamat' => $this->input->post('alamat'),
                        'email' => $this->input->post('email'),
                        'foto' => $foto,
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

    public function delete_admin($id = 0){
        $this->validation();
        $this->db->delete('admin', array('nip' => $id));
        $this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
        redirect(base_url('admin/admin/list_admin'));
    }

    public function view_admin($id = 0){
        $this->validation();
        $data['user'] = $this->AdminModel->get_admin_by_id($id);
        $data['view'] = 'admin/admin/admin_view';
        $this->load->view('admin/admin/admin_view', $data);

    }

    public function list_admin($offset=0){
        $this->validation();
        $jumlah = $this->db->get('admin');
        $config['base_url'] = base_url() . '/admin/admin/list_admin';
        $config['total_rows'] = $jumlah->num_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
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
        $data['halaman'] = $this->pagination->create_links();
        $data['offset'] = $offset;
        $data['data'] = $this->AdminModel->list_admin($config['per_page'], $offset);
        $this->load->view('admin/admin/admin_list', $data);
    }
}

?>