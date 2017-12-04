<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BimbinganModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get_all_laporan(){
        $query = $this->db->get('laporan');
        return $result = $query->result_array();
    }

    public function get_laporan_by_id($id){
        $query = $this->db->get_where('laporan', array('katlap_id' => $id));
        return $result = $query->row_array();
    }

    public function total_rows(){
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

    public function index_limit($limit, $start = 0){
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

    //mengambil katlap_id dari tabel kategori laporan
    function get_bab($no){
        $this->db->select('*');
        $this->db->from('kategori_laporan');
        $this->db->where('katlap_id', $no);
        $query = $this->db->get();
        return $query;
    }

    //mengambil data terakhir bimbingan
    function get_last_bimbingan($mhs){
        $this->db->select('*');
        $this->db->from('bimbingan');
        $this->db->join('laporan','bimbingan.lap_id = laporan.lap_id');
        $this->db->where('laporan.mhs_id', $mhs);
        $this->db->order_by('bimb_id','desc');
        $this->db->limit('1');
        $query= $this->db->get();
        return $query;
    }

    //mengambil data terakhir bimbingan berdasarkan katlap_id
    function get_last_bimbingankategori($mhs, $no){
        $this->db->select('*');
        $this->db->from('bimbingan');
        $this->db->join('laporan','bimbingan.lap_id = laporan.lap_id');
        $this->db->where('laporan.mhs_id', $mhs);
        $this->db->where('laporan.katlap_id', $no);
        $this->db->order_by('bimb_id','desc');
        $this->db->limit('1');
        $query= $this->db->get();
        return $query;
    }

    //mengambil semua data bimbingan mahasiswa
    function get_all_bimbingan($id, $no){
        $this->db->select('*');
        $this->db->from('bimbingan a');
        $this->db->join('laporan b', 'a.lap_id = b.lap_id');
        $this->db->join('kategori_laporan c', 'b.katlap_id = c.katlap_id');
        $this->db->where('b.mhs_id', $id);
        $this->db->where('b.katlap_id', $no);
        $this->db->order_by('a.bimb_id','desc');
        $query = $this->db->get();
        return $query;
    }

    //edit laporan bimbingan
    function edit_laporan($id, $isi){
        $nama_file = preg_replace("/^(.+?);.*$/", "\\1", $isi);
        $data = array(
            'lap_file'=>$isi,
            'lap_tanggal'=>date('Y-m-d'),
            'lap_waktu'=>date('H:i:s')
        );
        $this->db->where('lap_id',$id);
        $this->db->update('laporan',$data);
    }

    //menambahkan laporan bimbingan
    function add_laporan($kat_id, $isi){
        $data = array(
            'lap_id'=>null,
            'mhs_id'=>$this->session->userdata('id'),
            'katlap_id'=>$kat_id,
            'lap_file'=>$isi,
            'lap_tanggal'=>date('Y-m-d'),
            'lap_waktu'=>date('H:i:s'),
        );
        $this->db->insert('laporan',$data);
    }

    function get_last(){
        $id	= $this->session->userdata('id');
        $this->db->select('lap_id, laporan.mhs_id');
        $this->db->from('laporan');
        $this->db->join('mahasiswa','laporan.mhs_id=mahasiswa.mhs_id');
        $this->db->where('laporan.mhs_id', $id);
        $this->db->order_by('lap_id','desc');
        $this->db->limit('1');
        $query= $this->db->get();

        return $query;
    }

    //sebelum insert pembimbing
    public function check_pembimbing($id, $p1){
        $this->db->select('*');
        $this->db->from('pembimbing');
        $this->db->where('mhs_id',$id);
        $this->db->where('pembimbing1',$p1);
        $query = $this->db->get();
        return $query;
    }

    //mengambil data proposal
    function get_lap($id){
        $this->db->where('lap_id',$id);
        $q=$this->db->get('laporan');
        return $q;
    }

    //download file laporan bimbingan
    function download_laporan() {
        $ur = $this->uri->segment(1);
        if($ur =="dosen"){
            $requested_file = $this->uri->segment(5);
        }else if($ur=="bimbingan"){
            $requested_file = $this->uri->segment(4);
        }else{
            $requested_file = $this->uri->segment(3);
        }
        $this->load->helper('download');
        $this->db->select('*');
        $this->db->where('lap_file',$requested_file);
        $query =  $this->db->get('laporan');
        foreach ($query->result() as $row)
        {
            if($ur=='admin'){
                if($this->uri->segment(4)=='2'){
                    $file_data = file_get_contents(base_url()."uploads/laporan/".$row->lap_file);
                }
            }else if($ur=="bimbingan"){
                $file_data = file_get_contents(base_url()."uploads/laporan/".$row->lap_file);
            }
            $file_name = $row->lap_file;
        }
        force_download($file_name, $file_data);
    }

    //download file laporan
    function download_revisi() {
        $ur = $this->uri->segment(1);
        if($ur =="admin"){
            $requested_file = $this->uri->segment(5);
        }else if($ur=="bimbingan"){
            $requested_file = $this->uri->segment(4);
        }else{
            $requested_file = $this->uri->segment(3);
        }

        $this->load->helper('download');
        $this->db->select('*');
        $this->db->where('bimb_file',$requested_file);
        $query =  $this->db->get('bimbingan');
        foreach ($query->result() as $row)
        {
            $file_data = file_get_contents(base_url()."assets/upload/bimbingan/".$row->bimb_file);
            $file_name = $row->bimb_file;
        }
        force_download($file_name, $file_data);
    }





}

?>