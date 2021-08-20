<?php
    view('partials/header.php');
?>

    <section id="hero" style="margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Saints</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="about-us">
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
                            <span class="citation-name">Date of Birth &#8212;</span> <?= h($saint['birthdate']) ?>
                            <br>
                            <span class="citation-name">Feast Date &#8212;</span> <?= h($saint['feast_date']) ?>
                        </p>
                        <p class="card-text">By <a href="<?= BASE_URL ?>users/<?= h($saint['user_id']) ?>"><?= h($saint['user_name']) ?></a></p>
                    </div>
                </div>
                <hr style="margin-top: 50px;">
            </div>
        <?php endforeach; ?>

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