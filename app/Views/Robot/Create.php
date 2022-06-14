<?= $this->extend('Layout/_Layout') ?>

<?= $this->section('content'); ?>
    <div class="page-title-box">
        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Robot</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Heraio Admin</a>
                        </li>
                        <li class="breadcrumb-item">Robot</li>
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
                    <h4 class="mt-0 header-title">Add New Robot Entry</h4>
                    <a href="<?= base_url('Robot/Index');?>" class="btn btn-sm btn-outline-secondary mb-2">Back</a>
                    <?php $validation = \Config\Services::validation(); ?>
                    <form method="post" action="<?= base_url('Robot/Save') ?>">
                    <div style="margin-top:50px">
                        <div class="form-group">
                            <label>ROBOT CODE</label><span style="color:red;">*</span>
                            <input name="rbt_code" class="form-control" type="text" value="<?=isset($data)?$data['rbt_code']:''?>">
                            <?php if($validation->getError('rbt_code')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('rbt_code'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>ROBOT NAME</label><span style="color:red;">*</span>
                            <input name="rbt_name" class="form-control" type="text" value="<?=isset($data)?$data['rbt_name']:''?>">
                            <?php if($validation->getError('rbt_name')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('rbt_name'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>ROBOT DESC</label><span style="color:red;">*</span>
                            <textarea name="rbt_desc" class="form-control"><?=isset($data)?$data['rbt_desc']:''?></textarea>
                            <?php if($validation->getError('rbt_desc')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('rbt_desc'); ?>
                                </div>
                            <?php }?>
                        </div>
                        
                        <div class="form-group">
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