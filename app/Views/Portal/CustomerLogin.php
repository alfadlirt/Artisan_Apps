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
        <form action="<?=base_url('login/authcustomer')?>" method="POST">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="customer-login text-left">
                        <h4 class="title-1 title-border text-uppercase mb-30">Registered customers</h4>
                        <p class="text-gray">If you have an account with us, Please login!</p>
                        <input value="<?=isset($username)?$username:''?>" type="text" placeholder="Username" name="username" required>
                        <input type="password" placeholder="Password" name="password" required>
                        <p><a href="<?=base_url('register')?>" class="text-gray">Customer Register?</a></p>
                        <p><a href="<?=base_url('seller/register')?>" class="text-gray">Seller Register?</a></p>
                        <?php
                            $session = session();
                            $authMsg = $session->getFlashdata('authresult');
                        ?>
                        <?php if(isset($authMsg)):?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top:20px;margin-bottom:20px">
                            <?=$authMsg?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif?>
                        <button type="submit" data-text="login" class="button-one submit-button mt-15">login</button>
                    </div>					
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection('content'); ?>