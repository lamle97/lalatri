<div class="ps-hero">
  <div class="container">
    <h3>Giỏ hàng</h3>
  </div>
</div>
<main class="ps-main pt-80 pb-80">
  <div class="ps-container">
    <?php if ($cart['total_items'] > 0) { ?>
    <div class="ps-cart-listing">
      <form method="post" action="carts/update">
        <table class="table ps-cart__table" cellspacing="0">
          <thead>
            <tr>
              <th>Tên sản phẩm</th>
              <th>Kiểu sản phẩm</th>
              <th>Đơn giá</th>
              <th>Số lượng</th>
              <th>Thành tiền</th>
              <th>&nbsp;</th>
            </tr>
          </thead>   
          <tbody>
          <?php
            foreach ($cart['products'] as $key => $product) {
              $price = ($product['discount'] != $product['price'])?$product['discount']:$product['price'];
          ?>
            <tr class="cart_item">
              <td class="product-thumbnail"><a class="ps-product--compare" title="<?php echo $product['name'] ?>" href="<?php echo base_url('products/'.$product['product_id'].'-'.$product['keyword']) ?>"><img width="75" alt="<?php echo $product['name'] ?>" src="<?php echo base_url('images/'.$product['image']) ?>"> <?php echo $product['name'] ?></a></td>
              <td class="product-option">
                <span class="ps-product--compare"> <?php echo $product['option_name'] ?> </span>
                <input type="hidden" name="cart[<?php echo $key ?>][product_option_id]" value="<?php echo $product['product_option_id'] ?>">
              </td>
              <td class="product-price"><?php echo number_format($price,0,'','.')?> VND</td>
              <td class="product-quantity">
                <div class="form-group--number">
                  <button class="minus"><span>-</span></button>
                  <input maxlength="12" class="form-control" title="Số lượng" value="<?php echo $product['quantity'] ?>" name="cart[<?php echo $key ?>][quantity]">
                  <button class="plus"><span>+</span></button>
                </div>
              </td>
              <td class="product-subtotal"><?php echo number_format($price*$product['quantity'],0,'','.') ?></td>
              <td class="product-remove"><a class="ps-remove remove" title="Xóa sản phẩm" href="<?php echo base_url('account/carts/delete/'.$product['product_option_id']) ?>"></a></td>
            </tr>
          <?php
            }
          ?>                      
          </tbody>       
        </table>
        <div class="ps-cart__actions">
            <div class="ps-cart__promotion">
                <div class="form-group">
                    <button class="ps-btn" title="Cập nhật giỏ hàng" value="update_qty" name="update_cart_action" type="submit"><span><span>Cập nhật giỏ hàng</span></span></button>
                </div>
                <div class="form-group">
                    <button id="empty_cart_button" class="ps-btn ps-btn--gray" title="Xóa giỏ hàng" onclick="window.location='<?php echo base_url('account/carts/clear') ?>'" type="button">Xóa giỏ hàng</button>
                </div>
            </div>
            <div class="ps-cart__total">
                <h3>Tổng số sản phẩm: <span> <?php echo $cart['total_items'] ?></span></h3>
                <h3>Tổng số tiền: <span> <?php echo number_format($cart['total_money'],0,'','.') ?></span></h3>
                <a class="ps-btn" href="<?php echo base_url('account/checkout') ?>">Thanh toán ngay</a>
            </div>
        </div>        
      </form>
    </div>
    <?php } else { ?>
    <div class="ps-cart__promotion">
      <div class="form-group">
          <p>Không có sản phẩm nào trong giỏ hàng</p>
      </div>
      <div class="form-group">
        <a class="ps-btn ps-btn--gray" href="<?php echo base_url() ?>">Tiếp tục mua sắm</a>
      </div>
    </div> 
    <?php } ?>
  </div>
</main>