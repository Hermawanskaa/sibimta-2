<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DosenModel extends CI_Model {
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

public function get_all_where2($table,$id_cari,$var_cari,$id_carii,$var_carii){
	$this->db->from($table);
	$this->db->where($id_cari, $var_cari);
	$this->db->where($id_carii, $var_carii);
	$query = $this->db->get();
	return $query->result();
}

public function get_all_where($table,$id_cari,$var_cari){
	$this->db->from($table);
	$this->db->where($id_cari,$var_cari);
	$query = $this->db->get();
	return $query->result();
}

public function get_all_berkas($table,$id_cari,$var_cari){
	$this->db->from($table);
	$this->db->where($id_cari,$var_cari);
	$this->db->where('FILE IS NOT NULL');
	$query = $this->db->get();
	return $query->result();
}

public function save_pertemuan($id_judul,$tgl,$summary,$jenis,$tgl_post,$jam_post){
	$this->db->set('id_judul',$id_judul);
	$this->db->set('tgl',$tgl);
	$this->db->set('summary',$summary);
	$this->db->set('jenis',$jenis);
	$this->db->set('tgl_post',$tgl_post);
	$this->db->set('jam_post',$jam_post);
	$this->db->insert('pertemuan');
}

public function Upload_file_komentar($id_pertemuan,$komentar,$file,$id_member,$tgl_post,$size){
	$this->db->set('id_pertemuan',$id_pertemuan);
	$this->db->set('id_member',$id_member);
	$this->db->set('status',1);
	$this->db->set('size',$size);
	$this->db->set('isi',$komentar);
	$this->db->set('file',$file);
	$this->db->set('tgl_post',$tgl_post);
	$this->db->insert('komentar');
}

public function get_all_where_not($table,$id_cari,$var_cari){
	$this->db->from($table);
	$this->db->where_not_in($id_cari,$var_cari);
	$query = $this->db->get();
	return $query->result();
}

}

?>