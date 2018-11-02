<?php

require_once(__DIR__ . '/classes/UnitTrait.class.php');

class Trait_Model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_trait($trait_id) {
        $sql = "SELECT * FROM traits WHERE trait_id = ? LIMIT 1";

        $query = $this->db->query($sql, array($trait_id));

        if($query->num_rows() === 0) return false;

        return new UnitTrait($query->row_array());
    }
}
