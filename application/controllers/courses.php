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

        $this->form_validation->set_rules('addCode','Course Code','trim|required');
        $this->form_validation->set_rules('addDesc','Course Description','trim|required');
        

        if($this->form_validation->run() == TRUE) {
            $data = array (
                'course_code' => $this->input->post('addCode'),
                'course_desc' => $this->input->post('addDesc'),
                'department_desc' => $this->input->post('addDeptDesc'),
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

            redirect(base_url() . 'index.php/courses', 'refresh');   
            
        }
        else
        {

            $add_course_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>' . validation_errors() . '</div>';
            $add_course_error_action = "$('#modalAddCourse').modal('show');";

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_course_error_msg' => $add_course_error_msg,
                'add_course_error_action' => $add_course_error_action
            );

            $this->load->model('course_model');

            if($query = $this->course_model->list_course()) {
                $data['records'] = $query;
            } else {
            	$data['records'] = $query;
            }

            if(!$data['records']) {
                //$add_course_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>The record is existing!</div>';
                $add_course_error_action = "$('#modalAddCourse').modal('show');";
                $data = array (
                    'current_user' => $this->session->userdata('displayname'),
                    'current_username' => $this->session->userdata('username'),
                    'add_course_error_msg' => $add_course_error_msg,
                    'add_course_error_action' => $add_course_error_action
                );
            }
            
	        if($query = $this->course_model->list_course_dept()) {
                $data['record'] = $query;
            }

            $this->session->set_userdata($data);

			$this->load->view('includes/nocache');
			$this->load->view('includes/header2');
    		$this->load->view('courses_view', $data);
    		$this->load->view('includes/course_footer', $data);

            
        }
    }

    public function list_edit_course (
            $add_course_error_msg = NULL, 
            $add_course_error_action = "$('#modalEditCourse').modal('show');", 
            $reg_error_msg = NULL

        ) {

        $data = array (
                'course_code' => $this->input->post('editCode'),
                'course_desc' => $this->input->post('editDesc'),
                'department_desc' => $this->input->post('addDeptDesc'),
                'userid' => $this->session->userdata('userid')
            );


        $this->load->model('course_model');
        //kinuha lang ung department id galing sa view
        $course_id = $this->input->post('dataid');

        //check kung ajax request
        if($this->input->post('ajax')) {

            //ni-recycle ko lng ung sa addsem na modal trigger
            $add_course_error_action = "$('#modalEditDepartment').modal('show');"; 

            $query = $this->course_model->get_course_code($course_id);
            $query2 = $this->course_model->get_course_desc($course_id);
            $query3 = $this->course_model->get_dept_desc($course_id);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_course_error_msg' => $add_course_error_msg,
                'add_course_error_action' => $add_course_error_action,
                'dataid' => $course_id,
                'ccode' => $query,
                'cdesc' => $query2,
                'ddesc' => $query3
                
            );

            $this->session->set_userdata($data); //the trick!! mawawala na ung ajax request next time eh
            
            echo implode('', $data['ccode']);
            echo '*';
            echo implode('', $data['cdesc']);
            echo '*';
            echo implode('', $data['ddesc']);
        } else {

        	$this->form_validation->set_rules('editCode','Course Code','trim|required');
        	$this->form_validation->set_rules('editDesc','Course Description','trim|required');
        
        	if($this->form_validation->run() == TRUE) {
	            $code = $this->input->post('editCode');
	            $desc = $this->input->post('editDesc');
	            $ddesc = $this->input->post('editDeptDesc');

	            //kinuha ung session ng dept id
	            $course_id = $this->session->userdata('dataid');
	            $this->course_model->update_course($course_id, $code, $desc, $ddesc);
	            echo $course_id. $code. $desc. $ddesc;
	            redirect(base_url().'index.php/courses');
	        }
	        else {
	        	redirect(base_url().'index.php/courses');
	        }
        }
    }

    public function delete_course ($id = NULL) {

        $this->load->model('course_model');
        $this->course_model->delete_course($id);
        redirect(base_url().'index.php/courses');
        return;
    }

    public function delete_all_course () {
        $this->load->model('course_model');
        $this->course_model->delete_all_course();
        redirect(base_url().'index.php/courses');
        return;
    }

}