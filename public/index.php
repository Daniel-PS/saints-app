<?php

use App\User;
use App\Connection;

require_once '../src/autoload.php';
require_once '../src/functions.php';

$user = new User('Daniel');
var_dump($user->getName());

$search = 'a';
$search = "%{$search}%";

try {
    $dbh = Connection::make();

    $stmt = $dbh->prepare('SELECT * FROM users WHERE name LIKE ?');
    $stmt->execute([ $search ]);

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<pre>';
    foreach ($users as $user) {
        var_dump($user);
    }
    echo '</pre>';
} catch (\Throwable $t) {
    var_dump($t);
}
