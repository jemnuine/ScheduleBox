<?php

class site extends CI_Controller {

	public function __construct()
 	{
 		parent::__construct();
 	}

	public function index($msg = NULL, $error = NULL) {
		//$path = $this->config->item('server_root');
		//echo $path;
		$data['msg'] = $msg;
		$data['error'] = $error;
        $this->session->sess_destroy();
        if($this->session->userdata('validated') == FALSE) {
    		$this->load->view('includes/header');
    		$this->load->view('main', $data);
    		$this->load->view('includes/footer');
        }
        else {
            $data['dd'] = "$('.dropdown-menu').dropdown();";
            $data['current_username'] = $this->session->userdata('username');
            $data['current_user'] = $this->session->userdata('displayname');
            
            $this->load->view('includes/header');
            $this->load->view('home', $data);
            $this->load->view('includes/footer2', $data);
        }

	}

	public function process() {
        // Load the model
        $this->load->model('login_model');
        // Validate the user can login
        $result = $this->login_model->validate();
        // Now we verify the result
        if(! $result){
            // If user did not validate, then show them login page again
            $msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Invalid username and/or password.</div>';
            $error = "$('#modalLogin').modal('show')";
            $this->index($msg, $error);

        } 
        else {
            // If user did validate, 
            // Send them to members area
            //redirect('home');
            $data['current_user'] = $this->session->userdata('displayname');
            $this->load->view('includes/header');
            $this->load->view('home', $data);
            $this->load->view('includes/footer2');
        }        
    }

    public function create_user() {

        $this->form_validation->set_rules('regdisplayname','Display Name','trim|required');
        $this->form_validation->set_rules('regusername','Username','trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('regpassword','Password','trim|required');
        $this->form_validation->set_rules('regconfirm','Confirm Password','trim|required|matches[regpassword]');
        

        

        if($this->form_validation->run() == TRUE) {
            $data = array(
                'username' => $this->input->post('regusername'),
                'password' => do_hash($this->input->post('regpassword'), 'md5'),
                'displayname' => $this->input->post('regdisplayname')
            );

            $this->load->model('register_model');
            $this->register_model->add_user($data);
            $error = "$('#modalLogin').modal('show')";
            $this->index('', $error);
        }
        else
        {
            $msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>' . validation_errors() . '</div>';
            $error = "$('#modalRegister').modal('show')";
            $this->index($msg, $error);
        }
    }
}