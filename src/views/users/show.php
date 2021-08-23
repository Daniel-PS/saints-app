<?php
    view('partials/header.php');
?>
<?php if (isset($message)) : ?>
    <div id="hideMe" class="message" style="margin-top: 100px;">
        <p class="message-text"><?= $message ?></p>
    </div>
<?php endif; ?>
<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-lg-3 col-sm-6" style="width: 100%;">
            <div class="card hovercard" style="border: none;">
                <div class="cardheader">
                </div>
                <div class="avatar">
                    <?php if ($user->getPhoto()) : ?>
                        <img alt="" src="<?= BASE_URL ?>images/user_uploads/<?= $user->getPhoto() ?>" style="object-fit: cover;">
                    <?php else : ?>
                        <img src="<?= BASE_URL ?>images/no_photo.jpg" style="object-fit: cover;">
                    <?php endif; ?>
                </div>
                <div class="info">
                    <div class="title">
                        <a><?= $user->getName() ?> <?= $user->getSurname() ?></a>
                    </div>
                    <div class="desc"><?= $user->getEmail() ?></div>
                    <div class="desc">Joined in <?= dateFormat($user->getCreatedAt(), true) ?></div>
                </div>
                <div id="hero">
                    <?php if (! empty($devotionsPaginator->getItems())) : ?>
                        <section id="hero" style="padding-bottom: 0;">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <h1 style="font-size: 18pt; text-transform: none; text-align: center;"><?= $user->getName() ?>'s Saints of Devotion</h1>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="row cards">
                            <?php foreach ($devotionsPaginator->getItems() as $saint) : ?>
                                <div class="col-md-4 d-flex justify-content-center">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                            <img src="<?= BASE_URL ?>images/user_uploads/<?= h($saint['photo']) ?>" alt="service" class="icon">
                                            <h5 class="card-title">
                                                <a href="<?= BASE_URL ?>saints/<?= h($saint['id']) ?>"><?= h($saint['name']) ?></a>
                                            </h5>
                                            <p class="card-text" style="font-style: italic;">
                                                <?= h($saint['phrase']) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <section id="hero" style="padding-bottom: 0;">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <h1 style="font-size: 18pt; text-transform: none; text-align: center;"><?= $user->getName() ?> doesn't have any Saints of devotion yet</h1>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>
                </div>
                <nav>
                    <ul class="pagination" style="place-content: center;">
                        <?php if ($devotionPage > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL . 'users/' . $user->getId() . '' ?>">
                                    First
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL . 'users/' . $user->getId() . '?devotionPage=' . ($devotionPage - 1) ?>">
                                    Previous
                                </a>
                            </li>
                        <?php endif ?>
                        <?php if ($devotionPage < $devotionsPaginator->getLastPage()) : ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL . 'users/' . $user->getId() . '?devotionPage=' . ($devotionPage + 1) ?>">
                                    Next
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL . 'users/' . $user->getId() . '?devotionPage=' . $devotionsPaginator->getLastPage() ?>">
                                    Last
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </nav>
                <div id="hero">
                    <?php if (! empty($registeredSaintsPaginator->getItems())) : ?>
                        <section id="hero" style="padding-bottom: 0;">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <h1 style="font-size: 18pt; text-transform: none; text-align: center;"><?= $user->getName() ?>'s registered Saints</h1>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="row cards">
                            <?php foreach ($registeredSaintsPaginator->getItems() as $saint) : ?>
                                <div class="col-md-4 d-flex justify-content-center">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                            <img src="<?= BASE_URL ?>images/user_uploads/<?= h($saint['photo']) ?>" alt="service" class="icon">
                                            <h5 class="card-title">
                                                <a href="<?= BASE_URL ?>saints/<?= h($saint['id']) ?>"><?= h($saint['name']) ?></a>
                                            </h5>
                                            <p class="card-text" style="font-style: italic;">
                                                <?= h($saint['phrase']) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <section id="hero" style="padding-bottom: 0;">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <h1 style="font-size: 18pt; text-transform: none; text-align: center;"><?= $user->getName() ?> didn't register any Saints yet</h1>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>
                </div>
                <nav>
                    <ul class="pagination" style="place-content: center;">
                        <?php if ($registeredPage > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL . 'users/' . $user->getId() . '' ?>">
                                    First
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL . 'users/' . $user->getId() . '?registeredPage=' . ($registeredPage - 1) ?>">
                                    Previous
                                </a>
                            </li>
                        <?php endif ?>
                        <?php if ($registeredPage < $registeredSaintsPaginator->getLastPage()) : ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL . 'users/' . $user->getId() . '?registeredPage=' . ($registeredPage + 1) ?>">
                                    Next
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL . 'users/' . $user->getId() . '?registeredPage=' . $registeredSaintsPaginator->getLastPage() ?>">
                                    Last
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </nav>
                <div id="hero">
                    <?php if (auth()->getId() === $user->getId()) : ?>
                        <?php if (! empty($approvalSaintsPaginator->getItems())) : ?>
                            <section id="hero" style="padding-bottom: 0;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <h1 style="font-size: 18pt; text-transform: none; text-align: center;">Saints you registered waiting for approval (this is only visible to you)</h1>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="row cards">
                                <?php foreach ($approvalSaintsPaginator->getItems() as $saint) : ?>
                                    <div class="col-md-4 d-flex justify-content-center">
                                        <div class="card" style="width: 18rem;">
                                            <div class="card-body">
                                                <img src="<?= BASE_URL ?>images/user_uploads/<?= h($saint['photo']) ?>" alt="service" class="icon">
                                                <h5 class="card-title">
                                                    <a href="<?= BASE_URL ?>saints/<?= h($saint['id']) ?>"><?= h($saint['name']) ?></a>
                                                </h5>
                                                <p class="card-text" style="font-style: italic;">
                                                    <?= h($saint['phrase']) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <section id="hero" style="padding-bottom: 0;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <h1 style="font-size: 18pt; text-transform: none; text-align: center;">None of the Saints you registered are needing approval (this is only visible to you)</h1>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <nav>
                    <ul class="pagination" style="place-content: center;">
                        <?php if ($approvalPage > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL . 'users/' . $user->getId() . '' ?>">
                                    First
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL . 'users/' . $user->getId() . '?approvalPage=' . ($approvalPage - 1) ?>">
                                    Previous
                                </a>
                            </li>
                        <?php endif ?>
                        <?php if ($approvalPage < $approvalSaintsPaginator->getLastPage()) : ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL . 'users/' . $user->getId() . '?approvalPage=' . ($approvalPage + 1) ?>">
                                    Next
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL . 'users/' . $user->getId() . '?approvalPage=' . $approvalSaintsPaginator->getLastPage() ?>">
                                    Last
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </nav>
                <?php if (auth()) : ?>
                    <?php if (auth()->getId() === $user->getId()) : ?>
                        <div class="fab-container" style="right: 130px;">
                            <div class="fab fab-icon-holder"><i class="fas fa-pencil-alt"></i></div>
                                <ul class="fab-options">
                                    <li>
                                        <a href="<?= BASE_URL ?>users/<?= h($user->getId()) ?>/edit" style="display: flex; text-decoration: none;">
                                            <span class="fab-label">Update Your Profile</span>
                                            <div class="fab-icon-holder">
                                                <i class="fas fa-user-edit"></i>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="delete-user" style="display: flex; text-decoration: none;">
                                            <span class="fab-label">Delete your profile</span>
                                            <div class="fab-icon-holder">
                                                <i id="<?= $user->getId() ?>" class="fas fa-minus-circle"></i>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
    view('partials/footer.php');
?>

<style>
.card {
    padding-top: 20px;
    margin: 10px 0 20px 0;
    background-color: rgba(214, 224, 226, 0.2);
    border-top-width: 0;
    border-bottom-width: 2px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card .card-heading {
    padding: 0 20px;
    margin: 0;
}

.card .card-heading.simple {
    font-size: 20px;
    font-weight: 300;
    color: #777;
    border-bottom: 1px solid #e5e5e5;
}

.card .card-heading.image img {
    display: inline-block;
    width: 46px;
    height: 46px;
    margin-right: 15px;
    vertical-align: top;
    border: 0;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
}

.card .card-heading.image .card-heading-header {
    display: inline-block;
    vertical-align: top;
}

.card .card-heading.image .card-heading-header h3 {
    margin: 0;
    font-size: 14px;
    line-height: 16px;
    color: #262626;
}

.card .card-heading.image .card-heading-header span {
    font-size: 12px;
    color: #999999;
}

.card .card-body {
    padding: 0 20px;
    margin-top: 20px;
}

.card .card-media {
    padding: 0 20px;
    margin: 0 -14px;
}

.card .card-media img {
    max-width: 100%;
    max-height: 100%;
}

.card .card-actions {
    min-height: 30px;
    padding: 0 20px 20px 20px;
    margin: 20px 0 0 0;
}

.card .card-comments {
    padding: 20px;
    margin: 0;
    background-color: #f8f8f8;
}

.card .card-comments .comments-collapse-toggle {
    padding: 0;
    margin: 0 20px 12px 20px;
}

.card .card-comments .comments-collapse-toggle a,
.card .card-comments .comments-collapse-toggle span {
    padding-right: 5px;
    overflow: hidden;
    font-size: 12px;
    color: #999;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.card-comments .media-heading {
    font-size: 13px;
    font-weight: bold;
}

.card.people {
    position: relative;
    display: inline-block;
    width: 170px;
    height: 300px;
    padding-top: 0;
    margin-left: 20px;
    overflow: hidden;
    vertical-align: top;
}

.card.people:first-child {
    margin-left: 0;
}

.card.people .card-top {
    position: absolute;
    top: 0;
    left: 0;
    display: inline-block;
    width: 170px;
    height: 150px;
    background-color: #ffffff;
}

.card.people .card-top.green {
    background-color: #53a93f;
}

.card.people .card-top.blue {
    background-color: #427fed;
}

.card.people .card-info {
    position: absolute;
    top: 150px;
    display: inline-block;
    width: 100%;
    height: 101px;
    overflow: hidden;
    background: #ffffff;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card.people .card-info .title {
    display: block;
    margin: 8px 14px 0 14px;
    overflow: hidden;
    font-size: 16px;
    font-weight: bold;
    line-height: 18px;
    color: #404040;
}

.card.people .card-info .desc {
    display: block;
    margin: 8px 14px 0 14px;
    overflow: hidden;
    font-size: 12px;
    line-height: 16px;
    color: #737373;
    text-overflow: ellipsis;
}

.card.people .card-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    display: inline-block;
    width: 100%;
    padding: 10px 20px;
    line-height: 29px;
    text-align: center;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: rgba(214, 224, 226, 0.2);
}

.card.hovercard .cardheader {
    background: url('/images/background-pattern.png');
    background-size: contain;
    height: 135px;
}

.card.hovercard .avatar {
    position: relative;
    top: -50px;
    margin-bottom: -50px;
}

.card.hovercard .avatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255,255,255,0.5);
}

.card.hovercard .info {
    padding: 4px 8px 10px;
}

.card.hovercard .info .title {
    margin-bottom: 4px;
    font-size: 24px;
    line-height: 1;
    color: #262626;
    vertical-align: middle;
}

.card.hovercard .info .desc {
    overflow: hidden;
    font-size: 12px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}

.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}

.btn{ border-radius: 50%; width:32px; height:32px; line-height:18px;  }
</style>