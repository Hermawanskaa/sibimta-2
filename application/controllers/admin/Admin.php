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
            $this->form_validation->set_rules('nama', 'nama', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('no_hp', 'no_hp', 'trim|required|xss_clean');
            $this->form_validation->set_rules('alamat', 'alamat', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('level', 'level', 'trim|required|xss_clean');
            $this->form_validation->set_message('required', '%s tidak boleh kosong');


            if ($this->form_validation->run() == FALSE) {
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
                    'level' => $this->input->post('level'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->AdminModel->add_admin($data);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Record is Added Successfully!');
                    redirect(base_url('admin/admin/admin_add'));
                }
            }
        } else{
            $data['view'] = 'admin/admin/admin_add';
            $this->load->view('admin/admin/admin_add', $data);
        }
    }

    public function edit_admin($id = 0){
        $this->validation();
        if($this->input->post('submit')){
            $this->form_validation->set_rules('nip', 'nip', 'trim|required|is_unique[admin.nip]');
            $this->form_validation->set_rules('nama', 'nama', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'password','trim|required|xss_clean');
            $this->form_validation->set_rules('no_hp', 'no_hp', 'trim|required|xss_clean');
            $this->form_validation->set_rules('alamat', 'alamat', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('level', 'level', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data['user'] = $this->AdminModel->get_admin_by_id($id);
                $data['view'] = 'admin/admin/admin_edit';
                $this->load->view('admin/admin/admin_edit', $data);
            }
            else{
                $data = array(
                    //'nip' => $this->input->post('nip'),
                    'nama' =>  $this->input->post('nama'),
                    'password' => $this->input->post('password'),
                    'no_hp' => $this->input->post('no_hp'),
                    'alamat' => $this->input->post('alamat'),
                    'email' => $this->input->post('email'),
                    'level' => $this->input->post('level'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->AdminModel->edit_admin($data, $id);
                if($result){
                    $this->session->set_flashdata('msg', 'Record is Updated Successfully!');
                    redirect(base_url('admin/list_admin'));
                }
            }
        }
        else{
            $data['user'] = $this->AdminModel->get_admin_by_id($id);
            $data['view'] = 'admin/admin/admin_edit';
            $this->load->view('admin/admin/admin_edit', $data);
        }
    }

    public function delete_admin($id = 0){
        $this->validation();
        $this->db->delete('admin', array('nip' => $id));
        $this->session->set_flashdata('msg', 'Record is Deleted Successfully!');
        redirect(base_url('admin/admin/list_admin'));
    }

    public function view_admin($data,$id){
        $this->validation();
        $data = array(
            'nip' => $this->input->post('nip'),
            'nama' =>  $this->input->post('nama'),
            'password' => $this->input->post('password'),
            'no_hp' => $this->input->post('no_hp'),
            'alamat' => $this->input->post('alamat'),
            'email' => $this->input->post('email'),
            'level' => $this->input->post('level'),
        );

        $data = $this->security->xss_clean($data);
        $result = $this->AdminModel->edit_admin($data, $id);
        if($result){
            $this->session->set_flashdata('msg', 'Record is Updated Successfully!');
            redirect(base_url('admin/admin/list_admin'));
        }
    }

    public function list_admin($offset=0){
        $this->validation();
        $jumlah = $this->db->get('admin');
        $config['total_rows'] = $jumlah->num_rows();
        $config['per_page'] = 3;
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