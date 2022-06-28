<?= $this->extend('Layout/_Layout2') ?>

<?= $this->section('content'); ?>
    <div class="page-title-box">
        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Product</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Artisan Admin</a>
                        </li>
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Product</li>
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
                    <h4 class="mt-0 header-title" style="margin-bottom:20px">Detail Product | <span class="sub-title"><?= $data->prd_id ?></span></h4>
                    
                        <input type="hidden" name="id_qa" value="<?= $data->prd_id ?>" />
                        <div class="row" style="margin-bottom:50px">
                            <div class="col-md-3">
                                <dt>PRODUCT NAME</dt>
                                <dd class="sub-title"><?= $data->name ?></dd>
                                <dt>KEYWORD</dt>
                                <dd class="sub-title"><?= $data->slug ?></dd>
                                <dt>CATEGORY</dt>
                                <dd class="sub-title"><?= $data->ktg_name ?></dd>
                                <dt>DESCRIPTION</dt>
                                <dd class="sub-title"><?= $data->description ?></dd>
                                <dt>PRICE</dt>
                                <dd class="sub-title">Rp <?= $data->display_price ?></dd>
                                <dt>STATUS</dt>
                                <dd class="sub-title">
                                    <?php if($data->status=1):?>
                                        <span class="badge badge-success">Active</span>
                                    <?php elseif($data->status==0):?>
                                        <span class="badge badge-danger">Non-Active</span>
                                    <?php endif ?>
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>VARIATION</dt>
                                <dd class="sub-title">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="5%" style="vertical-align: middle;">NO</th>
                                            <th width="10%" style="vertical-align: middle;">NAME</th>
                                            <th width="10%" style="vertical-align: middle;">PRICE</th>
                                            <th width="10%" style="vertical-align: middle;">STOCK</th>
                                            <th width="10%" style="vertical-align: middle;">STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nomor = 1; ?>
                                        <?php if(sizeof($variation)!=0):?>
                                            <?php foreach ($variation as $row) :
                                            ?>
                                            <tr>
                                                <th><?= $nomor++ ?></th>
                                                <td>
                                                    <?= $row['variation_name'] ?>
                                                </td>
                                                <td>
                                                    Rp <?= $row['price'] ?>
                                                </td>
                                                <td>
                                                    <?= $row['stock'] ?>
                                                </td>
                                                <td>
                                                    <?php if($row['status']==1):?>
                                                        <span class="badge badge-success">Active</span>
                                                    <?php else:?>
                                                        <span class="badge badge-danger">Non-Active</span>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                            <?php
                                            endforeach
                                            ?>
                                        <?php else :?>
                                            <tr>
                                                <td colspan="8" align="center">
                                                    No Data Available
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                                </dd>
                                
                            </div>
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-2">
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
                        <a href="<?= base_url('Product/Index');?>" class="btn btn-secondary mb-2">Back</a>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
<?= $this->endSection('content'); ?>