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
	}
	public function index()
	{
		$data['page_type'] = "login";
		$this->load->view('_partials/_header');
		$this->load->view('_pages/gateway');
		$this->load->view('_partials/_footer');
	}
	public function login(){
		$data = array(
			'username' => $this->input->post('user'),
			'password' => $this->input->post('pass')
		);

		$res = $this->Post->checkUser($data);

		if($res){
			$sess_arr= array();
			foreach ($res as $r) {
				$sess_arr = array(
					'first_name' => $r->first_name,
					'last_name' => $r->last_name,
					'uname' => $r->uname
				);
			$this->session->set_userdata('current_iser',$sess_arr);
			redirect('dashboard','refresh');
			}
		}else{
			redirect('gates','refresh');
		}
	}
}
