<?= $this->extend('Layout/_Layout3') ?>

<?= $this->section('content'); ?>
<style>
    .modal-dialog {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}
</style>
<div class="product-area single-pro-area pt-80 pb-80 product-style-2">
    <div class="container">	
        <div class="row shop-list single-pro-info no-sidebar">
            <a href="<?=base_url('product')?>">Back</a>
            <!-- Single-product start -->
            <div class="col-lg-12">
                <div class="single-product clearfix">
                    <!-- Single-pro-slider Big-photo start -->
                    <div class="single-pro-slider single-big-photo view-lightbox slider-for">
                        <div>
                            <?php if(isset($data->pic_data)):?>
                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($data->pic_data); ?>" alt="" />
                            <?php else:?>
                                <img src="<?=base_url('public/assets-customer/img/single-product/medium/1.jpg')?>" alt="" />
                            <?php endif?>
                            <a class="view-full-screen" href="img/single-product/large/1.jpg"  data-lightbox="roadtrip" data-title="My caption">
                                <i class="zmdi zmdi-zoom-in"></i>
                            </a>
                        </div>
                    </div>	
                    <!-- Single-pro-slider Big-photo end -->								
                    <div class="product-info">
                        <div class="fix">
                            <input type="hidden" id="prd_id" name="prd_id" value="<?= $data->prd_id ?>" />
                            <h4 class="post-title floatleft"><?= $data->name ?></h4>
                            <span class="pro-rating floatright">
                                <a href="#"><i class="zmdi zmdi-star"></i></a>
                                <a href="#"><i class="zmdi zmdi-star"></i></a>
                                <a href="#"><i class="zmdi zmdi-star"></i></a>
                                <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                                <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                                <span>( 27 Rating )</span>
                            </span>
                        </div>
                        <div class="fix mb-20">
                            <span class="pro-price">Rp <?= $data->display_price ?></span>
                        </div>
                        <div class="product-description">
                            <p><?= $data->description ?></p>
                        </div>
                        <!-- Size start -->
                        <div class="size-filter single-pro-size mb-35 clearfix">
                            <span class="color-title text-capitalize">Variation</span>
                            <select id="prd_dtl_id" name="prd_dtl_id" class="form-control">
                                <?php foreach ($variation as $row) :?>
                                    <option value='<?= $row['prd_dtl_id']; ?>'><?= $row['variation_name']; ?> | Rp <?= $row['price'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Size end -->
                        <div class="clearfix">
                            <div class="cart-plus-minus">
                                <input id="qty" type="text" value="1" name="qtybutton" class="cart-plus-minus-box">
                            </div>
                            <div style="width:28%" class="product-action clearfix">
                                <a href="#" id="addToCart" style="width:100%" data-bs-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i> Add To Cart</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Single-product end -->
        </div>
        <!-- single-product-tab start -->
        <div class="single-pro-tab">
            <div class="row">
                <div class="col-md-3">
                    <div class="single-pro-tab-menu">
                        <!-- Nav tabs -->
                        <ul class="nav d-block">
                            <li><a href="#information" data-bs-toggle="tab">Information</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane" id="information">
                            <div class="pro-tab-info pro-information">
                                <h3 class="tab-title title-border mb-30">Seller</h3>
                                <p><?= $seller['shop_name'] ?></p> 
                                <button id="slrBtn" type="button" data-toggle="modal" data-target="#sellerModal" data-text="Call Seller" class="button-one submit-button"><i class="zmdi zmdi-phone"></i> Call Seller</button>
                            </div>											
                            <div class="pro-tab-info pro-information">
                                <h3 class="tab-title title-border mb-30">Product information</h3>
                                <p><?= $data->description ?></p>
                            </div>											
                        </div>
                    </div>	
                </div>
            </div>
        </div>
        <!-- single-product-tab end -->
    </div>
    <div class="modal fade" id="sellerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Seller Info | <?= $seller['shop_name'] ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <dt>Shop Name</dt>
            <dd><?= $seller['shop_name'] ?></dd>

            <dt>Description</dt>
            <dd><?= $seller['shop_description'] ?></dd>

            <dt>Email</dt>
            <dd><?= $seller['email'] ?></dd>

            <dt>Telephone</dt>
            <dd><?= $seller['telp'] ?></dd>
        </div>
        <div class="modal-footer">
            <button id="clsMdl" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
</div>
<script>
    function loadCartCount() {
        $.ajax({
            type: 'GET',
            url: "<?= base_url('/Shop/CountCart'); ?>",
            beforeSend: function() {

            },
            complete: function() {

            },
            success: function(resp) {
                var data = JSON.parse(resp);
                $('#cartCount').html(data);
            },
            error: function(xhr) {
                alert('error');
            }
        });
    }
    var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';

    $(document).on('click', '#addToCart', function() {
        if ($('#prd_dtl_id').val() == '0') {
            $('#variationalert').removeClass('hide');
        } else {
            
            var id = $('#prd_id').val();
            var detailid = $('#prd_dtl_id').val();
            var qty = $('#qty').val();
            var product = {
                'productid': id,
                'detailid': detailid,
                'qty': qty
            };

        
            $.ajax({
                type: 'POST',
                url: "<?= base_url('/Shop/addtocart'); ?>",
                data: product,
                xhr: function() {
                        var xhr = $.ajaxSettings.xhr();
                        xhr.upload.onprogress = function(e) {
                        Swal.fire({
                            html: '<h4>Loading...</h4>',
                            onRender: function() {
                                $('.Swal2-content').prepend(sweet_loader);
                            }
                        });
                    };
                    return xhr;
                },
                success: function(resp) {
                    var data = JSON.parse(resp);

                    if(data == 'success') {
                        loadCartCount();
                        setTimeout(function() {
                            Swal.fire({
                                icon: 'success',
                                html: '<h4>Success!</h4>'
                            });
                        }, 700);
                    } 
                    else if(data == 'notloggedin') {
                        window.location = "<?= base_url('/account/signin'); ?>";
                    } else {
                        setTimeout(function() {
                        Swal.fire({
                            icon: 'error',
                            html: '<h4>Whoops!</h4><h5>Something went wrong.</h5>'
                        });
                        }, 700);
                    }
                },
                error: function() {
                    setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        html: '<h4>Whoops!</h4><h5>Something went wrong.</h5>'
                    });
                    }, 700);
                }
            });
        }
    });

    $(document).on('click', '#slrBtn', function() {
        $('#sellerModal').modal('show')
    });

    $(document).on('click', '#clsMdl', function() {
        $('#sellerModal').modal('hide')
    });
    
</script>
<?= $this->endSection('content'); ?>