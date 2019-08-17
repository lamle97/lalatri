<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="page-title">
        <h2>Register</h2>
      </div>
    </div>
  </div>
</div>
<div class="row clearfix f-space10"></div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
	<form accept-charset='UTF-8' id='customer_register' method='post'>
	    <fieldset>
	        <div class="required form-group">
	            <label for="firstname" class="required"> First name </label>
	            <input class="is_required validate form-control" id="firstname" name="firstname" value="" required="" type="text">
	        </div>
	        <div class="required form-group">
	            <label for="lastname" class="required"> Last name </label>
	            <input class="is_required validate form-control" name="lastname" id="lastname" value="" required="" type="text">
	        </div>
	        <div class="required form-group">
	            <label for="email" class="required"> E-mail address </label>
	            <input class="is_required validate form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" id="email" value="" required="" type="email">
	        </div>
	        <div class="required form-group">
	            <label for="telephone" class="required"> Telephone </label>
	            <input class="is_required validate form-control" pattern="[0-9]+" name="telephone" id="telephone" value="" required="" type="text">
	        </div>
	        <div class="form-group">
	            <label for="fax"> Fax </label>
	            <input class="validate form-control" pattern="[0-9]+" name="fax" id="fax" value="" type="text">
	        </div>	
	        <div class="required form-group">
	            <label for="address_1" class="required"> Address 1 </label>
	            <input class="is_required validate form-control" name="address_1" id="address_1" value="" required="" type="text">
	        </div>		
	        <div class="form-group">
	            <label for="address_2"> Address 2 </label>
	            <input class="validate form-control" name="address_2" id="address_2" value="" type="text">
	        </div>	
	        <div class="required form-group">
	            <label for="city" class="required"> City </label>
				<select id="city_id" name="city_id" class="form-control">
				<option value=''>--- Chọn Tỉnh thành ---</option> 
				<?php
					foreach ($citys as $city) {
						echo '<option value="'. $city['city_id'] .'">'. $city['name'] .'</option>';
					}
				?>
				</select>
	        </div>	
	        <div class="required form-group">
	            <label for="city" class="required"> City </label>
				<select id="zone_id" name="zone_id" class="form-control"></select>
	        </div>	        	                                	        
	        <div class="required form-group form-error">
	            <label for="password" class="required"> Password </label>
	            <input class="is_required validate form-control" name="password" id="password" type="password" required="">
	        </div>
	        <div class="form-group">
	            <label for="newsletter" class="top">
	                <div class="checkbox"><input type="checkbox" name="newsletter" value="1"></div> Get news from website
	            </label>
	        </div>	        
	        <div class="form-group">
	            <button type="submit" name="register" value="register" class="btn-default btn medium color2"> <span>Register<i class="icon-chevron-right right"></i></span> </button>
	        </div>
	    </fieldset>
	</form>
    </div>
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