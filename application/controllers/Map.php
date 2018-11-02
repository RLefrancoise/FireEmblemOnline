<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//models
		//$this->load->model('account');
		$this->load->helper('ajax');
	}

	public function index() {
		check_logged_in($this->session);

		$data['title']	=	'Battle';

		$this->load->view('templates/header', $data);
		$this->load->view('battle_view', $data);
		//$this->load->view('check_logged_in');
		$this->load->view('templates/footer');
	}

	public function load() {
		check_logged_in($this->session);

		$data['title']	=	'Map';

		$mapName = $this->security->xss_clean($this->input->post_get('mapName'));

		if($mapName == "") {
			redirect('home', 'refresh');
		}

		$map_data = file_get_contents(__DIR__ . '/../data/maps/' . $mapName . '.json');
		$map_data = json_decode($map_data);

		send_ajax_success(array(
			'data'	=>	$map_data
		));
	}

}
