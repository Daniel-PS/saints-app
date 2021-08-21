<?php

namespace App\Controllers;

use App\Session;
use App\Models\Saint;
use App\Models\Comment;
use App\Models\UsersDevotionSaints;

class SaintsController
{
    public function index()
    {
        $page = ! empty($_GET['page']) ? ((int) $_GET['page']) : 1;
        $perPage = 10;

        $saintsPaginator = Saint::getByApproval(1, $perPage, $page);

        $message = Session::get('message');
        Session::clear('message');

        view('saints/index.php', [
            'saintsPaginator' => $saintsPaginator,
            'page' => $page,
            'message' => $message
        ]);
    }

    public function create()
    {
        if (! auth()) {
            redirect('/');
        }

        view('saints/create.php');
    }

    public function store()
    {
        if ($_FILES['photo']['name']) {
            $_FILES['photo']['name'] = generateUniqueName();
        }
        $saint = new Saint();
        $saint->setUserId($_POST['authorship'] === 'true' ? auth()->getId() : null);
        $saint->setPhoto($_FILES['photo']['name']);
        $saint->setName($_POST['name']);
        $saint->setBaptismName($_POST['baptism_name']);
        $saint->setBirthdate($_POST['birthdate']);
        $saint->setFeastDate($_POST['feast_date']);
        $saint->setNation($_POST['nation']);
        $saint->setCity($_POST['city']);
        $saint->setPhrase($_POST['phrase']);
        $saint->setBio($_POST['bio']);
        $saint->setPrayer($_POST['prayer']);
        $saint->setApproved(auth()->getTypeId() == 1  ? 1 : 0);

        if (! $saint->hasValidData()) {
            $errors = $saint->getErrors();

            Session::set('errors', $errors);
            Session::set('old_input', $_POST);

            redirect('/saints/create');
            return;
        }

        $saint->save();
        redirectWithMessage('/saints', 'Saint Registered Successfully! Please, wait for approval');
    }

    public function show()
    {
        preg_match_all('!\d+!', $_SERVER['REQUEST_URI'], $matches);
        $saintId = $matches[0][0];

        $saint = Saint::getById($saintId);

        if (! $saint) {
            redirect('/');
        }

        $page = ! empty($_GET['page']) ? ((int) $_GET['page']) : 1;
        $perPage = 10;

        $commentsPaginator = Comment::getBySaint($saintId, $perPage, $page);
        $totalDevotions = UsersDevotionSaints::countBySaint($saintId);

        $message = Session::get('message');
        Session::clear('message');

        if (! $saint->getApproved()) {
            if (auth()->getId() == $saint->getUserId() || auth()->getTypeId() == 1) {
                view('saints/show.php', [
                    'saint' => $saint,
                    'message' => $message,
                    'page' => $page,
                    'totalDevotions' => $totalDevotions,
                    'commentsPaginator' => $commentsPaginator
                ]);
                exit();
            } else {
                redirect('/');
            }
        }

        view('saints/show.php', [
            'saint' => $saint,
            'message' => $message,
            'page' => $page,
            'totalDevotions' => $totalDevotions,
            'commentsPaginator' => $commentsPaginator
        ]);
    }

    public function edit()
    {
        $saintId = preg_replace('/[^0-9]/', '', $_SERVER['REQUEST_URI']);

        $saint = Saint::getById($saintId);

        if (! $saint) {
            redirect('/');
        }

        if ($saint->getUserId() === auth()->getId()) {
            view('saints/edit.php', [
                'saint' => $saint
            ]);
            exit();
        } else {
            redirect('/');
        }
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }

    public function removeAuthorship()
    {
        if (! auth()) {
            redirect('/');
        }

        $saintId = preg_replace('/[^0-9]/', '', $_SERVER['REQUEST_URI']);
        $saint = Saint::getById($saintId);

        if (! $saint) {
            redirect('/');
        }

        if (auth()->getId() != $saint->getUserId()) {
            redirect('/');
        }

        $saint->removeAuthorship();

        redirectWithMessage('/saints/' . $saintId, 'Authorship removed successfully');
    }
}
