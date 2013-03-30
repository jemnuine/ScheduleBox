<?php

class Schedule_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }
    

    public function add_semester($data) {
        $this->db->insert('curriculum', $data);
        return;
    }

    public function list_semester() {
        $query = $this->db->query('SELECT * FROM curriculum WHERE userid='.$this->session->userdata('userid') . ' ORDER BY curriculum_year DESC');
        return $query->result();
    }

    public function update_pass() {
        $this->db->where('');
    }

    
}