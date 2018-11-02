<?php

require_once(__DIR__ . '/classes/Affinity.class.php');

class Affinities_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_affinity($id) {
		$sql = "SELECT * FROM affinities WHERE affinity_id = ? LIMIT 1";

		$query = $this->db->query($sql, array($id));

		if($query->num_rows() === 0) return false;

		return new Affinity($query->row_array());
	}
}
