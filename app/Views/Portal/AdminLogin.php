<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Artisan Admin Portal</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <link href="<?php echo base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/css/metismenu.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/css/icons.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/css/style.css') ?>" rel="stylesheet" type="text/css">

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
                                    <img src="<?php echo base_url('public/assets/images/logo-artisan.png') ?>" class="mt-3" alt="" height="100"></a>
                                <p class="text-muted w-75 mx-auto mb-4 mt-4">Enter your email address and password to access app.</p>
                            </div>

                            <form class="form-horizontal mt-4" action="<?=base_url('login/authadmin')?>" method="POST">
                                <div class="form-group">
                                    <div class="col-12">
                                        <label for="username">Username</label>
                                        <input value="<?=isset($username)?$username:''?>" class="form-control" type="text" required="" name="username" placeholder="Username">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required="" name="password" placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <div class="checkbox checkbox-primary">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1"> Remember me</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center mt-3">
                                    <div class="col-12">
                                    <?php
                                        $session = session();
                                        $authMsg = $session->getFlashdata('authresult');
                                    ?>
                                    <?php if(isset($authMsg)):?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?=$authMsg?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?php endif?>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" style="background-color:#354558" type="submit">Log In</button>
                                    </div>
                                </div>

                                <div class="form-group text-center mt-4">
                                    <div class="col-12">
                                        <div class="float-left">
                                            <!--<a href="pages-recoverpw.html" class="text-muted"><i class="fa fa-lock mr-1"></i> Forgot your password?</a>-->
                                            <a class="text-muted"><i class="fa fa-lock mr-1"></i> Forgot your password? Contact Admin!</a>
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

    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>