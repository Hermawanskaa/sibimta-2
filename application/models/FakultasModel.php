<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FakultasModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function add_fakultas($data)
    {
        $this->db->insert('fakultas', $data);
        return true;
    }

    public function get_all_fakultas()
    {
        $query = $this->db->get('fakultas');
        return $result = $query->result_array();
    }

    public function get_fakultas_by_id($id)
    {
        $query = $this->db->get_where('fakultas', array('fak_id' => $id));
        return $result = $query->row_array();
    }

    public function edit_fakultas($data, $id)
    {
        $this->db->where('fak_id', $id);
        $this->db->update('fakultas', $data);
        return true;
    }

    public function profil_fakultas()
    {

    }

    public function update_profil_fakultas()
    {

    }

    public function total_rows()
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->from('fakultas')
                ->like('fak_id', $_GET['keyword'])
                ->or_like('fak_nama', $_GET['keyword'])
                ->or_like('fak_kode', $_GET['keyword'])
                ->order_by('fak_id', 'ASC')
                ->count_all_results();
        } else {
            return $this->db->from('fakultas')
                ->count_all_results();
        }
    }

    public function index_limit($limit, $start = 0)
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->select('*')
                ->from('fakultas')
                ->like('fak_id', $_GET['keyword'])
                ->or_like('fak_nama', $_GET['keyword'])
                ->or_like('fak_kode', $_GET['keyword'])
                ->order_by('fak_id', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        } else {
            return $this->db->select('*')
                ->from('fakultas')
                ->order_by('fak_id', 'ASC')
                ->limit($limit, $start)
                ->get()->result();
        }

    }

    public function get_fakultas(){
        $this->db->select('*')
            ->from('fakultas')
            ->where('fak_id !=',0);
        $query = $this->db->get();
        return $query;
    }
}

?>
