<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Saint;
use App\Models\UsersDevotionSaints;

class UsersController
{
    public function show()
    {
        preg_match_all('!\d+!', $_SERVER['REQUEST_URI'], $matches);
        $userId = $matches[0][0];

        $devotionPage = ! empty($_GET['devotionPage']) ? ((int) $_GET['devotionPage']) : 1;
        $registeredPage = ! empty($_GET['registeredPage']) ? ((int) $_GET['registeredPage']) : 1;
        $approvalPage = ! empty($_GET['approvalPage']) ? ((int) $_GET['approvalPage']) : 1;
        $perPage = 1;

        $user = User::getById($userId);
        $devotionsPaginator = UsersDevotionSaints::getUserDevotions($userId, $perPage, $devotionPage);
        $registeredSaintsPaginator = Saint::getByUserApproved($userId, 1, $perPage, $registeredPage);
        $approvalSaintsPaginator = Saint::getByUserApproved($userId, 0, $perPage, $approvalPage);

        if (! $user) {
            redirect('/');
        }

        view('users/show.php', [
            'user' => $user,
            'devotionPage' => $devotionPage,
            'registeredPage' => $registeredPage,
            'approvalPage' => $approvalPage,
            'devotionsPaginator' => $devotionsPaginator,
            'registeredSaintsPaginator' => $registeredSaintsPaginator,
            'approvalSaintsPaginator' => $approvalSaintsPaginator
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
