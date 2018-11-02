<?php

require_once(__DIR__ . '/classes/UnitClass.class.php');
require_once(__DIR__ . '/classes/Skill.class.php');

class Units_Classes_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->model('skills_model');
		$this->load->model('trait_model');
	}

	public function get_class($class_id) {
		$sql = "SELECT * FROM units_classes WHERE class_id = ? LIMIT 1";

		$query = $this->db->query($sql, array($class_id));

		if($query->num_rows() === 0) return false;

		$data = $query->row_array();

		//get skills
		$skills = $this->get_class_skills($class_id);

		//get traits
		$traits = $this->get_class_traits($class_id);

		return new UnitClass($data, $skills, $traits);
	}

	public function get_class_skills($class_id) {
		$sql = "SELECT skill_id FROM units_classes_skills
				WHERE class_id = ?";
		$query = $this->db->query($sql, array($class_id));

		$data = $query->result_array();

		$skills = array();

		foreach($data as $skill_data) {
			$s = $this->skills_model->get_skill($skill_data['skill_id']);
			$s->setLocked(true);
			$skills[] = $s;
		}
		
		return $skills;
	}

	public function get_class_traits($class_id) {
		$sql = "SELECT trait_id FROM units_classes_traits
				WHERE class_id = ?";
		$query = $this->db->query($sql, array($class_id));

		$data = $query->result_array();

		$traits = array();

		foreach($data as $trait_data) {
			$traits[] = $this->trait_model->get_trait($trait_data['trait_id']);
		}

		return $traits;
	}
}
