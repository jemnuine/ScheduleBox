<?php

class Schedule_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }
    

    public function add_semester($data) {
        $this->db->insert('curriculum', $data);
        return;
    }

    public function update_pass() {
        $this->db->where('');
    }

    
}