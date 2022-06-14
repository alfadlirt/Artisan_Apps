<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

	<title>Heraio Website</title>

	<meta name="keywords" content="Heraio Front Web"/>
	<meta name="description" content="Heraio Front Web">
		
	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?php echo base_url('public/assets-customer/images/favicon.ico')?>">
	
	<!-- Plugins CSS File -->
	<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/plugins/owl.carousel.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/plugins/datepicker.min.css')?>">

	<!-- Main CSS File -->
	<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/sass/style.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/vendor/fontawesome/css/all.min.css')?>">
	
</head>
<style>
	.rankIcon {
	color: #5e616c;
    font-weight: 800;
	padding: 40px;
	width: 20px;
	height: 20px;
	position: absolute;
	left: -17px;
	top: -45px;
	font-size:30px;
	}
	.submenu {
	list-style: none;
	margin: 0;
	padding-left: 0;
	}

	.submenu li {
	color: #fff;
	display: block;
	float: left;
	padding: 1rem;
	position: relative;
	text-decoration: none;
	transition-duration: 0.5s;
	}
	
	.submenu li a {
	color: #fff;
	}

	.submenu li:hover,
	li:focus-within {
	background: #23e2a4;
	cursor: pointer;
	}

	.submenu li:focus-within a {
	outline: none;
	}

	.submenu li ul {
	visibility: hidden;
	opacity: 0;
	min-width: 5rem;
	position: absolute;
	transition: all 0.5s ease;
	margin-top: 1rem;
	left: 0;
	display: none;
	}

	.submenu li:hover > ul,
	.submenu li:focus-within > ul,
	.submenu li ul:hover,
	.submenu li ul:focus {
	visibility: visible;
	opacity: 1;
	display: block
	}

	.submenu li ul li {
	clear: both;
	width: 100%;
	}
