<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Members_Area extends CI_Controller {

	public function __construct()
 	{
 		parent::__construct();
 	}

 	public function index () {

        //check kung naka-login
		if($this->session->userdata('is_logged_in')) {

			$data = array (
			'current_user' => $this->session->userdata('displayname'),
			'current_username' => $this->session->userdata('username')

			);

			$this->load->view('includes/nocache');
	        $this->load->view('includes/header2');
	        $this->load->view('home', $data);
	        $this->load->view('includes/footer2');

			
		}
		else {
			
			//kung hindi naka-login balik sa main page
			redirect(base_url(), 'refresh');
		}
 	}

}