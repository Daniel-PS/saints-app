<?php
    view('partials/header.php');
?>
  <!-- HERO SECTION -->
  <section id="hero">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Catholic <br> Saints</h1>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, magnam voluptas ad ipsam vero ipsa itaque doloribus, mollitia dignissimos unde officia nisi inventore saepe maxime sint a quibusdam minus cupiditate
                    </p>
                    <button class="btn btn-dark btn-lg">Large button</button>
                </div>
                <div class="col img-col">
                    <img src="<?= BASE_URL ?>images/banner.jpg" alt="Banner" class="img-fluid">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h1>Last registered</h1>
                </div>
            </div>
            <div class="row cards">
                <?php foreach ($saints->getItems() as $saint) : ?>
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
                                <?php if ($saint['user_id']) : ?>
                                    <p class="card-text">By <a href="<?= BASE_URL ?>users/<?= h($saint['user_id']) ?>" target="_blank"><?= h($saint['user_name']) ?></a></p>
                                <?php else : ?>
                                    <p class="card-text">By <a href="<?= BASE_URL ?>the-good-samaritan" target="_blank">Good Samaritan</a></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- HERO END -->

    <!-- PHRASE -->
    <section id="about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <img src="<?= BASE_URL ?>images/saint_therese.jpg" alt="therese_phrase">
                </div>
                <div class="col">
                    <h1>"I know now</h1>
                    <p class="phrase">
                        that true charity consists in bearing all our neighbors'defects&#8212;not being surprised at their weakness, but edified at their smallest virtues"
                    </p>
                    <p>
                        <span class="citation-name">&#8212; St. Therese of Lisieux</span>,
                        <span class="citation-from">Story of a Soul (l'Histoire d'une Ame)</span>
                        <br>
                        <span class="citation-year">September 30, 1898</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- END PHRASE -->
<?php
    view('partials/footer.php');
?>