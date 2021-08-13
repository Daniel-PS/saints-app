<?php

namespace App;

use PDO;

class Connection
{
    public static function make()
    {
        return new PDO('mysql:host=saints-mysql;dbname=saints_db', 'saints_user', 'secret');
    }
}
