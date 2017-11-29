<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function add_laporan($data)
    {
        $this->db->insert('laporan', $data);
        return true;
    }

    public function get_all_laporan()
    {
        $query = $this->db->get('laporan');
        return $result = $query->result_array();
    }

    public function get_laporan_by_id($id)
    {
        $query = $this->db->get_where('laporan', array('katlap_id' => $id));
        return $result = $query->row_array();
    }

    public function edit_laporan($data, $id)
    {
        $this->db->where('katlap_id', $id);
        $this->db->update('laporan', $data);
        return true;
    }

    public function total_rows()
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->from('laporan')
                ->like('katlap_id', $_GET['keyword'])
                ->or_like('katlap_kategori', $_GET['keyword'])
                ->order_by('katlap_id', 'DESC')
                ->count_all_results();
        } else {
            return $this->db->from('laporan')
                ->count_all_results();
        }
    }

    public function index_limit($limit, $start = 0)
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->select('*')
                ->from('laporan')
                ->like('katlap_id', $_GET['keyword'])
                ->or_like('katlap_kategori', $_GET['keyword'])
                ->order_by('katlap_id', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        } else {
            return $this->db->select('*')
                ->from('laporan')
                ->order_by('katlap_id', 'ASC')
                ->limit($limit, $start)
                ->get()->result();
        }

    }

    public function get_laporan(){
        $this->db->select('*')
            ->from('laporan')
            ->where('katlap_id !=',0);
        $query = $this->db->get();
        return $query;
    }
}

?>