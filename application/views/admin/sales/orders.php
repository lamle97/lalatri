<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
     <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Orders</a> </div>
    <h1>Orders</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <?php
    if (isset($success))
      echo '<div class="alert alert-success"><strong>Success!</strong> '. $success .'<button type="button" class="close" data-dismiss="alert">×</button></div>';
    if (isset($error))
      echo '<div class="alert alert-error"><strong>Error!</strong> '. $error .'<button type="button" class="close" data-dismiss="alert">×</button></div>';    
    ?> 
    <div class="row-fluid">
      <div class="span12">
      <form action="orders/delete" method="post">
      	<a class="btn btn-info tip-top" data-original-title="Add new" href="orders/add" disabled="" onclick="return false"><i class="icon-plus"></i></a>
      	<button class="btn btn-danger tip-top" data-original-title="Delete" type="submit"><i class="icon-trash"></i></button>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>List Orders</h5>
          </div>
          <div class="widget-content">
            <div class="span4">
              <div class="control-group">
                <label class="control-label">Order ID :</label>
                <div class="controls">
                  <input type="text" class="span11" name="order_id" id="order_id" placeholder="Order ID" />
                </div>
              </div> 
              <div class="control-group">
                <label class="control-label">Customer :</label>
                <div class="controls">
                  <input type="text" class="span11" name="customer" id="customer" placeholder="Customer" />
                </div>
              </div> 
            </div>
            <div class="span4">                               
              <div class="control-group">
                <label class="control-label">Order Status :</label>
                <div class="controls">
                  <select name="status" id="status">
                    <option value=""></option>
                    <option value="1">Paid</option>
                    <option value="0">Unpaid</option>
                  </select>
                </div>
              </div> 
              <div class="control-group">
                <label class="control-label">Shipping Status :</label>
                <div class="controls">
                  <select name="shipping_status" id="shipping_status">
                    <option value=""></option>
                    <option value="2">Shipped</option>
                    <option value="1">Shipping</option>
                    <option value="0">Pending</option>
                  </select>
                </div>
              </div>                 
            </div>
            <div class="span4"> 
              <div class="control-group">
                <label class="control-label">Date Start :</label>
                <div class="controls">
                  <div data-date="" class="input-append date datepicker">
                      <input type="text" value="" name="date_start" id="date_start">
                      <span class="add-on"><i class="icon-th"></i></span>
                  </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Date End :</label>
                <div class="controls">
                  <div data-date="" class="input-append date datepicker">
                      <input type="text" value="" name="date_end" id="date_end">
                      <span class="add-on"><i class="icon-th"></i></span>
                  </div>
                </div>
              </div>  
              <div class="control-group">  
                <a class="btn btn-info" onclick="filter()"><i class="icon-search"></i> Filter</a>
              </div>                                    
            </div>  
            <table class="table table-bordered table-striped with-check text-center">
              <thead>
                <tr>
                  <th><input onclick="$('input[name*=\'item\']').prop('checked', this.checked);" type="checkbox"></th>
                  <th>Order ID</th>
                  <th>Customer</th>
                  <th>Status</th>
                  <th>Shipping Status</th>
                  <th>Total</th>
                  <th>Date Added</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($orders as $order) {
                echo '<tr>';
                echo '<td><input type="checkbox" name="item[]" value="'. $order['order_id'] .'"/></td>';
                echo '<td>#'. $order['order_id'] .'</td>';
                echo '<td>'. $order['customer'] .'</td>';
                echo '<td>' .(($order['status'])?'Paid':'Unpaid'). '</td>';
                echo '<td>' .(($order['shipping_status'] == 2)?'Shipped':(($order['shipping_status'] == 1)?'Shipping':'Pending')). '</td>';
                echo '<td>'. $order['total'] .'</td>';
                echo '<td>' .date("d-m-Y", strtotime($order['date_added'])). '</td>';
                echo '<td><a class="btn btn-info" href="orders/view/'. $order['order_id'] .'"><i class="icon-eye-open"></i> View</a> <a class="btn btn-info" href="orders/edit/'. $order['order_id'] .'" disabled="" onclick="return false"><i class="icon-edit"></i> Edit</a></td>';
                echo '</tr>';
              } ?>
              </tbody>
            </table>
            <?php echo $pagination ?>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function filter() {
    var currentLocation = '<?php echo base_url('admin/sales/orders') ?>';
    var filter_order_id = $("#order_id").val();
    var filter_status = $("#status").val();   
    var filter_shipping_status = $("#shipping_status").val();
    var filter_customer = $("#customer").val(); 
    var filter_date_start = $("#date_start").val();
    var filter_date_end = $("#date_end").val();

    var url = "?status=" + filter_status;

    if (filter_order_id != "")
      url += '&order_id=' + filter_order_id;
    if (filter_shipping_status != "")
      url += '&shipping_status=' + filter_shipping_status;   
    if (filter_customer != "")
      url += '&customer=' + filter_customer;
    if (filter_date_start != "")
      url += '&date_start=' + filter_date_start;     
    if (filter_date_end != "")
      url += '&date_end=' + filter_date_end;                      

    window.location.href = currentLocation + url;
  }
</script>
<!--end-main-container-part-->