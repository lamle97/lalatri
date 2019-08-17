<div class="ps-product--fashion">
    <div class="ps-product__thumbnail"><a class="ps-product__overlay" title="<?php echo $product['name'] ?>" href="<?php echo base_url('products/'.$product['product_id'].'-'.$product['keyword']) ?>"></a><img class="lazy" src="<?php echo base_url('images/'.$product['image']) ?>" alt="product-image">
	      <?php if ($product['discount'] != $product['price']) {
	        echo '<div class="ps-badge ps-badge--sale-off"><span>SALE</span></div>';
	      }
	      ?>  
        
<!--         <ul class="ps-product__actions">
            <li><a href="<?php echo base_url('catalog/products/'.$product['product_id']) ?>" title="View"><i class="ps-icon-eye"></i></a></li>
            <li><a href="<?php echo base_url('account/wishlists/add/'.$product['product_id']) ?>" title="Favorite"><i class="ps-icon-heart"></i></a></li>
        </ul> -->
    </div>
    <div class="ps-product__content"><a class="ps-product__title" title="<?php echo $product['name'] ?>" href="<?php echo base_url('products/'.$product['product_id'].'-'.$product['keyword']) ?>"><?php echo $product['name'] ?></a>
        <p class="ps-product__price">
        	<?php if ($product['discount'] != $product['price']) {
            	echo '<del>'. number_format($product['price'],0,'','.') . ' <span>VND </span></del>'. number_format($product['discount'],0,'','.').' <span>VND </span>';
            }  else {
              	echo number_format($product['price'],0,'','.').' <span>VND </span>';
            } ?>
        </p><a href="<?php echo base_url('account/wishlists/add/'.$product['product_id']) ?>" title="Favorite" class="ps-product__cart"><i class="ps-icon-heart"></i></a>
    </div>
</div>