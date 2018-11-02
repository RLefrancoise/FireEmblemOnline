<?php

require_once(__DIR__ . '/../config/constants.php');

class Biorhythm
{
	private $id;
	private $name;
	private $turn;
	private $wave;

	public function __construct($data)
	{
		$this->id = $data['biorhythm_id'];
		$this->name = $data['name'];

		$this->wave = array();
		$this->turn = 1;

		foreach($data['wave'] as $wave_data)
		{
			$this->wave[$wave_data['turn']] = $wave_data['status'];
		}
	}

	public function getTurn()
	{
		return $this->turn;
	}

	public function getTurnsNumber()
	{
		return count($this->wave);
	}

	public function getWave()
	{
		return $this->wave;
	}

	public function getStatus()
	{
		return $this->wave[$this->turn];
	}

	public function setTurn($turn)
	{
		if($turn < 1 or $turn > BIORHYTHM_TURNS) return false;

		$this->turn = $turn;
	}

	public function nextTurn()
	{
		$this->turn++;
		if($this->turn > BIORHYTHM_TURNS) $this->turn = 1;
	}

	public function randomTurn()
	{
		$this->turn = mt_rand(1, BIORHYTHM_TURNS);
	}
}