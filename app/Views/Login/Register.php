<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

	<title>Caremed - Signin</title>

	<meta name="keywords" content="Caremed HTML5 Responsive Template Medicine COVID-19 Corona Hospital" />
	<meta name="description" content="Caremed - Hospital HTML5 Responsive Template">
	
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('public/assets-customer/images/favicon.ico')?>">
	
	<!-- Plugins CSS File -->
	<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/plugins/owl.carousel.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/plugins/datepicker.min.css')?>">

	<!-- Main CSS File -->
	<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/sass/style.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/vendor/fontawesome/css/all.min.css')?>">
</head>
<body>
    <!------------------------------------------------
	loading overlay - start
	------------------------------------------------>
	<div class="loading-overlay">
		<div class="bounce-loader">
			<div class="bounce1"></div>
			<div class="bounce2"></div>
			<div class="bounce3"></div>
		</div>
	</div>
	<!------------------------------------------------
	loading overlay - end
	------------------------------------------------>
    <div class="page-wrapper">
        <!------------------------------------------------
	    navigation - start
	    ------------------------------------------------>
        <header class="header header-sign">
            <div class="header-middle header-middle-simple">
                <div class="header-left">
                    <a href="index.html" class="logo">
                        <h1 class="mb-0"><img src="assets/images/logo.png" alt="Caremed Logo" width="185" height="48"></h1>
                    </a>
                </div>
            </div>
        </header>
        <!------------------------------------------------
	    navigation - end
	    ------------------------------------------------>
        <main class="main">
            <!------------------------------------------------
	        login - start
	        ------------------------------------------------>
            <!-- 
                background image is added through css and can be modified in the _sections.scss file
                the image is added to the .bg-section-17 class.
            -->
            <div class="height-100vh login-section position-relative bg-section bg-section-17">
                <form class="sign-form" method="POST" action="<?= base_url('Login/CreateAccount') ?>">
                    <div class="form-heading text-center">
                        <h4 class="sub-title ls-n-20 line-height-1 mb-2">Create Your Account.</h4>
                        <span class="heading-desc">
                            We Keep Your Privacy, Fill This Info To Create Your Account
                        </span>
                    </div>
                    <?php $validation = \Config\Services::validation(); ?>
                    <div class="form-content">
                        <div class="input-group input-light">
                            <h6 class="input-title">Token</h6>
                            <input type="hidden" value="<?=isset($token)?$token:''?>" name="token"/>
                            <p><?=isset($token)?$token:''?></p>
                        </div>
                        <div class="input-group input-light">
                            <h6 class="input-title">First Name</h6>
                            <input value="<?=isset($data)?$data['f_name']:''?>" name="f_name" class="form-control" type="text" required="" id="f_name">
                            <?php if($validation->getError('f_name')) {?>
                                <label style="color:red"><?= $error = $validation->getError('f_name'); ?></label>
                            <?php }?>
                        </div>
                        <div class="input-group input-light">
                            <h6 class="input-title">Last Name</h6>
                            <input value="<?=isset($data)?$data['l_name']:''?>" name="l_name" class="form-control" type="text" required="" id="l_name">
                            <?php if($validation->getError('l_name')) {?>
                                <label style="color:red"><?= $error = $validation->getError('l_name'); ?></label>
                            <?php }?>
                        </div>
                        <div class="input-group input-light">
                            <h6 class="input-title">Email</h6>
                            <input value="<?=isset($data)?$data['email']:''?>" name="email" class="form-control" type="text" required="" id="email">
                            <?php if($validation->getError('email')) {?>
                                <label style="color:red"><?= $error = $validation->getError('email'); ?></label>
                            <?php }?>
                        </div>
                        <div class="input-group input-light">
                            <h6 class="input-title">Username</h6>
                            <input value="<?=isset($data)?$data['username']:''?>" name="username" class="form-control" type="text" required="" id="username">
                            <?php if($validation->getError('username')) {?>
                                <label style="color:red"><?= $error = $validation->getError('username'); ?></label>
                            <?php }?>
                        </div>
                        <div class="input-group input-light">
                            <h6 class="input-title">Password</h6>
                            <input value="<?=isset($data)?$data['password1']:''?>" name="password1" class="form-control" type="password" required="" id="password1">
                            <?php if($validation->getError('password1')) {?>
                                <label style="color:red"><?= $error = $validation->getError('password1'); ?></label>
                            <?php }?>
                        </div>
                        <div class="input-group input-light">
                            <h6 class="input-title">Re-type Password</h6>
                            <input value="<?=isset($data)?$data['password2']:''?>" name="password2" class="form-control" type="password" required="" id="password2">
                            <?php if($validation->getError('password2')) {?>
                                <label style="color:red"><?= $error = $validation->getError('password2'); ?></label>
                            <?php }?>
                        </div>
                        <button type="submit" class="btn btn-form btn-primary-color">
                            <span>Redeem</span>
                        </button>
                        <div class="term-privacy d-flex justify-content-center">
                            <span class="line-height-1">Don't Have Token?</span>
                            <div class="btn-link">
                                <a class="line-height-1" href="signup.html">Buy H-Pass Here</a>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="foreground-img">
					<img src="assets/images/backgrounds/background-1-fore.png" alt="image">					
				</div>
            </div>
            <!------------------------------------------------
	        login - end
	        ------------------------------------------------>
        </main>
    </div>
    <!-- Plugins JS File -->
    
    <script src="<?php echo base_url('public/assets-customer/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('public/assets-customer/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?php echo base_url('public/assets-customer/js/jquery.waypoints.min.js') ?>"></script>
    <script src="<?php echo base_url('public/assets-customer/js/plugins/owl.carousel.min.js') ?>"></script>
    <script src="<?php echo base_url('public/assets-customer/js/plugins/imagesloaded.pkgd.min.js') ?>"></script>
    <script src="<?php echo base_url('public/assets-customer/js/plugins/isotope.pkgd.min.js') ?>"></script>
    
    <!-- Main JS File -->
    <script src="<?php echo base_url('public/assets-customer/js/main.min.js') ?>"></script>
    
</body>
</html>