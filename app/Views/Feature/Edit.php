<?= $this->extend('Layout/_Layout') ?>

<?= $this->section('content'); ?>
    <div class="page-title-box">
        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Feature</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Heraio Admin</a>
                        </li>
                        <li class="breadcrumb-item">Feature</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page-title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">EDIT | <span class="sub-title"><?= $data['ftr_id'] ?></span></h4>
                    <a href="<?= base_url('Feature/Index');?>" class="btn btn-sm btn-outline-secondary mb-2">Back</a>
                    <?php $validation = \Config\Services::validation(); ?>
                    <div style="margin-top:50px">
                    <form method="post" action="<?= base_url('Feature/Update') ?>">
                        <input type="hidden" name="ftr_id" value="<?= $data['ftr_id'] ?>" />
                        <div class="form-group">
                            <label>FEATURE NAME</label><span style="color:red;">*</span>
                            <input name="ftr_name" class="form-control" type="text" value="<?=isset($data)?$data['ftr_name']:''?>">
                            <?php if($validation->getError('ftr_name')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('ftr_name'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>FEATURE DESC</label><span style="color:red;">*</span>
                            <textarea name="ftr_desc" class="form-control"><?=isset($data)?$data['ftr_desc']:''?></textarea>
                            <?php if($validation->getError('ftr_desc')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('ftr_desc'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
<?= $this->endSection('content'); ?>