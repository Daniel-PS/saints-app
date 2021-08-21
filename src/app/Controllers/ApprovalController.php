<?php

namespace App\Controllers;

use App\Session;
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

        $message = Session::get('message');
        Session::clear('message');

        return view('approval/saints.php', [
            'saintsPaginator' => $saintsPaginator,
            'message' => $message,
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

        $message = Session::get('message');
        Session::clear('message');

        return view('approval/comments.php', [
            'commentsPaginator' => $commentsPaginator,
            'message' => $message,
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
        Session::set('message', 'Saint approved successfully!');
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
        Session::set('message', 'Saint removed successfully!');
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
        Session::set('message', 'Comment approved successfully!');
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
        Session::set('message', 'Comment removed successfully!');
    }
}
