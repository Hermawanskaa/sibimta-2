<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MahasiswaModel extends CI_Model {
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

public function get_all_where($table, $id_cari,$var_cari){
	$this->db->from($table);
	$this->db->where($id_cari,$var_cari);
	$query = $this->db->get();
	return $query->result();
}

public function get_all_berkas($table,$id_cari,$var_cari){
	$this->db->from($table);
	$this->db->where($id_cari,$var_cari);
	$this->db->where('FILE IS NOT NULL');
	$query =$this->db->get();
	return $query->result();
}

public function Upload_file_komentar($id_pertemuan,$komentar,$file,$id_member,$tgl_post,$size){
	$this->db->set('id_pertemuan',$id_pertemuan);
	$this->db->set('id_member',$id_member);
	$this->db->set('size',$size);
	$this->db->set('isi',$komentar);
	$this->db->set('file',$file);
	$this->db->set('tgl_post',$tgl_post);
	$this->db->insert('komentar');
}

public function Upload_file_ujian($id_judul,$id_judul,$kategori,$file,$tgl_post){
	$this->db->set('id_judul',$id_judul);
	$this->db->set('kategori',$kategori);
	$this->db->set('tgl_post',$tgl_post);
	$this->db->set('file',$file);
	$this->db->insert('jadwal');
}	


public function save_judul(){
	$member = $this->input->post('member');
	$judul = $this->input->post('judul');
	$diskripsi = $this->input->post('diskripsi');
	$en_judul = $this->input->post('en_judul');
	$en_diskripsi = $this->input->post('en_diskripsi');
	$software = $this->input->post('software');
	$matkul = $this->input->post('matkul');
	$dosen = $this->input->post('dosen');
	$this->db->set('id_member',$id_member);
	$this->db->set('judul',$judul);
	$this->db->set('diskripsi',$diskripsi);
	$this->db->set('en_judul',$en_judul);
	$this->db->set('en_diskripsi',$en_diskripsi);
	$this->db->set('software',$software);
	$this->db->set('id_matkul',$matkul);
	$this->db->set('id_dosen',$dosen);
	$this->db->insert('judul');
}


}

?>