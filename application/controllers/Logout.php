<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->helper('session');
	}

	function index() {
		
		$this->session->sess_destroy();
		
		redirect('home', 'refresh');
	}
}

?>

