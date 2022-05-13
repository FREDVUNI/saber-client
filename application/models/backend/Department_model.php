<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department_model extends CI_Model
{
    public function departments($id = FALSE){
        if ($id  === FALSE) :
            $query  = $this->db->get('departments');
            return $query->result_array();
        endif;
        $query =  $this->db->get_where('departments', array('departments.id' => $id));
        return $query->row_array();
    }
    public function save(array $data){
        $insert = $this->db->insert("departments");
        return $insert?$this->db->insert_id():FALSE;
    }
    public function department($id){
        $this->db->from('departments');
        $this->db->where('id', $id);
        $result = $this->db->get('');

        if ($result->num_rows() > 0) {
            return $result->row();
        }
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('departments', array('id' => $id));
        return TRUE;
    }
    //count the number of departments in the table departments
    public function countDepartments(){
        $this->db->from('departments');
        return $count = $this->db->count_all_results();
    }
}
