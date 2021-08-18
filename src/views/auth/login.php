<?php
    view('partials/header.php');
?>
<section class="vh-40" style="margin-top: 50px;">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="<?= BASE_URL ?>images/our_lady.jpeg" class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form action="<?= BASE_URL ?>authenticate" method="POST" id="form-login">
                    <div class="form-outline mb-4">
                        <label class="form-label" for="email">Email address</label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter a valid email address" value="<?= old('email') ?>">
                        <div class="invalid-feedback">
                            Invalid email.
                        </div>
                    </div>
                    <div class="form-outline mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter password">
                    </div>
                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn btn-dark btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account?
                        <a href="<?= BASE_URL ?>register" class="link-danger">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
    view('partials/footer.php');
?>