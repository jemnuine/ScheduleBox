<?php

class Schedule_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }
    

    public function add_semester($data) {
        
        //check if may duplicate row
        $query = $this->db->query (
            'SELECT semester, curriculum_year FROM curriculum WHERE userid=' . $this->session->userdata('userid') .
            ' AND semester="' . $data['semester'] . '" AND curriculum_year=' . $data['curriculum_year']
            );
        $records = $query->result();

        //if may record
        if($records) {
            return false;
        }

        $this->db->insert('curriculum', $data);
        return true;
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


    public function update_semester($id, $semester, $year) {

        if($id != '') {

            $data = array (
                'semester' => $semester,
                'curriculum_year' => $year
            );

            $this->db->where('curriculum_id',$id);
            $this->db->update('curriculum', $data);
        } else {
            echo ':(';
        }
    

    }

    public function update_pass() {

        $this->db->where('');
    }

    
}