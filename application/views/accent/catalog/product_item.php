<!-- Item -->
<div class="item">
  <div class="col-item">
      <?php if ($product['discount']) {
        echo '<div class="sale-label sale-top-right">SALE</div>';
      }
      ?>  
    <div class="product-image-area"> <a class="product-image" title="<?php echo $product['name'] ?>" href="<?php echo base_url('catalog/products/'.$product['product_id']) ?>"> <img src="<?php echo base_url('images/'.$product['image']) ?>" class="img-responsive" style="max-height:264px" alt="product-image" /> </a></div>
    <div class="info">
      <div class="info-inner">
        <div class="item-title"> <a title=" <?php echo $product['name'] ?>" href="<?php echo base_url('catalog/products/'.$product['product_id']) ?>"> <?php echo $product['name'] ?> </a> </div>
        <!--item-title-->
        <div class="item-content">
          <div class="ratings">
            <div class="rating-box">
              <?php
                $rating = 0;
                for ($i=1; $i <= 5; $i++) { 
                  if ($i <= $product['rating'])
                    $rating += 20;
                  else if ($i == $product['rating'] + 0.5) 
                    $rating += 10;
                }
              ?>             
              <div class="rating" style="width: <?php echo $rating ?>%"></div>
            </div>
          </div>
          <div class="price-box">
            <?php if ($product['discount'] != $product['price']) {
              echo '<p class="special-price"> <span class="price"> '. number_format($product['discount'],0,'','.') . '</span> </p> <p class="old-price"> <span class="price-sep">-</span> <span class="price">'. number_format($product['price'],0,'','.') . '</span> </p>';
            } else {
              echo '<p class="special-price"> <span class="price">'. number_format($product['price'],0,'','.') . '</span> </p>';
            }     
            ?>            
          </div>
        </div>
        <!--item-content--> 
      </div>
      <!--info-inner-->
      <div class="actions">
        <a href="<?php echo base_url('catalog/products/'.$product['product_id']) ?>" title="Xem sản phẩm" class="button btn-view"><span>Xem sản phẩm</span></a>
        <a href="<?php echo base_url('account/wishlists/add/'.$product['product_id']) ?>" title="Thêm vào yêu thích" class="button btn-wishlist"><span>Thêm vào yêu thích</span></a>
      </div>
      <!--actions-->
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
<!-- End Item --> 