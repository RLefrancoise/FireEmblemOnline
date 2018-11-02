<?php

require_once(__DIR__ . '/../models/classes/Unit.class.php');

function get_units_by_account($account_id)
{
	$CI =& get_instance();
	$CI->load->model('accounts_units_model');

	$user_units = $CI->accounts_units_model->get_units($account_id);
	if(!$user_units)
	{
		trigger_error("No account units found with id account_id = $account_id", E_USER_ERROR);
	}

	$units = array();

	foreach($user_units as $user_unit)
	{
		$unit = create_unit_by_user_unit($user_unit);
		$units[] = $unit;
	}

	return $units;
}

function get_unit_by_account($account_id, $unit_id)
{
	$CI =& get_instance();
	$CI->load->model('accounts_units_model');

	$user_unit = $CI->accounts_units_model->get_unit($account_id, $unit_id);
	if(!$user_unit)
	{
		trigger_error("No account unit found with id account_id = $account_id and unit_id = $unit_id", E_USER_ERROR);
	}

	$unit = create_unit_by_user_unit($user_unit);

	return $unit;
}

function create_unit_by_user_unit($user_unit)
{
	$CI =& get_instance();

	$CI->load->model('affinities_model');
	$CI->load->model('units_model');
	$CI->load->model('units_classes_model');
	$CI->load->model('accounts_units_model');
	$CI->load->model('units_bonds_model');
	$CI->load->model('biorhythm_model');
	$CI->load->model('races_model');

	$CI->load->helper('items');

	// general unit
	$unit_data = $CI->units_model->get_unit($user_unit['unit_id']);
	if(!$unit_data)
	{
		trigger_error("No unit found with id {$user_unit['unit_id']}", E_USER_ERROR);
	}

	// class
	$unit_class = $CI->units_classes_model->get_class($user_unit['class_id']);
	if(!$unit_class)
	{
		trigger_error("No class found for unit {$user_unit['unit_id']}", E_USER_ERROR);
	}

	// affinity
	$affinity = $CI->affinities_model->get_affinity($unit_data['affinity_id']);
	if(!$affinity)
	{
		trigger_error("No affinity found for unit {$unit_data['unit_id']} with id = {$unit_data['affinity_id']}", E_USER_ERROR);
	}

	//race
	$race = $CI->races_model->get_race($unit_data['race_id']);
	if(!$race)
	{
		trigger_error("No race found for unit {$unit_data['unit_id']} with id = {$unit_data['race_id']}", E_USER_ERROR);
	}

	// items
	$items = $CI->accounts_units_model->get_unit_items($user_unit['account_id'], $user_unit['unit_id']);
	/*$items_data = $CI->accounts_units_model->get_unit_items($user_unit['account_id'], $user_unit['unit_id']);
	$items = array();

	foreach($items_data as $item_data)
	{
		$place = (int) $item_data['place'];
		$item = get_item_by_type($item_data['item_type'], $item_data['item_id']);
		if($item !== false) {
			$item->setCurrentUses($item_data['current_uses']);
			$items[$place] = $item;
		}
	}*/

	// biorhythm
	$bio = $CI->biorhythm_model->get_biorhythm($unit_data['biorhythm_id']);
	if($bio) {
		$bio->setTurn($user_unit['biorhythm_turn']);
	}

	//bonds
	$bonds = $CI->units_bonds_model->get_bonds($unit_data['unit_id']);

	//graphics
	$graphics = $CI->units_model->get_graphics($unit_data['unit_id'], $user_unit['class_id']);

	//support
	$support = $CI->accounts_units_model->get_unit_support($user_unit['account_id'], $unit_data['unit_id']);
	if($support !== false) {
		$user_unit['support_id'] = $support['support_id'];
		$user_unit['support_level'] = $support['support_level'];
	} else {
		$user_unit['support_id'] = null;
		$user_unit['support_level'] = null;
	}

	//skills
	$skills = $CI->accounts_units_model->get_unit_skills($user_unit['account_id'], $unit_data['unit_id']);

	$unit = new Unit($unit_data, $user_unit, $unit_class, $affinity, $race, $items, $bio, $bonds, $graphics, $skills);

	//check unit for possible problems
	check_unit_validity($unit);
	return $unit;
}

function check_unit_validity(Unit &$unit)
{
	$CI =& get_instance();

	$CI->load->model('accounts_units_model');

	//-------------------------
	//equipped weapon validity
	//-------------------------

	//has unit a weapon equipped ?
	if($unit->getEquippedWeaponPlace() !== false)
	{
		$item = false;

		//check if current equipped weapon is valid or not
		if($unit->getItem($unit->getEquippedWeaponPlace()) !== false)
		{
			$item = $unit->getItem($unit->getEquippedWeaponPlace());

			// OK, weapon seems valid, we can stop checking
			if($item->isWeapon() and $unit->canEquipWeapon($item))
				goto check_weapon_end;
		}

		//if weapon is invalid, try to find the first valid one
		if(!$item or !$item->isWeapon() or !$unit->canEquipWeapon($item))
		{
			$i = 0;
			for( ; $i < count($unit->getItems()) ; $i++)
			{
				if(!$unit->getItem($i)) continue;

				$item = $unit->getItem($i);

				if($item->isWeapon() and $unit->canEquipWeapon($item))
				{
					// update equipped weapon place (unit is updated by model)
					$CI->accounts_units_model->set_equipped_weapon_place($unit, $i);

					goto check_weapon_end;
				}
			}
		}

		//if we are here, no weapon can be equipped at all, unequip weapon
		$CI->accounts_units_model->set_equipped_weapon_place($unit, null);
	}

	check_weapon_end:
}

