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
                        <li class="breadcrumb-item active">Detail</li>
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
                    <h4 class="mt-0 header-title" style="margin-bottom:20px">Detail Robot | <span class="sub-title"><?= $data->rbt_id ?></span></h4>
                    
                        <input type="hidden" name="id_qa" value="<?= $data->rbt_id ?>" />
                        <div class="row" style="margin-bottom:50px">
                            <div class="col-md-4">
                                <dt>ROBOT CODE</dt>
                                <dd class="sub-title"><?= $data->rbt_code ?></dd>
                                <dt>ROBOT NAME</dt>
                                <dd class="sub-title"><?= $data->rbt_name ?></dd>
                                <dt>ROBOT DESC</dt>
                                <dd class="sub-title"><?= $data->rbt_desc ?></dd>
                                <dt>STATUS</dt>
                                <dd class="sub-title">
                                    <?php if($data->status=='Y'):?>
                                        <span class="badge badge-success">Active</span>
                                    <?php elseif($data->status=='N'):?>
                                        <span class="badge badge-danger">Non-Active</span>
                                    <?php endif ?>
                                </dd>
                                <dt>NFT GENERATED</dt>
                                <dd class="sub-title">
                                    <?php if($data->nft_generated=='Y'):?>
                                        <span class="badge badge-success">NFT Generated</span>
                                    <?php elseif($data->nft_generated=='N'):?>
                                        <span class="badge badge-danger">Not Yet Generated</span>
                                    <?php endif ?>
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>CREATED DATE</dt>
                                <dd class="sub-title"><?= $data->created_date ?></dd>
                                <dt>CREATED BY</dt>
                                <dd class="sub-title"><?= $data->created_by ?></dd>
                                <dt>MODIFIED DATE</dt>
                                <dd class="sub-title"><?= $data->modified_date ?></dd>
                                <dt>MODIFIED BY</dt>
                                <dd class="sub-title"><?= $data->modified_by ?></dd>
                            </div>
                        </div>
                        <a href="<?= base_url('Robot/Index');?>" class="btn btn-secondary mb-2">Back</a>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
<?= $this->endSection('content'); ?>