<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="page-title">
        <h2>Wishlist (<?php echo count($products) ?>)</h2>
      </div>
    </div>
  </div>
</div>
<div class="row clearfix f-space10"></div>

<?php 
  foreach ($products as $product) {
?>
<!-- product -->
<div class="container">
  <div class="row">
    <div class="product">
      <div class="col-md-2 col-sm-3 hidden-xs p-wr">
        <div class="product-attrb-wr">
          <div class="product-attrb">
            <div class="image"> <a class="img" href="<?php echo base_url('catalog/products/'.$product['product_id']) ?>"><img alt="product info" src="<?php echo base_url('images/'.$product['image']) ?>" title="<?php echo $product['name'] ?>"></a> </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-7 col-xs-9 p-wr">
        <div class="product-attrb-wr">
          <div class="product-meta">
            <div class="name">
              <h3><a href="<?php echo base_url('catalog/products/'.$product['product_id']) ?>"><?php echo $product['name'] ?></a></h3>
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
          </div>
        </div>
      </div>
      <div class="col-md-3 hidden-sm hidden-xs p-wr">
        <div class="product-attrb-wr">
          <div class="product-meta">
            <div class="price">
            <?php if ($product['discount']) {
              echo '<span class="price-new">'. number_format($product['discount'],0,'','.') . '</span> <span class="price-old">'. number_format($product['price'],0,'','.') . '</span>';
            } else {
              echo '<span class="price-new">'. number_format($product['price'],0,'','.') . '</span>';
            }     
            ?> 
            </div>
          </div>
        </div>
      </div>      
      <div class="col-md-1 col-sm-2 col-xs-3 p-wr">
        <div class="product-attrb-wr">
          <div class="product-attrb">
            <div class="remove"> <a href="<?php echo base_url('account/wishlists/delete/'.$product['product_id']) ?>" class="color2" data-toggle="tooltip" data-original-title="Remove"><i class="fa fa-trash-o fa-fw color2"></i></a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end: product -->
<div class="row clearfix f-space30"></div>
<?php
  }
?>
