<?php

class Register_User extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {

        $this->form_validation->set_rules('regdisplayname','Display Name','trim|required');
        $this->form_validation->set_rules('regusername','Username','trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('regpassword','Password','trim|required');
        $this->form_validation->set_rules('regconfirm','Confirm Password','trim|required|matches[regpassword]'); 

        if($this->form_validation->run() == TRUE) {
            
            $data = array (
                'username' => $this->input->post('regusername'),
                'password' => do_hash($this->input->post('regpassword'), 'md5'),
                'displayname' => $this->input->post('regdisplayname')
            );


            $this->load->model('register_model');
            $this->register_model->add_user($data);

            $error_msg = '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button>' . 'Registration Successful!' . '</div>';
            //ni-recycle ko lang basta mag-ppop ung login after successful registration
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
        else
        {
            $reg_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>' . validation_errors() . '</div>';
            $error_action = "$('#modalRegister').modal('show')";

            $data = array (
				'error_msg' => NULL,
				'error_action' => $error_action,
				'reg_error_msg' => $reg_error_msg
			);

			$this->load->view('includes/nocache');
			$this->load->view('includes/header');
    		$this->load->view('content', $data);
    		$this->load->view('includes/footer');
            
        }
    }

}