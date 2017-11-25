<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PembimbingModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function add_pembimbing($data)
    {
        $this->db->insert('bagidosen', $data);
        return true;
    }

    public function get_all_pembimbing()
    {
        $query = $this->db->get('bagidosen');
        return $result = $query->result_array();
    }

    public function get_pembimbing_by_id($id)
    {
        $query = $this->db->get_where('bagidosen', array('bagi_id' => $id));
        return $result = $query->row_array();
    }

    public function edit_pembimbing($data, $id)
    {
        $this->db->where('bagi_id', $id);
        $this->db->update('bagidosen', $data);
        return true;
    }

    public function total_rows()
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->from('bagidosen')
                ->like('bagi_id', $_GET['keyword'])
                ->or_like('dsn_id', $_GET['keyword'])
                ->or_like('pembimbing1', $_GET['keyword'])
                ->or_like('pembimbing2', $_GET['keyword'])
                ->order_by('bagi_id', 'DESC')
                ->count_all_results();
        } else {
            return $this->db->from('pembimbing')
                ->count_all_results();
        }
    }

    public function index_limit($limit, $start = 0)
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->select('*')
                ->from('bagidosen')
                ->like('bagi_id', $_GET['keyword'])
                ->or_like('dsn_id', $_GET['keyword'])
                ->or_like('pembimbing1', $_GET['keyword'])
                ->or_like('pembimbing2', $_GET['keyword'])
                ->order_by('bagi_id', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        } else {
            return $this->db->select('*')
                ->from('bagidosen')
                ->order_by('bagi_id', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        }
    }

    function get_bagidosen(){
        $this->db->select('*');
        $this->db->from('bagidosen');
        $this->db->join('dosen','bagidosen.dsn_id = dosen.dsn_id');
        $result = $this->db->get();
        return $result;
    }
}

?>
