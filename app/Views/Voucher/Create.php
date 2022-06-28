<?= $this->extend('Layout/_Layout2') ?>

<?= $this->section('content'); ?>
    <div class="page-title-box">
        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Voucher</h4>
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Artisan Seller</a>
                        </li>
                        <li class="breadcrumb-item active">Voucher</li>
                        <li class="breadcrumb-item active">New</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page-title -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Add New Voucher Entry</h4>
                    <a href="<?= base_url('Voucher/Index');?>" class="btn btn-sm btn-outline-secondary mb-2">Back</a>
                    <?php $validation = \Config\Services::validation(); ?>
                    <form method="post" action="<?= base_url('Voucher/Save') ?>">
                    <div style="margin-top:50px">
                        <div class="form-group">
                            <label>VOUCHER NAME</label><span style="color:red;">*</span>
                            <input name="vcr_name" class="form-control" type="text" value="<?=isset($data)?$data['vcr_name']:''?>">
                            <?php if($validation->getError('vcr_name')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('vcr_name'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>VOUCHER CODE</label><span style="color:red;">*</span>
                            <input name="vcr_code" class="form-control" type="text" value="<?=isset($data)?$data['vcr_code']:''?>">
                            <?php if($validation->getError('vcr_code')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('vcr_code'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>DISCOUNT</label><span style="color:red;">*</span>
                            <input name="discount" class="form-control" type="number" value="<?=isset($data)?$data['discount']:''?>">
                            <?php if($validation->getError('discount')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('discount'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>START DATE</label><span style="color:red;">*</span>
                                    <input id="date_start" name="date_start" class="form-control date" type="text" value="<?=isset($data)?$data['date_start']:''?>">
                                    <?php if($validation->getError('date_start')) {?>
                                        <div class='alert alert-danger mt-2'>
                                        <?= $error = $validation->getError('date_start'); ?>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>END DATE</label><span style="color:red;">*</span>
                                    <input id="date_end" name="date_end" class="form-control date" type="text" value="<?=isset($data)?$data['date_end']:''?>">
                                    <?php if($validation->getError('date_end')) {?>
                                        <div class='alert alert-danger mt-2'>
                                        <?= $error = $validation->getError('date_end'); ?>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="margin-top:50px">
                            <button type="submit" value="Simpan" class="btn btn-lg btn-info waves-effect waves-light">Submit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col -->
        
    </div>
    <!-- end row -->
<?= $this->endSection('content'); ?>