<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Select extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SkripsiModel');
        $this->load->model('MahasiswaModel');
        $this->load->model('DosenModel');
        $this->load->model('PembimbingModel');
    }


    public function index()
    {


        $result = [];
        $this->load->database();
        if(!empty($this->input->get("q"))){

            $this->db->like('mhs_nama', $this->input->get("q"));

            $sql_query = $this->db->select('mhs_id,name as text')

                ->limit(10)

                ->get("mahasiswa");

            $result = $sql_query->result();

        }
        echo json_encode($result);
    }
}

?>