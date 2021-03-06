<?php
    view('partials/header.php');
?>

<section style="background-color: #eee; margin-top: 70px;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                                <form action="<?= BASE_URL ?>" method="POST" enctype="multipart/form-data" id="form" class="mx-1 mx-md-4">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-camera fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="name">Your Photo</label>
                                            <div id="user-photo" style="display: none;">
                                                <img src="" id="photo-img" name="photo" alt="user_photo" class="user-photo">
                                            </div>
                                            <input type="file" name="photo" class="form-control" id="photo-input" accept="image/*" value="">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="name">Your Name</label>
                                            <input type="text" name="name" id="name" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" value="<?= old('name') ?>">
                                            <?php if (isset($errors['name'])) : ?>
                                                <div class="invalid-feedback" style="display: block;">
                                                   <?= $errors['name'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="far fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="surname">Your Surname</label>
                                            <input type="text" name="surname" id="surname" class="form-control <?= isset($errors['surname']) ? 'is-invalid' : '' ?>" value="<?= old('surname') ?>">
                                            <?php if (isset($errors['surname'])) : ?>
                                                <div class="invalid-feedback" style="display: block;">
                                                   <?= $errors['surname'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="email">Your Email</label>
                                            <input type="email" name="email" id="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" value="<?= old('email') ?>">
                                            <?php if (isset($errors['email'])) : ?>
                                                <div class="invalid-feedback" style="display: block;">
                                                   <?= $errors['email'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">
                                            <?php if (isset($errors['password'])) : ?>
                                                <div class="invalid-feedback" style="display: block;">
                                                   <?= $errors['password'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="confirm-password">Repeat your password</label>
                                            <input type="password" name="confirm_password" id="confirm-password" class="form-control <?= isset($errors['confirm_password']) ? 'is-invalid' : '' ?>">
                                            <?php if (isset($errors['confirm_password'])) : ?>
                                                <div class="invalid-feedback" style="display: block;">
                                                   <?= $errors['confirm_password'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-dark btn-lg">Register</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="<?= BASE_URL ?>images/saint_isidore.jpg" class="img-fluid" alt="saint-isidore">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    view('partials/footer.php');
?>