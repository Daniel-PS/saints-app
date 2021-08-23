<?php

namespace App\Controllers;

use App\Session;
use App\Models\User;

class AuthController
{
    public function register()
    {
        if (auth()) {
            redirect('/');
        }

        $errors = Session::get('errors');
        Session::clear('errors');

        view('auth/register.php', [
            'errors' => $errors
        ]);
    }

    public function login()
    {
        if (auth()) {
            redirect('/');
        }

        $errors = Session::get('errors');
        Session::clear('errors');

        view('auth/login.php', [
            'errors' => $errors,
        ]);
    }

    public function authenticate()
    {
        if (auth()) {
            redirect('/');
        }

        $user = User::getByEmail($_POST['email']);

        if (! $user) {
            $this->handleInvalidLogin();
        }

        if (! password_verify($_POST['password'], $user->getPassword())) {
            $this->handleInvalidLogin();
        }

        $user->login();

        redirectWithMessage('/', 'Wellcome back, ' . $user->getName() . '!');
    }

    public function doRegister()
    {
        $this->checkIfUserAlreadyExists();
        $this->passwordsMatch();

        if ($_FILES['photo']['name']) {
            $_FILES['photo']['name'] = generateUniqueName();
        }

        $user = new User();
        $user->setPhoto($_FILES['photo']['name']);
        $user->setName($_POST['name']);
        $user->setSurname($_POST['surname']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);

        if (! $user->hasValidData()) {
            $errors = $user->getErrors();

            Session::set('errors', $errors);
            Session::set('old_input', $_POST);

            redirect('register');
        }

        $user->save();

        $user = User::getByEmail($_POST['email']);
        $user->login();

        redirectWithMessage('/', 'Registered Successfully');
    }

    public function logout()
    {
        Session::destroy();
        redirect('/');
    }

    private function handleInvalidLogin()
    {
        Session::set('errors', [
            'password' => 'Email or passwords are incorrect'
        ]);

        Session::set('old_input', $_POST);

        redirect('/login');
    }

    private function checkIfUserAlreadyExists()
    {
        $user = User::getByEmail($_POST['email']);

        if ($user) {
            Session::set('errors', [
                'email' => 'Email already registered'
            ]);

            Session::set('old_input', $_POST);

            redirect('register');
            exit();
        }
    }

    private function passwordsMatch()
    {
        if ($_POST['password'] !== $_POST['confirm_password']) {
            Session::set('errors', [
                'password' => 'Passwords does not match',
                'confirm_password' => 'Passwords does not match',
            ]);
            Session::set('old_input', $_POST);

            redirect('/register');
        }
    }
}
