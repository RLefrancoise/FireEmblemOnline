<?php

class Factions_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_faction($id) {
		$query = $this->db->get_where('factions', array('faction_id' => $id));

		if($query->num_rows() === 0) return false;

		return $query->row_array();
	}
}
