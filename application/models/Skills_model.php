<?php

require_once(__DIR__ . '/classes/Skill.class.php');

class Skills_Model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_skill($skill_id) {
        $sql = "SELECT * FROM skills WHERE skill_id = ? LIMIT 1";

        $query = $this->db->query($sql, array($skill_id));

        if($query->num_rows() === 0) return false;

        return new Skill($query->row_array());
    }
}
