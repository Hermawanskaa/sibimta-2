<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bimbingan extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->model('MahasiswaModel');
        $this->load->model('BimbinganModel');
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
        $this->kategori();
    }

    function kategori_bimbingan(){
        $this->validation();
        $id = $this->session->userdata('id');
        $no = $this->uri->segment(3);
        $data['bab'] = $this->BimbinganModel->get_bab($no);
        $data['bimbingan'] = $this->BimbinganModel->get_all_bimbingan($id, $no);
        $data['cek'] = $this->BimbinganModel->get_last_bimbingankategori($id, $no);
        $this->load->view('mahasiswa/bimbingan/bimbingan_list',$data);
    }

    function add_bimbingan(){
        //mencocokan nilai kategori laporan pada uri segmen
        $no = $this->uri->segment(3);
        if(empty($no) || $no==4 || $no==5 || $no==6 || $no==7 || $no==8 || $no==9){
            $data['bab']=$this->SkripsiModel->get_bab($no);
            $data['file']='';
            $this->load->view('mahasiswa/bimbingan/bimbingan_add',$data);
        }else{
            redirect('mahasiswa');
        }
    }

    function edit_bimbingan(){
        $no = $this->uri->segment(3);
        if(empty($no) || $no==4 || $no==5 || $no==6 || $no==7 || $no==8 || $no==9){
            $data['bab']=$this->BimbinganModel->get_bab($no);
            $data['file']='';
            $id = $this->uri->segment(4);
            //mengambil data proposal berdasarkan lap_id
            $data['bimbingan'] = $this->BimbinganModel->get_lap($id);
            $this->load->view('mahasiswa/bimbingan/bimbingan_add',$data);
        }else{
            redirect('mahasiswa');
        }
    }

    function get_file_laporan(){
        $no = $this->uri->segment(3);
        if(empty($no) || $no==4 || $no==5 || $no==6 || $no==7 || $no==8 || $no==9){
            $this->BimbinganModel->download_laporan();
        }else{
            redirect('mahasiswa');
        }
    }

    function get_file_revisi(){
        $no = $this->uri->segment(3);
        if(empty($no) || $no==4 || $no==5 || $no==6 || $no==7 || $no==8 || $no==9){
            $this->BimbinganModel->download_revisi();
        }else{
            redirect('mahasiswa');
        }
    }

    function submit(){
        $no = $this->uri->segment(3);
        $data['bab'] = $this->SkripsiModel->get_bab($no);
        $kat 		= $this->uri->segment(1);
        $act 		= $this->input->post('act');

        $link = array('4','5','6','7','8','9');
        $kat = array('bab1','bab2','bab3','bab4','bab5','bab6');
        for($i=0; $i<6; $i++){
            if($no==$link[$i]){
                $kat= $kat[$i];
                $kat_id = $link[$i];
            }
        }
        if (empty($_FILES['userfile']['name'])){
            $data['file'] = '';
            $data['pfile'] = 'Tidak ada File yang dipilih';
            $data['link'] = $this->input->post('act');
            $data['id'] = $this->input->post('lap_id');
            $this->load->view('mahasiswa/bimbingan/bimbingan_add',$data);

        }else if(!empty($_FILES['userfile']['name'])){
            $upload='userfile';
            $isi =  md5($this->session->userdata('nim')
                    .date('Y-m-d').date('H:i:s'))
                    .preg_replace("/\s+/", "_", $_FILES['userfile']['name']);

            $config['upload_path'] = "./uploads/laporan/";
            $config['allowed_types'] = 'doc|docx|pdf|rtf|odt';
            $config['max_size'] = '10000';
            $config['file_name'] = $isi;
            $config['overwrite'] = false;
            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload($upload)){
                $data['file'] = '';
                $data['pfile'] = $this->upload->display_errors();
                $data['link'] = $this->input->post('act');
                $data['id'] = $this->input->post('lap_id');
                $this->load->view('mahasiswa/bimbingan/bimbingan_add',$data);
            }else{
                $id = $this->input->post('lap_id');
                if ($id!=0){
                    $this->BimbinganModel->edit_laporan($id,$isi);
                }else{
                    $this->BimbinganModel->add_laporan($kat_id,  $isi);
                    $this->add_bimbingan_data();
                }
                $kat_lap_id = $kat_id;
                $mhsid = $this->session->userdata('id');
                $this->DosenModel->pesan_dospem($mhsid, $kat_lap_id);
                redirect('bimbingan/kategori_bimbingan/'.$no);
            }
        }
    }

    function add_bimbingan_data(){
        $nim = $this->BimbinganModel->get_last();
        foreach($nim->result() as $key){
            $data['id'] = $key->lap_id;
            $mhsid		= $key->mhs_id;
        }
        //cek last status
        $cek = $this->BimbinganModel->get_last_bimbingan($mhsid);
        if($cek->num_rows <>0){
            foreach($cek->result() as $row){
                $data['status'] = $row->bimb_status;
            }
            if($data['status'] == 'REVISI - P1'){
                $default_b = 'Menunggu Diperiksa Dosen P1';
            }else{
                $default_b = 'Menunggu Diperiksa';
            }
        }else{
            $default_b = 'Menunggu Diperiksa';
        }
        $default_f = 'Tak ada File Revisi';
        $default_k = 'Tak ada Komentar';

        $id = $this->session->userdata('id');
        $p1 = '1';
        $result = $this->BimbinganModel->check_pembimbing($id, $p1);
        foreach ($result->result() as $dsn){
            $tdata = array(
                'bimb_id'=>null,
                'lap_id'=>$data['id'],
                'dsn_id'=>$dsn->dsn_id,
                'bimb_file'=>$default_f,
                'bimb_catatan'=>$default_k,
                'bimb_tgl'=>date('Y-m-d'),
                'bimb_wkt'=>date('H:i:s'),
                'bimb_status'=>$default_b,
                'dosbing1'=>1,
                'dosbing2'=>0,
            );
            $this->db->insert('bimbingan',$tdata);
        }
    }
}
?>