<section class="main-container col1-layout">
    <div class="main container">
      <div class="col-main">
        <div class="row">
          <div class="product-view wow bounceInUp animated">
            <div class="product-essential">
              <div class="product-img-box col-lg-4 col-sm-4 col-md-4 col-xs-12 wow bounceInRight animated">
                <?php if ($product['discount']) {
                  echo '<div class="sale-label sale-top-left">SALE</div>';
                }
                ?>  
                <div class="product-image">
                  <div class="large-image"> <a href="<?php echo base_url('images/'.$product['options'][0]['images'][0]['image']) ?>" class="cloud-zoom" id="zoom1" rel="useWrapper: false, adjustY:0, adjustX:20"> <img src="<?php echo base_url('images/'.$product['options'][0]['images'][0]['image']) ?>" class="img-responsive" alt=""> </a> </div>
                  <div class="flexslider flexslider-thumb">
                    <ul class="previews-list slides">
                      <?php
                        foreach ($product['options'][0]['images'] as $image) {
                          echo '<li><a href="'. base_url('images/'.$image['image']) .'" class="cloud-zoom-gallery" rel="useZoom: \'zoom1\', smallImage: \''. base_url('images/'.$image['image']) .'\' "><img src="'. base_url('images/'.$image['image']) .'"/></a></li>';
                        }
                      ?>
                    </ul>
                  </div>
                </div>
                
                <!-- end: more-images -->
                
                <div class="clear"></div>
              </div>
              
              
              <div class="product-shop col-lg-8 col-sm-8 col-xs-12">
                <div class="product-name">
                  <h1><?php echo $product['name'] ?></h1>
                </div>
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
                  <p class="rating-links"> <a href="#"><?php echo $total_review ?> Nhận xét</a></p>
                </div>
                <?php echo ($product['quantity'])?'<p class="availability in-stock"><span>Còn hàng</span></p>':'<p class="availability out-of-stock">Hết hàng</span></p>' ?>
                <div class="price-block">
                  <div class="price-box">
                    <?php if ($product['discount']) {
                      echo '<p class="special-price"> <span class="price"> '. number_format($product['discount'],0,'','.') . '</span> </p> <p class="old-price"> <span class="price-sep">-</span> <span class="price">'. number_format($product['price'],0,'','.') . '</span> </p>';
                    } else {
                      echo '<p class="special-price"> <span class="price">'. number_format($product['price'],0,'','.') . '</span> </p>';
                    }     
                    ?>                      
                  </div>
                </div>
                <div class="short-description">
                  <p id="category">Danh mục: <a href="<?php echo base_url('catalog/categories/'.$product['category_id']) ?>"><?php echo $product['category'] ?></a></p>
                  <p id="manufacturer">Nhà sản xuất: <?php echo $product['manufacturer'] ?></p>
                  <p id="model">Model : <?php echo $product['model'] ?></p>
                  <p id="description_short"><?php echo $product['description_short'] ?></p>
                </div>
                <div class="add-to-box">
                  <div>
                    <label for="option">Tùy chọn:</label>
                    <div class="option form-group required option-select">
                    <select id="option_id" class="form-control">
                      <?php foreach ($product['options'] as $key => $value) {
                        echo '<option value="'. $value['product_option_id'] .'">'. $value['option_name'] .'</option>';
                      } ?>
                    </select>
                    <ul>
                      <?php foreach ($product['options'] as $key => $value) {
                        echo '<li data-value="'. $value['product_option_id'] .'"><span>'. $value['option_name'] .'</span></li>';
                      } ?>                      
                    </ul>
                    </div>
                  </div>
                  <div class="add-to-cart">
                    <label for="qty">Số lượng:</label>
                    <div class="pull-left">
                      <div class="custom pull-left">
                        <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa fa-minus"></i></button>
                        <input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                        <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    <div class="">
                      <button onClick="window.location='<?php echo base_url('account/carts/add/') ?>' + $('select#option_id option:checked').val() + '?quantity=' + $('input#qty').val() " class="button btn-cart" title="Thêm vào giỏ hàng" type="button"><span><i class="icon-basket"></i> Giỏ hàng</span></button>
                    </div>
                  </div>
                  <div class="email-addto-box">
                    <ul class="add-to-links">
                      <li>
                        <!-- AddThis Button BEGIN -->
                        <div class="addthis_toolbox addthis_default_style addthis_32x32_style"> <a class="addthis_button_facebook addthis-btn"></a> <a class="addthis_button_twitter addthis-btn" ></a> <a class="addthis_button_google_plusone_share addthis-btn"></a> <a class="addthis_button_compact addthis-btn"></a> </div>
                        <script type="text/javascript">
                        var addthis_config = {"data_track_addressbar":true};
                        </script> 
                        <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4df5ee7405c65a76"></script> 
                        <!-- AddThis Button END --> 
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-collateral">
              <div class="col-sm-12 wow bounceInUp animated">
                <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                  <li class="active"> <a href="#product_tabs_description" data-toggle="tab"> Mô tả sản phẩm </a> </li>
                  <li> <a href="#description_technical" data-toggle="tab">Thông số kỹ thuật</a> </li>
                  <li> <a href="#reviews_tabs" data-toggle="tab">Đánh giá</a> </li>
                </ul>
                <div id="productTabContent" class="tab-content">
                  <div class="tab-pane fade in active" id="product_tabs_description">
                    <div class="std">
                      <?php echo $product['description'] ?>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="description_technical">
                    <div class="std">
                      <?php echo $product['description_technical'] ?>
                    </div>
                  </div>                  
                  <div class="tab-pane fade" id="reviews_tabs">
                    <div class="box-collateral box-reviews" id="customer-reviews">
                      <div class="box-reviews-heading"> 
                        <span><strong>"<?php echo $product['name'] ?>"</strong> có <?php echo $total_review ?> Nhận xét</a></span>
                        <a class="button" href="#rw"><span><span>Viết nhận xét của bạn</span></span></a>           
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
                      <div class="box-reviews2">
                        <h3>Khách Hàng Nhận Xét</h3>
                        <div class="box visible">
                          <ul>
                          <?php foreach ($review as $key => $value) { ?>
                            <li>
                              <div class="review">
                                  <strong><?php echo $value['firstname']." ".$value['lastname'] ?></strong>
                                  <small><?php echo date("d-m-Y", strtotime($value['date_added'])) ?></small>
                                  <span style="color:#22b345">                                
                                  <?php
                                   if ($value['buy'])
                                      echo '<i class="fa fa-check"></i> Đã mua sản phẩm này';
                                  ?>         
                                  </span>
                                  <div class="rating-box">
                                    <?php
                                      $rating = 0;
                                      for ($i=1; $i <= 5; $i++) { 
                                        if ($i <= $value['rating'])
                                          $rating += 20;
                                      }
                                    ?>             
                                    <div class="rating" style="width: <?php echo $rating ?>%"></div> 
                                  </div>              
                                <div class="review-txt"><?php echo $value['text'] ?></div>
                              </div>
                            </li>
                          <?php } ?>
                          </ul>
                        </div>
                        <div class="actions"></div>
                      </div>
                      <div class="box-reviews1" id="rw">
                        <div class="form-add">
                          <form id="review-form" method="post">
                            <h3>Chia sẻ nhận xét về sản phẩm</h3>
                            <fieldset>
                              <fieldset class="rating">
                                <input id="star5" name="rating" value="5" type="radio">
                                <label for="star5" title="Quá tốt!" class="fa fa-star">5 stars</label>
                                <input id="star4" name="rating" value="4" type="radio">
                                <label for="star4" title="Tốt" class="fa fa-star">4 stars</label>
                                <input id="star3" name="rating" value="3" type="radio">
                                <label for="star3" title="Tạm được" class="fa fa-star">3 stars</label>
                                <input id="star2" name="rating" value="2" type="radio">
                                <label for="star2" title="Tệ" class="fa fa-star">2 stars</label>
                                <input id="star1" name="rating" value="1" type="radio">
                                <label for="star1" title="Quá tệ" class="fa fa-star">1 star</label>
                              </fieldset>
                              <div class="review2">
                                <ul>
                                  <li>
                                    <label class="required label-wide" for="review_field">Nội dung nhận xét<em>*</em></label>
                                    <div class="input-box">
                                      <textarea class="required-entry" rows="3" cols="5" id="review_field" name="text"></textarea>
                                    </div>
                                  </li>
                                </ul>
                                <div class="buttons-set">
                                  <button class="button submit" title="Gửi nhận xét" type="submit" name="review" value="review"><span>Gửi nhận xét</span></button>
                                </div>
                              </div>
                            </fieldset>
                          </form>
                        </div>
                      </div>                      
                      <div class="clear"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="box-additional">
                  <div class="related-pro wow bounceInUp animated">
                    <div class="slider-items-products">
                      <div class="new_title center">
                        <h2>Sản phẩm liên quan</h2>
                      </div>
                      <div id="related-products-slider" class="product-flexslider hidden-buttons">
                        <div class="slider-items slider-width-col4"> 
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
                </div>
              </div>              
            </div>
          </div>
        </div>
      </div>      
    </div>
  </section>
  <!--End main-container -->               
  <script src='<?php echo $base_template.'js/cloud-zoom.js' ?>' type='text/javascript'></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $('.product-image').on("focusin", function(){
      $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
    });

    function number_format(n) {
      n += '';
      x = n.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
          x1 = x1.replace(rgx, '$1' + '.' + '$2');
      }
      return x1 + x2;
    }

    $('.option-select li').on('click', function () {
      var $this = $(this);
      var $option = $this.closest('.option');

      /* trigger change on corresponding option */
      var $input = $option.find('[value="' + $this.attr('data-value') + '"]');

      if ($option.hasClass('option-select')) {
        var $select = $input.parent();
        var val = $select.val() == $this.attr('data-value') ? '' : $this.attr('data-value');
        $select.val(val);
        $select.trigger('change');
      } else {
        $input.trigger('click');
      }

      /* add class to selected options */
      if ($option.hasClass('option-select')) {
        $option.find('[data-value]').removeClass('selected');
        $option.find('[data-value="' + $option.find('select').val() + '"]').addClass('selected');
      } else {
        $option.find('input').each(function() {
          var $el = $(this);
          var val = $(this).val();
          if ($el.is(':checked')) {
            $option.find('[data-value="' + val + '"]').addClass('selected');
          } else {
            $option.find('[data-value="' + val + '"]').removeClass('selected');
          }
        });
      }

      $.get("./getProduct/" + $this.attr('data-value'), function(data, status){
        console.log(data);
        var json = jQuery.parseJSON(JSON.stringify(data));
        var image = '<div class="large-image"> <a href="<?php echo base_url('images/') ?>' + json.image + '" class="cloud-zoom" id="zoom1" rel="useWrapper: false, adjustY:0, adjustX:20"> <img src="<?php echo base_url('images/') ?>' + json.image + '" class="img-responsive" alt=""> </a> </div><div class="flexslider flexslider-thumb"><ul class="previews-list slides">';

        $.each(json.images, function( key, value ) {
          image += '<li><a href="<?php echo base_url('images/') ?>' + value.image + '" class="cloud-zoom-gallery" rel="useZoom: \'zoom1\', smallImage: \'<?php echo base_url('images/') ?>'  + value.image + '\' "><img src="<?php echo base_url('images/') ?>'  + value.image + '"/></a></li>';
        });

        image += '</ul></div>';
                  
        if (json.discount)
          var money = '<p class="special-price"> <span class="price">' + number_format(json.discount) + '</span> </p> <p class="old-price"> <span class="price-sep">-</span> <span class="price">' + number_format(json.price) + '</span> </p>';
        else
          var money = '<p class="special-price"> <span class="price">' + number_format(json.price) + '</span> </p>';

        $('.product-img-box .product-image').html(image);
        $('p#model').html(json.model);
        $('.price-box').html(money);
      });
    });

    $('.rating').focus();
     var a = 0;
     var b = 1;
    $('.rating').bind('focus change', function(event) {
     changed = event.target.id;
     var value   = 2123;
     var valueL  = value.length;
     var rgroup = $(this).find("input:last").attr('name');

     value = value.substring(a,b);     
    //alert(rgroup +" : "+ value+" : "+a+" : "+b+" : "+valueL);
    $('input:radio[name='+rgroup+']')[value].checked = true;
     if (b < valueL){b = b+1; a = a+1} else {b = 1; a = 0}

    });    
  });
  </script>