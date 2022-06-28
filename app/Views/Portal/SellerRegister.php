<?= $this->extend('Layout/_Layout3') ?>

<?= $this->section('content'); ?>
<div class="heading-banner-area overlay-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-banner">
                    <div class="heading-banner-title">
                        <h2>Login</h2>
                    </div>
                    <div class="breadcumbs pb-15">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>Portal</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- HEADING-BANNER END -->
<!-- SHOPPING-CART-AREA START -->
<div class="login-area  pt-80 pb-80">
    <div class="container">
        <form method="post" action="<?= base_url('seller/create-account') ?>">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="customer-login text-left">
                        <?php $validation = \Config\Services::validation(); ?>
                        <h4 class="title-1 title-border text-uppercase mb-30">new Seller</h4>
                        <p class="text-gray">Please fill data!</p>
                        <div class="form-group">
                            <label>SHOP NAME</label><span style="color:red;">*</span>
                            <input name="shop_name" class="form-control" type="text" value="<?=isset($data)?$data['shop_name']:''?>">
                            <?php if($validation->getError('shop_name')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('shop_name'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>DESCRIPTION</label><span style="color:red;">*</span>
                            <input placeholder="" name="shop_description" class="form-control" type="text" value="<?=isset($dataadd)?$dataadd['shop_description']:''?>">
                            <?php if($validation->getError('shop_description')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('shop_description'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>ADDRESS</label><span style="color:red;">*</span>
                            <input placeholder="" name="shop_address" class="form-control" type="text" value="<?=isset($dataadd)?$dataadd['shop_address']:''?>">
                            <?php if($validation->getError('shop_address')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('shop_address'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>FIRST NAME</label><span style="color:red;">*</span>
                            <input name="f_name" class="form-control" type="text" value="<?=isset($data)?$data['f_name']:''?>">
                            <?php if($validation->getError('f_name')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('f_name'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>LAST NAME</label><span style="color:red;">*</span>
                            <input name="l_name" class="form-control" type="text" value="<?=isset($data)?$data['l_name']:''?>">
                            <?php if($validation->getError('l_name')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('l_name'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>TELP</label><span style="color:red;">*</span>
                            <input name="telp" class="form-control" type="text" value="<?=isset($data)?$data['telp']:''?>">
                            <?php if($validation->getError('telp')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('telp'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>EMAIL</label><span style="color:red;">*</span>
                            <input name="email" class="form-control" type="text" value="<?=isset($data)?$data['email']:''?>">
                            <?php if($validation->getError('email')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('email'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>USERNAME</label><span style="color:red;">*</span>
                            <input name="usrname" class="form-control" type="text" value="<?=isset($data)?$data['usrname']:''?>">
                            <?php if($validation->getError('usrname')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('usrname'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>PASSWORD</label><span style="color:red;">*</span>
                            <input name="pass1" class="form-control" type="password" value="<?=isset($data['pass1'])?$data['pass1']:''?>">
                            <?php if($validation->getError('pass1')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('pass1'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>CONFIRM PASSWORD</label><span style="color:red;">*</span>
                            <input name="pass2" class="form-control" type="password" value="<?=isset($data['pass2'])?$data['pass2']:''?>">
                            <?php if($validation->getError('pass2')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('pass2'); ?>
                                </div>
                            <?php }?>
                        </div>
                        
                        <button type="submit" data-text="register" class="button-one submit-button mt-15">register</button>
                    </div>					
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection('content'); ?>