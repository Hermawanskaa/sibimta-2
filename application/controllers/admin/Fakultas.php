<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('FakultasModel');
    }

    public function validation(){
        if(!$this->session->userdata('is_admin_login')){
            redirect('login','refresh');

        }
    }

    public function index(){
        $this->validation();
        $this->load->view('admin/fakultas/fakultas_list');
    }
}

?>