<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sections extends CI_Controller {

	public function __construct()
 	{
 		parent::__construct();
 	}

 	public function index (
	 		$add_section_error_msg = NULL, 
	 		$add_section_error_action = NULL, 
	 		$reg_error_msg = NULL
 		) {

        //check kung naka-login
		if($this->session->userdata('is_logged_in')) {

			$data = array (
				'current_user' => $this->session->userdata('displayname'),
				'current_username' => $this->session->userdata('username'),
				'add_section_error_msg' => $add_section_error_msg,
				'add_section_error_action' => $add_section_error_action

			);

			$this->load->model('section_model');

            if($query = $this->section_model->list_section()) {
                $data['records'] = $query;
            }

            if($query = $this->section_model->list_section_course()) {
                $data['record'] = $query;
            }

			$this->load->view('includes/nocache');
	        $this->load->view('includes/header2');
	        $this->load->view('sections_view', $data);
	        $this->load->view('includes/section_footer');

			
		}

		else {
			
			//kung hindi naka-login balik sa main page
			redirect(base_url(), 'refresh');
		}
 	}

 	public function add_section() {

        $this->form_validation->set_rules('addCourse','Course Code','trim|required');
        $this->form_validation->set_rules('addLevel','Year Level','trim|required');
        $this->form_validation->set_rules('addSection','Section','trim|required');
        

        if($this->form_validation->run() == TRUE) {
            $data = array (
                'course_code' => $this->input->post('addCourse'),
                'year_level' => $this->input->post('addLevel'),
                'section_number' => $this->input->post('addSection'),
                'userid' => $this->session->userdata('userid')   
            );


            $this->load->model('section_model');
            $this->section_model->add_section($data);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
            	'add_section_error_msg' => NULL,
            	'add_section_error_action' => NULL //wala lang xD
            );

            redirect(base_url() . 'index.php/sections', 'refresh');   
            
        }
        else
        {

            $add_section_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>' . validation_errors() . '</div>';
            $add_section_error_action = "$('#modalAddSection').modal('show');";

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_section_error_msg' => $add_section_error_msg,
                'add_section_error_action' => $add_section_error_action
            );

            $this->load->model('section_model');

            if($query = $this->section_model->list_section()) {
                $data['records'] = $query;
            } else {
            	$data['records'] = $query;
            }

            if(!$data['records']) {
                //$add_section_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>The record is existing!</div>';
                $add_section_error_action = "$('#modalAddSection').modal('show');";
                $data = array (
                    'current_user' => $this->session->userdata('displayname'),
                    'current_username' => $this->session->userdata('username'),
                    'add_section_error_msg' => $add_section_error_msg,
                    'add_section_error_action' => $add_section_error_action
                );

            }
            
	        if($query = $this->section_model->list_section_course()) {
                $data['record'] = $query;
            }

            $this->session->set_userdata($data);

			$this->load->view('includes/nocache');
			$this->load->view('includes/header2');
    		$this->load->view('sections_view', $data);
    		$this->load->view('includes/section_footer', $data);

            
        }
    }

    public function list_edit_section (
            $add_section_error_msg = NULL, 
            $add_section_error_action = NULL, 
            $reg_error_msg = NULL

        ) {

        $data = array (
                'course_code' => $this->input->post('editCourse'),
                'year_level' => $this->input->post('editLevel'),
                'section_number' => $this->input->post('editSection'),
                'userid' => $this->session->userdata('userid')   
            );


        $this->load->model('section_model');
        //kinuha lang ung department id galing sa view
        $section_id = $this->input->post('dataid');

        //check kung ajax request
        if($this->input->post('ajax')) {

            //ni-recycle ko lng ung sa addsem na modal trigger
            $add_section_error_action = "$('#modalEditSection').modal('show');"; 

            $query = $this->section_model->get_course_code($course_id);
            $query2 = $this->section_model->get_year_level($course_id);
            $query3 = $this->section_model->get_section_number($course_id);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_section_error_msg' => $add_section_error_msg,
                'add_section_error_action' => $add_section_error_action,
                'dataid' => $course_id,
                'ccode' => $query,
                'year' => $query2,
                'sect' => $query3
                
            );

            $this->session->set_userdata($data); //the trick!! mawawala na ung ajax request next time eh
            
            echo implode('', $data['ccode']);
            echo '*';
            echo implode('', $data['year']);
            echo '*';
            echo implode('', $data['sect']);
        } else {

        	$this->form_validation->set_rules('editCourse','Course Code','trim|required');
            $this->form_validation->set_rules('editLevel','Year Level','trim|required');
            $this->form_validation->set_rules('editSection','Section','trim|required');
        
        	if($this->form_validation->run() == TRUE) {
	            $ccode = $this->input->post('editCode');
	            $year = $this->input->post('editLevel');
	            $sect = $this->input->post('editSection');

	            //kinuha ung session ng dept id
	            $course_id = $this->session->userdata('dataid');
	            $this->section_model->update_course($course_id, $code, $year, $sect);
	            echo $course_id. $code. $desc. $ddesc;
	            redirect(base_url().'index.php/sections');
	        }
	        else {
	        	redirect(base_url().'index.php/sections');
	        }
        }
    }

    public function delete_section ($id = NULL) {

        $this->load->model('section_model');
        $this->section_model->delete_section($id);
        redirect(base_url().'index.php/sections');
        return;
    }

    public function delete_all_section () {
        $this->load->model('section_model');
        $this->section_model->delete_all_section();
        redirect(base_url().'index.php/sections');
        return;
    }

}