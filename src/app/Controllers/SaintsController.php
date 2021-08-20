<?php

namespace App\Controllers;

use App\Models\Saint;
use App\Session;

class SaintsController
{
    public function index()
    {
        view('saints/index.php');
    }

    public function create()
    {
        view('saints/create.php');
    }

    public function store()
    {
        if ($_FILES['photo']['name']) {
            $_FILES['photo']['name'] = generateUniqueName();
        }

        $saint = new Saint();
        $saint->setPhoto($_FILES['photo']['name'] ?? '');
        $saint->setName($_POST['name'] ?? '');
        $saint->setBaptismName($_POST['baptism_name'] ?? '');
        $saint->setBirthdate($_POST['birthdate'] ?? '');
        $saint->setFeastDate($_POST['feast_date'] ?? '');
        $saint->setNation($_POST['nation'] ?? '');
        $saint->setCity($_POST['city'] ?? '');
        $saint->setPhrase($_POST['phrase'] ?? '');
        $saint->setBio($_POST['bio'] ?? '');
        $saint->setPrayer($_POST['prayer'] ?? '');

        if (! $saint->hasValidData()) {
            $errors = $saint->getErrors();

            Session::set('errors', $errors);
            Session::set('old_input', $_POST);

            redirect('/saints/create');
            return;
        }

        $saint->save();
        $saint = Saint::getByUser(auth()->getId());

        redirectWithMessage('/saints/' . $saint->getId(), 'Saint Registered Successfully!');
    }

    public function show()
    {
        $saintId = preg_replace('/[^0-9]/', '', $_SERVER['REQUEST_URI']);

        $saint = Saint::getById($saintId);

        if (! $saint) {
            redirect('/');
        }

        if (! $saint->getApproved()) {
            if ($saint->getUserId() === auth()->getId()) {
                view('saints/show.php', [
                    'saint' => $saint
                ]);
                exit();
            } else {
                redirect('/');
            }
        }

        view('saints/show.php', [
            'saint' => $saint
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
}
