<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add_admin($data)
    {
        $this->db->insert('admin', $data);
        return true;
    }

    public function get_all_admin()
    {
        $query = $this->db->get('admin');
        return $result = $query->result_array();
    }

    public function get_admin_by_id($id)
    {
        $query = $this->db->get_where('admin', array('adm_nip' => $id));
        return $result = $query->row_array();
    }

    public function edit_admin($data, $id)
    {
        $this->db->where('adm_nip', $id);
        $this->db->update('admin', $data);
        return true;
    }

    public function profile_admin()
    {

    }

    public function update_profil()
    {

    }

    public function total_rows()
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->from('admin')
                ->like('adm_nip', $_GET['keyword'])
                ->or_like('adm_nama', $_GET['keyword'])
                ->or_like('adm_nohp', $_GET['keyword'])
                ->or_like('adm_alamat', $_GET['keyword'])
                ->or_like('adm_email', $_GET['keyword'])
                ->or_like('adm_level', $_GET['keyword'])
                ->order_by('adm_nip', 'DESC')
                ->count_all_results();
        } else {
            return $this->db->from('admin')
                ->count_all_results();
        }
    }

    public function index_limit($limit, $start = 0)
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->select('*')
                ->from('admin')
                ->like('adm_nip', $_GET['keyword'])
                ->or_like('adm_nama', $_GET['keyword'])
                ->or_like('adm_nohp', $_GET['keyword'])
                ->or_like('adm_alamat', $_GET['keyword'])
                ->or_like('adm_email', $_GET['keyword'])
                ->or_like('adm_level', $_GET['keyword'])
                ->order_by('adm_nip', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        } else {
            return $this->db->select('*')
                ->from('admin')
                ->order_by('adm_nip', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        }

    }
}

?>