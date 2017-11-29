<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('JurusanModel');
        $this->load->model('FakultasModel');
    }

    public function validation(){
        if(!$this->session->userdata('is_admin_login')){
            redirect('login','refresh');

        }
    }

    public function index(){
        $this->validation();
        $this->load->view('admin/jurusan/jurusan_list');
    }

    public function add_jurusan(){
        $this->validation();
        $data['fakultas'] = $this->FakultasModel->get_fakultas();

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('jrs_nama', 'NAMA JURUSAN', 'trim|required|is_unique[jurusan.jrs_nama]');
            $this->form_validation->set_rules('jrs_kode', 'KODE JURUSAN', 'trim|required|xss_clean|min_length[2]');
            $this->form_validation->set_rules('fak_id', 'FAKULTAS', 'trim|required');

            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            if ($this->form_validation->run() == FALSE) {
                $data['view'] = 'admin/jurusan/jurusan_add';
                $this->load->view('admin/jurusan/jurusan_add', $data);
            } else {
                $data = array(
                    'jrs_nama' => $this->input->post('jrs_nama'),
                    'jrs_kode' => $this->input->post('jrs_kode'),
                    'fak_id' => $this->input->post('fak_id'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->JurusanModel->add_jurusan($data);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
                    redirect(base_url('admin/jurusan/add_jurusan'));
                }
            }
        } else {
            $data['view'] = 'admin/jurusan/jurusan_add';
            $this->load->view('admin/jurusan/jurusan_add', $data);
        }
    }

    public function edit_jurusan($id = 0){
        $this->validation();
        $data['fakultas'] = $this->FakultasModel->get_fakultas();

        if ($this->input->post('submit')) {
            $this->validation();
            $this->form_validation->set_rules('jrs_id', 'jrs_id', 'trim');
            $this->form_validation->set_rules('jrs_nama', 'NAMA JURUSAN', 'trim|required');
            $this->form_validation->set_rules('jrs_kode', 'KODE JURUSAN', 'trim|required|xss_clean|min_length[2]');
            $this->form_validation->set_rules('fak_id', 'fakultas', 'trim|required');

            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            if ($this->form_validation->run() == FALSE) {
                $data['user'] = $this->JurusanModel->get_jurusan_by_id($id);
                $data['view'] = 'admin/jurusan/jurusan_edit';
                $this->load->view('admin/jurusan/jurusan_edit', $data);
            } else {

                $data = array(
                    'jrs_nama' => $this->input->post('jrs_nama'),
                    'jrs_kode' => $this->input->post('jrs_kode'),
                    'fak_id' => $this->input->post('fak_id'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->JurusanModel->edit_jurusan($data, $id);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Diperbaharui !');
                    redirect(base_url('admin/jurusan/edit_jurusan'));
                }
            }
        } else {
            $data['user'] = $this->JurusanModel->get_jurusan_by_id($id);
            $data['view'] = 'admin/jurusan/jurusan_edit';
            $this->load->view('admin/jurusan/jurusan_edit', $data);
        }
    }

    public function delete_jurusan($id = 0){
        $this->validation();
        $this->db->delete('jurusan', array('jrs_id' => $id));
        $this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
        redirect(base_url('admin/jurusan/list_jurusan'));
    }

    public function view_jurusan($id = 0){
        $this->validation();
        $data['user'] = $this->JurusanModel->get_jurusan_by_id($id);
        $data['view'] = 'admin/jurusan/jurusan_view';
        $this->load->view('admin/jurusan/jurusan_view', $data);
    }

    public function list_jurusan(){
        $this->validation();
        $config['base_url'] = site_url('admin/jurusan/list_jurusan/');
        $config['total_rows'] = $this->JurusanModel->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = (!empty($_GET)) ? '?' . http_build_query($_GET, '', "&") : '';
        $config['first_url'] = $config['base_url'] . $config['suffix'];
        $config['query_string_segment'] = 'start';

        $this->pagination->initialize($config);
        $start = $this->uri->segment(4, 0);
        $confirm = $this->JurusanModel->index_limit($config['per_page'], $start);
        if ($confirm) {
            $this->data['jurusan_data'] = $confirm;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['start'] = $start;

            $this->load->view('admin/jurusan/jurusan_list', $this->data);
        } else {
            $this->data['pesan_warning'] = 'Data Not Found';
            $this->load->view('admin/jurusan/jurusan_list', $this->data);
        }
    }
}

?>