<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KajurModel extends CI_Model {
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
	$this->db->where($id_cari,$var_cari);
	$this->db->where($id_carii,$var_carii);
	$query = $this->db->get();
	return $query->result();
}

public function get_all_where($table,$id_cari,$var_cari){
	$this->db->from($table);
	$this->db->where($id_cari,$var_cari);
	$query = $this->db->get();
	return $query->result();
}

public function get_all_where_not($table,$id_cari,$var_cari){
	$this->db->from($table);
	$this->db->where_not_in($id_cari,$var_cari);
	$query = $this->db->get();
	return $query->result();
}

public function mhs_ta($id_jur){
	$query =$this->db->query("SELECT*FROM judul j, jurusan jur, mahasiswa m WHERE j.'id_member' = m.'id_member' AND jur. 'id_jurusan' = m.'jurusan' AND j.stus=2 AND jur.'id_jurusan' =".$id_jur);
	return $query->result();
}

}

?>