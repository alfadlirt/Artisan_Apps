<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Heraio Admin Apps</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="<?= base_url('public/assets/images/favicon.ico')?>">

    <link href="<?php echo base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/css/icons.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/css/style.css') ?>" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url('public/assets/js/jquery.min.js') ?>"></script>
</head>

<body>
    <div class="accountbg"></div>

    <div class="wrapper-page">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-5">
                    <div class="card card-pages shadow-none mt-4">
                        <div class="card-body">
                            <div class="text-center mt-0 mb-3">
                                <a href="index.html" class="logo logo-admin">
                                    <img src="assets/images/logo-isuzu.png" class="mt-3" alt="" height="26"></a>
                                <p class="text-muted w-75 mx-auto mb-4 mt-4">Enter your email address and password to access admin panel.</p>
                            </div>
                            <form method="POST" class="form-horizontal mt-4" action="<?= base_url('Login/Authentication') ?>">
                                <input type="hidden" name="loginType" value="ADMIN"/>
                                <div class="form-group">
                                    <div class="col-12">
                                        <label for="username">Username</label>
                                        <input value="<?=isset($data)?$data['username']:''?>" name="username" class="form-control" type="text" required="" id="username" placeholder="Username">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <label for="password">Password</label>
                                        <input value="<?=isset($data)?$data['password']:''?>" name="password" class="form-control" type="password" required="" id="password" placeholder="Password">
                                    </div>
                                </div>
                                <?php if(isset($errorMsg)):?>
                                <div class="form-group">
                                    <div class="col-12">
                                        <div class="alert alert-danger" role="alert">
                                        <?=$errorMsg?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif?>
                                <div class="form-group text-center mt-3">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" style="background-color:#354558" type="submit">Log In</button>
                                    </div>
                                </div>

                                <div class="form-group text-center mt-4">
                                    <div class="col-12">
                                        <div class="float-left">
                                            <a href="<?= base_url('Login/ForgotPassword') ?>" class="text-muted"><i class="fa fa-lock mr-1"></i> Forgot your password?</a>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
    </div>

    <!-- jQuery  -->
    <script src="<?php echo base_url('public/assets/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('public/assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?php echo base_url('public/assets/js/metismenu.min.js') ?>"></script>
    <script src="<?php echo base_url('public/assets/js/jquery.slimscroll.js') ?>"></script>
    <script src="<?php echo base_url('public/assets/js/waves.min.js') ?>"></script>

    <script src="<?php echo base_url('public/plugins/sweet-alert2/sweetalert2.min.js') ?>"></script>
    <!-- App js -->
    <script src="<?php echo base_url('public/assets/js/app.js') ?>"></script>

</body>

</html>