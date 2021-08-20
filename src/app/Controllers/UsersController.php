<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
    public function show()
    {
        if (! auth()) {
            redirect('/');
        }

        $userId = preg_replace('/[^0-9]/', '', $_SERVER['REQUEST_URI']);

        $user = User::getById($userId);

        if (! $user) {
            redirect('/');
        }

        view('users/show.php', [
            'user' => $user
        ]);
    }

    public function edit()
    {
        if (! auth()) {
            redirect('/');
        }

        $userId = preg_replace('/[^0-9]/', '', $_SERVER['REQUEST_URI']);

        if ($userId === auth()->getId()) {
            view('users/edit.php', [
                'user' => auth()
            ]);
        } else {
            redirect('/');
        }
    }

    public function update()
    {
        //
    }
}
