<?php

require_once(__DIR__ .'/Item.class.php');

class Weapon extends Item
{
	private $rank;
	private $might;
	private $hit;
	private $crit;
	private $weight;
	private $range;
	private $wexp;
	private $is_magic;
	private $traits_bonus;

	public static $WEAPON_TYPES = array(
	    WEAPON_TYPE_SWORD,
	    WEAPON_TYPE_SPEAR,
	    WEAPON_TYPE_AXE,
	    WEAPON_TYPE_BOW,
	    WEAPON_TYPE_KNIFE,
	    WEAPON_TYPE_STRIKE,
	    WEAPON_TYPE_FIRE,
	    WEAPON_TYPE_THUNDER,
	    WEAPON_TYPE_WIND,
	    WEAPON_TYPE_LIGHT,
	    WEAPON_TYPE_DARK,
	    WEAPON_TYPE_STAFF,
	);

	public function __construct($data, $traits_bonus = array())
	{
		parent::__construct($data['type'], $data);

		$this->rank			=	($data['rank'] !== null ? $data['rank'] : false);
		$this->might		=	(int) $data['might'];
		$this->hit			=	(int) $data['hit'];
		$this->crit			=	($data['crit'] !== null ? (int) $data['crit'] : false);
		$this->weight		=	(int) $data['weight'];
		$this->range		=	array();
		$this->range['min']	=	(int) $data['range_min'];
		$this->range['max']	=	(int) $data['range_max'];
		$this->wexp			=	(int) $data['wexp'];
		$this->is_magic		=	$data['is_magic'];

		$this->traits_bonus =	$traits_bonus;
	}

	public function getRank()
	{
		return $this->rank;
	}

	public function getMight()
	{
		return $this->might;
	}

	public function getHit()
	{
		return $this->hit;
	}

	public function getCrit()
	{
		return $this->crit;
	}

	public function getWeight()
	{
		return $this->weight;
	}

	public function getRange()
	{
		return $this->range;
	}

	public function getWexp()
	{
		return $this->wexp;
	}

	public function isMagic()
	{
		return $this->is_magic;
	}

	public function getTraitsBonus()
	{
		return $this->traits_bonus;
	}

	public function getTooltipText()
	{
		$CI =& get_instance();
		$CI->load->helper('items');

		return "<strong>" . weapon_type_to_string($this->getType()). "</strong> " . ($this->rank ? $this->rank : '-')
			. " <strong>Might</strong> " . $this->might
			. " <strong>Hit</strong> " . $this->hit
			. " <strong>Crit</strong> " . ($this->crit !== false ? (string) $this->crit : '-')
			. " <strong>Weight</strong> " . $this->weight
			. " <strong>Range</strong> " . ($this->range['min'] != $this->range['max'] ? $this->range['min'] . '~' . $this->range['max'] : $this->range['max'])
			. " <br>{$this->getDescription()}";
	}
}
