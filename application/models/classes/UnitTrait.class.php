<?php

class UnitTrait {
	private $id;
	private $name;
	private $description;
	private $icon;

	public function __construct($data) {
		$this->id 				= 	$data['trait_id'];
		$this->name 			=	$data['name'];
		$this->description 		= 	$data['description'];
		$this->icon 			= 	$data['icon'];
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getIcon() {
		return $this->icon;
	}
}