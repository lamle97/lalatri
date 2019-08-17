<div class="container"> 
  <!-- row -->
  <div class="row">
    <div class="col-md-12 box-block"> 
      
      <!--  box content -->
      
      <div class="box-content"> 
        <!-- single product -->
        <div class="single-product"> 
          <!-- Images -->
          <div class="images col-md-6 col-sm-12 col-xs-12">
            <div class="row"> 
              <!-- Small Images -->
              <div class="thumbs col-md-3 col-sm-3 col-xs-3"  id="thumbs">
                <ul>
                <?php
                  foreach ($product['options'][0]['images'] as $key => $image) {
                    if ($key == 3)
                      break;
                    echo '<li><a href="'. base_url('images/'.$image['image']) .'" data-image="'. base_url('images/'.$image['image']) .'" data-zoom-image="'. base_url('images/'.$image['image']) .'" class="elevatezoom-gallery"><img src="'. base_url('images/'.$image['image']) .'"/></a></li>';
                  }
                ?>                
                </ul>
              </div>
              <!-- end: Small Images --> 
              <!-- Big Image and Zoom -->
              <div class="big-image col-md-9 col-sm-9 col-xs-9"> <img id="product-image" src="<?php echo base_url('images/'.$product['options'][0]['images'][0]['image']) ?>" data-zoom-image="<?php echo base_url('images/'.$product['options'][0]['images'][0]['image']) ?>" alt="big image" /> </div>
              <!-- end: Big Image and Zoom -->
            </div>
          </div>
          
          <!-- end: Images --> 
          
          <!-- product details -->
          
          <div class="product-details col-md-6 col-sm-12 col-xs-12"> 
            
            <!-- Title and rating info -->
            <div class="title">
              <h1><?php echo $product['name'] ?></h1>
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
                <span><?php echo $total_review ?> review(s)</span> 
              </div>
            </div>
            <!-- end: Title and rating info -->
            
            <div class="row"> 
              <!-- Availability, Product Code, Brand -->
              <div class="short-info-wr col-md-12 col-sm-12 col-xs-12">
                <div class="short-info">
                  <div class="product-attr-text">Availability: <span class="available"><?php echo ($product['quantity'])?"In Stock":"Sold Out" ?></span></div>
                  <div class="product-attr-text">Product Code: <span><?php echo $product['model'] ?></span></div>
                  <div class="product-attr-text">Category: <span><?php echo $product['category'] ?></span></div>
                  <?php 
                    if ($product['manufacturer'])  
                      echo '<div class="product-attr-text">Brand: <span>'. $product['manufacturer'] .'</span></div>';
                  ?>
                  <div class="product-attr-text"><?php echo $product['description_short'] ?></div>
                </div>
              </div>
              <!-- end: Availability, Product Code, Brand --> 
              
            </div>
            <div class="row">
              <div class="short-info-opt-wr col-md-12 col-sm-12 col-xs-12">
                <div class="short-info-opt">
                  <div class="att-row">
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
                </div>
              </div>
            </div>
            <div class="row">
              <div class="short-info-opt-wr col-md-8 col-sm-8 col-xs-12">
                <div class="short-info-opt">
                  <div class="att-row">
                    <div class="qty-wr">
                      <div class="qty-text hidden-xs">Quantity:</div>
                      <div class="quantity-inp">
                        <input type="text" class="quantity-input" id="p_quantity" name="qty" value="1">
                      </div>
                      <div class="quantity-txt"><a  class="qty qtyplus" ><i class="fa fa-plus fa-fw"></i></a></div>
                      <div class="quantity-txt"><a  class="qty qtyminus" ><i class="fa fa-minus fa-fw"></i></a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="short-info-share-wr col-md-4 col-sm-4 col-xs-12">
                <div class="short-info-opt"> 
                  <!-- AddThis Button BEGIN -->
                  <div class="addthis_toolbox addthis_default_style addthis_32x32_style"> <a class="addthis_button_facebook addthis-btn"></a> <a class="addthis_button_twitter addthis-btn" ></a> <a class="addthis_button_google_plusone_share addthis-btn"></a> <a class="addthis_button_compact addthis-btn"></a> </div>
                  <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4df5ee7405c65a76"></script> 
                  <!-- AddThis Button END --> 
                </div>
              </div>
            </div>
            <div class="row">
              <div class="price-wr col-md-4 col-sm-4 col-xs-12">
                <div class="big-price">
                <?php if ($product['discount']) {
                  echo '<span class="price-old">'. number_format($product['price'],0,'','.') . '</span> <span class="price-new">'. number_format($product['discount'],0,'','.') . '</span>';
                } else {
                  echo '<span class="price-new">'. number_format($product['price'],0,'','.') . '</span>';
                }            
                ?>
                </div>
              </div>
              <div class="product-btns-wr col-md-8 col-sm-8 col-xs-12">
                <div class="product-btns">
                  <div class="product-big-btns">
                    <button class="btn btn-addtocart" onClick="window.location='<?php echo base_url('account/carts/add/') ?>' + $('select#option_id option:checked').val() + '?quantity=' + $('input#p_quantity').val() "> <i class="fa fa-shopping-cart fa-fw"></i> Add to Cart </button>
                    <a class="btn btn-wishlist" data-toggle="tooltip" title="Add to Wishlist" href="<?php echo base_url('account/wishlists/add/'.$product['product_id']) ?>"> <i class="fa fa-heart fa-fw"></i> Add to Wish List</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- end: product details --> 
          
        </div>
        
        <!-- end: single product --> 
        
      </div>
      
      <!-- end: box content --> 
      
    </div>
  </div>
  <!-- end:row --> 
</div>
<!-- end: container-->

