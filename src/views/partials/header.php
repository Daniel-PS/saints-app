<?php
    use App\Session;
    $user = Session::get('user');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/fontawesome.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="<?= BASE_URL ?>js/main.js"></script>
    <script defer src="<?= BASE_URL ?>js/jquery.mask.min.js"></script>
    <title>Saints</title>
</head>
<body>
    <nav class="py-3 navbar navbar-expand-lg fixed-top auto-hiding-navbar">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>">
                <img src="<?= BASE_URL ?>images/logo.png" class="logo" alt="logo">
                Saints
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>saints">Saints</a>
                    </li>
                    <?php if (! $user) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>register">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>login">Login</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($user) : ?>
                        <?php if ($user->getTypeId() == 1) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>approval/saints">Approve Saints</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>approval/comments">Approve Comments</a>
                            </li>
                        <?php endif; ?>
                        <div class="profile-details">
                            <?php if ($user->getPhoto()) : ?>
                                <img src="<?= BASE_URL ?>images/user_uploads/<?= h($user->getPhoto()) ?>" class="logged-user-photo" alt="user_photo">
                            <?php else : ?>
                                <img src="<?= BASE_URL ?>images/no_photo.jpg" class="logged-user-photo" alt="user_photo">
                            <?php endif; ?>
                            <span class="admin_name">
                                Hail Mary,
                                <a href="<?= BASE_URL . 'users/' . h($user->getId()) ?>" style="text-decoration: none;">
                                    <?= h($user->getName()) ?>!
                                </a>
                            </span>
                            <a href="<?= BASE_URL ?>logout" style="text-decoration: none; color: #2f404e; margin-top: 32px; margin-left: -130px; font-size: 10pt;">Logout</a>
                        </div>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
