<?= $this->extend('Layout/_Layout3') ?>

<?= $this->section('content'); ?>
<section class="slider-banner-area clearfix">
				
				<!-- Sidebar-social-media start -->
				<div class="banner-left floatleft">
					<!-- Slider-banner start -->
					<div class="slider-banner">
					<?php foreach ($top2 as $row) : ?>
						<div class="single-banner banner-1">
							<a class="banner-thumb" href="<?=base_url('product/'.$row['slug'])?>">
								<?php if(isset($row['pic_data'])):?>
									<img style="overflow:hidden;width:90%" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['pic_data']); ?>" alt="" />
								<?php else:?>
									<img src="<?php echo base_url('public/assets-customer/img/banner/1.jpg') ?>" alt="" />
								<?php endif?>
							</a>
							<span class="pro-label new-label">new</span>
							<div class="banner-brief">
								<h2 class="banner-title"><a href="<?=base_url('product/'.$row['slug'])?>"><?=$row['name']?></a></h2>
								<p class="mb-0">Rp <?=$row['display_price']?></p>
							</div>
							<a href="<?=base_url('product/'.$row['slug'])?>" class="button-one font-16px" data-text="Buy now">Buy now</a>
						</div>
					<?php endforeach ?>
					</div>
					<!-- Slider-banner end -->
				</div>
				<div class="slider-right floatleft">
					<!-- Slider-area start -->
					<div class="slider-area">
						<div class="bend niceties preview-2">
							<div id="ensign-nivoslider" class="slides">
								<img src="<?php echo base_url('public/assets-customer/img/banner-atas.jpg') ?>" alt="" title="#slider-direction-1"  />
								<img src="<?php echo base_url('public/assets-customer/img/banner-atas2.jpg') ?>" alt="" title="#slider-direction-2"  />
								<img src="<?php echo base_url('public/assets-customer/img/banner-atas3.jpg') ?>" alt="" title="#slider-direction-3"  />
							</div>
							<!-- direction 1 -->
							<div id="slider-direction-1" class="t-cn slider-direction">
								<div class="slider-progress"></div>
								<div class="slider-content t-lfl s-tb slider-1">
									<div class="title-container s-tb-c title-compress">
										<div class="layer-1">
											<div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
												<h2 class="slider-title3 text-uppercase mb-0" >welcome to our</h2>
											</div>
											<div class="wow fadeIn" data-wow-duration="1.5s" data-wow-delay="1.5s">
												<h2 class="slider-title1 text-uppercase mb-0">furniture</h2>
											</div>
											<div class="wow fadeIn" data-wow-duration="2s" data-wow-delay="2.5s">
												<h3 class="slider-title2 text-uppercase" >gallery 2021</h3>
											</div>
											<div class="wow fadeIn" data-wow-duration="2.5s" data-wow-delay="3.5s">
												<a href="#" class="button-one style-2 text-uppercase mt-20" data-text="Shop now">Shop now</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- direction 2 -->
							<div id="slider-direction-2" class="slider-direction">
								<div class="slider-progress"></div>
								<div class="slider-content t-lfl s-tb slider-1">
									<div class="title-container s-tb-c title-compress">
										<div class="layer-1">
											<div class="wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.5s">
												<h2 class="slider-title3 text-uppercase mb-0" >welcome to our</h2>
											</div>
											<div class="wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.5s">
												<h2 class="slider-title1 text-uppercase">furniture</h2>
											</div>
											<div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.5s">
												<p class="slider-pro-brief">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</p>
											</div>
											<div class="wow fadeInUpBig" data-wow-duration="2.5s" data-wow-delay="0.5s">
												<a href="#" class="button-one style-2 text-uppercase mt-20" data-text="Shop now">Shop now</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- direction 3 -->
							<div id="slider-direction-3" class="slider-direction">
								<div class="slider-progress"></div>
								<div class="slider-content t-lfl s-tb slider-1">
									<div class="title-container s-tb-c title-compress">
										<div class="layer-1">
											<div class="wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.5s">
												<h2 class="slider-title3 text-uppercase mb-0" >welcome to our</h2>
											</div>
											<div class="wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.5s">
												<h2 class="slider-title1 text-uppercase mb-0">furniture</h2>
											</div>
											<div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.5s">
												<h3 class="slider-title2 text-uppercase" >gallery 2021</h3>
											</div>
											<div class="wow fadeInUpBig" data-wow-duration="2.5s" data-wow-delay="0.5s">
												<p class="slider-pro-brief">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</p>
											</div>
											<div class="wow fadeInUpBig" data-wow-duration="3s" data-wow-delay="0.5s">
												<a href="#" class="button-one style-2 text-uppercase mt-20" data-text="Shop now">Shop now</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Slider-area end -->
				</div>
				
			</section>
			<!-- End Slider-section -->
		
			<!-- PRODUCT-AREA START -->
			<div class="product-area pt-80 pb-35">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="section-title text-center">
								<h2 class="title-border">Featured Products</h2>
							</div>
							<div class="product-slider style-1 arrow-left-right">
								<!-- Single-product start -->
								<?php foreach ($datalist as $row) : ?>
									<div class="single-product">
										<div class="product-img">
											<span class="pro-label new-label">new</span>
											<a href="<?=base_url('product/'.$row['slug'])?>">
												<?php if(isset($row['pic_data'])):?>
													<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['pic_data']); ?>" alt="" />
												<?php else:?>
													<img src="<?= base_url('public/assets-customer/img/product/6.jpg')?>" alt="" />
												<?php endif?>
											</a>
										</div>
										<div class="product-info clearfix">
											<div class="fix">
												<h4 class="post-title floatleft"><a href="#"><?=$row['name']?></a></h4>
												<p class="floatright hidden-sm">Furniture</p>
											</div>
											<div class="fix">
												<span class="pro-price floatleft">Rp <?=$row['display_price']?></span>
												<span class="pro-rating floatright">
													<a href="#"><i class="zmdi zmdi-star"></i></a>
													<a href="#"><i class="zmdi zmdi-star"></i></a>
													<a href="#"><i class="zmdi zmdi-star"></i></a>
													<a href="#"><i class="zmdi zmdi-star-half"></i></a>
													<a href="#"><i class="zmdi zmdi-star-half"></i></a>
												</span>
											</div>
										</div>
									</div>
									
								<?php endforeach ?>
								<!-- Single-product end -->
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- PRODUCT-AREA END -->
			<!-- PURCHASE-ONLINE-AREA START -->
			<div class="purchase-online-area pt-80">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="section-title text-center">
								<h2 class="title-border">Purchase Online on Artisan</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 text-center">
							<!-- Nav tabs -->
							<ul class="tab-menu nav clearfix">
								<li><a class="active" href="#best-seller"  data-bs-toggle="tab">Best Seller </a></li>
							</ul>
						</div>
						<div class="col-lg-12">
							<!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane active" id="new-arrivals">
									<div class="row">
									<?php foreach ($datalist as $row) : ?>
										<div class="single-product col-xl-3 col-lg-4 col-md-6">
											<div class="product-img">
												<span class="pro-label new-label">new</span>
												<a href="<?=base_url('product/'.$row['slug'])?>">
												<?php if(isset($row['pic_data'])):?>
													<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['pic_data']); ?>" alt="" />
												<?php else:?>
													<img src="<?= base_url('public/assets-customer/img/product/6.jpg')?>" alt="" />
												<?php endif?>
												</a>
												<div class="product-action clearfix">
													<a href="wishlist.html" data-bs-toggle="tooltip" data-placement="top" title="Wishlist"><i class="zmdi zmdi-favorite-outline"></i></a>
													<a href="#" data-bs-toggle="modal"  data-bs-target="#productModal" title="Quick View"><i class="zmdi zmdi-zoom-in"></i></a>
													<a href="#" data-bs-toggle="tooltip" data-placement="top" title="Compare"><i class="zmdi zmdi-refresh"></i></a>
													<a href="cart.html" data-bs-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
												</div>
											</div>
											<div class="product-info clearfix">
												<div class="fix">
													<h4 class="post-title floatleft"><a href="#"><?=$row['name']?></a></h4>
													<p class="floatright hidden-sm">Furniture</p>
												</div>
												<div class="fix">
													<span class="pro-price floatleft">Rp <?=$row['display_price']?></span>
													<span class="pro-rating floatright">
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star-half"></i></a>
														<a href="#"><i class="zmdi zmdi-star-half"></i></a>
													</span>
												</div>
											</div>
										</div>
										
									<?php endforeach ?>
									
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?= $this->endSection('content'); ?>
                