<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->model('MahasiswaModel');
        $this->load->model('LaporanModel');
        $this->load->model('SkripsiModel');
    }

    public function validation(){
        if (!$this->session->userdata('is_mahasiswa_login')) {
            redirect('login', 'refresh');
        }
    }

    public function index(){
        $this->validation();
        $this->kategori();
    }

    function kategori(){
        $this->validation();
        $id = $this->session->userdata('id');
        $no = $this->uri->segment(3);

        $data['bab']=$this->LaporanModel->get_bab($no);
        $data['laporan'] = $this->LaporanModel->get_all_proposal($id, $no);
        $data['cek'] = $this->LaporanModel->get_last_bimbingankategori($id, $no);
        $this->load->view('mahasiswa/laporan/laporan_list',$data);
    }


}
?>