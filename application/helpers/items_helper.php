<?php

require_once(__DIR__ . '/../models/classes/Weapon.class.php');
require_once(__DIR__ . '/../models/config/constants.php');

function get_shop()
{
	$CI =& get_instance();

	$CI->load->model('weapons_model');
	$CI->load->model('items_model');

	$shop = array(
        WEAPON_TYPE_SWORD       => array(),
        WEAPON_TYPE_SPEAR       => array(),
        WEAPON_TYPE_AXE         => array(),
        WEAPON_TYPE_BOW         => array(),
        WEAPON_TYPE_KNIFE       => array(),
        WEAPON_TYPE_STRIKE      => array(),
        WEAPON_TYPE_FIRE        => array(),
        WEAPON_TYPE_THUNDER     => array(),
        WEAPON_TYPE_WIND        => array(),
        WEAPON_TYPE_LIGHT       => array(),
        WEAPON_TYPE_DARK        => array(),
        WEAPON_TYPE_STAFF       => array(),
        ITEM_TYPE_GENERIC_ITEM  => array(),
    );

	$items = $CI->items_model->get_items();
	$weapons = $CI->weapons_model->get_weapons();
	$items = array_merge($items, $weapons);

	foreach($items as $item) {
		if($item->getWorth() === false) continue;
        $shop[$item->getType()][] = $item;
    }

    return $shop;
}

function get_item_by_type($type, $id)
{
	$CI =& get_instance();

	$CI->load->model('weapons_model');
	$CI->load->model('items_model');

	$item = false;

	switch($type)
	{
		// weapons
		case ITEM_TYPE_WEAPON:
		{
			$item = $CI->weapons_model->get_weapon($id);
		}
			break;

		// generic item
		case ITEM_TYPE_GENERIC_ITEM:
			$item = $CI->items_model->get_item($id);
			break;
		// consumable
		case ITEM_TYPE_CONSUMABLE:
			break;

		// skill scroll
		case ITEM_TYPE_SKILL_SCROLL:
			break;
	}

	return $item;
}

function weapon_rank_to_int($rank)
{
	switch($rank)
	{
		case WEAPON_RANK_E:
			return 0;
		case WEAPON_RANK_D:
			return 1;
		case WEAPON_RANK_C:
			return 2;
		case WEAPON_RANK_B:
			return 3;
		case WEAPON_RANK_A:
			return 4;
		case WEAPON_RANK_S:
			return 5;
		case WEAPON_RANK_SS:
			return 6;
		default:
			return false;
	}
}

function weapon_type_to_string($type)
{
	switch($type)
	{
		case WEAPON_TYPE_SWORD:
			return 'Sword';
		case WEAPON_TYPE_SPEAR:
			return 'Spear';
		case WEAPON_TYPE_AXE:
			return 'Axe';
		case WEAPON_TYPE_BOW:
			return 'Bow';
		case WEAPON_TYPE_KNIFE:
			return 'Knife';
		case WEAPON_TYPE_STRIKE:
			return 'Strike';
		case WEAPON_TYPE_FIRE:
			return 'Fire';
		case WEAPON_TYPE_THUNDER:
			return 'Thunder';
		case WEAPON_TYPE_WIND:
			return 'Wind';
		case WEAPON_TYPE_LIGHT:
			return 'Light';
		case WEAPON_TYPE_DARK:
			return 'Dark';
		case WEAPON_TYPE_STAFF:
			return 'Staff';
		default:
			return false;
	}
}
