<?php

namespace App\Controllers;

use App\Session;
use App\Models\Comment;
use App\Models\Saint;

class CommentsController
{
    public function create()
    {
        if (! auth()) {
            redirect('/');
        }

        $saintId = preg_replace('/[^0-9]/', '', $_SERVER['REQUEST_URI']);
        $saint = Saint::getById($saintId);

        if (! $saint) {
            redirectWithMessage('/', 'Saint does not exist');
        }

        if (! $saint->getApproved()) {
            redirectWithMessage('/saints/' . $saint->getId(), 'Saint is not approved yet');
        }

        $errors = Session::get('errors');
        Session::clear('errors');

        view('saints/comments/create.php', [
            'saint' => $saint,
            'errors' => $errors
        ]);
    }

    public function store()
    {
        $saintId = preg_replace('/[^0-9]/', '', $_SERVER['REQUEST_URI']);

        $comment = new Comment();
        $comment->setUserId(auth()->getId());
        $comment->setSaintId($saintId);
        $comment->setComment($_POST['comment']);
        $comment->setApproved(auth()->getTypeId() == 1 ? 1 : 0);

        if (! $comment->hasValidData()) {
            $errors = $comment->getErrors();

            Session::set('errors', $errors);
            Session::set('old_input', $_POST);

            redirect('/saints/' . $saintId . '/comments/create');
        }

        $comment->save();

        redirectWithMessage('/saints/' . $saintId, 'Comment Registered Successfully! Please wait for approval');
    }

    public function edit()
    {
        if (! auth()) {
            redirect('/');
        }

        preg_match_all('!\d+!', $_SERVER['REQUEST_URI'], $matches);
        list($saintId, $commentId) = $matches[0];

        $saint = Saint::getById($saintId);
        $comment = Comment::getById($commentId);

        if (! $comment) {
            redirectWithMessage('/saints/' . $saintId, 'Comment does not exist');
        }

        if (auth()->getId() != $comment->getUserId()) {
            redirectWithMessage('/saints/' . $saintId, 'You dont have permission to edit this comment.');
        }

        if (! $saint || ! $comment) {
            redirect('/');
        }

        $errors = Session::get('errors');
        Session::clear('errors');

        view('saints/comments/edit.php', [
            'saint' => $saint,
            'comment' => $comment,
            'errors' => $errors
        ]);
    }

    public function update()
    {
        if (! auth()) {
            redirect('/');
        }

        preg_match_all('!\d+!', $_SERVER['REQUEST_URI'], $matches);
        list($saintId, $commentId) = $matches[0];

        $comment = Comment::getById($commentId);

        if (! $comment) {
            redirectWithMessage('/saints/' . $saintId, 'Comment does not exist');
        }

        if (auth()->getId() != $comment->getUserId()) {
            redirectWithMessage('/saints/' . $saintId, 'You dont have permission to edit this comment.');
        }

        $editedComment = json_decode(file_get_contents('php://input'))->comment;
        $comment->setComment($editedComment);
        $comment->setApproved(auth()->getTypeId() == 1 ? 1 : 0);

        if (! $comment->hasValidData()) {
            $errors = $comment->getErrors();

            Session::set('errors', $errors);
            Session::set('old_input', $_POST);

            redirect('/saints/' . $saintId . '/comments/' . $commentId . '/edit');
        }

        $comment->update();

        Session::set('message', 'Comment edited successfully! Please, wait for approval');
    }

    public function destroy()
    {
        preg_match_all('!\d+!', $_SERVER['REQUEST_URI'], $matches);
        $commentId = $matches[0][1];

        $comment = Comment::getById($commentId);
        $comment->delete();

        Session::set('message', 'Comment deleted successfully');
    }
}
