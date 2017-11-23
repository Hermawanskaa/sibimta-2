<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('FakultasModel');
    }

    public function validation(){
        if(!$this->session->userdata('is_admin_login')){
            redirect('login','refresh');

        }
    }

    public function index(){
        $this->validation();
        $this->load->view('admin/fakultas/fakultas_list');
    }

    public function add_fakultas()
    {
        $this->validation();
        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('fak_nama', 'fak_nama', 'trim|required|is_unique[fakultas.fak_nama]');
            $this->form_validation->set_rules('fak_kode', 'fak_kode', 'trim|required|xss_clean|min_length[2]');

            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            if ($this->form_validation->run() == FALSE) {
                $data['view'] = 'admin/fakultas/fakultas_add';
                $this->load->view('admin/fakultas/fakultas_add', $data);
            } else {

                $data = array(
                    'fak_nama' => $this->input->post('fak_nama'),
                    'fak_kode' => $this->input->post('fak_kode'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->AdminModel->add_fakultas($data);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
                    redirect(base_url('admin/fakultas/add_fakultas'));
                }
            }
        } else {
            $data['view'] = 'admin/fakultas/fakultas_add';
            $this->load->view('admin/fakultas/fakultas_add', $data);
        }
    }

    public function edit_fakultas($id = 0)
    {
        $this->validation();
        if ($this->input->post('submit')) {
            $this->validation();
            $this->form_validation->set_rules('fak_id', 'fak_id', 'trim');
            $this->form_validation->set_rules('fak_nama', 'fak_nama', 'trim|required');
            $this->form_validation->set_rules('fak_kode', 'fak_kode', 'trim|required|xss_clean|min_length[2]');

            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            if ($this->form_validation->run() == FALSE) {
                $data['user'] = $this->FakultasModel->get_fakultas_by_id($id);
                $data['view'] = 'admin/fakultas/fakultas_edit';
                $this->load->view('admin/fakultas/fakultas_edit', $data);
            } else {

                $data = array(
                    'fak_nama' => $this->input->post('fak_nama'),
                    'fak_kode' => $this->input->post('fak_kode'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->FakultasModel->edit_fakultas($data, $id);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Diperbaharui !');
                    redirect(base_url('admin/fakultas/edit_fakultas'));
                }
            }
        } else {
            $data['user'] = $this->FakultasModel->get_fakultas_by_id($id);
            $data['view'] = 'admin/fakultas/fakultas_edit';
            $this->load->view('admin/fakultas/fakultas_edit', $data);
        }
    }

    public function delete_fakultas($id = 0)
    {
        $this->validation();
        $this->db->delete('fakultas', array('fak_id' => $id));
        $this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
        redirect(base_url('admin/fakultas/list_fakultas'));
    }

    public function view_fakultas($id = 0)
    {
        $this->validation();
        $data['user'] = $this->FakultasModel->get_fakultas_by_id($id);
        $data['view'] = 'admin/fakultas/fakultas_view';
        $this->load->view('admin/fakultas/fakultas_view', $data);
    }

    public function list_fakultas()
    {
        $this->validation();
        $config['base_url'] = site_url('admin/fakultas/list_fakultas/');
        $config['total_rows'] = $this->FakultasModel->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = (!empty($_GET)) ? '?' . http_build_query($_GET, '', "&") : '';
        $config['first_url'] = $config['base_url'] . $config['suffix'];
        $config['query_string_segment'] = 'start';

        $this->pagination->initialize($config);
        $start = $this->uri->segment(4, 0);
        $confirm = $this->FakultasModel->index_limit($config['per_page'], $start);
        if ($confirm) {
            $this->data['fakultas_data'] = $confirm;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['start'] = $start;

            $this->load->view('admin/fakultas/fakultas_list', $this->data);
        } else {
            $this->data['pesan_warning'] = 'Data Not Found';
            $this->load->view('admin/fakultas/fakultas_list', $this->data);
        }
    }

}

?>