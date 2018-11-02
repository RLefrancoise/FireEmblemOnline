<?php

require_once(__DIR__ . '/config/constants.php');
require_once(__DIR__ . '/classes/Biorhythm.class.php');

class Biorhythm_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_biorhythm($id)
	{
		$sql = "SELECT * FROM biorhythm
				WHERE biorhythm_id = ?";
		
		$query = $this->db->query($sql, array($id));
		
		if($query->num_rows() === 0) return false;
		
		$bio = $query->row_array();
		
		$wave = $this->get_biorhythm_wave($id);
		if($wave === false) return false;

		$bio['wave'] = $wave;

		return new Biorhythm($bio);
	}
	
	public function get_biorhythm_wave($id)
	{
		$sql = "SELECT turn, status FROM biorhythm_waves
				WHERE biorhythm_id = ?
				ORDER BY turn";
		
		$query = $this->db->query($sql, array($id));
		
		if($query->num_rows() === 0) return false;
		
		return $query->result_array();
	}
}
