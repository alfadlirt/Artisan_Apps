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
									<li><a class="active" href="<?=base_url()?>" data-bs-toggle="tab">Checkout</a></li>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									<form method="post" action="<?= base_url('Shop/AddOrder') ?>">
									<?php $validation = \Config\Services::validation(); ?>
											<div class="shop-cart-table check-out-wrap">
												<div class="row">
													<div class="col-md-6">
														<div class="billing-details pr-20">
															<h4 class="title-1 title-border text-uppercase mb-30">Address info</h4>
															<select class="custom-select mb-15" id="address_id" name="address_id">
															<option value="0">--SELECT ADDRESS--</option>
															<?php foreach ($address as $row) :
                                        					?>
																<option value="<?=$row['ADR_ID']?>"><?=$row['RECEIPENT'].' | '. $row['TELP'] .' | '.$row['address'].' | '.$row['NOTES']?></option>
																<?php
															endforeach
															?>
															</select>
															<?php if($validation->getError('address_id')) {?>
																<div class='alert alert-danger mt-2'>
																<?= $error = $validation->getError('address_id'); ?>
																</div>
															<?php }?>

															<h4 class="title-1 title-border text-uppercase mb-30">Different Address</h4>
															<input type="checkbox" id="isDifferent" name="isDifferent" />
															<label for="isDifferent">Different Address</label>
															<textarea id="newaddress" name="newaddress" class="custom-textarea mb-10" placeholder="Address"></textarea>

															<h4 class="title-1 title-border text-uppercase mb-30">Notes</h4>
															<textarea id="notes" name="notes" class="custom-textarea" placeholder="Notes" ></textarea>
														</div>
													</div>
													<div class="col-md-6 mt-xs-30">
														<!-- payment-method -->
														<div class="payment-method pr-20">
															<h4 class="title-1 title-border text-uppercase mb-30">Expedition</h4>
															<select class="custom-select mb-15" id="expedition_id" name="expedition_id">
															<option value="0">--EXPEDITION--</option>
															<?php foreach ($expedition as $row) :
                                        					?>
																<option value="<?=$row['exp_name']?>"><?=$row['exp_name']?></option>
																<?php
															endforeach
															?>
															</select>
															<?php if($validation->getError('expedition_id')) {?>
																<div class='alert alert-danger mt-2'>
																<?= $error = $validation->getError('expedition_id'); ?>
																</div>
															<?php }?>													
														</div>
														<div class="payment-method pr-20" id="payment_id">
															<h4 class="title-1 title-border text-uppercase mb-30">payment method</h4>
															<select class="custom-select mb-15" id="payment_id" name="payment_id">
															<option value="0">--SELECT PAYMENT METHOD--</option>
															<?php foreach ($payment as $row) :
                                        					?>
																<option value="<?=$row['pym_name']?>"><?=$row['pym_name']?></option>
																<?php
															endforeach
															?>
															</select>
															<?php if($validation->getError('payment_id')) {?>
																<div class='alert alert-danger mt-2'>
																<?= $error = $validation->getError('payment_id'); ?>
																</div>
															<?php }?>														
														</div>
													</div>
													<div class="col-md-12">
														<div class="our-order payment-details mt-60 pr-20">
															<h4 class="title-1 title-border text-uppercase mb-30">Your order</h4>
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
																		<input type="hidden" name="discount" id="discount" value="<?=$discount?>"/>
																		<td class="text-end">- Rp <?=$discount?></td>
																	</tr>
																	<tr>
																		<td>Order Total</td>
																		<input type="hidden" name="subtotal" id="subtotal" value="<?=$subtotal-$discount?>"/>
																		<td class="text-end">Rp <?=$subtotal-$discount?></td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
													<div class="col-md-6 mt-60">
													<button class="button-one submit-button mt-15" data-text="Checkout" type="submit">Checkout</button>
													</div>
												</div>
											</div>
										</form>											
									
								</div>

							</div>
						</div>
					</div>
				</div>
				
			</div>
<?= $this->endSection('content'); ?>