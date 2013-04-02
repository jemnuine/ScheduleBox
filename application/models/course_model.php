<?php

class Course_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }

     /********** Begin Department Functions **********/

    public function add_course($data) {
        
        //check if may duplicate row
        $query = $this->db->query (
            'SELECT * FROM department WHERE userid=' . $this->session->userdata('userid') .
            ' AND department_code="' . $data['department_code'] . '" AND department_desc="' . $data['department_desc'] . '"'
            );
        $records = $query->result();

        //if may record
        if($records) {
            return false;
        }

        $this->db->insert('department', $data);
        return true;
    }

    public function list_course() {

        $query = $this->db->query('SELECT * FROM course WHERE userid='.$this->session->userdata('userid') . ' ORDER BY course_code ASC');
        $data = $query->result();
        return $data;
    }

    public function list_course_dept() {

        $query = $this->db->query('SELECT department_desc FROM department WHERE userid='.$this->session->userdata('userid'));
        $data = $query->result();
        return $data;
    }

    public function get_dept_code($param) {

        $this->db->where('department_id', $param);
        $this->db->select('department_code');
        $query = $this->db->get('department');
        return $query->row_array();
    }

    public function get_dept_desc($param) {

        $this->db->where('department_id', $param);
        $this->db->select('department_desc');
        $query = $this->db->get('department');
        return $query->row_array();
    }


    public function update_department($id, $code, $desc) {

        //check if may duplicate row
        $query = $this->db->query (
            'SELECT department_code, department_desc FROM department WHERE userid=' . $this->session->userdata('userid') .
            ' AND department_code="' . $code . '" OR department_desc="' . $desc . '"'
            );
        $records = $query->result();

        //if may record
        if($records) {
            return false;
        }

        if($id != '') {

            $data = array (
                'department_code' => $code,
                'department_desc' => $desc
            );

            $this->db->where('department_id',$id);
            $this->db->update('department', $data);

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