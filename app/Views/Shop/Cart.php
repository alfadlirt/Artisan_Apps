<?= $this->extend('Layout/_Layout3') ?>

<?= $this->section('content'); ?>
<div class="heading-banner-area overlay-bg">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="heading-banner">
								<div class="heading-banner-title">
									<h2>Shopping Cart</h2>
								</div>
								<div class="breadcumbs pb-15">
									<ul>
										<li><a href="<?=base_url()?>">Home</a></li>
										<li>Shopping Cart</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- HEADING-BANNER END -->
			<!-- SHOPPING-CART-AREA START -->
			<div class="shopping-cart-area  pt-80 pb-80">
				<div class="container">	
					<div class="row">
						<div class="col-lg-12">
							<div class="shopping-cart">
								<!-- Nav tabs -->
								<ul class="cart-page-menu nav row clearfix mb-30">
									<li><a class="active" href="<?=base_url('myaccount')?>" data-bs-toggle="tab">shopping cart</a></li>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									<!-- shopping-cart start -->
										<form method="post" action="<?= base_url('checkout') ?>">
											<div class="shop-cart-table">
												<div class="table-content table-responsive">
													<table>
														<thead>
															<tr>
																<th class="product-thumbnail">Product</th>
																<th class="product-price">Price</th>
																<th class="product-quantity">Quantity</th>
																<th class="product-subtotal">Total</th>
																<th class="product-remove">Remove</th>
															</tr>
														</thead>
														<tbody>
                                                            <?php 
                                                            $subtotal = 0;
                                                            ?>
                                                        <?php if(sizeof($data)!=0):?>
                                        <?php foreach ($data as $row) :
                                        ?>
															<tr>
																<input type="hidden" class="cart_id" value="<?=$row['crt_id']?>"/>
																<td class="product-thumbnail text-left">
																	<!-- Single-product start -->
																	<div class="single-product">
																		<div class="product-img">
																			<a href="<?=base_url('product/'.$row['slug'])?>">
																				<?php if(isset($row['pic_data'])):?>
																					<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['pic_data']); ?>" alt="" />
																				<?php else:?>
																					<img src="img/product/2.jpg" alt="" />
																				<?php endif?>
																			</a>
																		</div>
																		<div class="product-info">
																			<h4 class="post-title"><a class="text-light-black" href="<?=base_url('product/'.$row['slug'])?>"><?=$row['name']?></a></h4>
																			<p class="mb-0">Variation : <?=$row['variation_name']?></p>
																		</div>
																	</div>
																	<!-- Single-product end -->												
																</td>
																<td class="product-price">Rp <?=$row['price']?></td>
																<td class="product-quantity">
																	<div class="cart-plus-minus">
																		<input type="text" value="<?=$row['qty']?>" class="cart-plus-minus-box quantity">
																	</div>
																</td>
                                                                <?php 
                                                                $tt = $row['qty']*$row['price'];
                                                                $subtotal += $tt;
                                                                ?>
																<td class="product-subtotal">Rp <?=$tt?></td>
																<td class="product-remove">
																	<a href="#" class="btnRemove"><i class="zmdi zmdi-close"></i></a>
																</td>
                                                                <input type="hidden" class="price" value="<?=$row['price']?>"/>
															</tr>
                                                            <?php
                                        endforeach
                                        ?>
                                    <?php else :?>
                                        <tr>
                                            <td colspan="8" align="center">
                                                No Items
                                            </td>
                                        </tr>
                                    <?php endif ?>
														</tbody>
													</table>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="customer-login mt-30">
														<h4 class="title-1 title-border text-uppercase">Voucher discount</h4>
														<p class="text-gray">Enter your voucher code if you have one!</p>
                                                        <input type="hidden" id="voucherhdn" name="voucher" value="0">
														<input type="text" placeholder="Enter your code here." id="voucherinput">
														<?php if(sizeof($data)!=0):?>
														<button id="applyBtn" type="button" data-text="apply voucher" class="button-one submit-button mt-15">apply voucher</button>
														<?php endif?>
													</div>
												</div>
												<div class="col-md-6">
													<div class="customer-login payment-details mt-30">
														<h4 class="title-1 title-border text-uppercase">payment details</h4>
                                                        
														<table>
                                                            <input type="hidden" id="subtotal" value="<?=$subtotal?>"/>
															<tbody>
                                                                <tr>
																	<td class="text-left">Cart Subtotal</td>
																	<td class="text-end">Rp <?=$subtotal?></td>
																</tr>
                                                                <tr>
																	<td class="text-left">Discount</td>
																	<td class="text-end" id="lblDiscount">Rp 0</td>
																</tr>
																<tr>
																	<td class="text-left">Total</td>
																	<td class="text-end" id="lblSubtotal">Rp <?=$subtotal?></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
                                            <div class="row">
                                                <div class="col-md-6">
												</div>
												<div class="col-md-6">
                                                    <div class="customer-login payment-details mt-30">
													<?php if(sizeof($data)!=0):?>
                                                    <button type="submit" data-text="Checkout Order" class="button-one submit-button mt-15">Checkout Order</button>
													<?php endif?>
                                                    </div>
												</div>
                                            </div>
										</form>		
									<!-- shopping-cart end -->
									
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
<script>
	$(document).ready(function(){
		var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
		$(document).on('click', '.btnRemove', function() {
            var id = $(this).parent().closest('tr').find('.cart_id').val();

            var item = {
                'cartid': id
            };
			
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						type: 'POST',
						url: "<?= base_url('/Shop/deleteFromCart'); ?>",
						data: item,
						xhr: function() {
								var xhr = $.ajaxSettings.xhr();
								xhr.upload.onprogress = function(e) {
								Swal.fire({
									html: '<h4>Loading...</h4>',
									onRender: function() {
										$('.Swal2-content').prepend(sweet_loader);
									}
								});
							};
							return xhr;
						},
						success: function(resp) {
							var data = JSON.parse(resp);
							console.log(data);
							if(data == 'success') {
								Swal.fire({
									icon: 'success',
									html: '<h4>Success!</h4>'
								});
								setTimeout(function() {
									window.location = "<?= base_url('/mycart'); ?>";	
								}, 1500);
							} 
							else if(data == 'notloggedin') {
								window.location = "<?= base_url('/account/signin'); ?>";
							} else {
								setTimeout(function() {
								Swal.fire({
									icon: 'error',
									html: '<h4>Whoops!</h4><h5>Something went wrong.</h5>'
								});
								}, 700);
							}
						},
						error: function() {
							setTimeout(function() {
							Swal.fire({
								icon: 'error',
								html: '<h4>Whoops!</h4><h5>Something went wrong.</h5>'
							});
							}, 700);
						}
					});
				}
			})
            
        
    	});

		$(document).on('click', '.inc.qtybutton, .dec.qtybutton', function() {
			var id = $(this).parent().closest('tr').find('.cart_id').val();
			var qty = $(this).parent().find('.quantity').val();

            var item = {
                'cartid': id,
				'qty' :qty
            };

			$.ajax({
				type: 'POST',
				url: "<?= base_url('/Shop/updateFromCart'); ?>",
				data: item,
				xhr: function() {
						var xhr = $.ajaxSettings.xhr();
						xhr.upload.onprogress = function(e) {
						Swal.fire({
							html: '<h4>Loading...</h4>',
							onRender: function() {
								$('.Swal2-content').prepend(sweet_loader);
							}
						});
					};
					return xhr;
				},
				success: function(resp) {
					var data = JSON.parse(resp);
					console.log(data);
					if(data == 'success') {
						Swal.fire({
							icon: 'success',
							html: '<h4>Success!</h4>'
						});
						setTimeout(function() {
							window.location = "<?= base_url('/mycart'); ?>";	
						}, 1500);
					} 
					else if(data == 'notloggedin') {
						window.location = "<?= base_url('/account/signin'); ?>";
					} else {
						setTimeout(function() {
						Swal.fire({
							icon: 'error',
							html: '<h4>Whoops!</h4><h5>Something went wrong.</h5>'
						});
						}, 700);
					}
				},
				error: function() {
					setTimeout(function() {
					Swal.fire({
						icon: 'error',
						html: '<h4>Whoops!</h4><h5>Something went wrong.</h5>'
					});
					}, 700);
				}
			});
		});

		$(document).on('click', '#applyBtn', function() {
			var code = $('#voucherinput').val();

            var item = {
                'code': code
            };

			$.ajax({
				type: 'POST',
				url: "<?= base_url('/Shop/generateVoucher'); ?>",
				data: item,
				xhr: function() {
						var xhr = $.ajaxSettings.xhr();
						xhr.upload.onprogress = function(e) {
						Swal.fire({
							html: '<h4>Loading...</h4>',
							onRender: function() {
								$('.Swal2-content').prepend(sweet_loader);
							}
						});
					};
					return xhr;
				},
				success: function(resp) {
					var data = JSON.parse(resp);
					console.log(data);
					if(data.status == 'success') {
						Swal.fire({
							icon: 'success',
							html: '<h4>Success!</h4>'
						});
						var discount = data.data;
						
						var subtot = $('#subtotal').val();
						var discrp = discount*subtot/100;
						var newsubtot = subtot - discrp;
						$('#voucherhdn').val(discrp);
						$('#lblDiscount').html('- Rp '+discrp);
						$('#lblSubtotal').html('Rp '+newsubtot);
					} 
					else if(data.status == 'notvalid') {
						Swal.fire({
							icon: 'danger',
							html: '<h4>Voucher Not Valid!</h4>'
						});
					}
					else if(data == 'notloggedin') {
						window.location = "<?= base_url('/account/signin'); ?>";
					} else {
						setTimeout(function() {
						Swal.fire({
							icon: 'error',
							html: '<h4>Whoops!</h4><h5>Something went wrong.</h5>'
						});
						}, 700);
					}
				},
				error: function() {
					setTimeout(function() {
					Swal.fire({
						icon: 'error',
						html: '<h4>Whoops!</h4><h5>Something went wrong.</h5>'
					});
					}, 700);
				}
			});
		});
	});
	
</script>
<?= $this->endSection('content'); ?>