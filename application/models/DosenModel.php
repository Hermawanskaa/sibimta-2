<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DosenModel extends CI_Model
{

    public function __construct(){
        parent::__construct();
    }

    public function add_dosen($data){
        $this->db->insert('dosen', $data);
        return true;
    }

    public function get_all_dosen(){
        $query = $this->db->get('dosen');
        return $result = $query->result_array();
    }

    public function get_dosen_by_id($id){
        $query = $this->db->get_where('dosen', array('dsn_nip' => $id));
        return $result = $query->row_array();
    }

    public function edit_dosen($data, $id){
        $this->db->where('dsn_nip', $id);
        $this->db->update('dosen', $data);
        return true;
    }

    public function total_rows(){
        if(!empty($_GET['keyword'])) {
            return $this->db->from('dosen')
                ->like('dsn_nip', $_GET['keyword'])
                ->or_like('dsn_nama', $_GET['keyword'])
                ->or_like('dsn_nohp', $_GET['keyword'])
                ->or_like('dsn_alamat', $_GET['keyword'])
                ->or_like('dsn_email', $_GET['keyword'])
                ->order_by('dsn_nip', 'DESC')
                ->count_all_results();
        } else {
            return $this->db->from('dosen')
                ->count_all_results();
        }
    }

    public function index_limit($limit, $start = 0){
        if(!empty($_GET['keyword'])) {
            return $this->db->select('*')
                ->from('dosen')
                ->like('dsn_nip', $_GET['keyword'])
                ->or_like('dsn_nama', $_GET['keyword'])
                ->or_like('dsn_nohp', $_GET['keyword'])
                ->or_like('dsn_alamat', $_GET['keyword'])
                ->or_like('dsn_email', $_GET['keyword'])
                ->order_by('dsn_nip', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        } else {
            return $this->db->select('*')
                ->from('dosen')
                ->order_by('dsn_nip', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        }
    }

    //list drop down dosen
    function get_dosen(){
        $this->db->select('*');
        $this->db->from('dosen');
        $this->db->where('dsn_id !=',0);
        $query = $this->db->get();
        return $query;
    }

    //pesan ke dosen
    function add_pesan($data){
        $this->db->insert('pesan_mahasiswa', $data);
        return true;
    }

    function pesantodospem($mhsid, $kat_lap_id){
        $this->db->select('dsn_id');
        $this->db->where('mhs_id',$mhsid);
        $query = $this->db->get('pembimbing');

        foreach($query->result() as $p){
            $data = array(
                'mhs_id'=>$mhsid,
                'dsn_id'=>$p->dsn_id,
                'katlap_id'=>$kat_lap_id,
                'pesmas_pesan'=>null,
                'pesmas_status'=>0,
                'pesmas_tanggal'=>date('Y-m-d'),
                'waktu'=>date('H:i:s')
            );
            $this->db->insert('pesan_mahasiswa',$data);
        }
    }
}

?>