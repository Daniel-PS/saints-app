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
                                    <span class="citation-name">Date of Birth &#8212;</span> <?= h($saint->getBirthdate()) ?>
                                    <br>
                                    <span class="citation-name">Feast Date &#8212;</span> <?= h($saint->getFeastDate()) ?>
                                </p>
                                <p class="card-text">By <a href="<?= BASE_URL ?>users/<?= h($saint->getUserId()) ?>"><?= h($saint->user_name) ?></a></p>
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
    <?php if (auth()) : ?>
        <?php if (auth()->getId() === $saint->getUserId()) : ?>
            <div class="fab-container" style="right: 130px;">
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
        <?php endif; ?>
    <?php endif; ?>
    <?php if (auth()) : ?>
        <div class="fab-container">
            <div class="fab fab-icon-holder" style="background: #ff4040;">
                <i class="fas fa-heart"></i>
            </div>
            <ul class="fab-options">
                <li>
                    <span class="fab-label" style="background: #ff4040;">Mark as Saint of Devotion</span>
                </li>
            </ul>
        </div>
    <?php endif; ?>
    <div class="col-md-12 col-lg-12 col-xl-12 align-items-justify">
        <section id="hero" >
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Bio</h1>
                    </div>
                    <p class="phrase" style="font-size: 14pt; text-align: justify;">
                        &nbsp;&nbsp;&nbsp;&nbsp; <?= h($saint->getBio()) ?>
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
                        <?= h($saint->getPrayer()) ?>
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
                                <?php if (! empty($commentsPaginator->getItems())) : ?>
                                    <?php foreach ($commentsPaginator->getItems() as $comment) : ?>
                                        <tr class="candidates-list">
                                            <td class="title">
                                                <div class="thumb">
                                                    <img class="img-fluid" src="<?= BASE_URL ?>images/user_uploads/<?= h($comment['photo']) ?>" alt="">
                                                </div>
                                                <div class="candidate-list-details">
                                                    <div class="candidate-list-info">
                                                        <div class="candidate-list-title">
                                                            <h5 class="mb-0"><a href="<?= BASE_URL ?>users/<?= $comment['user_id'] ?>" style="text-decoration: none;"><?= h($comment['name']) ?></a></h5>
                                                            <?php if ($comment['devoted']) : ?>
                                                                <a class="candidate-list-favourite order-2" style="color: transparent;" href="#">
                                                                    <i class="fas fa-cross"></i>
                                                                </a>
                                                                <span class="candidate-list-time order-1">Saint of Devotion</span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="candidate-list-option">
                                                            <ul class="list-unstyled">
                                                                <li style="font-size: 12pt; color: #2f404e; font-weight: bold;"><?= h($comment['comment']) ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <?php if (auth()) : ?>
                                                <?php if (auth()->getId() === $comment['user_id']) : ?>
                                                    <td>
                                                        <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                                            <li>
                                                                <a href="<?= BASE_URL ?>saints/<?= $saint->getId() ?>/comments/<?= $comment['id'] ?>/edit" class="text-info" data-toggle="tooltip" title="Edit" data-original-title="Edit">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="text-danger" data-toggle="tooltip" title="Delete" data-original-title="Delete" style="cursor: pointer;">
                                                                    <i id="<?= $comment['id'] ?>" class="far fa-trash-alt"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <h4 style="text-align: center;">Unfortunately, there are no comments for this Saint</h4>
                                    <h6 style="text-align: center;">Be the First!</h6>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <?php if (auth()) : ?>
                            <a href="<?= BASE_URL ?>saints/<?= h($saint->getId()) ?>/comments/create" class="btn btn-dark btn-lg" style="margin-top: 10px;">Add a comment</a>
                        <?php endif; ?>
                    </div>
                    <nav>
                        <ul class="pagination" style="place-content: center;">
                            <?php if ($page > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= BASE_URL . 'saints/' . $saint->getId() . '' ?>">
                                        First
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="<?= BASE_URL . 'saints/' . $saint->getId() . '?page=' . ($page - 1) ?>">
                                        Previous
                                    </a>
                                </li>
                            <?php endif ?>
                            <?php if ($page < $commentsPaginator->getLastPage()) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= BASE_URL . 'saints/' . $saint->getId() . '?page=' . ($page + 1) ?>">
                                        Next
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="<?= BASE_URL . 'saints/' . $saint->getId() . '?page=' . $commentsPaginator->getLastPage() ?>">
                                    </a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    view('partials/footer.php');
?>