<?php

class Section_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }

     /********** Begin Section Functions **********/

    public function add_section($data) {
        
        //check if may duplicate row
        $query = $this->db->query (
            'SELECT * FROM section WHERE userid=' . $this->session->userdata('userid') .
            ' AND course_code="' . $data['course_code'] . '" AND year_level=' . $data['year_level'] . ' AND section_number=' . $data['section_number']
            );

        $records = $query->result();

        //if may record
        if($records) {
            return false;
        }

        $this->db->insert('section', $data);
        return true;
    }

    public function list_section() {

        $query = $this->db->query('SELECT * FROM section WHERE userid='.$this->session->userdata('userid') . ' ORDER BY course_code ASC');
        return $query->result();
    }

    public function list_section_course() {

        $query = $this->db->query('SELECT course_code FROM course WHERE userid='.$this->session->userdata('userid'));
        $data = $query->result();
        return $data;
    }

    public function get_course_code($param) {

        $this->db->where('course_id', $param);
        $this->db->select('course_code');
        $query = $this->db->get('course');
        return $query->row_array();
    }

    public function get_course_desc($param) {

        $this->db->where('course_id', $param);
        $this->db->select('course_desc');
        $query = $this->db->get('course');
        return $query->row_array();
    }

    public function get_dept_desc($param) {

        $this->db->where('course_id', $param);
        $this->db->select('department_desc');
        $query = $this->db->get('course');
        return $query->row_array();
    }


    public function update_section($id, $code, $desc, $ddesc) {

        //check if may duplicate row
        $query = $this->db->query (
            'SELECT * FROM section WHERE userid=' . $this->session->userdata('userid') .
            ' AND course_code="' . $code . '" AND course_desc="' . $desc . '"'
            );
        $records = $query->result();

        //if may record
        if($records) {
            return false;   
        }

        if($id != '') {
            $data = array (
                'course_code' => $code,
                'course_desc' => $desc,
                'department_desc' => $ddesc
            );

            $this->db->where('section_id',$id);
            $this->db->update('section', $data);

        } else {

            echo 'Oops! Something is wrong in updating Department :(';
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