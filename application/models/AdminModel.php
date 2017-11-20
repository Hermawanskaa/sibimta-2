<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function add_admin($data){
        $this->db->insert('admin', $data);
        return true;
    }

    public function get_all_admin(){
        $query = $this->db->get('admin');
        return $result = $query->result_array();
    }

    public function get_admin_by_id($id){
        $query = $this->db->get_where('admin', array('nip' => $id));
        return $result = $query->row_array();
    }

    public function edit_admin($data, $id){
        $this->db->where('nip', $id);
        $this->db->update('admin', $data);
        return true;
    }

    public function profil_admin(){

    }

    public function update_profil_admin(){

    }

    function list_admin($num, $offset)  {
        $query = $this->db->get('admin',$num, $offset);
        return $query->result();

    }
}

?>