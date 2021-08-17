<?php

namespace App\Controllers;

class UsersController
{
    public function register()
    {
        view('auth/register.php');
    }

    public function login()
    {
        view('auth/login.php');
    }
}
