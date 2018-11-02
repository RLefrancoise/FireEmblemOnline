<?php

if(!$this->session->userdata('logged_in')) {
	refresh('login', 'refresh');
}

?>