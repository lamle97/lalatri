<section class="main-container col1-layout">
  <div class="main container">
    <div class="col-main">
      <div class="cart wow bounceInUp animated">
        <div class="page-title">
          <h2>Giỏ hàng</h2>
        </div>
        <div class="table-responsive">
          <form method="post" action="carts/update">
            <fieldset>
              <table class="data-table cart-table" id="shopping-cart-table">
                
                <thead>
                  <tr class="first last">
                    <th rowspan="1">&nbsp;</th>
                    <th rowspan="1"><span class="nobr">Tên sản phẩm</span></th>
                    <th rowspan="1">Kiểu sản phẩm</th>
                    <th colspan="1" class="a-center"><span class="nobr">Đơn giá</span></th>
                    <th class="a-center" rowspan="1">Số lượng</th>
                    <th colspan="1" class="a-center">Thành tiền</th>
                    <th class="a-center" rowspan="1">&nbsp;</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr class="first last">
                    <td class="a-right last" colspan="7">
                      <button class="button btn-update" title="Cập nhật giỏ hàng" value="update_qty" name="update_cart_action" type="submit"><span><span>Cập nhật giỏ hàng</span></span></button>
                      <button id="empty_cart_button" class="button btn-empty" title="Xóa giỏ hàng" onclick="window.location='<?php echo base_url('account/carts/clear') ?>'" type="button"><span><span>Xóa giỏ hàng</span></span></button></td>
                  </tr>
                </tfoot>
                <tbody>
                <?php
                	foreach ($cart['products'] as $key => $product) {
                		$price = ($product['discount'] != $product['price'])?$product['discount']:$product['price'];
                ?>
                  <tr>
                    <td class="image"><a class="product-image" title="<?php echo $product['name'] ?>" href="<?php echo base_url('catalog/products/'.$product['product_id']) ?>"><img width="75" alt="<?php echo $product['name'] ?>" src="<?php echo base_url('images/'.$product['image']) ?>"></a></td>
                    <td><h2 class="product-name"> <a href="<?php echo base_url('catalog/products/'.$product['product_id']) ?>"><?php echo $product['name'] ?></a> </h2></td>
                    <td class="a-center">
                    	<h4 class="product-name"> <?php echo $product['option_name'] ?> </h4>
                    	<input type="hidden" name="cart[<?php echo $key ?>][product_option_id]" value="<?php echo $product['product_option_id'] ?>">
                    </td>
                    <td class="a-right"><span class="cart-price"> <span class="price"><?php echo number_format($price,0,'','.')?></span> </span></td>
                    <td class="a-center movewishlist"><input maxlength="12" class="input-text qty" title="Số lượng" size="4" value="<?php echo $product['quantity'] ?>" name="cart[<?php echo $key ?>][quantity]"></td>
                    <td class="a-right movewishlist"><span class="cart-price"> <span class="price"><?php echo number_format($price*$product['quantity'],0,'','.') ?></span> </span></td>
                    <td class="a-center last"><a class="button remove-item" title="Xóa sản phẩm" href="<?php echo base_url('account/carts/delete/'.$product['product_option_id']) ?>"><span><span>Xóa sản phẩm</span></span></a></td>
                  </tr>
                <?php
                	}
                ?>
                </tbody>
              </table>
            </fieldset>
          </form>
        </div>
        <!-- BEGIN CART COLLATERALS -->
        <div class="cart-collaterals row">
          <div class="col-sm-8">
          		<button onclick="window.location='<?php echo base_url() ?>';" class="button" title="Tiếp tục mua hàng" type="button"><span>Tiếp tục mua hàng</span></button>
          </div>
        <div class="totals col-sm-4">
          <h3>Tổng giá sản phẩm</h3>
          <div class="inner">
            <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
              
              <tbody>
                <tr>
                  <td colspan="1" class="a-left"><strong>Tổng số sản phẩm</strong></td>
                  <td class="a-right pull-right"><strong><span class="price"><?php echo $cart['total_items'] ?></span></strong></td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="1" class="a-left"> Tổng số tiền thanh toán </td>
                  <td class="a-right pull-right"><span class="price"><?php echo number_format($cart['total_money'],0,'','.') ?></span></td>
                </tr>
              </tfoot>
            </table>
            <ul class="checkout">
              <li>
                <button onclick="window.location='<?php echo base_url('account/checkout') ?>';" class="button btn-proceed-checkout" title="Thanh toán ngay" type="button"><span>Thanh toán ngay</span></button>
              </li>
              
            </ul>
          </div>
          <!--inner--> 
          
        </div>
      </div>
      
      <!--cart-collaterals--> 
      
    </div>
  </div>
</div>
</section>