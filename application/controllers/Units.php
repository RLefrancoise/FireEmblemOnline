<?php

require_once(__DIR__ . '/../models/classes/Unit.class.php');
require_once(__DIR__ . '/../models/classes/UnitClass.class.php');

class Units extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('units_model');
		$this->load->model('units_classes_model');
		$this->load->model('accounts_units_model');
		$this->load->model('factions_model');

		$this->load->helper('units');
		$this->load->helper('support');
	}

	public function index()
	{
		check_logged_in($this->session);

		try {
			$this->db->trans_begin();

			$data['title']	=	'Units';

			//get units of user
			$units = get_units_by_account(get_account()->getId());

			$data['units'] 	= 	$units;

			$this->load->view('templates/header', $data);
			$this->load->view('templates/units', $data);
			$this->load->view('templates/footer');

			if ($this->db->trans_status() === FALSE) throw new Exception("Transaction Failed");

			$this->db->trans_commit();
		} catch(Exception $e) {
			$this->db->trans_rollback();
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
	}

	public function view($id)
	{
		check_logged_in($this->session);

		try {
			$this->db->trans_begin();

			$unit = get_unit_by_account(get_account()->getId(), $id);

			$data['unit'] 	= 	$unit;
			$data['title']	=	$unit->getName();

			//leader
			$data['leader_name'] = '';

			if($unit->getLeaderId())
			{
				$leader = $this->units_model->get_unit($unit->getLeaderId());
				$data['leader_name'] = $leader['name'];
			}

			//faction
			$data['faction_name'] = '';

			if($unit->getFactionId())
			{
				$faction = $this->factions_model->get_faction($unit->getFactionId());
				$data['faction_name'] = $faction['name'];
			}

			//bonds
			$data['bonds'] = array(
				'names' => array(),
				'bonus' => 0,
			);

			if($unit->getBonds())
			{
				$bonds = $unit->getBonds();
				for($i = 0 ; $i < count($bonds) ; $i++)
				{
					$data['bonds']['names'][] = $this->units_model->get_unit($bonds[$i]['bond_id'])['name'];
					$data['bonds']['bonus'] += $bonds[$i]['bonus'];
				}
			}

			//support
			$data['support'] = get_support_data($unit);

			$this->load->view('templates/header', $data);
			$this->load->view('templates/view_unit', $data);
			$this->load->view('templates/footer');

			if ($this->db->trans_status() === FALSE) throw new Exception("Transaction Failed");

			$this->db->trans_commit();
		} catch(Exception $e) {
			$this->db->trans_rollback();
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
	}
}