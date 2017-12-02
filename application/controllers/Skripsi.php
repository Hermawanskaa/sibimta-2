<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skripsi extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('MahasiswaModel');
        $this->load->model('PembimbingModel');
        $this->load->model('SkripsiModel');
        $this->load->model('DosenModel');
    }

    public function validation(){
        if (!$this->session->userdata('is_mahasiswa_login')) {
            redirect('login', 'refresh');
        }
    }

    public function index(){
        $this->validation();
        $id = $this->session->userdata('id');
        $cek_dashboard = $this->MahasiswaModel->dashboard_mahasiswa($id);
        foreach($cek_dashboard->result() as $dashboard){
            if ($dashboard->judul =='NON AKTIF'){
                redirect('mahasiswa');
            }
        }
        $data['error']		='';
        $id 				= $this->session->userdata('id');
        $data['skripsi']	= $this->SkripsiModel->get_skripsi($id);
        $this->load->view('mahasiswa/skripsi/skripsi_list', $data);
    }

    function detail_skripsi(){
        $id = $this->session->userdata('id');
        $data['user'] = $this->SkripsiModel->detail_skripsi($id);
        $this->load->view('mahasiswa/skripsi_view',$data);
    }


}
?>