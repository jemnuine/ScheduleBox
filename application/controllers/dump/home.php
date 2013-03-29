<?php

class Home extends site {
    function __construct(){
        parent::__construct();
        $this->check_isvalidated();
    }
    
    public function index() {
        // If the user is validated, then this function will run
        $data['dd'] = "$('.dropdown-menu').dropdown();";
        $data['current_username'] = $this->session->userdata('username');
        $data['current_user'] = $this->session->userdata('displayname');
        
        $this->load->view('includes/header');
        $this->load->view('home', $data);
        $this->load->view('includes/footer2', $data);
    }
    
    private function check_isvalidated() {

        if(!$this->session->userdata('validated')) {
            redirect('site');
        }
    }  

    function logout() {
        $this->session->sess_destroy();
        redirect(base_url(),'refresh');
    }

    public function change_password($newpass) {
        $data = array (
            'password' => $newpass
        );

        $this->register_model->update_pass($data);
    }
 }