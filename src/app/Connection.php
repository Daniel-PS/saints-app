<?php

namespace App;

use PDO;

class Connection
{
    public static function make(): PDO
    {
        $dbHost = getenv('DB_HOST');
        $dbName = getenv('DB_DATABASE');
        $dbUser = getenv('DB_USERNAME');
        $dbPassword = getenv('DB_PASSWORD');

        return new PDO("mysql:host=$dbHost;port=3306;dbname=$dbName", $dbUser, $dbPassword);
    }
}

