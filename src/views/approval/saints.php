<?php
    view('partials/header.php');
?>
    <section id="hero" style="margin-top: 100px;">
    <?php if (isset($message)) : ?>
        <div id="hideMe" class="message" style="margin-top: 100px;">
            <p class="message-text"><?= $message ?></p>
        </div>
    <?php endif; ?>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Saints</h1>
                </div>
            </div>
        </div>
    </section>
    <section id="about-us">
        <?php if (! empty($saintsPaginator->getItems())) : ?>
            <?php foreach ($saintsPaginator->getItems() as $saint) : ?>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col">
                            <img src="<?= BASE_URL ?>images/user_uploads/<?= h($saint['photo']) ?>" alt="therese_phrase">
                        </div>
                        <div class="col">
                            <h1>
                                <a href="<?= BASE_URL ?>saints/<?= h($saint['id']) ?>" style="text-decoration: none; color: #2f404e;"><?= h($saint['name']) ?></a>
                            </h1>
                            <p class="phrase">
                                <?= h($saint['phrase']) ?>
                            </p>
                            <p>
                                <span class="citation-name">Baptism name</span> &#8212; <?= h($saint['baptism_name']) ?>
                                <br>
                                <span class="citation-name">Place of Birth</span> &#8212; <?= h($saint['city']) ?>, <?= h($saint['nation']) ?>
                                <br>
                                <span class="citation-name">Date of Birth &#8212;</span> <?= $saint['birthdate'] ? h(dateFormat($saint['birthdate'])) : 'Unknow' ?>
                                <br>
                                <span class="citation-name">Feast Date &#8212;</span> <?= $saint['feast_date'] ? h(dateFormat($saint['feast_date'])) : 'Unknow' ?>
                            </p>
                            <?php if ($saint['user_id']) : ?>
                                <p class="card-text">By <a href="<?= BASE_URL ?>users/<?= h($saint['user_id']) ?>"><?= h($saint['user_name']) ?></a></p>
                            <?php else : ?>
                                <p class="card-text">By <a href="<?= BASE_URL ?>the-good-samaritan" target="_blank" style="text-decoration: none;">Good Samaritan</a></p>
                            <?php endif; ?>
                            <a class="text-info approve-saint" data-toggle="tooltip" title="Approve" data-original-title="Approve" style="cursor: pointer; text-decoration: none; margin-right: 10px;">
                                <i id="<?= $saint['id'] ?>" class="fas fa-thumbs-up" style="color: limegreen;"></i>
                            </a>

                            <a class="remove-saint" data-toggle="tooltip" title="Remove" data-original-title="Remove" style="cursor: pointer; text-decoration: none;">
                                <i id="<?= $saint['id'] ?>" class="far fa-thumbs-down" style="color: red;"></i>
                            </a>
                        </div>
                    </div>
                    <hr style="margin-top: 50px;">
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <h4 style="text-align: center;">There are no Saints to approve</h4>
        <?php endif; ?>

        <nav>
            <ul class="pagination" style="place-content: center;">
                <?php if ($page > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL . 'saints' ?>">
                            First
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL . 'saints?page=' . ($page - 1) ?>">
                            Previous
                        </a>
                    </li>
                <?php endif ?>
                <?php if ($page < $saintsPaginator->getLastPage()) : ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL . 'saints?page=' . ($page + 1) ?>">
                            Next
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL . 'saints?page=' . $saintsPaginator->getLastPage() ?>">
                            Last
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </nav>
    </section>
<?php
    view('partials/footer.php');
?>