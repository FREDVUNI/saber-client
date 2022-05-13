<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class VehicleType_model extends CI_Model
{
    public function vehicletypes($id = FALSE){
        if ($id  === FALSE) :
            $query  = $this->db->get('vehicletype');
            return $query->result_array();
        endif;
        $query = $this->db->get_where('vehicletype', array('vehicletype.vehicletype_id' => $id));
        return $query->row_array();
    }
    public function save(array $data){
        $insert = $this->db->insert("vehicletype");
        return $insert?$this->db->insert_id():FALSE;
    }
    public function vehicletype($id){
        $this->db->from('vehicletype');
        $this->db->where('vehicletype_id', $id);
        $result = $this->db->get('');

        if ($result->num_rows() > 0) {
            return $result->row_array();
        }
    }

    public function delete($vehicletype_id){
        $this->db->where('vehicletype_id', $vehicletype_id);
        $this->db->delete('vehicletype', array('vehicletype_id' => $vehicletype_id));
        return TRUE;
    }
    //count the number of vehicle types in the table vehicle types
    public function countVehicletypes(){
        $this->db->from('vehicletype');
        return $count = $this->db->count_all_results();
    }
}
