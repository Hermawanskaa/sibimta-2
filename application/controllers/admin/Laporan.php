<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LaporanModel');
    }

    public function validation(){
        if(!$this->session->userdata('is_admin_login')){
            redirect('login','refresh');
        }
    }

    public function index(){
        $this->validation();
        $this->load->view('admin/laporan/laporan_list');
    }

    public function add_laporan(){
        $this->validation();
        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('katlap_kategori', 'Kategori Laporan', 'trim|required');
            $this->form_validation->set_message('required', '%s tidak boleh kosong');

            if ($this->form_validation->run() == FALSE) {
                $data['view'] = 'admin/laporan/laporan_add';
                $this->load->view('admin/laporan/laporan_add', $data);
            } else {
                $data = array(
                    'katlap_kategori' => $this->input->post('katlap_kategori'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->LaporanModel->add_laporan($data);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
                    redirect(base_url('admin/laporan/add_laporan'));
                }
            }
        } else {
            $data['view'] = 'admin/laporan/laporan_add';
            $this->load->view('admin/laporan/laporan_add', $data);
        }
    }

    public function edit_laporan($id = 0){
        $this->validation();
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('katlap_id', 'katlap_id', 'trim');
            $this->form_validation->set_rules('katlap_kategori', 'Kategori Laporan', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $data['user'] = $this->LaporanModel->get_laporan_by_id($id);
                $data['view'] = 'admin/laporan/laporan_edit';
                $this->load->view('admin/laporan/laporan_edit', $data);
            } else {
                $data = array(
                    'katlap_kategori' => $this->input->post('katlap_kategori'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->LaporanModel->edit_laporan($data, $id);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Diperbaharui !');
                    redirect(base_url('admin/laporan/edit_laporan'));
                }
            }
        } else {
            $data['user'] = $this->LaporanModel->get_laporan_by_id($id);
            $data['view'] = 'admin/laporan/laporan_edit';
            $this->load->view('admin/laporan/laporan_edit', $data);
        }
    }

    public function delete_laporan($id = 0){
        $this->validation();
        $this->db->delete('laporan', array('katlap_id' => $id));
        $this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
        redirect(base_url('admin/laporan/list_laporan'));
    }

    public function list_laporan(){
        $this->validation();
        $config['base_url'] = site_url('admin/laporan/list_laporan/');
        $config['total_rows'] = $this->LaporanModel->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = (!empty($_GET)) ? '?' . http_build_query($_GET, '', "&") : '';
        $config['first_url'] = $config['base_url'] . $config['suffix'];
        $config['query_string_segment'] = 'start';

        $this->pagination->initialize($config);
        $start = $this->uri->segment(4, 0);
        $confirm = $this->LaporanModel->index_limit($config['per_page'], $start);
        if ($confirm) {
            $this->data['laporan_data'] = $confirm;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['start'] = $start;

            $this->load->view('admin/laporan/laporan_list', $this->data);
        } else {
            $this->data['pesan_warning'] = 'Data Not Found';
            $this->load->view('admin/laporan/laporan_list', $this->data);
        }
    }


    function kat(){
        $id = $this->session->userdata('id');
        $no = $this->uri->segment(3);

        $data['bab'] = $this->LaporanModel->get_bab($no);
        $data['cek'] = $this->m_paper->get_last_bimbingankategori($id, $no);
        $this->load->view('mahasiswa/laporan',$data);
    }
}

?>