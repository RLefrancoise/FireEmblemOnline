<?php

require_once(__DIR__ . '/config/constants.php');

class Accounts_warehouses_model extends CI_Model {

	public function __construct() {
		$this->load->database();
		$this->load->model('weapons_model');
		$this->load->model('items_model');
		$this->load->model('items_instances_model');
	}

	public function get_account_warehouse($account_id) {
		$sql = "SELECT weapons.id AS id, items_instances.* FROM accounts_warehouses
				INNER JOIN items_instances ON items_instances.item_instance_id = accounts_warehouses.item_instance_id
				INNER JOIN weapons ON weapons.id = items_instances.item_id
				WHERE accounts_warehouses.account_id = ?
				AND items_instances.item_type = ?

				UNION

				SELECT items.id AS id, items_instances.* FROM accounts_warehouses
				INNER JOIN items_instances ON items_instances.item_instance_id = accounts_warehouses.item_instance_id
				INNER JOIN items ON items.id = items_instances.item_id
				WHERE accounts_warehouses.account_id = ?
				AND items_instances.item_type = ?

				ORDER BY id";
		$query = $this->db->query($sql, array($account_id, ITEM_TYPE_WEAPON, $account_id, ITEM_TYPE_GENERIC_ITEM));

		$data = $query->result_array();

		$warehouse = array(
			WEAPON_TYPE_SWORD 		=> array(),
			WEAPON_TYPE_SPEAR 		=> array(),
			WEAPON_TYPE_AXE 		=> array(),
			WEAPON_TYPE_BOW 		=> array(),
			WEAPON_TYPE_KNIFE 		=> array(),
			WEAPON_TYPE_STRIKE 		=> array(),
			WEAPON_TYPE_FIRE 		=> array(),
			WEAPON_TYPE_THUNDER 	=> array(),
			WEAPON_TYPE_WIND 		=> array(),
			WEAPON_TYPE_LIGHT 		=> array(),
			WEAPON_TYPE_DARK 		=> array(),
			WEAPON_TYPE_STAFF 		=> array(),
			ITEM_TYPE_GENERIC_ITEM 	=> array(),
		);

		foreach($data as $warehouse_data) {
			$item = $this->items_instances_model->get_item_instance($warehouse_data['item_instance_id']);
			if($warehouse_data['current_uses']) $item->setCurrentUses($warehouse_data['current_uses']);
			$warehouse[$item->getType()][] = $item;
		}

		return $warehouse;
	}

	public function add_item_to_warehouse($account_id, $item_instance_id) {
		$data = array(
			'account_id'		=>	$account_id,
			'item_instance_id'	=>	$item_instance_id,
		);

		if(!$this->db->insert('accounts_warehouses', $data)) throw new Exception($this->db->error()['message']);
	}
}