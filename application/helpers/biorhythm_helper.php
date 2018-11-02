<?php
require_once(__DIR__ . '/../models/classes/Biorhythm.class.php');

function get_biorhythm_by_id($id)
{
	$CI =& get_instance();
	$CI->load->model('biorhythm_model');

	$bio = $CI->biorhythm_model->get_biorhythm($id);
	if($bio === false) return false;

	$wave = $CI->biorhythm_model->get_biorhythm_wave($id);
	if($wave === false) return false;

	$bio['wave'] = $wave;

	return new Biorhythm($bio);
}