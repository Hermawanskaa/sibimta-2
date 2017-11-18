<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
            parent::__construct();
            $this->load->model('AdminModel');
            }

    public function validation(){
        if(!$this->session->userdata('is_admin_login')){
            redirect('auth','refresh');
        }
    }

    public function index(){
        $this->validation();
        $this->load->view('admin/home');
    }

    //CRUD DOSEN
    public function add_dosen(){
        $this->validation();
        if($this->input->post('submit')){
            $this->form_validation->set_rules('id_member', 'id_member', 'trim|required|is_unique[dosen.id_member]');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
            $this->form_validation->set_rules('nama', 'nama', 'trim|required');
            $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
            $this->form_validation->set_rules('no_hp', 'no_hp', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $data['view'] = 'admin/dosen/dosen_add';
                $this->load->view('admin/dosen/dosen_add', $data);
            }
            else{
                $data = array(
                    'id_member' => $this->input->post('id_member'),
                    'pass' =>  $this->input->post('password'),
                    'nama' => $this->input->post('nama'),
                    'alamat' => $this->input->post('alamat'),
                    'no_hp' => $this->input->post('no_hp'),
                    'email' => $this->input->post('email'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->AdminModel->add_dosen($data);
                if($result){
                    $this->session->set_flashdata('msg', 'Record is Added Successfully!');
                    redirect(base_url('admin/list_dosen'));
                }
            }
        }
        else{
            $data['view'] = 'admin/dosen/dosen_add';
            $this->load->view('admin/dosen/dosen_add', $data);
        }

    }

    public function edit_dosen($id = 0){
        $this->validation();
        if($this->input->post('submit')){
            $this->form_validation->set_rules('id_member', 'id_member', 'trim');
            $this->form_validation->set_rules('nama', 'nama', 'trim|required');
            $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
            $this->form_validation->set_rules('no_hp', 'no_hp', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $data['user'] = $this->AdminModel->get_dosen_by_id($id);
                $data['view'] = 'admin/dosen/dosen_edit';
                $this->load->view('admin/dosen/dosen_edit', $data);
            }
            else{
                $data = array(
                    //'id_member' => $this->input->post('id_member'),
                    'nama' => $this->input->post('nama'),
                    'alamat' => $this->input->post('alamat'),
                    'no_hp' => $this->input->post('no_hp'),
                    'email' => $this->input->post('email'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->AdminModel->edit_dosen($data, $id);
                if($result){
                    $this->session->set_flashdata('msg', 'Record is Updated Successfully!');
                    redirect(base_url('admin/list_dosen'));
                }
            }
        }
        else{
            $data['user'] = $this->AdminModel->get_dosen_by_id($id);
            $data['view'] = 'admin/dosen/dosen_edit';
            $this->load->view('admin/dosen/dosen_edit', $data);
        }
    }

    public function delete_dosen($id = 0){
        $this->validation();
        $this->db->delete('dosen', array('id_member' => $id));
        $this->session->set_flashdata('msg', 'Record is Deleted Successfully!');
        redirect(base_url('admin/list_dosen'));
    }

    public function view_dosen($data,$id){
        $this->validation();
        $data = array(
            'id_member' => $this->input->post('id_member'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('no_hp'),
            'email' => $this->input->post('email'),
        );
        $data = $this->security->xss_clean($data);
        $result = $this->AdminModel->edit_dosen($data, $id);
        if($result){
            $this->session->set_flashdata('msg', 'Record is Updated Successfully!');
            redirect(base_url('admin'));
        }
    }

    public function profile_dosen(){
        $this->validation();
        $this->load->view('admin/profil_view');
    }

    public function update_profil_dosen(){
        $this->validation();
        $this->load->view('admin/profil_update');
    }

    public function list_dosen($offset=0)
    {
        $jumlah = $this->db->get('dosen');
        $config['base_url'] = base_url() . '/paging/view';
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
        $data['data'] = $this->AdminModel->list_dosen($config['per_page'], $offset);
        $this->load->view('admin/dosen/dosen_list', $data);
    }

        //CRUD MAHASISWA








    }
  
?>