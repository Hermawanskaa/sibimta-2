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
        $data['laporan'] = $this->BimbinganModel->get_all_laporan($id, $no);
        $data['cek'] = $this->BimbinganModel->get_last_bimbingankategori($id, $no);
        $this->load->view('mahasiswa/bimbingan/bimbingan_list',$data);
    }

    function add_bimbingan(){
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
            $data['bimbingan'] = $this->BimbinganModel->get_laporan($id);
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

    function detail_bimbingan(){
        $this->validation();
        $id = $this->session->userdata('id');
        $lap_id = $this->uri->segment(3);
        $data['log'] = $this->BimbinganModel->get_all_bimbingan($id, $lap_id);
        $data['topik'] = $this->BimbinganModel->get_topik($id, $lap_id);
        $this->load->view('mahasiswa/bimbingan/bimbingan_detail',$data);
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
        $this->form_validation->set_rules('lap_topik', 'TOPIK BIMBINGAN', 'required|min_length[10]');
        $this->form_validation->set_rules('lap_jenis', 'JENIS BIMBINGAN', 'required');
        $this->form_validation->set_rules('bimb_catatan', 'PEMBAHASAN TOPIK', 'required|min_length[10]');

        $this->form_validation->set_message('required', '%s tidak boleh kosong!');
        $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
        $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

        if ($this->form_validation->run() == FALSE) {
            $data['link'] = $this->input->post('act');
            $data['id'] = $this->input->post('lap_id');
            $this->load->view('mahasiswa/bimbingan/bimbingan_add',$data);
        }else{
            $id = $this->input->post('lap_id');
            if ($id!=0){
                $data = array(
                    'lap_topik'=>$this->input->post('lap_topik'),
                    'lap_jenis' =>$this->input->post('lap_jenis'),
                    'lap_tanggal'=>date('Y-m-d'),
                    'lap_waktu'=>date('H:i:s')
                );
                $this->BimbinganModel->edit_laporan($id, $data);
            }else{
                $data = array(
                    'lap_id'=>null,
                    'mhs_id'=>$this->session->userdata('id'),
                    'katlap_id'=> $kat_id,
                    'lap_topik' => $this->input->post('lap_topik'),
                    'lap_jenis' =>$this->input->post('lap_jenis'),
                    'lap_tanggal'=>date('Y-m-d'),
                    'lap_waktu'=>date('H:i:s'),
                );
                $this->BimbinganModel->add_laporan($data);
                $this->add_bimbingan_data();
                $kat_lap_id = $kat_id;

                $mhsid = $this->session->userdata('id');
                $this->DosenModel->pesan_dospem($mhsid, $kat_lap_id);
            }

            redirect('bimbingan/detail_bimbingan/'.$mhsid.'/'.$kat_lap_id);
        }
    }

    function add_bimbingan_data(){
        $nim = $this->BimbinganModel->get_last();
        foreach($nim->result() as $key){
            $data['id'] = $key->lap_id;
            $mhsid		= $key->mhs_id;
        }
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
                'mhs_id'=>$dsn->mhs_id,
                'bimb_file'=>$default_f,
                'bimb_catatan'=>$this->input->post('bimb_catatan'),
                'bimb_tgl'=>date('Y-m-d'),
                'bimb_wkt'=>date('H:i:s'),
                'bimb_status'=>'none',
                'dosbing1'=>1,
                'dosbing2'=>0,
            );
            $this->db->insert('bimbingan',$tdata);
        }
    }
}
?>