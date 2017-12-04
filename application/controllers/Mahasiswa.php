<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->model('MahasiswaModel');
        $this->load->model('NotifikasiModel');
    }

    public function validation()
    {
        if (!$this->session->userdata('is_mahasiswa_login')) {
            redirect('login', 'refresh');
        }
    }

    public function index(){
        $this->validation();
        $this->dashboard();
    }

    public function dashboard(){
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

    public function update_password($id = null){
        $this->validation();

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('password_lama', 'PASSWORD LAMA', 'required|callback_cek_password');
            $this->form_validation->set_rules('password_baru', 'PASSWORD', 'required|min_length[5]');
            $this->form_validation->set_rules('konfirmasi_password', 'KONFIRMASI PASSWORD', 'required|matches[password_baru]');

            $this->form_validation->set_message('required', '%s tidak boleh kosong!');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan {param}.');

            if ($this->form_validation->run() == FALSE) {
                $data['view'] = 'mahasiswa/profil/update_password';
                $this->load->view('mahasiswa/profil/update_password', $data);
            }else{
                $data = array(
                    'mhs_password' => $this->input->post('konfirmasi_password')
                );
                $userId = $this->session->userdata('id');
                $data = $this->security->xss_clean($data);
                $result = $this->MahasiswaModel->update_password($userId, $data);

        if($result){
            $this->session->set_flashdata('msg', 'Password Berhasil terupdate!<br>silahkan logout dan login dengan password yang baru!');
            redirect(base_url('mahasiswa/update_password'));
                 }
            }
        }else{
            $data['view'] = 'mahasiswa/profil/update_password';
            $this->load->view('mahasiswa/profil/update_password', $data);
        }
    }

    public function cek_password($old_password){
        $this->validation();
        $user_id = $this->session->userdata('id');
        $result = $this->MahasiswaModel->cek_password($old_password,$user_id);
        if($result ==0){
            $this->form_validation->set_message('cek_password', "Password lama tidak sesuai!");
            return FALSE ;
        } else{
            return TRUE ;
        }
    }

    //pesan dari dosen
    public function pesan(){
        $this->validation();
        $id = $this->session->userdata('id');
        $data['pesan'] = $this->MahasiswaModel->all_pesan($id);
        $this->load->view('mahasiswa/pesan',$data);
    }

    public function detail_pesan(){
        $this->validation();
        $id = $this->uri->segment(4);
        $katid = $this->uri->segment(3);
        $this->MahasiswaModel->detail_pesan($id);

        if($katid == 4 || $katid == 5 || $katid == 6 || $katid == 7 || $katid == 8 || $katid == 9){
            redirect('bimbingan/kategori/'.$katid);
        }else{
            redirect('skripsi');
        }
    }


}

?>