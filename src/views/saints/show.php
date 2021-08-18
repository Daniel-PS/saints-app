<?php
    view('partials/header.php');
?>

<section >
    <div class="container-fluid h-custom" style="background: #2f404e; color: white; padding: 0;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-7">
                <section id="about-us">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1>
                                    <a href="#" style="text-decoration: none; color: white;">Saint Therese of Lisieux</a>
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
                    </div>
                </section>
            </div>
            <div class="col-md-9 col-lg-6 col-xl-5" style="text-align: right;">
                <img src="<?= BASE_URL ?>images/saint_therese.jpg" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="fab-container" style="right: 130px;">
        <div class="fab fab-icon-holder" style="background: #ff4040;">
            <i class="fas fa-heart"></i>
        </div>
        <ul class="fab-options">
            <li>
                <span class="fab-label" style="background: #ff4040;">Mark as Saint of Devotion</span>
            </li>
        </ul>
    </div>
    <div class="fab-container">
        <div class="fab fab-icon-holder"><i class="fas fa-pencil-alt"></i></div>
            <ul class="fab-options">
                <li>
                    <span class="fab-label">Update Saint</span>
                    <div class="fab-icon-holder">
                        <i class="fas fa-user-edit"></i>
                    </div>
                </li>
                <li>
                    <span class="fab-label">Remove authorship</span>
                    <div class="fab-icon-holder">
                        <i class="fas fa-minus-circle"></i>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-xl-12 align-items-justify">
        <section id="hero" >
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Bio</h1>
                    </div>
                    <p class="phrase" style="font-size: 14pt; text-align: justify;">
                        &nbsp;&nbsp;&nbsp;&nbsp; Thérèse of Lisieux (French: sainte Thérèse de Lisieux [te.ʁɛz də li.zjø]), born Marie Françoise-Thérèse Martin (2 January 1873 – 30 September 1897), also known as Saint Therese of the Child Jesus and the Holy Face (Thérèse de l’Enfant Jésus et de la Sainte Face), was a French Catholic Discalced Carmelite nun who is widely venerated in modern times. She is popularly known in English as "The Little Flower of Jesus", or simply "The Little Flower,” and in French as la petite Thérèse (little Thérèse).[2][3]

                        Therese has been a highly influential model of sanctity for Catholics and for others because of the simplicity and practicality of her approach to the spiritual life. Together with Francis of Assisi, she is one of the most popular saints in the history of the church.[4][5] Pope Pius X called her "the greatest saint of modern times".[6][7]

                        Therese felt an early call to religious life and after overcoming various obstacles in 1888, at the early age of 15,[8] she became a nun and joined two of her older sisters in the cloistered Carmelite community of Lisieux, Normandy (yet another sister, Céline, also later joined the order). After nine years as a Carmelite religious, having fulfilled various offices such as sacristan and assistant to the novice mistress, in her last eighteen months in Carmel she fell into a night of faith, in which she is said to have felt Jesus was absent and been tormented by doubts that God existed. Therese died at the age of 24 from tuberculosis.

                        Her feast day in the General Roman Calendar was 3 October from 1927 until it was moved in 1969 to 1 October.[9] Therese is well known throughout the world, with the Basilica of Lisieux being the second most popular place of pilgrimage in France after Lourdes.
                    </p>
                </div>
            </div>
        </section>
        <section id="hero">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Prayer</h1>
                    </div>
                    <p class="phrase" style="font-size: 15pt; font-style: italic; text-align: center;">
                        O Little Therese of the Child Jesus, please pick for me a rose
                        from the heavenly gardens and send it to me as a message of love.

                        O Little Flower of Jesus, ask God to grant the favors
                        I now place with confidence in your hands . .

                        (mention in silence here)

                        St. Therese, help me to always believe as you did in
                        God’s great love for me, so that I might imitate your “Little Way” each day.

                        Amen
                    </p>
                </div>
            </div>
        </section>
        <section id="hero" style="padding-bottom: 0;">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Comments</h1>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container mt-3 mb-4">
        <div class="col-lg-12 mt-4 mt-lg-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                        <table class="table manage-candidates-top mb-0">
                            <tbody>
                                <tr class="candidates-list">
                                    <td class="title">
                                        <div class="thumb">
                                            <img class="img-fluid" src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/c8366146-25b7-49b3-a640-58439d2a2baa/d5gs9sv-0c98ab64-0f32-4c6d-90ed-39d38d2bf0ba.jpg/v1/fill/w_900,h_675,q_75,strp/random_dude_who_lives_near_me_by_misa_amane_17_d5gs9sv-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9Njc1IiwicGF0aCI6IlwvZlwvYzgzNjYxNDYtMjViNy00OWIzLWE2NDAtNTg0MzlkMmEyYmFhXC9kNWdzOXN2LTBjOThhYjY0LTBmMzItNGM2ZC05MGVkLTM5ZDM4ZDJiZjBiYS5qcGciLCJ3aWR0aCI6Ijw9OTAwIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmltYWdlLm9wZXJhdGlvbnMiXX0.YP5o5wapk-q4-6vpQIKaERchdyvNl8MOAs_cbG7ThfU" alt="">
                                        </div>
                                        <div class="candidate-list-details">
                                            <div class="candidate-list-info">
                                                <div class="candidate-list-title">
                                                    <h5 class="mb-0"><a href="#" style="text-decoration: none;">John Kelly</a></h5>
                                                    <a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-cross"></i></a>
                                                    <span class="candidate-list-time order-1">Saint of Devotion</span>
                                                </div>
                                                <div class="candidate-list-option">
                                                    <ul class="list-unstyled">
                                                        <li style="font-size: 12pt; color: #2f404e; font-weight: bold;">My Patron Saint!</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                            <li><a href="#" class="text-primary" data-toggle="tooltip" title="" data-original-title="view"><i class="far fa-eye"></i></a></li>
                                            <li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
                                            <li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="candidates-list">
                                    <td class="title">
                                        <div class="thumb">
                                            <img class="img-fluid" src="https://i1.sndcdn.com/avatars-000705432103-7ogz0j-t240x240.jpg" alt="">
                                        </div>
                                        <div class="candidate-list-details">
                                            <div class="candidate-list-info">
                                                <div class="candidate-list-title">
                                                    <h5 class="mb-0"><a href="#" style="text-decoration: none;">Mary Bradley</a></h5>
                                                </div>
                                                <div class="candidate-list-option">
                                                    <ul class="list-unstyled">
                                                        <li style="font-size: 12pt; color: #2f404e; font-weight: bold;">Beloved Saint! Little Flower pray for us!</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                            <li><a href="#" class="text-primary" data-toggle="tooltip" title="" data-original-title="view"><i class="far fa-eye"></i></a></li>
                                            <li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
                                            <li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    view('partials/footer.php');
?>