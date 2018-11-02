<?php

require_once(__DIR__ .'/Item.class.php');
require_once(__DIR__ .'/item_effects/ItemEffect.class.php');

class GenericItem extends Item 
{
	public function __construct($data) {
		parent::__construct(ITEM_TYPE_GENERIC_ITEM, $data);
	}

	public function getEffect()
    {
        $effect_class = preg_replace('/[^A-Za-z0-9]/', '', $this->name);
        $effect_class = ucfirst(strtolower($effect_class));

        if(file_exists(__DIR__ . '/item_effects/' . $effect_class . '.class.php')) {
            require_once(__DIR__ . '/item_effects/' . $effect_class . '.class.php');
            return new $effect_class($this);
        } else {
            return new ItemEffect($this);
        }
    }
}