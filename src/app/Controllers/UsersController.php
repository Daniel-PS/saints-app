<?php

namespace App\Controllers;

use App\Session;
use App\Models\User;
use App\Models\Saint;
use App\Models\UsersDevotionSaints;

class UsersController
{
    public function show()
    {
        preg_match_all('!\d+!', $_SERVER['REQUEST_URI'], $matches);
        $userId = $matches[0][0];
        $user = User::getById($userId);

        if (! $user) {
            redirect('/');
        }

        $devotionPage = ! empty($_GET['devotionPage']) ? ((int) $_GET['devotionPage']) : 1;
        $registeredPage = ! empty($_GET['registeredPage']) ? ((int) $_GET['registeredPage']) : 1;
        $approvalPage = ! empty($_GET['approvalPage']) ? ((int) $_GET['approvalPage']) : 1;
        $perPage = 1;

        $devotionsPaginator = UsersDevotionSaints::getUserDevotions($userId, $perPage, $devotionPage);
        $registeredSaintsPaginator = Saint::getByUserApproved($userId, 1, $perPage, $registeredPage);
        $approvalSaintsPaginator = Saint::getByUserApproved($userId, 0, $perPage, $approvalPage);

        $message = Session::get('message');
        Session::clear('message');

        view('users/show.php', [
            'user' => $user,
            'message' => $message,
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
            redirectWithMessage('/', 'You dont have permission to enter this route');
        }
    }

    public function update()
    {
        if (! auth()) {
            redirect('/');
        }

        $userId = preg_replace('/[^0-9]/', '', $_SERVER['REQUEST_URI']);
        $user = User::getById($userId);

        if (auth()->getId() != $user->getId()) {
            redirectWithMessage('/users/' . $user->getId(), 'You dont have permission to edit this comment.');
        }

        if ($_FILES['photo']['name']) {
            $_FILES['photo']['name'] = generateUniqueName();

            $user->setOldPhoto($user->getPhoto());
            $user->setPhoto($_FILES['photo']['name']);
        }

        $user->setName($_POST['name']);
        $user->setSurname($_POST['surname']);
        $user->setEmail($_POST['email']);

        if ($_POST['password']) {
            if ($_POST['password'] !== $_POST['confirm_password']) {
                Session::set('errors', [
                    'password' => 'Passwords does not match',
                    'confirm_password' => 'Passwords does not match',
                ]);
                Session::set('old_input', $_POST);

                redirect('/users/' . $this->id);
            }

            $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT));
        }

        if (! $user->hasValidEditedData()) {
            $errors = $user->getErrors();

            Session::set('errors', $errors);
            Session::set('old_input', $_POST);

            redirect('register');
            return;
        }

        $user->update();
        $user->login();

        redirectWithMessage('/users/' . $userId, 'Profile edited successfully!');
    }

    public function destroy()
    {
        $userId = preg_replace('/[^0-9]/', '', $_SERVER['REQUEST_URI']);

        $user = User::getById($userId);
        $user->delete();

        Session::destroy();
        Session::set('message', 'Profile deleted successfully');
    }
}
