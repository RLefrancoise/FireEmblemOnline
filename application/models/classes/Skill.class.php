<?php

class Skill {

    private $id;
    private $name;
    private $description;
    private $capacity;
    private $icon;
    private $locked;
    private $ignore_capacity;

    public function __construct($data)
    {
        $this->id               =   $data['skill_id'];
        $this->name             =   $data['name'];
        $this->description      =   $data['description'];
        $this->capacity         =   $data['capacity'];
        $this->icon             =   $data['icon'];
        $this->locked           =   isset($data['locked']) ? $data['locked'] : false;
        $this->ignore_capacity  =   isset($data['ignore_capacity']) ? $data['ignore_capacity'] : false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCapacity()
    {
        return $this->ignore_capacity ? null : $this->capacity;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function isLocked()
    {
        return $this->locked;
    }

    public function setLocked($locked)
    {
        $this->locked = $locked;
    }

    public function setIgnoreCapacity($ignore_capacity)
    {
        $this->ignore_capacity = $ignore_capacity;
    }

    public function getEffect()
    {
        $effect_class = preg_replace('/[^A-Za-z0-9]/', '', $this->name);
        $effect_class = ucfirst(strtolower($effect_class));

        if(file_exists(__DIR__ . '/skill_effects/' . $effect_class . '.class.php')) {
            require_once(__DIR__ . '/skill_effects/' . $effect_class . '.class.php');
            return new $effect_class($this);
        } else {
            return false;
        }
    }
}