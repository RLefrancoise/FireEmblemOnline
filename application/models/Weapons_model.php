<?php

require_once(__DIR__ . '/classes/Weapon.class.php');

class Weapons_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('trait_model');
	}

	public function get_weapons() {
		$sql = "SELECT * FROM weapons
				ORDER BY id";
		$query = $this->db->query($sql);

		$weapons = array();

		foreach($query->result_array() as $weapon_data) {
			$weapons[] = new Weapon($weapon_data, $this->get_weapon_traits_bonus($weapon_data['id']));
		}

		return $weapons;
	}

	public function get_weapon($id) {
		$sql = "SELECT * FROM weapons WHERE id = ? LIMIT 1";

		$query = $this->db->query($sql, array($id));

		if($query->num_rows() === 0) return false;

		//get traits bonus
		$traits = $this->get_weapon_traits_bonus($id);

		return new Weapon($query->row_array(), $traits);
	}

	public function get_weapon_traits_bonus($weapon_id) {
		$sql = "SELECT trait_id FROM weapons_traits_bonus
				WHERE weapon_id = ?";

		$query = $this->db->query($sql, array($weapon_id));

		$traits = array();

		$data = $query->result_array();

		foreach($data as $trait_data) {
			$traits[] = $this->trait_model->get_trait($trait_data['trait_id']);
		}

		return $traits;
	}
}
