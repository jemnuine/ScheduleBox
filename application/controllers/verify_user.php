<?php

class Verify_User extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		//i-load ang model para sa login!!
		$this->load->model('login_model');

		//check kung makakalog-in using validate() sa loob ng login_model
		$result = $this->login_model->validate();

		if(!$result || !$this->session->userdata('is_logged_in')) {

			$error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Invalid username and/or password.</div>';
            //i-trigger ung modal pag-error
            $error_action = "$('#modalLogin').modal('show')";

            $data = array (
            	'error_msg' => $error_msg,
            	'error_action' => $error_action,
            	'reg_error_msg' => NULL
            );


            //back to main page
            $this->load->view('includes/header');
            $this->load->view('content', $data);
            $this->load->view('includes/footer');
		}

		else {

			redirect(base_url() . 'index.php/members_area', 'refresh');
		}

	}
}