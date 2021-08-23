<?php
    view('partials/header.php');
?>
<section>
    <div class="container-fluid h-custom" style="background: #2f404e; color: white; padding: 0;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-7">
                <section id="about-us">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1>
                                    <a href="#" style="text-decoration: none; color: white;"><?= h($saint->getName()) ?></a>
                                </h1>
                                <p class="phrase">
                                    <?= h($saint->getPhrase()) ?>
                                </p>
                                <p>
                                    <span class="citation-name">Baptism name</span> &#8212; <?= h($saint->getBaptismName()) ?>
                                    <br>
                                    <span class="citation-name">Place of Birth</span> &#8212; <?= h($saint->getCity()) ?>, <?= h($saint->getNation()) ?>
                                    <br>
                                    <span class="citation-name">Date of Birth &#8212;</span> <?= $saint->getBirthdate() ? h(dateFormat($saint->getBirthdate())) : 'Unknow' ?>
                                    <br>
                                    <span class="citation-name">Feast Date &#8212;</span> <?= $saint->getFeastDate() ? h(dateFormat($saint->getFeastDate())) : 'Unknow' ?>
                                </p>
                                <?php if ($saint->user_name) : ?>
                                    <p class="card-text">By <a href="<?= BASE_URL ?>users/<?= h($saint->getUserId()) ?>"><?= h($saint->user_name) ?></a></p>
                                <?php else : ?>
                                    <p class="card-text">By <a href="<?= BASE_URL ?>the-good-samaritan" style="text-decoration: none;" target="_blank">Good Samaritan</a></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-9 col-lg-6 col-xl-5" style="text-align: right;">
                <img src="<?= BASE_URL ?>images/user_uploads/<?= h($saint->getPhoto()) ?>" class="img-fluid" style="max-width: 750px;">
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-xl-12 align-items-justify">
        <section id="hero" >
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Comment</h1>
                    </div>
                    <form id="submit-edited-comment">
                        <textarea name="comment" id="saint-comment" cols="10" rows="10" class="form-control form-control-lg <?= isset($errors['comment']) ? 'is-invalid' : '' ?>" placeholder="Write a comment" data-toggle="tooltip" data-placement="top"  title="<?= isset($errors['comment']) ? $errors['comment'] : '' ?>"><?= old('comment') ?><?= old('comment') ?><?= h($comment->getComment()) ?></textarea>
                        <button type="submit" class="btn btn-dark btn-lg" style="margin-left: 40%; margin-top: 2%;">Edit comment</button>
                    </form>
                </div>
            </div>
        </section>
        <?php if (auth()->getTypeId() != 1) : ?>
            <div style="text-align-last: center;">
                <p style="font-size: 18pt;">
                    <?= h(auth()->getName()) ?>, your comment is currently as <a style="<?= $comment->getApproved() ? 'color: limegreen;' : 'color: #757500;' ?>"><?= $comment->getApproved() ? 'approved' : 'not approved' ?></a>.
                </p>
                <?php if ($comment->getApproved()) : ?>
                    <p style="font-size: 18pt;">Changing it now will return it to analysis.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
    view('partials/footer.php');
?>