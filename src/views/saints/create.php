<?php
    view('partials/header.php');
?>

<section>
    <form action="<?= BASE_URL ?>saints/store" method="POST" enctype="multipart/form-data" id="saint-form">
        <div class="container-fluid h-custom" style="background: #2f404e; color: white; padding: 0;">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-7">
                    <section id="about-us">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h1>
                                        <input type="hidden" name="authorship" id="authorship" value="true">
                                        <input type="text" id="saint-name" name="name" class="form-control form-control-lg saint-input" placeholder="Name" value="<?= old('name') ?>" autocomplete="off" data-toggle="tooltip" data-placement="top" title="">
                                    </h1>
                                    <p class="phrase">
                                        <input type="text" id="saint-phrase" name="phrase" class="form-control form-control-lg saint-input phrase" placeholder="Phrase" value="<?= old('phrase') ?>" autocomplete="off" data-toggle="tooltip" data-placement="top" title="">
                                    </p>
                                    <p class="phrase">
                                        <input type="text" id="saint-baptism-name" name="baptism_name" class="form-control form-control-lg saint-input phrase" placeholder="Baptism Name" value="<?= old('baptism_name') ?>" autocomplete="off" data-toggle="tooltip" data-placement="top" title="">
                                    </p>
                                    <p>
                                        <span style="display: flex;">
                                            <input type="text" id="saint-birthdate" name="birthdate" class="form-control form-control-lg saint-input phrase" placeholder="Birthdate" value="<?= old('birthdate') ?>" autocomplete="off" data-toggle="tooltip" data-placement="top" title="" data-mask="00/00/0000">

                                            <input type="text" id="saint-feast-date" name="feast_date" class="form-control form-control-lg saint-input phrase" placeholder="Feast Date" value="<?= old('feast_date') ?>" autocomplete="off" data-toggle="tooltip" data-placement="top" title="" style="margin-left: 30px;" data-mask="00/00/0000">
                                        </span>
                                    </p>
                                    <p>
                                        <span style="display: flex;">
                                            <input type="text" id="saint-nation" name="nation" class="form-control form-control-lg saint-input phrase" placeholder="Nation" value="<?= old('nation') ?>" autocomplete="off" data-toggle="tooltip" data-placement="top" title="">

                                            <input type="text" id="saint-city" name="city" class="form-control form-control-lg saint-input phrase" placeholder="City" value="<?= old('city') ?>" autocomplete="off" data-toggle="tooltip" data-placement="top" title="" style="margin-left: 30px;">
                                        </span>
                                    </p>

                                    <input type="file" name="photo" class="inputfile" id="saint-photo-input" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-9 col-lg-6 col-xl-5" style="text-align: right;">
                    <img src="<?= BASE_URL ?>images/sacred heart of jesus.webp" class="img-fluid" id="photo-img" alt="saint_photo" style="max-width: 750px;">
                </div>
            </div>
        </div>
        <div class="fab-container">
            <div class="fab fab-icon-holder"><i class="fas fa-pencil-alt"></i></div>
                <ul class="fab-options">
                    <li id="submit">
                        <span class="fab-label">Save Saint</span>
                        <div class="fab-icon-holder">
                            <i class="fas fa-upload"></i>
                        </div>
                    </li>
                    <li id="remove-authorship">
                        <span class="fab-label">Save Saint without authorship</span>
                        <div class="fab-icon-holder">
                            <i class="fas fa-file-upload"></i>
                        </div>
                    </li>
                    <li id="add-authorship" style="display: none;">
                        <span class="fab-label">Save Saint with authorship</span>
                        <div class="fab-icon-holder">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                    </li>
                    <li>
                        <span class="fab-label">Add Photo</span>
                        <label for="saint-photo-input" style="cursor: pointer;">
                            <div class="fab-icon-holder">
                                <i class="fas fa-camera"></i>
                            </div>
                        </label>
                    </li>
                    <li style="display: none;" id="remove-saint-photo">
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
                        <textarea name="bio" id="saint-bio" cols="30" rows="10" class="form-control form-control-lg" placeholder="Write info about this Saint" data-toggle="tooltip" data-placement="top" title=""><?= old('bio') ?></textarea>
                    </div>
                </div>
            </section>
            <section id="hero">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h1>Prayer</h1>
                        </div>
                        <textarea name="prayer" id="saint-prayer" cols="30" rows="10" class="form-control form-control-lg" placeholder="Write a Prayer" data-toggle="tooltip" data-placement="top" title=""><?= old('prayer') ?></textarea>
                    </div>
                </div>
            </section>
        </div>
    </form>
</section>

<?php
    view('partials/footer.php');
?>