<section class="main-container col2-left-layout">
<div class="main container">
      <div class="row">
        <div class="col-main col-sm-9 col-sm-push-3 wow bounceInUp animated">
          <div class="category-title">
            <h1>Tìm kiếm với từ khóa: <?php echo $name ?></h1>
          </div>
          
          <div class="category-products">
            <div class="toolbar">
              <div id="sort-by">
                <label class="left">Sắp xếp: </label>
                <ul>
                  <li><a href="">Mặc định<span class="right-arrow"></span></a>
                    <ul id="sort">
                      <li><a href="">Mặc định</a></li>
                      <li><a href="p.name-ASC">A &rarr; Z</a></li>
                      <li><a href="p.name-DESC">Z &rarr; A</a></li>
                      <li><a href="po.discount-ASC">Giá tăng dần</a></li>
                      <li><a href="po.discount-DESC">Giá giảm dần</a></li>
                      <li><a href="p.date_added-DESC">Hàng mới nhất</a></li>
                      <li><a href="p.date_added-ASC">Hàng cũ nhất</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="pager">
                <div class="pages">
                  <?php echo $pagination ?>
                </div>
              </div>
            </div>
            <ul class="products-grid">
           	<?php 
           		foreach ($products as $product) {
           			echo '<li class="item col-lg-4 col-md-3 col-sm-4 col-xs-12">';
           			$data['product'] = $product;
           			$this->load->view_template('catalog/product_item.php', $data);
           			echo '</li>';
           		}
           	?>
            </ul>
            <div class="toolbar">
              <div id="sort-by">
                <label class="left">Sắp xếp: </label>
                <ul>
                  <li><a href="">Mặc định<span class="right-arrow"></span></a>
                    <ul id="sort">
                      <li><a href="">Mặc định</a></li>
                      <li><a href="p.name-ASC">A &rarr; Z</a></li>
                      <li><a href="p.name-DESC">Z &rarr; A</a></li>
                      <li><a href="po.discount-ASC">Giá tăng dần</a></li>
                      <li><a href="po.discount-DESC">Giá giảm dần</a></li>
                      <li><a href="p.date_added-DESC">Hàng mới nhất</a></li>
                      <li><a href="p.date_added-ASC">Hàng cũ nhất</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="pager">
                <div class="pages">
                  <?php echo $pagination ?>
                </div>
              </div>
            </div>            
          </div>
        </div>            
		<aside class="col-left sidebar col-lg-3 col-md-3 col-sm-12 col-md-pull-9 col-xs-12">
			<?php $this->load->view_template('catalog/category_menu.php') ?>
      <div class="side-nav-categories block-layered-nav">
        <div class="block-title"> Lọc sản phẩm </div>
        <div class="box-content">
          <div class="shopby">
            <!-- Price Range --> 
            <p class="block-subtitle">Giá tiền</p>
            <div class="pricerange">
              <input type="text" id="price-range" name="price-range"/>            
              <button class="button right" type="button" id="filter">Lọc</button>
            </div>
            <!--end: Price Range --> 
          </div>
        </div>
      </div>     
		</aside>
		</div>
	</div>
</section>
<script type="text/javascript">
$('ul#sort li a').bind('click', function(e) {  
    e.preventDefault();
    var url = window.location.href;
        url = replaceUrlParam(url, 'sort', $(this).attr('href'));  
    window.location.href = url;   
  });
$('button#filter').bind('click', function(e) {  
    e.preventDefault();
    var url = window.location.href;
        url = replaceUrlParam(url, 'filter_price', $('input[name=price-range]').val());  
    window.location.href = url;   
  });
function replaceUrlParam(url, paramName, paramValue) {
  var pattern = new RegExp('('+paramName+'=).*?(&|$)'),
   newUrl = url.replace(pattern,'$1' + paramValue + '$2');
  if ( newUrl == url ) {
   newUrl = newUrl + (newUrl.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
  }
  return newUrl;
} 
</script>