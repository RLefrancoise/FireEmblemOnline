<?php

function send_ajax_if_not_logged_in($session) {

    $CI =& get_instance();
    $CI->load->helper('session');

    if(!is_logged_in($session)) {
        echo json_encode(array(
            'success'   =>  false,
            'error'     =>  'Not logged in',
            'redirect'  =>  'home',
        ));

        exit;
    }
}

function send_ajax_success($data = false) {
    $json = array(
        'success'   =>  true,
    );

    if($data) {
        $json = array_merge($json, $data);
    }

    echo json_encode($json);
}

function send_ajax_error($error, $redirect = false) {
    echo json_encode(array(
        'success'   =>  false,
        'error'     =>  $error,
        'redirect'  =>  ($redirect !== false) ? $redirect : false,
    ));
}