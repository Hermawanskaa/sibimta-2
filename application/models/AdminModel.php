<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    //CRUD DOSEN
    public function add_dosen($data){
        $this->db->insert('dosen', $data);
        return true;
    }

    public function get_all_dosen(){
        $query = $this->db->get('dosen');
        return $result = $query->result_array();
    }

    public function get_dosen_by_id($id){
        $query = $this->db->get_where('dosen', array('id_member' => $id));
        return $result = $query->row_array();
    }

    public function edit_dosen($data, $id){
        $this->db->where('id_member', $id);
        $this->db->update('dosen', $data);
        return true;
    }

    public function profil_dosen(){

    }

    public function update_profil_dosen(){

    }

    function list_dosen($num, $offset)  {
        $query = $this->db->get('dosen',$num, $offset);
        return $query->result();

    }
}

?>