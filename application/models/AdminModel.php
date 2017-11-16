<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {
	public function __construct(){
parent::__construct();
}

	public function get_all($table){
	$this->db->from($table);
	$query = $this->db->get();
	return $query->result();
}

public function get_all_distinct($table,$Field){
	$this->db->distinct();
	$this->db->select($Field);
	$this->db->from($table);
	$query = $this->db->get();
}

public function kuota(){
	$query = $this->db->query('SELECT DISTINCT(id_dosen),COUNT(id_dosen) AS jumlah FROM judul WHERE stus=2 GROUP BY id_dosen');
}

public function get_all_where($table,$id_cari,$var_cari){
	$this->db->from($table);
	$this->db->where($id_cari,$var_cari);
	$query = $this->db->get();
	return $query->result();
}

public function save_mahasiswa(){
	$id_member = $this->input->post('NIM');
	$pass = $this->input->post('Password');
	$nama = $this->input->post('Nama');
	$alamat = $this->input->post('Alamat');
	$jurusan = $this->input->post('jurusan');
	$no_hp = $this->input->post('HP');
	$email = $this->input->post('Email');
	$this->db->set('id_member',$id_member);
	$this->db->set('pass',$pass);
	$this->db->set('nama',$nama);
	$this->db->set('alamat',$alamat);
	$this->db->set('jurusan',$jurusan);
	$this->db->set('no_hp',$no_hp);
	$this->db->set('email',$email);
	$this->db->insert('mahasiswa');
}

public function edit_mahasiswa(){
	$id_member = $this->input->post('NIM');
	$pass = $this->input->post('Password');
	$nama = $this->input->post('Nama');
	$alamat = $this->input->post('Alamat');
	$jurusan = $this->input->post('jurusan');
	$no_hp = $this->input->post('HP');
	$email = $this->input->post('Email');

	$this->db->set('id_member',$id_member);
	$this->db->set('pass',$pass);
	$this->db->set('nama',$nama);
	$this->db->set('alamat',$alamat);
	$this->db->set('jurusan',$jurusan);
	$this->db->set('no_hp',$no_hp);
	$this->db->set('email',$email);
	$this->db->where('id_member',$id_member);
	$this->db->update('mahasiswa');
}

public function del_mhs($id){
	$this->db->where('id_member',$id);
	$this->db->delete('mahasiswa');
}

public function stujui($id) {
	$this->db->set('stus',2);
	$this->where('id_judul', $id);
	$this->db->update('judul');
}

public function tolak($id){
	$this->db->set('stus',1);
	$this->db->where('id_judul',$id);
	$this->db->update('judul');
}

public function simpanProfil($image = ''){
	if(!$image){
		$data = array('nama'=>$this->input->post('nama'),
			'no_hp'=>$this->input->post('no_hp'),
			'pass'=>$this->input->post('pass'));}
		else{$data = array('nama'=>$this->input->post('nama'),
			'no_hp' =>$this->input->post('no_hp'),
			'pass'=>$this->input->post('pass'),
			'foto'=>$image
		);
			if($this->input->post('id_member') && $image){
				$tampil = $this->db->get_where('admin',array('id_member'=>$this->input->post('id_member')))->result();
				if($tampil[0]->foto!= ""){
					unlink('./assets/foto/admin/', $tampil[0]->foto);
				}
			}
			$this->db->where('id_member',$this->input->post('id_member'));
			$this->db->update('admin',$data);

		}
	}

public function get_all_where_not($table,$id_cari,$var_cari){
	$this->db->from($table);
	$this->db->where_not_in($id_cari, $var_cari);
	$query = $this->db->get();
	return $query->result();
}




//CRUD DOSEN
public function add_user($data){
			$this->db->insert('dosen', $data);
			return true;
		}

		public function get_all_users(){
			$query = $this->db->get('dosen');
			return $result = $query->result_array();
		}

		public function get_user_by_id($id){
			$query = $this->db->get_where('dosen', array('id_member' => $id));
			return $result = $query->row_array();
		}

		public function edit_user($data, $id){
			$this->db->where('id_member', $id);
			$this->db->update('dosen', $data);
			return true;
		}
}

//CRUD MAHASISWA
//CRUD ADMIN


?>