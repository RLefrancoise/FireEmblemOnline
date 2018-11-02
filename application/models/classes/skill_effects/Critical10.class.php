<?php

require_once('SkillEffect.class.php');

class Critical10 extends SkillEffect
{
    public function getStatsBonus() {
        return array(
            BATTLESTAT_CRITICAL  =>  10,
        );
    }
}