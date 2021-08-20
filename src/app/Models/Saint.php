<?php

namespace App\Models;

use DateTime;
use App\Connection;
use App\Paginator;

class Saint
{
    private $id;
    private $user_id;
    private $photo;
    private $name;
    private $baptism_name;
    private $birthdate;
    private $feast_date;
    private $nation;
    private $city;
    private $bio;
    private $prayer;
    private $errors;
    private $created_at;

    private $old_photo;

    public static function countByApproved($approved)
    {
        $pdo = Connection::make();

        $sql = '
        SELECT count(id) AS total
            FROM saints
        LIMIT 1';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$approved]);
        $data = $stmt->fetch();

        if (empty($data)) {
            return null;
        }

        return (int) $data['total'];
    }

    public static function getByApproved($approved, $perPage = 10, $page = 1): Paginator
    {
        $pdo = Connection::make();

        $total = static::countByApproved($approved);

        if ($total === 0) {
            return new Paginator($page, $perPage, $total, []);
        }

        $offset = $perPage * ($page - 1);

        $sql = "
        SELECT *
            FROM saints
        WHERE
            approved = ?
        LIMIT {$offset}, {$perPage}";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$approved]);

        return new Paginator($page, $perPage, $total, $stmt->fetchAll());
    }

    public static function getByUser($user_id)
    {
        $pdo = Connection::make();
        $sql = "SELECT * FROM saints WHERE user_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public static function getById($id): ?Saint
    {
        $pdo = Connection::make();

        $stmt = $pdo->prepare('SELECT * FROM saints WHERE id=?');
        $stmt->execute([$id]);

        $saintData = $stmt->fetch();

        if (empty($saintData)) {
            return null;
        }

        $saint = new Saint();
        $saint->setId($saintData['id']);
        $saint->setUserId($saintData['user_id']);
        $saint->setPhoto($saintData['photo']);
        $saint->setName($saintData['name']);
        $saint->setBaptismName($saintData['baptism_name']);
        $saint->setBirthdate($saintData['birthdate']);
        $saint->setFeastDate($saintData['feast_date']);
        $saint->setNation($saintData['nation']);
        $saint->setCity($saintData['city']);
        $saint->setPhrase($saintData['phrase']);
        $saint->setBio($saintData['bio']);
        $saint->setPrayer($saintData['prayer']);
        $saint->setApproved($saintData['approved']);
        $saint->setCreatedAt($saintData['created_at']);

        return $saint;
    }

    public static function getByUserId($id): array
    {
        $pdo = Connection::make();

        $stmt = $pdo->prepare('SELECT * FROM saints WHERE user_id=?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getBaptismName()
    {
        return $this->baptism_name;
    }

    public function setBaptismName($baptism_name)
    {
        $this->baptism_name = $baptism_name;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getFeastDate()
    {
        return $this->feast_date;
    }

    public function setFeastDate($feast_date)
    {
        $this->feast_date = $feast_date;
    }

    public function getNation()
    {
        return $this->nation;
    }

    public function setNation($nation)
    {
        $this->nation = $nation;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getPhrase()
    {
        return $this->phrase;
    }

    public function setPhrase($phrase)
    {
        $this->phrase = $phrase;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    public function getPrayer()
    {
        return $this->prayer;
    }

    public function setPrayer($prayer)
    {
        $this->prayer = $prayer;
    }

    public function getApproved()
    {
        return $this->approved;
    }

    public function setApproved($approved)
    {
        $this->approved = $approved;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setOldPhoto($old_photo)
    {
        $this->old_photo = $old_photo;
    }

    public function hasValidData()
    {
        $this->errors = [];

        if (empty($this->photo)) {
            $this->errors['photo'] = 'Preencha este campo.';
        }

        if (empty($this->name)) {
            $this->errors['name'] = 'Preencha este campo.';
        }

        if (empty($this->baptism_name)) {
            $this->errors['baptism_name'] = 'Preencha este campo.';
        }

        if (empty($this->nation)) {
            $this->errors['nation'] = 'Preencha este campo.';
        }

        if (empty($this->city)) {
            $this->errors['city'] = 'Preencha este campo.';
        }

        if (empty($this->birthdate)) {
            $this->errors['birthdate'] = 'Preencha este campo.';
        } else {
            $birthdayDate = DateTime::createFromFormat('d/m/Y', $this->birthdate);
            $this->birthdate = $birthdayDate->format('Y-m-d');

            if ($birthdayDate === false) {
                $this->errors['birthdate'] = 'Data inválida';
            }
        }

        if (empty($this->feast_date)) {
            $this->errors['feast_date'] = 'Preencha este campo.';
        } else {
            $birthdayDate = DateTime::createFromFormat('d/m/Y', $this->feast_date);
            $this->feast_date = $birthdayDate->format('Y-m-d');

            if ($birthdayDate === false) {
                $this->errors['feast_date'] = 'Data inválida';
            }
        }

        if (empty($this->phrase)) {
            $this->errors['phrase'] = 'Preencha este campo';
        }

        if (empty($this->bio)) {
            $this->errors['bio'] = 'Preencha este campo';
        }

        if (empty($this->prayer)) {
            $this->errors['prayer'] = 'Preencha este campo';
        }

        return empty($this->errors);
    }

    public function save()
    {
        $user = auth();

        $saint = [
            $this->photo,
            $this->name,
            $this->baptism_name,
            $this->birthdate,
            $this->feast_date,
            $this->nation,
            $this->city,
            $this->phrase,
            $this->bio,
            $this->prayer,
            $user->getId(),
        ];

        $pdo = Connection::make();
        $stmt = $pdo->prepare(
            'INSERT INTO saints
            (photo, name, baptism_name, birthdate, feast_date, nation, city, phrase, bio, prayer, user_id)
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );

        $result = $stmt->execute($saint);

        if ($result) {
            handleUploadedFile('photo');
        }

        return $result;
    }

    public function saveUpdate()
    {
        $updatedSaint = [
            $this->photo,
            $this->name,
            $this->baptism_name,
            $this->birthdate,
            $this->feast_date,
            $this->nation,
            $this->city,
            $this->phrase,
            $this->bio,
            $this->prayer,
            $this->id
        ];

        $pdo = Connection::make();
        $stmt = $pdo->prepare(
            'UPDATE saints
            SET photo=?, name=?, baptism_name=?, birthdate=?, feast_date=?, nation=?, city=?, bio=?, prayer=?
            WHERE id=?'
        );

        $result = $stmt->execute($updatedSaint);

        if ($result) {
            handleUploadedFile('photo', $this->old_photo);
        }
        return $result;
    }

    public static function delete($id)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('SELECT photo FROM saints WHERE id=?');
        $stmt->execute([$id]);
        $photo = $stmt->fetch();

        $stmt = $pdo->prepare('DELETE FROM saints WHERE id=?');
        $result = $stmt->execute([$id]);

        if ($result) {
            deletePhoto($photo);
        }
    }
}
