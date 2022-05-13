<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle_model extends CI_Model
{
    public function vehicles($vehicle_id = FALSE){
         $this->db->select('*');
         $this->db->join('vehicletype', 'vehicletype.vehicletype_id = vehicles.vehicletype_id');
        if ($vehicle_id  === FALSE) :
            $query  = $this->db->get('vehicles');
            return $query->result_array();
        endif;
        $query =  $this->db->get_where('vehicles', array('vehicles.vehicle_id' => $vehicle_id));
        return $query->row_array();
    }
    public function save($data){
        $data = array(
            'vehicletype_id' => $this->input->post('vehicletype_id'),
            'vehicle' => $this->input->post('vehicle'),
            'license_plate' => $this->input->post('license_plate'),
            'admin_id' => $data['user']['id'],
            'image' => $data['userfile'],
            'status' => 'available'
        );
        return $this->db->insert('vehicles', $data);
    }
    public function vehicle($id){
        $this->db->from('vehicles');
        $this->db->where('vehicle_id', $id);
        $result = $this->db->get('');

        if ($result->num_rows() > 0) {
            return $result->row();
        }
    }

    public function delete($id){
        $this->db->where('vehicle_id', $id);
        $this->db->delete('vehicles', array('vehicle_id' => $id));
        return TRUE;
    }
    //count the number of vehicles in the table vehicles
    public function countVehicles(){
        $this->db->from('vehicles');
        return $count = $this->db->count_all_results();
    }
    public function countBooked(){
        $this->db->from('vehicles');
        $this->db->where('status','Booked');
        return $count = $this->db->count_all_results();
    }
    public function countAssigned(){
    $this->db->from('vehicles');
    $this->db->where('status','available');
    return $count = $this->db->count_all_results();
    }
}
