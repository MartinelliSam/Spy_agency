<?php

class LogoutController 
{
    public function logout() 
    {
        // disabling and destructing session infos
        session_unset();
        session_destroy();
        header('location: ' . BASE_URL . '/');
    }
}