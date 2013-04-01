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
        $this->form_validation->set_rules('addyear','Year','trim|required|greater_than[1997]|less_than[2100]');
        

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

            if(!$data['records']){
                $add_sem_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>The record is existing!</div>';
                $add_sem_error_action = "$('#modalAddSemester').modal('show');";
                $data = array (
                    'current_user' => $this->session->userdata('displayname'),
                    'current_username' => $this->session->userdata('username'),
                    'add_sem_error_msg' => $add_sem_error_msg,
                    'add_sem_error_action' => $add_sem_error_action
                );
            }

            $this->session->set_userdata($data);

			$this->load->view('includes/nocache');
			$this->load->view('includes/header2');
    		$this->load->view('semester_view', $data);
    		$this->load->view('includes/semester_footer', $data);

            
        }
    }

    public function list_edit_semester (
            $add_sem_error_msg = NULL, 
            $add_sem_error_action = "$('#modalEditSemester').modal('show');", 
            $reg_error_msg = NULL

        ) {

        $data = array (
                'semester' => $this->input->post('addsemester'),
                'curriculum_year' => $this->input->post('addyear'),
                'userid' => $this->session->userdata('userid')
            );


        $this->load->model('schedule_model');
        //kinuha lang ung curriculum id galing sa view
        $curriculum_id = $this->input->post('dataid');

        //check kung ajax request
        if($this->input->post('ajax')) {
            



            //ni-recycle ko lng ung sa addsem na modal trigger
            $add_sem_error_action = "$('#modalEditSemester').modal('show');"; 

            $query = $this->schedule_model->get_semester($curriculum_id);
            $query2 = $this->schedule_model->get_year($curriculum_id);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_sem_error_msg' => $add_sem_error_msg,
                'add_sem_error_action' => $add_sem_error_action,
                'dataid' => $curriculum_id,
                'sem' => $query,
                'year' => $query2
                
            );

            $this->session->set_userdata($data); //the trick!! mawawala na ung ajax request next time eh
            
            echo implode('', $data['sem']);
            echo '*';
            echo implode('', $data['year']);
           /* $this->load->view('includes/nocache');
            $this->load->view('includes/header2');
            $this->load->view('semester_view', $data);
            $this->load->view('includes/semester_footer', $data);*/


        } else {

            $sem = $this->input->post('editsemester');
            $year = $this->input->post('edityear');

            //kinuha ung session ng curriculum id
            $curriculum_id = $this->session->userdata('dataid');
            $this->schedule_model->update_semester($curriculum_id, $sem, $year);
            redirect(base_url().'index.php/semester');
        }

    }

    public function delete_semester ($id = NULL) {

        $this->load->model('schedule_model');
        $this->schedule_model->delete_semester($id);
        redirect(base_url().'index.php/semester');

        return false;
    }

}