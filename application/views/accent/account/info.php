<section class="main-container col2-right-layout">
	<div class="main container">
      <div class="row">
        <section class="col-main col-sm-9 wow bounceInUp animated">	
		<div class="account-login">
			<div class="page-title">
				<h2>Quản lý thông tin tài khoản</h2>
			</div>
			<fieldset class="col2-set">
				<div class="registered-users"><strong>Thông tin tài khoản</strong>
					<div class="content">
						<form accept-charset='UTF-8' id='customer_update' method='post' action="info/update">						
						<ul class="form-list">
							<div class="row">
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="first_name">Tên <span class="required">*</span></label>
									<br>
									<input type="text" title="Tên" class="input-text required-entry" id="firstname" value="<?php echo $customer['firstname'] ?>" name="firstname" required>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="last_name">Họ <span class="required">*</span></label>
									<br>
									<input type="text" title="Họ" class="input-text required-entry" id="lastname" value="<?php echo $customer['lastname'] ?>" name="lastname" required>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="email">Email <span class="required">*</span></label>
									<br>
									<input type="text" title="Địa chỉ email" class="input-text required-entry" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email" value="<?php echo $customer['email'] ?>" name="email" readonly="" required>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="pass">Mật khẩu <span class="required">*</span></label>
									<br>
									<input type="password" title="Mật khẩu" id="pass" class="input-text required-entry validate-password" name="password">
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="telephone">Số điện thoại <span class="required">*</span></label>
									<br>
									<input type="text" title="Số điện thoại" class="input-text required-entry" pattern="[0-9]+" id="telephone" value="<?php echo $customer['telephone'] ?>" name="telephone" required>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="fax">Fax</label>
									<br>
									<input type="text" title="Fax" class="input-text required-entry" id="fax" value="<?php echo $customer['fax'] ?>" name="fax">
								</li>	
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="address_1">Địa chỉ 1 <span class="required">*</span></label>
									<br>
									<input type="text" title="Địa chỉ 1" class="input-text required-entry" id="address_1" value="<?php echo $customer['address_1'] ?>" name="address_1" required>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="address_2">Địa chỉ 2</label>
									<br>
									<input type="text" title="Địa chỉ 2" class="input-text required-entry" id="address_2" value="<?php echo $customer['address_2'] ?>" name="address_2">
								</li>	
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="city_id">Thành phố <span class="required">*</span></label>
									<br>
									<select id="city_id" name="city_id" class="form-control">
									<option value=''>--- Chọn Tỉnh thành ---</option> 
									<?php
										foreach ($citys as $city) {
											if ($customer['city_id'] == $city['city_id'])
												echo '<option value="'. $city['city_id'] .'" selected="selected">'. $city['name'] .'</option>';
											else
												echo '<option value="'. $city['city_id'] .'">'. $city['name'] .'</option>';
										}
									?>
									</select>
								</li>	
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="zone_id">Quận huyện <span class="required">*</span></label>
									<br>
									<select id="zone_id" name="zone_id" class="form-control">
									</select>
								</li>
								<li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<input type="checkbox" name="newsletter" value="1" <?php echo ($customer['newsletter'])?'checked="checked"':'' ?>> Nhận thông báo từ website
								</li>								
							</div>
						</ul>
						<div class="buttons-set">
							<button id="update" name="update" value="update" type="submit" class="button create-account"><span>Cập nhật</span></button>
						</div>
						</form>
					</div>
				</div>
			</fieldset>			
		</div>
		</section>
        <aside class="col-right sidebar col-sm-3 wow bounceInUp animated">
          <div class="block block-account">
            <div class="block-title">Tài khoản của tôi</div>
            <div class="block-content">
              <ul>
                <li><a href="<?php echo base_url('account') ?>">Trang quản lý</a></li>
                <li class="current"><a>Thông tin tài khoản</a></li>
                <li><a href="<?php echo base_url('account/orders') ?>">Đơn hàng</a></li>
                <li><a href="<?php echo base_url('account/reviews') ?>">Đánh giá</a></li>
                <li><a href="<?php echo base_url('account/wishlists') ?>">Danh sách yêu thích</a></li>
              </ul>
            </div>
          </div>
        </aside>		
	</div>
</div>
<script type="text/javascript">
function zone() {
	$.ajax({
		url: '<?php echo base_url('common/Zones/autocomplete?filter_city_id=') ?>' + $( "select#city_id option:checked" ).val(),
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'city_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
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

			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
}
$( "#city_id" ).change(function() {
	zone();
});
zone();
</script>
</section>