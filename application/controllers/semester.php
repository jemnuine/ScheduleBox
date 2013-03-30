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

            $this->load->model('schedule_model');

            if($query = $this->schedule_model->list_semester()) {
                $data['records'] = $query;
            }

			$this->load->view('includes/nocache');
	        $this->load->view('includes/header2');
	        $this->load->view('semester_view', $data);
	        $this->load->view('includes/semester_footer');
		}

		else {
			
			//kung hindi naka-login balik sa main page
			redirect(base_url(), 'refresh');
		}
 	}

 	public function add_semester() {

        $this->form_validation->set_rules('addsemester','Semester','trim|required');
        $this->form_validation->set_rules('addyear','Year','trim|required|min_length[4]|greater_than[1997]');
        

        if($this->form_validation->run() == TRUE) {
            $data = array (
                'semester' => $this->input->post('addsemester'),
                'curriculum_year' => $this->input->post('addyear'),
                'userid' => $this->session->userdata('userid')
                
            );


            $this->load->model('schedule_model');
            $this->schedule_model->add_semester($data);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
            	'add_sem_error_msg' => NULL,
            	'add_sem_error_action' => NULL //wala lang xD
            );

            redirect(base_url() . 'index.php/semester', 'refresh');   
            
        }
        else
        {

            $add_sem_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>' . validation_errors() . '</div>';
            $add_sem_error_action = "$('#modalAddSemester').modal('show');";

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_sem_error_msg' => $add_sem_error_msg,
                'add_sem_error_action' => $add_sem_error_action
            );

            $this->load->model('schedule_model');

            if($query = $this->schedule_model->list_semester()) {
                $data['records'] = $query;
            }

			$this->load->view('includes/nocache');
			$this->load->view('includes/header2');
    		$this->load->view('semester_view', $data);
    		$this->load->view('includes/semester_footer', $data);
            
        }
    }

    public function list_edit_semester (
            $add_sem_error_msg = NULL, 
            $add_sem_error_action = NULL, 
            $reg_error_msg = NULL
        ) {

        $data = array (
                'semester' => $this->input->post('addsemester'),
                'curriculum_year' => $this->input->post('addyear'),
                'userid' => $this->session->userdata('userid')
                
            );


        $this->load->model('schedule_model');

        //check kung ajax request
        if($this->input->post('ajax')) {
            //kinuha lang ung curriculum id galing sa view
            $curriculum_id = $this->input->post('dataid');
            
            $add_sem_error_action = "$('#modalEditSemester').modal('show');"; //ni-recycle ko lng ung sa addsem na modal trigger


            //i-query ung records na may additional na WHERE condition, curriculum
            $query = $this->schedule_model->list_semester($curriculum_id);

            foreach ($query->result() as $row)
            {
                $data['semester'] = $row->semester;
                $data['curriculum_year'] = $row->curriculum_year;
            }

            $this->session->set_userdata($data);

            $data = array (
                'semester' => $this->session->userdata('semester'),
                'curriculum_year' => $this->session->userdata('curriculum_year'),
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_sem_error_msg' => $add_sem_error_msg,
                'add_sem_error_action' => $add_sem_error_action

            );

            $this->load->view('includes/nocache');
            $this->load->view('includes/header2');
            $this->load->view('semester_view', $data);
            $this->load->view('includes/semester_footer', $data);


        } else {
            echo '2';
        }

    }

}