<?php

function is_logged_in($session) {
    //if(isset($_SESSION['logged_in']))
	if(!$session->userdata('logged_in'))
		return false;
	else
		return true;
}

function check_logged_in($session) {
	if(!is_logged_in($session)) {
		redirect('home', 'refresh');
	}
}

function get_account() {
    $CI =& get_instance();

    if(!is_logged_in($CI->session)) return false;

    $CI->load->model('accounts_model');

    return $CI->accounts_model->get_account($CI->session->userdata('logged_in')['id']);
}