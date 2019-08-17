<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu-col">
        <!-- Iview Slider -->
        <div class="slider">
          <div id="iview">
            <?php
              foreach ($setting['slider'] as $value) {
                echo '<div data-iview:image="'. base_url('images/'.$value['image']) .'" onclick="location.href=\''. $value['link'] .'\'"></div>';
              }
            ?>    
          </div>
        </div>
      </div>
    </div>
</div>
<div class="row clearfix f-space30"></div>

<!-- Products -->
<div class="container">
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 main-column box-block">
      <div class="box-heading"><span>Popular Products</span></div>
      <div class="box-content">
        <div class="box-products slide" id="productc1">
          <div class="carousel-controls"> <a class="carousel-control left" data-slide="prev" href="#productc1"> <i class="fa fa-angle-left fa-fw"></i> </a> <a class="carousel-control right" data-slide="next" href="#productc1"> <i class="fa fa-angle-right fa-fw"></i> </a> </div>
          <div class="carousel-inner"> 
            <?php
              $result = '<div class="item active"><div class="row box-product">';
                foreach ($popular_products as $key => $value) {
                    if ($key !=0 && ($key % 3 == 0)) { //to avoid first empty "active"
                      $result .= '</div></div>';
                      $result .= '<div class="item"><div class="row box-product">';
                    }
                    $data['product'] = $value;
                    $result .= $this->load->view_template('catalog/product_item', $data, true);
                }
                $result .= '</div></div>';
                echo $result;
            ?> 
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 box-block sidebar">
      <div class="box-heading"><span>Best Sell</span></div>
      <div class="box-content">
        <div class="box-products slide carousel-fade" id="productc2">
          <ol class="carousel-indicators">
            <li class="active" data-slide-to="0" data-target="#productc2"></li>
            <li class="" data-slide-to="1" data-target="#productc2"></li>
            <li class="" data-slide-to="2" data-target="#productc2"></li>
          </ol>
          <div class="carousel-inner"> 
            <?php
              $result = '';
              foreach ($best_products as $key => $value) {
                  if ($key == 0) { //to avoid first empty "active"
                    $result .= '<div class="item active">';
                  } else {
                    $result .= '<div class="item">';
                  }

                  $data['product'] = $value;
                  $data['class'] = '';
                  $result .= $this->load->view_template('catalog/product_item', $data, true);
                  $result .= '</div>';
              }
              
              echo $result;
            ?>  
          </div>
        </div>
        <div class="carousel-controls"> <a class="carousel-control left" data-slide="prev" href="#productc2"> <i class="fa fa-angle-left fa-fw"></i> </a> <a class="carousel-control right" data-slide="next" href="#productc2"> <i class="fa fa-angle-right fa-fw"></i> </a> </div>
        <div class="nav-bg"></div>
      </div>
    </div>
  </div>
</div>
<?php
  foreach ($products as $id => $product) {
?>
<div class="row clearfix f-space30"></div>
<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-column box-block">
      <div class="box-heading"><span><?php echo $product['category_name'] ?></span></div>
      <div class="box-content">
        <div class="box-products slide" id="product-<?php echo $id ?>">
          <div class="carousel-controls"> <a class="carousel-control left" data-slide="prev" href="#product-<?php echo $id ?>"> <i class="fa fa-angle-left fa-fw"></i> </a> <a class="carousel-control right" data-slide="next" href="#product-<?php echo $id ?>"> <i class="fa fa-angle-right fa-fw"></i> </a> </div>
          <div class="carousel-inner"> 
<?php
              $result = '<div class="item active"><div class="row box-product">';
              foreach ($product['data'] as $key => $value) {
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
<?php
  }
?>

<div class="row clearfix f-space30"></div>
<?php $this->load->view_template('common/rectangle') ?>

<!-- Widgets -->
<div class="row clearfix f-space30"></div>
<div class="container">
  <div class="row"> 
    <!-- Sidebar -->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 box-block sidebar">
      <!-- Get Updates Box -->
      <div class="box-content">
        <div class="subscribe">
          <div class="heading">
            <h3>Get updates</h3>
          </div>
          <div class="formbox">
            <form>
              <i class="fa fa-envelope fa-fw"></i>
              <input class="form-control" id="InputUserEmail" placeholder="Your e-mail..." type="text">
              <button class="btn color1 normal pull-right" type="submit">Sign
              up</button>
            </form>
          </div>
        </div>
      </div>
      <!-- end: Get Updates Box --> 
    </div>
    <!-- end: Sidebar -->
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="row"> 
        <!-- Brands -->
        <div class="col-md-12 main-column box-block brands-block">
          <div class="box-heading"><span>Populer Brands</span></div>
          <div class="box-content">
            <div class="box-products box-brands slide" id="brands">
              <div class="carousel-controls"> <a class="carousel-control left" data-slide="prev" href="#brands"> <i class="fa fa-angle-left fa-fw"></i> </a> <a class="carousel-control right" data-slide="next" href="#brands"> <i class="fa fa-angle-right fa-fw"></i> </a> </div>
              <div class="carousel-inner">
              <?php
                $result = '<div class="brands-row item active">';
                  foreach ($manufacturers as $key => $value) {
                      if ($key !=0 && ($key % 4 == 0)) { //to avoid first empty "active"
                        $result .= "</div>";
                        $result .= "<div class='brands-row item'>";
                      }

                      $result .= '<div class="brand-logo"><a href="#"><img src="'. base_url('images/'. $value['image']) .'" alt="'.$value['name'].'" title="'.$value['name'].'"></a></div>';
                  }
                  $result .= '</div>';
                  echo $result;
              ?> 
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end: Brands --> 
    </div>
  </div>
</div>
<!-- end: Widgets -->