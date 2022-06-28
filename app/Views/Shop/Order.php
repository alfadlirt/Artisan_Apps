<?= $this->extend('Layout/_Layout3') ?>

<?= $this->section('content'); ?>
<div class="heading-banner-area2 overlay-bg">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="heading-banner">
								<div class="heading-banner-title">
									<h2>My Order</h2>
								</div>
								<div class="breadcumbs pb-15">
									<ul>
										<li><a href="<?=base_url()?>">Home</a></li>
										<li>Order History</li>
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
									<li><a class="active" href="#" data-bs-toggle="tab">order history</a></li>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									<div class="row">
										<div class="col-md-12">
										<table class="table">
											<thead class="thead-dark">
												<tr>
												<th scope="col">#</th>
												<th scope="col">Date</th>
												<th scope="col">Total</th>
												<th scope="col">Expedition</th>
												<th scope="col">Payment</th>
												<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $no = 1;?>
											<?php if(sizeof($data)!=0):?>
												<?php foreach ($data as $row) :
												?>
												<tr>
													<th><?= $no++ ?></th>
													<td>
													<?= $row['created_date'] ?>
													</td>
													<td>
													Rp <?= $row['total_paid_price'] ?>
													</td>
													<td>
													<?= $row['expedition'] ?>
													</td>
													<td>
													<?= $row['payment'] ?>
													</td>
													<td>
														<a title="Detail" href="<?= base_url('myorder/'.$row['trs_id']) ?>">
														<i class="zmdi zmdi-dehaze"></i>
													</td>
												</tr>
												<?php
												endforeach
												?>
											<?php else :?>
												<tr>
													<td colspan="6" align="center">
														No Data Available
													</td>
												</tr>
											<?php endif ?>
											</tbody>
											</table>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
<?= $this->endSection('content'); ?>