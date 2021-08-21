<?php
    view('partials/header.php');
?>
<section>
    <section id="hero" style="padding-bottom: 0;">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Comments to be approved</h1>
                </div>
            </div>
        </div>
    </section>
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
                                                <div style="position: absolute; margin-top: 130px; display: flex;">
                                                    <p>
                                                        Commented on
                                                        <a href="<?= BASE_URL ?>saints/<?= $comment['saint_id'] ?>" target="_blank" style="text-decoration: none;">
                                                            <?= $comment['saint_name'] ?>
                                                        </a>
                                                        at <?= dateFormat($comment['created_at'], true) ?>
                                                    </p>
                                                    <img class="saint-comment" src="<?= BASE_URL ?>images/user_uploads/<?= $comment['saint_photo'] ?>">
                                                </div>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                                    <li>
                                                        <a class="text-info approve-comment" data-toggle="tooltip" title="Approve" data-original-title="Approve" style="cursor: pointer;">
                                                            <i id="<?= $comment['id'] ?>" class="fas fa-thumbs-up" style="color: limegreen;"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="remove-comment" data-toggle="tooltip" title="Remove" data-original-title="Remove" style="cursor: pointer;">
                                                            <i id="<?= $comment['id'] ?>" class="far fa-thumbs-down" style="color: red;"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <h4 style="text-align: center;">There are no comments to approve</h4>
                                <?php endif; ?>
                            </tbody>
                        </table>
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