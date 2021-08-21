<?php

namespace App\Models;

use App\Connection;
use App\Paginator;

class UsersDevotionSaints
{
    private $id;
    private $user_id;
    private $saint_id;

    public static function countByUser($userId)
    {
        $pdo = Connection::make();

        $sql = '
        SELECT count(id) AS total
            FROM users_devotion_saints
        WHERE
            user_id = ?
        LIMIT 1';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);
        $data = $stmt->fetch();

        if (empty($data)) {
            return null;
        }

        return (int) $data['total'];
    }

    public static function countBySaint(mixed $saintId): ?int
    {
        $pdo = Connection::make();

        $sql = '
        SELECT count(id) AS total
            FROM users_devotion_saints
        WHERE
            saint_id = ?
        LIMIT 1';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$saintId]);
        $data = $stmt->fetch();

        if (empty($data)) {
            return null;
        }

        return (int) $data['total'];
    }

    public static function getByUserSaint($id): ?UsersDevotionSaints
    {
        $pdo = Connection::make();

        $stmt = $pdo->prepare(
            'SELECT * FROM users_devotion_saints WHERE user_id=? AND saint_id=?'
        );
        $stmt->execute([auth()->getId(), $id]);

        $userDevotedSaintData = $stmt->fetch();

        if (empty($userDevotedSaintData)) {
            return null;
        }

        $userDevotedSaint = new UsersDevotionSaints();
        $userDevotedSaint->setId($userDevotedSaintData['id']);
        $userDevotedSaint->setUserId($userDevotedSaintData['user_id']);
        $userDevotedSaint->setSaintId($userDevotedSaintData['saint_id']);

        return $userDevotedSaint;
    }

    public static function getUserDevotions($userId, $perPage = 10, $page = 1): Paginator
    {
        $pdo = Connection::make();

        $total = static::countByUser($userId);

        if ($total === 0) {
            return new Paginator($page, $perPage, $total, []);
        }

        $offset = $perPage * ($page - 1);

        $sql = "
            SELECT * FROM
                users_devotion_saints uds
            JOIN saints s
            ON s.id = uds.saint_id
            WHERE uds.user_id=?
            LIMIT {$offset}, {$perPage}";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);

        return new Paginator($page, $perPage, $total, $stmt->fetchAll());
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getSaintId()
    {
        return $this->saint_id;
    }

    public function setSaintId($saint_id)
    {
        $this->saint_id = $saint_id;
    }

    public function save()
    {
        $userDevotedSaint = [
            $this->user_id,
            $this->saint_id,
        ];

        $pdo = Connection::make();
        $stmt = $pdo->prepare(
            'INSERT INTO users_devotion_saints
            (user_id, saint_id)
            VALUES
            (?, ?)'
        );

        $result = $stmt->execute($userDevotedSaint);
        return $result;
    }

    public function delete()
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare(
            'DELETE FROM users_devotion_saints WHERE id=?'
        );

        $result = $stmt->execute([$this->id]);

        return $result;
    }
}
