<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function checkUser($data){
		$query = $this->db->query("SELECT user_id, uname, first_name, last_login_from 
								   FROM postit_users
								   WHERE uname='".$data['username']."'
								   AND pass='".MD5($data['password'])."'");
		if($query->num_rows()==1){
			return $query->result();
		}else{
			return false;
		}
	}

	public function lastLoggedIn($data){
		$query = $this->db->query("UPDATE postit_users
								   SET last_login_from='". $data['last_login_from'] ."'
								   WHERE user_id='". $data['user_id'] ."'");
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function countUsers(){
		$query = $this->db->query("SELECT user_id 
								   FROM postit_users");
		return count($query);
	}

	public function isUsernameTaken($username){
		$query = $this->db->query("SELECT DISTINCT user_id
								   FROM postit_users
								   WHERE uname='". $username ."'");
		if($query->num_rows()==1){
			return true;
		}else{
			return false;
		}
	}

	public function createUser($data){
		$query = $this->db->query("INSERT INTO postit_users (first_name,last_name,email,uname,pass,tagline,color_preference)
									VALUES ('". $data['first_name'] ."', '". $data['last_name'] ."', 
											'". $data['email'] ."', '". $data['username'] ."',
											'". MD5($data['password']) ."', '". $data['tagline'] . "',
											'". $data['color_preference'] ."')");
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function createUserPost($data){
		$query = $this->db->query("INSERT INTO postit_posts (user_id,title,body,creator_ip) 
								   VALUES ('". $data['user_id'] ."','". $data['post_title'] ."',
								   		   '". $data['post_body'] ."', '". $data['creator_ip'] ."')");
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function updateUserPost($data){
		$query = $this->db->query("UPDATE postit_posts
								   SET title='". $data['post_title'] ."', body='". $data['post_body'] ."'
								   WHERE id='". $data['id'] ."'");
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function deleteUserPost($user_id,$post_id){
		$query = $this->db->query("DELETE FROM postit_posts
								   WHERE id='". $post_id ."'
								   AND user_id='". $user_id ."'");
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function getUserPosts($username){
		$user_id = $this->getUserId($username);
		$query = $this->db->query("SELECT id, user_id, title, body, likes, created_at
								   FROM postit_posts
								   WHERE user_id='". $user_id ."'
								   ORDER BY created_at DESC");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function getUserPostsByUserIdAndPostId($user_id,$post_id){
		$this->db->from("postit_posts");
        $this->db->where('user_id',$user_id);
        $this->db->where('id',$post_id);
        $query = $this->db->get();
 
        return $query->row();
	}

	public function getBloggerData($username){
		$data = [];
		$query = $this->db->query("SELECT DISTINCT * FROM postit_users WHERE uname='". $username ."'");
		if($query->num_rows()==1){
			$data = $query->result();
			foreach ($data as $row) {
				array_push($data, [
					'first_name' => $row->first_name,
					'last_name' => $row->last_name,
					'username' => $row->uname,
					'email' => $row->email,
					'tagline' => $row->tagline,
					'color_preference' => $row->color_preference,
					'font_preference' => $row->font_preference,
					'password' => $row->pass,
					'user_status' => $row->isNew
				]);
			}
			return json_encode($data);
		}else{
			return false;
		}
	}

	public function getUserId($username){
		$id = [];
		$query = $this->db->query("SELECT DISTINCT user_id
								   FROM postit_users
								   WHERE uname='". $username ."'");
		if($query->num_rows()>0){
			foreach ($query->result() as $row) {
				$id = $row->user_id;
			}
			return $id;
		}else{
			return false;
		}
	}

	public function setUserStatus($user_id){
		$query = $this->db->query("UPDATE postit_users
								   SET isNew=0
								   WHERE user_id='". $user_id ."'");
		if($query){
			return true;
		}else{
			return false;
		}
	}
}

?>