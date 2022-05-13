<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class History_model extends CI_Model
{
    public function histories($id = FALSE){
        $this->db->select('*');
        $this->db->join('vehicles', 'vehicles.vehicle_id = history.vehicle_id');
        $this->db->join('users', 'users.user_id = history.user_id');
        if ($id  === FALSE) :
            $query  = $this->db->get('history');
            return $query->result_array();
        endif;
        $query =  $this->db->get_where('history', array('history.id' => $id));
        return $query->row_array();
    }
    public function save($data){
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'admin_id' => $this->input->post('admin_id'),
            'vehicle_id' => $this->input->post('vehicle_id'),
            'destination' => $this->input->post('destination'),
            'reason' => $this->input->post('reason'),
            'period' => $this->input->post('period'),
            'status' => $this->input->post('status'),
        );
        return $this->db->insert('history', $data);
    }
    public function history($id){
        $this->db->select('*');
        $this->db->join('vehicles', 'vehicles.vehicle_id = history.vehicle_id');
        $this->db->join('users', 'users.user_id = history.user_id');
        $this->db->from('history');
        $this->db->where('id', $id);
        $result = $this->db->get('');

        if ($result->num_rows() > 0) {
            return $result->row();
        }
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('history', array('id' => $id));
        return TRUE;
    }
}
