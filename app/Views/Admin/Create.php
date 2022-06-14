<?= $this->extend('Layout/_Layout') ?>

<?= $this->section('content'); ?>
    <div class="page-title-box">
        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Admin</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Heraio Admin</a>
                        </li>
                        <li class="breadcrumb-item">Admin</li>
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
                    <h4 class="mt-0 header-title">Add New Admin Entry</h4>
                    <a href="<?= base_url('Admin/Index');?>" class="btn btn-sm btn-outline-secondary mb-2">Back</a>
                    <?php $validation = \Config\Services::validation(); ?>
                    <form method="post" action="<?= base_url('Admin/Save') ?>">
                    <div style="margin-top:50px">
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
                            <label>PASSWORD</label>
                            <p>heraioadmin</p>
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