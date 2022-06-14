<?= $this->extend('Layout/_Layout') ?>

<?= $this->section('content'); ?>
<div class="page-title-box">
        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">NFT Catalog</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Heraio Admin</a>
                        </li>
                        <li class="breadcrumb-item">NFT Catalog</li>
                        <li class="breadcrumb-item active">New</li>
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
                    <h4 class="mt-0 header-title">EDIT | <span class="sub-title"><?= $data['nft_catalog_id'] ?></span></h4>
                    <a href="<?= base_url('NFTCatalog/Index');?>" class="btn btn-sm btn-outline-secondary mb-2">Back</a>
                    <?php $validation = \Config\Services::validation(); ?>
                    <div style="margin-top:50px">
                    <form method="post" action="<?= base_url('NFTCatalog/Update') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="nft_catalog_id" value="<?= $data['nft_catalog_id'] ?>" />
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label>NFT NAME</label><span style="color:red;">*</span>
                                <input name="nft_name" class="form-control" type="text" value="<?=isset($data)?$data['nft_name']:''?>">
                                <?php if($validation->getError('nft_name')) {?>
                                    <div class='alert alert-danger mt-2'>
                                    <?= $error = $validation->getError('nft_name'); ?>
                                    </div>
                                <?php }?>
                            </div>
                            <div class="form-group">
                                <label>LINK</label><span style="color:red;"></span>
                                <textarea name="link" class="form-control"><?=isset($data)?$data['link']:''?></textarea>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>New Photo</label><span style="color:red;"></span>
                                    <input class="form-control" type="file" class="pic-input" name="photo">
                                    <?php if($validation->getError('photo')) {?>
                                        <div class='alert alert-danger mt-2'>
                                        <?= $error = $validation->getError('photo'); ?>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
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