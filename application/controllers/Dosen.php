<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public function __construct(){
	parent::__construct();
	$this->load->Model('DosenModel');
}


    public function validation(){
        if(!$this->session->userdata('is_admin_login')){
            redirect('auth','refresh');
        }
    }

public function index(){
	$this->validation();
	$this->template->render('dosen/home');
}

public function bimbingan(){
	$this->validation();
	$session = $this->session->userdata('login');
	$dosen = $session['id_member'];
	$data['list_mhs'] = $this->DosenModel->get_all_where2('judul','id_dosen',$dosen,'stus','2');
	$this->template->render('dosen/list_mahasiswa',$data);
}

public function berkas($id){
	$this->validation();
	$data['berkas'] = $this->DosenModel->get_all_where('pertemuan','id_judul',$id);
	$this->template->render('dosen/berkas',$data);
}

public function save_pertemuan(){
	echo $id_judul = $this->input->post('id_judul');
	echo $jenis = $this->input->post('jenis');
	echo $summary = $this->input->post('summary');
	echo $tgl = $this->input->post('tgl');
	echo $tgl_post = date('Y-m-d');
	echo $jam_post = date('H:i:s');
	$this->DosenModel->save_pertemuan($id_judul,$tgl,$summary,$jenis,$tgl_post,$jam_post);
	redirect('dosen/reView');
}

public function reView(){
	$this->validation();
	$sesi =($this->session->userdata('id_jud'));
	$data['log'] = $this->DosenModel->get_all_where('pertemuan','id_judul',$sesi['id_judul']);
	$data['idjudul'] = $sesi['id_judul'];
	$this->template->render('dosen/bimbingan',$data);
}

public function save_komentar(){
	$this->validation();
	$session = $this->session->userdata('login');
	$config['Upload_path'] = 'pdf|docx|doc|rar|xlsx|xls|jpeg|jpg|png|zip|pptx|ppt';
	$this->load->library('Upload',$config);
	if(!$this->Upload->do_Upload()){
		$error = array('error'=> $this->Upload->display_errors());
			print_r($error->error);
			$id_pertemuan = $this->input->post('id_pertemuan');;
			$komentar = $this->input->post('komentar');
			$id_member = $session['id_member'];
			$tgl_post = date('Y-m-d');
			$jam_post = date('H:i:s');
			$file = null;
			$size = null;
			$this->DosenModel->Upload_file_komentar($id_pertemuan,$komentar,$file,$id_member,$tgl_post,$size);
			redirect('dosen/reView');
}
else{
		$data = array('Upload_data'=>$this->Upload->data());
		$id_pertemuan = $this->input->post('id_pertemuan');;
		$komentar = $this->input->post('komentar');
		$id_member = $session['id_member'];
		$tgl_post = date('Y-m-d');
		$jam_post = date('H:i:s');
		$Upload_data = $this->Upload->data();
		$Upload_data['file_name'];
		$file = $Upload_data['file_name'];
		$size = $Upload_data['file_size'];
		$this->DosenModel->Upload_file_komentar($id_pertemuan,$komentar,$file,$id_member,$tgl_post,$size);
		redirect('dosen/reView');
	}		
}
}

?>