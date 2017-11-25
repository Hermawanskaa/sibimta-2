<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skripsi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SkripsiModel','MahasiswaModel','DosenModel');
    }

    public function validation(){
        if(!$this->session->userdata('is_admin_login')){
            redirect('login','refresh');

        }
    }

    public function index(){
        $this->validation();
        $this->load->view('admin/skripsi/skripsi_list');
    }

    public function add_skripsi()
    {
        $this->validation();
        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('mhs_id', 'mhs_id', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('jdl_judul', 'jdl_judul', 'trim|required|xss_clean|is_unique[judul.jdl_judul');
            $this->form_validation->set_rules('jdl_deskripsi', 'jdl_deskripsi', 'trim|required|xss_clean|min_length[10]');
            $this->form_validation->set_rules('jdl_enjudul', 'jdl_enjudul', 'trim|required|xss_clean|min_length[10]');
            $this->form_validation->set_rules('jdl_status', 'jdl_status', 'trim|required|xss_clean|min_length[10]');
            $this->form_validation->set_rules('jdl_tanggal', 'jdl_tanggal', 'trim|required|xss_clean');

            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            if ($this->form_validation->run() == FALSE) {
                $data['view'] = 'admin/skripsi/skripsi_add';
                $this->load->view('admin/skripsi/skripsi_add', $data);
            } else {
                $data = array(
                    'mhs_id' => $this->input->post('mhs_id'),
                    'jdl_judul' => $this->input->post('jdl_judul'),
                    'jdl_deskripsi' => $this->input->post('jdl_deskripsi'),
                    'jdl_enjudul' => $this->input->post('jdl_enjudul'),
                    'jdl_status' => $this->input->post('jdl_status'),
                    'jdl_tanggal' => $this->input->post('jdl_tanggal'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->SkripsiModel->add_admin($data);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
                    redirect(base_url('admin/skripsi/add_skripsi'));
                }
            }
        } else {
            $data['view'] = 'admin/skripsi/skripsi_add';
            $this->load->view('admin/skripsi/skripsi_add', $data);
        }
    }

    public function edit_skripsi($id = 0)
    {
        $this->validation();
        if ($this->input->post('submit')) {
            $this->validation();

            $this->form_validation->set_rules('mhs_id', 'mhs_id', 'trim|required|xss_clean|min_length[5]');
            $this->form_validation->set_rules('jdl_judul', 'jdl_judul', 'trim|required|xss_clean|is_unique[judul.jdl_judul');
            $this->form_validation->set_rules('jdl_deskripsi', 'jdl_deskripsi', 'trim|required|xss_clean|min_length[10]');
            $this->form_validation->set_rules('jdl_enjudul', 'jdl_enjudul', 'trim|required|xss_clean|min_length[10]');
            $this->form_validation->set_rules('jdl_status', 'jdl_status', 'trim|required|xss_clean|min_length[10]');
            $this->form_validation->set_rules('jdl_tanggal', 'jdl_tanggal', 'trim|required|xss_clean');

            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            if ($this->form_validation->run() == FALSE) {
                $data['user'] = $this->SkripsiModel->get_skripsi_by_id($id);
                $data['view'] = 'admin/skripsi/skripsi_edit';
                $this->load->view('admin/skripsi/skripsi_edit', $data);
            } else {

                $data = array(
                    'mhs_id' => $this->input->post('mhs_id'),
                    'jdl_judul' => $this->input->post('jdl_judul'),
                    'jdl_deskripsi' => $this->input->post('jdl_deskripsi'),
                    'jdl_enjudul' => $this->input->post('jdl_enjudul'),
                    'jdl_status' => $this->input->post('jdl_status'),
                    'jdl_tanggal' => $this->input->post('jdl_tanggal'),
                );

                $data = $this->security->xss_clean($data);
                $result = $this->SkripsiModel->edit_skripsi($data, $id);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Diperbaharui !');
                    redirect(base_url('admin/skripsi/edit_skripsi'));
                }
            }
        } else {
            $data['user'] = $this->SkripsiModel->get_skripsi_by_id($id);
            $data['view'] = 'admin/skripsi/skripsi_edit';
            $this->load->view('admin/skripsi/skripsi_edit', $data);
        }
    }

    public function delete_skripsi($id = 0)
    {
        $this->validation();
        $this->db->delete('judul', array('jdl_id' => $id));
        $this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
        redirect(base_url('admin/skripsi/list_skripsi'));
    }

    public function view_skripsi($id = 0)
    {
        $this->validation();
        $data['user'] = $this->SkripsiModel->get_skripsi_by_id($id);
        $data['view'] = 'admin/skripsi/skripsi_view';
        $this->load->view('admin/skripsi/skripsi_view', $data);
    }

    public function list_skripsi()
    {
        $this->validation();
        $config['base_url'] = site_url('admin/skripsi/list_skripsi/');
        $config['total_rows'] = $this->SkripsiModel->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = (!empty($_GET)) ? '?' . http_build_query($_GET, '', "&") : '';
        $config['first_url'] = $config['base_url'] . $config['suffix'];
        $config['query_string_segment'] = 'start';

        $this->pagination->initialize($config);
        $start = $this->uri->segment(4, 0);
        $confirm = $this->SkripsiModel->index_limit($config['per_page'], $start);
        if ($confirm) {
            $this->data['skripsi_data'] = $confirm;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['start'] = $start;

            $this->load->view('admin/skripsi/skripsi_list', $this->data);
        } else {
            $this->data['pesan_warning'] = 'Data Not Found';
            $this->load->view('admin/skripsi/skripsi_list', $this->data);
        }
    }

}

?>