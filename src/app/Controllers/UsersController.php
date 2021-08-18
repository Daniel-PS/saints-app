<?php

namespace App\Controllers;

use App\Models\User;
use App\Session;

class UsersController
{
    public function show()
    {
        if (! Session::get('user')) {
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
        $user = Session::get('user');

        if (! $user) {
            redirect('/');
        }

        $userId = preg_replace('/[^0-9]/', '', $_SERVER['REQUEST_URI']);

        if ($userId === $user->getId()) {
            view('users/edit.php', [
                'user' => $user
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