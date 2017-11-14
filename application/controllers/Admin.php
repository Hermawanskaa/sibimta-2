<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

public function __construct() {
		parent::__construct();
		$this->load->model('adminModel');
		}

public function validation(){
	if($this->session->userdata('login')){
		redirect('login','refresh');
	}
}

public function index(){
	$this->validation();
	//$this->load->view('admin/dosen/dosen_list');
	$data['all_users'] =  $this->adminModel->get_all_users();
	$data['view'] = 'admin/dosen/dosen_list';
	$this->load->view('admin/dosen/dosen_list', $data);
}

public function list_mhs(){
	$this->validation();
	$data['mahasiswa'] = $this->AdminModel->get_all('mahasiswa');
	$this->template->render('admin/mahasiswa/list',$data);
}

public function edit_mhs($id){
	$this->validation();
	$data['jurusan'] = $this->AdminModel->get_all('jurusan');
	$data['edit'] = $this->AdminModel->get_all_where('mahasiswa','id_member',$id);
	$this->template->render('admin/mahasiswa/edit',$data);
}

public function save_mhs(){
	$this->validation();
	$this->AdminModel->save_mahasiswa();
	redirect('admin/list_mhs');
}

public function detail_list(){
	$this->validation();
	$data['judul'] = $this->AdminModel->get_all_where('judul','status','0');
	$this->template->render('admin/approval/detail_list', $data);
}

public function stujui($id){
	$this->validation();
	$this->AdminModel->stujui($id);
	redirect('admin/approval');
}

public function tolak($id){
	$this->validation();
	$this->AdminModel->tolak($id);
	redirect('admin/approval');
}

public function list_cekjudul(){
	$this->validation();
	$data['cek_judul'] = $this->AdminModel->get_all('cek_judul');
	$this->template->render('admin/cek_judul/home', $data);
}

public function edit_cekjudul($id){
	$this->validation();
	$data['edit'] = $this->AdminModel->get_all_where('cek_judul','id_skripsi',$id);
	$this->template->render('admin/cek_judul/edit',$data);
 }

public function save_cekjudul(){
	$this->validation();
	$this->AdminModel->save_cekjudul();
	redirect('admin/list_cekjudul');
}

public function del_cekjudul($id){
	$this->validation();
	$this->AdminModel->del_cekjudul($id);
	redirect('admin/list_cekjudul');
}

public function lihat_judul(){
	$this->validation();
	$data['cek_judul'] = $this->AdminModel->get_all_where('cek_judul','id_skripsi',$id);
}

public function save_download(){
	$this->validation();
	$config['Upload_path'] = '.uploads/akademik';
	$config['allowed_types'] = 'pdf|docx|doc|rar|xlsx|xls|jpeg|jpg|png|zip|pptx|ppt';
	$this->load->library('Upload',$config);
	if (!$this->Upload->do_Upload()){
		$error = array('error'=>$this->Upload->display_errors());
		$file = null;
		redirect('admin/list_download');}
		else{
			$data = array('Upload_data'=>$this->Upload->data());
			$nama = $this->input->post('Nama');
			$tgl_post = date('Y-m-d');
			$jam_post = date('H:i:s');
			$Upload_data = $this->Upload->data();
			$Upload_data['file_name'];
			$file = $Upload_data['file_name'];
			$this->AdminModel->save_download($nama,$tgl_post,$jam_post,$file);
			redirect('admin/list_download');}
	}

public function del_download($id){
	$this->validation();
	$this->AdminModel->del_download($id);
	redirect('admin/list_download');
}

public function request_ujian(){
	$this->validation();
	$data['jadwal'] = $this->AdminModel->get_all_where('jadwal','status',0);
	$data['jadw'] = $this->AdminModel->get_all_where('jadwal','status',0);
	$this->template->render('admin/request_ujian',$data);
}

public function proses_jadwal($id){
	$this->validation();
	$data['dosen'] = $this->AdminModel->get_all('dosen');
	$data['jadwal'] = $this->AdminModel->get_all_where('jadwal','id_jadwal',$id);
}

public function update_jadwal(){
	$this->validation();
	$this->AdminModel->update_jadwal();
	$this->redirect('admin/request_ujian');
}

