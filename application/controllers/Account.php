<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//models
		$this->load->model('accounts_model');
		
		//helpers
		$this->load->helper(array('session'));
	}

	public function index()
	{
		check_logged_in($this->session);
		
		$user_data = $this->session->userdata('logged_in');
		$user_id = $user_data->getId();
		//$username = $user_data['username'];
		
		$data['account'] 	= 	$this->accounts_model->get_account($user_id);
		$data['title']	=	'My Account';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/footer');
	}
}

?>