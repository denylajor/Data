<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ImportModel extends CI_Model
{

    public function insert($data, $chm)
    {
        $insert = $this->db->insert_batch($chm, $data);
        if ($insert) {
            return true;
        }
    }
    public function getData()
    {
        $this->db->select('*');
        return $this->db->get('chm')->result_array();
    }

    public function querytable()
    {
        $inserttble = $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = BASE TABLE AND TABLE_SCHEMA=datalaporan");
    }
}
