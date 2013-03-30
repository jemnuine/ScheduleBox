<?php

class Schedule_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }
    

    public function add_semester($data) {
        $this->db->insert('curriculum', $data);
        return;
    }

    public function list_semester($param = NULL) {
        
        $where = ' AND curriculum_id=';
        if($param) {
            $where += $param;
        }
        else {
            $where = NULL;
        }

        $query = $this->db->query('SELECT * FROM curriculum WHERE userid='.$this->session->userdata('userid') . $where . ' ORDER BY curriculum_year DESC');
        return $query->result();
    }

    public function update_semester($id) {
        $array = array (
            'curriculum_id' => $id,
            'userid' => $this->session->userdata('username')
        );

        $this->db->where($array);
        $this->db->update('curriculum', $data);
    }

    public function update_pass() {

        $this->db->where('');
    }

    
}