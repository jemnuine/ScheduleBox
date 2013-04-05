<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Instructors extends CI_Controller {

	public function __construct()
 	{
 		parent::__construct();
 	}

 	public function index (
	 		$add_instructor_error_msg = NULL, 
	 		$add_instructor_error_action = NULL, 
	 		$reg_error_msg = NULL
 		) {

        //check kung naka-login
		if($this->session->userdata('is_logged_in')) {

			$data = array (
				'current_user' => $this->session->userdata('displayname'),
				'current_username' => $this->session->userdata('username'),
				'add_instructor_error_msg' => $add_instructor_error_msg,
				'add_instructor_error_action' => $add_instructor_error_action

			);

			$this->load->model('instructor_model');

            if($query = $this->instructor_model->list_instructor()) {

                $data['records'] = $query;
            }


			$this->load->view('includes/nocache');
	        $this->load->view('includes/header2');
	        $this->load->view('instructors_view', $data);
	        $this->load->view('includes/instructor_footer');

			
		}

		else {
			
			//kung hindi naka-login balik sa main page
			redirect(base_url(), 'refresh');
		}
 	}

 	public function add_instructor() {

        $this->form_validation->set_rules('addInstructor','Instructor Name','trim|required');

        if($this->form_validation->run() == TRUE) {
            $data = array (
                'instructor_name' => $this->input->post('addInstructor'),
                'userid' => $this->session->userdata('userid')   
            );


            $this->load->model('instructor_model');
            $this->instructor_model->add_instructor($data);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
            	'add_instructor_error_msg' => NULL,
            	'add_instructor_error_action' => NULL //wala lang xD
            );

            redirect(base_url() . 'index.php/instructors', 'refresh');   
            
        }
        else
        {

            $add_instructor_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>' . validation_errors() . '</div>';
            $add_instructor_error_action = "$('#modalAddInstructor').modal('show');";

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_instructor_error_msg' => $add_instructor_error_msg,
                'add_instructor_error_action' => $add_instructor_error_action
            );

            $this->load->model('instructor_model');

            if($query = $this->instructor_model->list_instructor()) {
                $data['records'] = $query;
            } else {
            	$data['records'] = $query;
            }

            if(!$data['records']) {
                //$add_instructor_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>The record is existing!</div>';
                $add_instructor_error_action = "$('#modalAddInstructor').modal('show');";
                $data = array (
                    'current_user' => $this->session->userdata('displayname'),
                    'current_username' => $this->session->userdata('username'),
                    'add_instructor_error_msg' => $add_instructor_error_msg,
                    'add_instructor_error_action' => $add_instructor_error_action
                );

            }

            $this->session->set_userdata($data);

			$this->load->view('includes/nocache');
			$this->load->view('includes/header2');
    		$this->load->view('instructors_view', $data);
    		$this->load->view('includes/instructor_footer', $data);

            
        }
    }

    public function list_edit_subject (
            $add_instructor_error_msg = NULL, 
            $add_instructor_error_action = NULL, 
            $reg_error_msg = NULL

        ) {

        $data = array (
                'userid' => $this->session->userdata('userid')   
            );


        $this->load->model('instructor_model');

        //kinuha lang ung department id galing sa view
        $instructor_id = $this->input->post('dataid');

        //check kung ajax request
        if($this->input->post('ajax')) {

            //ni-recycle ko lng ung sa addsem na modal trigger
            $add_instructor_error_action = "$('#modalEditInstructor').modal('show');"; 

            $query = $this->instructor_model->get_instructor_name($subject_id);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_instructor_error_msg' => $add_instructor_error_msg,
                'add_instructor_error_action' => $add_instructor_error_action,
                'dataid' => $subject_id,
                'iname' => $query
                
            );

            $this->session->set_userdata($data); //the trick!! mawawala na ung ajax request next time eh
            
            echo implode('', $data['iname']);
            

        } else {

        	$this->form_validation->set_rules('addInstructor','Instructor Name','trim|required');
	        

	        if($this->form_validation->run() == TRUE) {
	            $iname = $this->input->post('editCode');

	            //kinuha ung session ng dept id
	            $subject_id = $this->session->userdata('dataid');
	            $this->instructor_model->update_instructor($instructor_id, $iname);
	            redirect(base_url().'index.php/instructors');
	        } else {

	        	redirect(base_url().'index.php/instructors');
	        }
	        
        }
    }

    public function delete_instructor ($id = NULL) {

        $this->load->model('instructor_model');
        $this->instructor_model->delete_instructor($id);
        redirect(base_url().'index.php/instructors');
        return;
    }

    public function delete_all_instructor () {
        $this->load->model('instructor_model');
        $this->instructor_model->delete_all_instructor();
        redirect(base_url().'index.php/instructors');
        return;
    }

}