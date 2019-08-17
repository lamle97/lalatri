<div class="container"> 
  <!-- row -->
  <div class="row">
    <div class="col-md-9 col-sm-12 col-xs-12 box-block">
      <div class="box-heading category-heading"><span>Search with name: <?php echo $name ?></span>
        <ul class="nav nav-pills pull-right">
          <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" href="#a"> Sort by <i class="fa fa-sort fa-fw"></i> </a>
            <ul class="dropdown-menu" role="menu" id="sort">
              <li><a href="">Default</a></li>
              <li><a href="p.name-ASC">Name (A-Z)</a></li>
              <li><a href="p.name-DESC">Name (Z-A)</a></li>
              <li><a href="po.discount-ASC">Price (Low-High)</a></li>
              <li><a href="po.discount-DESC">Price (High-Low)</a></li>
              <li><a href="p.date_added-DESC">Newst</a></li>
              <li><a href="p.date_added-ASC">Oldest</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="row clearfix f-space20"></div>
      <div class="box-content">
        <div class="box-products"> 
            <?php
              $result = '<div class="row box-product">';
                foreach ($products as $key => $value) {
                    if ($key !=0 && ($key % 3 == 0)) { //to avoid first empty "active"
                      $result .= '</div></div>';
                      $result .= '<div class="item"><div class="row box-product">';
                    }
                    $data['product'] = $value;
                    $result .= $this->load->view_template('catalog/product_item', $data, true);
                }
                $result .= '</div><div class="clearfix f-space30"></div>';
                echo $result;
            ?>               
        </div>
      </div>
      <div class="clearfix f-space30"></div>
      <div class="pull-right">
        <?php echo $pagination ?>
      </div>
    </div>
    
    <!-- side bar -->
    <div class="col-md-3 col-sm-12 col-xs-12 box-block page-sidebar">
      <div class="box-heading"><span>Shop by</span></div>
      <!-- Filter by -->
      <div class="box-content">
        <div class="shopby">
          
          <!-- Price Range --> 
          <span>Price range</span>
          <div class="pricerange">
            <input type="text" id="price-range" name="price-range"/>
            <!--  data-from="30"                      // overwrite default FROM setting
data-to="70"                        // overwrite default TO setting
data-type="double"                  // slider type
data-step="10"                      // slider step
data-postfix=" pounds"              // postfix text
data-hasgrid="true"                 // enable grid
data-hideminmax="true"              // hide Min and Max fields
data-hidefromto="true"              // hide From and To fields
data-prettify="false"               // don't use spaces in large numbers, eg. 10000 than 10 000
 -->
            
            <button class="btn color1 normal pull-right" type="button" id="filter">Filter</button>
          </div>
          <!--end: Price Range --> 
        </div>
      </div>
      <!-- end: Filter by -->
      <div class="clearfix f-space30"></div>
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
    <!-- end:sidebar --> 
  </div>
  <!-- end:row --> 
</div>
<!-- end: container-->

<div class="row clearfix f-space30"></div>
<script>

(function($) {
  "use strict";
      
        
      //Filter by Price Slider
$("#price-range").ionRangeSlider({
    min: 0,                        // min value
    max: 50000000,                       // max value
    from: 200,                       // overwrite default FROM setting
    to: 600,                         // overwrite default TO setting
    type: "double",                 // slider type
    step: 50,                       // slider step
    postfix: "",                // postfix text
    hasGrid: false,                  // enable grid
    hideMinMax: false,               // hide Min and Max fields
    hideFromTo: false,               // hide From and To fields
    prettify: false,                 // separate large numbers with space, eg. 10 000
    onChange: function(obj){        // function-callback, is called on every change
        console.log(obj);
    },
    onFinish: function(obj){        // function-callback, is called once, after slider finished it's work
        console.log(obj);
    }
});     
    
    


$('ul#sort li a').bind('click', function(e) {  
    e.preventDefault();
    var url = window.location.href;
        url = replaceUrlParam(url, 'sort', $(this).attr('href'));  
    window.location.href = url;   
  });
$('button#filter').bind('click', function(e) {  
    e.preventDefault();
    var url = window.location.href;
        url = replaceUrlParam(url, 'filter_price', $('input[name=price-range]').val());  
    window.location.href = url;   
  });
function replaceUrlParam(url, paramName, paramValue) {
  var pattern = new RegExp('('+paramName+'=).*?(&|$)'),
   newUrl = url.replace(pattern,'$1' + paramValue + '$2');
  if ( newUrl == url ) {
   newUrl = newUrl + (newUrl.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
  }
  return newUrl;
}        
        
})(jQuery);

 </script>