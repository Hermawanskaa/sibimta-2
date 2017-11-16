<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Auth extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('LoginModel');
		} 

		public function index(){
			if($this->session->has_userdata('is_logged_in'))
			{
				redirect('admin');
			}
			else{
				$this->load->view('login/login');
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
                    $id_member = $this->input->post('id_member');
                    $password = $this->input->post('password');
                    $data = array(
                        'id_member' => $id_member,
                        'pass' => $password
                    );
                    //ADMIN
                    $result = $this->LoginModel->login('admin', $data)->num_rows();
                    if ($result > 0) {
                        $data_session = array(
                            'nama' => $id_member,
                            'status' => 'login',
                            'is_loggerd_in' => TRUE
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
                                'is_loggerd_in' => TRUE
                            );
                            $this->session->set_userdata($data_session);
                            redirect(base_url('admin'));
                        } else {
                            //MAHASISWA
                            $result = $this->LoginModel->login('mahasiswa', $data)->num_rows();
                            if ($result > 0) {
                                $data_session = array(
                                    'nama' => $id_member,
                                    'status' => 'login',
                                    'is_loggerd_in' => TRUE
                                );
                                $this->session->set_userdata($data_session);
                                redirect(base_url('admin'));
                            } else {
                                //KAJUR
                                $result = $this->LoginModel->login('kajur', $data)->num_rows();
                                if ($result > 0) {
                                    $data_session = array(
                                        'nama' => $id_member,
                                        'status' => 'login',
                                        'is_loggerd_in' => TRUE
                                    );
                                    $this->session->set_userdata($data_session);
                                    redirect(base_url('admin'));
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



		public function change_pwd(){
			$id = $this->session->userdata('admin_id');
			if($this->input->post('submit')){
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('confirm_pwd', 'Confirm Password', 'trim|required|matches[password]');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/auth/change_pwd';
					$this->load->view('admin/layout', $data);
				}
				else{
					$data = array(
						'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
					);
					$result = $this->auth_model->change_pwd($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Password has been changed successfully!');
						redirect(base_url('admin/auth/change_pwd'));
					}
				}
			}
			else{
				$data['view'] = 'admin/auth/change_pwd';
				$this->load->view('admin/layout', $data);
			}
		}
				
		public function logout(){
			$this->session->sess_destroy();
			redirect(base_url('admin/auth/login'), 'refresh');
		}
			
	}  // end class


?>