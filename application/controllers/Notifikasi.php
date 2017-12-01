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
        $data['jumlah_notif'] =$this->NotifikasiModel->notifikasi_count();
        $data['notifikasi'] =$this->mnotifikasi->get_notifikasi();
        $this->load->view('mahasiswa/template/topbar',$data);
    }

    public function load_row(){
        echo $this->mnotifikasi->notiffikasi_count($this->session->userdata('id'));
    }

    public function load_data(){

    }
}
?>