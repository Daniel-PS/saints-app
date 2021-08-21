<?php

namespace App\Controllers;

use App\Models\Saint;

class HomeController
{
    public function index()
    {
        $saints = Saint::getByApproved(1);

        view('home.php', [
            'saints' => $saints
        ]);
    }
}
