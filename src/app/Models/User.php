<?php

namespace App\Models;

use App\Connection;
use App\Session;

class User
{
    private $id;
    private $typeId;
    private $photo;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $created_at;
    private $oldPhoto;
    private $errors;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    public function getTypeId()
    {
        return $this->typeId;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setOldPhoto($oldPhoto)
    {
        $this->oldPhoto = $oldPhoto;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasValidData()
    {
        $this->errors = [];

        if (empty($this->name)) {
            $this->errors['name'] = 'Fill this field.';
        }

        if (empty($this->surname)) {
            $this->errors['surname'] = 'Fill this field.';
        }

        if (empty($this->email)) {
            $this->errors['email'] = 'Fill this field.';
        }

        if (empty($this->password)) {
            $this->errors['password'] = 'Fill this field.';
        }

        return empty($this->errors);
    }

    public function hasValidEditedData()
    {
        $this->errors = [];

        if (empty($this->name)) {
            $this->errors['name'] = 'Fill this field.';
        }

        if (empty($this->surname)) {
            $this->errors['surname'] = 'Fill this field.';
        }

        if (empty($this->email)) {
            $this->errors['email'] = 'Fill this field.';
        }

        return empty($this->errors);
    }

    public static function getById(int $id): ?User
    {
        $pdo = Connection::make();

        $stmt = $pdo->prepare('SELECT * FROM users WHERE id=?');
        $stmt->execute([$id]);
        $userData = $stmt->fetch();

        if (empty($userData)) {
            return null;
        }

        $user = new User();
        $user->setId($userData['id']);
        $user->setTypeId($userData['user_type_id']);
        $user->setPhoto($userData['photo']);
        $user->setName($userData['name']);
        $user->setSurname($userData['surname']);
        $user->setEmail($userData['email']);
        $user->setPassword($userData['password']);
        $user->setCreatedAt($userData['created_at']);

        return $user;
    }

    public static function getByEmail(string $email): ?User
    {
        $pdo = Connection::make();

        $stmt = $pdo->prepare('SELECT * FROM users WHERE email=?');
        $stmt->execute([$email]);
        $userData = $stmt->fetch();

        if (empty($userData)) {
            return null;
        }

        $user = new User();
        $user->setId($userData['id']);
        $user->setTypeId($userData['user_type_id']);
        $user->setPhoto($userData['photo']);
        $user->setName($userData['name']);
        $user->setSurname($userData['surname']);
        $user->setEmail($userData['email']);
        $user->setPassword($userData['password']);
        $user->setCreatedAt($userData['created_at']);

        return $user;
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        $user = [
            $this->photo,
            $this->name,
            $this->surname,
            $this->email,
            $this->password
        ];

        $pdo = Connection::make();
        $stmt = $pdo->prepare('INSERT INTO users (photo, name, surname, email, password) VALUES (?, ?, ?, ?, ?)');
        $result = $stmt->execute($user);

        handleUploadedFile('photo');

        return $result;
    }

    public function update()
    {
        $this->handlePostData();

        $updatedUser = [
            $this->photo,
            $this->name,
            $this->surname,
            $this->email,
            $this->password,
            $this->id
        ];

        $pdo = Connection::make();
        $stmt = $pdo->prepare('UPDATE users SET photo=?, name=?, surname=?, email=?, password=? WHERE id=?');
        $result = $stmt->execute($updatedUser);

        if ($result && $_FILES['photo']['name']) {
            handleUploadedFile('photo', $this->oldPhoto);
        }

        return $result;
    }

    public function delete()
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare(
            'DELETE FROM users WHERE id=?'
        );

        $result = $stmt->execute([$this->id]);

        return $result;
    }

    private function handlePostData()
    {
        if (auth()->getId() != $this->id) {
            redirectWithMessage('/users/' . $this->id, 'You dont have permission to edit this comment.');
        }

        if ($_FILES['photo']['name']) {
            $this->oldPhoto = $this->photo;
            $this->photo = $_FILES['photo']['name'];
        }

        if ($_POST['name']) {
            $this->name = $_POST['name'];
        }

        if ($_POST['surname']) {
            $this->surname = $_POST['surname'];
        }

        if ($_POST['email']) {
            $this->email = $_POST['email'];
        }

        if ($_POST['password']) {
            if ($_POST['password'] !== $_POST['confirm_password']) {
                Session::set('errors', [
                    'password' => 'Passwords does not match',
                    'confirm_password' => 'Passwords does not match',
                ]);
                Session::set('old_input', $_POST);

                redirect('/users/' . $this->id);
                exit();
            }

            $this->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }
    }

    public function login()
    {
        Session::set('user', $this);
    }
}
