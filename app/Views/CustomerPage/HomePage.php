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
            <div class="header-middle sticky-header">
                <div class="header-left">
                    <a href="index.html" class="logo">
                        <h1 class="mb-0"><img src="<?php echo base_url('public/assets-customer/images/logo.png')?>" alt="Caremed Logo" width="80" height="48"></h1>
                    </a>
                </div>
                <div class="header-right">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="fal fa-bars"></i>
                    </button>
                    <nav class="main-nav ls-20">
                        <ul class="menu sf-arrows">
                            <li class="megamenu-container active">
                                <a href="index.html">Home</a>
                            </li>
                            <li>
                                <a href="how-it-works.html">About</a>
                            </li>
							<li>
                                <a href="how-it-works.html">Top Products</a>
                            </li>
                            <li>
                                <a href="treatments.html">Timeline</a>
                            </li>
                            <li>
                                <a href="membership.html">NFT Catalog</a>
                            </li>
							
                        </ul><!-- End .menu -->
						
                    </nav><!-- End .main-nav -->
					<?php
						$username = session()->get('username');
						$name = session()->get('name');
						?>
						<?php if(isset($username)&&isset($name)):?>
							<a href="<?=base_url('my-robot')?>" class="btn btn-sm btn-primary-color ls-0">
								<span>My Robot</span>
							</a>
							<ul class="submenu">
								<li><a href="#"><span><?=$username?></span></a>
								<ul class="dropdown">
									<li><a href="#">My Account</a></li>
									<li><a href="<?=base_url('Logout')?>">Logout</a></li>
								</ul>
								</li>
							</ul>
							
						<?php else: ?>
							<ul class="submenu">
								<li>
									<a href="<?=base_url('login')?>" class="btn btn-sm btn-secondary-color ls-0 btn-login">	
										<span>Login</span>	
									</a>
								</li>
							</ul>
						<?php endif ?>
                </div>
            </div>
        </header>
		<!------------------------------------------------
		navigation - end
		------------------------------------------------>
		<main class="main">
			<!------------------------------------------------
			hero slider - start
			------------------------------------------------>
			<div class="intro-slider intro-slider-1 owl-carousel owl-theme owl-nav-inside owl-light slide-animate mb-0" data-toggle="owl" data-owl-options='{
					"dots": false,
					"nav": false, 
					"responsive": {
						"1200": {
							"nav": true
						}
					}
				}'>
				<!-- 
					background image is added through css and can be modified in the _sections.scss file
					the image is added to the .bg-section-1 class.
				-->
				<div class="banner intro-slide bg-section bg-section-1">
					<div class="container">
						<div class="banner-content">
							<h1 class="banner-title">
								WHY MUST BUY H-BOT & Their H-Pass
							</h1>
							<p class="banner-info">
								H-bot is a robot that can assist you when doing
								thing and also become your pet. H-Bot contain a
								lifesaver thing too.Imagine, a cute robot pet
								that not also become pet but also become your
								lifesaver. H-Bot need H-Pass to run. However H-Pass can become collectible game card too. Come join and buy us for more.</p>
							<div class="banner-actions">
								<a href="appointment-step1.html" class="btn btn-secondary-color">
									<span>Buy H-Pass</span>
								</a>
								<a href="how-it-works.html" class="btn">
									<span>Learn More</span>
								</a>
							</div>
						</div>
						<div class="foreground-img">
							<img src="<?php echo base_url('public/assets-customer/images/demos/demo-1/banner/banner-hero-1-fore.png')?>" alt="Banner-slide">
						</div>
					</div>
				</div>
				<!-- 
					background image is added through css and can be modified in the _sections.scss file
					the image is added to the .bg-section-2 class.
				-->
				<div class="banner intro-slide bg-section bg-section-2">
					<div class="container">
						<div class="banner-content">
							<h1 class="banner-title">
								Doctors who treat with care.
							</h1>
							<p class="banner-info">
									Our skilled doctors have tremendous experience with wide
									range of diseases to serve the needs of our patients.</p>
							<div class="banner-actions">
								<a href="appointment-step1.html" class="btn btn-secondary-color">
									<span>Buy H-Pass</span>
								</a>
								<a href="how-it-works.html" class="btn">
									<span>Learn More</span>
								</a>
							</div>
						</div>
						<div class="foreground-img">
							<img src="<?php echo base_url('public/assets-customer/images/demos/demo-1/banner/banner-hero-2-fore.png')?>" alt="Banner-slide">
						</div>
					</div>
				</div>
			</div>
			<!------------------------------------------------
			hero slider - end
			------------------------------------------------>
			<!------------------------------------------------
			schedule section - start
			------------------------------------------------>
			<div class="type-section type-section-margin-bottom bg-section bg-section-3">
				<div class="container">
					<div class="row position-relative">
						<img src="<?php echo base_url('public/assets-customer/images/puzzle-heraio.png')?>" class="puzzle pr-0 pl-0" alt="Puzzle" width="160" height="217">
						<div class="col-lg-5 offset-lg-0 col-md-8 col-sm-8 offset-sm-2 col-10 offset-1">
							<div class="widget">
								<h4 class="widget-title"><i class="far fa-clock"></i>About Heraio</h4>
								<p class="widget-desc">
									Heraio is Jakarta based medical corporation that produce robots to monitor people health. This corporation esthablished in 2022.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!------------------------------------------------
			schedule section - end
			------------------------------------------------>
			<!------------------------------------------------
			disease section - start
			------------------------------------------------>
			<div class="container disease-section">
				<div class="row d-flex justify-content-center">
					<div class="col-lg-12 col-md-8 col-sm-8 col-10">
						<h2 class="ls-n-20 text-center section-heading">Quality care for you and the ones you love.</h2>
					</div>
				</div>
				<div class="blog-slider row d-flex justify-content-center">
					<div class="col-lg-4 col-md-8 col-sm-8 col-10">
						<div class="card">
							<div class="card-heading">
								<figure>
									<i class="fal fa-head-side-cough"></i>
								</figure>
								<h4 class="card-title">4DAM<br>H-BOT</h4>
							</div>
							<div class="card-content">
								<ul class="card-menu ls-20">
									<li class="menu-item"><i class="far fa-caret-right"></i><a href="treatments.html" class="item-link">Offline</a></li>
									<li class="menu-item"><i class="far fa-caret-right"></i><a href="treatments.html" class="item-link">Learn New</a></li>
								</ul>
								<div class="btn-link">
									<a href="departments-1.html">Learn More</a><i class="far fa-caret-right"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-8 col-sm-8 col-10">
						<div class="card">
							<div class="card-heading">
								<figure>
									<i class="fal fa-lungs"></i>
								</figure>
								<h4 class="card-title">1D21S<br>H-BOT</h4>
							</div>
							<div class="card-content">
								<ul class="card-menu ls-20">
									<li class="menu-item"><i class="far fa-caret-right"></i><a href="treatments.html" class="item-link">Online</a></li>
									<li class="menu-item"><i class="far fa-caret-right"></i><a href="treatments.html" class="item-link">Can Write</a></li>
									<li class="menu-item"><i class="far fa-caret-right"></i><a href="treatments.html" class="item-link">Medical Warning</a></li>
									<li class="menu-item"><i class="far fa-caret-right"></i><a href="treatments.html" class="item-link">Environment Warning</a></li>
								</ul>
								<div class="btn-link">
									<a href="departments-1.html">Learn More</a><i class="far fa-caret-right"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-8 col-sm-8 col-10">
						<div class="card">
							<div class="card-heading">
								<figure>
									<i class="fal fa-heartbeat"></i>
								</figure>
								<h4 class="card-title">N04H<br>H-BOT</h4>
							</div>
							<div class="card-content">
								<ul class="card-menu ls-20">
									<li class="menu-item"><i class="far fa-caret-right"></i><a href="treatments.html" class="item-link">Online</a></li>
									<li class="menu-item"><i class="far fa-caret-right"></i><a href="treatments.html" class="item-link">Weather Prediction</a></li>
									<li class="menu-item"><i class="far fa-caret-right"></i><a href="treatments.html" class="item-link">Medical Warning</a></li>
									<li class="menu-item"><i class="far fa-caret-right"></i><a href="treatments.html" class="item-link">Environment Warning</a></li>
								</ul>
								<div class="btn-link">
									<a href="departments-1.html">Learn More</a><i class="far fa-caret-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<!------------------------------------------------
			disease section - end
			------------------------------------------------>
			<!------------------------------------------------
			types section - start
			------------------------------------------------>
			<!-- 
				background image is added through css and can be modified in the _sections.scss file
				the image is added to the .bg-section-3 class.
			-->
			<div class="type-section type-section-margin-bottom bg-section bg-section-3">
				<div class="container-wrapper">
					<div class="container position-relative">
						<div class="row">
							<div class="col-lg-12 offset-lg-0 col-md-8 col-sm-8 offset-sm-2 col-10 offset-1">
								<div class="banner-content">
									<div class="banner-content-wrapper">
										<div class="banner-heading">
											<h2 class="banner-title">
												Heraio Timeline
											</h2>
											<p class="banner-info">We provide futuristic H-Bot Soon.</p>
										</div>
									</div>
									<div>

									</div>
								</div>
							</div>
							<div class="col-lg-12 offset-lg-0 col-md-8 col-sm-8 offset-sm-2 col-10 offset-1">
								<div class="banner-content">
									<img width="90%" src="<?php echo base_url('public/assets-customer/images/heraio-timeline.png')?>">
								</div>
							</div>
						</div>
					</div>
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
								<img src="<?php echo base_url('public/assets-customer/images/heraio-logo-hor.png')?>" alt="Caremed Logo" width="185" height="48">
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