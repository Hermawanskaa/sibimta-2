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

    function kategori(){
        $this->validation();
        $id = $this->session->userdata('id');
        $no = $this->uri->segment(3);

        $data['bab']=$this->BimbinganModel->get_bab($no);
        $data['bimbingan'] = $this->BimbinganModel->get_all_bimbingan($id, $no);
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

    public function add_fakultas(){

        $this->validation();
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('fak_nama', 'NAMA FAKULTAS', 'trim|required|is_unique[fakultas.fak_nama]');
            $this->form_validation->set_rules('fak_kode', 'KODE FAKULTAS', 'trim|required|xss_clean|min_length[2]');

            $this->form_validation->set_message('required', '%s tidak boleh kosong');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            if ($this->form_validation->run() == FALSE) {
                $data['view'] = 'admin/fakultas/fakultas_add';
                $this->load->view('admin/fakultas/fakultas_add', $data);
            } else {
                $data = array(
                    'fak_nama' => $this->input->post('fak_nama'),
                    'fak_kode' => $this->input->post('fak_kode'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->AdminModel->add_fakultas($data);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
                    redirect(base_url('admin/fakultas/add_fakultas'));
                }
            }
        } else {
            $data['view'] = 'admin/fakultas/fakultas_add';
            $this->load->view('admin/fakultas/fakultas_add', $data);
        }
    }




}
?>