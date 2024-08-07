<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Excel_import_model extends CI_Model
{
    public function select(){
        $this->db->order_by("name", "DESC");
        $query = $this->db->get("importexcel");
        return $query;
    }

    public function insert($data){
        $this->db->insert_batch('importexcel', $data);
    }
}
?>
