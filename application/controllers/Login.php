<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('LoginModel');
  }

  function index() {
    $this->load->view('login/login');
  }

public function logout(){
  $this->session->unset_userdata('login');
  redirect('login','refresh');
}

public function m_login(){
$result = $this->LoginModel->mahasiswa();
if(!$result){
  $result = $this->LoginModel->dosen();
  if(!$result){
    $result = $this->LoginModel->kajur();
    if(!$result){
      $result = $this->LoginModel->admin();
      if (!$result) {
        redirect('login/error');
      }else{
        redirect('admin');
        }
      }
      else{
        redirect('kajur');
          }
      }
      else{
        redirect('dosen');
      }
      }else{
  redirect('mahasiswa');
      };
}

public function error(){
  $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
        redirect('login');
  
}

}

?>
