<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Semester extends CI_Controller {

	public function __construct()
 	{
 		parent::__construct();
 	}

 	public function index (
	 		$add_sem_error_msg = NULL, 
	 		$add_sem_error_action = NULL, 
	 		$reg_error_msg = NULL
 		) {

        //check kung naka-login
		if($this->session->userdata('is_logged_in')) {

			$data = array (
				'current_user' => $this->session->userdata('displayname'),
				'current_username' => $this->session->userdata('username'),
				'add_sem_error_msg' => $add_sem_error_msg,
				'add_sem_error_action' => $add_sem_error_action

			);

			$this->load->view('includes/nocache');
	        $this->load->view('includes/header2');
	        $this->load->view('semester_view', $data);
	        $this->load->view('includes/footer2');

			
		}

		else {
			
			//kung hindi naka-login balik sa main page
			redirect(base_url(), 'refresh');
		}
 	}

 	public function add_semester() {

        $this->form_validation->set_rules('addsemester','Display Name','trim|required');
        $this->form_validation->set_rules('addyear','Display Name','trim|required|min_length[4]|greater_than[1997]');
        

        if($this->form_validation->run() == TRUE) {
            $data = array (
                'semester' => $this->input->post('addsemester'),
                'curriculum_year' => $this->input->post('addyear'),
                'userid' => $this->session->userdata('userid')
                
            );


            $this->load->model('schedule_model');
            $this->schedule_model->add_semester($data);

            $data = array (
            	'add_error_msg' => $add_error_msg,
            	'add_error_action' => NULL //wala lang xD
            );


            //back to semester page
            $this->load->view('includes/header2');
            $this->load->view('semester', $data);
            $this->load->view('includes/footer2');
            
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