<?php

require_once(__DIR__ . '/../config/constants.php');

class UnitClass
{
	private $id;
	private $name;
	private $tier;
	private $base_stats;
	private $max_stats;
	private $growth;
	private $weapon_ranks;
	private $vision;
	private $skill_capacity;

	private $skills;
	private $traits;

	public function __construct($data, $skills = array(), $traits = array())
	{
		$this->id									=	(int) $data['class_id'];
		$this->name									=	$data['name'];
		$this->tier									=	(int) $data['tier'];

		$this->base_stats 							= 	array();
		$this->base_stats[STAT_TYPE_HP]				=	(int) $data['base_hp'];
		$this->base_stats[STAT_TYPE_STRENGTH]		=	(int) $data['base_strength'];
		$this->base_stats[STAT_TYPE_MAGIC]			=	(int) $data['base_magic'];
		$this->base_stats[STAT_TYPE_SKILL]			=	(int) $data['base_skill'];
		$this->base_stats[STAT_TYPE_SPEED]			=	(int) $data['base_speed'];
		$this->base_stats[STAT_TYPE_LUCK]			=	(int) $data['base_luck'];
		$this->base_stats[STAT_TYPE_DEFENCE]		=	(int) $data['base_defence'];
		$this->base_stats[STAT_TYPE_RESISTANCE]		=	(int) $data['base_resistance'];
		$this->base_stats[STAT_TYPE_CONSTITUTION]	=	(int) $data['base_constitution'];
		$this->base_stats[STAT_TYPE_WEIGHT]			=	(int) $data['base_weight'];
		$this->base_stats[STAT_TYPE_MOVEMENT]		=	(int) $data['base_movement'];

		$this->vision								=	(int) $data['base_vision'];

		$this->max_stats							=	array();
		$this->max_stats[STAT_TYPE_HP]				=	(int) $data['max_hp'];
		$this->max_stats[STAT_TYPE_STRENGTH]		=	(int) $data['max_strength'];
		$this->max_stats[STAT_TYPE_MAGIC]			=	(int) $data['max_magic'];
		$this->max_stats[STAT_TYPE_SKILL]			=	(int) $data['max_skill'];
		$this->max_stats[STAT_TYPE_SPEED]			=	(int) $data['max_speed'];
		$this->max_stats[STAT_TYPE_LUCK]			=	(int) $data['max_luck'];
		$this->max_stats[STAT_TYPE_DEFENCE]			=	(int) $data['max_defence'];
		$this->max_stats[STAT_TYPE_RESISTANCE]		=	(int) $data['max_resistance'];

		$this->growth								= 	array();
		$this->growth[STAT_TYPE_HP]					=	(int) $data['hp_growth'];
		$this->growth[STAT_TYPE_STRENGTH]			=	(int) $data['strength_growth'];
		$this->growth[STAT_TYPE_MAGIC]				=	(int) $data['magic_growth'];
		$this->growth[STAT_TYPE_SKILL]				=	(int) $data['skill_growth'];
		$this->growth[STAT_TYPE_SPEED]				=	(int) $data['speed_growth'];
		$this->growth[STAT_TYPE_LUCK]				=	(int) $data['luck_growth'];
		$this->growth[STAT_TYPE_DEFENCE]			=	(int) $data['defence_growth'];
		$this->growth[STAT_TYPE_RESISTANCE]			=	(int) $data['resistance_growth'];

		$this->weapon_ranks							=	array();
		$this->weapon_ranks[WEAPON_TYPE_SWORD]		=	($data['sword_rank'] ? $data['sword_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_SPEAR]		=	($data['spear_rank'] ? $data['spear_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_AXE]		=	($data['axe_rank'] ? $data['axe_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_BOW]		=	($data['bow_rank'] ? $data['bow_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_KNIFE]		=	($data['knife_rank'] ? $data['knife_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_STRIKE]		=	($data['strike_rank'] ? $data['strike_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_FIRE]		=	($data['fire_rank'] ? $data['fire_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_THUNDER]	=	($data['thunder_rank'] ? $data['thunder_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_WIND]		=	($data['wind_rank'] ? $data['wind_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_LIGHT]		=	($data['light_rank'] ? $data['light_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_DARK]		=	($data['dark_rank'] ? $data['dark_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_STAFF]		=	($data['staff_rank'] ? $data['staff_rank'] : false);

		$this->skill_capacity						=	$data['skill_capacity'];

		$this->skills								=	$skills;

		$this->traits 								=	$traits;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getTier()
	{
		return $this->tier;
	}

	public function getMaxStat($stat)
	{
		if(!isset($this->max_stats[$stat]))
		{
			trigger_error("No such stat : $stat", E_USER_WARNING);
		}

		return $this->max_stats[$stat];
	}

	public function getWeaponRank($weapon)
	{
		if(!isset($this->weapon_ranks[$weapon]))
		{
			trigger_error("No such weapon : $weapon", E_USER_WARNING);
		}

		return $this->weapon_ranks[$weapon];
	}

	public function getSkillCapacity()
	{
		return $this->skill_capacity;
	}

	public function getSkills()
	{
		return $this->skills;
	}

	public function getTraits()
	{
		return $this->traits;
	}
}
