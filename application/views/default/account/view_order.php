<div class="main container" id="printablediv">
		<div class="col-main">
			<div class="cart">
				<div class="page-title">
					<div class="row">
						<div class="col-sm-8 col-sm-12">
							<h2>Detail Order #<?php echo $order['order_id'] ?></h2>
							<p>Date Create : <?php echo date("d-m-Y", strtotime($order['date_added'])) ?></p>
						</div>
						<div class="col-sm-4 col-xs-12">
							<a href="/account" class="btn small color1 accountBackToAccounts">
								<i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back to account
							</a>
							<button type="button" class="btn small color1 tip-top" data-original-title="Print"  onclick="javascript:printDiv('printablediv')"><i class="fa fa-print"></i></button>
						</div>
					</div>
				</div>
				<div class="block-center" >
					<table id="order-list" class="table table-bordered footab default footable-loaded footable">
						<thead>
							<tr class="first last">
								<th>Product</th>
								<th><span class="nobr">Model</span></th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($order['products'] as $product) { ?>
							<tr>
								<td><?php echo $product['name'] ?></td>
								<td><?php echo $product['model'] ?></td>
								<td><?php echo  number_format($product['price'],0,'','.') ?></td>
								<td><?php echo $product['quantity'] ?></td>
								<td><?php echo  number_format($product['total'],0,'','.') ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<!-- BEGIN CART COLLATERALS -->
				<div class="cart-collaterals row">
					<div class="col-sm-4">
						<div class="shipping">
							<h4>Payment info</h4>
							<div class="inner">
								<p>Status: <strong><?php echo ($order['status'])?'Paid':'Unpaid' ?></strong></p>
								<p>Payment method: <strong><?php echo $order['payment']['name'] ?></strong></p>
								<?php echo ($order['status'])?'':'<p>'.$order['payment']['method'].'</p>' ?>
							</div>
							<h4>Note</h4>
							<div class="inner">
								<p><?php echo $order['note'] ?></p>
							</div>							
						</div>
					</div>
					<div class="col-sm-4">
						<div class="discount">
							<h4>Ship Info</h4>
							<div class="inner">
								<p>Shipping Status: <?php echo ($order['shipping_status'] == 2)?'Shipped':(($order['shipping_status'] == 1)?'Shipping':'Pending') ?></p>
								<p><?php echo $order['shipping_firstname'].' '.$order['shipping_lastname'] ?></p>
								<p><?php echo $order['shipping_address'] ?></p>
								<p><?php echo $order['shipping_telephone'] ?></p>
								<p><?php echo $order['city'] ?></p>
								<p><?php echo $order['zone'] ?></p>
							</div>
						</div>
					</div>
					<div class="totals col-sm-4">
						
						<h4>Total Order</h4>
						<div class="inner">
							<table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
								<tbody>
									<tr>
										<td colspan="1" class="a-left"> Total </td>
										<td class="a-right pull-right"><span class="price"><?php echo  number_format($order['total'],0,'','.') ?></span></td>
									</tr>
									
									<tr>
										<td colspan="1" class="a-left">Ship Fee:</td>
										<td class="a-right pull-right"><span>Free</span></td>
									</tr>
									
									
									<tr>
										<td colspan="1" class="a-left"> Need Pay </td>
										<td class="a-right pull-right"><span class="price"><?php echo ($order['status'])?'0':number_format($order['total'],0,'','.') ?></span></td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<!--inner-->
					</div>
				</div>
				<!--cart-collaterals-->
			</div>
		</div>
	</div>
</section>
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