<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Auth extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('loginModel');
		} 

		public function index(){
			if($this->session->has_userdata('id_member'))
			{
				redirect('admin');
			}
			else{
				$this->load->view('login/login');
			}
		}

		public function login(){

			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_member', 'id_member', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$this->load->view('login/login');
				}
				else {
					$data = array(
					'id_member' => $this->input->post('id_member'),
					'password' => $this->input->post('password')
					);
					$result = $this->loginModel->login($data);
					if ($result == TRUE) {
						$admin_data = array(
							'id_member' => $result['id_member'],
						 	'nama' => $result['nama'],
						 	'validated' => TRUE
						);
						$this->session->set_userdata($admin_data);
						redirect(base_url('admin'), 'refresh');
					}
					else{
						$data['msg'] = 'Invalid Email or Password!';
						$this->load->view('login/login', $data);
					}
				}
			}
			else{
				$this->load->view('login/login');
			}
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