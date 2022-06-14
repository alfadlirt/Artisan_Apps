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
                <form class="sign-form" method="POST" action="<?= base_url('Login/TokenAuthentication') ?>">
                    <div class="form-heading text-center">
                        <h4 class="sub-title ls-n-20 line-height-1 mb-2">Redeem Token.</h4>
                        <span class="heading-desc">
                            Redeem The Token You Got From OpenSea
                        </span>
                    </div>
                    <div class="form-content">
                        <div class="input-group input-light">
                            <h6 class="input-title">Token</h6>
                            <input value="<?=isset($data)?$data['token']:''?>" name="token" class="form-control" type="text" required="" id="token">
                        </div>
                        <?php if(isset($status)&&$status=='success'):?>
                            <div class="input-group input-light">
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                <?=$msg?>
                                </div>
                                <a class="line-height-1" href="<?=base_url('register?token='.$data['token'])?>">Create Account Here</a>
                                <span class="heading-desc">
                                    Or
                                </span>
                                <button type="button" class="line-height-1">Add H-Pass To Existing Account</button>
                            </div>

                            </div>
                        <?php elseif(isset($status)&&$status=='failed'):?>
                            <div class="input-group input-light">
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                <?=$msg?>
                                </div>
                            </div>
                            </div>
                        <?php endif?>
                        <button type="submit" class="btn btn-form btn-primary-color">
                            <span>Redeem</span>
                        </button>
                        <div class="term-privacy d-flex justify-content-center">
                            <span class="line-height-1">Don't Have Token?</span>
                            <div class="btn-link">
                                <a class="line-height-1" href="https://opensea.io/" target="_blank">Buy H-Pass Here</a>
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