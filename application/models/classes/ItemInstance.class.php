<?php

class ItemInstance {
	private $instance_id;
	private $item;
	private $current_uses;

	public function __construct($data, $item) {
		$this->instance_id 	= 	$data['item_instance_id'];
		$this->item 		= 	$item;
		$this->current_uses	=	$data['current_uses'];
	}

	/*
	* Magic method to make shorcut between instance methods and item methods
	*/
	public function __call($name, $arguments) {
		$available_methods = get_class_methods($this->item);
		if(in_array($name, $available_methods)) {
			return $this->item->$name($arguments);
		} else {
			trigger_error("ItemInstance <id:{$this->instance_id}> no such method $name", E_USER_ERROR);
		}
	}

	public function getInstanceId() {
		return $this->instance_id;
	}

	public function getItem() {
		return $this->item;
	}

	public function getCurrentUses() {
		return $this->current_uses;
	}




	public function setCurrentUses($uses)
	{
		if($uses < 0) return;

		$this->current_uses = (int) $uses;

		if($this->current_uses > $this->item->getUses()) $this->current_uses = $this->item->getUses();
	}
}