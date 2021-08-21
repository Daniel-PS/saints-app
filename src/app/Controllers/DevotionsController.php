<?php

namespace App\Controllers;

use App\Session;
use App\Models\UsersDevotionSaints;

class DevotionsController
{
    public function store()
    {
        if (! auth()) {
            redirect('/');
        }

        $userDevotionSaint = UsersDevotionSaints::getByUserSaint($_POST['id']);

        if ($userDevotionSaint) {
            $this->destroy($userDevotionSaint);
            return;
        }

        $userDevotionSaint = new UsersDevotionSaints();
        $userDevotionSaint->setUserId(auth()->getId());
        $userDevotionSaint->setSaintId($_POST['id']);

        $userDevotionSaint->save();

        Session::set('message', 'Devotion added successfully!');
    }

    private function destroy(UsersDevotionSaints $userDevotionSaint)
    {
        $userDevotionSaint->delete();
        Session::set('message', 'Devotion removed successfully');
    }
}
