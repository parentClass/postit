<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Model {

	public function __construct(){
		header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "OPTIONS") {
        die();
    }

		parent::__construct();
		$this->load->database();
	}

	public function addBuddyUser($user_one,$user_two){
		$uo_uname = $this->getUserName($user_one);
		$ut_uname = $this->getUserName($user_two);

		$data = array(
					"requestee_uid"=> $user_two,
					"requestee_username"=> $ut_uname,
					"requester_uid"=> $user_one,
					"requester_username"=>	 $uo_uname
		); //uid,username, uid,username

		$outcome = $this->db->insert('postit_buddy_requests',$data);
		if($outcome){
			return true;
		}else{
			return false;
		}
	}

	public function acceptBuddyRequest($user_one,$user_two){
		$uo_uname = $this->getUserName($user_one);
		$ut_uname = $this->getUserName($user_two);

		$outcome = $this->removeBuddyUserRequest($user_one,$user_two);

		if($outcome){
			$query = $this->db->query("INSERT INTO postit_buddy_list (requestee_uid,requestee_username,requester_uid,requester_username)
																   VALUES ('".$user_one."','".$uo_uname."','".$user_two."','".$ut_uname."') ");
			if($query){
				$this->updateBuddyCount($user_one,$user_two);
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function updateBuddyCount($uo_id,$ut_id){
		$query = $this->db->query("UPDATE postit_users
								   SET buddy_count = buddy_count + 1
									 WHERE user_id IN ('".$uo_id."','".$ut_id."')");
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function removeBuddyUserRequest($user_one,$user_two){
		$query = $this->db->query("DELETE FROM postit_buddy_requests
								   WHERE requestee_uid='". $user_one ."'
								   AND requester_uid='". $user_two ."' 
									 OR requestee_uid='". $user_two ."'
								   AND requester_uid='". $user_one ."' ");
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function removeBuddyUser($user_one,$user_two){
		$query = $this->db->query("DELETE FROM postit_buddy_list
								   WHERE requestee_uid='". $user_one ."'
								   AND requester_uid='". $user_two ."'");
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function getBuddyRequests($uname){
		$status = [];
		$query = $this->db->query("SELECT DISTINCT requester_uid,requester_username, status
									 FROM postit_buddy_requests
									 WHERE requestee_username='". $uname ."' AND status='1'");
		if($query->num_rows()>0){
			foreach ($query->result() as $row) {
				array_push($status,[
					"requester" => $row->requester_username,
					"requester_uid" => $row->requester_uid,
					"status" => $row->status
				]);
			}
			return $status;
		}else{
			return $status;
		}
	}

	public function getBuddyStatus($user_one,$user_two){
		$status = [];
		$query = $this->db->query("SELECT DISTINCT status
									 FROM postit_buddy_requests
									 WHERE requestee_username='". $user_one ."'
									 AND requester_username='". $user_two ."' OR requestee_username='". $user_two ."' AND requester_username='". $user_one ."'");

		if($query->num_rows()>0){
			foreach ($query->result() as $row) {
				$status = $row->status;
			}
			return $status;
		}else{
			return $status;
		}
	}

	public function checkIfBuddy($user_one,$user_two){
		$query = $this->db->query("SELECT id
								   FROM postit_buddy_list
								   WHERE requestee_username='".$user_one."' AND requester_username='".$user_two."'
									 OR requestee_username='".$user_two."' AND requester_username='".$user_one."'");
		if($query->num_rows()==1){
			return true;
		}else{
			return false;
		}
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

	public function getUserName($uid){
		$uname = [];
		$query = $this->db->query("SELECT DISTINCT uname
									 FROM postit_users
									 WHERE user_id='". $uid ."'");
		if($query->num_rows()>0){
			foreach ($query->result() as $row) {
				$uname = $row->uname;
			}
			return $uname;
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

	public function countUserPosts($username){
		$user_id = $this->getUserId($username);
		$query = $this->db->query("SELECT id FROM postit_posts WHERE user_id='". $user_id ."'");
		$outcome = $query->result();
		return json_encode($outcome);
	}

	public function countUserLikes($username){
		$user_id = $this->getUserId($username);
		$query = $this->db->query("SELECT likes FROM postit_posts WHERE user_id='". $user_id ."'");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function countUserBuddy($username){
		$query = $this->db->query("SELECT buddy_count FROM postit_users WHERE uname='". $username ."'");
		$outcome = $query->result();
		return json_encode($outcome[0]);
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
		$query = $this->db->query("SELECT DISTINCT user_id,first_name,last_name,uname,email,tagline,color_preference,font_preference,isNew,facebook_url,twitter_url,instagram_url
			 														FROM postit_users WHERE uname='". $username ."'");
		if($query->num_rows()==1){
			foreach ($query->result() as $row) {
				array_push($data, [
					'user_id' => $row->user_id,
					'first_name' => $row->first_name,
					'last_name' => $row->last_name,
					'uname' => $row->uname,
					'email' => $row->email,
					'tagline' => $row->tagline,
					'color_preference' => $row->color_preference,
					'font_preference' => $row->font_preference,
					'user_status' => $row->isNew,
					'facebook_url' => $row->facebook_url,
					'twitter_url' => $row->twitter_url,
					'instagram_url' => $row->instagram_url,
					'isNew' => $row->isNew
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
