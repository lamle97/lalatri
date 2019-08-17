<div class="ps-hero">
  <div class="container">
    <h3>Danh sách yêu thích</h3>
  </div>
</div>
<main class="ps-main pt-80 pb-80">
  <div class="ps-container">
    <div class="MyAccount">
      <nav class="MyAccount-navigation">
        <ul>
          <li><a href="<?php echo base_url('account') ?>">Trang quản lý</a></li>
          <li><a href="<?php echo base_url('account/info') ?>">Thông tin tài khoản</a></li>
          <li><a href="<?php echo base_url('account/orders') ?>">Đơn hàng</a></li>
          <li><a href="<?php echo base_url('account/reviews') ?>">Đánh giá</a></li>
          <li class="active"><a href="<?php echo base_url('account/wishlists') ?>">Danh sách yêu thích</a></li>
        </ul>
      </nav>  
      <div class="MyAccount-content">             
        <?php if ($products != null) { ?>
        <div class="ps-cart-listing">
          <table class="table ps-cart__table" cellspacing="0">
            <thead>
              <tr>
                <th>Tên sản phẩm</th>
                <th>Đơn giá</th>
                <th>&nbsp;</th>
              </tr>
            </thead>   
            <tbody>
            <?php
              foreach ($products as $product) {
            ?>
              <tr class="cart_item">
                <td class="product-thumbnail"><a class="ps-product--compare" title="<?php echo $product['name'] ?>" href="<?php echo base_url('products/'.$product['product_id'].'-'.$product['keyword']) ?>"><img width="75" alt="<?php echo $product['name'] ?>" src="<?php echo base_url('images/'.$product['image']) ?>"> <?php echo $product['name'] ?></a></td>
                <td class="product-price">
                  <p class="ps-product__price">
                    <?php if ($product['discount'] != $product['price']) {
                        echo '<del>'. number_format($product['price'],0,'','.') . ' <span>VND </span></del>'. number_format($product['discount'],0,'','.').' <span>VND </span>';
                      }  else {
                          echo number_format($product['price'],0,'','.').' <span>VND </span>';
                      } ?>       
                  </p>
                </td>
                <td class="product-remove"><a class="ps-remove remove" title="Xóa sản phẩm" href="<?php echo base_url('account/wishlists/delete/'.$product['product_id']) ?>"></a></td>
              </tr>
            <?php
              }
            ?>                      
            </tbody>       
          </table>
        </div>
        <?php } else { ?>
        <div class="ps-cart__promotion">
          <div class="form-group">
              <p>Không có sản phẩm nào trong danh sách yêu thích</p>
          </div>
          <div class="form-group">
            <a class="ps-btn ps-btn--gray" href="<?php echo base_url() ?>">Tiếp tục mua sắm</a>
          </div>
        </div> 
        <?php } ?>
      </div>
    </div>
  </div>
</main>