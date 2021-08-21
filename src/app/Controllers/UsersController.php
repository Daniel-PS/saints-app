<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\UsersDevotionSaints;

class UsersController
{
    public function show()
    {
        preg_match_all('!\d+!', $_SERVER['REQUEST_URI'], $matches);
        $userId = $matches[0][0];

        $page = ! empty($_GET['page']) ? ((int) $_GET['page']) : 1;
        $perPage = 6;

        $user = User::getById($userId);
        $devotionsPaginator = UsersDevotionSaints::getUserDevotions($userId, $perPage, $page);

        if (! $user) {
            redirect('/');
        }

        view('users/show.php', [
            'user' => $user,
            'page' => $page,
            'devotionsPaginator' => $devotionsPaginator
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
