<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
  class LoginModel extends CI_Model {
      public function __construct(){
          parent::__construct();
      }

    public function login($table, $data){
        return $this->db->get_where($table,$data);
    }

}

?>