public function kuota(){
	$this->validation();
	$data['dosen'] = $this->AdminModel->kuota();
	$this->template->render('admin/kuota',$data);
}

public function profile(){
	$this->validation();
	$session = $this->session->userdata('login');
	$data['admin'] = $this->AdminModel->get_all_where('admin','id_member', $session['id_member']);
	$this->template->render('admin/profile', $data);
}

//selesai
public function do_Upload($gambar){
	$config = array('allowed_types'=>'jpg|jpeg|png|gif',
					'Upload_path'=>'./uploads/foto/admin','max_size'=>30000);
	$this->load->library('Upload',$config);
	$this->Upload->do_Upload($gambar);
	$images = $this->Upload->data($gambar);
	$images_data = $this->Upload->data($gambar);
	$images_name = $image_data['file_name'];
	$config = array('source_image'=>$images_data['full_path'],
					'maintain_ratio'=>true,'width'=>300,'height'=>1,'master_dim'=>'width');
	$this->load->library('image_lib',$config);
	$this->image_lib->resize();
	return  $image_name;
}

public function update_pass(){
	$gambar = $this->do_Upload('gambar');
	$this->AdminModel->simpanProfil($gambar);
	redirect('login/logout');
	}




//CRUD DOSEN
public function add_dosen(){
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_member', 'id_member', 'trim|required');
				$this->form_validation->set_rules('password', 'password', 'trim|required');
				$this->form_validation->set_rules('nama', 'nama', 'trim|required');
				$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
				$this->form_validation->set_rules('no_hp', 'no_hp', 'trim|required');
				$this->form_validation->set_rules('email', 'email', 'trim|required');


				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/dosen/dosen_add';
					$this->load->view('admin/dosen/dosen_add', $data);
				}
				else{
					$data = array(
						'id_member' => $this->input->post('id_member'),
						'pass' =>  $this->input->post('password'),
						'nama' => $this->input->post('nama'),
						'alamat' => $this->input->post('alamat'),
						'no_hp' => $this->input->post('no_hp'),
						'email' => $this->input->post('email'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->adminModel->add_user($data);
					if($result){
						$this->session->set_flashdata('msg', 'Record is Added Successfully!');
						redirect(base_url('admin'));
					}
				}
			}
			else{
				$data['view'] = 'admin/dosen/dosen_add';
				$this->load->view('admin/dosen/dosen_add', $data);
			}
			
		}

		public function edit_dosen($id = 0){
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_member', 'id_member', 'trim|required');
				$this->form_validation->set_rules('nama', 'nama', 'trim|required');
				$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
				$this->form_validation->set_rules('no_hp', 'no_hp', 'trim|required');
				$this->form_validation->set_rules('email', 'email', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['user'] = $this->adminModel->get_user_by_id($id);
					$data['view'] = 'admin/dosen/dosen_edit';
					$this->load->view('admin/dosen/dosen_edit', $data);
				}
				else{
					$data = array(
						'id_member' => $this->input->post('id_member'),
						'nama' => $this->input->post('nama'),
						'alamat' => $this->input->post('alamat'),
						'no_hp' => $this->input->post('no_hp'),
						'email' => $this->input->post('email'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->adminModel->edit_user($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Record is Updated Successfully!');
						redirect(base_url('admin'));
					}
				}
			}
			else{
				$data['user'] = $this->adminModel->get_user_by_id($id);
				$data['view'] = 'admin/dosen/dosen_edit';
				$this->load->view('admin/dosen/dosen_edit', $data);
			}
		}

		public function delete_dosen($id = 0){
			$this->db->delete('dosen', array('id_member' => $id));
			$this->session->set_flashdata('msg', 'Record is Deleted Successfully!');
			redirect(base_url('admin'));
		}

		public function view_dosen(){
			$data = array(
						'id_member' => $this->input->post('id_member'),
						'nama' => $this->input->post('nama'),
						'alamat' => $this->input->post('alamat'),
						'no_hp' => $this->input->post('no_hp'),
						'email' => $this->input->post('email'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->adminModel->edit_user($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Record is Updated Successfully!');
						redirect(base_url('admin'));
					}
				}

}
  
?>