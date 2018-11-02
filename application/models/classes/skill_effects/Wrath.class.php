<?php

require_once('SkillEffect.class.php');

class Wrath extends SkillEffect
{
    public function onBeforeAttack(Unit &$unit, Unit &$target) {
        if($unit->getCurrentHP() <= $unit->getStat(STAT_TYPE_HP) * 0.3) {
            return array(
                BATTLESTAT_CRITICAL => 50,
            );
        }
    }
}