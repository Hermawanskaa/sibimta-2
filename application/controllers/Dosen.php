<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('DosenModel');
    }

    public function validation()
    {
        if (!$this->session->userdata('is_dosen_login')) {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {
        $this->validation();
        $this->load->view('dosen/dashboard');
    }

    //pesan dari mahasiswa
    public function pesan(){
        $this->validation();
        $id = $this->session->userdata('id');
        $data['pesan'] = $this->DosenModel->all_pesan($id);
        $this->load->view('dosen/pesan',$data);
    }

    //detail pesan dari mahasiswa
    public function detail_pesan(){
        $this->validation();
        $id = $this->uri->segment(4);
        $katid = $this->uri->segment(3);
        $this->DosenModel->detail_pesan($id);

        if($katid == 4 || $katid == 5 || $katid == 6 || $katid == 7 || $katid == 8 || $katid == 9){
            redirect('bimbingan/kategori/'.$katid);
        }else{
            redirect('skripsi');
        }
    }

    //update password untuk dosen
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
                $data['view'] = 'dosen/profil/update_password';
                $this->load->view('dosen/profil/update_password', $data);
            }else{
                $data = array(
                    'dsn_password' => $this->input->post('konfirmasi_password')
                );
                $userId = $this->session->userdata('id');
                $data = $this->security->xss_clean($data);
                $result = $this->DosenModel->update_password($userId, $data);

                if($result){
                    $this->session->set_flashdata('msg', 'Password Berhasil terupdate!<br>silahkan logout dan login dengan password yang baru!');
                    redirect(base_url('dosen/update_password'));
                }
            }
        }else{
            $data['view'] = 'dosen/profil/update_password';
            $this->load->view('dosen/profil/update_password', $data);
        }
    }

    //cek password untuk dosen
    public function cek_password($old_password){
        $user_id = $this->session->userdata('id');
        $result = $this->DosenModel->cek_password($old_password,$user_id);
        if($result ==0){
            $this->form_validation->set_message('cek_password', "Password lama tidak sesuai!");
            return FALSE ;
        } else{
            return TRUE ;
        }
    }


}
