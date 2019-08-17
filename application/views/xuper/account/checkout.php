<div class="ps-hero">
  <div class="container">
    <h3>Thanh toán</h3>
  </div>
</div>
<div class="ps-checkout pt-40 pb-40">
    <div class="ps-container">
        <form class="ps-form--checkout" action="orders/add<?php echo ($this->input->get('token'))?'?token='.$this->input->get('token'):'' ?>" data-toggle="validator" method="post">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                    <div class="ps-checkout__billing">
                        <h3>Thông tin mua hàng</h3>
                        <div class="form-group form-group--inline">
                            <label>Email<span>*</span>
                            </label>
                            <div class="form-group__content">
                                <input required  name="email" id="email" type="email" class="form-control" placeholder="Địa chỉ email" pattern="^([a-zA-Z0-9_\-\.\+]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" 
                                <?php echo ($customer)?'value="'.$customer['email'].'" readonly=""':'' ?> />
                            </div>
                        </div>
                        <h3 class="mt-40"> Thông tin thanh toán và nhận hàng</h3>
                        <div class="form-group form-group--inline">
                            <label>Họ và tên lót<span>*</span>
                            </label>
                            <div class="form-group__content">
                                <input required name="shipping_lastname" id="shipping_lastname" class="form-control" placeholder="Họ và Tên Lót" value="<?php echo ($customer)?$customer['lastname']:'' ?>"  />
                            </div>
                        </div>
                        <div class="form-group form-group--inline">
                            <label>Tên<span>*</span>
                            </label>
                            <div class="form-group__content">
                                <input required name="shipping_firstname" id="shipping_firstname" class="form-control" placeholder="Tên" value="<?php echo ($customer)?$customer['firstname']:'' ?>" />
                            </div>
                        </div>
                        <div class="form-group form-group--inline">
                            <label>Số điện thoại<span>*</span>
                            </label>
                            <div class="form-group__content">
                                <input required name="shipping_telephone" id="shipping_telephone" class="form-control" placeholder="Số điện thoại" pattern="[0-9]+"value="<?php echo ($customer)?$customer['telephone']:'' ?>"  />
                            </div>
                        </div>
                        <div class="form-group form-group--inline">
                            <label>Địa chỉ<span>*</span>
                            </label>
                            <div class="form-group__content">
                                <input required name="shipping_address" id="shipping_address" class="form-control" placeholder="Địa chỉ" value="<?php echo ($customer)?$customer['address_1']:'' ?>" />
                            </div>
                        </div>
                        <div class="form-group form-group--inline">
                            <label>Thành phố<span>*</span>
                            </label>
                            <div class="form-group__content">
	                            <select name="shipping_city_id" id="shipping_city_id" class="form-control ps-select selectpicker" required>
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
                            </div>
                        </div>
                        <div class="form-group form-group--inline">
                            <label>Quận huyện<span>*</span>
                            </label>
                            <div class="form-group__content">
                                <select name="shipping_zone_id" id="shipping_zone_id" class="form-control ps-select selectpicker" required></select>
                            </div>
                        </div>
                        <h3 class="mt-40"> Thông tin bổ sung</h3>
                        <div class="form-group form-group--inline textarea">
                            <label>Ghi chú</label>
                            <textarea name="note" value="" class="form-control" placeholder="Thông tin bổ sung thêm của bạn cho việc đặt hàng và giao hàng"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                    <div class="ps-checkout__order">
                        <header>
                            <h3>Đơn hàng</h3>
                        </header>
                        <div class="content">
                            <table class="table ps-checkout__products">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase">Sản phẩm</th>
                                        <th class="text-uppercase">Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart['products'] as $product) { ?>
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            <?php echo $product['name'].' - '.$product['option_name'] ?> <strong class="product-quantity">× <?php echo $product['quantity'] ?></strong>
                                        </td>
                                        <td class="product-total">
                                            <?php echo number_format($product['discount'],0,'','.') ?>
                                        </td>
                                    </tr>
                                     <?php } ?> 
                                    <tr class="shipping">
                                        <td>Phí vận chuyển</td>
                                        <td data-title="Shipping">
                                            Miễn phí
                                        </td>
                                    </tr>  
                                    <tr class="order-total">
                                        <td>Tổng cộng</td>
                                        <td><strong><?php echo number_format($cart['total_money'],0,'','.') ?></strong> </td>
                                    </tr>                                                                   
                                </tbody>
                            </table>
                        </div>
                        <footer>
                            <h3>Phương thức thanh toán</h3>
                            <?php foreach ($payment as $key => $value) { ?>
                                <div class="form-group cheque">
                                    <div class="ps-radio ps-radio--small">
                                        <input class="form-control" type="radio" name="payment_id" value="<?php echo $value['payment_id']; ?>" id="rdo<?php echo $value['payment_id']; ?>" checked>
                                        <label for="rdo<?php echo $value['payment_id']; ?>"><?php echo $value['name']; ?></label>
                                    </div>
                                    <p><?php echo $value['method']; ?></p>   
                                </div>                                    
                            <?php } ?>
                            <input class="ps-btn ps-btn--fullwidth" type="submit" name="checkout" value="Đặt Hàng" />
                        </footer>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

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
			html = '';

			for (var i = 0; i < json.length; i++) {
				if (json[i]['zone_id'] == <?php echo $customer['zone_id'] ?>)
					html += '<option value="' + json[i]['zone_id'] + '" selected="selected">' + json[i]['name'] +'</option>';
				else
					html += '<option value="' + json[i]['zone_id'] + '">' + json[i]['name'] +'</option>';
			}

			$('select[name=\'shipping_zone_id\']').html(html);
			$('.selectpicker').selectpicker('refresh');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}
$( "#shipping_city_id" ).on('change', zone);
zone();
</script>