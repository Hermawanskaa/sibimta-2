<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('MahasiswaModel');
        $this->load->model('JurusanModel');
        $this->load->model('NotifikasiModel');
    }

    public function index(){
        $id = $this->session->userdata('id');
        $data = $this->NotifikasiModel->notifikasi_count($id);
        $data['notifikasi'] = $this->NotifikasiModel->get_notifikasi();
        $this->load->view('mahasiswa/template/topbar',$data);
    }
}
?>