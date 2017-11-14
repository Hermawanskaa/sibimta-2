<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kajur extends CI_Controller {

public function __construct(){
	parent::__construct();
	$this->load->Model('KajurModel');
}

public function validation(){
	if(!$this->session->userdata('login')){
		redirect('login','refresh');
	}
}

public function index(){
	$this->validation();
	$this->template->render('kajur/home');
}

public function bimbingan(){
	$this->validation();
	$session = $this->session->userdata('login');
	$kajur = $session['id_member'];
	$data['list_mhs'] = $this->KajurModel->get_all_where2('judul','id_kajur',$kajur,'stus','2');
	$this->template->render('kajur/list_mahasiswa',$data);
}

public function list_m(){
	$this->validation();
	$session = $this->$session->userdata('login');
	$jurusan = $this->KajurModel->get_all_where('kajur','id_member',$session['id_member']);
	$data['judul'] = $this->KajurModel->mhs_ta($jurusan[0]->jurusan);
	$this->template->render('kajur/list_m',$data);
}

public function reView(){
	$this->validation();
	$sesi =($this->session->userdata('id_jud'));
	$data['log'] = $this->AdminModel->get_all_where('pertemuan','id_judul',$sesi['id_judul']);
	$this->template->render('kajur/bimbingan',$data);
}

}
  
?>