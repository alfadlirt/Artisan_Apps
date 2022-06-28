<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Artisan Admin Apps</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="<?= base_url('public/assets/images/favicon.ico')?>">

    <link href="<?php echo base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/css/icons.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/css/style.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/plugins/sweet-alert2/sweetalert2.css')?>" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url('public/assets/js/jquery.min.js') ?>"></script>
</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="index.html" class="logo">
                    <img src="<?= base_url('public/assets/images/logo-artisan.png')?>" class="logo-lg" alt="" height="80">
                    <img src="<?= base_url('public/assets/images/logo-artisan.png')?>" class="logo-sm" alt="" height="50">
                </a>
            </div>

            <!-- Search input -->
            <div class="search-wrap" id="search-wrap">
                <div class="search-bar">
                    <input class="search-input" type="search" placeholder="Search" />
                    <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                        <i class="mdi mdi-close-circle"></i>
                    </a>
                </div>
            </div>

            <nav class="navbar-custom">
                <ul class="navbar-right list-inline float-right mb-0">
                    <li class="dropdown notification-list list-inline-item">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?php echo base_url('public/assets/images/users/user-1.jpg') ?>" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Profile</a>
                                <a class="dropdown-item d-block" href="#"><i class="mdi mdi-settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="#" id="btnLogout"><i class="mdi mdi-power text-danger"></i> Logout</a>
                            </div>
                        </div>
                    </li>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                </ul>

            </nav>

        </div>
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li>
                            <a href="<?= base_url('Category/Index')?>" class="waves-effect"><i class="mdi mdi-file-document-box-multiple-outline"></i><span>Category</span></a>
                        </li>
                        <li>
                            <a href="<?= base_url('Expedition/Index')?>" class="waves-effect"><i class="mdi mdi-flash"></i><span>Expedition</span></a>
                        </li>
                        <li>
                            <a href="<?= base_url('Payment/Index')?>" class="waves-effect"><i class="mdi mdi-coin"></i><span>Payment</span></a>
                        </li>
                    </ul>

                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <div class="container-fluid">
                    <!-- INSERT CONTENT HERE -->
                    <?= $this->renderSection('content'); ?>
                    <!-- INSERT CONTENT HERE -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- content -->

            <footer class="footer">© 2022 Artisan Admin Application.</footer>

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src="<?php echo base_url('public/assets/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('public/assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?php echo base_url('public/assets/js/metismenu.min.js') ?>"></script>
    <script src="<?php echo base_url('public/assets/js/jquery.slimscroll.js') ?>"></script>
    <script src="<?php echo base_url('public/assets/js/waves.min.js') ?>"></script>

    <script src="<?php echo base_url('public/plugins/sweet-alert2/sweetalert2.min.js') ?>"></script>
    <!-- App js -->
    <script src="<?php echo base_url('public/assets/js/app.js') ?>"></script>

    <script>
        $(document).ready(function(){
            $("#btnLogout").click(function(){
                swal({
                    title: 'Confirmation',
                    text: "Are You Sure Want To Log Out?",
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger ml-2',
                    confirmButtonText: 'Confirm!'
                }).then(function () {
                    window.location.href = <?="'".base_url('logout')."'"?>;
                })
            });
        });
    </script>

</body>

</html>