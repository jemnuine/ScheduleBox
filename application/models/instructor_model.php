<?php

class Instructor_model extends CI_Model {

    function __construct() {
        parent:: __construct();
    }

     /********** Begin Instructor Functions **********/

    public function add_instructor($data) {
        
        //check if may duplicate row
        $query = $this->db->query (
            'SELECT * FROM instructor WHERE userid=' . $this->session->userdata('userid') .
            ' AND instructor_name="' . $data['instructor_name'] .'"'
            );

        $records = $query->result();

        //if may record
        if($records) {
            return false;
        }

        $this->db->insert('instructor', $data);
        return true;
    }

    public function list_instructor() {

        $query = $this->db->query('SELECT * FROM instructor WHERE userid='.$this->session->userdata('userid') . ' ORDER BY instructor_name ASC');
        return $query->result();
    }


    public function get_instructor_name($param) {

        $this->db->where('instructor_id', $param);
        $this->db->select('instructor_name');
        $query = $this->db->get('instructor');
        return $query->row_array();
    }


    public function update_instructor($id, $iname) {

        //check if may duplicate row
        $query = $this->db->query (
            'SELECT * FROM instructor WHERE userid=' . $this->session->userdata('userid') .
            ' AND instructor_name="' . $iname . '"'
            );
        
        $records = $query->result();

        //if may record
        if($records) {
            return false;   
        }

        if($id != '') {
            $data = array (
                'instructor_name' => $iname
            );

            $this->db->where('instructor_id',$id);
            $this->db->update('instructor', $data);

        } else {

            echo 'Oops! Something is wrong in updating instructor :(';

        }
    }

    public function delete_instructor($id) {
        
        if($id != '') {

            $this->db->where('instructor_id',$id);
            $this->db->delete('instructor');


            /*$query = $this->db->query('SELECT course_code FROM course WHERE userid='.$this->session->userdata('userid') . ' AND course_id=' . $id);
            $code = $query->result();

            foreach ($code as $row) {
                $a = $row->course_code;
            }

            //cascade deletion
            $this->db->where('course_code', $a);
            $this->db->delete('instructor');*/

        } else {

            echo 'Oops! Something is wrong in deleting course :(';
        }
    }

    public function delete_all_instructor() {
        $this->db->where('userid', $this->session->userdata('userid'));
        $this->db->delete('instructor'); 
    }

    /********** End Instructor Functions **********/
}