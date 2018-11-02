<?php

require_once(__DIR__ . '/classes/Account.class.php');

class Accounts_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	function login($username, $password) {
		$query = $this->db->query("SELECT * FROM accounts WHERE username = ? and password = ? LIMIT 1", array($username, md5($password)));


		if($query->num_rows() == 1) {
			$data = $query->row_array();
			$data['account_data'] = $this->get_account_data($data['id']);
			return new Account($data);
		} else {
			return false;
		}
	}

	public function get_account($id) {
		$query = $this->db->get_where('accounts', array('id' => $id));

		$data = $query->row_array();
		$data['account_data'] = $this->get_account_data($id);

		return new Account($data);
	}

	public function get_account_data($account_id) {
		$query = $this->db->get_where('accounts_data', array('account_id', $account_id));
		$account_data = $query->row_array();
		return $account_data;
	}

	public function set_gold($account_id, $gold) {
		$this->update_data($account_id, array(
			'gold'	=>	$gold,
		));
	}

	private function update($account_id, $data) {
		$this->db->where('id', $account_id);
		if(!$this->db->update('accounts', $data)) throw new Exception($this->db->error()['message']);
	}

	private function update_data($account_id, $data) {
		$this->db->where('account_id', $account_id);
		if(!$this->db->update('accounts_data', $data)) throw new Exception($this->db->error()['message']);
	}
}
