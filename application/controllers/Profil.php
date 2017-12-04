<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('MahasiswaModel');
        $this->load->model('JurusanModel');
        $this->load->model('DosenModel');
    }

    function index(){

    }

    function profil_mahasiswa(){
        $data ['mahasiswa']= $this->MahasiswaModel->get_mahasiswa_by_id($this->session->userdata('nim'));
        $this->load->view('mahasiswa/profil/profil_view',$data);
    }

    function profil_dosen(){
        $data ['dosen']= $this->DosenModel->get_dosen_by_id($this->session->userdata('nip'));
        $this->load->view('dosen/profil/profil_view',$data);
    }
}
?>