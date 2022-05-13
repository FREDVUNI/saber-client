<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Driver_model extends CI_Model
{
    public function drivers($driver_id = FALSE){
         $this->db->select('*');
         $this->db->join('vehicles', 'vehicles.vehicle_id = drivers.vehicle_id');
        if ($driver_id  === FALSE) :
            $query  = $this->db->get('drivers');
            return $query->result_array();
        endif;
        $query =  $this->db->get_where('drivers', array('drivers.driver_id' => $driver_id));
        return $query->row_array();
    }
   public function save(array $data){
        $insert = $this->db->insert("drivers");
        return $insert?$this->db->insert_id():FALSE;
   }
    public function driver($driver_id){
         $this->db->from('drivers');
        $this->db->where('driver_id', $driver_id);
        $result = $this->db->get('');

        if ($result->num_rows() > 0) {  
            return $result->row_array();
        }
    }

    public function delete($driver_id){
        $this->db->where('driver_id', $driver_id);
        $this->db->delete('drivers', array('driver_id' => $driver_id));
        return TRUE;
    }
    //count the number of drivers in the table drivers
    public function countDrivers(){
        $this->db->from('drivers');
        return $count = $this->db->count_all_results();
    }
}
