<?php

class Timetable_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }

     /********** Begin Section Functions **********/

    public function add_schedule($data) {
        
        //check if may duplicate row
        /*$query = $this->db->query (
            'SELECT * FROM section WHERE userid=' . $this->session->userdata('userid') .
            ' AND course_code="' . $data['course_code'] . '" AND year_level=' . $data['year_level'] . ' AND section_number=' . $data['section_number']
            );

        $records = $query->result();

        //if may record
        if($records) {
            return false;
        }*/

        

        $this->db->insert('schedules', $data);
        return true;
    }

    public function list_schedule() {

        $query = $this->db->query('SELECT * FROM schedules WHERE userid='.$this->session->userdata('userid'));
        return $query->result();
    }

    public function list_course() {
        $query = $this->db->query('SELECT course_code FROM course WHERE userid='.$this->session->userdata('userid'));
        return $query->result();
    }    

    public function list_level() {
        $query = $this->db->query('SELECT year_level FROM section WHERE userid='.$this->session->userdata('userid'));
        return $query->result();
    }   

    public function list_section() {
        $query = $this->db->query('SELECT section_number FROM section WHERE userid='.$this->session->userdata('userid'));
        return $query->result();
    }

    public function list_room() {
        $query = $this->db->query('SELECT room_name FROM room WHERE userid='.$this->session->userdata('userid'));
        return $query->result();
    } 

    public function list_subject() {
        $query = $this->db->query('SELECT subject_code FROM all_subjects WHERE userid='.$this->session->userdata('userid'));
        return $query->result();
    } 

    public function list_semester() {

        $query = $this->db->query('SELECT semester FROM curriculum WHERE userid='.$this->session->userdata('userid') . ' ORDER BY curriculum_year DESC');
        return $query->result();
    }

    public function list_year() {

        $query = $this->db->query('SELECT curriculum_year FROM curriculum WHERE userid='.$this->session->userdata('userid') . ' ORDER BY curriculum_year DESC');
        return $query->result();
    }

    public function list_instructor() {
        $query = $this->db->query('SELECT instructor_name FROM instructor WHERE userid='.$this->session->userdata('userid'));
        return $query->result();
    } 

























    public function list_section_course() {

        $query = $this->db->query('SELECT course_code FROM course WHERE userid='.$this->session->userdata('userid'));
        $data = $query->result();
        return $data;
    }

    public function get_course_code($param) {

        $this->db->where('section_id', $param);
        $this->db->select('course_code');
        $query = $this->db->get('section');
        return $query->row_array();
    }

    public function get_year_level($param) {

        $this->db->where('section_id', $param);
        $this->db->select('year_level');
        $query = $this->db->get('section');
        return $query->row_array();
    }

    public function get_section_number($param) {

        $this->db->where('section_id', $param);
        $this->db->select('section_number');
        $query = $this->db->get('section');
        return $query->row_array();
    }


    public function update_section($id, $code, $year, $sect) {

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

    public function delete_section($id) {
        
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

    public function delete_all_section() {
        $this->db->where('userid', $this->session->userdata('userid'));
        $this->db->delete('section'); 
    }

    /********** End course Functions **********/
}