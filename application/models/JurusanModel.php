<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JurusanModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function add_jurusan($data)
    {
        $this->db->insert('jurusan', $data);
        return true;
    }

    public function get_all_jurusan()
    {
        $query = $this->db->get('jurusan');
        return $result = $query->result_array();
    }

    public function get_jurusan_by_id($id)
    {
        $query = $this->db->get_where('jurusan', array('jrs_id' => $id));
        return $result = $query->row_array();
    }

    public function edit_jurusan($data, $id)
    {
        $this->db->where('jrs_id', $id);
        $this->db->update('jurusan', $data);
        return true;
    }

    public function profil_jurusan()
    {

    }

    public function update_profil_jurusan()
    {

    }

    public function total_rows()
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->from('jurusan')
                ->like('jrs_id', $_GET['keyword'])
                ->or_like('jrs_nama', $_GET['keyword'])
                ->or_like('jrs_kode', $_GET['keyword'])
                ->or_like('fak_id', $_GET['keyword'])
                ->order_by('jrs_id', 'ASC')
                ->count_all_results();
        } else {
            return $this->db->from('jurusan')
                ->count_all_results();
        }
    }

    public function index_limit($limit, $start = 0)
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->select('*')
                ->from('jurusan')
                ->like('jrs_id', $_GET['keyword'])
                ->or_like('jrs_nama', $_GET['keyword'])
                ->or_like('jrs_kode', $_GET['keyword'])
                ->or_like('fak_id', $_GET['keyword'])
                ->order_by('jrs_id', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        } else {
            return $this->db->select('*')
                ->from('jurusan')
                ->order_by('jrs_id', 'ASC')
                ->limit($limit, $start)
                ->get()->result();
        }

    }

    public function get_jurusan(){
        $this->db->select('*')
                 ->from('jurusan')
                 ->where('jrs_id !=',0);
        $query = $this->db->get();
        return $query;
    }
}

?>