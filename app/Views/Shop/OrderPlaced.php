<?= $this->extend('Layout/_Layout3') ?>

<?= $this->section('content'); ?>
<div class="heading-banner-area overlay-bg">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="heading-banner">
								<div class="heading-banner-title">
									<h2>Thank You</h2>
								</div>
								<div class="breadcumbs pb-15">
									<ul>
										<li><a href="<?=base_url()?>">Home</a></li>
										<li>Order Placed</li>
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
								<!-- Tab panes -->
								<div class="tab-content">
									<div class="thank-recieve bg-white mb-30">
										<p>Thank you. Your order has been received.</p>
									</div>
									<div class="order-info bg-white text-center clearfix mb-30">
										<div class="single-order-info">
											<h4 class="title-1 text-uppercase text-light-black mb-0">order no</h4>
											<p class="text-uppercase text-light-black mb-0"><strong>m <?=$transaction['trs_id']?></strong></p>
										</div>
										<div class="single-order-info">
											<h4 class="title-1 text-uppercase text-light-black mb-0">Date</h4>
											<p class="text-uppercase text-light-black mb-0"><strong><?=date("F j, Y, g:i a", strtotime($transaction['created_date']))?></strong></p>
										</div>
										<div class="single-order-info">
											<h4 class="title-1 text-uppercase text-light-black mb-0">Total</h4>
											<p class="text-uppercase text-light-black mb-0"><strong>Rp <?=$transaction['total_paid_price']?></strong></p>
										</div>
										<div class="single-order-info">
											<h4 class="title-1 text-uppercase text-light-black mb-0">payment method</h4>
											<p class="text-uppercase text-light-black mb-0"><?=$transaction['payment']?></p>
										</div>
									</div>
									
									<div class="row justify-content-center">
										<div class="col-md-2"></div>
										<div class="col-md-2 order-info bg-white text-center clearfix mb-30">
											<div class="single-order-info">
												<h4 class="title-1 text-uppercase text-light-black mb-0">notes</h4>
												<p class="text-uppercase text-light-black mb-0"><?=$transaction['notes']?></p>
											</div>
										</div>
										<div class="col-md-2 order-info bg-white text-center clearfix mb-30">
										<div class="single-order-info">
											<h4 class="title-1 text-uppercase text-light-black mb-0">expedition</h4>
											<p class="text-uppercase text-light-black mb-0"><?=$transaction['expedition']?></p>
										</div>
										</div>
									</div>
									
									<div class="shop-cart-table check-out-wrap">
										<div class="row">
											<div class="col-md-12">
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
														<?php 
                                                            $subtotal = 0;
                                                            ?>
                                                        
                                        <?php foreach ($data as $row) :
                                        ?>
																	<tr>
																		<td><?=$row['name']?> | <?=$row['variation_name']?>  x <?=$row['qty']?></td>
																		<?php 
                                                                $tt = $row['qty']*$row['price'];
                                                                $subtotal += $tt;
                                                                ?>
																		<td class="text-end">Rp <?=$tt?></td>
																	</tr>
																	<?php
                                        endforeach
                                        ?>
										<tr>
																		<td>Discount</td>
																		<input type="hidden" name="discount" id="discount" value="<?=$transaction['discount']?>"/>
																		<td class="text-end">- Rp <?=$transaction['discount']?></td>
																	</tr>
																	<tr>
																		<td>Order Total</td>
																		<input type="hidden" name="subtotal" id="subtotal" value="<?=$subtotal-$transaction['discount']?>"/>
																		<td class="text-end">Rp <?=$subtotal-$transaction['discount']?></td>
																	</tr>
														</tbody>
													</table>
													<div style="margin-top:100px">
														<a href="<?=base_url('product')?>">Back To Home</a>
													</div>
												</div>
												
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
<?= $this->endSection('content'); ?>