<?php

function get_support_data(Unit $unit)
{
    $CI =& get_instance();
    $CI->load->model('units_model');
    $CI->load->model('affinities_model');

    $data['name'] = '';
    $data['level'] = $unit->getSupportLevel();
    $data['atk'] = 0;
    $data['def'] = 0;
    $data['hit'] = 0;
    $data['avd'] = 0;

    $bonus_multiplier = 0;
    switch($unit->getSupportLevel()) {
        case 'C':
            $bonus_multiplier = 1;
            break;
        case 'B':
            $bonus_multiplier = 2;
            break;
        case 'A':
            $bonus_multiplier = 3;
    }

    if($unit->getSupportId())
    {
        $support = $CI->units_model->get_unit($unit->getSupportId());
        $affinity = $CI->affinities_model->get_affinity($support['affinity_id']);

        $data['name'] = $support['name'];
        $data['atk'] = round(($unit->getAffinity()->getAtkSupport() + $affinity->getAtkSupport()) * $bonus_multiplier);
        $data['def'] = round(($unit->getAffinity()->getDefSupport() + $affinity->getDefSupport()) * $bonus_multiplier);
        $data['hit'] = round(($unit->getAffinity()->getHitSupport() + $affinity->getHitSupport()) * $bonus_multiplier);
        $data['avd'] = round(($unit->getAffinity()->getAvdSupport() + $affinity->getAvdSupport()) * $bonus_multiplier);
    }

    return $data;
}

?>