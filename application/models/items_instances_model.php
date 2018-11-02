<?php

require_once(__DIR__ . '/classes/ItemInstance.class.php');
require_once(__DIR__ . '/classes/Item.class.php');

class Items_Instances_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->helper('items');
	}
	
	public function get_item_instance($instance_id)
	{
		$sql = "SELECT * FROM items_instances
				WHERE item_instance_id = ?";
		
		$query = $this->db->query($sql, array($instance_id));
		if($query->num_rows() === 0) return false;
		
		$data = $query->row_array();

		return new ItemInstance($data, get_item_by_type($data['item_type'], $data['item_id']));
	}

	public function create_instance(Item $item) {
		$data = array(
			'item_id'		=>	$item->getId(),
			'item_type'		=>	$item->isWeapon() ? ITEM_TYPE_WEAPON : $item->getType(),
			'current_uses' 	=>	$item->getUses(),
		);

		if(!$this->db->insert('items_instances', $data)) throw new Exception($this->db->error()['message']);
		else return $this->get_item_instance($this->db->insert_id());
	}
}
