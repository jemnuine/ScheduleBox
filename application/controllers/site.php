<?php

class Site extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	function index($error_msg = NULL, $error_action = NULL, $reg_error_msg = NULL) {

		//kung may error sa pag-login ipapasa niya sa array na to
		$data = array (
			'error_msg' => $error_msg,
			'error_action' => $error_action,
			'reg_error_msg' => $reg_error_msg,
			//lumalabas kasi undefined pag-nagback button kaya aun dito ko nalang isingit
			'current_user' => $this->session->userdata('displayname'),
			'current_username' => $this->session->userdata('username')

		);

		//check kung naka-login
		if($this->session->userdata('is_logged_in')) {

			redirect(base_url() . 'index.php/members_area', 'refresh');
		}
		else {
			
			$this->load->view('includes/nocache');
			$this->load->view('includes/header');
    		$this->load->view('content', $data);
    		$this->load->view('includes/footer');
		}
	}
}