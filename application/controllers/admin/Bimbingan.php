<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bimbingan extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('DosenModel');
        $this->load->model('BimbinganModel');
        $this->load->model('PembimbingModel');
    }

    public function validation(){
        if (!$this->session->userdata('is_dosen_login')) {
            redirect('login', 'refresh');
        }
    }

    public function index(){
        $this->validation();
        $this->load->view('dosen/dashboard');
    }

    function detail_bimbingan(){
        $this->validation();
        $mhsid = $this->uri->segment(4);
        $result = $this->PembimbingModel->get_dosenpembimbing($mhsid);
        $maxdos = $this->PembimbingModel->count_dosenpembimbing();
        if($result){
            foreach($result as $key=>$res){
                $dosen[$res['dsn_id']] = explode(',', $res['dosen']);
            }
            $data['result'] = $result;
            $data['dosen'] = $dosen;
        }
        $data['result'] = $result;
        $data['maxdos'] = $maxdos;
        $data['laporan'] = $this->BimbinganModel->getall_laporan_dospem($mhsid);
        $data['terakhir'] = $this->BimbinganModel->get_last_bimbingan($mhsid);
        $this->load->view('dosen/bimbingan/bimbingan_list',$data);
    }

    function edit_bimbingan(){
        $this->validation();
        $id = $this->uri->segment(4);
        $pengid = $this->uri->segment(5);
        $data['bimbingan'] = $this->BimbinganModel->get_bimbingan($id);
        $this->load->view('dosen/bimbingan/bimbingan_edit',$data);
    }

    function submit(){
        $this->validation();
        $upload = 'userfile';

        if( empty($_FILES['userfile']['name'])){
            $file='Tak ada File Revisi';
            $this->BimbinganModel->update_bimbingan($file);
        }else if(!empty($_FILES['userfile']['name'])){
            $upload='userfile';
            $file =  md5($this->session->userdata('id').date('Y-m-d').date('H:i:s')).preg_replace("/\s+/", "_", $_FILES['userfile']['name']);
            $config['upload_path'] = "./uploads/bimbingan/";
            $config['allowed_types'] = 'doc|docx|pdf|rtf|odt';
            $config['file_name'] = $file;
            $config['max_size']  = '5000';
            $config['overwrite'] = false;
            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload($upload)){
                $data['error'] = $this->upload->display_errors();
                $id = $this->input->post('lapid');
                $data['bimbingan'] = $this->BimbinganModel->get_bimbingan($id);
                $this->load->view('dosen/bimbingan/bimbingan_edit',$data);
            }else{
                $this->BimbinganModel->update_bimbingan($file);
            }
        }
        redirect( 'admin/bimbingan/detail_bimbingan/'.$this->input->post('mhs').'/'.$this->input->post('pengid'));
    }

}