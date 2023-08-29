<?php

require_once 'models/managers/LoginManager.php';

class LoginController
{
    private $loginManager;

    public function __construct()
    {
        $this->loginManager = new LoginManager;
    }

    public function index() 
    {
        require_once 'views/log/login.php';
    }

    public function login() 
    {
        $this->loginManager->connect(); 
    }
}