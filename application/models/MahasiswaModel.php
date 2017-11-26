<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MahasiswaModel extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function add_mahasiswa($data)
    {
        $this->db->insert('mahasiswa', $data);
        return true;
    }

    public function get_all_mahasiswa()
    {
        $query = $this->db->get('mahasiswa');
        return $result = $query->result_array();
    }

    public function get_mahasiswa_by_id($id)
    {
        $query = $this->db->get_where('mahasiswa', array('mhs_nim' => $id));
        return $result = $query->row_array();
    }

    public function edit_mahasiswa($data, $id)
    {
        $this->db->where('mhs_nim', $id);
        $this->db->update('mahasiswa', $data);
        return true;
    }

    public function profil_mahasiswa()
    {

    }

    public function update_profil_mahasiswa()
    {

    }

    public function total_rows()
    {
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

    public function index_limit($limit, $start = 0)
    {
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
    public function update_password($id, $data)
    {
        $query = $this->db->where('mhs_id', $id);
        $this->db->update('mahasiswa', $data);
        return $query;
    }
}

?>