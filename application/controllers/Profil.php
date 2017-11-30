<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('MahasiswaModel');
        $this->load->model('JurusanModel');
    }

    function index(){
        $data ['mahasiswa']= $this->MahasiswaModel->get_mahasiswa_by_id($this->session->userdata('nim'));
        $this->load->view('mahasiswa/profil/profil_view',$data);
    }
}
?>