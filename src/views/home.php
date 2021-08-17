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
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img src="<?= BASE_URL ?>images/user_uploads/saint bernadette.jpg" alt="service" class="icon">
                            <h5 class="card-title">
                                <a href="#">Saint Bernadette</a>
                            </h5>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                            </p>
                            <p class="card-text">By <a href="#">John</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img src="<?= BASE_URL ?>images/user_uploads/saint germaine cousin.jpg" alt="service" class="icon">
                            <h5 class="card-title">
                                <a href="#">Saint Germaine Cousin</a>
                            </h5>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                            </p>
                            <p class="card-text">By <a href="#">Mary</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img src="<?= BASE_URL ?>images/user_uploads/saint joseph.jpg" alt="service" class="icon">
                            <h5 class="card-title">
                                <a href="#">Saint Joseph</a>
                            </h5>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                            </p>
                            <p class="card-text">By <a href="#">Claire</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img src="<?= BASE_URL ?>images/user_uploads/saint therese.jpg" alt="service" class="icon">
                            <h5 class="card-title">
                                <a href="#">Saint Therese</a>
                            </h5>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                            </p>
                            <p class="card-text">By <a href="#">Mary</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img src="<?= BASE_URL ?>images/user_uploads/saint teresa of avila.jpg" alt="service" class="icon">
                            <h5 class="card-title">
                                <a href="#">Saint Teresa of Avila</a>
                            </h5>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                            </p>
                            <p class="card-text">By <a href="#">Paul</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img src="<?= BASE_URL ?>images/user_uploads/saint clare of assisi.jpg" alt="service" class="icon">
                            <h5 class="card-title">
                                <a href="#">Saint Claire of Assisi</a>
                            </h5>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                            </p>
                            <p class="card-text">By <a href="#">Therese</a></p>
                        </div>
                    </div>
                </div>
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