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
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <img src="<?= BASE_URL ?>images/saint_therese.jpg" alt="therese_phrase">
                </div>
                <div class="col">
                    <h1>
                        <a href="#" style="text-decoration: none; color: #2f404e;">Saint Therese of Lisieux</a>
                    </h1>
                    <p class="phrase">
                        "I know now that true charity consists in bearing all our neighbors'defects&#8212;not being surprised at their weakness, but edified at their smallest virtues"
                    </p>
                    <p>
                        <span class="citation-name">Baptism name</span> &#8212; Marie Françoise-Thérèse Martin
                        <br>
                        <span class="citation-name">Place of Birth</span> &#8212; Alençon, France
                        <br>
                        <span class="citation-name">Date of Birth &#8212;</span> January 2, 1873
                    </p>
                    <p class="card-text">By <a href="#">Mary</a></p>
                </div>
            </div>
            <hr style="margin-top: 50px;">
            <div class="row align-items-center" style="margin-top: 50px;">
                <div class="col">
                    <img src="<?= BASE_URL ?>images/user_uploads/saint bernadette.jpg" alt="therese_phrase">
                </div>
                <div class="col">
                    <h1>
                        <a href="#" style="text-decoration: none; color: #2f404e;">Saint Bernadette</a>
                    </h1>
                    <p class="phrase">
                        "I shall spend every moment loving. One who loves does not notice her trials; or perhaps more accurately, she is able to love them."
                    </p>
                    <p>
                        <span class="citation-name">Baptism name</span> &#8212; Bernadeta Sobirós
                        <br>
                        <span class="citation-name">Place of Birth</span> &#8212; Lourdes, France
                        <br>
                        <span class="citation-name">Date of Birth &#8212;</span> January 7, 1844
                    </p>
                    <p class="card-text">By <a href="#">Good Samaritan</a></p>
                </div>
            </div>
        </div>
    </section>

<?php
    view('partials/footer.php');
?>