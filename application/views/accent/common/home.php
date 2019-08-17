<!-- Slider -->
<div id="magik-slideshow" class="magik-slideshow">
	<div class="container">
		<div class="row">
			<div  class="col-lg-2 col-md-2 hidden-xs hidden-sm">
				<ul class="home-menu">
					<?php
						foreach ($category->getCategories(array('parent_id' => 0, 'status' => 1)) as $value) {
							echo '<li><a href="'. base_url('catalog/categories/'. $value['category_id']) .'"><i class="'. (($value['image'])?$value['image']:'fa fa-check-circle') .'"></i> '. $value['name'] .'</a>';

							$chil = $category->getCategories(array('parent_id' => $value['category_id'], 'status' => 1));
							if (count($chil) > 0) {
								echo '<div class="nav-sub"><ul>';

								foreach ($chil as $value_chil) {
									echo '<li><div class="nav-sub-list-box">';
									echo '<a href="'. base_url('catalog/categories/'. $value_chil['category_id']) .'"><h2>'. $value_chil['name'] .'</h2></a>';

									$last = $category->getCategories(array('parent_id' => $value_chil['category_id'], 'status' => 1));
									if (count($last) > 0) {
										foreach ($last as $value_last) {
											echo '<a href="'. base_url('catalog/categories/'. $value_last['category_id']) .'">'. $value_last['name'] .'</a>';
										}
									}

									echo '</div></li>';
								}

								echo '</ul></div>';
							}
						}
					?>
				</ul>
			</div>
			<div class="col-lg-10 col-sm-12 col-md-10  wow bounceInUp animated">
		         <div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container' >
		            <div id='rev_slider_4' class='rev_slider fullwidthabanner'>
		              <ul>
                  <?php
                    foreach ($setting['slider'] as $value) {
                      echo "<li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb='//bizweb.dktcdn.net/100/037/441/themes/506777/assets/slider-img1.jpg?1493864457261'><img src='". base_url('images/'.$value['image']) ."' data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat' alt='banner'/>
                        <div class='tp-caption sfb  tp-resizeme' data-x='0'  data-y='0'  data-endspeed='0'  data-speed='0' data-start='0' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; width: 100%; height: 100%; cursor: pointer;' onclick='location.href=\"". $value['link'] ."\"'></div></li>";
                    }
                  ?>
		              </ul>
		              <div class="tp-bannertimer"></div>
		            </div>
		         </div>				
			</div>
		</div>
	</div>
</div>
<!-- end Slider -->
  <!-- main container -->
  <section class="main-container col1-layout home-content-container">
    <div class="container">
      <div class="std">
        <div class="best-seller-pro wow bounceInUp animated">
          <div class="slider-items-products">
            <div class="new_title center">
              <h2>Sản phẩm HOT</h2>
            </div>
            <div id="best-seller-slider" class="product-flexslider hidden-buttons">
              <div class="slider-items slider-width-col4"> 
                <?php
                    foreach ($popular_products as $key => $value) {
                        $data['product'] = $value;
                        $this->load->view_template('catalog/product_item', $data);
                    }
                ?>                 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End main container -->
  <!-- recommend slider -->
  <?php
  foreach ($products as $id => $product) {
  ?>
  <section class="main-container col1-layout home-content-container">
    <div class="container">
      <div class="std">
        <div class="best-seller-pro wow bounceInUp animated">
          <div class="slider-items-products">
            <div class="new_title center">
              <h2><a href="<?php echo base_url('catalog/categories/'. $product['category_id']) ?>"><?php echo $product['category_name'] ?></a></h2>
            </div>
            <div id="best-seller-slider" class="product-flexslider hidden-buttons">
              <div class="slider-items slider-width-col4"> 
                <?php
                    foreach ($product['data'] as $key => $value) {
                        $data['product'] = $value;
                        $this->load->view_template('catalog/product_item', $data);
                    }
                ?>                 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
  }
  ?>
  <!-- End Recommend slider -->
  <footer class="footer bounceInUp animated">
    <div class="brand-logo ">
      <div class="container">
        <div class="slider-items-products">
          <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col6"> 
			<?php foreach ($manufacturers as $key => $value) { ?>
			<!-- Item -->
				<div class="item">
					<a href="#"><img src="<?php echo base_url('images/'. $value['image']) ?>" alt="<?php echo $value['name'] ?>" title="<?php echo $value['name'] ?>"></a>
				</div>
			<!-- End Item -->
			<?php } ?>            	
            </div>
          </div>
        </div>
      </div>
    </div>
<script type='text/javascript'>
        jQuery(document).ready(function(){
            jQuery('#rev_slider_4').show().revolution({
            	startwidth: 945,
            	shuffle: 'off',
            	touchenabled: 'on',
                onHoverStop: 'on',      	
            });
        });
        </script>    