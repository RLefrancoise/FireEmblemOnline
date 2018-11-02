<?php

class Race {
	private $id;
	private $name;

	public function __construct($data) {
		$this->id 				= 	$data['race_id'];
		$this->name 			=	$data['name'];
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}
}