<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Schedules extends CI_Controller {

	public function __construct()
 	{
 		parent::__construct();
 	}

 	public function index (
	 		$add_schedule_error_msg = NULL, 
	 		$add_schedule_error_action = NULL, 
	 		$reg_error_msg = NULL
 		) {

        //check kung naka-login
		if($this->session->userdata('is_logged_in')) {

			$data = array (
				'current_user' => $this->session->userdata('displayname'),
				'current_username' => $this->session->userdata('username'),
				'add_schedule_error_msg' => $add_schedule_error_msg,
				'add_schedule_error_action' => $add_schedule_error_action

			);

			$this->load->model('timetable_model');

            if($query = $this->timetable_model->list_schedule()) {
                $data['records'] = $query;
            }

            if($query = $this->timetable_model->list_subject()) {
                $data['subject_record'] = $query;
            }

            if($query = $this->timetable_model->list_year()) {
                $data['curriculum_record'] = $query;
            }

            if($query = $this->timetable_model->list_semester()) {
                $data['semester_record'] = $query;
            }

            if($query = $this->timetable_model->list_course()) {
                $data['course_record'] = $query;
            }

            if($query = $this->timetable_model->list_level()) {
                $data['level_record'] = $query;
            }

            if($query = $this->timetable_model->list_section()) {
                $data['section_record'] = $query;
            }

            if($query = $this->timetable_model->list_room()) {
                $data['room_record'] = $query;
            }

            if($query = $this->timetable_model->list_instructor()) {
                $data['instructor_record'] = $query;
            }

            //color alternate 
            $color = rand(0,4);
            $data['rand'] = $color;

			$this->load->view('includes/nocache');
	        $this->load->view('schedules_view', $data);
	        $this->load->view('includes/schedule_footer');

			
		}

		else {
			
			//kung hindi naka-login balik sa main page
			redirect(base_url(), 'refresh');
		}
 	}

 	public function add_schedule() {

        
        $data = array (
            'curriculum_year' => $this->input->post('addYear'),
            'semester' => $this->input->post('addSemester'),
            'course_code' => $this->input->post('addCourse'),
            'year_level' => $this->input->post('addLevel'),
            'section_number' => $this->input->post('addSection'),
            'day' => $this->input->post('addDay'),
            'room_name' => $this->input->post('addRoom'),
            'subject_name' => $this->input->post('addSubject'),
            'instructor_name' => $this->input->post('addInstructor'),
            'start_time' => $this->input->post('addStart'),
            'end_time' => $this->input->post('addEnd'),
            'userid' => $this->session->userdata('userid')   
        );

        $start = strtotime($this->input->post('addStart'));
        $end = strtotime($this->input->post('addEnd'));

        if($start >= $end) {
            redirect(base_url() . 'index.php/schedules', 'refresh');
        }

        $this->load->model('timetable_model');
        $this->timetable_model->add_schedule($data);

        $data = array (
            'current_user' => $this->session->userdata('displayname'),
            'current_username' => $this->session->userdata('username'),
        	'add_schedule_error_msg' => NULL,
        	'add_schedule_error_action' => NULL //wala lang xD
        );

        redirect(base_url() . 'index.php/schedules', 'refresh');   
            
        
    }

    public function list_edit_schedule (
            $add_schedule_error_msg = NULL, 
            $add_schedule_error_action = NULL, 
            $reg_error_msg = NULL

        ) {

        $data = array (
                'userid' => $this->session->userdata('userid')   
            );


        $this->load->model('timetable_model');

        //kinuha lang ung department id galing sa view
        $section_id = $this->input->post('dataid');

        //check kung ajax request
        if($this->input->post('ajax')) {

            //ni-recycle ko lng ung sa addsem na modal trigger
            $add_schedule_error_action = "$('#modalEditSection').modal('show');"; 

            $query = $this->timetable_model->get_course_code($section_id);
            $query2 = $this->timetable_model->get_year_level($section_id);
            $query3 = $this->timetable_model->get_section_number($section_id);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_schedule_error_msg' => $add_schedule_error_msg,
                'add_schedule_error_action' => $add_schedule_error_action,
                'dataid' => $section_id,
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

        	
	            $ccode = $this->input->post('editCode');
	            $year = $this->input->post('editLevel');
	            $sect = $this->input->post('editSection');

	            //kinuha ung session ng dept id
	            $section_id = $this->session->userdata('dataid');
	            $this->timetable_model->update_section($section_id, $ccode, $year, $sect);
	            redirect(base_url().'index.php/sections');
	        
        }
    }

    public function delete_schedule ($id = NULL) {

        $this->load->model('timetable_model');
        $this->timetable_model->delete_section($id);
        redirect(base_url().'index.php/schedules');
        return;
    }

    public function delete_all_schedule () {
        $this->load->model('timetable_model');
        $this->timetable_model->delete_all_section();
        redirect(base_url().'index.php/schedules');
        return;
    }

}