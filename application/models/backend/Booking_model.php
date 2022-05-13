<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Booking_model extends CI_Model
{
    public function bookings($id = FALSE){
        $this->db->select('vehicles.*,users.user_id,firstname,admins.id,bookings.*');
        $this->db->join('vehicles', 'vehicles.vehicle_id = bookings.vehicle_id');
        $this->db->join('users', 'users.user_id = bookings.user_id');
        $this->db->join('admins', 'admins.id = bookings.admin_id');
        if ($id  === FALSE) :
            $query  = $this->db->get('bookings');
            return $query->result_array();
        endif;
        $query =  $this->db->get_where('bookings', array('bookings.id' => $id));
        return $query->row_array();
    }
    public function booking($id){ 
         $this->db->select('*');
         $this->db->join('vehicles', 'vehicles.vehicle_id = bookings.vehicle_id');
         $this->db->join('users', 'users.user_id = bookings.user_id');
        $this->db->from('bookings');
        $this->db->where('id', $id);
        $result = $this->db->get('');

        if ($result->num_rows() > 0) {
            return $result->row();
        }
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('bookings', array('id' => $id));
        return TRUE;
    }
    //count the number of bookings in the table bookings
    public function countBookings(){
        $this->db->from('bookings');
        return $count = $this->db->count_all_results();
    }
}