</style>
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
		<header class="header">
            <div class="header-top">
                <div class="container-fluid">
                    <div class="header-left">
                        <ul class="top-menu top-link-menu">
                            <li><a href="tel:#" class="link-phone"><i class="fas fa-phone"></i>+(62) 88291352</a></li>
                            <li><a href="#" class="link-email"><i class="fas fa-envelope-open"></i>contact@heraio.com</a></li>
                        </ul>
                    </div>
                    <div class="header-right">
                        <ul class="top-menu">
                            <li><a href="#" class="social-link"><i class="fab fa-twitter"></i>Twitter</a></li>
                            <li><a href="#" class="social-link"><i class="fab fa-facebook"></i>Facebook</a></li>
                            <li><a href="#" class="social-link"><i class="fab fa-youtube"></i>Youtube</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
            <div class="header-middle">
				<?php
					$username = session()->get('username');
					$name = session()->get('name');
				?>
                <div class="header-left">
					<a href="<?=base_url('my-robot')?>" class="btn btn-sm btn-primary-color ls-0">
						<span>Home</span>
					</a>
                </div>
                <div class="header-right">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="fal fa-bars"></i>
                    </button>
                    <nav class="main-nav ls-20">
						<?php if(isset($username)&&isset($name)):?>
							<ul class="submenu">
								<li><a href="#"><span><?=$username?></span></a>
								<ul class="dropdown">
									<li><a href="#">My Account</a></li>
									<li><a href="<?=base_url('Logout')?>">Logout</a></li>
								</ul>
								</li>
							</ul>
						<?php else: ?>
							<a href="<?=base_url('login')?>" class="btn btn-sm btn-secondary-color ls-0 btn-login">	
								<span>Login</span>	
							</a>
						<?php endif ?>
                    </nav><!-- End .main-nav -->
					
                </div>
            </div>
        </header>
		<!------------------------------------------------
		navigation - end
		------------------------------------------------>
		<main class="main">
			<div class="type-section type-section-margin-bottom bg-section bg-section-3">
				<div class="container">
					<div class="row position-relative">
						<div class="col-lg-7 offset-lg-0 col-md-7 col-sm-8 offset-sm-2 col-10 offset-1">
							<div class="widget">
								<h4 class="widget-title"><i class="far fa-robot"></i>My Robot</h4>
								
								<span style="color:white;font-weight:400;border-radius: 35px;background-color:#23e2a4;justify-content: center;text-align: center;padding: 0.9rem 3.7rem;">4D4M BOT</span>
								<div style="margin-top:20px;display:block;color:white">
								<span>Power : 900 Pts</span><br>
								<span>Intelligence : 900 Pts</span><br>
								<span>Agility : 900 Pts</span>
								</div>
							</div>
						</div>
						<div class="col-lg-5 offset-lg-0 col-md-8 col-sm-8 offset-sm-2 col-10 offset-1">
							<div class="widget">
								<h4 class="widget-title"><i class="far fa-fire"></i>Powerups</h4>
								<div class="col-lg-12 col-sm-8 col-10">
									<div>
										<form action="<?=base_url('Powerup/TokenAuthentication')?>" method="POST">
										<div class="filter-item">
											<div class="input-group input-light">
												<input type="text" name="token" class="form-control" placeholder="Powerup Token">
											</div>
										</div>
										<?php if(isset($status)&&$status=='success'):?>
											<div class="input-group input-light">
											<div class="col-12">
												<div class="alert alert-success" role="alert">
												<?=$msg?>
												</div>
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
										<button type="button" id="btnRedeem" data-href="<?=base_url('Powerup/TokenAuthentication')?>" class="btn btn-form btn-primary-color">
											<span>Redeem</span>
										</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bg-section bg-section-4 type-section type-section-2" style="background:#2f3136">
				<div class="container-wrapper">
					<div class="container">
						<div class="banner-content">
							<div class="row">
								<div class="col-lg-12 offset-lg-0 col-md-8 col-sm-8 offset-sm-2 col-10 offset-1">
									<div class="banner-content-wrapper">
										<h2 class="banner-title">
											H-Pass Leaderboard
										</h2>
										<p class="banner-info">
											Our mission it to improve the world’s health through compassionate and afforable care through innovation.
										</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 offset-lg-0 col-md-8 col-sm-8 offset-sm-2 col-10 offset-1">
									<div class="rankIcon">#1</div>
									<div class="icon-box icon-box-left">
										<figure>
											<i class="fal fa-robot"></i>
										</figure>
										<div class="icon-box-content">
											<h4 class="box-title">afifriob</h4>
											<div class="box-title" style="font-weight:200">
											<span style="display:block">Power : 900</span>
											<span style="display:block">Intelligence : 900</span>
											<span style="display:block">Agility : 500</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 offset-lg-0 col-md-8 col-sm-8 offset-sm-2 col-10 offset-1">
									<div class="rankIcon">#2</div>
									<div class="icon-box icon-box-left">
										<figure>
											<i class="fal fa-robot"></i>
										</figure>
										<div class="icon-box-content">
											<h4 class="box-title">mhmmdasr</h4>
											<div class="box-title" style="font-weight:200">
											<span style="display:block">Power : 900</span>
											<span style="display:block">Intelligence : 800</span>
											<span style="display:block">Agility : 500</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 offset-lg-0 col-md-8 col-sm-8 offset-sm-2 col-10 offset-1">
									<div class="rankIcon">#3</div>
									<div class="icon-box icon-box-left">
										<figure>
											<i class="fal fa-robot"></i>
										</figure>
										<div class="icon-box-content">
											<h4 class="box-title">siarantero</h4>
											<div class="box-title" style="font-weight:200">
											<span style="display:block">Power : 800</span>
											<span style="display:block">Intelligence : 800</span>
											<span style="display:block">Agility : 400</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 offset-lg-0 col-md-8 col-sm-8 offset-sm-2 col-10 offset-1">
									<div class="rankIcon">#77</div>
									<div class="icon-box icon-box-left" style="background-color: #23e2a4;">
										<figure>
											<i class="fal fa-robot"></i>
										</figure>
										<div class="icon-box-content">
											<h4 class="box-title">mafiatimes123</h4>
											<div class="box-title" style="font-weight:200">
											<span style="display:block">Power : 600</span>
											<span style="display:block">Intelligence : 600</span>
											<span style="display:block">Agility : 300</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 offset-lg-0 col-md-8 col-sm-8 offset-sm-2 col-10 offset-1">
									<div class="rankIcon">#99</div>
									<div class="icon-box icon-box-left">
										<figure>
											<i class="fal fa-robot"></i>
										</figure>
										<div class="icon-box-content">
											<h4 class="box-title">maniacnft</h4>
											<div class="box-title" style="font-weight:200">
											<span style="display:block">Power : 500</span>
											<span style="display:block">Intelligence : 600</span>
											<span style="display:block">Agility : 300</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 offset-lg-0 col-md-8 col-sm-8 offset-sm-2 col-10 offset-1">
									<div class="rankIcon">#100</div>
									<div class="icon-box icon-box-left">
										<figure>
											<i class="fal fa-robot"></i>
										</figure>
										<div class="icon-box-content">
											<h4 class="box-title">alfadlirt</h4>
											<div class="box-title" style="font-weight:200">
											<span style="display:block">Power : 400</span>
											<span style="display:block">Intelligence : 300</span>
											<span style="display:block">Agility : 200</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 offset-lg-0 col-md-8 col-sm-8 offset-sm-2 col-10 offset-1">
									<div class="banner-actions">
										<a href="https://opensea.io/" target="_blank" class="btn btn-primary-color">
											<span>Buy Powerups</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="foreground-img">
					<img src="assets/images/demos/demo-1/banner/banner-big-2-fore.png" alt="image">					
				</div>
			</div>
		</main>
		<!------------------------------------------------
		footer - start
		------------------------------------------------>
		<footer class="footer">
			<div class="container">
				<div class="footer-top">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="col-lg-6 col-sm-7 col-10">
							<a href="index.html" class="logo">
								<img src="<?= base_url('public/assets-customer/images/heraio-logo-hor.png')?>" alt="Caremed Logo" width="185" height="48">
							</a>
						</div>
						<div class="col-lg-6 col-sm-7 col-10 d-lg-flex justify-content-lg-end">
							<div class="social-links">
								<a href="#" class="social-link"><i class="fab fa-twitter"></i><span>Twitter</span></a>
								<a href="#" class="social-link"><i class="fab fa-facebook"></i><span>Facebook</span></a>
								<a href="#" class="social-link"><i class="fab fa-youtube"></i><span>Youtube</span></a>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-middle">
					<div class="container">
						<div class="row d-flex justify-content-center">
							<div class="col-lg-4 col-sm-7 col-10">
								<div class="info-box">
									<h6 class="info-title">Company</h6>
									<ul class="info-list">
										<li><a href="#" class="info-link">About</a></li>
										<li><a href="#" class="info-link">Our Doctors</a></li>
										<li><a href="#" class="info-link">Latest Blog</a></li>
										<li><a href="#" class="info-link">Careers</a></li>
										<li><a href="#" class="info-link">Contact</a></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-4 col-sm-7 col-10">
								<div class="info-box">
									<h6 class="info-title">Support</h6>
									<ul class="info-list">
										<li><a href="#" class="info-link">Reviews</a></li>
										<li><a href="#" class="info-link">FAQs</a></li>
										<li><a href="#" class="info-link">Help Center</a></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-4 col-sm-7 col-10">
								<div class="info-box">
									<h6 class="info-title">Legal</h6>
									<ul class="info-list">
										<li><a href="#" class="info-link">Term of use</a></li>
										<li><a href="#" class="info-link">Code of Conduct</a></li>
										<li><a href="#" class="info-link">Privacy Policy</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-bottom">
					<div class="row d-flex justify-content-center">
						<div class="col-lg-12 col-sm-7 col-10">
							<p>© Heraio Corporation</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!------------------------------------------------
		footer - end
		------------------------------------------------>
	</div>
	<button id="scroll-top" title="Back to Top"><i class="fal fa-angle-up"></i></button>
	
	

    <div class="mobile-menu-overlay"></div>

	<div class="mobile-menu-container mobile-menu-light">
		<div class="mobile-menu-wrapper">
			<span class="mobile-menu-close"><i class="fal fa-times"></i></span>

			<div class="input-group input-light input-search mt-2">
				<input type="text" class="form-control search-control border-none mr-1 ml-1" placeholder="search">
				<button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
			</div>
			
			<nav class="mobile-nav mt-3">
				<ul class="mobile-menu">
					<li>
						<a href="#"  class="sf-with-ul">Home Pages</a>

						<ul>
							<li><a href="index.html">Home 1</a></li>
							<li><a href="index-2.html">Home 2</a></li>
							<li><a href="index-3.html">Home 3</a></li>
							<li><a href="index-4.html">Home 4</a></li>
							<li><a href="index-5.html">Home 5</a></li>
							<li><a href="index-6.html">Home 6</a></li>
							<li><a href="index-7.html">Home 7</a></li>
						</ul>
					</li>
					<li>
						<a href="#" class="sf-with-ul">Standard Pages</a>
						<ul>
							<li><a href="about.html">About Us</a></li>
							<li><a href="doctors.html">Our Doctors</a></li>
							<li><a href="doctors-detailed.html">Doctor (Detailed)</a></li>
							<li><a href="departments-1.html">Departments (Style 01)</a></li>
							<li><a href="departments-2.html">Departments (Style 02)</a></li>
							<li><a href="departments-detailed.html">Departments (Detailed)</a></li>
							<li><a href="treatments.html">Treatments</a></li>
							<li><a href="how-it-works.html">How it Works</a></li>
							<li><a href="help.html">Help</a></li>
							<li><a href="help-questions.html">Help Questions</a></li>
							<li><a href="membership.html">Membership</a></li>
							<li><a href="reviews.html">Reviews</a></li>
							<li><a href="contact-us.html">Contact</a></li>
						</ul>
					</li>
					<li>
						<a href="#" class="sf-with-ul">Blog Pages</a>
						<ul>
							<li><a href="blog-masonry.html">Blog Masonry</a></li>
							<li><a href="blog-right-sidebar.html">Blog Masonry (Right Sidebar)</a></li>
							<li><a href="blog-left-sidebar.html">Blog Masonry (Left Sidebar)</a></li>
							<li><a href="blog-detailed.html">Blog Detailed</a></li>
							<li><a href="blog-detailed-sidebar.html">Blog Detailed Sidebar</a></li>
						</ul>
					</li>
					<li>
						<a href="#" class="sf-with-ul">Appointments</a>
						<ul>
							<li><a href="appointment-step1.html">Appointment (Step01)</a></li>
							<li><a href="appointment-step2.html">Appointment (Step02)</a></li>
							<li><a href="appointment-step3.html">Appointment (Step03)</a></li>
							<li><a href="appointment-step4.html">Appointment (Step04)</a></li>
						</ul>
					</li>
					<li>
						<a href="#" class="sf-with-ul">Login Pages</a>
						<ul>
							<li><a href="login.html">Signin</a></li>
							<li><a href="signup.html">Signup</a></li>
						</ul>
					</li>
				</ul>
			</nav>

			<div class="social-icons mt-6">
				<a href="#" class="social-icon" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
				<a href="#" class="social-icon" target="_blank" title="Facebook"><i class="fab fa-facebook"></i></a>
				<a href="#" class="social-icon" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a>
			</div>

			
		</div>
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