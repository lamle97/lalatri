  <!-- main-container -->
  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-main col-sm-9 wow bounceInUp animated">
          <div class="my-account">
            <div class="page-title">
              <h2>Hóa đơn mua hàng</h2>
            </div>
            <div class="dashboard">
              <div class="orders">
                <div class="title-buttons"><strong>Tất cả hóa đơn của bạn</strong></div>
                <div class="table-responsive">
                  <table class="data-table" id="my-orders-table">
                    <thead>
                      <tr class="first last">
                        <th>Mã hóa đơn #</th>
                        <th>Ngày tạo</th>
                        <th>Giao hàng đến</th>
                        <th><span class="nobr">Tổng hóa đơn</span></th>
                        <th>Đã thanh toán</th>
                        <th>Trạng thái</th>
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
                        <td><em><?php echo ($order['status'])?'Đã thanh toán':'Chưa thanh toán' ?></em></td>
                        <td><em><?php echo ($order['shipping_status'] == 2)?'Đã giao hàng':(($order['shipping_status'] == 1)?'Đang giao hàng':'Chưa giao hàng') ?></em></td>
                        <td class="a-center last"><span class="nobr"> <a href="<?php echo base_url('account/orders/view/'.$order['order_id']) ?>">Xem chi tiết hóa đơn</a></td>
                      </tr>                      
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
        <aside class="col-right sidebar col-sm-3 wow bounceInUp animated">
          <div class="block block-account">
            <div class="block-title">Tài khoản của tôi</div>
            <div class="block-content">
              <ul>
                <li><a href="<?php echo base_url('account') ?>">Trang quản lý</a></li>
                <li><a href="<?php echo base_url('account/info') ?>">Thông tin tài khoản</a></li>
                <li class="current"><a>Đơn hàng</a></li>
                <li><a href="<?php echo base_url('account/reviews') ?>">Đánh giá</a></li>
                <li><a href="<?php echo base_url('account/wishlists') ?>">Danh sách yêu thích</a></li>
              </ul>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
  <!--End main-container -->