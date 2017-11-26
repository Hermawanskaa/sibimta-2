<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SkripsiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add_skripsi($data)
    {
        $this->db->insert('judul', $data);
        return true;
    }

    public function get_all_skripsi()
    {
        $query = $this->db->get('judul');
        return $result = $query->result_array();
    }

    public function get_judul_by_id($id)
    {
        $query = $this->db->get_where('judul', array('jdl_id' => $id));
        return $result = $query->row_array();
    }

    public function edit_judul($data, $id)
    {
        $this->db->where('jdl_id', $id);
        $this->db->update('jdl_id', $data);
        return true;
    }

    public function total_rows()
    {
        if (!empty($_GET['keyword'])) {
            return $this->db->from('judul')
                ->like('mhs_id', $_GET['keyword'])
                ->or_like('jdl_id', $_GET['keyword'])
                ->or_like('jdl_judul', $_GET['keyword'])
                ->or_like('jdl_deskripsi', $_GET['keyword'])
                ->or_like('jdl_enjudul', $_GET['keyword'])
                ->or_like('jdl_status', $_GET['keyword'])
                ->or_like('jdl_tanggal', $_GET['keyword'])
                ->order_by('jdl_id', 'DESC')
                ->count_all_results();
        } else {
            return $this->db->from('judul')
                ->count_all_results();
        }
    }

    public function index_limit($limit, $start = 0)
    {
        if (!empty($_GET['keyword'])) {
            return $this->db->select('*')
                ->from('judul')
                ->like('mhs_id', $_GET['keyword'])
                ->or_like('jdl_id', $_GET['keyword'])
                ->or_like('jdl_judul', $_GET['keyword'])
                ->or_like('jdl_deskripsi', $_GET['keyword'])
                ->or_like('jdl_enjudul', $_GET['keyword'])
                ->or_like('jdl_status', $_GET['keyword'])
                ->or_like('jdl_tanggal', $_GET['keyword'])
                ->order_by('jdl_id', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        } else {
            return $this->db->select('*')
                ->from('judul')
                ->order_by('jdl_id', 'DESC')
                ->limit($limit, $start)
                ->get()->result();
        }
    }

    public function check_status($id)
    {
        $this->db->select('mhs_id');
        $this->db->where('jdl_id', $id);
        $sql = $this->db->get('judul');

        foreach ($sql->result() as $key) {
            $mhs = $key->mhs_id;

            //cek count approval
            $this->db->select('*');
            $this->db->from('judul');
            $this->db->where('judul.mhs_id', $mhs);
            $cek = $this->db->get();

            //jika mahasiswa telah mengambil judul tugas akhir
            if ($cek->num_rows() <> 0) {
                $result = 'lebih';
            } else {
                //cek pembagian dospem
                $this->db->select('mhs_id');
                $this->db->from('pembimbing');
                $this->db->where('mhs_id', $mhs);
                $query = $this->db->get();

                #sudah ada dospem
                if ($query->num_rows() <> 0) {
                    $this->db->where('jdl_id', $id);
                    $this->db->update('judul');
                    $result = 'ada';
                    //jika belum mendapat dospem update status==DISETJUI
                } else {
                    $this->db->where('jdl_id', $id);
                    $this->db->update('judul');
                    $result = $mhs; //jangan diganti !
                }
            }
        }
    }

    public function add_dospem($mhsid){

        $this->db->select('*');
        $this->db->where('mhs_id',$mhsid);
        $this->db->where('pembimbing1',1);
        $p1 = $this->db->get('pembimbing');
        foreach($p1->result() as $sq1){}

        $this->db->select('*');
        $this->db->where('mhs_id',$mhsid);
        $this->db->where('pembimbing2',1);
        $p2 = $this->db->get('pembimbing');
        foreach($p2->result() as $q2){}

        $data = array(
            'pemb_id'=>null,
            'mhs_id'=>$mhsid,
            'dsn_id'=>$sq1->pgw_id,
            'pembimbing1'=>'1',
            'pembimbing2'=>'0',
        );
        $this->db->insert('pembimbing',$data);

        $data2 = array(
            'pemb_id'=>null,
            'mhs_id'=>$mhsid,
            'dsn_id'=>$sq1->pgw_id,
            'pembimbing1'=>'0',
            'pembimbing2'=>'1',
        );
        $this->db->insert('pembimbing',$data2);
    }
}
?>
