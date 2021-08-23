<?php
    view('partials/header.php');
?>

<?php if (isset($message)) : ?>
    <div id="hideMe" class="message" style="margin-top: 100px;">
        <p class="message-text"><?= $message ?></p>
    </div>
<?php endif; ?>
<section>
    <form action="<?= BASE_URL ?>saints/<?= h($saint->getId()) ?>" method="POST" enctype="multipart/form-data" id="form">
        <div class="container-fluid h-custom" style="background: #2f404e; color: white; padding: 0;">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-7">
                    <section id="about-us">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h1>
                                        <input type="hidden" name="authorship" id="authorship" value="true">
                                        <input type="text" id="name" name="name" class="form-control form-control-lg saint-input <?= isset($errors['name']) ? 'is-invalid' : '' ?>" placeholder="Name" value="<?= old('name') ?? h($saint->getName()) ?>" autocomplete="off" data-toggle="tooltip" data-placement="top" title="<?= isset($errors['name']) ? $errors['name'] : '' ?>">
                                    </h1>
                                    <p class="phrase">
                                        <input type="text" id="phrase" name="phrase" class="form-control form-control-lg saint-input phrase <?= isset($errors['phrase']) ? 'is-invalid' : '' ?>" placeholder="Phrase" value="<?= old('phrase') ?? h($saint->getPhrase()) ?>" autocomplete="off" data-toggle="tooltip" data-placement="top" title="<?= isset($errors['phrase']) ? $errors['phrase'] : '' ?>">
                                    </p>
                                    <p class="phrase">
                                        <input type="text" name="baptism_name" class="form-control form-control-lg saint-input phrase <?= isset($errors['baptism_name']) ? 'is-invalid' : '' ?>" placeholder="Baptism Name" value="<?= old('baptism_name') ?? h($saint->getBaptismName()) ?>" autocomplete="off" data-toggle="tooltip" data-placement="top" title="<?= isset($errors['baptism_name']) ? $errors['baptism_name'] : '' ?>">
                                    </p>
                                    <p>
                                        <span style="display: flex;">
                                            <input type="text" name="birthdate" class="form-control form-control-lg saint-input phrase <?= isset($errors['birthdate']) ? 'is-invalid' : '' ?>" placeholder="Birthdate" value="<?= old('birthdate') ? dateFormat(old('birthdate')) : ($saint->getBirthdate() ? h(dateFormat($saint->getBirthdate())) : '') ?>" autocomplete="off" data-toggle="tooltip" data-placement="top" id="birth-date" data-mask="00/00/0000" title="<?= isset($errors['birthdate']) ? $errors['birthdate'] : '' ?>">

                                            <input type="text" name="feast_date" class="form-control form-control-lg saint-input phrase <?= isset($errors['feast_date']) ? 'is-invalid' : '' ?>" placeholder="Feast Date" value="<?= old('feast_date') ? dateFormat(old('feast_date')) : ($saint->getFeastDate() ? h(dateFormat($saint->getFeastDate())) : '') ?>" autocomplete="off" data-toggle="tooltip" data-placement="top" id="feast-date" style="margin-left: 30px;" data-mask="00/00/0000" title="<?= isset($errors['feast_date']) ? $errors['feast_date'] : '' ?>">
                                        </span>
                                    </p>
                                    <p>
                                        <span style="display: flex;">
                                            <input type="text" name="nation" class="form-control form-control-lg saint-input phrase <?= isset($errors['nation']) ? 'is-invalid' : '' ?>" placeholder="Nation" value="<?= old('nation') ?? h($saint->getNation()) ?>" autocomplete="off" data-toggle="tooltip" data-placement="top" title="<?= isset($errors['nation']) ? $errors['nation'] : '' ?>">

                                            <input type="text" name="city" class="form-control form-control-lg saint-input phrase <?= isset($errors['city']) ? 'is-invalid' : '' ?>" placeholder="City" value="<?= old('city') ?? h($saint->getCity()) ?>" autocomplete="off" data-toggle="tooltip" data-placement="top" title="<?= isset($errors['city']) ? $errors['city'] : '' ?>" style="margin-left: 30px;">
                                        </span>
                                    </p>

                                    <input type="file" name="photo" class="inputfile" id="photo-input" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-9 col-lg-6 col-xl-5" style="text-align: right;">
                    <img src="<?= BASE_URL ?>images/user_uploads/<?= h($saint->getPhoto()) ?>" class="img-fluid" id="photo-img" alt="saint_photo" style="max-width: 750px;">
                </div>
            </div>
        </div>
        <div class="fab-container">
            <div class="fab fab-icon-holder"><i class="fas fa-pencil-alt"></i></div>
                <ul class="fab-options">
                    <li id="submit">
                        <span class="fab-label">Update Saint</span>
                        <div class="fab-icon-holder">
                            <i class="fas fa-upload"></i>
                        </div>
                    </li>
                    <?php if ($saint->getUserId() === auth()->getId()) : ?>
                        <li id="remove-authorship">
                            <span class="fab-label">Update Saint without authorship</span>
                            <div class="fab-icon-holder">
                                <i class="fas fa-file-upload"></i>
                            </div>
                        </li>
                        <li id="add-authorship" style="display: none;">
                            <span class="fab-label">Update Saint with authorship</span>
                            <div class="fab-icon-holder">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li>
                        <span class="fab-label">Add Photo</span>
                        <label for="photo-input" style="cursor: pointer;">
                            <div class="fab-icon-holder">
                                <i class="fas fa-camera"></i>
                            </div>
                        </label>
                    </li>
                    <li style="display: none;" id="remove-photo">
                        <span class="fab-label">Remove Photo</span>
                        <div class="fab-icon-holder">
                            <i class="fas fa-trash"></i>
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
                        <textarea name="bio" id="bio" cols="30" rows="10" class="form-control form-control-lg <?= isset($errors['bio']) ? 'is-invalid' : '' ?>" placeholder="Write info about this Saint" data-toggle="tooltip" data-placement="top" title="<?= isset($errors['bio']) ? $errors['bio'] : '' ?>"><?= old('bio') ?? h($saint->getBio()) ?></textarea>
                    </div>
                </div>
            </section>
            <section id="hero">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h1>Prayer</h1>
                        </div>
                        <textarea name="prayer" id="prayer" cols="30" rows="10" class="form-control form-control-lg <?= isset($errors['prayer']) ? 'is-invalid' : '' ?>" placeholder="Write a Prayer" data-toggle="tooltip" data-placement="top" title="<?= isset($errors['prayer']) ? $errors['prayer'] : '' ?>"><?= old('prayer') ?? h($saint->getPrayer()) ?></textarea>
                    </div>
                </div>
            </section>
        </div>
    </form>
</section>

<?php if (auth()->getTypeId() != 1) : ?>
    <div style="text-align-last: center;">
        <p style="font-size: 18pt;">
            <?= h(auth()->getName()) ?>, <?= h($saint->getName()) ?> is currently as <a style="<?= $saint->getApproved() ? 'color: limegreen;' : 'color: #757500;' ?>"><?= $saint->getApproved() ? 'approved' : 'not approved' ?></a>.
        </p>
        <?php if ($saint->getApproved()) : ?>
            <p style="font-size: 18pt;">Changing it now will return it to analysis.</p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<script src="/js/saints/edit.js"></script>

<?php
    view('partials/footer.php');
?>