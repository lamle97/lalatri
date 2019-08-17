<div class="ps-hero">
  <div class="container">
    <h3>Trang quản lý</h3>
  </div>
</div>
<main class="ps-main pt-80 pb-80">
  <div class="ps-container">
     <div class="MyAccount">
      <nav class="MyAccount-navigation">
        <ul>
          <li class="active"><a href="<?php echo base_url('account') ?>">Trang quản lý</a></li>
          <li><a href="<?php echo base_url('account/info') ?>">Thông tin tài khoản</a></li>
          <li><a href="<?php echo base_url('account/orders') ?>">Đơn hàng</a></li>
          <li><a href="<?php echo base_url('account/reviews') ?>">Đánh giá</a></li>
          <li><a href="<?php echo base_url('account/wishlists') ?>">Danh sách yêu thích</a></li>
        </ul>
      </nav>   
      <div class="MyAccount-content">   
        <div class="col-md-12 pb-20">
          <strong>Xin chào, <?php echo $customer['lastname']. ' ' .$customer['firstname'] ?>!</strong>
          <p>Từ trang quản lý này, bạn có thể xem lại các hóa đơn và thông tin của mình. Chọn các liên kết bên dưới để chỉnh sửa thông tin.</p>
        </div>
        <div class="col-md-12">
            <strong class="pull-left">Hóa đơn gần đây</strong>
            <a class="pull-right" href="account/orders">Xem tất cả </a>
        </div>
        <div class="col-md-12 pb-20">
          <table class="table ps-cart__table">
            <thead>
              <tr>
                <th>Mã hóa đơn #</th>
                <th>Ngày mua</th>
                <th>Giao hàng đến</th>
                <th>Tổng hóa đơn</th>
                <th>Đã thanh toán</th>
                <th>Trạng thái</th>
                <th>&nbsp;</th>
              </tr>
            </thead>  
            <tbody>
            <?php for ($i=0; $i < 5 && $i < count($orders); $i++) { ?>
              <tr>
                <td>#<?php echo $orders[$i]['order_id'] ?></td>
                <td><?php echo date("d/m/Y", strtotime($orders[$i]['date_added'])) ?></td>
                <td><?php echo $orders[$i]['shipping_address'] ?></td>
                <td><span class="price"><?php echo  number_format($orders[$i]['total'],0,'','.') ?></span></td>
                <td><em><?php echo ($orders[$i]['status'])?'Đã thanh toán':'Chưa thanh toán' ?></em></td>
                <td><em><?php echo ($orders[$i]['shipping_status'] == 2)?'Đã giao hàng':(($orders[$i]['shipping_status'] == 1)?'Đang giao hàng':'Chưa giao hàng') ?></em></td>
                <td><a href="<?php echo base_url('account/orders/view/'.$orders[$i]['order_id']) ?>">Xem chi tiết hóa đơn</a></td>
              </tr>                      
            <?php } ?>
            </tbody>                         
          </table>
        </div>
        <div class="col-md-12">
          <div class="col-md-4">
            <strong>Thông tin tài khoản</strong>
            <p>Họ tên: <?php echo $customer['lastname']. ' ' .$customer['firstname'] ?></p>
            <p>Email: <?php echo $customer['email'] ?></p>
            <p>Điện thoại: <?php echo $customer['telephone'] ?></p>
            <p>Địa chỉ: <?php echo $customer['address_1'] ?></p>
            <p>Thành phố: <?php echo $customer['city'] ?></p>
            <p>Quận huyện: <?php echo $customer['zone'] ?></p> 
          </div>    
          <div class="col-md-4">
            <strong>Nhận thông báo</strong>
            <p> <?php echo ($customer['newsletter'])?"Bạn đang bật chức năng nhận email thông báo từ website":"Bạn đang tắt chức năng nhận email thông báo từ website" ?> </p>
          </div> 
          <div class="col-md-4">
            <a class="pull-right" href="account/info">Chỉnh sửa</a>            
          </div>   
        </div>
      </div>      
     </div>
  </div>
</main>