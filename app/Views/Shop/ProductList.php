<?= $this->extend('Layout/_Layout3') ?>

<?= $this->section('content'); ?>
<div class="product-area pt-80 pb-80 product-style-2">
	<div class="container">
		<!-- Shop-Content End -->
		<div class="shop-content">
			<div class="row">
				<div class="col-md-12" style="margin-bottom:90px;">
					<div class="product-option mb-30 clearfix">
						<form method="GET" action="<?=base_url('Shop/ProductList');?>">
						<label>Search Product</label>
						<input type="text" placeholder="Search...." name="keyword" value="<?=($searchform)? $searchform['keyword']: ''?>"/>							
						<button type="submit" class="btn btn-secondary" text="Search">Search</button>
						</form>
					</div>						
				</div>
				<div class="col-md-12">
					<div class="product-option mb-30 clearfix">
						<!-- Categories start -->
						<div class="dropdown floatleft">
							<button class="option-btn" >
							Categories
							</button>
							<div class="dropdown-menu dropdown-width" >
								<!-- Widget-Categories start -->
								<aside class="widget widget-categories">
									<div class="widget-title">
										<h4>Categories</h4>
									</div>
									<div id="cat-treeview"  class="widget-info product-cat boxscrol2">
										<ul>
											<?php foreach ($category as $row) : ?>
											<li><span><?=$row['ktg_name']?></span></li>
											<?php endforeach ?>
										</ul>
									</div>
								</aside>
								<!-- Widget-categories end -->
							</div>
						</div>	
						<!-- Categories end -->
						<div class="showing text-end">
							<p class="mb-0 d-none d-md-block">Showing 01-10 of 17 Results</p>
						</div>
					</div>						
				</div>	
				<div class="col-md-12">
					<div class="row">
					<?php foreach ($datalist as $row) : ?>
						<!-- Single-product start -->
						<div class="col-xl-3 col-md-4">
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
								<div class="product-info clearfix text-center">
									<div class="fix">
										<h4 class="post-title"><a href="<?=base_url('product/'.$row['slug'])?>"><?=$row['name']?></a></h4>
									</div>
									<div class="fix">
										<label class="muted-text">Rp <?=$row['display_price']?></label>
									</div>
									<div class="fix">
										<span class="pro-rating">
											<a href="#"><i class="zmdi zmdi-star"></i></a>
											<a href="#"><i class="zmdi zmdi-star"></i></a>
											<a href="#"><i class="zmdi zmdi-star"></i></a>
											<a href="#"><i class="zmdi zmdi-star-half"></i></a>
											<a href="#"><i class="zmdi zmdi-star-half"></i></a>
										</span>
									</div>
									<div class="product-action clearfix">
										<a style="width:50%" href="cart.html" data-bs-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i> Add To Cart</a>
									</div>
								</div>
							</div>
						</div>
						<!-- Single-product end -->
						<?php endforeach ?>
					</div>
				</div>
				<div class="col-md-12">
					<div style="margin-top:100px">
						<?= $pager->links('default', 'paginationTemplate2'); ?>
					</div>
					<!-- Pagination start -->
					<div class="shop-pagination  text-center">
						
					</div>
					<!-- Pagination end -->
				</div>
			</div>
		</div>
		<!-- Shop-Content End -->
	</div>
</div>
<?= $this->endSection('content'); ?>
                