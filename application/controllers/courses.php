<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

	public function __construct()
 	{
 		parent::__construct();
 	}

 	public function index (
	 		$add_course_error_msg = NULL, 
	 		$add_course_error_action = NULL, 
	 		$reg_error_msg = NULL
 		) {

        //check kung naka-login
		if($this->session->userdata('is_logged_in')) {

			$data = array (
				'current_user' => $this->session->userdata('displayname'),
				'current_username' => $this->session->userdata('username'),
				'add_course_error_msg' => $add_course_error_msg,
				'add_course_error_action' => $add_course_error_action

			);

			$this->load->model('course_model');

            if($query = $this->course_model->list_course()) {
                $data['records'] = $query;
            }

            if($query = $this->course_model->list_course_dept()) {
                $data['record'] = $query;
            }


			$this->load->view('includes/nocache');
	        $this->load->view('includes/header2');
	        $this->load->view('courses_view', $data);
	        $this->load->view('includes/course_footer');

			
		}

		else {
			
			//kung hindi naka-login balik sa main page
			redirect(base_url(), 'refresh');
		}
 	}

 	public function add_course() {

        $this->form_validation->set_rules('addCode','Department Code','trim|required');
        $this->form_validation->set_rules('addDesc','Department Description','trim|required');
        

        if($this->form_validation->run() == TRUE) {
            $data = array (
                'department_code' => $this->input->post('addCode'),
                'department_desc' => $this->input->post('addDesc'),
                'userid' => $this->session->userdata('userid')   
            );


            $this->load->model('course_model');
            $this->course_model->add_course($data);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
            	'add_course_error_msg' => NULL,
            	'add_course_error_action' => NULL //wala lang xD
            );

            redirect(base_url() . 'index.php/departments', 'refresh');   
            
        }
        else
        {

            $add_course_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>' . validation_errors() . '</div>';
            $add_course_error_action = "$('#modalAddDepartment').modal('show');";

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_course_error_msg' => $add_course_error_msg,
                'add_course_error_action' => $add_course_error_action
            );

            $this->load->model('course_model');

            if($query = $this->course_model->list_course()) {
                $data['records'] = $query;
            }

            if(!$data['records']) {
                $add_course_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>The record is existing!</div>';
                $add_course_error_action = "$('#modalAddDepartment').modal('show');";
                $data = array (
                    'current_user' => $this->session->userdata('displayname'),
                    'current_username' => $this->session->userdata('username'),
                    'add_course_error_msg' => $add_course_error_msg,
                    'add_course_error_action' => $add_course_error_action
                );
            }
             
	        

            $this->session->set_userdata($data);

			$this->load->view('includes/nocache');
			$this->load->view('includes/header2');
    		$this->load->view('courses_view', $data);
    		$this->load->view('includes/course_footer', $data);

            
        }
    }

    public function list_edit_department (
            $add_course_error_msg = NULL, 
            $add_course_error_action = "$('#modalEditSemester').modal('show');", 
            $reg_error_msg = NULL

        ) {

        $data = array (
                'department_code' => $this->input->post('addCode'),
                'department_desc' => $this->input->post('addDescription'),
                'userid' => $this->session->userdata('userid')
            );


        $this->load->model('course_model');
        //kinuha lang ung department id galing sa view
        $department_id = $this->input->post('dataid');

        //check kung ajax request
        if($this->input->post('ajax')) {

            //ni-recycle ko lng ung sa addsem na modal trigger
            $add_course_error_action = "$('#modalEditDepartment').modal('show');"; 

            $query = $this->course_model->get_dept_code($department_id);
            $query2 = $this->course_model->get_dept_desc($department_id);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_course_error_msg' => $add_course_error_msg,
                'add_course_error_action' => $add_course_error_action,
                'dataid' => $department_id,
                'dcode' => $query,
                'ddesc' => $query2
                
            );

            $this->session->set_userdata($data); //the trick!! mawawala na ung ajax request next time eh
            
            echo implode('', $data['dcode']);
            echo '*';
            echo implode('', $data['ddesc']);
        } else {

            $code = $this->input->post('editCode');
            $desc = $this->input->post('editDesc');

            //kinuha ung session ng dept id
            $department_id = $this->session->userdata('dataid');
            $this->course_model->update_department($department_id, $code, $desc);
            redirect(base_url().'index.php/departments');
        }

    }

    public function delete_department ($id = NULL) {

        $this->load->model('course_model');
        $this->course_model->delete_department($id);
        redirect(base_url().'index.php/departments');
        return;
    }

    public function delete_all_department () {

        $this->load->model('course_model');
        $this->course_model->delete_all_department();
        redirect(base_url().'index.php/departments');
        return;
    }

}