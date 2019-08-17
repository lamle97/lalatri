<div class="main container">
		<div class="col-main">
			<div class="cart">
				<div class="page-title">
					<div class="row">
						<div class="col-sm-8 col-sm-12">
							<h2>Chi tiết đơn hàng #<?php echo $order['order_id'] ?></h2>
							<p>Ngày tạo : <?php echo date("d-m-Y", strtotime($order['date_added'])) ?></p>
						</div>
						<div class="col-sm-4 col-xs-12">
							<a href="/account" class="accountBackToAccounts">
								<i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Quay lại trang tài khoản
							</a>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<fieldset>
						<table class="data-table cart-table" id="shopping-cart-table">
							<thead>
								<tr class="first last">
									<th rowspan="1">Sản phẩm</th>
									<th style="width: 200px" rowspan="1"><span class="nobr">Model</span></th>
									<th style="width: 150px" class="a-center" rowspan="1">Giá</th>
									<th style="width: 150px" colspan="1" class="a-center">Số lượng</th>
									<th style="width: 150px !important" class="a-center" rowspan="1">Thành tiền</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($order['products'] as $product) { ?>
								<tr>
									<td><?php echo $product['name'] ?></td>
									<td><?php echo $product['model'] ?></td>
									<td class="a-center"><?php echo  number_format($product['price'],0,'','.') ?></td>
									<td class="a-center"><?php echo $product['quantity'] ?></td>
									<td class="a-center"><?php echo  number_format($product['total'],0,'','.') ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</fieldset>
				</div>
				<!-- BEGIN CART COLLATERALS -->
				<div class="cart-collaterals row">
					<div class="col-sm-4">
						<div class="shipping">
							<h4>Thông tin thanh toán</h4>
							<div class="inner">
								<p>Trạng thái thanh toán: <strong><?php echo ($order['status'])?'Đã thanh toán':'Chưa thanh toán' ?></strong></p>
								<p>Phương thức thanh toán: <strong><?php echo $order['payment']['name'] ?></strong></p>
								<?php echo ($order['status'])?'':'<p>'.$order['payment']['method'].'</p>' ?>
							</div>
							<h4>Ghi chú</h4>
							<div class="inner">
								<p><?php echo $order['note'] ?></p>
							</div>							
						</div>
					</div>
					<div class="col-sm-4">
						<div class="discount">
							<h4>Thông tin giao hàng</h4>
							<div class="inner">
								<p>Trạng thái vận chuyển: <?php echo ($order['shipping_status'])?'Đã giao hàng':'Chưa giao hàng' ?></p>
								<p><?php echo $order['shipping_firstname'].' '.$order['shipping_lastname'] ?></p>
								<p><?php echo $order['shipping_address'] ?></p>
								<p><?php echo $order['shipping_telephone'] ?></p>
								<p><?php echo $order['city'] ?></p>
								<p><?php echo $order['zone'] ?></p>
							</div>
						</div>
					</div>
					<div class="totals col-sm-4">
						
						<h4>Tổng tiền hóa đơn</h4>
						<div class="inner">
							<table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
								<tbody>
									<tr>
										<td colspan="1" class="a-left"> Tổng tiền </td>
										<td class="a-right pull-right"><span class="price"><?php echo  number_format($order['total'],0,'','.') ?></span></td>
									</tr>
									
									<tr>
										<td colspan="1" class="a-left">Giao hàng tận nơi:</td>
										<td class="a-right pull-right">Miễn phí</td>
									</tr>
									
									
									<tr>
										<td colspan="1" class="a-left"> Cần thanh toán </td>
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