<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Subjects extends CI_Controller {

	public function __construct()
 	{
 		parent::__construct();
 	}

 	public function index (
	 		$add_subject_error_msg = NULL, 
	 		$add_subject_error_action = NULL, 
	 		$reg_error_msg = NULL
 		) {

        //check kung naka-login
		if($this->session->userdata('is_logged_in')) {

			$data = array (
				'current_user' => $this->session->userdata('displayname'),
				'current_username' => $this->session->userdata('username'),
				'add_subject_error_msg' => $add_subject_error_msg,
				'add_subject_error_action' => $add_subject_error_action

			);

			$this->load->model('subject_model');

            if($query = $this->subject_model->list_subject()) {
                $data['records'] = $query;
            }


			$this->load->view('includes/nocache');
	        $this->load->view('includes/header2');
	        $this->load->view('subjects_view', $data);
	        $this->load->view('includes/subject_footer');

			
		}

		else {
			
			//kung hindi naka-login balik sa main page
			redirect(base_url(), 'refresh');
		}
 	}

 	public function add_subject() {

        $this->form_validation->set_rules('addCode','Subject Code','trim|required');
        $this->form_validation->set_rules('addSubject','Subject Name','trim|required');
        $this->form_validation->set_rules('addUnits','Units','trim|required|numberic|less_than[10]');
        

        if($this->form_validation->run() == TRUE) {
            $data = array (
                'subject_code' => $this->input->post('addCode'),
                'subject_name' => $this->input->post('addSubject'),
                'units' => $this->input->post('addUnits'),
                'userid' => $this->session->userdata('userid')   
            );


            $this->load->model('subject_model');
            $this->subject_model->add_subject($data);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
            	'add_subject_error_msg' => NULL,
            	'add_subject_error_action' => NULL //wala lang xD
            );

            redirect(base_url() . 'index.php/subjects', 'refresh');   
            
        }
        else
        {

            $add_subject_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>' . validation_errors() . '</div>';
            $add_subject_error_action = "$('#modalAddSubject').modal('show');";

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_subject_error_msg' => $add_subject_error_msg,
                'add_subject_error_action' => $add_subject_error_action
            );

            $this->load->model('subject_model');

            if($query = $this->subject_model->list_subject()) {
                $data['records'] = $query;
            } else {
            	$data['records'] = $query;
            }

            if(!$data['records']) {
                //$add_subject_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>The record is existing!</div>';
                $add_subject_error_action = "$('#modalAddSubject').modal('show');";
                $data = array (
                    'current_user' => $this->session->userdata('displayname'),
                    'current_username' => $this->session->userdata('username'),
                    'add_subject_error_msg' => $add_subject_error_msg,
                    'add_subject_error_action' => $add_subject_error_action
                );

            }

            $this->session->set_userdata($data);

			$this->load->view('includes/nocache');
			$this->load->view('includes/header2');
    		$this->load->view('subjects_view', $data);
    		$this->load->view('includes/subject_footer', $data);

            
        }
    }

    public function list_edit_subject (
            $add_subject_error_msg = NULL, 
            $add_subject_error_action = NULL, 
            $reg_error_msg = NULL

        ) {

        $data = array (
                'userid' => $this->session->userdata('userid')   
            );


        $this->load->model('subject_model');
        //kinuha lang ung department id galing sa view
        $subject_id = $this->input->post('dataid');

        //check kung ajax request
        if($this->input->post('ajax')) {

            //ni-recycle ko lng ung sa addsem na modal trigger
            $add_subject_error_action = "$('#modalEditSubject').modal('show');"; 

            $query = $this->subject_model->get_subject_code($subject_id);
            $query2 = $this->subject_model->get_subject_name($subject_id);
            $query3 = $this->subject_model->get_units($subject_id);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_subject_error_msg' => $add_subject_error_msg,
                'add_subject_error_action' => $add_subject_error_action,
                'dataid' => $subject_id,
                'scode' => $query,
                'sname' => $query2,
                'units' => $query3
                
            );

            $this->session->set_userdata($data); //the trick!! mawawala na ung ajax request next time eh
            
            echo implode('', $data['scode']);
            echo '*';
            echo implode('', $data['sname']);
            echo '*';
            echo implode('', $data['units']);
            
            

        } else {

        	$this->form_validation->set_rules('addCode','Subject Code','trim|required');
	        $this->form_validation->set_rules('addSubject','Subject Name','trim|required');
	        $this->form_validation->set_rules('addUnits','Units','trim|required|numberic|less_than[10]');
	        

	        if($this->form_validation->run() == TRUE) {
	            $scode = $this->input->post('editCode');
	            $sname = $this->input->post('editSubject');
	            $units = $this->input->post('editUnits');

	            //kinuha ung session ng dept id
	            $subject_id = $this->session->userdata('dataid');
	            $this->subject_model->update_subject($subject_id, $scode, $sname, $units);
	            redirect(base_url().'index.php/subjects');
	        } else {

	        	redirect(base_url().'index.php/subjects');
	        }
	        
        }
    }

    public function delete_subject ($id = NULL) {

        $this->load->model('subject_model');
        $this->subject_model->delete_subject($id);
        redirect(base_url().'index.php/subjects');
        return;
    }

    public function delete_all_subject () {
        $this->load->model('subject_model');
        $this->subject_model->delete_all_subject();
        redirect(base_url().'index.php/subjects');
        return;
    }

}