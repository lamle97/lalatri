<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="page-title">
        <h2>Cart (<?php echo count($cart['products']) ?>)</h2>
      </div>
    </div>
  </div>
</div>
<div class="row clearfix f-space10"></div>
<form method="post" action="carts/update">
<?php 
  foreach ($cart['products'] as $key => $product) {
    $price = ($product['discount'] != $product['price'])?$product['discount']:$product['price'];
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
      <div class="col-md-3 col-sm-7 col-xs-9 p-wr">
        <div class="product-attrb-wr">
          <div class="product-meta">
            <div class="name">
              <h3><a href="<?php echo base_url('catalog/products/'.$product['product_id']) ?>"><?php echo $product['name'] ?></a></h3>
            </div>
            <div class="price"> <span class="price-new"><?php echo number_format($price,0,'','.') ?></span></div>
          </div>
        </div>
      </div>
      <div class="col-md-2 hidden-sm hidden-xs p-wr">
        <div class="product-attrb-wr">
          <div class="product-attrb">
            <div class="att"><h3><?php echo $product['option_name'] ?></h3></div>
            <input type="hidden" name="cart[<?php echo $key ?>][product_option_id]" value="<?php echo $product['product_option_id'] ?>">
          </div>
        </div>
      </div>
      <div class="col-md-2 hidden-sm hidden-xs p-wr">
        <div class="product-attrb-wr">
          <div class="product-attrb">
            <div class="qtyinput">
              <div class="quantity-inp">
                <input type="text" class="quantity-input" id="p_quantity" name="cart[<?php echo $key ?>][quantity]" value="<?php echo $product['quantity'] ?>">
                <div class="quantity-txt minusbtn"><a href="#a" class="qty qtyminus" ><i class="fa fa-minus fa-fw"></i></a></div>
                <div class="quantity-txt plusbtn"><a href="#a" class="qty qtyplus" ><i class="fa fa-plus fa-fw"></i></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-2 hidden-sm hidden-xs p-wr">
        <div class="product-attrb-wr">
          <div class="product-attrb">
            <div class="price"> <span class="t-price"><?php echo number_format($price*$product['quantity'],0,'','.') ?></span> </div>
          </div>
        </div>
      </div>
      <div class="col-md-1 col-sm-2 col-xs-3 p-wr">
        <div class="product-attrb-wr">
          <div class="product-attrb">
            <div class="remove"> <a href="<?php echo base_url('account/carts/delete/'.$product['product_option_id']) ?>" class="color2" data-toggle="tooltip" data-original-title="Remove"><i class="fa fa-trash-o fa-fw color2"></i></a> </div>
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
<div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-8 col-xs-12 cart-box-wr">
      <button class="btn medium btn-update" title="Update Cart" value="update_qty" name="update_cart_action" type="submit"><span><span>Update Cart</span></span></button>
      <button class="btn medium btn-empty" title="Clear Cart" onclick="window.location='<?php echo base_url('account/carts/clear') ?>'" type="button"><span><span>Clear Cart</span></span></button>
    </div>

   <div class="col-md-4 col-sm-4 col-xs-12 cart-box-wr">
      <div class="box-content">
        <div class="cart-box-tm">
          <div class="tm1">Sub-Total</div>
          <div class="tm2"><?php echo number_format($cart['total_money'],0,'','.') ?></div>
        </div>
        <div class="clearfix f-space10"></div>
        <div class="cart-box-tm">
          <div class="tm1">Shipping Fee </div>
          <div class="tm2">Free</div>
        </div>
        <div class="clearfix f-space10"></div>
        <div class="cart-box-tm">
          <div class="tm3 bgcolor2">Total </div>
          <div class="tm4 bgcolor2"><?php echo number_format($cart['total_money'],0,'','.') ?></div>
        </div>
        <div class="clearfix f-space10"></div>
        <button class="btn large color1 pull-right" onclick="window.location='<?php echo base_url('account/checkout') ?>';" type="button">Proceed to Checkout</button>
        <div class="clearfix f-space30"></div>
      </div>
    </div>    
  </div>
</div>
</form>