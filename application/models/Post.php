<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function checkUser($data){
		$query = $this->db->query("SELECT * FROM postit_users WHERE uname='".$data['username']."' AND pass='".MD5($data['password'])."'");
		if($query->num_rows()==1){
			return $query->result();
		}else{
			return false;
		}
	}

}


?>