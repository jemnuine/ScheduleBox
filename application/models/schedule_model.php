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

    public function get_semester($param) {

        $this->db->where('curriculum_id', $param);
        $this->db->select('semester');
        $query = $this->db->get('curriculum');
        return $query->row_array();
    }

    public function get_year($param) {

        $this->db->where('curriculum_id', $param);
        $this->db->select('curriculum_year');
        $query = $this->db->get('curriculum');
        return $query->row_array();
    }


    public function update_semester($id) {
        $array = array (
            'curriculum_id' => $id,
            'userid' => $this->session->userdata('username')
        );

        $this->db->where($array);
        $this->db->update('curriculum', $array);
    }

    public function update_pass() {

        $this->db->where('');
    }

    
}