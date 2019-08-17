<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">invoice</a> </div>
    <h1>Invoice</h1>
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
        <form method="post" class="form-horizontal">
        <button type="button" class="btn btn-info tip-top" data-original-title="Print"  onclick="javascript:printDiv('printablediv')"><i class="icon-print"></i></button>
        <div class="widget-box" id="printablediv">
          <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
            <h5 >Customer Info</h5>
          </div>
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span6">
                <table class="">
                  <tbody>
                    <tr>
                      <td><h4><?php echo $order['customer'] ?></h4></td>
                    </tr>
                    <tr>
                      <td><?php echo $customer['address_1'] ?></td>
                    </tr>
                    <tr>
                      <td><?php echo $customer['address_2'] ?></td>
                    </tr>
                    <tr>
                      <td><?php echo $customer['city'].' / ' .$customer['zone'] ?></td>
                    </tr>                    
                    <tr>
                      <td>Mobile Phone: <?php echo $customer['telephone'] ?></td>
                    </tr>
                    <tr>
                      <td><?php echo $customer['email'] ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="span6">
                <table class="table table-bordered table-invoice">
                  <tbody>
                    <tr>
                    <tr>
                      <td class="width30">Invoice ID:</td>
                      <td class="width70"><strong>#<?php echo $order['order_id'] ?></strong></td>
                    </tr>
                    <tr>
                      <td>Date Create:</td>
                      <td><strong><?php echo date("d-m-Y", strtotime($order['date_added'])) ?></strong></td>
                    </tr>
                  <td class="width30">Shipping Address:</td>
                    <td class="width70"><strong><?php echo $order['customer'] ?></strong> <br>
                      <?php echo $order['shipping_address'] ?><br>
                      <?php echo $order['city'].' / ' .$order['zone'] ?><br>
                      Contact No: <?php echo $order['shipping_telephone'] ?></td>
                  </tr>
                    </tbody>
                  
                </table>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span12">
                <table class="table table-bordered table-invoice-full">
                  <thead>
                    <tr>
                      <th class="head0">Product</th>
                      <th class="head1">Model</th>
                      <th class="head0 right">Price</th>
                      <th class="head1 right">Quantity</th>
                      <th class="head0 right">Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($order['products'] as $product) { ?>
                    <tr>
                      <td><?php echo $product['name'] ?></td>
                      <td><?php echo $product['model'] ?></td>
                      <td class="right"><?php echo $product['price'] ?></td>
                      <td class="right"><?php echo $product['quantity'] ?></td>
                      <td class="right"><strong><?php echo $product['total'] ?></strong></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
                <table class="table table-bordered table-invoice-full">
                  <tbody>
                    <tr>
                      <td class="msg-invoice" width="50%"><h4>Payment method: </h4>
                        <a href="#" class="tip-bottom" title="<?php echo $order['payment']['name'] ?>"><?php echo $order['payment']['name'] ?></a></td>
                      <td><strong>Order Status</strong> <br>
                          <select name="status" id="status">
                            <option value="1">Paid</option>
                            <option value="0" <?php echo (!$order['status'])?'selected="selected"':'' ?>>Unpaid</option>
                          </select>
                      </td>
                      <td><strong>Shipping Status</strong> <br>
                          <select name="shipping_status" id="shipping_status">
                            <option value="2">Shipped</option>
                            <option value="1" <?php echo ($order['shipping_status'] == 1)?'selected="selected"':'' ?>>Shipping</option>
                            <option value="0" <?php echo ($order['shipping_status'] == 0)?'selected="selected"':'' ?>>Pending</option>
                          </select>
                      </td>
                      <td class="right"><strong>Subtotal</strong> <br>
                        <strong>Shipping</strong> <br>
                        <strong>Discount</strong></td>
                      <td class="right"><strong><?php echo $order['total'] ?><br>
                        Free <br>
                        0</strong></td>
                    </tr>
                  </tbody>
                </table>
                <div class="pull-right">
                  <h4><span>Amount Due:</span> <?php echo $order['total'] ?></h4>
                  <br>
                  <button class="btn btn-primary btn-large pull-right" type="submit" name="update" value="update">Update Invoice</button> </div>
              </div>
            </div>
          </div>
        </form>  
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function printDiv(divID) {
      //Get the HTML of div
      var divElements = document.getElementById(divID).innerHTML;

      //Reset the page's HTML with div's HTML only
      document.body.innerHTML = 
        "<html><head><title></title></head><body>" + 
        divElements + "</body>";

      //Print Page
      window.print();

      //Restore orignal HTML
      location.reload(); 

  }  
</script>