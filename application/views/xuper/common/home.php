<div class="ps-home-slider">
	<div class="rev_slider_wrapper fullwidthbanner-container" data-alias="home-1" data-source="gallery" id="rev_slider_1_1_wrapper" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;"><!-- START REVOLUTION SLIDER 5.4.6.3.1 fullwidth mode -->
		<div class="rev_slider fullwidthabanner" data-version="5.4.6.3.1" id="rev_slider_1_1" style="display:none;">
			<ul>
				<?php
                    foreach ($setting['slider'] as $value) {
                    	echo '<!-- SLIDE  -->';
                    	echo '<li data-description="" data-easein="Power0.easeInOut,default,default" data-easeout="default,default,default" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-6" data-masterspeed="default,default,default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0,0,0" data-saveperformance="off" data-slotamount="default,default,default" data-title="Slide" data-transition="zoomout,slotzoom-vertical,curtain-2"><!-- MAIN IMAGE -->';
                      	echo '<img alt="" class="rev-slidebg" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" height="750" src="'. base_url('images/'.$value['image']) .'" width="1920" /></li>';
						echo '<!-- SLIDE  -->';
                    }
                 ?>
			</ul>

			<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
		</div>
	</div>
</div>

<div class="ps-section pt-60 pb-30">
	<div class="ps-container">
		<div class="ps-section__header text-center">
			<h2 class="ps-section__title">Sản phẩm HOT</h2>
		</div>

		<div class="ps-section__content">
			<div class="ps-slider--center owl-slider" data-owl-auto="true" data-owl-dots="false" data-owl-duration="1000" data-owl-gap="30" data-owl-item="4" data-owl-item-lg="4" data-owl-item-md="3" data-owl-item-sm="2" data-owl-item-xs="1" data-owl-loop="true" data-owl-mousedrag="on" data-owl-nav="true" data-owl-nav-left="&lt;i class='ps-icon-arrow-left'&gt;&lt;/i&gt;" data-owl-nav-right="&lt;i class='ps-icon-arrow-right'&gt;&lt;/i&gt;" data-owl-speed="5000">

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

<?php
foreach ($products as $id => $product) {
?>

<div class="ps-section pt-60 pb-30">
	<div class="ps-container">
		<div class="ps-section__header text-center">
			<h2 class="ps-section__title"><a href="<?php echo base_url('catalog/categories/'. $product['category_id']) ?>"><?php echo $product['category_name'] ?></a></h2>
		</div>

		<div class="ps-section__content">
			<div class="ps-slider--center owl-slider" data-owl-auto="true" data-owl-dots="false" data-owl-duration="1000" data-owl-gap="30" data-owl-item="4" data-owl-item-lg="4" data-owl-item-md="3" data-owl-item-sm="2" data-owl-item-xs="1" data-owl-loop="true" data-owl-mousedrag="on" data-owl-nav="true" data-owl-nav-left="&lt;i class='ps-icon-arrow-left'&gt;&lt;/i&gt;" data-owl-nav-right="&lt;i class='ps-icon-arrow-right'&gt;&lt;/i&gt;" data-owl-speed="5000">

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

<?php
}
?>

<div class="ps-section--partner">
  <div class="ps-container">
    <div class="owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="60" data-owl-nav="false" data-owl-dots="false" data-owl-item="5" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="5" data-owl-duration="1000" data-owl-mousedrag="on">
    	<?php foreach ($manufacturers as $key => $value) { ?>
    	<a href="#"><img src="<?php echo base_url('images/'. $value['image']) ?>" alt="<?php echo $value['name'] ?>" title="<?php echo $value['name'] ?>"></a>
    	<?php } ?>  
    </div>
  </div>
</div>