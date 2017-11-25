<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembimbing extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PembimbingModel');
        $this->load->model('DosenModel');
    }

    public function validation(){
        if(!$this->session->userdata('is_admin_login')){
            redirect('login','refresh');
        }
    }

    public function index(){
        $this->validation();
        $this->load->view('admin/pembimbing/dosbing_list');
    }

    public function add_pembimbing()
    {
        $this->validation();
        $data['dosen'] = $this->DosenModel->get_dosen();
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('dsn_id', 'Dosen', 'trim|xss_clean|is_unique[bagidosen.dsn_id]');
            $this->form_validation->set_rules('pembimbing1', 'Pilihan Dosen Pembimbing 1', 'trim|required|xss_clean');
            $this->form_validation->set_rules('pembimbing2', 'Pilihan Dosen Pembimbing 2', 'trim|required|xss_clean');

            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            if ($this->form_validation->run() == FALSE) {
                $data['bagidosen'] = $this->DosenModel->get_dosen();
                $data['view'] = 'admin/pembimbing/dosbing_add';
                $this->load->view('admin/pembimbing/dosbing_add', $data);
            } else {

                $data = array(
                    'dsn_id' => $this->input->post('dsn_id'),
                    'pembimbing1' => $this->input->post('pembimbing1'),
                    'pembimbing2' => $this->input->post('pembimbing2'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->PembimbingModel->add_pembimbing($data);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
                    redirect(base_url('admin/pembimbing/add_pembimbing'));
                }
            }
        } else {
            $data['view'] = 'admin/pembimbing/dosbing_add';
            $this->load->view('admin/pembimbing/dosbing_add', $data);
        }
    }

    public function edit_pembimbing($id = 0)
    {
        $this->validation();
        $data['dosen'] = $this->DosenModel->get_dosen($id);
        $data['bagidosen'] = $this->PembimbingModel->get_bagidosen();

        if ($this->input->post('submit')) {
            $this->validation();
            $this->form_validation->set_rules('dsn_id', 'Dosen', 'trim|required|xss_clean');
            $this->form_validation->set_rules('pembimbing1', 'Pilihan Dosen Pembimbing 1', 'trim|required|xss_clean');
            $this->form_validation->set_rules('pembimbing2', 'Pilihan Dosen Pembimbing 2', 'trim|required|xss_clean');

            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            if ($this->form_validation->run() == FALSE) {
                $data['user'] = $this->PembimbingModel->get_pembimbing_by_id($id);
                $data['view'] = 'admin/pembimbing/dosbing_edit';
                $this->load->view('admin/pembimbing/dosbing_edit', $data);
            } else {

                $data = array(
                    'dsn_id' => $this->input->post('dsn_id'),
                    'pembimbing1' => $this->input->post('pembimbing1'),
                    'pembimbing2' => $this->input->post('pembimbing2'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->PembimbingModel->edit_pembimbing($data, $id);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Diperbaharui !');
                    redirect(base_url('admin/pembimbing/edit_pembimbing'));
                }
            }
        } else {
            $data['user'] = $this->PembimbingModel->get_pembimbing_by_id($id);
            $data['view'] = 'admin/pembimbing/dosbing_edit';
            $this->load->view('admin/pembimbing/dosbing_edit', $data);
        }
    }

    public function delete_pembimbing($id = 0)
    {
        $this->validation();
        $this->db->delete('pembimbing', array('bagi_id' => $id));
        $this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
        redirect(base_url('admin/pembimbing/list_pembimbing'));
    }

    public function view_pembimbing($id = 0)
    {
        $this->validation();
        $data['user'] = $this->PembimbingModel->get_pembimbing_by_id($id);
        $data['view'] = 'admin/pembimbing/dosbing_view';
        $this->load->view('admin/pembimbing/dosbing_view', $data);
    }

    public function list_pembimbing()
    {
        $this->validation();
        $config['base_url'] = site_url('admin/pembimbing/list_pembimbing/');
        $config['total_rows'] = $this->PembimbingModel->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = (!empty($_GET)) ? '?' . http_build_query($_GET, '', "&") : '';
        $config['first_url'] = $config['base_url'] . $config['suffix'];
        $config['query_string_segment'] = 'start';

        $this->pagination->initialize($config);
        $start = $this->uri->segment(4, 0);
        $confirm = $this->PembimbingModel->index_limit($config['per_page'], $start);
        if ($confirm) {
            $this->data['pembimbing_data'] = $confirm;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['start'] = $start;

            $this->load->view('admin/pembimbing/dosbing_list', $this->data);
        } else {
            $this->data['pesan_warning'] = 'Data Not Found';
            $this->load->view('admin/pembimbing/dosbing_list', $this->data);
        }
    }

}

?>