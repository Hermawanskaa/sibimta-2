<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('LoginModel');
    }

    public function index(){
        if($this->session->has_userdata('is_admin_login')) {
            redirect('admin');
        }else{
            if($this->session->has_userdata('is_dosen_login')){
                redirect('dosen');
            }else{
                if ($this->session->has_userdata('is_mahasiswa_login')){
                    redirect('mahasiswa');
                }else{
                    if ($this->session->has_userdata('is_kajur_login')){
                        redirect('kajur');
                    }else{
                            $this->load->view('login/login');
                        }
                    }
                }
            }
        }


    public function login()
    {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('id_member', 'id_member', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('auth/login');
            } else {
                $id_member = $this->security->xss_clean($this->input->post('id_member'));
                $password = $this->security->xss_clean($this->input->post('password'));
                $data = array(
                    'id_member' => $id_member,
                    'pass' => $password
                );
                //ADMIN
                $result = $this->LoginModel->login('admin',$data);
                $rows = $result->num_rows();
                if ($rows > 0) {
                    $result = $result->row_array();
                    $data_session = array(
                        'NIP' => $result['id_member'],
                        'nama' => $result['nama'],
                        'is_admin_login' => TRUE
                    );
                    $this->session->set_userdata($data_session);
                    redirect(base_url('admin'));
                } else {
                    //DOSEN
                    $result = $this->LoginModel->login('dosen', $data)->num_rows();
                    if ($result > 0) {
                        $data_session = array(
                            'nama' => $id_member,
                            'status' => 'login',
                            'is_dosen_login' => TRUE
                        );
                        $this->session->set_userdata($data_session);
                        redirect(base_url('dosen'));
                    } else {
                        //MAHASISWA
                        $result = $this->LoginModel->login('mahasiswa', $data)->num_rows();
                        if ($result > 0) {
                            $data_session = array(
                                'nama' => $id_member,
                                'status' => 'login',
                                'is_mahasiswa_login' => TRUE
                            );
                            $this->session->set_userdata($data_session);
                            redirect(base_url('mahasiswa'));
                        } else {
                            //KAJUR
                            $result = $this->LoginModel->login('kajur', $data)->num_rows();
                            if ($result > 0) {
                                $data_session = array(
                                    'nama' => $id_member,
                                    'status' => 'login',
                                    'is_kajur_login' => TRUE
                                );
                                $this->session->set_userdata($data_session);
                                redirect(base_url('kajur'));
                            } else {
                                redirect('auth/error');
                            }
                        }
                    }
                }
            }
        }
    }

    public function error(){
        $data['msg'] = '<br>Username atau Password yang anda masukkan salah.';
        $this->load->view('login/login', $data);
    }

    public function change_password(){
        $id = $this->session->userdata('id_member');
        if($this->input->post('submit')){
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('confirm_pwd', 'Confirm Password', 'trim|required|matches[password]');
            if ($this->form_validation->run() == FALSE) {
                $data['view'] = 'login/change_password';
                $this->load->view('login/change_password', $data);
            }
            else{
                $data = array(
                    'password' => $this->input->post('password'),
                );
                $result = $this->LoginModel->change_password($data, $id);
                if($result){
                    $this->session->set_flashdata('msg', 'Password has been changed successfully!');
                    redirect(base_url('login/change_password'));
                }
            }
        }
        else{
            $data['view'] = 'login/change_password';
            $this->load->view('login/change_password', $data);
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('auth');
    }

}

?>