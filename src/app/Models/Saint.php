<?php

namespace App\Models;

use DateTime;
use App\Connection;
use App\Paginator;
use App\Models\UserType;

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
    private $approved;
    private $errors;
    private $created_at;

    private $oldPhoto;

    public const NOT_APPROVED = 0;
    public const APPROVED = 1;

    public static function countByApproval($approved)
    {
        $pdo = Connection::make();

        $sql = '
        SELECT count(id) AS total
            FROM saints
        WHERE
            approved = ?
        LIMIT 1';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$approved]);
        $data = $stmt->fetch();

        if (empty($data)) {
            return null;
        }

        return (int) $data['total'];
    }

    public static function countByUserApproved($userId, $approved)
    {
        $pdo = Connection::make();

        $sql = '
        SELECT count(id) AS total
            FROM saints
        WHERE
            user_id = ?
        AND
            approved = ?
        LIMIT 1';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId, $approved]);
        $data = $stmt->fetch();

        if (empty($data)) {
            return null;
        }

        return (int) $data['total'];
    }

    public static function getByApproval($approved, $perPage = 10, $page = 1): Paginator
    {
        $pdo = Connection::make();

        $total = static::countByApproval($approved);

        if ($total === 0) {
            return new Paginator($page, $perPage, $total, []);
        }

        $offset = $perPage * ($page - 1);

        $sql = "
        SELECT s.*, u.name AS user_name, count(uds.id) as totalDevotions
            FROM saints s
        LEFT OUTER JOIN users u
            ON u.id = s.user_id
        LEFT OUTER JOIN users_devotion_saints uds
            ON uds.saint_id = s.id
        WHERE
            approved = ?
        GROUP BY (s.id)
        LIMIT {$offset}, {$perPage}";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$approved]);

        return new Paginator($page, $perPage, $total, $stmt->fetchAll());
    }

    public static function getByUserApproved($userId, $approved = 1, $perPage = 10, $page = 1): Paginator
    {
        $pdo = Connection::make();

        $total = static::countByUserApproved($userId, $approved);

        if ($total === 0) {
            return new Paginator($page, $perPage, $total, []);
        }

        $offset = $perPage * ($page - 1);

        $sql = "SELECT * FROM saints WHERE user_id=? AND approved=? LIMIT {$offset}, {$perPage}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId, $approved]);

        return new Paginator($page, $perPage, $total, $stmt->fetchAll());
    }

    public static function getById($id): ?Saint
    {
        $pdo = Connection::make();

        $stmt = $pdo->prepare(
            'SELECT s.*, u.name as user_name FROM saints s
            LEFT OUTER JOIN users u
            ON u.id = s.user_id
            WHERE s.id=?'
        );
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
        $saint->user_name = $saintData['user_name'];

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

    public function setOldPhoto($oldPhoto)
    {
        $this->oldPhoto = $oldPhoto;
    }

    public function hasValidData()
    {
        $this->errors = [];

        if (empty($this->photo)) {
            $this->errors['photo'] = 'Fill this field';
        }

        if (empty($this->name)) {
            $this->errors['name'] = 'Fill this field';
        }

        if (! empty($this->birthdate)) {
            if (substr_count($this->birthdate, '/') === 1) {
                $this->birthdate = $this->birthdate . '/0000';
            }

            $birthdayDate = DateTime::createFromFormat('d/m/Y', $this->birthdate);

            if (! $birthdayDate) {
                $this->errors['birthdate'] = 'Invalid date';
            } else {
                $this->birthdate = $birthdayDate->format('Y-m-d');
            }
        }

        if (! empty($this->feast_date)) {
            if (substr_count($this->feast_date, '/') === 1) {
                $this->feast_date = $this->feast_date . '/0000';
            }

            $feastDate = DateTime::createFromFormat('d/m/Y', $this->feast_date);

            if (! $feastDate) {
                $this->errors['feast_date'] = 'Invalid date';
            } else {
                $this->feast_date = $feastDate->format('Y-m-d');
            }
        }

        if (empty($this->phrase)) {
            $this->errors['phrase'] = 'Fill this field';
        }

        if (empty($this->bio)) {
            $this->errors['bio'] = 'Fill this field';
        }

        if (empty($this->prayer)) {
            $this->errors['prayer'] = 'Fill this field';
        }

        return empty($this->errors);
    }

    public function hasValidEditData()
    {
        $this->errors = [];

        if (empty($this->name)) {
            $this->errors['name'] = 'Fill this field';
        }

        if (! empty($this->birthdate)) {
            if (substr_count($this->birthdate, '/') === 1) {
                $this->birthdate = $this->birthdate . '/0000';
            }

            $birthdayDate = DateTime::createFromFormat('d/m/Y', $this->birthdate);

            if (! $birthdayDate) {
                $this->errors['birthdate'] = 'Invalid date';
            } else {
                $this->birthdate = $birthdayDate->format('Y-m-d');
            }
        }

        if (! empty($this->feast_date)) {
            if (substr_count($this->feast_date, '/') === 1) {
                $this->feast_date = $this->feast_date . '/0000';
            }

            $feastDate = DateTime::createFromFormat('d/m/Y', $this->feast_date);

            if (! $feastDate) {
                $this->errors['feast_date'] = 'Invalid date';
            } else {
                $this->feast_date = $feastDate->format('Y-m-d');
            }
        }

        if (empty($this->phrase)) {
            $this->errors['phrase'] = 'Fill this field';
        }

        if (empty($this->bio)) {
            $this->errors['bio'] = 'Fill this field';
        }

        if (empty($this->prayer)) {
            $this->errors['prayer'] = 'Fill this field';
        }

        return empty($this->errors);
    }

    public function save()
    {
        $this->birthdate = $this->birthdate ? $this->birthdate : null;
        $this->feast_date = $this->feast_date ? $this->feast_date : null;

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
            $this->approved,
            $this->user_id,
        ];

        $pdo = Connection::make();
        $stmt = $pdo->prepare(
            'INSERT INTO saints
            (photo, name, baptism_name, birthdate, feast_date, nation, city, phrase, bio, prayer, approved, user_id)
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );

        $result = $stmt->execute($saint);

        if ($result) {
            handleUploadedFile('photo');
        }

        return $result;
    }

    public function update()
    {
        $this->birthdate = $this->birthdate ? $this->birthdate : null;
        $this->feast_date = $this->feast_date ? $this->feast_date : null;

        $updatedSaint = [
            $this->user_id,
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
            $this->approved,
            $this->id
        ];

        $pdo = Connection::make();
        $stmt = $pdo->prepare(
            'UPDATE saints
            SET
                user_id=?,
                photo=?,
                name=?,
                baptism_name=?,
                birthdate=?,
                feast_date=?,
                nation=?,
                city=?,
                phrase=?,
                bio=?,
                prayer=?,
                approved=?
            WHERE id=?'
        );

        $result = $stmt->execute($updatedSaint);

        if ($result && $_FILES['photo']['name']) {
            handleUploadedFile('photo', $this->oldPhoto);
        }

        return $result;
    }

    public function delete()
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('DELETE FROM saints WHERE id=?');
        $result = $stmt->execute([$this->id]);

        if ($result) {
            deletePhoto($this->photo);
        }
    }

    public function approve()
    {
        $this->approved = 1;
        $this->update();
    }

    public function removeAuthorship()
    {
        $this->user_id = null;

        $updatedSaint = [
            $this->user_id,
            $this->id
        ];

        $pdo = Connection::make();
        $stmt = $pdo->prepare(
            'UPDATE saints
            SET
                user_id=?
            WHERE id=?'
        );

        return $stmt->execute($updatedSaint);
    }
}
