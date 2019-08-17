<div class="ps-hero">
  <div class="container">
    <h3>Đăng nhập tài khoản</h3>
  </div>
</div>
<main class="ps-main pt-40 pb-40">
	<?php if (isset($error)) { ?>
	<div class="ps-container">
		<ul class="xuper-error" role="alert">
			<?php if  ($error == "Wrong email or password, please try again.")
					echo "<li><strong>Lỗi:</strong> Email không tồn tại hoặc sai mật khẩu.</li>";
				else
					echo "<li><strong>Lỗi:</strong> Email không tồn tại.</li>";
			?>
		</ul>
	</div>
	<?php } ?>
	<?php if (isset($success)) { ?>
	<div class="ps-container">
		<ul class="xuper-info" role="alert">
			<li><strong>Thành công:</strong> Khôi phục mật khẩu thành công. Vui lòng kiểm tra email của bạn và xem mật khẩu mới của bạn.</li>
		</ul>
	</div>
	<?php } ?>	
	<div class="ps-container">
		<div id="login-form" class="col-md-6">
			<h2>Đăng nhập</h2>
			<p>Nếu bạn đã có một tài khoản, hãy đăng nhập.</p>
			<form class="login" method="post">
				<p>
					<label for="email">Email <span class="required">*</span></label>
					<input class="form-control input-text required-entry" name="email" placeholder="Email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$" required="" type="email">			
				</p>
				<p>
					<label for="password">Mật khẩu <span class="required">*</span></label>
					<input class="form-control input-text required-entry validate-password" name="password" placeholder="Mật khẩu" required="" type="password">
				</p>
				<p class="form-row">			
					<button type="submit" class="ps-btn button" name="login" value="login"><i class="fa fa-unlock"></i> Đăng nhập</button>
					<a href="#recovery" class="pl-10">Quên mật khẩu?</a>
				</p>
			</form>
		</div>	
		<div id="recovery-form" class="col-md-6 hidden">
			<h2>Lấy lại mật khẩu</h2>
			<p>Bạn đã có một tài khoản nhưng bạn quên mật khẩu nên không thể đăng nhập vào hệ thống. Hãy điền Email vào ô bên dưới và nhận hỗ trợ lấy lại mật khẩu qua Email.</p>
			<form class="login" method="post" action="/account/login/recover">
				<p>
					<label for="email">Email <span class="required">*</span></label>
					<input class="form-control input-text required-entry" name="email" placeholder="Email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$" required="" type="email">			
				</p>
				<p class="form-row">			
					<button type="submit" class="ps-btn button" name="recover" value="recover"><i class="fa fa-paper-plane"></i> Gửi</button>
					<a href="#login" class="pl-10">Quay lại</a>
				</p>
			</form>
		</div>			
		<div class="col-md-6">
			<h2>Tạo tài khoản mới</h2>
			<p>Đăng ký tài khoản ngay để có thể mua hàng nhanh chóng và dễ dàng hơn ! Ngoài ra còn có rất nhiều chính sách và ưu đãi cho các thành viên.</p>
			<p class="form-row">			
				<a href="/account/register" class="ps-btn button"><i class="fa fa-user"></i> Tạo tài khoản</a>
			</p>
		</div>	
	</div>
</main>
