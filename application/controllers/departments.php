<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {

	public function __construct()
 	{
 		parent::__construct();
 	}

 	public function index (
	 		$add_dept_error_msg = NULL, 
	 		$add_dept_error_action = NULL, 
	 		$reg_error_msg = NULL
 		) {

        //check kung naka-login
		if($this->session->userdata('is_logged_in')) {

			$data = array (
				'current_user' => $this->session->userdata('displayname'),
				'current_username' => $this->session->userdata('username'),
				'add_dept_error_msg' => $add_dept_error_msg,
				'add_dept_error_action' => $add_dept_error_action

			);

			$this->load->view('includes/nocache');
	        $this->load->view('includes/header2');
	        $this->load->view('departments_view', $data);
	        $this->load->view('includes/dept_footer');

			
		}

		else {
			
			//kung hindi naka-login balik sa main page
			redirect(base_url(), 'refresh');
		}
 	}

 	public function add_department() {

        $this->form_validation->set_rules('addCode','Department Code','trim|required');
        $this->form_validation->set_rules('addDescription','Department Description','trim|required');
        

        if($this->form_validation->run() == TRUE) {
            $data = array (
                'dept_code' => $this->input->post('addCode'),
                'dept_desc' => $this->input->post('addDescription'),
                'userid' => $this->session->userdata('userid')   
            );


            $this->load->model('schedule_model');
            $this->schedule_model->add_department($data);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
            	'add_dept_error_msg' => NULL,
            	'add_dept_error_action' => NULL //wala lang xD
            );

            redirect(base_url() . 'index.php/department', 'refresh');   
            
        }
        else
        {

            $add_dept_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>' . validation_errors() . '</div>';
            $add_dept_error_action = "$('#modalAddDepartment').modal('show');";

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_dept_error_msg' => $add_dept_error_msg,
                'add_dept_error_action' => $add_dept_error_action
            );

            $this->load->model('schedule_model');

            if($query = $this->schedule_model->list_department()) {
                $data['records'] = $query;
            } 

            if(!$data['records']){
                $add_dept_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>The record is existing!</div>';
                $add_dept_error_action = "$('#modalAddDepartment').modal('show');";
                $data = array (
                    'current_user' => $this->session->userdata('displayname'),
                    'current_username' => $this->session->userdata('username'),
                    'add_dept_error_msg' => $add_dept_error_msg,
                    'add_dept_error_action' => $add_dept_error_action
                );
            }

            $this->session->set_userdata($data);

			$this->load->view('includes/nocache');
			$this->load->view('includes/header2');
    		$this->load->view('semester_view', $data);
    		$this->load->view('includes/dept_footer', $data);

            
        }
    }

    public function list_edit_department (
            $add_dept_error_msg = NULL, 
            $add_dept_error_action = "$('#modalEditSemester').modal('show');", 
            $reg_error_msg = NULL

        ) {

        $data = array (
                'dept_code' => $this->input->post('addCode'),
                'dept_desc' => $this->input->post('addDescription'),
                'userid' => $this->session->userdata('userid')
            );


        $this->load->model('schedule_model');
        //kinuha lang ung curriculum id galing sa view
        $department_id = $this->input->post('dataid');

        //check kung ajax request
        if($this->input->post('ajax')) {
            



            //ni-recycle ko lng ung sa addsem na modal trigger
            $add_dept_error_action = "$('#modalEditDepartment').modal('show');"; 

            $query = $this->schedule_model->get_dept_code($curriculum_id);
            $query2 = $this->schedule_model->get_dept_desc($curriculum_id);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_dept_error_msg' => $add_dept_error_msg,
                'add_dept_error_action' => $add_dept_error_action,
                'dataid' => $curriculum_id,
                'dcode' => $query,
                'ddesc' => $query2
                
            );

            $this->session->set_userdata($data); //the trick!! mawawala na ung ajax request next time eh
            
            echo implode('', $data['dcode']);
            echo '*';
            echo implode('', $data['ddesc']);
        } else {

            $code = $this->input->post('editCode');
            $desc = $this->input->post('editDescription');

            //kinuha ung session ng dept id
            $department_id = $this->session->userdata('dataid');
            $this->schedule_model->update_department($department_id, $code, $desc);
            redirect(base_url().'index.php/department');
        }

    }

    public function delete_department ($id = NULL) {

        $this->load->model('schedule_model');
        $this->schedule_model->delete_delete($id);
        redirect(base_url().'index.php/department');
        return;
    }

    public function delete_all_department () {

        $this->load->model('schedule_model');
        $this->schedule_model->delete_all_department();
        redirect(base_url().'index.php/department');
        return;
    }

}