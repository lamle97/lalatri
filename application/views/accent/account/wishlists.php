<div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-main col-sm-9 wow bounceInUp animated">
          <div class="my-account">
            <div class="page-title">
              <h2>Yêu thích</h2>
            </div>
            <div class="my-wishlist">
              <div class="table-responsive">
                <form method="post" action="#/wishlist/index/update/wishlist_id/1/" id="wishlist-view-form">
                  <fieldset>
                    <input type="hidden" value="ROBdJO5tIbODPZHZ" name="form_key">
                    <table id="wishlist-table" class="clean-table linearize-table data-table">
                      <thead>
                        <tr class="first last">
                          <th class="customer-wishlist-item-image"></th>
                          <th class="customer-wishlist-item-info"></th>
                          <th class="customer-wishlist-item-price">Price</th>
                          <th class="customer-wishlist-item-cart"></th>
                          <th class="customer-wishlist-item-remove"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          foreach ($products as $value) {
                        ?>
                        <tr class="first odd">
                          <td class="wishlist-cell0 customer-wishlist-item-image"><a title="<?php echo $value['name'] ?>" href="<?php echo base_url('catalog/products/'.$value['product_id']) ?>" class="product-image"> <img width="150"  alt="<?php echo $value['name'] ?>" src="<?php echo base_url('images/'.$value['image']) ?>"> </a></td>
                          <td class="wishlist-cell1 customer-wishlist-item-info"><h3 class="product-name"><a title="<?php echo $value['name'] ?>" href="<?php echo base_url('catalog/products/'.$value['product_id']) ?>"><?php echo $value['name'] ?></a></h3>
                            <div class="ratings">
                              <div class="rating-box">
                                <?php
                                  $rating = 0;
                                  for ($i=1; $i <= 5; $i++) { 
                                    if ($i <= $value['rating'])
                                      $rating += 20;
                                    else if ($i == $value['rating'] + 0.5) 
                                      $rating += 10;
                                  }
                                ?>             
                                <div class="rating" style="width: <?php echo $rating ?>%"></div>
                              </div>
                            </div>
                            <div class="description std">
                              <div class="inner"><?php echo $value['description_short'] ?></div>
                            </div></td>
                          <td data-rwd-label="Price" class="wishlist-cell3 customer-wishlist-item-price"><div class="cart-cell">
                              <div class="price-box">
                                <?php if ($value['discount']) {
                                  echo '<p class="special-price"> <span class="price"> '. number_format($value['discount'],0,'','.') . '</span> </p> <p class="old-price"> <span class="price-sep">-</span> <span class="price">'. number_format($value['price'],0,'','.') . '</span> </p>';
                                } else {
                                  echo '<p class="special-price"> <span class="price">'. number_format($value['price'],0,'','.') . '</span> </p>';
                                }     
                                ?>  
                              </div>
                            </div></td>
                          <td class="wishlist-cell5 customer-wishlist-item-remove last"><a class="remove-item" title="Clear Cart" href="<?php echo base_url('account/wishlists/delete/'.$value['product_id']) ?>"><span><span></span></span></a></td>
                        </tr>
                        <?
                          }
                        ?>

                      </tbody>
                    </table>
                  </fieldset>
                </form>
              </div>
            </div>
            <div class="buttons-set">
              <p class="back-link"><a href="<?php echo $this->agent->referrer() ?>"><small>« </small>Quay lại</a></p>
            </div>
          </div>
        </section>
        <aside class="col-right sidebar col-sm-3 wow bounceInUp animated">
          <div class="block block-account">
            <div class="block-title">Tài khoản của tôi</div>
            <div class="block-content">
              <ul>
                <li><a href="<?php echo base_url('account') ?>">Trang quản lý</a></li>
                <li><a href="<?php echo base_url('account/info') ?>">Thông tin tài khoản</a></li>
                <li><a href="<?php echo base_url('account/orders') ?>">Đơn hàng</a></li>
                <li><a href="<?php echo base_url('account/reviews') ?>">Đánh giá</a></li>
                <li class="current"><a>Danh sách yêu thích</a></li>
              </ul>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>