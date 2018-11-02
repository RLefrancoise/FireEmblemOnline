<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//models
		//$this->load->model('account');

		$this->load->helper(array('form', 'session'));
	}

	public function index()
	{
		$data['title']	=	'Home';

		$this->load->view('templates/header', $data);
		//$this->load->view('check_logged_in');
		$this->load->view('templates/footer');
	}

	public function login() {

		$this->load->model('accounts_model','',TRUE);

		$res = array('status' => 'error');

		if($this->input->post_get('username') == "" or $this->input->post_get('password') == "") {
			echo json_encode($res);
			return;
		}

		$user = $this->security->xss_clean($_POST['username']);
		$password = $this->security->xss_clean($_POST['password']);

		//query the database
		$result = $this->accounts_model->login($user, $password);

		if($result) {
			$sess_array = array(
			 'id'		=> 	$result->getId(),
			);

			//$_SESSION['logged_in'] = $sess_array;
			$this->session->set_userdata('logged_in', $sess_array);

			$res['status'] = 'login_ok';
		}
		else {
			$res['status'] = 'Invalid username or password';
		}

		echo json_encode($res);
	}
}