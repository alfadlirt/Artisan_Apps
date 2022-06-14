<?= $this->extend('Layout/_Layout') ?>

<?= $this->section('content'); ?>
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">QA List</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">QA Apps</a>
                        </li>
                        <li class="breadcrumb-item active">QA List</li>
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
                    <h4 class="mt-0 header-title">EDIT | <span class="sub-title"><?= $data['rbt_code'] ?></span></h4>
                    <a href="<?= base_url('Robot/Index');?>" class="btn btn-sm btn-outline-secondary mb-2">Back</a>
                    <?php $validation = \Config\Services::validation(); ?>
                    <div style="margin-top:50px">
                    <form method="post" action="<?= base_url('Robot/Update') ?>">
                        <input type="hidden" name="rbt_identifier" value="<?= $data['identifier'] ?>" />
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