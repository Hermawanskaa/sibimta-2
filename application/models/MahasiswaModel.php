<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MahasiswaModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function add_mahasiswa($data){
        $this->db->insert('mahasiswa', $data);
        return true;
    }

    public function get_all_mahasiswa(){
        $query = $this->db->get('mahasiswa');
        return $result = $query->result_array();
    }

    public function get_mahasiswa_by_id($id){
        $query = $this->db->join('jurusan', 'jurusan.jrs_id = mahasiswa.jrs_id')
                          ->get_where('mahasiswa', array('mhs_nim' => $id));

        return $result = $query->row_array();
    }

    public function edit_mahasiswa($data, $id){
        $this->db->where('mhs_nim', $id);
        $this->db->update('mahasiswa', $data);
        return true;
    }

    public function cek_password($password, $id){
        $this->db->where('mhs_id', $id);
        $this->db->where('mhs_password', $password);
        $query = $this->db->get('mahasiswa');
        return $query->num_rows();
    }

    public function total_rows(){
        if(!empty($_GET['keyword'])) {
            return $this->db->from('mahasiswa')
                ->join('jurusan','jurusan.jrs_id = mahasiswa.jrs_id')
                ->like('mhs_nim', $_GET['keyword'])
                ->or_like('mhs_nama', $_GET['keyword'])
                ->or_like('mhs_nohp', $_GET['keyword'])
                ->or_like('mhs_alamat', $_GET['keyword'])
                ->or_like('mhs_email', $_GET['keyword'])
                ->or_like('mhs_angkatan', $_GET['keyword'])
                ->or_like('jrs_id', $_GET['keyword'])
                ->order_by('mhs_nim', 'DESC')
                ->count_all_results();
        } else {
            return $this->db->from('mahasiswa')
                ->join('jurusan','jurusan.jrs_id = mahasiswa.jrs_id')
                ->count_all_results();
        }
    }

    //paginasi mahasiswa
    public function index_limit($limit, $start = 0){
        if(!empty($_GET['keyword'])) {
            return $this->db->select('*')
                ->from('mahasiswa')
                ->join('jurusan','jurusan.jrs_id = mahasiswa.jrs_id')
                ->like('mhs_nim', $_GET['keyword'])
                ->or_like('mhs_nama', $_GET['keyword'])
                ->or_like('mhs_nohp', $_GET['keyword'])
                ->or_like('mhs_alamat', $_GET['keyword'])
                ->or_like('mhs_email', $_GET['keyword'])
                ->or_like('mhs_angkatan', $_GET['keyword'])
                ->or_like('jrs_id', $_GET['keyword'])
                ->order_by('mhs_nim', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        } else {
            return $this->db->select('*')
                ->from('mahasiswa')
                ->join('jurusan','jurusan.jrs_id = mahasiswa.jrs_id')
                ->order_by('mhs_nim', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        }
    }

    //drop down form input judul
    public function get_mahasiswa(){
        $this->db->select('*')
            ->from('mahasiswa')
            ->where('mhs_id !=',0);
        $query = $this->db->get();
        return $query;
    }

    //update password
    public function update_password($id, $data){
        $query = $this->db->where('mhs_id', $id);
        $this->db->update('mahasiswa', $data);
        return $query;
    }

    //dashboard mahasiswa
    public function dashboard_mahasiswa($id){
        $this->db->select('*');
        $this->db->from('dashboard');
        $this->db->join('mahasiswa','mahasiswa.mhs_id = dashboard.mhs_id');
        $this->db->where('mahasiswa.mhs_id',$id);
        $query= $this->db->get();
        return $query;
    }

    //pesan dari dosen
    function all_pesan($id){
        $this->db->select('*');
        $this->db->from('pesan_dosen');
        $this->db->join('dosen','dosen.dsn_id = pesan_dosen.dsn_id');
        $this->db->join('kategori_laporan','kategori_laporan.katlap_id = pesan_dosen.katlap_id');
        $this->db->where('mhs_id',$id);
        $this->db->where('pesan_dosen.katlap_id !=',3);
        $this->db->order_by('pesdos_id','desc');
        $query= $this->db->get();
        return $query->result();
    }

    //detail pesan dari dosen
    public function detail_pesan($id){
        $query = $this->db->select('*');
        $this->db->from('pesan_dosen');
        $this->db->where('pesdos_id',$id);
        $this->db->set('pesdos_status',1);
        $this->db->update('pesan_dosen');
        return $query;
    }

    //info dosen pembimbing pada dashboard mahasiswa
    function dospem_dashboard($id){
            $this->db->select('a.*, b.*, c.*, d.*, GROUP_CONCAT(c.dsn_nama ORDER BY a.pemb_id) as dosen');
            $this->db->from('pembimbing a');
            $this->db->join('mahasiswa b', 'a.mhs_id = b.mhs_id');
            $this->db->join('dosen c', 'a.dsn_id = c.dsn_id');
            $this->db->join('judul d', 'd.mhs_id = b.mhs_id');
            $this->db->where('b.mhs_id', $id);
            $this->db->where('d.jdl_status', 'AKTIF');
            $this->db->group_by('d.jdl_judul');
            $this->db->order_by('d.jdl_id','desc');
            $this->db->limit('1');
            $query = $this->db->get();
            return $query->result_array();
        }


}

?>