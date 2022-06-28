<?= $this->extend('Layout/_Layout3') ?>

<?= $this->section('content'); ?>
		<div class="heading-banner-area overlay-bg">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="heading-banner">
							<div class="heading-banner-title">
								<h2>My Account</h2>
							</div>
							<div class="breadcumbs pb-15">
								<ul>
									<li><a href="<?=base_url()?>">Home</a></li>
									<li>My Account</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			<!-- HEADING-BANNER END -->
			<?php
				$session = session();
				$stateAction = $session->getFlashdata('state');
			?>
			<input type="hidden" id="stateAction" value="<?= $stateAction?>" />
			<!-- MY-ACCOUNT-AREA START -->
			<div class="my-account-area  pt-80 pb-80" style="margin-bottom:100px">
				<div class="container">	
					<div class="my-account">
						<div class="row">
							<div class="col-md-6">
								<div class="panel-group" id="accordion">
									<div class="panel mb-2">
										<div class="my-account-menu" >
											<a  data-bs-toggle="collapse" href="#my-info">
											My Personal Information
											</a>
										</div>
										<div id="my-info" class="panel-collapse collapse show" data-bs-parent="#accordion">
											<div class="panel-body">
												<div class="billing-details shop-cart-table">
													<button style="margin-bottom:20px;" type="button" title="Edit Profile" id="editProfil" class="btn btn-secondary"><i class="zmdi zmdi-edit" style="margin-right:10px;"></i>Edit Profile</button>
													<dt>First Name</dt>
													<dd><?=$data['f_name']?></dd>
													<dt>Last Name</dt>
													<dd><?=$data['l_name']?></dd>
													<dt>Telp</dt>
													<dd><?=$data['telp']?></dd>
													<dt>Email</dt>
													<dd><?=$data['email']?></dd>
													<dt>Username</dt>
													<dd><?=$data['usrname']?></dd>
													<dt>Password</dt>
													<dd>****</dd>
												</div>
											</div>
										</div>
									</div>
									<div class="panel mb-2">
										<div class="my-account-menu">
											<a class="collapsed"  data-bs-toggle="collapse"  href="#my-billing">
											My address
											</a>
										</div>
										<div id="my-billing" class="panel-collapse collapse" data-bs-parent="#accordion">
											<div class="panel-body">
												<div class="billing-details shop-cart-table">
													<div class="payment-accordion">
													<?php if(sizeof($data)!=0):?>
                                        <?php foreach ($address as $row) :
                                        ?>
														<div>
														<!-- Accordion start  -->
															<input type="hidden" value="<?=$row['ADR_ID']?>"/>
															<h3 class="payment-accordion-toggle active"><?=$row['ADR_NAME']?></h3>
															<div class="payment-content default">
																	<p>
																		<?=$row['RECEIPENT'] . ' | '. $row['TELP'] . ' | '. $row['address']. ' | '. $row['NOTES'] ?>
																<a href="#" class="editAddress" title="Edit Address"><i class="zmdi zmdi-edit"></i></a>
																</p>
															</div> 
														</div>
														<!-- Accordion end -->
														<?php
                                        endforeach
                                        ?>
                                    <?php else :?>
                                        <tr>
                                            <td colspan="2" align="center">
                                                No Items
                                            </td>
                                        </tr>
                                    <?php endif ?>
									<button id="addAddress" type="button" data-text="Add Address" class="button-one submit-button mt-15">Add Address</button>			
													</div>	
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel-group" id="accordion-2">
									<div class="panel mb-2">
										<div class="my-account-menu" >
											<a  data-bs-toggle="collapse" href="#my-payment-method">
											Login Log
											</a>
										</div>
										<div id="my-payment-method" class="panel-collapse collapse show" data-bs-parent="#accordion-2">
											<div class="panel-body">
												<div class="our-order payment-details shop-cart-table">
												<table>
														<thead>
															<tr>
																<th><strong>Date</strong></th>
																<th class="text-end"><strong>Client</strong></th>
															</tr>
														</thead>
														<tbody>
														<?php if(sizeof($data)!=0):?>
                                        <?php foreach ($log as $row) :
                                        ?>
															<tr>
																<td><?=$row['login_date']?></td>
																<td class="text-end">Google Chrome</td>
															</tr>
															<?php
                                        endforeach
                                        ?>
                                    <?php else :?>
                                        <tr>
                                            <td colspan="2" align="center">
                                                No Items
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
				</div>
			</div>
			<!-- -->
			<div style="z-index:9999999" class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" action="<?= base_url('/myaccount/profile/update') ?>">
								<?php $validation = \Config\Services::validation(); ?>
								<div class="form-group">
								<label>FIRST NAME</label><span style="color:red;">*</span>
									<input name="f_name" class="form-control" type="text" value="<?=isset($dataval)?$dataval['f_name']:$data['f_name']?>">
									<?php if($validation->getError('f_name')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('f_name'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group">
									<label>LAST NAME</label><span style="color:red;">*</span>
									<input name="l_name" class="form-control" type="text" value="<?=isset($dataval)?$dataval['l_name']:$data['l_name']?>">
									<?php if($validation->getError('l_name')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('l_name'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group">
									<label>TELP</label><span style="color:red;">*</span>
									<input name="telp" class="form-control" type="text" value="<?=isset($dataval)?$dataval['telp']:$data['telp']?>">
									<?php if($validation->getError('telp')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('telp'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group">
									<label>EMAIL</label><span style="color:red;">*</span>
									<input name="email" class="form-control" type="text" value="<?=isset($dataval)?$dataval['email']:$data['email']?>">
									<?php if($validation->getError('email')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('email'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group">
									<label>USERNAME</label><span style="color:red;">*</span>
									<input name="usrname" class="form-control" type="text" value="<?=isset($dataval)?$dataval['usrname']:$data['usrname']?>">
									<?php if($validation->getError('usrname')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('usrname'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group" style="margin-top:25px">
									<button name="btnUpdate" value="data" type="submit" class="btn btn-md btn-info waves-effect waves-light">Update</button>
								</div>
								<div style="margin-top:50px">
									<div class="form-group">
										<label>OLD PASSWORD</label><span style="color:red;">*</span>
										<input name="oldpass" class="form-control" type="password" value="<?=isset($dataval['oldpass'])?$dataval['oldpass']:''?>">
										<?php if(isset($validationOldPass)):?>
											<div class='alert alert-danger mt-2'>
											<?=$validationOldPass?>
											</div>
										<?php elseif($validation->getError('oldpass')) :?>
											<div class='alert alert-danger mt-2'>
											<?= $error = $validation->getError('oldpass'); ?>
											</div>
										<?php endif?>
									</div>
									<div class="form-group">
										<label>NEW PASSWORD</label><span style="color:red;">*</span>
										<input name="newpass1" class="form-control" type="password" value="<?=isset($dataval['newpass1'])?$dataval['newpass1']:''?>">
										<?php if($validation->getError('newpass1')) {?>
											<div class='alert alert-danger mt-2'>
											<?= $error = $validation->getError('newpass1'); ?>
											</div>
										<?php }?>
									</div>
									<div class="form-group">
										<label>CONFIRM PASSWORD</label><span style="color:red;">*</span>
										<input name="newpass2" class="form-control" type="password" value="<?=isset($dataval['newpass2'])?$dataval['newpass2']:''?>">
										<?php if($validation->getError('newpass2')) {?>
											<div class='alert alert-danger mt-2'>
											<?= $error = $validation->getError('newpass2'); ?>
											</div>
										<?php }?>
									</div>
									<div class="form-group" style="margin-top:25px">
										<button name="btnUpdate" value="pass" type="submit" class="btn btn-md btn-info waves-effect waves-light">Update</button>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="clsModal btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			
			<div style="z-index:9999999" class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">EditAddress</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" action="<?= base_url('/myaccount/address/update') ?>">
								<?php $validation = \Config\Services::validation(); ?>
								<input type="hidden" id="address_id" value=""/>
								<div class="form-group">
								<label>ADDRESS NAME</label><span style="color:red;">*</span>
									<input id="adrname" placeholder="Home/Office/Family" name="adr_name" class="form-control" type="text" value="<?=isset($dataupdate)?$dataupdate['ADR_NAME']:''?>">
									<?php if($validation->getError('adr_name')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('adr_name'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group">
								<label>RECEIPENT</label><span style="color:red;">*</span>
									<input id="rcpnt" placeholder="Receipent" name="receipent" class="form-control" type="text" value="<?=isset($dataupdate)?$dataupdate['RECEIPENT']:''?>">
									<?php if($validation->getError('receipent')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('receipent'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group">
								<label>TELP</label><span style="color:red;">*</span>
									<input id="tlp" placeholder="Telp" name="telp" class="form-control" type="text" value="<?=isset($dataupdate)?$dataupdate['TELP']:''?>">
									<?php if($validation->getError('telp')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('telp'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group">
								<label>ADDRESS</label><span style="color:red;">*</span>
								<textarea id="adr" class="form-control" name="address"><?=isset($dataupdate)?$dataupdate['address']:''?></textarea>
									<?php if($validation->getError('address')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('address'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group">
								<label>NOTES</label><span style="color:red;">*</span>
									<input id="nts" placeholder="Notes" name="notes" class="form-control" type="text" value="<?=isset($dataupdate)?$dataupdate['NOTES']:''?>">
									<?php if($validation->getError('notes')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('notes'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group" style="margin-top:25px">
									<button name="btnUpdate" type="submit" class="btn btn-md btn-info waves-effect waves-light">Save</button>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="clsModal btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<div style="z-index:9999999" class="modal fade" id="addressAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Add Address</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" action="<?= base_url('/myaccount/address/add') ?>">
								<?php $validation = \Config\Services::validation(); ?>
								<div class="form-group">
								<label>ADDRESS NAME</label><span style="color:red;">*</span>
									<input placeholder="Home/Office/Family" name="adr_name" class="form-control" type="text" value="<?=isset($dataadd)?$dataadd['ADR_NAME']:''?>">
									<?php if($validation->getError('adr_name')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('adr_name'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group">
								<label>RECEIPENT</label><span style="color:red;">*</span>
									<input placeholder="Receipent" name="receipent" class="form-control" type="text" value="<?=isset($dataadd)?$dataadd['RECEIPENT']:''?>">
									<?php if($validation->getError('receipent')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('receipent'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group">
								<label>TELP</label><span style="color:red;">*</span>
									<input placeholder="Telp" name="telp" class="form-control" type="text" value="<?=isset($dataadd)?$dataadd['TELP']:''?>">
									<?php if($validation->getError('telp')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('telp'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group">
								<label>ADDRESS</label><span style="color:red;">*</span>
								<textarea class="form-control" name="address"><?=isset($dataadd)?$dataadd['address']:''?></textarea>
									<?php if($validation->getError('address')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('address'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group">
								<label>NOTES</label><span style="color:red;">*</span>
									<input placeholder="Notes" name="notes" class="form-control" type="text" value="<?=isset($dataadd)?$dataadd['NOTES']:''?>">
									<?php if($validation->getError('notes')) {?>
										<div class='alert alert-danger mt-2'>
										<?= $error = $validation->getError('notes'); ?>
										</div>
									<?php }?>
								</div>
								<div class="form-group" style="margin-top:25px">
									<button name="btnUpdate" type="submit" class="btn btn-md btn-info waves-effect waves-light">Save</button>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="clsModal btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- -->
			</div>
<script>
	$(document).ready(function(){
		var state = <?= $state ?>;
		
		switch(state){
			case 1:
				$('#profileModal').modal('show')
				break;
			case 2:
				$('#addressModal').modal('show')
			break;
			case 3:
				$('#addressAddModal').modal('show')
			break;
			default:

			break;
		}

		var stateAction = $('#stateAction').val();
		
		if(stateAction == 1){
			Swal.fire({
				icon: 'success',
				text: 'Profile Updated!'
			});
				
		}
		else if(stateAction == 2){
			Swal.fire({
				icon: 'success',
				text: 'Address Updated!'
			});
		}
		else if(stateAction == 3){
			Swal.fire({
				icon: 'success',
				text: 'Address Added!'
			});
		}
	})

	$(document).on('click', '#editProfil', function() {
        $('#profileModal').modal('show')
    });
	$(document).on('click', '.editAddress', function() {
		var idAdr = $(this).parent().parent().parent().find('input[type="hidden"]').val();
		
		var item = {
			'addressid': idAdr
		};

		$.ajax({
			type: 'POST',
			url: "<?= base_url('/Shop/getAddress'); ?>",
			data: item,
			success: function(resp) {
				var data = JSON.parse(resp);
				$('#nts').val(data.NOTES);
				$('#tlp').val(data.TELP);
				$('#rcpnt').val(data.NOTES);
				$('#adr').val(data.address);
				$('#adrname').val(data.ADR_NAME);
				$('#rcpnt').val(data.RECEIPENT);
				$('#address_id').val(data.ADR_ID);
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

        $('#addressModal').modal('show')
    });
	$(document).on('click', '#addAddress', function() {
        $('#addressAddModal').modal('show')
    });

    $(document).on('click', '.clsModal', function() {
        $(this).parent().parent().parent().parent().modal('hide')
    });
</script>
<?= $this->endSection('content'); ?>