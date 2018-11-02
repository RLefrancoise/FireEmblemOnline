<?php

require_once(__DIR__ . '/config/constants.php');
require_once(__DIR__ . '/classes/Race.class.php');

class Races_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_race($id)
	{
		$sql = "SELECT * FROM races
				WHERE race_id = ?";
		
		$query = $this->db->query($sql, array($id));
		
		if($query->num_rows() === 0) return false;
		
		$data = $query->row_array();
		return new Race($data);
	}
}
