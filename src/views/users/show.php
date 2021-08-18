<?php
    view('partials/header.php');
?>

<br><br><br><br>
<?php if ($user->getPhoto()) : ?>
    <img src="<?= BASE_URL ?>images/user_uploads/<?= $user->getPhoto() ?>" class="logged-user-photo" alt="user_photo">
<?php endif; ?>
<h1><?= $user->getName() ?></h1>
<h1><?= $user->getSurname() ?></h1>
<h1><?= $user->getEmail() ?></h1>

<?php
    view('partials/footer.php');
?>