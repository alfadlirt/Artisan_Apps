<?= $this->extend('Layout/_Layout') ?>

<?= $this->section('content'); ?>
    <div class="page-title-box">
        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">NFT</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Heraio Admin</a>
                        </li>
                        <li class="breadcrumb-item active">NFT</li>
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
                <form method="GET" action="<?=base_url('NFT/Index');?>">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Items Per Page</label>
                                <select class="form-control" name="pgsz" style="display:inline-block; width:35%">
                                    <option value="5" <?= ($searchform)&&($searchform['pgsz']== '5') ? "selected" : "" ; ?>>5</option>
                                    <option value="10" <?= (!$searchform)||(($searchform)&&($searchform['pgsz']== '10')) ? "selected" : "" ; ?>>10</option>
                                    <option value="20" <?= ($searchform)&&($searchform['pgsz']== '20') ? "selected" : "" ; ?>>20</option>
                                    <option value="30" <?= ($searchform)&&($searchform['pgsz']== '30') ? "selected" : "" ; ?>>30</option>
                                    <option value="40" <?= ($searchform)&&($searchform['pgsz']== '40') ? "selected" : "" ; ?>>40</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <?php
                                $session = session();
                                $actionMsg = $session->getFlashdata('message');
                                $actionStatus = $session->getFlashdata('messageStatus');
                            ?>
                            <?php if(isset($actionMsg)):?>
                            <div class="<?=($actionStatus=='Success')?'alert alert-success alert-dismissible fade show':'alert alert-danger alert-dismissible fade show'?>" role="alert">
                                <?=$actionMsg?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif?>
                        </div>
                    </div>
                    
                
                    <div style="margin-top:50px" class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ROBOT NAME / CODE / DESC</label>
                                <input class="form-control" type="text" placeholder="search..." name="keyword" value="<?=($searchform)? $searchform['keyword']: ''?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>NFT Generated</label>
                                <select class="form-control" name="status">
                                    <option value="0" <?= (!$searchform)||($searchform['status']== '0') ?  "selected" : "" ; ?>>All</option>
                                    <option value="Y" <?= ($searchform)&&($searchform['status']== 'Y') ?  "selected" : "" ; ?>>Generated</option>
                                    <option value="N" <?= ($searchform)&&($searchform['status']== 'N') ?  "selected" : "" ; ?>>Not Yet Generated</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button style="float:right" type="submit" class="btn btn-warning waves-effect waves-light">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
                    <div style="margin-top:50px" class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%" style="vertical-align: middle;">NO</th>
                                        <th width="20%" style="vertical-align: middle;">RBT CODE</th>
                                        <th style="vertical-align: middle;">RBT NAME</th>
                                        <th width="10%" style="vertical-align: middle;">NFT</th>
                                        <th width="10%" style="vertical-align: middle;">STATUS</th>
                                        <th width="5%" style="vertical-align: middle; max-width:16%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(sizeof($datalist)!=0):?>
                                        <?php foreach ($datalist as $row) :
                                        ?>
                                        <tr>
                                            <th><?= $nomor++ ?></th>
                                            <td>
                                                <?= $row['rbt_code'] ?>
                                            </td>
                                            <td>
                                            <?= $row['rbt_name'] ?>
                                            </td>
                                            <td>
                                            xx
                                            </td>
                                            <td>
                                                <?php if($row['nft_generated']=='Y'):?>
                                                    <span class="badge badge-success">NFT Generated</span>
                                                <?php else:?>
                                                    <span class="badge badge-danger">Not Yet Generated</span>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <div class="button-items">
                                                    <?php if($row['nft_generated']=='Y'):?>
                                                        <a title="NFT List" class="btn btn-primary waves-effect waves-light" href="<?= base_url('NFT/Detail/'.$row['rbt_id']) ?>">
                                                        <i class="mdi mdi-information"></i>
                                                        </a>
                                                    <?php else:?>
                                                        <a href="<?= base_url('NFT/Detail/'.$row['rbt_id']) ?>" class="btn btn-success waves-effect waves-light">
                                                        <i title="Active/Non-Active" class="mdi mdi-plus"></i>
                                                        </a>
                                                    <?php endif ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        endforeach
                                        ?>
                                    <?php else :?>
                                        <tr>
                                            <td colspan="6" align="center">
                                                No Data Available
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-top:100px">
                            <?= $pager->links('default', 'paginationTemplate'); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

    <script>
        function confirmToDelete(el){
            swal({
                title: 'Confirmation',
                text: "Your data will set to active/non-active",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger ml-2',
                confirmButtonText: 'Confirm!'
            }).then(function () {
                $.ajax({
                    type: 'POST',
                    url: el.dataset.href,
                    success: function(resp) {
                        var data = JSON.parse(resp);
                        if (data == "success") {
                            swal({
                                title: 'Success!',
                                text: 'Data Entry Updated.',
                                timer: 1500,
                                type: 'success',
                                showConfirmButton: false,
                            }).then(
                                function () {
                                    window.location.href = window.location.href;
                                }
                            )
                            
                        } else {
                            swal(
                            'Error!',
                            'Internal Server Error!',
                            'danger'
                            )
                        }
                    },
                    error: function(xhr) {
                        swal(
                            'Error!',
                            'Internal Server Error!',
                            'danger'
                        )
                    }
                });
            })
        }
    </script>
<?= $this->endSection('content'); ?>
                