<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>/template/assets/images/favicon.ico">

    <!-- App css -->
    <link href="<?= base_url() ?>/template/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/template/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
    <link href="<?= base_url() ?>/template/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" disabled="disabled">

</head>

<body class="authentication-bg" data-layout-config="{&quot;leftSideBarTheme&quot;:&quot;dark&quot;,&quot;layoutBoxed&quot;:false, &quot;leftSidebarCondensed&quot;:false, &quot;leftSidebarScrollable&quot;:false,&quot;darkMode&quot;:false, &quot;showRightSidebarOnStart&quot;: true}" data-leftbar-theme="dark" style="visibility: visible;">

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-lg-5">
                    <div class="card">
                        <!-- Logo-->
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <a href="#">
                                <span><img src="<?= base_url() ?>/assets_image/teanology_4.png" alt="" height="32"></span>
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center mt-0 fw-bold">Free Sign Up</h4>
                                <p class="text-muted mb-4">Don't have an account? Create your account, it takes less than a minute </p>
                            </div>

                            <form method="POST" action="<?= site_url('auth/processRegister') ?>">
                                <?= csrf_field() ?>
                                <div class="mb-3 d-flex">
                                    <div class="w-100 me-3">
                                        <label for="firstname" class="form-label">First Name</label>
                                        <input class="form-control" type="text" id="first_name_customer" name="first_name_customer" placeholder="First name" required="">
                                    </div>
                                    <div class="w-100">
                                        <label for="lastname" class="form-label">Last Name</label>
                                        <input class="form-control" type="text" id="last_name_customer" name="last_name_customer" placeholder="Last name" required="">
                                    </div>
                                </div>

                                <div class="mb-3 d-flex">
                                    <div class="w-100 me-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" type="email" id="email_customer" name="email_customer" required="" placeholder="Email">
                                    </div>
                                    <div class="w-100">
                                        <label class="form-label">Telephone</label>
                                        <input type="text" class="form-control" data-toggle="input-mask" name="phone_customer" data-mask-format="00000-0000-0000" placeholder="Enter number">
                                        <span class="font-13 text-muted">e.g "6281x-xxxx-xxxx"</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="w-100 me-3">
                                        <label for="example-date" class="form-label">Date</label>
                                        <input class="form-control" id="example-date" type="date" name="birthdate_customer">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password_customer" class="form-control" name="password_customer" placeholder="Enter your password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signup">
                                        <label class="form-check-label" for="checkbox-signup">I accept <a href="#" class="text-muted">Terms and Conditions</a></label>
                                    </div>
                                </div>

                                <div class="mb-3 text-center">
                                    <button class="btn btn-primary" type="submit"> Sign Up </button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">Already have account? <a href="<?= site_url('auth/login') ?>" class="text-muted ms-1"><b>Log In</b></a></p>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt">
        2024 © Teanology - Tim 12
    </footer>

    <!-- bundle -->
    <script src="<?= base_url() ?>/template/assets/js/vendor.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/app.min.js"></script>



</body>

</html>