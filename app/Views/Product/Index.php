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
                <form method="GET" action="<?=base_url('Product/index');?>">
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
                                <label>Name</label>
                                <input class="form-control" type="text" placeholder="search..." name="keyword" value="<?=($searchform)? $searchform['keyword']: ''?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>STATUS</label>
                                <select class="form-control" name="status">
                                    <option value="0" <?= (!$searchform)||($searchform['status']== '0') ?  "selected" : "" ; ?>>All</option>
                                    <option value="Y" <?= ($searchform)&&($searchform['status']== 'Y') ?  "selected" : "" ; ?>>Active</option>
                                    <option value="N" <?= ($searchform)&&($searchform['status']== 'N') ?  "selected" : "" ; ?>>Non-Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button style="float:right" type="submit" class="btn btn-warning waves-effect waves-light">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="row" style="margin-top:50px">
                        <div class="col-md-3">
                            <a href="<?= base_url('Product/New') ?>" class="btn btn-lg btn-success waves-effect waves-light"><i class="mdi mdi-plus" style="margin-right:10px"></i>Add Entry</a>
                        </div>
                    </div>

                    <div style="margin-top:10px" class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table id="qaListTable" class="table  table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%" style="vertical-align: middle;">NO</th>
                                        <th width="10%" style="vertical-align: middle;">NAME</th>
                                        <th width="10%" style="vertical-align: middle;">KEYWORD</th>
                                        <th width="10%" style="vertical-align: middle;">CATEGORY</th>
                                        <th width="10%" style="vertical-align: middle;">DESC</th>
                                        <th width="10%" style="vertical-align: middle;">PRICE</th>
                                        <th width="10%" style="vertical-align: middle;">STATUS</th>
                                        <th width="10%" style="vertical-align: middle; max-width:16%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(sizeof($datalist)!=0):?>
                                        <?php foreach ($datalist as $row) :
                                        ?>
                                        <tr>
                                            <th><?= $nomor++ ?></th>
                                            <td>
                                                <?= $row['name'] ?>
                                            </td>
                                            <td>
                                                <?= $row['slug'] ?>
                                            </td>
                                            <td>
                                                <?= $row['ktg_id'] ?>
                                            </td>
                                            <td>
                                                <?= $row['description'] ?>
                                            </td>
                                            <td>
                                                Rp <?= $row['display_price'] ?>
                                            </td>
                                            <td>
                                                <?php if($row['status']==1):?>
                                                    <span class="badge badge-success">Active</span>
                                                <?php else:?>
                                                    <span class="badge badge-danger">Non-Active</span>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <div class="button-items">
                                                    <a title="Detail" class="btn btn-primary waves-effect waves-light" href="<?= base_url('Product/Detail/'.$row['prd_id']) ?>">
                                                    <i class="mdi mdi-information"></i>
                                                    </a>
                                                    <a title="Edit" class="btn btn-warning waves-effect waves-light" href="<?= base_url('Product/Edit/'.$row['prd_id']) ?>">
                                                    <i class="mdi mdi-lead-pencil"></i>
                                                    </a>
                                                    <?php if($row['status']==1):?>
                                                        <button type="button" data-href="<?= base_url('Product/Delete/'.$row['prd_id']) ?>" onclick="confirmToDelete(this)" class="btn btn-danger waves-effect waves-light">
                                                        <i title="Active/Non-Active" class="mdi mdi-trash-can"></i>
                                                        </button>
                                                    <?php else:?>
                                                        <button type="button" data-href="<?= base_url('Product/Delete/'.$row['prd_id']) ?>" onclick="confirmToDelete(this)" class="btn btn-success waves-effect waves-light">
                                                        <i title="Active/Non-Active" class="mdi mdi-lightbulb-on"></i>
                                                        </button>
                                                    <?php endif ?>
                                                    
                                                </div>
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
                            'error'
                            )
                        }
                    },
                    error: function(xhr) {
                        swal(
                            'Error!',
                            'Internal Server Error!',
                            'error'
                        )
                    }
                });
            })
        }
    </script>
<?= $this->endSection('content'); ?>
                