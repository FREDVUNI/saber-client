<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor_model extends CI_Model
{
    public function vendors($vendor_id = FALSE){
        if ($vendor_id  === FALSE) : 
            $query  = $this->db->get('vendors');
            return $query->result_array();
        endif;
        $query =  $this->db->get_where('vendors', array('vendors.vendor_id' => $vendor_id));
        return $query->row_array();
    }
    public function save(array $data){
        $insert = $this->db->insert("vendors");
        return $insert?$this->db->insert_id():FALSE;
    }
    public function vendor($vendor_id){
        $this->db->from('vendors');
        $this->db->where('vendor_id', $vendor_id);
        $result = $this->db->get('');

        if ($result->num_rows() > 0) { 
            return $result->row();
        }
    }

    public function delete($vendor_id){
        $this->db->where('vendor_id', $vendor_id);
        $this->db->delete('vendors', array('vendor_id' => $vendor_id));
        return TRUE;
    }
    //count the number of vendors in the table vendors
    public function countVendors(){
        $this->db->from('vendors');
        return $count = $this->db->count_all_results();
    }
}
