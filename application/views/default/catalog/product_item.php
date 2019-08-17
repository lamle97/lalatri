<!-- Product -->
<div class="<?php echo (isset($class))?$class:'col-lg-4 col-md-4 col-sm-4 col-xs-12' ?>">
  <div class="product-block">
    <div class="image">
      <?php if ($product['discount']) {
        echo '<div class="product-label product-sale"><span>SALE</span></div>';
      }
      ?>
      <a class="img" href="<?php echo base_url('catalog/products/'.$product['product_id']) ?>"><img alt="product info" src="<?php echo base_url('images/'.$product['image']) ?>" title="<?php echo $product['name'] ?>"></a> </div>
    <div class="product-meta">
      <div class="name"><a href="<?php echo base_url('catalog/products/'.$product['product_id']) ?>"><?php echo $product['name'] ?></a></div>
      <div class="big-price">
        <?php if ($product['discount']) {
          echo '<span class="price-new">'. number_format($product['discount'],0,'','.') . '</span> <span class="price-old">'. number_format($product['price'],0,'','.') . '</span>';
        } else {
          echo '<span class="price-new">'. number_format($product['price'],0,'','.') . '</span>';
        }     
        ?>
      </div>
      <div class="big-btns"> <a class="btn btn-default btn-view pull-left" href="<?php echo base_url('catalog/products/'.$product['product_id']) ?>">View</a> <a class="btn btn-default btn-addtocart pull-right" href="<?php echo base_url('account/carts/add/'.$product['product_id']) ?>">Add to Cart</a> </div>
      <div class="small-price"> 
        <?php if ($product['discount']) {
          echo '<span class="price-new">'. number_format($product['discount'],0,'','.') . '</span> <span class="price-old">'. number_format($product['price'],0,'','.') . '</span>';
        } else {
          echo '<span class="price-new">'. number_format($product['price'],0,'','.') . '</span>';
        }     
        ?>
      </div>
      <div class="rating">
      <?php
        for ($i=1; $i <= 5; $i++) { 
          if ($i <= $product['rating'])
            echo '<i class="fa fa-star"></i> ';
          else if ($i == $product['rating'] + 0.5) 
            echo '<i class="fa fa-star-half-o"></i> ';
          else
            echo '<i class="fa fa-star-o"></i> ';
        }
      ?>        
      </div>
      <div class="small-btns">
        <a class="btn btn-default btn-wishlist pull-left" data-toggle="tooltip" title="Add to Wishlist" href="<?php echo base_url('account/wishlists/add/'.$product['product_id']) ?>"> <i class="fa fa-heart fa-fw"></i> </a>
        <a class="btn btn-default btn-addtocart pull-left" data-toggle="tooltip" title="Add to Cart" href="<?php echo base_url('account/carts/add/'.$product['product_option_id']) ?>"> <i class="fa fa-shopping-cart fa-fw"></i> </a>
      </div>
    </div>
    <div class="meta-back"></div>
  </div>
</div>
<!-- end: Product --> 