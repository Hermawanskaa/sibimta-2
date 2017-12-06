<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BimbinganModel extends CI_Model{
    public function __construct(){
        parent::__construct();
    }


    public function get_laporan_by_id($id){
        $query = $this->db->get_where('laporan', array('katlap_id' => $id));
        return $result = $query->row_array();
    }

    public function total_rows(){
        if(!empty($_GET['keyword'])){
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
        $query = $this->db->get('laporan');
        return $query;
    }

    //download file laporan bimbingan
    function download_laporan(){
        $ur = $this->uri->segment(1);
        if($ur =='admin'){
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
            $file_data = file_get_contents(base_url()."uploads/bimbingan/".$row->bimb_file);
            $file_name = $row->bimb_file;
        }
        force_download($file_name, $file_data);
    }

    //mengambil dan join tabel bimbingan
    function getall_laporan_dospem($mhsid){
        $id	= $this->session->userdata('id');
        $this->db->select('*');
        $this->db->from('bimbingan a');
        $this->db->join('laporan b', 'a.lap_id = b.lap_id');
        $this->db->join('kategori_laporan c', 'b.katlap_id = c.katlap_id');
        $this->db->join('pembimbing d', 'b.mhs_id = d.mhs_id');
        $this->db->join('mahasiswa e', 'b.mhs_id = e.mhs_id');
        $this->db->where('b.mhs_id', $mhsid);
        $this->db->where('d.dsn_id', $id);
        $this->db->group_by('b.lap_id');
        $this->db->order_by('a.bimb_id','desc');
        $query = $this->db->get();
        return $query;
    }

    //mengambil data bimbingan berdasarkan lap_id
    function get_bimbingan($id){
        $this->db->select('*');
        $this->db->from('bimbingan a');
        $this->db->join('laporan b', 'a.lap_id = b.lap_id');
        $this->db->join('kategori_laporan c', 'b.katlap_id = c.katlap_id');
        $this->db->where('b.lap_id', $id);
        $query = $this->db->get();
        return $query;
    }

    function update_bimbingan($file){
        $pgw		= $this->session->userdata('id');
        $id			= $this->input->post('bimid', TRUE);
        $lapid		= $this->input->post('lapid', TRUE);
        $mhs		= $this->input->post('mhs', TRUE);
        $katlap		= $this->input->post('katlap', TRUE);
        $koment		= $this->input->post('komentar',TRUE);
        if (empty($koment)){
            $komentar ='Tak ada Komentar';
        }else{
            $komentar = $koment;
        }
        $stat = $this->input->post('status',TRUE);
        //cek status dospem
        $this->db->select('*');
        $this->db->from('pembimbing');
        $this->db->where('dsn_id',$pgw);
        $this->db->where('mhs_id',$mhs);
        $cek = $this->db->get();

        foreach($cek->result() as $key){
            $dos_id = $key->pemb_id;
            $dosp1 = $key->pembimbing1;
            $dosp2 = $key->pembimbing2;

            if($dos_id % 2 == 0){
                if($stat =="ACC"){
                    $up_stat = 'Menunggu Diperiksa Dosen P1';
                }else{
                    $up_stat = 'REVISI - P2';
                }
            }else{
                if($stat =="ACC"){
                    $up_stat = $stat;
                }else{
                    $up_stat = 'REVISI - P1';
                }
            }
            if($dosp1=='1'){
                $dp1 = '1';
            }else{
                $dp1 = '0';
            }

            if($dosp2=='1'){
                $dp2 = '1';
            }else{
                $dp2 = '0';
            }
        }

        $data = array(
            'dsn_id'=>$pgw,
            'bimb_file'=>$file,
            'bimb_catatan'=>$komentar,
            'bimb_tgl'=>date('Y-m-d'),
            'bimb_wkt'=>date('H:i:s'),
            'bimb_status'=>$up_stat,
            'dosbing1'=>$dp1,
            'dosbing2'=>$dp2
        );

        $this->db->where('bimb_id',$id);
        $this->db->update('bimbingan',$data);

        if($up_stat=='ACC'){
            $this->open_dashboard($mhs);
        }
    }

    function open_dashboard($mhs){
        $this->db->select('*');
        $this->db->from('dashboard');
        $this->db->where('mhs_id',$mhs);
        $cek = $this->db->get();

        foreach($cek->result() as $dash){
            $judul 		= $dash->judul;
            $bab1		= $dash->bab1;
            $bab2		= $dash->bab2;
            $bab3		= $dash->bab3;
            $bab4		= $dash->bab4;
            $bab5		= $dash->bab5;
            $bab6		= $dash->bab6;
        }

        if($bab1=='AKTIF'){
            $data = array('bab2'=>'AKTIF');
        }
        if($bab2=='AKTIF'){
            $data = array('bab3'=>'AKTIF');
        }
        if($bab3=='AKTIF'){
            $data = array('bab4'=>'AKTIF');
        }
        if($bab4=='AKTIF'){
            $data = array('bab5'=>'AKTIF');
        }
        if($bab5=='AKTIF'){
            $data = array('bab6'=>'AKTIF');
        }
        if($bab5=='AKTIF'){
            $data = array('bab6'=>'AKTIF');
        }
        $this->db->where('mhs_id',$mhs);
        $this->db->update('dashboard',$data);
    }
}

?>