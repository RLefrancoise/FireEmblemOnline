<?php

class Units_Bonds_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_bonds($unit_id) {
        $sql = "SELECT * FROM units_bonds
                WHERE unit1_id = ?
                OR unit2_id = ?";

		$query = $this->db->query($sql, array($unit_id, $unit_id));

		if($query->num_rows() === 0) return false;

        $data = $query->result_array();
        $res = array();

        foreach($data as $bond_data) {
            $res[] = array(
                'bond_id'   =>  ($bond_data['unit1_id'] == $unit_id) ? $bond_data['unit2_id'] : $bond_data['unit1_id'],
                'bonus'     =>  $bond_data['bonus'],
            );
        }
		return $res;
	}
}
