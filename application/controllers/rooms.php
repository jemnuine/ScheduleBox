<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rooms extends CI_Controller {

	public function __construct()
 	{
 		parent::__construct();
 	}

 	public function index () {

        
        $add_room_error_msg = NULL;
        $add_room_error_action = NULL; 
        $reg_error_msg = NULL;
        
        //check kung naka-login
		if($this->session->userdata('is_logged_in')) {

			$data = array (
				'current_user' => $this->session->userdata('displayname'),
				'current_username' => $this->session->userdata('username'),
				'add_room_error_msg' => $add_room_error_msg,
				'add_room_error_action' => $add_room_error_action

			);

			$this->load->model('room_model');

            if($query = $this->room_model->list_room()) {
                $data['records'] = $query;
            }

			$this->load->view('includes/nocache');
	        $this->load->view('includes/header2');
	        $this->load->view('rooms_view', $data);
	        $this->load->view('includes/room_footer');
		}

		else {
			
			//kung hindi naka-login balik sa main page
			redirect(base_url(), 'refresh');
		}
 	}

 	public function add_room() {

        $this->form_validation->set_rules('addRoom','Room Name','trim|required');
        $this->form_validation->set_rules('addType','Room Type','trim|required');
        $this->form_validation->set_rules('addCapacity','Room Capacity','trim|required|numeric');
        

        if($this->form_validation->run() == TRUE) {
            $data = array (
                'room_name' => $this->input->post('addRoom'),
                'room_type' => $this->input->post('addType'),
                'room_capacity' => $this->input->post('addCapacity'),
                'userid' => $this->session->userdata('userid')   
            );


            $this->load->model('room_model');

            $this->room_model->add_room($data);

            $this->session->unset_userdata('add_room_error_msg');
            $this->session->unset_userdata('add_room_error_action');

            redirect(base_url() . 'index.php/rooms', 'refresh');  
            
            
        }

        else
        {

            $add_room_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>' . validation_errors() . '</div>';
            $add_room_error_action = "$('#modalAddRoom').modal('show');";

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_room_error_msg' => $add_room_error_msg,
                'add_room_error_action' => $add_room_error_action
            );

            $this->load->model('room_model');

            if($query = $this->room_model->list_room()) {
                $data['records'] = $query;
            } else {
                $data['records'] = $query;
            }

            if(!$data['records']) {
                //$add_room_error_msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>The record is existing!</div>';
                $add_room_error_action = "$('#modalAddRoom').modal('show');";
                $data = array (
                    'current_user' => $this->session->userdata('displayname'),
                    'current_username' => $this->session->userdata('username'),
                    'add_room_error_msg' => $add_room_error_msg,
                    'add_room_error_action' => $add_room_error_action
                );

                $this->session->set_userdata($data);
            }
             
            $this->load->view('includes/nocache');
            $this->load->view('includes/header2');
            $this->load->view('rooms_view', $data);
            $this->load->view('includes/room_footer', $data);

            
        }
        
    }

    public function list_edit_room (
            $add_room_error_msg = NULL, 
            $add_room_error_action = "$('#modalEditRoom').modal('show');", 
            $reg_error_msg = NULL

        ) {

        $data = array (
            'userid' => $this->session->userdata('userid')
        );


        $this->load->model('room_model');
        //kinuha lang ung department id galing sa view
        $room_id = $this->input->post('dataid');

        //check kung ajax request
        if($this->input->post('ajax')) {

            //ni-recycle ko lng ung sa addsem na modal trigger
            $add_room_error_action = "$('#modalEditRoom').modal('show');"; 

            $query = $this->room_model->get_room_name($room_id);
            $query2 = $this->room_model->get_room_type($room_id);
            $query3 = $this->room_model->get_room_capacity($room_id);

            $data = array (
                'current_user' => $this->session->userdata('displayname'),
                'current_username' => $this->session->userdata('username'),
                'add_room_error_msg' => $add_room_error_msg,
                'add_room_error_action' => $add_room_error_action,
                'dataid' => $room_id,
                'rname' => $query,
                'rtype' => $query2,
                'rcap' => $query3
                
            );

            $this->session->set_userdata($data); //the trick!! mawawala na ung ajax request next time eh
            
            echo implode('', $data['rname']);
            echo '*';
            echo implode('', $data['rtype']);
            echo '*';
            echo implode('', $data['rcap']);

        } else {

            $this->form_validation->set_rules('editRoom','Room Name','trim|required');
	        $this->form_validation->set_rules('editType','Room Type','trim|required');
	        $this->form_validation->set_rules('editCapacity','Room Capacity','trim|required|numeric');
            
            if($this->form_validation->run() == TRUE) {

                $rname = $this->input->post('editRoom');
                $rtype = $this->input->post('editType');
                $rcap = $this->input->post('editCapacity');

                //kinuha ung session ng dept id
                $room_id = $this->session->userdata('dataid');
                $this->room_model->update_room($room_id, $rname, $rtype, $rcap);
                echo $rname.$rtype.$rcap; //for debugging purpose
                redirect(base_url().'index.php/rooms');
            }
            else {
                redirect(base_url().'index.php/rooms');
            }
        }

    }

    public function delete_room ($id = NULL) {

        $this->load->model('room_model');
        $this->room_model->delete_room($id);
        redirect(base_url().'index.php/rooms');
        return;
    }

    public function delete_all_room () {

        $this->load->model('room_model');
        $this->room_model->delete_all_room();
        redirect(base_url().'index.php/rooms');
        return;
    }

}