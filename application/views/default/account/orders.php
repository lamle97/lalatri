<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="page-title">
        <h2>Orders</h2>
      </div>
    </div>
  </div>
</div>
<div class="row clearfix f-space10"></div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="block-center" id="block-history">
                <table id="order-list" class="table table-bordered footab default footable-loaded footable">
                   <thead>
                      <tr class="first last">
                        <th>Order ID #</th>
                        <th>Date Create</th>
                        <th>Ship to</th>
                        <th><span class="nobr">Total/span></th>
                        <th>Status</th>
                        <th>Shipping Status</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($orders as $order) { ?>
                      <tr>
                        <td>#<?php echo $order['order_id'] ?></td>
                        <td><?php echo date("d-m-Y", strtotime($order['date_added'])) ?></td>
                        <td><?php echo $order['shipping_address'] ?></td>
                        <td><span class="price"><?php echo  number_format($order['total'],0,'','.') ?></span></td>
                        <td><em><?php echo ($order['status'])?'Paid':'Unpaid' ?></em></td>
                        <td><em><?php echo ($order['shipping_status'] == 2)?'Shipped':(($order['shipping_status'] == 1)?'Shipping':'Pending') ?></em></td>
                        <td class="a-center last"><span class="nobr"> <a href="<?php echo base_url('account/orders/view/'.$order['order_id']) ?>" class="btn small color1">Xem chi tiết hóa đơn</a></td>
                      </tr>                      
                    <?php } ?>
                    </tbody>
                </table>
                <div id="block-order-detail" class="unvisible">&nbsp;</div>
            </div>
            <div class="row clearfix f-space10"></div>
        </div>
    </div>
</div>
