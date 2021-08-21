<?php

namespace App\Controllers;

use App\Models\Saint;

class HomeController
{
    public function index()
    {
        $saints = Saint::getByApproval(1);

        view('home.php', [
            'saints' => $saints
        ]);
    }
}
