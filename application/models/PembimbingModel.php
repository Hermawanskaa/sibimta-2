<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PembimbingModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function add_pembimbing($data){
        $this->db->insert('bagidosen', $data);
        return true;
    }

    public function get_all_pembimbing(){
        $query = $this->db->get('bagidosen');
        return $result = $query->result_array();
    }

    public function get_pembimbing_by_id($id){
        $query = $this->db->join('dosen', 'dosen.dsn_id = bagidosen.dsn_id')
                          ->get_where('bagidosen', array('bagi_id' => $id));
        return $result = $query->row_array();
    }

    public function edit_pembimbing($data, $id){
        $this->db->where('bagi_id', $id);
        $this->db->update('bagidosen', $data);
        return true;
    }

    public function total_rows(){
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

    public function index_limit($limit, $start = 0){
        if(!empty($_GET['keyword'])) {
            return $this->db->select('*')
                ->from('bagidosen')
                ->join('dosen','dosen.dsn_id = bagidosen.dsn_id')
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
                ->join('dosen','dosen.dsn_id = bagidosen.dsn_id')
                ->order_by('bagi_id', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        }
    }

    function get_bagidosen(){
        $this->db->select('*');
        $this->db->from('bagidosen');
        $this->db->where('dsn_id !=',0);
        $query = $this->db->get();
        return $query;
    }

    public function get_bagidosen1(){
        $this->db->select('*');
        $this->db->from('bagidosen');
        $this->db->join('dosen','bagidosen.dsn_id = dosen.dsn_id');
        $this->db->where('pembimbing1','Y');
        $result = $this->db->get();
        return $result;
    }

    public function get_bagidosen2(){
        $this->db->select('*');
        $this->db->from('bagidosen');
        $this->db->join('dosen','bagidosen.dsn_id = dosen.dsn_id');
        $this->db->where('pembimbing2','Y');
        $result = $this->db->get();
        return $result;
    }

    public function check_pembimbing($data, $id){
        $this->db->select('mhs_id');
        $this->db->from('pembimbing');
        $this->db->where('mhs_id',$data);
        $this->db->where('pemb_id',$id);
        $query = $this->db->get();

        if($query->num_rows() > 1) {
            $this->db->where('mhs_id', $data);
            $this->db->where('pemb_id',$id);
            $this->db->update('bagidosen', $data, $id);
            return true;
        }
        else {
            return false;
        }
    }

    public function add_mhs_pembimbing($data){
        $this->db->insert('pembimbing', $data);
        return true;
    }

}

?>
