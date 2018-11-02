<?php

require_once(__DIR__ . '/../config/constants.php');
require_once(__DIR__ . '/Weapon.class.php');

class Unit
{
	//data
	private $general_id;
	private $id;
	private $account_id;
	private $name;
	private $class;
	private $level;
	private $exp;
	private $current_hp;
	private $stats;
	private $growth;
	private $weapon_ranks;
	private $affinity;
	private $race;

	//inventory
	private $items;
	private $equipped_weapon_place;

	//biorhythm
	private $biorhythm;

	//relations
	private $faction_id;
	private $authority;
	private $leader_id;
	private $bonds;
	private $support_id;
	private $support_level;

	//graphics
	private $face;
	private $resources_folder;

	//skills
	private $skills;

	public function __construct($unit_data, $user_unit_data, $unit_class, $unit_affinity, $race, $items, $biorhythm, $bonds, $graphics = false, $skills = array())
	{
		$this->general_id 							= 	(int) $unit_data['unit_id'];
		$this->id 									= 	(int) $user_unit_data['unit_id'];
		$this->account_id							=	(int) $user_unit_data['account_id'];
		$this->name 								= 	$unit_data['name'];
		$this->class								=	$unit_class;
		$this->level 								= 	(int) $user_unit_data['level'];
		$this->exp									=	(int) $user_unit_data['exp'];
		$this->current_hp							=	(int) $user_unit_data['current_hp'];

		$this->stats								=	array();
		$this->stats[STAT_TYPE_HP]					=	(int) $user_unit_data['hp'];
		$this->stats[STAT_TYPE_STRENGTH]			=	(int) $user_unit_data['strength'];
		$this->stats[STAT_TYPE_MAGIC]				=	(int) $user_unit_data['magic'];
		$this->stats[STAT_TYPE_SKILL]				=	(int) $user_unit_data['skill'];
		$this->stats[STAT_TYPE_SPEED]				=	(int) $user_unit_data['speed'];
		$this->stats[STAT_TYPE_LUCK]				=	(int) $user_unit_data['luck'];
		$this->stats[STAT_TYPE_DEFENCE]				=	(int) $user_unit_data['defence'];
		$this->stats[STAT_TYPE_RESISTANCE]			=	(int) $user_unit_data['resistance'];

		$this->stats[STAT_TYPE_CONSTITUTION] 		=	(int) $user_unit_data['constitution'];
		$this->stats[STAT_TYPE_WEIGHT]				=	(int) $user_unit_data['weight'];
		$this->stats[STAT_TYPE_MOVEMENT]			=	(int) $user_unit_data['movement'];

		$this->growth								= 	array();
		$this->growth[STAT_TYPE_HP]					=	(int) $unit_data['hp_growth'];
		$this->growth[STAT_TYPE_STRENGTH]			=	(int) $unit_data['strength_growth'];
		$this->growth[STAT_TYPE_MAGIC]				=	(int) $unit_data['magic_growth'];
		$this->growth[STAT_TYPE_SKILL]				=	(int) $unit_data['skill_growth'];
		$this->growth[STAT_TYPE_SPEED]				=	(int) $unit_data['speed_growth'];
		$this->growth[STAT_TYPE_LUCK]				=	(int) $unit_data['luck_growth'];
		$this->growth[STAT_TYPE_DEFENCE]			=	(int) $unit_data['defence_growth'];
		$this->growth[STAT_TYPE_RESISTANCE]			=	(int) $unit_data['resistance_growth'];

		$this->weapon_ranks							=	array();
		$this->weapon_ranks[WEAPON_TYPE_SWORD]		=	($user_unit_data['sword_rank'] ? $user_unit_data['sword_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_SPEAR]		=	($user_unit_data['spear_rank'] ? $user_unit_data['spear_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_AXE]		=	($user_unit_data['axe_rank'] ? $user_unit_data['axe_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_BOW]		=	($user_unit_data['bow_rank'] ? $user_unit_data['bow_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_KNIFE]		=	($user_unit_data['knife_rank'] ? $user_unit_data['knife_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_STRIKE]		=	($user_unit_data['strike_rank'] ? $user_unit_data['strike_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_FIRE]		=	($user_unit_data['fire_rank'] ? $user_unit_data['fire_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_THUNDER]	=	($user_unit_data['thunder_rank'] ? $user_unit_data['thunder_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_WIND]		=	($user_unit_data['wind_rank'] ? $user_unit_data['wind_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_LIGHT]		=	($user_unit_data['light_rank'] ? $user_unit_data['light_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_DARK]		=	($user_unit_data['dark_rank'] ? $user_unit_data['dark_rank'] : false);
		$this->weapon_ranks[WEAPON_TYPE_STAFF]		=	($user_unit_data['staff_rank'] ? $user_unit_data['staff_rank'] : false);

		$this->affinity								=	$unit_affinity;

		$this->race									=	$race;

		$this->items								=	$items;
		$this->equipped_weapon_place				=	($user_unit_data['equipped_weapon_place'] !== null ? $user_unit_data['equipped_weapon_place'] : false);

		$this->biorhythm							=	$biorhythm;

		$this->faction_id							=	($unit_data['faction_id'] !== null) ? $unit_data['faction_id'] : false;
		$this->authority							=	$unit_data['authority'] !== null ? $unit_data['authority'] : false;
		$this->leader_id							=	$unit_data['leader_id'];
		$this->bonds								=	$bonds;
		$this->support_id							=	$user_unit_data['support_id'] !== null ? $user_unit_data['support_id'] : false;
		$this->support_level						=	$user_unit_data['support_level'] !== null ? $user_unit_data['support_level'] : false;

		$this->face 								= 	($graphics === false ? $unit_data['face'] : $graphics['face']);
		$this->resources_folder						=	($graphics === false ? $unit_data['resources_folder'] : $graphics['resources_folder']);

		$this->skills 								=	$skills;
	}


	//getters


	public function getGeneralId()
	{
		return $this->general_id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getAccountId()
	{
		return $this->account_id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getClassName()
	{
		return $this->class->getName();
	}

	public function getClassTier()
	{
		return $this->class->getTier();
	}

	public function getLevel()
	{
		return $this->level;
	}

	public function getExp()
	{
		if($this->level < 20)
			return $this->exp;
		else
			return false;
	}

	public function getCurrentHP()
	{
		return $this->current_hp;
	}

	public function getStat($stat)
	{
		if(!isset($this->stats[$stat]))
		{
			trigger_error("No such stat : $stat", E_USER_WARNING);
		}

		return $this->stats[$stat];
	}

	public function getStatCap($stat)
	{
		return $this->class->getMaxStat($stat);
	}

	public function getBattleStat($stat)
	{
		//biorhythm bonus
		$bio = $this->biorhythm;
		$bio_bonus = 0;

		if($bio !== false)
		{
			switch($bio->getStatus())
			{
				case BIORHYTHM_BEST:
					$bio_bonus = 10;
					break;
				case BIORHYTHM_GOOD:
					$bio_bonus = 5;
					break;
				/*case BIORHYTHM_NORMAL:
					$bio_bonus = 0;
					break;*/
				case BIORHYTHM_BAD:
					$bio_bonus = -5;
					break;
				case BIORHYTHM_WORST:
					$bio_bonus = -10;
					break;
			}
		}


		switch($stat)
		{
			case BATTLESTAT_ATTACK:
			{
				$weapon = $this->getWeapon();
				if(!$weapon) return false;

				// Strength + Weapon Might
				// Magic + Weapon Might
				$attack = $weapon->getMight();

				if($weapon->isMagic())
					$attack += $this->getStat(STAT_TYPE_MAGIC);
				else
					$attack += $this->getStat(STAT_TYPE_STRENGTH);

				return $attack;
			}
			break;

			case BATTLESTAT_ACCURACY:
			{
				$weapon = $this->getWeapon();
				if(!$weapon) return false;

				// Weapon Hit + (Skill x 2) + Luck + Biorhythm bonus
				$acc = $weapon->getHit() + $this->getStat(STAT_TYPE_SKILL) * 2 + $this->getStat(STAT_TYPE_LUCK) + $bio_bonus;

				return $acc;
			}
			break;

			case BATTLESTAT_CRITICAL:
			{
				$weapon = $this->getWeapon();
				if(!$weapon) return false;

				$crit_bonus = 0;
				foreach($this->getSkills() as $skill) {
					$effect = $skill->getEffect();
					if(!$effect || $effect->getStatsBonus() === false) continue;

					$bonus = $effect->getStatsBonus();
					$crit_bonus += (int) $bonus[BATTLESTAT_CRITICAL];
				}

				// Weapon Critical + (Skill / 2) + Critical bonus
				$crit = $weapon->getCrit() + ((int) floor($this->getStat(STAT_TYPE_SKILL) / 2)) + $crit_bonus;

				return $crit;
			}
			break;

			case BATTLESTAT_RANGE:
			{
				$weapon = $this->getWeapon();
				if(!$weapon) return false;

				return $weapon->getRange();

				/*if($weapon->getRange()['min'] != $weapon->getRange()['max'])
				{
					return $weapon->getRange()['min'] . '~' . $weapon->getRange()['max'];
				}
				else
					return $weapon->getRange()['max'];*/
			}
			break;

			case BATTLESTAT_BONUS:
			{
				$weapon = $this->getWeapon();
				if(!$weapon) return false;

				return $weapon->getTraitsBonus();
			}
			break;

			case BATTLESTAT_ATTACK_SPEED:
			{
				$weapon = $this->getWeapon();

				$minus = 0;
				if($weapon !== false)
				{
					$minus = $weapon->getWeight() - $this->getStat(STAT_TYPE_STRENGTH);
					if($minus < 0) $minus = 0;
				}

				// Speed - (Weapon Weight - Strength, take as 0 if negative)
				return $this->getStat('speed') - $minus;
			}
			break;

			case BATTLESTAT_AVOID:
			{
				// (Attack Speed x 2) + Luck + Biorhythm bonus

				return 		$this->getBattleStat('as') * 2
						+	$this->getStat('luck')
						+ 	$bio_bonus
						;
			}
			break;

			case BATTLESTAT_DODGE:
			{
				return $this->getStat('luck');
			}
			break;

			default:
			{
				trigger_error("No such battle stat : $stat", E_USER_WARNING);
			}
			break;
		}
	}

	public function getGrowth($stat)
	{
		if(!isset($this->growth[$stat]))
		{
			trigger_error("No such stat : $stat", E_USER_WARNING);
		}

		return $this->growth[$stat];
	}

	public function getWeaponRank($weapon_type)
	{
		if(!isset($this->weapon_ranks[$weapon_type]))
		{
			trigger_error("No such weapon type : $weapon_type", E_USER_WARNING);
		}

		return $this->weapon_ranks[$weapon_type];
	}

	public function getMaxWeaponRank($weapon_type)
	{
		return $this->class->getWeaponRank($weapon_type);
	}

	public function getAffinity()
	{
		return $this->affinity;
	}

	public function getRace()
	{
		return $this->race;
	}

	public function getItems()
	{
		return $this->items;
	}

	public function getItem($place)
	{
		if($place < 0 or $place > INVENTORY_SIZE)
		{
			trigger_error("Invalid place $place", E_USER_WARNING);
		}

		if(!isset($this->items[$place])) return false;

		return $this->items[$place];
	}

	public function canEquipWeapon($weapon)
	{
		$CI =& get_instance();
		$CI->load->helper('items');

		// type of weapon can't be equipped by this unit
		if(!$this->getWeaponRank($weapon->getType()))
			return false;

		// check if weapon is allowed to be equipped by this unit (some weapon can be equipped only by some units)
		if($weapon->getRank() === false)
		{
			//need to check here before returning true
			return true;
		}

		// weapon rank of unit is lower than required rank
		if(weapon_rank_to_int($this->getWeaponRank($weapon->getType())) < weapon_rank_to_int($weapon->getRank()))
			return false;

		return true;
	}

	public function getWeapon()
	{
		if($this->equipped_weapon_place === false)
			return false;

		$weapon = $this->getItem($this->equipped_weapon_place);
		if(!$weapon)
			return false;

		if(!$weapon->isWeapon())
			return false;

		if(!$this->canEquipWeapon($weapon))
			return false;

		return $weapon;
	}

	public function getEquippedWeaponPlace()
	{
		return $this->equipped_weapon_place;
	}

	//biorhythm
	public function getBiorhythmTurn()
	{
		if(!$this->biorhythm) return false;

		return $this->biorhythm->getTurn();
	}

	public function getBiorhythmStatus()
	{
		if(!$this->biorhythm) return false;

		return $this->biorhythm->getStatus();
	}

	public function getBiorhythmTurnsNumber()
	{
		if(!$this->biorhythm) return false;

		return $this->biorhythm->getTurnsNumber();
	}

	public function getBiorhythmWave()
	{
		if(!$this->biorhythm) return false;

		return $this->biorhythm->getWave();
	}

	//relations
	public function getFactionId()
	{
		return $this->faction_id;
	}

	public function getAuthority()
	{
		return $this->authority;
	}

	public function getLeaderId()
	{
		return $this->leader_id;
	}

	public function getBonds()
	{
		return $this->bonds;
	}

	public function getSupportId()
	{
		return $this->support_id;
	}

	public function getSupportLevel()
	{
		return $this->support_level;
	}

	//graphics
	public function getFace()
	{
		return $this->face;
	}

	public function getResourcesFolder()
	{
		return $this->resources_folder;
	}

	//skills
	public function getSkillCapacity()
	{
		return $this->class->getSkillCapacity();
	}

	public function getSkills()
	{
		return array_merge($this->skills, $this->class->getSkills());
	}

	public function getTotalSkillCost()
	{
		$cost = 0;
		foreach($this->getSkills() as $skill) {
			if($skill->getCapacity()) $cost += $skill->getCapacity();
		}

		return $cost;
	}

	//setters

	public function setEquippedWeaponPlace($place)
	{
		if($place === false)
		{
			$this->equipped_weapon_place = false;
		}
		else if($place < 0 or $place > INVENTORY_SIZE)
		{
			trigger_error("Invalid place $place", E_USER_WARNING);
		}
		else
		{
			$this->equipped_weapon_place = (int) $place;
		}
	}
}