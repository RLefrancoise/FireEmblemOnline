<?php

class Account
{
    private $id;
    private $username;
    private $password;
    private $ip;
    private $mail;

    private $account_data;

    public function __construct($data) {
        $this->id       =       $data['id'];
        $this->username =       $data['username'];
        $this->password =       $data['password'];
        $this->ip       =       $data['ip'];
        $this->mail     =       $data['mail'];

        $this->account_data = $data['account_data'];
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getIP() {
        return $this->ip;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getGold() {
        return $this->account_data['gold'];
    }


    public function setGold($gold) {
        $this->account_data['gold'] = $gold;
    }
}