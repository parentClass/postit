<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gates extends CI_Controller {

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
		$this->load->model('Post');
		$this->load->library('session');
	}

	public function index()
	{
		$data['page_type'] = "login";
		$this->load->view('_partials/_header',$data);
		$this->load->view('_pages/gateway', $data);
		$this->load->view('_partials/_footer',$data);
	}

	public function login(){
		$container = [];
		$data = array(
			'username' => "@". $this->clean(str_replace(' ', '', $this->input->post('username'))),
			'password' => $this->input->post('password')
		);

		$res = $this->Post->checkUser($data);

		if($res){
			foreach ($res as $row) {
				$container = array(
					'user_id' => $row->user_id,
					'username' => $row->uname,
					'first_name' => $row->first_name,
					'last_login_from' => $this->input->ip_address()
				);
			}

			$this->Post->lastLoggedIn($container);

			$this->session->set_userdata('isLoggedIn',true);
			$this->session->set_userdata('user_id', $container['user_id']);
			$this->session->set_userdata('loggedInAs', $this->clean($container['username']));
			$this->session->set_flashdata('success_msg',"Welcome " . $container['first_name'] . "! Glad to see you today.");
			redirect('blog/'. $this->clean($data['username']),'refresh');
		}else{
			$this->session->set_flashdata("error_msg","Invalid login credentials!");
			redirect('/','refresh');
		}
	}

	public function register(){
		$data = array(
			'first_name' => $this->input->post('firstname'),
			'last_name' => $this->input->post('lastname'),
			'username' => "@". $this->clean($this->input->post('username')),
			'email' => $this->input->post('email'),
			'tagline' => $this->input->post('tagline'),
			'color_preference' => $this->input->post('color_preference'),
			'password' => $this->input->post('password')
		);

		$isUsernameTaken = $this->Post->isUsernameTaken($data['username']);

		if(!$isUsernameTaken){
			if($data['username']!="@"){
				$res = $this->Post->createUser($data);

				if($res){
					$this->session->set_flashdata("signup_success_msg","Thanks " . ucfirst($data['first_name']) . " for joining the community.</br>The blogging begins and may the posts be with you.");
					redirect('/','refresh');
				}else{
					$this->session->set_flashdata("signup_failed_msg","Sorry, I wasn't able to sign you up.");
					redirect('/','reresh');
				}
			}else{
				$this->session->set_flashdata("username_invalid_msg","Aww, That username is not valid.");
				redirect('/','reresh');
			}
		}else{
			$this->session->set_flashdata("username_taken_msg", "Sorry " . ucfirst($data['first_name']) . ", but the username " . $data['username'] . " is already taken by another blogger.");
			redirect('/','reresh');
		}
	}

	private function clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
}
