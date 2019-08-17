    <div class="ps-hero">
      <div class="container">
        <h3><?php echo $product['name'] ?></h3>
      </div>
    </div>
    <main class="ps-main">
      <div class="ps-container">
        <div class="ps-product--detail">
          <div class="row">
                <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 ">
                  <div class="ps-product__thumbnail">
                    <div class="ps-product__preview">
                      <div class="ps-product__variants">
                      <?php
                        foreach ($product['images'] as $image) {
                          echo '<div class="item"><img src="'. base_url('images/'.$image['image']) .'"/></div>';
                        }
                      ?>                       
                      </div>
                    </div>
                    <div class="ps-product__image">
                      <?php
                        foreach ($product['images'] as $image) {
                          echo '<div class="item"><img class="zoom" src="'. base_url('images/'.$image['image']) .'" data-zoom-image="'. base_url('images/'.$image['image']) .'"/></div>';
                        }
                      ?>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 ">
                  <div class="ps-product__info">
                    <div class="ps-product__rating">
                      <select class="ps-rating">
                      <?php
                        $rating = 0;
                        for ($i=1; $i <= 5; $i++) { 
                          if ($i <= $product['rating'])
                            echo '<option value="1">'. $i . '</option>';
                          else
                            echo '<option value="0">'. $i . '</option>';
                        }
                      ?> 
                      </select><a href="#" id="read-comment-link" rel="nofollow"><?php echo $total_review ?> Nhận xét</a>
                    </div>
                    <h1><?php echo $product['name'] ?></h1>
                    <p class="ps-product__category"><strong>Danh mục</strong>: <a href="<?php echo base_url('catalog/categories/'.$product['category_id']) ?>"><?php echo $product['category'] ?></a></p>
                    <p><strong>Nhà sản xuất</strong>: <?php echo $product['manufacturer'] ?></p>
                    <p><strong>Model</strong>: <span class="sku"><?php echo $product['model'] ?></span></p>
                    <h3 class="ps-product__price">
                    <?php if ($product['discount'] != $product['price']) {
                      echo '<del>'. number_format($product['price'],0,'','.') . ' <span>VND </span></del>'. number_format($product['discount'],0,'','.').' <span>VND </span>';
                    }  else {
                        echo number_format($product['price'],0,'','.').' <span>VND </span>';
                    } ?>
                    </h3>
                    <div class="ps-product__short-desc">
                      <?php echo $product['description_short'] ?>
                    </div>
                    <div class="ps-product__block ps-product__size">
                      <h4>Tùy chọn:</h4>
                      <select id="option_id" class="ps-select selectpicker">
                        <?php foreach ($product['options'] as $key => $value) {
                          echo '<option value="'. $value['product_option_id'] .'">'. $value['option_name'] .'</option>';
                        } ?>
                      </select>
                      <div class="form-group ps-number">
                        <input class="form-control" type="text" value="1" name="qty" id="qty"><span class="up"></span><span class="down"></span>
                      </div>
                    </div>
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style addthis_32x32_style" addthis:url="<?php echo base_url('products/'.$product['product_id'].'-'.$product['keyword']) ?>"> <a class="addthis_button_facebook addthis-btn"></a> <a class="addthis_button_twitter addthis-btn" ></a> <a class="addthis_button_google_plusone_share addthis-btn"></a> <a class="addthis_button_compact addthis-btn"></a> </div>
                    <script type="text/javascript">
                      var addthis_config = {"data_track_addressbar":true};
                    </script> 
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ba4692a7f67124c"></script>
                    <!-- AddThis Button END -->
                    <div class="ps-product__shopping">
                      <button onClick="window.location='<?php echo base_url('account/carts/add/') ?>' + $('select#option_id option:checked').val() + '?quantity=' + $('input#qty').val() " class="ps-btn" title="Thêm vào giỏ hàng" type="button"><span><i class="icon-basket"></i> Đặt mua</span></button>
                      <div class="ps-product__actions"><a class="mr-10" href="<?php echo base_url('account/wishlists/add/'.$product['product_id']) ?>"><i class="ps-icon-heart"></i></a></div>
                    </div>
                  </div>
                </div>
          </div>
          <div class="ps-product__content">
            <ul class="tab-list" role="tablist">
              <li class="active"><a href="#tab_01" aria-controls="tab_01" role="tab" data-toggle="tab">Mô tả sản phẩm</a></li>
              <li><a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">Đánh giá</a></li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="tab_01">
              <?php echo $product['description'] ?>
            </div>          
            <div class="tab-pane" role="tabpanel" id="tab_02">
              <p class="mb-20"><strong>"<?php echo $product['name'] ?>"</strong> có <?php echo $total_review ?> Nhận xét</a></p>
              <h3>Khách Hàng Nhận Xét</h3>
              <?php foreach ($review as $key => $value) { ?>
              <div class="ps-review">
                <div class="ps-review__content">
                  <header>
                    <select class="ps-rating">
                      <?php
                        $rating = 0;
                        for ($i=1; $i <= 5; $i++) { 
                          if ($i <= $value['rating'])
                            echo '<option value="1">'. $i . '</option>';
                          else
                            echo '<option value="0">'. $i . '</option>';
                        }
                      ?> 
                    </select>
                    <p>
                      bởi <a href="#"> <?php echo $value['lastname']." ".$value['firstname'] ?></a> - <?php echo date("d/m/Y", strtotime($value['date_added'])) ?> 
                      <span style="color:#22b345">                                
                      <?php
                       if ($value['buy'])
                          echo '<i class="fa fa-check"></i> Đã mua sản phẩm này';
                      ?>         
                      </span>
                    </p>
                  </header>
                  <?php echo $value['text'] ?>
                </div>
              </div>
              <?php } ?>
              <?php if($this->customer->isLogged()) { ?>
              <form class="ps-form--product-review" id="review-form" method="post">
                <h4>Chia sẻ nhận xét về sản phẩm</h4>
                <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                        <div class="form-group">
                          <label>Xếp hạng của bạn<span></span></label>
                          <select class="ps-rating" name="rating">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 ">
                        <div class="form-group">
                          <label>Nội dung nhận xét:</label>
                          <textarea class="form-control" rows="6" id="review_field" name="text"></textarea>
                        </div>
                        <div class="form-group">
                          <button class="ps-btn--outline" type="submit" name="review" value="review">Gửi nhận xét</button>
                        </div>
                      </div>
                </div>
              </form>
            <?php } else { ?>
              <p><a href="/account/login">ĐĂNG NHẬP</a> / <a href="/account/register">ĐĂNG KÝ</a> ĐỂ NHẬN XÉT VỀ SẢN PHẨM</p>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </main>

    <div class="ps-section pb-50">
      <div class="ps-container">
        <div class="ps-section__header text-center">
          <h2 class="ps-section__title">Sản phẩm liên quan</h2>
        </div>
        <div class="ps-section__content">
          <div class="ps-slider--center owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on" data-owl-nav-left="&lt;i class='ps-icon-arrow-left'&gt;&lt;/i&gt;" data-owl-nav-right="&lt;i class='ps-icon-arrow-right'&gt;&lt;/i&gt;">
            
            <?php
                foreach ($related_products as $key => $value) {
                    $data['product'] = $value;
                    $this->load->view_template('catalog/product_item', $data);
                }
            ?> 

          </div>
        </div>
      </div>
    </div>