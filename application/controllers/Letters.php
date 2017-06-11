<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Letters extends CI_Controller {

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

	public function index($blogger_id='')
	{
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
		}

		$data['page_type'] = "letters";
		$data['currUser'] = $this->session->userdata('loggedInAs');
		$data['isLoggedIn'] = $this->session->userdata('isLoggedIn');
		$data['logged_blogger_data'] = json_decode($this->Post->getBloggerData('@'.$this->session->userdata('loggedInAs')),true);
		$data['viewed_blogger_data'] = json_decode($this->Post->getBloggerData('@'.$blogger_id),true);
		$this->load->view('_partials/_header',$data);
    $this->load->view('_partials/_navbar',$data);
		$this->load->view('_pages/open_letters', $data);
		$this->load->view('_partials/_modals',$data);
		$this->load->view('_partials/_footer',$data);
	}


	private function clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
}
