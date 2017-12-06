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

    // untuk paginasi search
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

    //paginasi search
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

    //mengambil semua data dosen
    function get_bagidosen(){
        $this->db->select('*');
        $this->db->from('bagidosen');
        $this->db->where('dsn_id !=',0);
        $query = $this->db->get();
        return $query;
    }

    //mengambil data dosen pembimbing 1
    public function get_bagidosen1(){
        $this->db->select('*');
        $this->db->from('bagidosen');
        $this->db->join('dosen','bagidosen.dsn_id = dosen.dsn_id');
        $this->db->where('pembimbing1','Y');
        $result = $this->db->get();
        return $result;
    }

    //mengambil data dosen pembimbing 2
    public function get_bagidosen2(){
        $this->db->select('*');
        $this->db->from('bagidosen');
        $this->db->join('dosen','bagidosen.dsn_id = dosen.dsn_id');
        $this->db->where('pembimbing2','Y');
        $result = $this->db->get();
        return $result;
    }

    //check pembimbing jika sudah ada maka data akan di update
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

    //mengambil data pembimbing beserta judul dan mahasiswa yang dibimbing
    function get_dosenpembimbing($mhsid){
            $this->db->select('a.*, b.*, c.*, d.*, GROUP_CONCAT(c.dsn_nama ORDER BY a.pemb_id) as dosen');
            $this->db->from('pembimbing a');
            $this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
            $this->db->join('dosen c', 'a.dsn_id = c.dsn_id');
            $this->db->join('judul d', 'b.mhs_id = d.mhs_id');
            $this->db->where('b.mhs_id', $mhsid);
            $this->db->group_by('a.mhs_id');
            $query = $this->db->get();
            return $query->result_array();
    }

    public function count_dosenpembimbing(){
        $this->db->select('COUNT(*) countrow');
        $this->db->group_by('mhs_id');
        $this->db->order_by('count(*)', 'desc');
        $query = $this->db->get('pembimbing');
        return $query->row_array();
    }
}

?>
