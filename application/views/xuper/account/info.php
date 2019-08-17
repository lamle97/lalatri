<div class="ps-hero">
  <div class="container">
    <h3>Quản lý thông tin tài khoản</h3>
  </div>
</div>
<main class="ps-main pt-80 pb-80">
  <div class="ps-container">
    <div class="MyAccount">
      <nav class="MyAccount-navigation">
        <ul>
          <li><a href="<?php echo base_url('account') ?>">Trang quản lý</a></li>
          <li class="active"><a href="<?php echo base_url('account/info') ?>">Thông tin tài khoản</a></li>
          <li><a href="<?php echo base_url('account/orders') ?>">Đơn hàng</a></li>
          <li><a href="<?php echo base_url('account/reviews') ?>">Đánh giá</a></li>
          <li><a href="<?php echo base_url('account/wishlists') ?>">Danh sách yêu thích</a></li>
        </ul>
      </nav>  
      <div class="MyAccount-content">   
      	<form accept-charset='UTF-8' id='customer_update' method='post' action="info/update">	
			<div class="col-md-12 mt-10">
				<div class="col-md-6">
					<label for="last_name">Họ <span class="required">*</span></label>
					<input type="text" placeholder="Họ" class="form-control input-text required-entry" id="lastname" value="<?php echo $customer['lastname'] ?>" name="lastname" required>
				</div>
				<div class="col-md-6">
					<label for="first_name">Tên <span class="required">*</span></label>
					<input type="text" placeholder="Tên" class="form-control input-text required-entry" id="firstname" value="<?php echo $customer['firstname'] ?>" name="firstname" required>
				</div>					
			</div>
			<div class="col-md-12 mt-10">
				<div class="col-md-6">
					<label for="email">Email <span class="required">*</span></label>
					<input type="email" placeholder="Địa chỉ email" class="form-control input-text required-entry" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email" value="<?php echo $customer['email'] ?>" name="email" required>	
				</div>
				<div class="col-md-6">
					<label for="pass">Mật khẩu</label>
					<input type="password" placeholder="Nhập nếu thay đổi mật khẩu" id="pass" class="form-control input-text validate-password" name="password">
				</div>					
			</div>		
			<div class="col-md-12 mt-10">
				<div class="col-md-6">
					<label for="last_name">Số điện thoại <span class="required">*</span></label>
					<input type="text" placeholder="Số điện thoại" class="form-control input-text required-entry" pattern="[0-9]+" id="telephone" value="<?php echo $customer['telephone'] ?>" name="telephone" required>
				</div>
				<div class="col-md-6">
					<label for="last_name">Fax</label>
					<input type="text" placeholder="Fax" class="form-control input-text" id="fax" value="<?php echo $customer['fax'] ?>" name="fax">
				</div>					
			</div>	
			<div class="col-md-12 mt-10">
				<div class="col-md-6">
					<label for="last_name">Địa chỉ 1 <span class="required">*</span></label>
					<input type="text" placeholder="Địa chỉ 1" class="form-control input-text required-entry" id="address_1" value="<?php echo $customer['address_1'] ?>" name="address_1" required>
				</div>
				<div class="col-md-6">
					<label for="last_name">Địa chỉ 2</label>
					<input type="text" placeholder="Địa chỉ 2" class="form-control input-text" id="address_2" value="<?php echo $customer['address_2'] ?>" name="address_2">
				</div>					
			</div>
			<div class="col-md-12 mt-10">
				<div class="col-md-6">
					<label for="last_name">Thành phố <span class="required">*</span></label>
					<select id="city_id" name="city_id" class="form-control ps-select selectpicker">
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
				</div>
				<div class="col-md-6">
					<label for="last_name">Quận huyện <span class="required">*</span></label>
					<select id="zone_id" name="zone_id" class="form-control ps-select selectpicker"></select>
				</div>					
			</div>				
			<div class="col-md-12 mt-20">	
				<button id="update" name="update" value="update" type="submit" class="ps-btn button"><i class="fa fa-edit"></i> Cập nhật</button>	
				<input type="checkbox" name="newsletter" value="1" <?php echo ($customer['newsletter'])?'checked="checked"':'' ?>> Nhận thông báo từ website	
			</div>      		
      	</form> 
      </div>
    </div>
  </div>
</main>

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
			$('.selectpicker').selectpicker('refresh');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}
$( "#city_id" ).on('change', zone);
zone();
</script>
