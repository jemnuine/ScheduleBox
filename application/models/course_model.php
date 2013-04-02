<?php

class Course_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }

     /********** Begin Department Functions **********/

    public function add_course($data) {
        
        //check if may duplicate row
        $query = $this->db->query (
            'SELECT * FROM course WHERE userid=' . $this->session->userdata('userid') .
            ' AND course_code="' . $data['course_code'] . '" OR course_desc="' . $data['course_desc'] . '"'
            );

        $records = $query->result();

        //if may record
        if($records) {
            return false;
        }

        $this->db->insert('course', $data);
        return true;
    }

    public function list_course() {

        $query = $this->db->query('SELECT * FROM course WHERE userid='.$this->session->userdata('userid') . ' ORDER BY course_code ASC');
        return $query->result();
    }

    public function list_course_dept() {

        $query = $this->db->query('SELECT department_desc FROM department WHERE userid='.$this->session->userdata('userid'));
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


    public function update_course($id, $code, $desc, $ddesc) {

        //check if may duplicate row
        $query = $this->db->query (
            'SELECT course_code, course_desc FROM course WHERE userid=' . $this->session->userdata('userid') .
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

            $this->db->where('course_id',$id);
            $this->db->update('course', $data);

        } else {

            echo 'Oops! Something is wrong in updating Department :(';
        }
    }

    public function delete_department($id) {
        
        if($id != '') {

            $this->db->where('department_id',$id);
            $this->db->delete('department');

            $query = $this->db->query('SELECT department_desc FROM department WHERE userid='.$this->session->userdata('userid') . ' AND department_id=' . $id);
            $desc = $query->result();
            //cascade deletion
            $this->db->where('department_desc', $desc['department_desc']);
            $this->db->delete('course');

        } else {

            echo 'Oops! Something is wrong in deleting semester :(';
        }
    }

    public function delete_all_department() {
        $this->db->where('userid', $this->session->userdata('userid'));
        $this->db->delete('department'); 
    }

    /********** End Department Functions **********/
}