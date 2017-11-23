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
        $query = $this->db->get_where('mahasiswa', array('nim' => $id));
        return $result = $query->row_array();
    }

    public function edit_mahasiswa($data, $id)
    {
        $this->db->where('nim', $id);
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
                ->like('nim', $_GET['keyword'])
                ->or_like('nama', $_GET['keyword'])
                ->or_like('no_hp', $_GET['keyword'])
                ->or_like('alamat', $_GET['keyword'])
                ->or_like('email', $_GET['keyword'])
                ->or_like('angkatan', $_GET['keyword'])
                ->or_like('id_jurusan', $_GET['keyword'])
                ->order_by('nim', 'DESC')
                ->count_all_results();
        } else {
            return $this->db->from('mahasiswa')
                ->count_all_results();
        }
    }

    public function index_limit($limit, $start = 0)
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->select('*')
                ->from('mahasiswa')
                ->like('nim', $_GET['keyword'])
                ->or_like('nama', $_GET['keyword'])
                ->or_like('no_hp', $_GET['keyword'])
                ->or_like('alamat', $_GET['keyword'])
                ->or_like('email', $_GET['keyword'])
                ->or_like('angkatan', $_GET['keyword'])
                ->or_like('id_jurusan', $_GET['keyword'])
                ->order_by('nim', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        } else {
            return $this->db->select('*')
                ->from('mahasiswa')
                ->join('jurusan', 'jurusan.id_jurusan = mahasiswa.id_jurusan')
                ->order_by('nim', 'DESC')
                ->limit($limit, $start)
                ->get()->result();

        }

    }
}

?>