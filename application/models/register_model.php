<?php

class Register_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }
    

    public function add_user($data) {
        $this->db->insert('users', $data);
        return;
    }

    public function update_pass() {
        $this->db->where('');
    }

    
}