<?php

class Units_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_units() {
		$query = $this->db->get('units');
		return $query->result_array();
	}

	public function get_unit($id) {
		$query = $this->db->get_where('units', array('unit_id' => $id));

		if($query->num_rows() === 0) return false;

		return $query->row_array();
	}

	public function get_graphics($unit_id, $class_id)
	{
		$sql = "SELECT * FROM units_graphics WHERE unit_id = ? AND class_id = ? LIMIT 1";

		$query = $this->db->query($sql, array($unit_id, $class_id));

		if($query->num_rows() === 0) return false;

		return $query->row_array();
	}
}
