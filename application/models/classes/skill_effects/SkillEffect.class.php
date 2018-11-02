<?php

require_once(__DIR__ . '/../../config/constants.php');
require_once(__DIR__ . '/../Unit.class.php');

abstract class SkillEffect {
    protected $skill;

    public function __construct($skill) {
        $this->skill = $skill;
    }

    public function getStatsBonus() {
        return false;
    }

    public function onBeforeBattle(Unit &$unit, Unit &$target, $map) {
        return false;
    }

    public function onBeforeAttack(Unit &$unit, Unit &$target) {
        return false;
    }

    public function onBeforeDamage(Unit &$unit, Unit &$target) {
        return false;
    }
}