<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SkripsiModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function add_skripsi($data)
    {
        $this->db->insert('judul', $data);
        return true;
    }

    public function get_all_skripsi()
    {
        $query = $this->db->get('judul');
        return $result = $query->result_array();
    }

    public function get_judul_by_id($id)
    {
        $query = $this->db->get_where('judul', array('jdl_id' => $id));
        return $result = $query->row_array();
    }

    public function edit_judul($data, $id)
    {
        $this->db->where('jdl_id', $id);
        $this->db->update('jdl_id', $data);
        return true;
    }

    public function total_rows()
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->from('judul')
                ->like('mhs_id', $_GET['keyword'])
                ->or_like('jdl_id', $_GET['keyword'])
                ->or_like('jdl_judul', $_GET['keyword'])
                ->or_like('jdl_deskripsi', $_GET['keyword'])
                ->or_like('jdl_enjudul', $_GET['keyword'])
                ->or_like('jdl_status', $_GET['keyword'])
                ->or_like('jdl_tanggal', $_GET['keyword'])
                ->order_by('jdl_id', 'DESC')
                ->count_all_results();
        } else {
            return $this->db->from('judul')
                ->count_all_results();
        }
    }

    public function index_limit($limit, $start = 0)
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->select('*')
                ->from('judul')
                ->like('mhs_id', $_GET['keyword'])
                ->or_like('jdl_id', $_GET['keyword'])
                ->or_like('jdl_judul', $_GET['keyword'])
                ->or_like('jdl_deskripsi', $_GET['keyword'])
                ->or_like('jdl_enjudul', $_GET['keyword'])
                ->or_like('jdl_status', $_GET['keyword'])
                ->or_like('jdl_tanggal', $_GET['keyword'])
                ->order_by('jdl_id', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        } else {
            return $this->db->select('*')
                ->from('judul')
                ->order_by('jdl_id', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        }
    }

    public function add_mhs_pembimbing($data)
    {
        $this->db->insert('pembimbing', $data);
        return true;
    }
}

?>
