<div class="ps-hero">
	<div class="container">
		<h1>Tìm kiếm với từ khóa: <?php echo $name ?></h1>    	      	
	</div>
</div>

<main class="ps-main ps-products-listing">
	<div class="ps-content" data-mh="product-page" style="height: 1202px;">
		<div class="ps-product-group" data-item="5">	
			<div class="ps-product-group__header" style="display: none;">
			</div>
			<div class="ps-product-group__content">

				<div class="ps-product-group__action">
					<div class="row">

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
							<p> Hiển thị <?=count($products)?> sản phẩm </p>
						</div><!--end col woocommerce-result-count-->
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
							<select id="sort" name="orderby" class="ps-select orderby">
								<option value="">Mặc định</option>
								<option value="p.name-ASC">A &rarr; Z</option>
								<option value="p.name-DESC">Z &rarr; A</option>
								<option value="po.discount-ASC">Giá tăng dần</option>
								<option value="po.discount-DESC">Giá giảm dần</option>
								<option value="p.date_added-DESC">Hàng mới nhất</option>
								<option value="p.date_added-ASC">Hàng cũ nhất</option>
							</select>
						</div><!--end col woocommerce-ordering-->
					</div>
				</div><!--end ps-product-group__action-->
				<div class="products">
					<?php
					foreach ($products as $product) {
						$data['product'] = $product;
						echo '<div class="ps-product-wrap product type-product status-publish has-post-thumbnail product_cat-accessories last instock sale shipping-taxable purchasable product-type-simple">';
						$this->load->view_template('catalog/product_item', $data);
						echo '</div>';
					}
					?> 
				</div>

				<div class="ps-product-group__footer">
				</div>
			</div><!--end ps-product-group__content-->

		</div>
	</div>

	<aside class="ps-sidebar" data-mh="product-page" style="height: 1202px;">
		<?php 
			$data["category_id_now"] = -1;
			$this->load->view_template('catalog/category_menu.php', $data); 
		?>

		<div id="woocommerce_price_filter-3" class="ps-widget--sidebar woocommerce widget_price_filter">
			<div class="ps-widget__header"><h3>Giá tiền</h3></div>
			<div class="ps-widget__content">
				<div class="pricerange">
					<input type="text" id="price-range" name="price-range"/>            
					<button class="button ps-btn" type="button" id="filter">Lọc</button>
				</div>
			</div>
		</div>
	</aside>			
</main>
<script type="text/javascript">
window.onload = function() {
	$('select#sort').bind('change', function() {  
	    var urlnow = window.location.href;
	        urlnew = replaceUrlParam(urlnow, 'sort', $(this).val());
	    if (urlnow != urlnew)
	    	window.location.href = urlnew;   
	});	
	$('button#filter').bind('click', function(e) {  
	    e.preventDefault();
	    var url = window.location.href;
	        url = replaceUrlParam(url, 'filter_price', $('input[name=price-range]').val());  
	    window.location.href = url;   
	});
};
function replaceUrlParam(url, paramName, paramValue) {
  var pattern = new RegExp('('+paramName+'=).*?(&|$)'),
   newUrl = url.replace(pattern,'$1' + paramValue + '$2');
  if ( newUrl == url ) {
   newUrl = newUrl + (newUrl.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
  }
  return newUrl;
} 
</script>