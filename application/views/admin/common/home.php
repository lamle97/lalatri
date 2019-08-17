<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->   
  <hr/>
  <?php
    if (isset($success))
      echo '<div class="alert alert-success"><strong>Success!</strong> '. $success .'<button type="button" class="close" data-dismiss="alert">×</button></div>';
    if (isset($error))
      echo '<div class="alert alert-error"><strong>Error!</strong> '. $error .'<button type="button" class="close" data-dismiss="alert">×</button></div>';    
  ?>
<!--Chart-box-->    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>Site Analytics</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span9">
              <div class="chart"></div>
            </div>
            <div class="span3">
              <ul class="site-stats">
                <li class="bg_lh"><i class="icon-user"></i> <strong><?php echo $total_customer ?></strong> <small>Total Customers</small></li>
                <li class="bg_lh"><i class="icon-plus"></i> <strong><?php echo $new_customer ?></strong> <small>New Customers </small></li>
                <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong><?php echo $total_order ?></strong> <small>Total Orders</small></li>
                <li class="bg_lh"><i class="icon-flag"></i> <strong><?php echo $new_order?></strong> <small>New Orders</small></li>
                <li class="bg_lh"><i class="icon-repeat"></i> <strong><?php echo $pending_order ?></strong> <small>Pending Orders</small></li>
                <li class="bg_lh"><i class="icon-credit-card"></i> <strong><?php echo $total_sale ?></strong> <small>Total Sales</small></li>                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
<!--End-Chart-box--> 
    <hr/>
    <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-shopping-cart"></i></span>
          <h5>Latest Orders</h5>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered data-table">
            <thead>
              <tr>
                <th>Date</th>
                <th>Order #</th>
                <th>Ship to</th>
                <th>Customer</th>
                <th>Order Total</th>
                <th>Status</th>
                <th>Shipping Status</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($lasted_orders as $order) { 
              echo '<tr>';
              echo '<td>' .date("d-m-Y", strtotime($order['date_added'])). '</td>';
              echo '<td><a href="admin/sales/orders/view/'. $order['order_id'] .'">#' .$order['order_id']. '</a></td>';
              echo '<td>' .$order['shipping_address']. '</td>';
              echo '<td>' .$order['customer']. '</td>';
              echo '<td>' .$order['total']. '</td>';
              echo '<td>' .(($order['status'])?'Paid':'Unpaid'). '</td>';
              echo '<td>' .(($order['shipping_status'] == 2)?'Shipped':(($order['shipping_status'] == 1)?'Shipping':'Pending')). '</td>';
              echo '</tr>';
            } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part-->
<script type="text/javascript">
$(document).ready(function(){
  
  function gd(year, month, day) {
    return new Date(year, month, day).getTime();
  }
  
  // === Prepare peity charts === //
  maruti.peity();
  
  // === Prepare the chart data ===/
  var sin = [], cos = [];
    <?php for ($i = 0; $i < 12; $i++) {
      echo 'sin.push([gd(2017, '. $i .', 1), '. $orders[$i+1]['total'] .']);';
      echo 'cos.push([gd(2017, '. $i .', 1), '. $customers[$i+1]['total'] .']);';
    } ?>

    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

  // === Make chart === //
    var plot = $.plot($(".chart"),
           [ { data: sin, label: "Orders", color: "#ee7951"}, { data: cos, label: "Customers",color: "#4fb9f0" } ], {

               series: {
                   lines: { show: true },
                   points: { show: true }
               },
               grid: { hoverable: true, clickable: true },
               xaxis: {
                  mode:"time",
              tickSize: [1,"month"],
              tickLength: 0
          },
               yaxis: { min: 0 }
       });
    
  // === Point hover in chart === //
    var previousPoint = null;
    $(".chart").bind("plothover", function (event, pos, item) {
    
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                
                $('#tooltip').fadeOut(200,function(){
          $(this).remove();
        });
                var x = item.datapoint[0],
                    y = item.datapoint[1];
                    
                maruti.flot_tooltip(item.pageX, item.pageY,item.series.label + "<br/>" + monthNames[new Date(x).getMonth()] + " : " + y);
            }
            
        } else {
      $('#tooltip').fadeOut(200,function(){
          $(this).remove();
        });
            previousPoint = null;           
        }   
    });  
}); 
</script>