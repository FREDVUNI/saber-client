<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function users($user_id = FALSE){
        $this->db->select('*');
        $this->db->join('departments', 'departments.id = users.department_id');
        if ($user_id  === FALSE) :
            $query  = $this->db->get('users');
            return $query->result_array();
        endif;
        $query =  $this->db->get_where('users', array('users.user_id' => $user_id));
        return $query->row_array();
    }
    public function save(array $data){
        $insert = $this->db->insert("users");
        return $insert?$this->db->insert_id():FALSE;
    }

    public function user($user_id){
        $this->db->select('*');
        $this->db->join('departments', 'departments.id = users.department_id');
        $this->db->from('users');
        $this->db->where('user_id', $user_id);
        $result = $this->db->get(''); 

        if ($result->num_rows() > 0) {
            return $result->row();
        }
    }
    public function get_data(){
        $this->db->select('MONTHNAME(date_created) as y, count(user_id) as a');
        $this->db->from('users');
        $this->db->group_by('y');
        $this->db->order_by('
        FIELD(
        y,
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
        )
        ');
        $result = $this->db->get('');
        return $result;
    }
    public function delete($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->delete('users', array('user_id' => $user_id));
        return TRUE;
    }
    //count the number of users in the table users
    public function countUsers(){
        $this->db->from('users');
        return $count = $this->db->count_all_results();
    }
}
