<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

public function __construct(){
	parent::__construct();
	$this->load->Model('MahasiswaModel');
}

    public function validation(){
        if(!$this->session->userdata('is_mahasiswa_login')){
            redirect('auth','refresh');
        }
    }

public function index(){
	$this->validation();
	$this->template->render('mahasiswa/home');
}

public function daftar_judul(){
	$this->validation();
	$session = $this->session->userdata('login');
	$data['judul_ta'] = $this->MahasiswaModel->get_all_where('judul','id_member',$session['id_member']);
	$jur = $this->MahasiswaModel->get_all_where('mahasiswa','id_member',$session['id_member']);

	$data['matkul']=$this->MahasiswaModel->get_all_where('matakuliah','id_jurusan',$jur['0']->jurusan);
	$this->template->render('mahasiswa/pendaftaran_judul',$data);
}

public function data_dosen_matkul(){
	$this->validation();
	$id = $this->input->post('id_matkul');
	$data['dosen'] = $this->MahasiswaModel->get_all_where('pengajar','id_matkul',$id);
	$this->load->View('mahasiswa/dosen',$data);
}

public function save_judul(){
	$this->validation();
	$this->MahasiswaModel->save_judul();
	redirect('mahasiswa/daftar_judul');
}

public function download(){
	$this->validation();
	$data['download'] = $this->MahasiswaModel->get_all('download');
	$this->template->render('mahasiswa/download',$data);
}

public function berkas($id){
	$this->validation();
	$data['berkas'] = $this->DosenModel->get_all_where('pertemuan','id_judul',$id);
	$this->template->render('dosen/berkas',$data);
}

public function jadwal(){
	$this->validation();
	$data['jadw'] = $this->MahasiswaModel->get_all_where('jadwal','status',1);
	$this->template->render('mahasiswa/jadwal',$data);
}

public function pendaftaran_ujian(){
	$this->validation();
	$data['jadwal'] = $this->MahasiswaModel->get_all_where('jadwal','id_judul',$this->get_jud());
	$data['judul'] = $this->MahasiswaModel->get_all_where('judul','id_judul',$this->get_jud());
	$this->template->render('mahasiswa/pendaftaran_ujian',$data);
}

public function save_ujian(){
	$this->validation();
	$session = $this->session->userdata('login');
	$config['Upload_path'] = './assets/file/ujian';
	$config['allowed_types'] = 'pdf|jpg|jpeg|png';
	$this->load->library('AjaxUpload',$config);
	if(!$this->Upload->do_Upload()){
		$error = array('error'=>$this->Upload->display_errors());
		echo "-------".$id_judul = $this->input->post('id_judul');
		echo "-------".$kategori=$this->input->post('kategori');
		$tgl_post = date('Y-m-d');
		$file = null;
		$this->MahasiswaModel->Upload_file_ujian($id_judul,$kategori,$file,$tgl_post);
		redirect('mahasiswa/pendaftaran_ujian');
        }
        else{
			$data = array('Upload_data'=>$this->Upload->data());
			echo "------".$id_judul = $this->input->post('id_judul');
			echo "------".$kategori = $this->input->post('kategori');
			$tgl_post = date('Y-m-d');
			$Upload_data = $this->Upload->data();
			$Upload_data['file_name'];
			$file = $Upload_data['file_name'];
			$this->MahasiswaModel->Upload_file_ujian($id_judul,$kategori,$file,$tgl_post);
			redirect('mahasiswa/pendaftaran_ujian');
		}
	}
}
?>