<?php

namespace App\Controllers;

use App\Session;
use App\Models\Saint;

class HomeController
{
    public function index()
    {
        $saints = Saint::getByApproval(1);

        $message = Session::get('message');
        Session::clear('message');

        view('home.php', [
            'saints' => $saints,
            'message' => $message
        ]);
    }

    public function goodSamaritan()
    {
        // $saints = Saint::getByApproval(1);

        view('goodSamaritan.php');
    }
}
