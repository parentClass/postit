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
		$this->load->library('encryption');
	}

	public function index($blogger_id='',$letter_from='',$letter_to='')
	{
		$blogger_id = $this->clean($blogger_id);

		$data['isLoggedIn'] = $this->session->userdata('isLoggedIn');

		// no blogger id (missing uri parameter)
		if(empty($blogger_id) || empty($data['isLoggedIn'])){
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
			case 'sendLetter':
				$this->sendLetter($letter_from,$letter_to);
				break;
			case 'writeBack':
					$this->sendLetter($letter_from,$letter_to);
					break;
		}

		$data['page_type'] = "letters";
		$data['currUser'] = $this->session->userdata('loggedInAs');
		$data['logged_blogger_data'] = json_decode($this->Post->getBloggerData('@'.$this->session->userdata('loggedInAs')),true);
		$data['viewed_blogger_data'] = json_decode($this->Post->getBloggerData('@'.$blogger_id),true);
		$data['open_letters'] = $this->getOpenLetters('@'.$data['currUser']);
		$data['posts_tags_dataset'] = $this->Post->getPostTags();
		$this->load->view('_partials/_header',$data);
    $this->load->view('_partials/_navbar',$data);
		$this->load->view('_pages/open_letters', $data);
		$this->load->view('_partials/_modals',$data);
		$this->load->view('_partials/_footer',$data);
	}

	public function sendLetter($letter_from,$letter_to){
		$data = array(
			'letter_title' => $this->encryption->encrypt($this->input->post('letter_title')),
			'letter_body' => $this->encryption->encrypt($this->input->post('letter_body')),
			'letter_from' => $letter_from,
			'letter_to' => $letter_to,
		);
		$res = $this->Post->sendLetter($data);
		return "success";
	}

	public function getOpenLetters($username){
		$data = array();
		$res = $this->Post->getOpenLetters($username);
		if(!empty($res)){
			foreach ($res as $row) {
				array_push($data,[
					"letter_title" => $this->encryption->decrypt($row['letter_title']),
					"letter_body" => $this->encryption->decrypt($row['letter_body']),
					"letter_from" => $row['letter_from'],
					"sent_at" => $row['sent_at']
				]);
			}
		}else{
			array_push($data,["letter_status"=>"No open letters."]);
		}
		return $data;
	}

	private function clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}

}
