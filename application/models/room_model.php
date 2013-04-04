<?php

class Room_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }

     /********** Begin Room Functions **********/

    public function add_room($data) {
        
        //check if may duplicate row
        $query = $this->db->query (
            'SELECT * FROM room WHERE userid=' . $this->session->userdata('userid') .
            ' AND room_name="' . $data['room_name'] . '" AND room_capacity=' . $data['room_capacity'] . ' AND room_type="' . $data['room_type'] . '"'
            );

        $records = $query->result();

        //if may record
        if($records) {
            return false;
        }

        $this->db->insert('room', $data);
        return true;
    }

    public function list_room() {

        $query = $this->db->query('SELECT * FROM room WHERE userid='.$this->session->userdata('userid') . ' ORDER BY room_name ASC');
        return $query->result();
    }

    public function list_room_course() {

        $query = $this->db->query('SELECT course_code FROM course WHERE userid='.$this->session->userdata('userid'));
        $data = $query->result();
        return $data;
    }

    public function get_room_name($param) {

        $this->db->where('room_id', $param);
        $this->db->select('room_name');
        $query = $this->db->get('room');
        return $query->row_array();
    }

    public function get_room_type($param) {

        $this->db->where('room_id', $param);
        $this->db->select('room_type');
        $query = $this->db->get('room');
        return $query->row_array();
    }

    public function get_room_capacity($param) {

        $this->db->where('room_id', $param);
        $this->db->select('room_capacity');
        $query = $this->db->get('room');
        return $query->row_array();
    }


    public function update_room($id, $code, $year, $sect) {

        /*//check if may duplicate row
        $query = $this->db->query (
            'SELECT * FROM section WHERE userid=' . $this->session->userdata('userid') .
            ' AND course_code="' . $code . '" AND year_level=' . $year . 'AND section_number=' . $sect
            );
        $records = $query->result();

        //if may record
        if($records) {
            return false;   
        }*/

        if($id != '') {
            $data = array (
                'course_code' => $code,
                'year_level' => $year,
                'section_number' => $sect
            );

            $this->db->where('section_id',$id);
            $this->db->update('section', $data);

        } else {

            echo 'Oops! Something is wrong in updating Section :(';
            echo 'onupdate id:'.$id.'code:'.$code.'year:'.$year.'section:'.$sect;
        }
    }

    public function delete_room($id) {
        
        if($id != '') {

            $this->db->where('section_id',$id);
            $this->db->delete('section');


            /*$query = $this->db->query('SELECT course_code FROM course WHERE userid='.$this->session->userdata('userid') . ' AND course_id=' . $id);
            $code = $query->result();

            foreach ($code as $row) {
                $a = $row->course_code;
            }

            //cascade deletion
            $this->db->where('course_code', $a);
            $this->db->delete('section');*/

        } else {

            echo 'Oops! Something is wrong in deleting course :(';
        }
    }

    public function delete_all_room() {
        $this->db->where('userid', $this->session->userdata('userid'));
        $this->db->delete('section'); 
    }

    /********** End course Functions **********/
}