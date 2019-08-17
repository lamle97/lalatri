  <!-- main-container -->
  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-main col-sm-9 wow bounceInUp animated">
          <div class="my-account">
            <div class="page-title">
              <h2>Trang quản lý</h2>
            </div>
            <div class="dashboard">
              <div class="welcome-msg"> <strong>Xin chào, <?php echo $customer['firstname']. ' ' .$customer['lastname'] ?>!</strong>
                <p>Từ trang quản lý này, bạn có thể xem lại các hóa đơn và thông tin của mình. Chọn các liên kết bên dưới để chỉnh sửa thông tin.</p>
              </div>
              <div class="recent-orders">
                <div class="title-buttons"><strong>Hóa đơn gần đây</strong> <a href="account/orders">Xem tất cả </a> </div>
                <div class="table-responsive">
                  <table class="data-table" id="my-orders-table">
                    
                    <thead>
                      <tr class="first last">
                        <th>Mã hóa đơn #</th>
                        <th>Ngày mua</th>
                        <th>Giao hàng đến</th>
                        <th><span class="nobr">Tổng hóa đơn</span></th>
                        <th>Đã thanh toán</th>
                        <th>Trạng thái</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php for ($i=0; $i < 2 && $i < count($orders); $i++) { ?>
                      <tr class="first odd">
                        <td>#<?php echo $orders[$i]['order_id'] ?></td>
                        <td><?php echo date("d-m-Y", strtotime($orders[$i]['date_added'])) ?></td>
                        <td><?php echo $orders[$i]['shipping_address'] ?></td>
                        <td><span class="price"><?php echo  number_format($orders[$i]['total'],0,'','.') ?></span></td>
                        <td><em><?php echo ($orders[$i]['status'])?'Đã thanh toán':'Chưa thanh toán' ?></em></td>
                        <td><em><?php echo ($orders[$i]['shipping_status'] == 2)?'Đã giao hàng':(($orders[$i]['shipping_status'] == 1)?'Đang giao hàng':'Chưa giao hàng') ?></em></td>
                        <td class="a-center last"><span class="nobr"> <a href="<?php echo base_url('account/orders/view/'.$orders[$i]['order_id']) ?>">Xem chi tiết hóa đơn</a></td>
                      </tr>                      
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="box-account">
                <div class="page-title">
                  <h2>Thông tin tài khoản</h2>
                </div>
                <div class="col2-set">
                  <div class="col-1">
                    <h5>Thông tin liên hệ</h5>
                    <a href="./info">Chỉnh sửa</a>
                    <p> <?php echo $customer['firstname']. ' ' .$customer['lastname'] ?><br>
                        <?php echo $customer['email'] ?><br>
                        <?php echo $customer['telephone'] ?><br>
                        <?php echo $customer['address_1'] ?><br>
                        <?php echo $customer['email'] ?><br>
                        <?php echo $customer['city'] ?><br>
                        <?php echo $customer['zone'] ?><br>
                  </div>
                  <div class="col-2">
                    <h5>Nhận thông báo</h5>
                    <p> <?php echo ($customer['newsletter'])?"Bạn đang bật chức năng nhận email thông báo từ website":"Bạn đang tắt chức năng nhận email thông báo từ website" ?> </p>
                  </div>
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
                <li class="current"><a>Trang quản lý</a></li>
                <li><a href="<?php echo base_url('account/info') ?>">Thông tin tài khoản</a></li>
                <li><a href="<?php echo base_url('account/orders') ?>">Đơn hàng</a></li>
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