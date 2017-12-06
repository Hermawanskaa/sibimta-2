<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DosenModel extends CI_Model
{

    public function __construct(){
        parent::__construct();
    }

    //menambahkan data dosen
    public function add_dosen($data){
        $this->db->insert('dosen', $data);
        return true;
    }

    //filter data dosen berdasarkan id dosen
    public function get_dosen_by_id($id){
        $query = $this->db->get_where('dosen', array('dsn_nip' => $id));
        return $result = $query->row_array();
    }

    //edit data dosen
    public function edit_dosen($data, $id){
        $this->db->where('dsn_nip', $id);
        $this->db->update('dosen', $data);
        return true;
    }

    //paginasi untuk dosen list
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

    //paginasi search untuk dosen list
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
        $this->db->insert('pesan_dosen', $data);
        return true;
    }

    //pesan dari dosen ke mahasiswa
    function add_pesan_dosen($data){
        $this->db->insert('pesan_dosen', $data);
        return true;
    }

    //pesan ke dospem setelah input skripsi mahasiswa
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

    //pesan dari mahasiswa
    function all_pesan($id){
        $this->db->select('*');
        $this->db->from('pesan_mahasiswa');
        $this->db->join('mahasiswa','mahasiswa.mhs_id = pesan_mahasiswa.mhs_id');
        $this->db->join('kategori_laporan','kategori_laporan.katlap_id = pesan_mahasiswa.katlap_id');
        $this->db->where('dsn_id',$id);
        $this->db->where('pesan_mahasiswa.katlap_id !=',3);
        $this->db->order_by('pesmas_id','desc');
        $query= $this->db->get();
        return $query->result();
    }

    //detail pesan dari mahasiswa
    public function detail_pesan($id){
        $query = $this->db->select('*');
        $this->db->from('pesan_mahasiswa');
        $this->db->where('pesmas_id',$id);
        $this->db->set('pesmas_status',1);
        $this->db->update('pesan_mahasiswa');
        return $query;
    }

    //update password dosen
    public function update_password($id, $data){
        $query = $this->db->where('dsn_id', $id);
        $this->db->update('dosen', $data);
        return $query;
    }

    //cek password dosen
    public function cek_password($password, $id){
        $this->db->where('dsn_id', $id);
        $this->db->where('dsn_password', $password);
        $query = $this->db->get('dosen');
        return $query->num_rows();
    }
}

?>