<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();

		header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "OPTIONS") {
        die();
    }
		
		$this->load->database();
		$this->load->model('Post');
		$this->load->library('session');
	}

	public function index($blogger_id='',$user_id='',$post_id=''){

		$blogger_id = $this->clean($blogger_id);

		// no blogger id (missing uri parameter)
		if(empty($blogger_id)){
			redirect('/','refresh');
		}

		// blogger id casing
		switch ($blogger_id) {
			case 'logout':
				$this->logout();
				break;
			case 'userPost':
				$this->userPost();
				break;
			case 'retrieveUserPost':
				$this->userPostByUserIdAndPostId($user_id,$post_id);
				break;
			case 'updatePost':
				$this->updateUserPost($user_id,$post_id);
				break;
			case 'deletePost':
				$this->deleteUserPost($user_id,$post_id);
				break;
		}

		if($this->Post->isUsernameTaken('@'.$blogger_id)){

			$data['currUser'] = $this->session->userdata('loggedInAs');
			$data['isLoggedIn'] = $this->session->userdata('isLoggedIn');
			$data['logged_blogger_data'] = json_decode($this->Post->getBloggerData('@'.$this->session->userdata('loggedInAs')),true);
			$data['viewed_blogger_data'] = json_decode($this->Post->getBloggerData('@'.$blogger_id),true);
			$data['user_post_count'] = json_decode($this->Post->countUserPosts('@'.$this->session->userdata('loggedInAs')),true);
			$data['posts_data'] = $this->displayUserPosts('@'.$blogger_id);
			$data['posts_tags_dataset'] = $this->Post->getPostTags();
 			$data['page_type'] = "dashboard";
			$this->load->view('_partials/_header',$data);
			$this->load->view('_pages/board',$data);
			$this->load->view('_partials/_modals',$data);
			$this->load->view('_partials/_footer',$data);

		}else{
			redirect('_','refresh');
		}
	}

	public function logout(){
		$data = $this->session->all_userdata();
		foreach ($data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
		}

		$this->session->sess_destroy();
		redirect('/','refresh');
	}

	public function userPost(){
		$user_id = $this->session->userdata('user_id');

		$post_tags = implode(',', $this->input->post('post_tag'));

		if(empty($post_tags)){
			$post_tags = "Unspecified";
		}

		$data = array(
			'user_id' => $user_id,
			'title' => $this->security->xss_clean($this->input->post('post_title')),
			'body' => $this->security->xss_clean($this->input->post('post_body')),
			'tags' => $post_tags,
			'creator_ip' => $this->input->ip_address()
		);

		$res = $this->Post->createUserPost($data);

		$this->Post->setUserStatus($user_id);
	}

	public function displayUserPosts($blogger_id){
		$temp = array();
		$tags = array();

		$x = $this->Post->getUserPosts($blogger_id);

		$foo = json_decode(json_encode($x),true);

		for ($i=0; $i < count($foo); $i++) {
			$tags[] = $foo[$i]['tags'];
		}


		if(!empty($x)){
			for ($i=0; $i < count($foo); $i++) {
				array_push($temp, [
					'id' => $foo[$i]['id'],
					'user_id' => $foo[$i]['user_id'],
					'post_title' => $foo[$i]['title'],
					'post_body' => $foo[$i]['body'],
					'post_likes' => $foo[$i]['likes'],
					'post_tags' => $this->Post->getCurrentPostTags($foo[$i]['tags']),
					'post_tags_count' => count(explode(",", json_encode($foo[$i]['tags']))),
					'post_date' => $foo[$i]['created_at']
				]);
			}
		}else{
			array_push($temp, [
				"post_warning"=>"No adventures shared yet."
			]);
		}
		return $temp;
	}

	public function userPostByUserIdAndPostId($user_id,$post_id){
		$data = $this->Post->getUserPostsByUserIdAndPostId($user_id,$post_id);
		echo json_encode($data);
	}

	public function updateUserPost($user_id,$post_id){
		$post_tags = implode(',', $this->input->post('post_tag'));


		$data = array(
			'id' => $post_id,
			'user_id' => $user_id,
			'title' => $this->security->xss_clean($this->input->post('post_title')),
			'body' => $this->security->xss_clean($this->input->post('post_body')),
			'tags' => $post_tags
		);

		$res = $this->Post->updateUserPost($data);
	}

	public function deleteUserPost($user_id,$post_id){
		$status = array();
		$res = $this->Post->deleteUserPost($user_id,$post_id);
		if($res){
			array_push($status,[
				"status" => 200,
				"delete_ops" => "success"
			]);
		}else{
			array_push($status,[
				"status" => 200,
				"delete_ops" => "failed"
			]);
		}
		echo json_encode($status);
	}

	private function clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
}
