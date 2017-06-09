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
		$outcome = $this->db->insert('postit_users',$data);
		if($outcome){
			return true;
		}else{
			return false;
		}
	}

	public function createUserPost($data){
		$outcome = $this->db->insert('postit_posts',$data);
		if($outcome){
			return true;
		}else{
			return false;
		}
	}

	public function updateUserPost($data){
		$outcome = $this->db->replace('postit_posts',$data);
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
		$query = $this->db->query("SELECT id, user_id, title, body, likes, tags, created_at
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
					'user_status' => $row->isNew,
					'facebook_url' => $row->facebook_url,
					'twitter_url' => $row->twitter_url,
					'instagram_url' => $row->instagram_url
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

	public function getPostTags(){
		$query = $this->db->query("SELECT * FROM postit_tags");
		return json_decode(json_encode($query->result()),true);
	}

	public function getCurrentPostTags(&$tag_name){
		$temp = array();
		$tags = array();

		// sanitize tag_name
		$foo = explode(",", json_encode($tag_name));
		$foo = str_replace("\"", "", $foo);

		// add ' in both start and end of a tag
		for ($i=0; $i < count($foo); $i++) { 
			$temp[] = "'".$foo[$i]."'";
		}

		// assembling things with ,
		$temp = implode(",", $temp);


		$query = $this->db->query("SELECT * FROM postit_tags WHERE tag_name IN (". $temp .")");

		foreach ($query->result() as $row) {
			array_push($tags, [
				'tag_name' => $row->tag_name,
				'tag_emoji' => $row->tag_emoji
			]);
		}

		return $tags;
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