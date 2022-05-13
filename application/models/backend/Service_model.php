<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service_model extends CI_Model
{
    public function services($service_id = FALSE){
         $this->db->select('*');
         $this->db->join('vehicles', 'vehicles.vehicle_id = services.vehicle_id');
         $this->db->join('vendors', 'vendors.vendor_id = services.vendor_id');
        if ($service_id  === FALSE) :
            $query  = $this->db->get('services');
            return $query->result_array();  
        endif;
        $query =  $this->db->get_where('services', array('services.service_id' => $service_id));
        return $query->row_array();
    }
    public function save($data){
        $data = array(
            'vehicle_id' => $this->input->post('vehicle_id'),
            'vendor_id' => $this->input->post('vendor_id'),
            'service' => $this->input->post('service'),
            'amount' => $this->input->post('amount'),
            'comment' => $this->input->post('comment'),
            'image' => $data['userfile'],
            'admin_id' => $data['user']['id'],
        );
        return $this->db->insert('services', $data);
    }
    public function service($service_id){
        $this->db->select('*');
        $this->db->join('vehicles', 'vehicles.vehicle_id = services.vehicle_id');
        $this->db->join('vendors', 'vendors.vendor_id = services.vendor_id');
        $this->db->from('services');
        $this->db->where('service_id', $service_id);
        $result = $this->db->get('');

        if ($result->num_rows() > 0) {
            return $result->row();
        }
    }

    public function delete($service_id){
        $this->db->where('service_id', $service_id);
        $this->db->delete('services', array('service_id' => $service_id));
        return TRUE;
    }
    //count the number of services in the table services
    public function countService(){
        $this->db->from('services');
        return $count = $this->db->count_all_results();
    }
}
