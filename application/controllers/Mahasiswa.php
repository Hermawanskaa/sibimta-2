<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
    }

    public function validation()
    {
        if (!$this->session->userdata('is_mahasiswa_login')) {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {
        $this->validation();
        $this->load->view('mahasiswa/dashboard');
    }
}
