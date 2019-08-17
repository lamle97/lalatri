<div class="ps-hero">
  <div class="container">
    <h3>Đăng ký tài khoản</h3>
  </div>
</div>
<main class="ps-main pt-40 pb-40">
	<?php if (isset($error)) { ?>
	<div class="ps-container">
		<ul class="xuper-error" role="alert">
			<li><strong>Lỗi:</strong> Email đã tồn tại, vui lòng thử lại email khác hoặc thử đăng nhập bằng email này.</li>
		</ul>
	</div>
	<?php } ?>	
	<div class="ps-container">
		<div class="col-md-12">
			<h2>Đăng ký</h2>
			<p>Hãy điền đầy đủ các thông tin dưới để tạo một tài khoản mới.</p>
			<form class="login" method="post">
				<div class="col-md-12 mt-10">
					<div class="col-md-6">
						<label for="last_name">Họ <span class="required">*</span></label>
						<input type="text" placeholder="Họ" class="form-control input-text required-entry" id="lastname" value="" name="lastname" required>
					</div>
					<div class="col-md-6">
						<label for="first_name">Tên <span class="required">*</span></label>
						<input type="text" placeholder="Tên" class="form-control input-text required-entry" id="firstname" value="" name="firstname" required>
					</div>					
				</div>
				<div class="col-md-12 mt-10">
					<div class="col-md-6">
						<label for="email">Email <span class="required">*</span></label>
						<input type="email" placeholder="Địa chỉ email" class="form-control input-text required-entry" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email" value="" name="email" required>	
					</div>
					<div class="col-md-6">
						<label for="pass">Mật khẩu <span class="required">*</span></label>
						<input type="password" placeholder="Mật khẩu" id="pass" class="form-control input-text required-entry validate-password" name="password" required>
					</div>					
				</div>		
				<div class="col-md-12 mt-10">
					<div class="col-md-6">
						<label for="last_name">Số điện thoại <span class="required">*</span></label>
						<input type="text" placeholder="Số điện thoại" class="form-control input-text required-entry" pattern="[0-9]+" id="telephone" value="" name="telephone" required>
					</div>
					<div class="col-md-6">
						<label for="last_name">Fax</label>
						<input type="text" placeholder="Fax" class="form-control input-text" id="fax" value="" name="fax">
					</div>					
				</div>	
				<div class="col-md-12 mt-10">
					<div class="col-md-6">
						<label for="last_name">Địa chỉ 1 <span class="required">*</span></label>
						<input type="text" placeholder="Địa chỉ 1" class="form-control input-text required-entry" id="address_1" value="" name="address_1" required>
					</div>
					<div class="col-md-6">
						<label for="last_name">Địa chỉ 2</label>
						<input type="text" placeholder="Địa chỉ 2" class="form-control input-text" id="address_2" value="" name="address_2">
					</div>					
				</div>
				<div class="col-md-12 mt-10">
					<div class="col-md-6">
						<label for="last_name">Thành phố <span class="required">*</span></label>
						<select id="city_id" name="city_id" class="form-control ps-select selectpicker">
							<option value=''>--- Chọn Tỉnh thành ---</option> 
							<?php
								foreach ($citys as $city) {
									echo '<option value="'. $city['city_id'] .'">'. $city['name'] .'</option>';
								}
							?>
						</select>
					</div>
					<div class="col-md-6">
						<label for="last_name">Quận huyện <span class="required">*</span></label>
						<select id="zone_id" name="zone_id" class="form-control ps-select selectpicker"></select>
					</div>					
				</div>				
				<div class="col-md-12 mt-20">	
					<button id="register" name="register" value="register" type="submit" class="ps-btn button"><i class="fa fa-key"></i> Đăng ký</button>		
				</div>
			</form>
		</div>
	</div>
</main>

<script type="text/javascript">
$( "#city_id" ).on('change', function() {
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
			$('.selectpicker').selectpicker('refresh');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
</script>
