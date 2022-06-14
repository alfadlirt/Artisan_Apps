<?= $this->extend('Layout/_Layout') ?>

<?= $this->section('content'); ?>
    <div class="page-title-box">
        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Powerups</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Heraio Admin</a>
                        </li>
                        <li class="breadcrumb-item active">Powerups</li>
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
                <form method="GET" action="<?=base_url('Powerup/Index');?>">
                    <div style="margin-top:50px" class="row">
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
                    
                    <div style="margin-top:10px" class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Powerup TOKEN / LINK</label>
                                <input class="form-control" type="text" placeholder="search..." name="keyword" value="<?=($searchform)? $searchform['keyword']: ''?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>TYPE</label>
                                <select class="form-control" name="type">
                                    <option value="0" <?= (!$searchform)||($searchform['type']== '0') ?  "selected" : "" ; ?>>All</option>
                                    <option value="POWER" <?= ($searchform)&&($searchform['type']== 'POWER') ?  "selected" : "" ; ?>>Power</option>
                                    <option value="INTELLIGENCE" <?= ($searchform)&&($searchform['type']== 'INTELLIGENCE') ?  "selected" : "" ; ?>>Intelligence</option>
                                    <option value="AGILITY" <?= ($searchform)&&($searchform['type']== 'AGILITY') ?  "selected" : "" ; ?>>Agility</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>STATUS</label>
                                <select class="form-control" name="status">
                                    <option value="0" <?= (!$searchform)||($searchform['status']== '0') ?  "selected" : "" ; ?>>All</option>
                                    <option value="N" <?= ($searchform)&&($searchform['status']== 'N') ?  "selected" : "" ; ?>>Available</option>
                                    <option value="Y" <?= ($searchform)&&($searchform['status']== 'Y') ?  "selected" : "" ; ?>>Registered</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button style="float:right" type="submit" class="btn btn-warning waves-effect waves-light">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="row" style="margin-top:50px">
                    <!-- Button trigger modal -->
                        <div class="col-md-3">
                            <button type="button" id="btnGenerateModal" class="btn btn-lg btn-success waves-effect waves-light"><i class="mdi mdi-plus" style="margin-right:10px"></i>Generate Token</button>
                        </div>
                        <!--  Modal content for the above example -->
                        
                    </div>
                    <div style="margin-top:10px" class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%" style="vertical-align: middle;">NO</th>
                                        <th width="30%" style="vertical-align: middle;">TOKEN</th>
                                        <th width="30%" style="vertical-align: middle;">TYPE</th>
                                        <th width="30%" style="vertical-align: middle;">PTS</th>
                                        <th width="20%" style="vertical-align: middle;">LINK</th>
                                        <th width="10%" style="vertical-align: middle;">CREATED DATE</th>
                                        <th width="10%" style="vertical-align: middle;">CREATED BY</th>
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
                                                <?= $row['powerup_token'] ?>
                                            </td>
                                            <td>
                                                <?= $row['type'] ?>
                                            </td>
                                            <td>
                                                <?= $row['pts'] ?>
                                            </td>
                                            <td>
                                                <?php if($row['link']==''):?>
                                                    <span class="badge badge-warning">please fill this link</span>
                                                <?php else:?>
                                                    <a href="<?= $row['link'] ?>" target="_blank"><?= $row['link'] ?></a>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                            <?= $row['created_date'] ?>
                                            </td>
                                            <td>
                                            <?= $row['created_by'] ?>
                                            </td>
                                            <td>
                                                <?php if($row['is_registered']=='N'):?>
                                                    <span class="badge badge-success">available</span>
                                                <?php else:?>
                                                    <span class="badge badge-secondary">registered</span>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <div class="button-items">
                                                    <?php if($row['is_registered']=='N'):?>
                                                    <button title="Edit" class="btn btn-warning waves-effect waves-light btnEditModal" type="button">
                                                    <i class="mdi mdi-lead-pencil"></i>
                                                    </button>

                                                    <button title="Delete" class="btn btn-danger waves-effect waves-light btnDeleteToken" type="button">
                                                    <i class="mdi mdi-trash-can"></i>
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
                                            <td colspan="9" align="center">
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
                <div class="modal fade bs-example-modal-lg" tabindex="0" role="dialog" id="powerupModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myLargeModalLabel">Generate Powerup Token</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6" id="tokenDiv">
                                        <div class="form-group">
                                            <label>Token</label><span style="color:red;"></span>
                                            <input id="token" name="token" class="form-control" type="text" readonly style="max-width:85%;display:inline;overflow-x:scroll">
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="nitemsDiv">
                                        <div class="form-group">
                                            <label>Add</label><span style="color:red;">*</span>
                                            <input id="nitems" name="nitems" class="form-control" type="number" value="1" min="1" style="max-width:60%;display:inline">
                                            <label class="sub-title">Token</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="typeDiv">
                                        <div class="form-group">
                                            <label>Type</label><span style="color:red;">*</span>
                                            <select class="form-control" name="type" id="type" style="max-width:60%;display:inline">
                                                <option value="POWER">Power</option>
                                                <option value="INTELLIGENCE">Intelligence</option>
                                                <option value="AGILITY">Agility</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="generateDiv">
                                        <div class="form-group">
                                            <label>Points</label><span style="color:red;">*</span>
                                            <input id="pts" name="pts" class="form-control" type="number" value="100" min="1"readonly style="max-width:60%;display:inline">
                                            <label class="sub-title">Points</label>
                                        </div>
                                        <button data-href="<?=base_url('Powerup/GenerateToken')?>" style="float:right" type="button" id="btnGenerate" class="btn btn-success waves-effect waves-light">Generate</button>
                                    </div>
                                    <div class="col-md-12" id="updateDiv">
                                        <div class="form-group">
                                            <label>Link</label><span style="color:red;"></span>
                                            <input id="link" name="link" class="form-control" type="text">
                                        </div>
                                        <button data-href="<?=base_url('Powerup/UpdateToken')?>" style="float:right" type="button" id="btnUpdate" class="btn btn-success waves-effect waves-light">Update</button>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <script>
    $(document).ready(function(){
        $("#btnGenerate").click(function(el){
            var datawrapped = {
                'nitems': $('#nitems').val(),
                'type': $('#type').val(),
                'pts': $('#pts').val()
            };
            swal({
                title: 'Confirmation',
                text: "You will generate powerup token",
                type: 'info',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger ml-2',
                confirmButtonText: 'Confirm!'
            }).then(function () {
                $.ajax({
                    type: 'POST',
                    data: datawrapped,
                    url: $('#btnGenerate').data('href'),
                    success: function(resp) {
                        console.log(resp);
                        var data = JSON.parse(resp);
                        if (data == "success") {
                            swal({
                                title: 'Success!',
                                text: 'Powerup Token Generated.',
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
        });

        $("#btnGenerateModal").click(function(el){
            $("#powerupModal").find("#updateDiv").hide();
            $("#powerupModal").find("#tokenDiv").hide();
            $("#powerupModal").find("#nitemsDiv").show();
            $("#powerupModal").find("#generateDiv").show();
            
            $("#powerupModal").find("#typeDiv").removeClass();
            $("#powerupModal").find("#typeDiv").addClass('col-md-4');

            $("#type").val("POWER");

            $('#powerupModal').modal('show');    
        });

        $(".btnEditModal").click(function(el){
            var token = $(this).closest("tr").find("td").html().trim();
            var link;
            var datawrapped = {
                'token': token
            };
            
            $.ajax({
                type: 'POST',
                data: datawrapped,
                url: <?="'".base_url('Powerup/GetDetail')."'"?>,
                success: function(resp) {
                    var data = JSON.parse(resp);
                    if (data.status == "success") {
                        $('#token').val(token);
                        $('#type').val(data.type);
                        $('#link').val(data.link);

                        $("#powerupModal").find("#updateDiv").show();
                        $("#powerupModal").find("#tokenDiv").show();
                        $("#powerupModal").find("#nitemsDiv").hide();
                        $("#powerupModal").find("#generateDiv").hide();

                        $("#powerupModal").find("#typeDiv").removeClass();
                        $("#powerupModal").find("#typeDiv").addClass('col-md-6');

                        $('#powerupModal').modal('show');     
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
        });

        $("#btnUpdate").click(function(el){
            var datawrapped = {
                'token': $('#token').val(),
                'type': $('#type').val(),
                'link': $('#link').val()
            };
            swal({
                title: 'Confirmation',
                text: "You will update Powerup data",
                type: 'info',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger ml-2',
                confirmButtonText: 'Confirm!'
            }).then(function () {
                $.ajax({
                    type: 'POST',
                    data: datawrapped,
                    url: <?="'".base_url('Powerup/UpdateToken')."'"?>,
                    success: function(resp) {
                        console.log(resp);
                        var data = JSON.parse(resp);
                        if (data == "success") {
                            swal({
                                title: 'Success!',
                                text: 'Powerup Link Updated.',
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
        });

        $(".btnDeleteToken").click(function(el){
            var token = $(this).closest("tr").find("td").html().trim();
            var datawrapped = {
                'token': token
            };
            swal({
                title: 'Confirmation',
                text: "Deleted Token Can't Be Restored! Are You Sure?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger ml-2',
                confirmButtonText: 'Confirm!'
            }).then(function () {
                $.ajax({
                    type: 'POST',
                    data: datawrapped,
                    url: <?="'".base_url('Powerup/DeleteToken')."'"?>,
                    success: function(resp) {
                        console.log(resp);
                        var data = JSON.parse(resp);
                        if (data == "success") {
                            swal({
                                title: 'Success!',
                                text: 'Powerup Token Deleted.',
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
        });
    });
    </script>
<?= $this->endSection('content'); ?>
                