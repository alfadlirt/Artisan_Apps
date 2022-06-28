<?= $this->extend('Layout/_Layout2') ?>

<?= $this->section('content'); ?>
    <div class="page-title-box">
        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Product</h4>
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Artisan Seller</a>
                        </li>
                        <li class="breadcrumb-item active">Product</li>
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
                    <h4 class="mt-0 header-title">Add New Product Entry</h4>
                    <a href="<?= base_url('Product/Index');?>" class="btn btn-sm btn-outline-secondary mb-2">Back</a>
                    <?php $validation = \Config\Services::validation(); ?>
                    <form method="post" action="<?= base_url('Product/Save') ?>" id="formCreate" enctype='multipart/form-data'>
                    <input type="hidden" id="arraydetail" name="variationdata">
                    <div style="margin-top:50px">
                        <div class="form-group">
                            <label>PRODUCT NAME</label><span style="color:red;">*</span>
                            <input name="name" class="form-control" type="text" value="<?=isset($data)?$data['name']:''?>">
                            <?php if($validation->getError('name')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('name'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>CATEGORY</label><span style="color:red;">*</span>
                            <select id="ktg_id" name="ktg_id" class="form-control">
                                <?php foreach ($category as $s) : ?>
                                    <option value='<?= $s['ktg_id']; ?>'><?= $s['ktg_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if($validation->getError('category')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('category'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>DESCRIPTION</label><span style="color:red;">*</span>
                            <textarea class="form-control" name="description"><?=isset($data)?$data['description']:''?></textarea>
                            <?php if($validation->getError('description')) {?>
                                <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('description'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label>PHOTO</label>
                            <input name="mainpic" id="mainpic" type="file" value="<?=isset($photo)?$photo['prd_pic_id']:''?>"/>
                        </div>
                        <div class="form-group">
                            <label>Item Variation</label>
                            <button style="display:block;cursor:pointer;" type="button" name="add" id="add" class="btn btn-fw accent"><span class='fa fa-plus' style="padding-right:20px"></span>Add Variation</button>

                            <div class="form-group" style="padding-top:20px" id="detailtable">
                                <table class="table table-bordered" id="crud_table">
                                    <tr>
                                        <th width="55%">Variation Name</th>
                                        <th width="25%">Quantity</th>
                                        <th width="25%">Price (Rp)</th>
                                        <th width="5%" style="border-left-style: none"></th>
                                    </tr>
                                    <tr>
                                        <td contenteditable="true" class="variation_name"></td>
                                        <td contenteditable="true" class="variation_qty numeric"></td>
                                        <td contenteditable="true" class="variation_price numeric"></td>
                                        <td style="border-left-style: none"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row" style="padding-top:20px; display:none" id="alertDetailDiv">
                                <div class="col">
                                    <div class="alert alert-danger" role="alert" id="detailAlertMsg">
                                        Please Fill Variation With Valid Value !
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="margin-top:50px">
                            <button id="btnSave" type="submit" value="Simpan" class="btn btn-lg btn-info waves-effect waves-light">Submit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col -->
        
    </div>
    <!-- end row -->
    <script type="text/javascript">
    function ValidateSize(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MiB
        if (FileSize > 2) {
            return false;
        } else {
            return true;
        }
    }

    function ValidateInput() {
        var validate3 = [0];

        var variation_name = [];
        var variation_qty = [];
        var variation_price = [];
        $('.variation_name').each(function() {
            variation_name.push($(this).text());
        });
        $('.variation_qty').each(function() {
            variation_qty.push($(this).text());
        });
        $('.variation_price').each(function() {
            variation_price.push($(this).text());
        });

        var itemdetail = [];
        var i;
        var limit = variation_name.length;

        for (i = 0; i < limit; i++) {
            var vname = variation_name[i];
            var vqty = variation_qty[i];
            var vprc = variation_price[i];
            var itemdetails = {
                NamaVariasi: vname,
                Qty: vqty,
                Price: vprc
            };
            itemdetail.push(itemdetails);
        }
        var detailvalid = true;
        for (i = 0; i < itemdetail.length; i++) {
            var varname = itemdetail[i].NamaVariasi;
            var varqty = itemdetail[i].Qty;
            var varprc = itemdetail[i].Price;
            if (varname == '' || varqty == '' || varprc == '') {
                detailvalid = false;
            }
        }
        if (detailvalid == true) {
            var itemdetailwrapped = JSON.stringify(itemdetail);
            $('#arraydetail').val(itemdetailwrapped);
            validate3[0] = 1;
        } else {
            //$('#detailtable').addClass('alertborder');
            validate3[0] = 0;
            $('#alertDetailDiv').removeClass('hide');
        }


        if (validate3[0] == 1) {
            return true;
        } else {
            return false;
        }
    }

    function setClearFor(input) {
        var alert = $(input).parent().closest(".form-group").find('.validate-alert');
        $(input).removeClass('input-invalid');
        alert.addClass('hide');
    }

    function setErrorFor(input, message) {
        var alert = $(input).parent().closest(".form-group").find('.validate-alert');
        $(input).addClass('input-invalid');
        alert.removeClass('hide');
        alert.html(message);
    }

    function isChar(textbox) {
        return /^[a-zA-Z]*$/g.test(textbox);
    }

    function Clear(element) {
        if ($(element).hasClass("form-control input-invalid")) {
            setClearFor(element);
        }
    }
    var count = 1;
    $('#add').click(function() {
        $('#alertvalidation').removeClass('show');
        count = count + 1;
        var html_code = "<tr id='row" + count + "'>";
        html_code += "<td contenteditable='true' class='variation_name'></td>";
        html_code += "<td contenteditable='true' class='variation_qty numeric' ></td>";
        html_code += "<td contenteditable='true' class='variation_price numeric' ></td>";
        html_code += "<td style='border-left-style: none'><button type='button' name='remove' data-row='row" + count + "' class='btn btn-danger btn-xs remove'><span class='fa fa-trash fa-lg'></span></button></td>";
        html_code += "</tr>";
        $('#crud_table').append(html_code);
        $('#alertDetailDiv').hide();
    });

    $(document).on('click', '.remove', function() {
        $('#alertvalidation').removeClass('show');
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
        count = count - 1;
        $('#alertDetailDiv').hide();
    });
    $(document).ready(function() {
        $('select').change(function() {
            Clear(this);
        });
        $('input[type=text],input[type=number]').on('input', function() {
            Clear(this);
        });
        $('textarea').on('input', function() {
            Clear(this);
        });

        $('.pic-add').click(function() {
            var input = $(this).parent().closest(".picture").find('.pic-input');
            input.click();
        });

        $('.pic-remove').click(function() {
            var input = $(this).parent().closest(".picture").find('.pic-input');
            input.val('');
            var img = $(this).parent().closest(".picture").find('.pic-box').attr('src', "<?php echo base_url('public/assets/images/img_placeholder.png') ?>");

            $(this).parent().closest(".picture").find('.pic-add').removeClass('hide');
            $(this).hide();
        });
        $('#mainpicInput').on('change', function() {
            $('#mainpicDiv').removeClass('alertborder');
            $('#alertDiv').hide();
        })
        $('.pic-input').on('change', function(e) {
            $(this).parent().removeClass('alertborder');
            $('#alertDiv').hide();
            if (ValidateSize(this)) {
                var image_name = $(this).val();
                var file = e.target.files[0];
                if (image_name == '') {
                    alert("Please Select Image");
                    return false;
                } else {
                    var extension = $(this).val().split('.').pop().toLowerCase();
                    if (jQuery.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                        alert('Invalid Image File');
                        $(this).val('');
                        return false;
                    } else {
                        $(this).parent().closest(".picture").find('.pic-box').attr('src', URL.createObjectURL(file));
                        $(this).parent().closest(".picture").find('.pic-add').addClass('hide');
                        $(this).parent().closest(".picture").find('.pic-remove').show();
                    }
                }
            } else {
                $(this).parent().addClass('alertborder');
                $('#alertDiv').show();
                $('#alertMessage').html('Maximum Size Is 2 MB');
            }
        });
        $('.numeric').keypress(function(event) {
            var charCode = (event.which) ? event.which : event.keyCode
            if (charCode >= 48 && charCode <= 57)
                return true;
            return false;
        })
        $('.variation_qty').on('input', function() {
            $('#alertDetailDiv').addClass('hide');
        })
        $('.variation_name').on('input', function() {
            $('#alertDetailDiv').addClass('hide');
        })
        $('.variation_price').on('input', function() {
            $('#alertDetailDiv').addClass('hide');
        })

    });
    $('#btnSave').click(function(event) {
        event.preventDefault();
        if (ValidateInput() == true) {
            $("#formCreate").submit();
        } else {
            //return false;
        }
    })
</script>
<?= $this->endSection('content'); ?>