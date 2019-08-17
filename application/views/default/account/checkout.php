<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $setting['shop_description'] ?>" />

    <title><?php echo $setting['shop_name'] ?> - Thanh toán đơn hàng</title>
    
    <link rel="shortcut icon" href="<?php echo base_url('images/'.$setting['shop_icon']) ?>" type="image/x-icon" />

    <link href='<?php echo $base_template.'css/bootstrap.min.css' ?>' rel='stylesheet' type='text/css' />
    <link href='<?php echo $base_template.'fonts/fontawesome/font-awesome.css' ?>' rel='stylesheet' type='text/css' />
    <link href='<?php echo $base_template.'css/checkout.css' ?>' rel='stylesheet' type='text/css' />

 

    
</head>

<body class="body--custom-background-color ">
	<form method="post" action="orders/add<?php echo ($this->input->get('token'))?'?token='.$this->input->get('token'):'' ?>" data-toggle="validator" class="formCheckout">
    <div class="container checkout">
    
	    	<div class="header">
                <div class="wrap">
                    <div class="shop logo logo--left ">
    
        <h1 class="shop__name">
            <a href="/">
                <?php echo $setting['shop_name'] ?>
            </a>
        </h1>
    
</div>
                </div>
            </div>
            <div class="main">
            	<div class="wrap clearfix">
                    <div class="row">
                    	<div class="col-md-4 col-sm-12 order-info"">
                            <div class="order-summary order-summary--custom-background-color ">
                                <div class="order-summary-header summary-header--thin summary-header--border">
                                    <h2>
                                        <label class="control-label">Đơn hàng</label>
                                        <label class="control-label"><?php echo $cart['total_items'] ?></label>
                                    </h2>
                                </div>
                                <div class="order-items">
                                    <div class="summary-body summary-section summary-product" >
                                        <div class="summary-product-list">
                                            <ul class="product-list">
                                                <?php
                                                    foreach ($cart['products'] as $product) {
                                                ?>
                                                    <li class="product product-has-image clearfix">
                                                        <div class="product-thumbnail pull-left">
                                                            <div class="product-thumbnail__wrapper">
                                                                
                                                                    <img src='<?php echo base_url('images/'.$product['image']) ?>' alt='<?php echo $product['name'].' '.$product['option_name'] ?>' class='product-thumbnail__image' />
                                                                
                                                            </div>
                                                            <span class="product-thumbnail__quantity" aria-hidden="true"><?php echo $product['quantity'] ?></span>
                                                        </div>
                                                        <div class="product-info pull-left">
                                                            <span class="product-info-name">
                                                                
                                                                <strong><?php echo $product['name'] ?></strong>
                                                            </span>
                                                            
                                                                <span class="product-info-description">
                                                                    <?php echo $product['option_name'] ?>
                                                                </span>
                                                            
                                                            
                                                        </div>
                                                        <strong class="product-price pull-right">
                                                            <?php echo number_format($product['discount'],0,'','.') ?>
                                                        </strong>
                                                    </li>
                                                <?php
                                                    }
                                                ?>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="summary-section border-top-none--mobile">
                                    <div class="total-line total-line-subtotal clearfix">
                                        <span class="total-line-name pull-left">
                                            Tạm tính
                                        </span>
                                        <span class="total-line-subprice pull-right">
                                            <?php echo number_format($cart['total_money'],0,'','.') ?>
                                        </span>
                                    </div>
                                    <div class="total-line total-line-shipping clearfix" bind-show="requiresShipping">
                                        <span class="total-line-name pull-left">
                                            Phí vận chuyển
                                        </span>
                                        <span class="total-line-shipping pull-right" >
                                            
                                                Miễn phí
                                            
                                        </span>
                                    </div>
                                    <div class="total-line total-line-total clearfix">
                                        <span class="total-line-name pull-left">
                                            Tổng cộng
                                        </span>
                                        <span class="total-line-price pull-right">
                                            <?php echo number_format($cart['total_money'],0,'','.') ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group clearfix hidden-sm hidden-xs">
                                <input class="btn btn-primary col-md-12 mt10 btn-checkout" type="submit" name="checkout" value="ĐẶT HÀNG" />
                            </div>
                            <div class="form-group has-error">
                                <div class="help-block ">
                                    <ul class="list-unstyled">
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 customer-info">
                            <div class="form-group m0">
                                <h2>
                                    <label class="control-label">Thông tin mua hàng</label>
                                </h2>
                            </div>
                            
                            <hr class="divider">
                            
                            <div class="form-group">
                                <input data-error="Vui lòng nhập email đúng định dạng"  required  name="email" id="email" type="email" class="form-control" placeholder="Email" pattern="^([a-zA-Z0-9_\-\.\+]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" 
                                <?php echo ($customer)?'value="'.$customer['email'].'" readonly=""':'' ?> />
                                <div class="help-block with-errors">
                                </div>
                            </div>
                            
                            <div class="billing">
                                <div class="form-group">
                                    <a class="underline-none" href="javascript:void(0)">
                                        <span>Thông tin thanh toán và nhận hàng</span>
                                    </a>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <input data-error="Vui lòng nhập tên" required name="shipping_firstname" id="shipping_firstname" class="form-control" placeholder="Tên" value="<?php echo ($customer)?$customer['firstname']:'' ?>" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input data-error="Vui lòng nhập họ và tên lót" required name="shipping_lastname" id="shipping_lastname" class="form-control" placeholder="Họ và Tên Lót" value="<?php echo ($customer)?$customer['lastname']:'' ?>"  />
                                        <div class="help-block with-errors"></div>
                                    </div>                                        

                                    <div class="form-group">
                                        <input data-error="Vui lòng nhập số điện thoại" required name="shipping_telephone" id="shipping_telephone" class="form-control" placeholder="Số điện thoại" pattern="[0-9]+"value="<?php echo ($customer)?$customer['telephone']:'' ?>"  />
                                        <div class="help-block with-errors"></div>
                                    </div> 
                                
                                    <div class="form-group">
                                        <input data-error="Vui lòng nhập địa chỉ" required name="shipping_address" id="shipping_address" class="form-control" placeholder="Địa chỉ" value="<?php echo ($customer)?$customer['address_1']:'' ?>" />
                                        <div class="help-block with-errors"></div>
                                    </div>                                
                                    
                                    <div class="form-group">
                                        <div class="next-select__wrapper">
                                            <select name="shipping_city_id" id="shipping_city_id" class="form-control next-select" required data-error="Bạn chưa chọn tỉnh thành">
                                                <option value=''>--- Chọn Tỉnh thành ---</option>      
                                                <?php
                                                    foreach ($citys as $city) {
                                                        if ($customer && $city['city_id'] == $customer['city_id'])
                                                            echo '<option value="'. $city['city_id'] .'" selected="selected">'. $city['name'] .'</option>';
                                                        else
                                                            echo '<option value="'. $city['city_id'] .'">'. $city['name'] .'</option>';
                                                    }
                                                ?>
                                            </select>
                                            <span class="next-icon next-icon--size-12">
                                                <img src='//bizweb.dktcdn.net/assets/themes_support/angle-down.png?4' alt='' class='img-responsive' />
                                            </span>
                                        </div>
                                        <div class="help-block with-errors"></div>
                                     </div>
                                        
                                    <div class="form-group">
                                        <div class="next-select__wrapper">
                                            <select name="shipping_zone_id" id="shipping_zone_id" class="form-control next-select" required data-error="Bạn chưa chọn quận huyện"></select>
                                            <span class="next-icon next-icon--size-12">
                                                <img src='//bizweb.dktcdn.net/assets/themes_support/angle-down.png?4' alt='' class='img-responsive' />
                                            </span>
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <hr class="divider" />
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea name="note" value="" class="form-control" placeholder="Ghi chú"></textarea>
                            </div>
                            <?php if ($customer) { ?>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <div class="icheckbox_square" style="position: relative;">
                                            <input type="checkbox" name="otherAddress" id="otherAddress" value="1"  class="icheck square" style="position: absolute; opacity: 0;" />
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;"></ins>
                                        </div>
                                        Giao hàng đến địa chỉ khác
                                    </label>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    	<div class="col-md-4 col-sm-12">
                            <div class="shipping-method">
                                <div class="form-group">
                                    <h2>
                                        <label class="control-label">Phương thức thanh toán</label>
                                    </h2>
                                    <div class="next-select__wrapper">
                                        <select name="payment_id" class="form-control next-select">
                                            <?php foreach ($payment as $key => $value) {
                                                echo '<option value="'. $value['payment_id'] .'">'. $value['name'] .'</option>';
                                            } ?>
                                        </select>
                                        <span class="next-icon next-icon--size-12">
                                            <img src='//bizweb.dktcdn.net/assets/themes_support/angle-down.png?4' alt='' class='img-responsive' />
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main_footer footer unprint">
    
    
    
    <div class="mt10"></div>
</div>
	    </div>
	</form>

<script src="<?php echo $base_template.'js/jquery-1.10.2.min.js' ?>" type='text/javascript'></script>
<script src='<?php echo $base_template.'js/bootstrap.min.js' ?>' type='text/javascript'></script>
<script src='<?php echo $base_template.'js/validator.min.js' ?>' type='text/javascript'></script>
<script type="text/javascript">
function zone() {
    $.ajax({
        url: '<?php echo base_url('common/Zones/autocomplete?filter_city_id=') ?>' + $( "select[name=\'shipping_city_id\'] option:checked" ).val(),
        dataType: 'json',
        beforeSend: function() {
            $('select[name=\'shipping_city_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        complete: function() {
            $('.fa-spin').remove();
        },
        success: function(json) {
            html = '<option value="">--- Chọn Quận huyện ---</option>';

            for (var i = 0; i < json.length; i++) {
                if (json[i]['zone_id'] == <?php echo ($customer)?$customer['zone_id']:'0' ?>)
                    html += '<option value="' + json[i]['zone_id'] + '" selected="selected">' + json[i]['name'] +'</option>';
                else
                    html += '<option value="' + json[i]['zone_id'] + '">' + json[i]['name'] +'</option>';
            }

            $('select[name=\'shipping_zone_id\']').html(html);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}
$('select[name=\'shipping_city_id\']').change(function () {
    zone();
});
zone();

function otherAddress() {
    var check = $('#otherAddress').val();
    if (check == true) {
        $('div.icheckbox_square').removeClass('checked');
        $('#shipping_firstname').attr('readonly', true);
        $('#shipping_lastname').attr('readonly', true);
        $('#shipping_telephone').attr('readonly', true);
        $('#shipping_address').attr('readonly', true);
        $('#shipping_city_id').attr('readonly', true);
        $('#shipping_zone_id').attr('readonly', true);
    }
    else {
        $('div.icheckbox_square').addClass('checked');
        $('#shipping_firstname').removeAttr('readonly');
        $('#shipping_lastname').removeAttr('readonly');
        $('#shipping_telephone').removeAttr('readonly');
        $('#shipping_address').removeAttr('readonly');
        $('#shipping_city_id').removeAttr('readonly');
        $('#shipping_zone_id').removeAttr('readonly');
    }
    check ^= true;
    $('#otherAddress').val(check);
}
$('input[name=\'otherAddress\']').change(function () {
    otherAddress();
});
otherAddress();
</script>	
</body>
</html>