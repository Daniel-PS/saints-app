<?php

namespace App\Models;

use App\Connection;
use App\Paginator;

class Comment
{
    private $id;
    private $user_id;
    private $saint_id;
    private $comment;
    private $approved;
    private $errors;

    public static function countByApproved(mixed $id): ?int
    {
        $pdo = Connection::make();

        $sql = '
        SELECT count(id) AS total
            FROM comments
        WHERE
            saint_id = ?
        AND
            approved = 1
        LIMIT 1';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if (empty($data)) {
            return null;
        }

        return (int) $data['total'];
    }

    public static function getByApproved($id, $perPage = 10, $page = 1): Paginator
    {
        $pdo = Connection::make();

        $total = static::countByApproved($id);

        if ($total === 0) {
            return new Paginator($page, $perPage, $total, []);
        }

        $offset = $perPage * ($page - 1);

        $sql = "
        SELECT u.name, u.photo, u.id AS user_id, c.*, uds.id AS devoted
            FROM comments c
        JOIN users u
        ON u.id = c.user_id
        LEFT OUTER JOIN users_devotion_saints uds
        ON uds.user_id = c.user_id AND uds.saint_id = c.saint_id
        WHERE
            c.saint_id = ?
        AND
            approved = 1
        LIMIT {$offset}, {$perPage}";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        return new Paginator($page, $perPage, $total, $stmt->fetchAll());
    }

    public static function getById($id): ?Comment
    {
        $pdo = Connection::make();

        $stmt = $pdo->prepare(
            'SELECT * FROM comments
            WHERE id=?'
        );
        $stmt->execute([$id]);

        $commentData = $stmt->fetch();

        if (empty($commentData)) {
            return null;
        }

        $comment = new Comment();
        $comment->setId($commentData['id']);
        $comment->setUserId($commentData['user_id']);
        $comment->setSaintId($commentData['saint_id']);
        $comment->setComment($commentData['comment']);
        $comment->setApproved($commentData['approved']);

        return $comment;
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

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
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

    public function hasValidData()
    {
        $this->errors = [];

        if (empty($this->comment)) {
            $this->errors['comment'] = 'Fill this field.';
        }

        return empty($this->errors);
    }

    public function save()
    {
        $comment = [
            $this->user_id,
            $this->saint_id,
            $this->comment,
            $this->approved
        ];

        $pdo = Connection::make();
        $stmt = $pdo->prepare(
            'INSERT INTO comments
            (user_id, saint_id, comment, approved)
            VALUES
            (?, ?, ?, ?)'
        );

        $result = $stmt->execute($comment);
        return $result;
    }

    public function update()
    {
        $updatedComment = [
            $this->comment,
            $this->approved,
            $this->id
        ];

        $pdo = Connection::make();
        $stmt = $pdo->prepare(
            'UPDATE comments
            SET comment=?, approved=?
            WHERE id=?'
        );

        $result = $stmt->execute($updatedComment);

        return $result;
    }

    public function delete()
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare(
            'DELETE FROM comments WHERE id=?'
        );

        $result = $stmt->execute([$this->id]);

        return $result;
    }
}
