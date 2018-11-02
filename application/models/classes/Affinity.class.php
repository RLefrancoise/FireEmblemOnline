<?php

class Affinity
{
	private $id;
	private $name;
	private $icon;
	private $atk_support;
	private $def_support;
	private $hit_support;
	private $avd_support;

	public function __construct($data)
	{
		$this->id			=	$data['affinity_id'];
		$this->name			=	$data['name'];
		$this->icon			=	$data['icon'];
		$this->atk_support	=	$data['atk_support'];
		$this->def_support	=	$data['def_support'];
		$this->hit_support	=	$data['hit_support'];
		$this->avd_support	=	$data['avd_support'];
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getIcon()
	{
		return $this->icon;
	}

	public function getAtkSupport()
	{
		return $this->atk_support;
	}

	public function getDefSupport()
	{
		return $this->def_support;
	}

	public function getHitSupport()
	{
		return $this->hit_support;
	}

	public function getAvdSupport()
	{
		return $this->avd_support;
	}
}
