<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->model('MahasiswaModel');
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
        $id = $this->session->userdata('id');
        $result = $this->MahasiswaModel->dospem_dashboard($id);
        if($result){
            foreach($result as $key=>$res){
                $dosen[$res['dsn_id']] = explode(',', $res['dosen']);
            }
            $data['result'] = $result;
            $data['dosen'] = $dosen;
        }
        $data['dashboard']= $this->MahasiswaModel->dashboard_mahasiswa($this->session->userdata('id'));
        $this->load->view('mahasiswa/dashboard',$data);
    }

    public function pesan(){
        $id = $this->session->userdata('id');
        $data['pesan'] = $this->MahasiswaModel->all_pesan($id);
        $this->load->view('mahasiswa/pesan',$data);
    }
}

?>