<div class="row clearfix f-space30"></div>

<!-- container -->
<div class="container"> 
  <!-- row -->
  <div class="row"> 
    <!-- tabs -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-column box-block product-details-tabs"> 
      
      <!-- Details Info/Reviews/Tags --> 
      <!-- Nav tabs -->
      <ul class="nav nav-tabs blog-tabs nav-justified">
        <li class="active"><a href="#details-info" data-toggle="tab"><i class="fa  fa-th-list fa-fw"></i> Details Info</a></li>
        <li><a href="#details-technical" data-toggle="tab"><i class="fa  fa-th-list fa-fw"></i> Details Technical</a></li>
        <li><a href="#reviews" data-toggle="tab"><i class="fa fa-comments fa-fw"></i> Reviews</a></li>
        <li> <a href="#tags" data-toggle="tab"><i class="fa fa-tags fa-fw"></i> Tags </a> </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="details-info">
          <?php echo $product['description'] ?>
        </div>
        <div class="tab-pane" id="details-technical">
          <?php echo $product['description_technical'] ?>
        </div>        
        <div class="tab-pane" id="reviews">
          <div class="heading"> <span><strong>"<?php echo $product['name'] ?>"</strong> has <?php echo $total_review ?> review(s)</span>
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
            <a href="#wr" class="btn color1 normal">Add Review</a> </div>
            <?php foreach ($review as $key => $value) { ?>
          <div class="review">
            <div class="review-info">
              <div class="name"><i class="fa fa-comment-o fa-flip-horizontal fa-fw"></i> <?php echo $value['firstname']." ".$value['lastname'] ?></div>
              <div class="date"> on <em><?php echo date("d-m-Y", strtotime($value['date_added'])) ?></em></div>
              <span style="color:#22b345">                                
              <?php
               if ($value['buy'])
                  echo '<i class="fa fa-check"></i> Bought this product';
              ?>         
              </span>
              <div class="rating">
            <?php
              for ($i=1; $i <= 5; $i++) { 
                if ($i <= $value['rating'])
                  echo '<i class="fa fa-star"></i> ';
                else if ($i == $value['rating'] + 0.5) 
                  echo '<i class="fa fa-star-half-o"></i> ';
                else
                  echo '<i class="fa fa-star-o"></i> ';
              }
            ?>                 
              </div>
            </div>
            <div class="text"><?php echo $value['text'] ?></div>
          </div>
              <?php } ?>            
          <div class="write-reivew" id="#write-review">
            <h3>Write a review</h3>
            <div class="fr-border"></div>
            <?php if ($customer) { ?>
            <!-- Form -->
            <form action="#self" id="review_form" method="post">
              <div class="row">
                <div class="col-md-4 col-xs-12"> <a name="wr"> </a>
                  <fieldset class="rating">
                    <input type="radio" id="star5" name="rating" value="5" />
                    <label for="star5" title="Rocks!" class="fa fa-star">5 stars</label>
                    <input type="radio" id="star4" name="rating" value="4" />
                    <label for="star4" title="Pretty good" class="fa fa-star">4 stars</label>
                    <input type="radio" id="star3" name="rating" value="3" />
                    <label for="star3" title="Cool" class="fa fa-star">3 stars</label>
                    <input type="radio" id="star2" name="rating" value="2" />
                    <label for="star2" title="Kinda bad" class="fa fa-star">2 stars</label>
                    <input type="radio" id="star1" name="rating" value="1" />
                    <label for="star1" title="Oops!" class="fa fa-star">1 star</label>
                  </fieldset>
                </div>
                <div class="col-md-8 col-xs-12">
                  <textarea name="text" id="review" placeholder="Review" rows="8"></textarea>
                </div>
              </div>
              <button class="btn normal color1 pull-right" type="submit" name="review" value="review">Submit</button>
            </form>
            <!-- end: Form --> 
            <?php } else echo 'Please login to write a review !' ?>
          </div>
        </div>
        <div class="tab-pane" id="tags">
          <div class="tags">
            <?php
              foreach (explode(',', $product['tag']) as $value) {
                echo '<a href="#">'. trim($value) .'</a>';
              }
            ?>
          </div>
        </div>
      </div>
      <!-- end: Tab panes --> 
      <!-- end: Details Info/Reviews/Tags -->
      <div class="clearfix f-space30"></div>
    </div>
    <!-- end: tabs --> 
    
  </div>
  <!-- row --> 
</div>
<!-- end: container --> 

<!-- Relate Products -->

<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-column box-block">
      <div class="box-heading"><span>Related Products</span></div>
      <div class="box-content">
        <div class="box-products slide" id="productc3">
          <div class="carousel-controls"> <a class="carousel-control left" data-slide="prev" href="#productc3"> <i class="fa fa-angle-left fa-fw"></i> </a> <a class="carousel-control right" data-slide="next" href="#productc3"> <i class="fa fa-angle-right fa-fw"></i> </a> </div>
          <div class="carousel-inner"> 
            <?php
              $result = '<div class="item active"><div class="row box-product">';
                foreach ($related_products as $key => $value) {
                    if ($key !=0 && ($key % 4 == 0)) { //to avoid first empty "active"
                      $result .= '</div></div>';
                      $result .= '<div class="item"><div class="row box-product">';
                    }
                    $data['product'] = $value;
                    $data['class'] = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
                    $result .= $this->load->view_template('catalog/product_item', $data, true);
                }
                $result .= '</div></div>';
                echo $result;
            ?> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- end: Related products -->
<div class="row clearfix f-space30"></div>
<?php $this->load->view_template('common/rectangle') ?>
 <script type="text/javascript">
  $(document).ready(function() {
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
    });
  });
  </script>
