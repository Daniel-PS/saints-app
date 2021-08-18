<?php

namespace App\Controllers;

use App\Session;
use App\Models\User;

class AuthController
{
    public function register()
    {
        if (Session::get('user')) {
            redirect('/');
        }

        view('auth/register.php');
    }

    public function login()
    {
        if (Session::get('user')) {
            redirect('/');
        }

        $errors = Session::get('errors');
        Session::clear('errors');

        view('auth/login.php',  [
            'errors' => $errors,
        ]);
    }

    public function authenticate()
    {
        if (Session::get('user')) {
            redirect('/');
        }

        $user = User::getByEmail($_POST['email']);

        if (! $user) {
            $this->handleInvalidLogin();
        }

        if (! password_verify($_POST['password'], $user->getPassword())) {
            $this->handleInvalidLogin();
        }

        Session::set('user', $user);
        Session::set('message', 'Wellcome back, ' . $user->getName() . '!');

        redirect('/');
    }

    public function doRegister()
    {
        $request = $_POST;
        $photo = $_FILES['photo'];
        $photo['name'] = $this->generateUniqueName($photo['name']);

        $this->checkPassword($request);

        $user = new User();
        $user->setPhoto($photo['name']);
        $user->setName($request['name']);
        $user->setSurname($request['surname']);
        $user->setEmail($request['email']);
        $user->setPassword($request['password']);

        if (! $user->hasValidData()) {
            $errors = $user->getErrors();

            Session::set('errors', $errors);
            Session::set('old_input', $request);

            redirect('register');
            return;
        }

        $user->save();

        handleUploadedFile('photo');

        $user = User::getByEmail($user->getEmail());
        Session::set('user', $user);

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
            'login' => 'Dados inválidos'
        ]);

        redirect('login');
    }

    private function checkPassword(array $request): void
    {
        if ($request['password'] !== $request['confirm_password']) {
            $errors = [];
            $errors['confirm_password'] = 'Passwords does not match.';
            $errors['password'] = 'Passwords does not match.';

            Session::set('errors', $errors);
            redirect('register');
        }
    }

    private function generateUniqueName(string $name): string
    {
        return uniqid() . '_' . $name;
    }
}
