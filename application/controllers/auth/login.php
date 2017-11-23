<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('LoginModel');
    }

    public function index(){
        if($this->session->has_userdata('is_admin_login')) {
            redirect('admin/dashboard');
        }else{
            if($this->session->has_userdata('is_dosen_login')){
                redirect('dosen');
            }else{
                if ($this->session->has_userdata('is_mahasiswa_login')){
                    redirect('mahasiswa');
                }else{
                     $this->load->view('auth/login');
                    }
                }
            }
        }


    public function login()
    {
        //ADMIN
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('username', 'username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('auth/login');
            } else {
                $username = $this->security->xss_clean($this->input->post('username'));
                $password = $this->security->xss_clean($this->input->post('password'));
                $data = array(
                    'nip' => $username,
                    'password' => $password
                );
                $result = $this->LoginModel->login('Admin',$data);
                $rows = $result->num_rows();
                if ($rows > 0) {
                    $result = $result->row_array();
                    $data_session = array(
                        'nama' => $result['nama'],
                        'nip' => $result['nip'],
                        'foto' => $result['foto'],
                        'is_admin_login' => TRUE
                    );
                    $this->session->set_userdata($data_session);
                    redirect(base_url('admin/dashboard'),'refresh');
                }
                //DOSEN
                else{
                    $data = array(
                        'nip' => $username,
                        'password' => $password
                    );
                    $result = $this->LoginModel->login('dosen',$data);
                    $rows = $result->num_rows();
                    if ($rows > 0) {
                        $result = $result->row_array();
                        $data_session = array(
                            'nama' => $result['nama'],
                            'nip' => $result['nip'],
                            'foto' => $result['foto'],
                            'is_dosen_login' => TRUE
                        );
                        $this->session->set_userdata($data_session);
                        redirect(base_url('dosen'),'refresh');
                    }

                 //MAHASISWA
                    else{
                        $data = array(
                            'nim' => $username,
                            'password' => $password
                        );
                        $result = $this->LoginModel->login('mahasiswa',$data);
                        $rows = $result->num_rows();
                        if ($rows > 0) {
                            $result = $result->row_array();
                            $data_session = array(
                                'nama' => $result['nama'],
                                'nim' => $result['nim'],
                                'foto' => $result['foto'],
                                'is_mahasiswa_login' => TRUE
                            );
                            $this->session->set_userdata($data_session);
                            redirect(base_url('mahasiswa'),'refresh');
                        }else{
                            $data['msg'] = '<br>Username atau Password yang anda masukkan salah.';
                            $this->load->view('admin/auth/login', $data);
                        }
                    }
                }
            }
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

}

?>