<section class="main-container col1-layout">
	<div class="main container">
		<div class="account-login">
			<div class="page-title">
				<h2>Đăng ký tài khoản thành viên.</h2>
			</div>
			<fieldset class="col2-set">
				<legend>Đăng ký tài khoản thành viên.</legend>
				<div class="registered-users col-lg-12 col-md-12 col-sm-12 col-xs-12"><strong>Thông tin tài khoản</strong>
					<div class="content">
						<p>Hãy điền đầy đủ các thông tin dưới để tạo một tài khoản mới.</p>
						<form accept-charset='UTF-8' id='customer_register' method='post'>						
						<ul class="form-list">
							<div class="row">
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="first_name">Tên <span class="required">*</span></label>
									<br>
									<input type="text" title="Tên" class="input-text required-entry" id="firstname" value="" name="firstname" required>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="last_name">Họ <span class="required">*</span></label>
									<br>
									<input type="text" title="Họ" class="input-text required-entry" id="lastname" value="" name="lastname" required>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="email">Email <span class="required">*</span></label>
									<br>
									<input type="text" title="Địa chỉ email" class="input-text required-entry" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email" value="" name="email" required>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="pass">Mật khẩu <span class="required">*</span></label>
									<br>
									<input type="password" title="Mật khẩu" id="pass" class="input-text required-entry validate-password" name="password" required>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="last_name">Số điện thoại <span class="required">*</span></label>
									<br>
									<input type="text" title="Số điện thoại" class="input-text required-entry" pattern="[0-9]+" id="telephone" value="" name="telephone" required>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="last_name">Fax</label>
									<br>
									<input type="text" title="Fax" class="input-text required-entry" id="fax" value="" name="fax">
								</li>	
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="last_name">Địa chỉ 1 <span class="required">*</span></label>
									<br>
									<input type="text" title="Địa chỉ 1" class="input-text required-entry" id="address_1" value="" name="address_1" required>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="last_name">Địa chỉ 2</label>
									<br>
									<input type="text" title="Địa chỉ 2" class="input-text required-entry" id="address_2" value="" name="address_2">
								</li>	
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="last_name">Thành phố <span class="required">*</span></label>
									<br>
									<select id="city_id" name="city_id" class="form-control">
									<option value=''>--- Chọn Tỉnh thành ---</option> 
									<?php
										foreach ($citys as $city) {
											echo '<option value="'. $city['city_id'] .'">'. $city['name'] .'</option>';
										}
									?>
									</select>
								</li>	
								<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<label for="last_name">Quận huyện <span class="required">*</span></label>
									<br>
									<select id="zone_id" name="zone_id" class="form-control">
									</select>
								</li>
							</div>
						</ul>
						<div class="buttons-set">
							<button id="register" name="register" value="register" type="submit" class="button create-account"><span>Đăng ký</span></button>
							hoặc
							<button onclick="location.href='/account/login'" type="button" class="button login"><span>Đăng nhập</span></button>
						</div>
						</form>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
<script type="text/javascript">
$( "#city_id" ).change(function() {
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
				html += '<option value="' + json[i]['zone_id'] + '">' + json[i]['name'] +'</option>';
			}

			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
</script>
</section>