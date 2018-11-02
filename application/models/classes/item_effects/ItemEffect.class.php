<?php

require_once(__DIR__ . '/../../config/constants.php');
require_once(__DIR__ . '/../Unit.class.php');
require_once(__DIR__ . '/../GenericItem.class.php');

class ItemEffect {
    protected $item;

    public function __construct(GenericItem $item) {
        $this->item = $item;
    }

    public function getStatsBonus() {
        return false;
    }

    public function useOutsideBattle() {
        return false;
    }

    public function canUse(Unit &$unit, Unit &$target, $map) {
        return false;
    }

    public function onUse(Unit &$unit, Unit &$target, $map) {
        return false;
    }
}