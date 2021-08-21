<?php

namespace App\Controllers;

use App\Models\Saint;
use App\Models\Comment;

class ApprovalController
{
    public function saints()
    {
        if (! auth()) {
            redirect('/');
        }

        if (auth()->getTypeId() != 1) {
            redirect('/');
        }

        $page = ! empty($_GET['page']) ? ((int) $_GET['page']) : 1;
        $perPage = 10;

        $saintsPaginator = Saint::getByApproval(0, $perPage, $page);

        return view('approval/saints.php', [
            'saintsPaginator' => $saintsPaginator,
            'page' => $page
        ]);
    }

    public function comments()
    {
        if (! auth()) {
            redirect('/');
        }

        if (auth()->getTypeId() != 1) {
            redirect('/');
        }

        $page = ! empty($_GET['page']) ? ((int) $_GET['page']) : 1;
        $perPage = 10;

        $commentsPaginator = Comment::getByApproval(0, $perPage, $page);

        return view('approval/comments.php', [
            'commentsPaginator' => $commentsPaginator,
            'page' => $page
        ]);
    }

    public function approveSaint()
    {
        if (! auth()) {
            redirect('/');
        }

        if (auth()->getTypeId() != 1) {
            redirect('/');
        }

        $id = json_decode(file_get_contents('php://input'))->id;

        $saint = Saint::getById($id);

        if (! $saint) {
            redirectWithMessage('/approval/saints', 'Saint does not exist');
        }

        $saint->approve();
    }

    public function removeSaint()
    {
        if (! auth()) {
            redirect('/');
        }

        if (auth()->getTypeId() != 1) {
            redirect('/');
        }

        $id = json_decode(file_get_contents('php://input'))->id;

        $saint = Saint::getById($id);

        if (! $saint) {
            redirectWithMessage('/approval/comments', 'Saint does not exist');
        }

        $saint->delete();
    }

    public function approveComment()
    {
        if (! auth()) {
            redirect('/');
        }

        if (auth()->getTypeId() != 1) {
            redirect('/');
        }

        $id = json_decode(file_get_contents('php://input'))->id;

        $comment = Comment::getById($id);

        if (! $comment) {
            redirectWithMessage('/approval/comments', 'Comment does not exist');
        }

        $comment->approve();
    }

    public function removeComment()
    {
        if (! auth()) {
            redirect('/');
        }

        if (auth()->getTypeId() != 1) {
            redirect('/');
        }

        $id = json_decode(file_get_contents('php://input'))->id;

        $comment = Comment::getById($id);

        if (! $comment) {
            redirectWithMessage('/approval/comments', 'Comment does not exist');
        }

        $comment->delete();
    }
}
