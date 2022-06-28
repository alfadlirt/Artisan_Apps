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
										<li><a href="index.html">Home</a></li>
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
									<li><a class="active" href="#" data-bs-toggle="tab">shopping cart</a></li>
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
																<td class="product-thumbnail  text-left">
																	<!-- Single-product start -->
																	<div class="single-product">
																		<div class="product-img">
																			<a href="single-product.html"><img src="img/product/2.jpg" alt="" /></a>
																		</div>
																		<div class="product-info">
																			<h4 class="post-title"><a class="text-light-black" href="#"><?=$row['name']?></a></h4>
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
																	<a href="#"><i class="zmdi zmdi-close"></i></a>
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
														<button type="button" data-text="apply voucher" class="button-one submit-button mt-15">apply voucher</button>
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
																	<td class="text-end">Rp 0</td>
																</tr>
																<tr>
																	<td class="text-left">Total</td>
																	<td class="text-end">Rp <?=$subtotal?></td>
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
									
									
									<!-- order-complete start -->
									<div class="tab-pane" id="order-complete">
										<form action="#">
											<div class="thank-recieve bg-white mb-30">
												<p>Thank you. Your order has been received.</p>
											</div>
											<div class="order-info bg-white text-center clearfix mb-30">
												<div class="single-order-info">
													<h4 class="title-1 text-uppercase text-light-black mb-0">order no</h4>
													<p class="text-uppercase text-light-black mb-0"><strong>m 2653257</strong></p>
												</div>
												<div class="single-order-info">
													<h4 class="title-1 text-uppercase text-light-black mb-0">Date</h4>
													<p class="text-uppercase text-light-black mb-0"><strong>june 15, 2021</strong></p>
												</div>
												<div class="single-order-info">
													<h4 class="title-1 text-uppercase text-light-black mb-0">Total</h4>
													<p class="text-uppercase text-light-black mb-0"><strong>$ 170.00</strong></p>
												</div>
												<div class="single-order-info">
													<h4 class="title-1 text-uppercase text-light-black mb-0">payment method</h4>
													<p class="text-uppercase text-light-black mb-0"><a href="#"><strong>check payment</strong></a></p>
												</div>
											</div>
											<div class="shop-cart-table check-out-wrap">
												<div class="row">
													<div class="col-md-6">
														<div class="our-order payment-details pr-20">
															<h4 class="title-1 title-border text-uppercase mb-30">our order</h4>
															<table>
																<thead>
																	<tr>
																		<th><strong>Product</strong></th>
																		<th class="text-end"><strong>Total</strong></th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Dummy Product Name  x 2</td>
																		<td class="text-end">$86.00</td>
																	</tr>
																	<tr>
																		<td>Dummy Product Name  x 1</td>
																		<td class="text-end">$69.00</td>
																	</tr>
																	<tr>
																		<td>Cart Subtotal</td>
																		<td class="text-end">$155.00</td>
																	</tr>
																	<tr>
																		<td>Shipping and Handing</td>
																		<td class="text-end">$15.00</td>
																	</tr>
																	<tr>
																		<td>Vat</td>
																		<td class="text-end">$00.00</td>
																	</tr>
																	<tr>
																		<td>Order Total</td>
																		<td class="text-end">$170.00</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
													<!-- payment-method -->
													<div class="col-md-6 mt-xs-30">
														<div class="payment-method  pl-20">
															<h4 class="title-1 title-border text-uppercase mb-30">payment method</h4>
															<div class="payment-accordion">
																<!-- Accordion start  -->
																<h3 class="payment-accordion-toggle active">Direct Bank Transfer</h3>
																<div class="payment-content default">
																	<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.</p>
																</div> 
																<!-- Accordion end -->
																<!-- Accordion start -->
																<h3 class="payment-accordion-toggle">Cheque Payment</h3>
																<div class="payment-content">
																	<p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
																</div>
																<!-- Accordion end -->
																<!-- Accordion start -->
																<h3 class="payment-accordion-toggle">PayPal</h3>
																<div class="payment-content">
																	<p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
																	<a href="#"><img src="img/payment/1.png" alt="" /></a>
																	<a href="#"><img src="img/payment/2.png" alt="" /></a>
																	<a href="#"><img src="img/payment/3.png" alt="" /></a>
																	<a href="#"><img src="img/payment/4.png" alt="" /></a>
																</div>
																<!-- Accordion end --> 
																<button class="button-one submit-button mt-15" data-text="place order" type="submit">place order</button>			
															</div>															
														</div>
													</div>
												</div>
											</div>
										</form>										
									</div>
									<!-- order-complete end -->
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
<?= $this->endSection('content'); ?>