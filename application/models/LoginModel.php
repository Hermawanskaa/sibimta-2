<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
  class LoginModel extends CI_Model {
      public function __construct(){
          parent::__construct();
      }

public function login($table, $data){
    return $this->db->get_where($table,$data);
    }

    public function change_pwd($data, $id){
      $this->db->where('id', $id);
      $this->db->update('ci_users', $data);
      return true;
    }


public function mahasiswa(){
  echo $username = $this->security->xss_clean($this->input->post('username'));
  echo $password = $this->security->xss_clean($this->input->post('password'));
  
  $this->db->where('id_member',$username);
  $this->db->where('pass',$password);
  $query = $this->db->get('mahasiswa');
  if($query->num_rows !=0){
    $row = $query->row();
    $data = array(
      'id_member' => $row->id_member,
      'nama' => $row->nama,
      'foto' => $row->foto,
      'validated' =>true
      );
    $this->session->set_userdata('login',$data);
    return true;
  }
  return false;
}

public function dosen(){
  echo $username = $this->security->xss_clean($this->input->post('username'));
  echo $password = $this->security->xss_clean($this->input->post('password'));

  $this->db->where('id_member',$username);
  $this->db->where('pass',$password);
  $query = $this->db->get('mahasiswa');
  if($query->num_rows !=0){
    $row = $query->row();
    $data = array(
      'id_member' => $row->id_member,
      'nama' => $row->nama,
      'foto' => $row->foto,
      'validated' =>true
      );
    $this->session->set_userdata('login',$data);
    return true;
  }
  return false;
  
}

public function kajur(){
  echo $username = $this->security->xss_clean($this->input->post('username'));
  echo $password = $this->security->xss_clean($this->input->post('password'));

  $this->db->where('id_member',$username);
  $this->db->where('pass',$password);
  $query = $this->db->get('mahasiswa');
  if($query->num_rows !=0){
    $row = $query->row();
    $data = array(
      'id_member' => $row->id_member,
      'nama' => $row->nama,
      'foto' => $row->foto,
      'validated' =>true
      );
    $this->session->set_userdata('login',$data);
    return true;
  }
  return false;
  
}

public function admin(){
  echo $username = $this->security->xss_clean($this->input->post('username'));
  echo $password = $this->security->xss_clean($this->input->post('password'));

  $this->db->where('id_member',$username);
  $this->db->where('pass',$password);
  $query = $this->db->get('mahasiswa');
  if($query->num_rows !=0){
    $row = $query->row();
    $data = array(
      'id_member' => $row->id_member,
      'nama' => $row->nama,
      'foto' => $row->foto,
      'validated' =>true
      );
    $this->session->set_userdata('login',$data);
    return true;
  }
  return false;
  
}









      function cek($username, $password) {
        $this->db->where("id_member", $username);
        $this->db->where("pass", $password);
        return $this->db->get("admin");
      }

      function getLoginData($usr, $psw) {
        $u = $usr;
        $p = $psw;
        $q_cek_login = $this->db->get_where('admin', array('id_member' => $u, 'pass' => $p));
        if (count($q_cek_login->result()) > 0) {
          foreach ($q_cek_login->result() as $qck) {
            foreach ($q_cek_login->result() as $qad) {
              $sess_data['logged_in'] = TRUE;
              $sess_data['id_member'] = $qad->id_member;
              $sess_data['pass'] = $qad->pass;
              $sess_data['nama'] = $qad->nama;
              $sess_data['no_hp'] = $qad->no_hp;
              $this->session->set_userdata($sess_data);
            }
          redirect('admin');
          }
        } else {
            $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
            header('location:' . base_url() . 'login');
          }
      }
  }
?>
