<?php

function give_gold(Account &$account, $gold) {
    $CI =& get_instance();
    $CI->load->model('accounts_model');

    $CI->accounts_model->set_gold($account->getId(), $account->getGold() + $gold);

    $account->setGold($account->getGold() + $gold);
}