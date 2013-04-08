<?php

class Subject_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }

     /********** Begin Subject Functions **********/

    public function add_subject($data) {
        
        //check if may duplicate row
        $query = $this->db->query (
            'SELECT * FROM all_subjects WHERE userid=' . $this->session->userdata('userid') .
            ' AND subject_code="' . $data['subject_code'] . '" AND subject_name="' . $data['subject_name'] . '" AND units=' . $data['units']
            );

        $records = $query->result();

        //if may record
        if($records) {
            return false;
        }

        $this->db->insert('all_subjects', $data);
        return true;
    }

    public function list_subject() {

        $query = $this->db->query('SELECT * FROM all_subjects WHERE userid='.$this->session->userdata('userid') . ' ORDER BY subject_code ASC');
        return $query->result();
    }

    public function get_subject_code($param) {

        $this->db->where('subject_id', $param);
        $this->db->select('subject_code');
        $query = $this->db->get('all_subjects');
        return $query->row_array();
    }

    public function get_subject_name($param) {

        $this->db->where('subject_id', $param);
        $this->db->select('subject_name');
        $query = $this->db->get('all_subjects');
        return $query->row_array();
    }

    public function get_units($param) {

        $this->db->where('subject_id', $param);
        $this->db->select('units');
        $query = $this->db->get('all_subjects');
        return $query->row_array();
    }


    public function update_subject($id, $scode, $sname, $units) {

        /*//check if may duplicate row
        $query = $this->db->query (
            'SELECT * FROM section WHERE userid=' . $this->session->userdata('userid') .
            ' AND course_code="' . $scode . '" AND year_level=' . $sname . 'AND section_number=' . $units
            );
        $records = $query->result();

        //if may record
        if($records) {
            return false;   
        }*/

        if($id != '') {
            $data = array (
                'subject_code' => $scode,
                'subject_name' => $sname,
                'units' => $units
            );

            $this->db->where('subject_id',$id);
            $this->db->update('all_subjects', $data);

        } else {

            echo 'Oops! Something is wrong in updating subject :(';

        }
    }

    public function delete_subject($id) {
        
        if($id != '') {

            $this->db->where('subject_id',$id);
            $this->db->delete('all_subjects');


            /*$query = $this->db->query('SELECT course_code FROM course WHERE userid='.$this->session->userdata('userid') . ' AND course_id=' . $id);
            $code = $query->result();

            foreach ($code as $row) {
                $a = $row->course_code;
            }

            //cascade deletion
            $this->db->where('course_code', $a);
            $this->db->delete('all_subjects');*/

        } else {

            echo 'Oops! Something is wrong in deleting course :(';
        }
    }

    public function delete_all_subject() {
        $this->db->where('userid', $this->session->userdata('userid'));
        $this->db->delete('all_subjects'); 
    }

    /********** End Subject Functions **********/
}