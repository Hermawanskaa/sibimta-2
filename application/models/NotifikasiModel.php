<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotifikasiModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
    }

    function notifikasi_count($id){
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from(' pesan_dosen');
        $this->db->where('mhs_id',$id);
        $this->db->where('pesdos_status',0);
        $this->db->where('pesan_dosen.katlap_id !=',3);
        $query= $this->db->get();
        if($query->num_rows() <> 0){
            $data = $query->row();
            $jumlah = intval($data->jumlah);
        }else{
            $jumlah = 0;
        }
        return $jumlah;
    }

    function get_notifikasi($id){
        $this->db->select('*');
        $this->db->from('pesan_dosen');
        $this->db->join('dosen','pesan_dosen.dsn_id = dosen.dsn_id');
        $this->db->join('kategori_laporan','pesan_dosen.katlap_id = kategori_laporan.katlap_id');
        $this->db->where('mhs_id',$id);
        $this->db->where('pesdos_status',0);
        $this->db->where('pesan_dosen.katlap_id !=',3);
        $this->db->order_by('pesdos_id','desc');
        $query = $this->db->get();
        return $query->result();
    }

}
?>