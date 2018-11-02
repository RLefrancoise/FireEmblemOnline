<?php

require_once(__DIR__ . '/classes/Unit.class.php');
require_once(__DIR__ . '/config/constants.php');

class Accounts_Units_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->model('skills_model');
		$this->load->model('items_instances_model');
	}

	public function get_units($account_id)
	{
		$sql = "SELECT au.* FROM accounts_units as au, units as u
				WHERE au.account_id = ?
				AND au.unit_id = u.unit_id
				ORDER BY u.name";

		$query = $this->db->query($sql, array($account_id));

		return $query->result_array();
	}

	public function get_unit($account_id, $unit_id)
	{
		$sql = "SELECT * FROM accounts_units
				WHERE account_id = ?
				AND unit_id = ?
				LIMIT 1";

		$query = $this->db->query($sql, array($account_id, $unit_id));

		if($query->num_rows() === 0) return false;

		return $query->row_array();
	}

	public function get_unit_items($account_id, $unit_id)
	{
		$sql = "SELECT place, items_instances.* FROM accounts_units_items
				INNER JOIN items_instances ON items_instances.item_instance_id = accounts_units_items.item_instance_id
				WHERE account_id = ?
				AND unit_id = ?
				ORDER BY place";

		$query = $this->db->query($sql, array($account_id, $unit_id));

		$data = $query->result_array();

		$items = array();

		foreach($data as $item_instance_data) {
			$instance = $this->items_instances_model->get_item_instance($item_instance_data['item_instance_id']);
			if($instance !== false) $items[$item_instance_data['place']] = $instance;
		}

		return $items;
	}

	public function get_unit_support($account_id, $unit_id)
	{
		$sql = "SELECT * FROM accounts_units_supports
				WHERE account_id = ?
				AND (unit1_id = ?
				OR unit2_id = ?)
				LIMIT 1";
		$query = $this->db->query($sql, array($account_id, $unit_id, $unit_id));

		if($query->num_rows() === 0) return false;

		$data = $query->row_array();
		$res = array(
			'support_id'	=>	($data['unit1_id'] == $unit_id) ? $data['unit2_id'] : $data['unit1_id'],
			'support_level' => $data['support_level'],
		);

		return $res;
	}

	public function get_unit_skills($account_id, $unit_id)
	{
		$sql = "SELECT * FROM accounts_units_skills
				WHERE unit_id = ?
				AND account_id = ?";
		$query = $this->db->query($sql, array($unit_id, $account_id));

		$data = $query->result_array();

		$skills = array();

		foreach($data as $skill_data) {
			$s = $this->skills_model->get_skill($skill_data['skill_id']);
			$s->setLocked($skill_data['locked']);
			$s->setIgnoreCapacity($skill_data['ignore_capacity']);
			$skills[] = $s;
		}

		return $skills;
	}

	// Change the equipped weapon place of unit in inventory
	//
	//
	//
	public function set_equipped_weapon_place(Unit $unit, $place)
	{
		if($place !== null and ($place < 0 or $place > INVENTORY_SIZE))
		{
			trigger_error("place has invalid value $place", E_USER_WARNING);
		}

		$data = array('equipped_weapon_place' => $place);
		$where = "account_id = {$unit->getAccountId()} AND unit_id = {$unit->getId()}";
		$sql = $this->db->update_string('accounts_units', $data, $where);

		$query = $this->db->query($sql);

		if($place !== null)
			$unit->setEquippedWeaponPlace($place);
		else
			$unit->setEquippedWeaponPlace(false);
	}

	public function swap_unit_items(Unit $unit, $place1, $place2)
	{
	}
}
