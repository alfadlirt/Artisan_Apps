<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Artisan Website</title>
		<meta name="description" content="Hurst – Furniture Store eCommerce HTML Template is a clean and elegant design – suitable for selling flower, cookery, accessories, fashion, high fashion, accessories, digital, kids, watches, jewelries, shoes, kids, furniture, sports….. It has a fully responsive width adjusts automatically to any screen size or resolution.">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('public/assets-customer/img/favicon.ico') ?>">
		<!-- Place favicon.ico in the root directory -->

		<!-- Google Font -->
		<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>

		<!-- all css here -->
		<!-- bootstrap v5 css -->
		<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/bootstrap.min.css') ?>">
		<!-- animate css -->
		<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/animate.min.css') ?>">
		<!-- jquery-ui.min css -->
		<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/jquery-ui.min.css') ?>">
		<!-- meanmenu css -->
		<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/meanmenu.min.css') ?>">
		<!-- nivo-slider css -->
		<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/lib/css/nivo-slider.css') ?>">
		<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/lib/css/preview.css') ?>">
		<!-- slick css -->
		<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/slick.min.css') ?>">
		<!-- lightbox css -->
		<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/lightbox.min.css') ?>">
		<!-- material-design-iconic-font css -->
		<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/material-design-iconic-font.css') ?>">
		<!-- All common css of theme -->
		<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/default.css') ?>">
		<!-- style css -->
		<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/style.css') ?>">
        <!-- shortcode css -->
        <link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/shortcode.css') ?>">
		<!-- responsive css -->
		<link rel="stylesheet" href="<?php echo base_url('public/assets-customer/css/responsive.css') ?>">
		<!-- modernizr css -->
		<script src="<?php echo base_url('public/assets-customer/js/vendor/modernizr-3.11.2.min.js') ?>"></script>
		<script src="<?php echo base_url('public/assets-customer/js/vendor/jquery-3.6.0.min.js') ?>"></script>
		<script src="<?php echo base_url('public/assets-customer/js/vendor/jquery-migrate-3.3.2.min.js') ?>"></script>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<style>
			.sweet_loader {
				width: 140px;
				height: 140px;
				margin: 0 auto;
				animation-duration: 0.5s;
				animation-timing-function: linear;
				animation-iteration-count: infinite;
				animation-name: ro;
				transform-origin: 50% 50%;
				transform: rotate(0) translate(0,0);
			}
			@keyframes ro {
				100% {
					transform: rotate(-360deg) translate(0,0);
				}
			}
		</style>
	</head>
	<body>
		<!-- WRAPPER START -->
		<div class="wrapper">

			<!-- Mobile-header-top Start -->
			<div class="mobile-header-top d-block d-md-none">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- header-search-mobile start -->
							<div class="header-search-mobile">
								<div class="table">
									<div class="table-cell">
										<ul>
											<li><a class="search-open" href="#"><i class="zmdi zmdi-search"></i></a></li>
											<li><a href="login.html"><i class="zmdi zmdi-lock"></i></a></li>
											<li><a href="my-account.html"><i class="zmdi zmdi-account"></i></a></li>
											<li><a href="wishlist.html"><i class="zmdi zmdi-favorite"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- header-search-mobile start -->
						</div>
					</div>
				</div>
			</div>
			<!-- Mobile-header-top End -->
			<?php
            $session = session();
            $user_name = $session->get('user_name');
            $username = $session->get('user_username');
            $userid = $session->get('user_id');
        ?>
			<!-- HEADER-AREA START -->
			<header id="sticky-menu" class="header">
				<div class="header-area">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-4 offset-md-4 col-7">
								<div class="logo text-md-center">
									<a href="<?=base_url()?>"><img src="<?php echo base_url('public/assets/images/logo-artisan.png')?>" alt="" width="50px"/></a>
								</div>
							</div>
							<div class="col-md-4 col-5">
								<div class="mini-cart text-end">
									<ul>
										<?php if(isset($userid)) :?>
										<li>
											<h6>Hello, <?=$user_name?></h6>
										</li>
										<?php endif ?>
										<li>
											<a class="cart-icon" href="<?=base_url('myaccount')?>">
												<i class="zmdi zmdi-account"></i>
											</a>
											<div class="mini-cart-brief text-left">
												<div class="cart-bottom  clearfix">
													<?php if(isset($userid)) :?>
													<a href="<?=base_url('logout')?>" class="button-one floatleft text-uppercase" data-text="Logout">Logout</a>
													<?php else :?>
													<a href="<?=base_url('login')?>" class="button-one floatleft text-uppercase" data-text="Login">Login</a>
													<?php endif ?>
												</div>
											</div>
										</li>
										<li>
											<a class="cart-icon" href="<?=base_url('mycart')?>">
												<i class="zmdi zmdi-shopping-cart"></i>
												<span id="cartCount">0</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- MAIN-MENU START -->
				<div class="menu-toggle hamburger hamburger--emphatic d-none d-md-block">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</div>
				<div class="main-menu  d-none d-md-block">
					<nav>
						<ul>
							<li><a href="<?=base_url('')?>">home</a></li>
							<li><a href="<?=base_url('product')?>">all products</a></li>
							<li><a href="<?=base_url('mycart')?>">my cart</a></li>
							<li><a href="<?=base_url('myaccount')?>">my account</a></li>
							<li><a href="<?=base_url('myorder')?>">my order</a></li>
						</ul>
					</nav>
				</div>
				<!-- MAIN-MENU END -->
			</header>
			<!-- HEADER-AREA END -->
			<!-- Mobile-menu start -->
			<div class="mobile-menu-area">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 d-block d-md-none">
							<div class="mobile-menu">
								<nav id="dropdown">
									<ul>
										<li><a href="index.html">home</a>
											<ul>
												<li><a href="index.html">Home Version 1</a></li>
												<li><a href="index-2.html">Home Version 2</a></li>
											</ul>
										</li>
										<li><a href="shop.html">products</a></li>
										<li><a href="shop-sidebar.html">accesories</a></li>
										<li><a href="shop-list.html">lookbook</a></li>
										<li><a href="blog.html">blog</a></li>
										<li><a href="#">pages</a>
											<ul>
												<li><a href="shop.html">Shop</a></li>
												<li><a href="shop-sidebar.html">Shop Sidebar</a></li>
												<li><a href="shop-list.html">Shop List</a></li>
												<li><a href="single-product.html">Single Product</a></li>
												<li><a href="single-product-sidebar.html">Single Product Sidebar</a></li>
												<li><a href="cart.html">Shopping Cart</a></li>
												<li><a href="wishlist.html">Wishlist</a></li>
												<li><a href="checkout.html">Checkout</a></li>
												<li><a href="order.html">Order</a></li>
												<li><a href="login.html">login / Registration</a></li>
												<li><a href="my-account.html">My Account</a></li>
												<li><a href="404.html">404</a></li>
												<li><a href="blog.html">Blog</a></li>
												<li><a href="single-blog.html">Single Blog</a></li>
												<li><a href="single-blog-sidebar.html">Single Blog Sidebar</a></li>
												<li><a href="about.html">About Us</a></li>
												<li><a href="contact.html">Contact</a></li>
											</ul>
										</li>
										<li><a href="about.html">about us</a></li>
										<li><a href="contact.html">contact</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Mobile-menu end -->
			<!-- SLIDER-BANNER-AREA START -->

            <!-- INSERT CONTENT HERE -------------------------------->
            <?= $this->renderSection('content'); ?>
            <!-- INSERT CONTENT HERE -------------------------------->


			<!-- FOOTER START -->
			<footer>
				<!-- Footer-area start -->
				<div class="footer-area">
					<div class="container">
						<div class="row justify-content-between">
							<div class="col-lg-4 col-md-6">
								<div class="single-footer">
									<h3 class="footer-title  title-border">Contact Us</h3>
									<ul class="footer-contact">
										<li><span>Address :</span>28 Green Tower, Street Name,<br>Garut City, USA</li>
										<li><span>Cell-Phone :</span>012345 - 123456789</li>
										<li><span>Email :</span>yourfavorite@artisan.com</li>
									</ul>
								</div>
							</div>
							<div class="col-lg-2 col-md-3 col-sm-6">
								<div class="single-footer">
									<h3 class="footer-title  title-border">accounts</h3>
									<ul class="footer-menu">
										<li><a href="<?=base_url('myaccount')?>"><i class="zmdi zmdi-dot-circle"></i>My Account</a></li>
										<li><a href="<?=base_url('mycart')?>"><i class="zmdi zmdi-dot-circle"></i>My Cart</a></li>
										<li><a href="<?=base_url('login')?>"><i class="zmdi zmdi-dot-circle"></i>Sign In</a></li>
										<li><a href="<?=base_url('admin/login')?>"><i class="zmdi zmdi-dot-circle"></i>Admin Portal</a></li>
										<li><a href="<?=base_url('seller/login')?>"><i class="zmdi zmdi-dot-circle"></i>Seller Portal</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Footer-area end -->
				<!-- Copyright-area start -->
				<div class="copyright-area">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<div class="copyright">
									<p class="mb-0">&copy; <a href="#" target="_blank"> Artisan Furniture  </a> 2022. All Rights Reserved.</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="payment  text-md-end">
									<a href="#"><img src="<?php echo base_url('public/assets-customer/img/payment/1.png') ?>" alt="" /></a>
									<a href="#"><img src="<?php echo base_url('public/assets-customer/img/payment/2.png') ?>" alt="" /></a>
									<a href="#"><img src="<?php echo base_url('public/assets-customer/img/payment/3.png') ?>" alt="" /></a>
									<a href="#"><img src="<?php echo base_url('public/assets-customer/img/payment/4.png') ?>" alt="" /></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Copyright-area start -->
			</footer>
			<!-- FOOTER END -->
			<!-- QUICKVIEW PRODUCT -->
			<div id="quickview-wrapper">
			   <!-- Modal -->
			   <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<div class="modal-product">
									<div class="product-images">
										<div class="main-image images">
											<img alt="#" src="<?php echo base_url('public/assets-customer/img/product/quickview-photo.jpg') ?>"/>
										</div>
									</div><!-- .product-images -->

									<div class="product-info">
										<h1>Aenean eu tristique</h1>
										<div class="price-box-3">
											<hr />
											<div class="s-price-box">
												<span class="new-price">$160.00</span>
												<span class="old-price">$190.00</span>
											</div>
											<hr />
										</div>
										<a href="shop.html" class="see-all">See all features</a>
										<div class="quick-add-to-cart">
											<form method="post" class="cart">
												<div class="numbers-row">
													<input type="number" id="french-hens" value="3" min="1">
												</div>
												<button class="single_add_to_cart_button" type="submit">Add to cart</button>
											</form>
										</div>
										<div class="quick-desc">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero.
										</div>
										<div class="social-sharing">
											<div class="widget widget_socialsharing_widget">
												<h3 class="widget-title-modal">Share this product</h3>
												<ul class="social-icons">
													<li><a target="_blank" title="Google +" href="#" class="gplus social-icon"><i class="zmdi zmdi-google-plus"></i></a></li>
													<li><a target="_blank" title="Twitter" href="#" class="twitter social-icon"><i class="zmdi zmdi-twitter"></i></a></li>
													<li><a target="_blank" title="Facebook" href="#" class="facebook social-icon"><i class="zmdi zmdi-facebook"></i></a></li>
													<li><a target="_blank" title="LinkedIn" href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
												</ul>
											</div>
										</div>
									</div><!-- .product-info -->
								</div><!-- .modal-product -->
							</div><!-- .modal-body -->
						</div><!-- .modal-content -->
					</div><!-- .modal-dialog -->
			   </div>
			   <!-- END Modal -->
			</div>
			<!-- END QUICKVIEW PRODUCT -->

		</div>
		<!-- WRAPPER END -->

		<!-- all js here -->
		<!-- jquery latest version -->
		
		<!-- bootstrap js -->
		<script src="<?php echo base_url('public/assets-customer/js/bootstrap.bundle.min.js') ?>"></script>
		<!-- jquery.meanmenu js -->
		<script src="<?php echo base_url('public/assets-customer/js/jquery.meanmenu.js') ?>"></script>
		<!-- slick.min js -->
		<script src="<?php echo base_url('public/assets-customer/js/slick.min.js') ?>"></script>
		<!-- jquery.treeview js -->
		<script src="<?php echo base_url('public/assets-customer/js/jquery.treeview.js') ?>"></script>
		<!-- lightbox.min js -->
		<script src="<?php echo base_url('public/assets-customer/js/lightbox.min.js') ?>"></script>
		<!-- jquery-ui js -->
		<script src="<?php echo base_url('public/assets-customer/js/jquery-ui.min.js') ?>"></script>
		<!-- jquery.nivo.slider js -->
		<script src="<?php echo base_url('public/assets-customer/lib/js/jquery.nivo.slider.js') ?>"></script>
		<script src="<?php echo base_url('public/assets-customer/lib/home.js') ?>"></script>
		<!-- jquery.nicescroll.min js -->
		<script src="<?php echo base_url('public/assets-customer/js/jquery.nicescroll.min.js') ?>"></script>
		<!-- countdon.min js -->
		<script src="<?php echo base_url('public/assets-customer/js/countdon.min.js') ?>"></script>
		<!-- wow js -->
		<script src="<?php echo base_url('public/assets-customer/js/wow.min.js') ?>"></script>
		<!-- plugins js -->
		<script src="<?php echo base_url('public/assets-customer/js/plugins.js') ?>"></script>
		<!-- main js -->
		<script src="<?php echo base_url('public/assets-customer/js/main.js') ?>"></script>
	</body>
</html>
<script>
    $(document).ready(function() {
        var auth = "<?= (isset($userid)) ? $userid : ''; ?>";
        if (auth != '') {
            loadCartCount();
        }
    })

    function loadCartCount() {
        $.ajax({
            type: 'GET',
            url: "<?= base_url('/Shop/CountCart'); ?>",
            beforeSend: function() {

            },
            complete: function() {

            },
            success: function(resp) {
                var data = JSON.parse(resp);
                $('#cartCount').html(data);
            },
            error: function(xhr) {
                alert('error');
            }
        });
    }
</script>
