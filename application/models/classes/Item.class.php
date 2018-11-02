<?php

require_once(__DIR__ . '/../config/constants.php');

abstract class Item
{
	protected $type;
	protected $id;
	protected $name;
	protected $descr;
	protected $icon;
	protected $worth;
	//private $current_uses;
	private $uses;

	public function __construct($type, $data)
	{
		$this->type			=	$type;
		$this->id			=	(int) $data['id'];
		$this->name			=	$data['name'];
		$this->descr		=	$data['descr'];
		$this->icon			=	$data['icon'];
		$this->worth		=	($data['worth'] ? (int) $data['worth'] : false);
		$this->uses			=	($data['uses'] ? (int) $data['uses'] : false);
		//$this->current_uses	=	$this->uses;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDescription()
	{
		return $this->descr;
	}

	public function getIcon()
	{
		return $this->icon;
	}

	public function getWorth()
	{
		return $this->worth;
	}

	/*public function getCurrentUses()
	{
		return $this->current_uses;
	}*/

	public function getUses()
	{
		return $this->uses;
	}

	public function getTooltipText()
	{
		return $this->getDescription();
	}
	public final function isWeapon()
	{
		switch($this->type)
		{
			case WEAPON_TYPE_SWORD:
			case WEAPON_TYPE_SPEAR:
			case WEAPON_TYPE_AXE:
			case WEAPON_TYPE_BOW:
			case WEAPON_TYPE_KNIFE:
			case WEAPON_TYPE_STRIKE:
			case WEAPON_TYPE_FIRE:
			case WEAPON_TYPE_THUNDER:
			case WEAPON_TYPE_WIND:
			case WEAPON_TYPE_LIGHT:
			case WEAPON_TYPE_DARK:
			case WEAPON_TYPE_STAFF:
				return true;
			default:
				return false;
		}
	}



	/*public function setCurrentUses($uses)
	{
		if($uses < 0) return;

		$this->current_uses = (int) $uses;

		if($this->current_uses > $this->uses) $this->current_uses = $this->uses;
	}*/

}

