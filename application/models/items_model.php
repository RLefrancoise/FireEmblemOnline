<?php

require_once(__DIR__ . '/config/constants.php');
require_once(__DIR__ . '/classes/GenericItem.class.php');

class Items_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_items()
	{
		$sql = "SELECT* FROM items";

		$items = array();

		$query = $this->db->query($sql);

		foreach($query->result_array() as $item_data) {
			$items[] = new GenericItem($item_data);
		}

		return $items;
	}

	public function get_item($item_id)
	{
		$sql = "SELECT * FROM items
				WHERE id = ?";

		$query = $this->db->query($sql, array($item_id));
		if($query->num_rows() === 0) return false;

		$bio = $query->row_array();
		return new GenericItem($query->row_array());
	}
}
