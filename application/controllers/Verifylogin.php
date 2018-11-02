<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('accounts_model','',TRUE);
	}

	function index()
	{
		if($this->input->post('username') == "" or $this->input->post('password') == "") {
			echo 'error';
			return;
		}
		
		$username = $this->security->xss_clean($_POST['username']);
		$password = $this->security->xss_clean($_POST['password']);
		
		if(!$this->check_database($username, $password)) {
			echo 'Invalid username or password';
			return;
		}
		
		echo 'login_ok';
		return;
		
		/*//This method will have the credentials validation
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->helper(array('session'));
			//Field validation failed.&nbsp; User redirected to login page
			$this->load->view('templates/header');
			$this->load->view('templates/footer');
		}
		else
		{
			//Go to private area
			redirect('home', 'refresh');
		}*/

	}

	function check_database($username, $password)
	{
		//Field validation succeeded. Validate against database
		$username = $this->input->post('username');

		//query the database
		$result = $this->accounts_model->login($username, $password);

		if($result)
		{
			$sess_array = array();
			foreach($result as $row)
			{
				/*$sess_array = array(
				 'id' => $row->id,
				 'username' => $row->username
				);*/
				$this->session->set_userdata('logged_in', $result);
			}
			return TRUE;
		}
		else
		{
			//$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}
}
?>
