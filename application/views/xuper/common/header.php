<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="format-detection" content="telephone=no"><meta name="apple-mobile-web-app-capable" content="yes">
	<link href="apple-touch-icon.png" rel="apple-touch-icon" />
	<link rel="icon" href="<?php echo base_url('images/'.$setting['shop_icon']) ?>" type="image/x-icon" />
	<meta name="keywords" content="<?php echo $setting['shop_keywords'] ?>">
	<meta name="description" content="<?php echo $setting['shop_description'] ?>">
	<link rel="canonical" href="<?php echo base_url() ?>">
	<title><?php echo (isset($title))?$title." | ".$setting['shop_name']:$setting['shop_name'] ?></title>
	<!-- Fonts-->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CLibre+Baskerville:400,700" rel="stylesheet" />
	<link href="<?php echo $base_template.'plugins/font-awesome/css/font-awesome.min.css' ?>" rel="stylesheet" />
	<link href="<?php echo $base_template.'plugins/ps-icon/style.css' ?>" rel="stylesheet" /><!-- CSS Library-->
	<link href="<?php echo $base_template.'plugins/bootstrap/dist/css/bootstrap.min.css' ?>" rel="stylesheet" />
	<link href="<?php echo $base_template.'plugins/owl-carousel/assets/owl.carousel.css' ?>" rel="stylesheet" />
	<link href="<?php echo $base_template.'plugins/bootstrap-select/dist/css/bootstrap-select.min.css' ?>" rel="stylesheet" />
	<link href="<?php echo $base_template.'plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css' ?>" rel="stylesheet" />
	<link href="<?php echo $base_template.'plugins/slick/slick/slick.css' ?>" rel="stylesheet" /><!-- Custom-->
	<link href='<?php echo $base_template.'css/ion.rangeSlider.css' ?>' rel='stylesheet' type='text/css' />
	<link href='<?php echo $base_template.'css/ion.rangeSlider.skinModern.css' ?>' rel='stylesheet' type='text/css' />
	<link href="<?php echo $base_template.'css/style.css' ?>" rel="stylesheet" />
	<link href="<?php echo $base_template.'plugins/revolution/css/settings.css' ?>" rel="stylesheet" />
	<link href="<?php echo $base_template.'plugins/revolution/css/layers.css' ?>" rel="stylesheet" />
	<link href="<?php echo $base_template.'plugins/revolution/css/navigation.css' ?>" rel="stylesheet" /><!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries--><!--WARNING: Respond.js doesn't work if you view the page via file://--><!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->

	<!-- JS Library-->
    <script src="<?php echo $base_template.'plugins/jquery/dist/jquery.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/bootstrap/dist/js/bootstrap.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/owl-carousel/owl.carousel.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/bootstrap-select/dist/js/bootstrap-select.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/jquery-bar-rating/dist/jquery.barrating.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/imagesloaded.pkgd.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/masonry.pkgd.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/isotope.pkgd.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/slick/slick/slick.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/jquery.matchHeight-min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/elevatezoom/jquery.elevatezoom.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/revolution/js/jquery.themepunch.tools.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/revolution/js/jquery.themepunch.revolution.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/revolution/js/extensions/revolution.extension.video.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/revolution/js/extensions/revolution.extension.slideanims.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/revolution/js/extensions/revolution.extension.navigation.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/revolution/js/extensions/revolution.extension.parallax.min.js' ?>"></script>
    <script src="<?php echo $base_template.'plugins/revolution/js/extensions/revolution.extension.actions.min.js' ?>"></script>
    <script src='<?php echo $base_template.'js/ion.rangeSlider.js' ?>' type='text/javascript'></script>
    <script src="<?php echo $base_template.'js/slider-1.js' ?>"></script>
    <script src="<?php echo $base_template.'js/validator.min.js' ?>"></script>
    <!-- Custom scripts-->
    <script src="<?php echo $base_template.'js/main.js' ?>"></script>	
</head>
<!--[if IE 7]><body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]--><!--[if IE 8]><body class="ie8 lt-ie9 lt-ie10"><![endif]--><!--[if IE 9]><body class="ie9 lt-ie10"><![endif]-->
<body class="ps-loading">
	<div class="header--sidebar"></div>

	<header class="header" data-sticky="true">
		<div class="header__top">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
						<p><?php echo $setting['shop_address'] ?> - Hotline: <?php echo $setting['shop_telephone'] ?></p>
						                

					</div>

					<div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 ">
						<div class="header__actions">
							<?php
							if (!$customer) {
								echo '<a title="Đăng nhập" href="/account/login"><span>Đăng nhập</span></a><a title="Đăng ký" href="/account/register"><span>Đăng ký</span></a>';
							}
							else
							{
								?>
								<div class="btn-group ps-dropdown"><a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"></i> <span>Tài khoản</span></a>
									<ul class="dropdown-menu">
										<li><a href="/account">Thông tin tài khoản</a></li>
										<li><a href="/account/logout">Đăng xuất</a></li>
									</ul>
								</div>
								<a title="Yêu thích" href="/account/wishlists">
									<i class="fa fa-heart"></i> <span>Danh sách yêu thích</span>
								</a>
								<?php		
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<nav class="navigation">
			<div class="container-fluid">
				<div class="left">
					<div class="header__logo"><a class="ps-logo" href="/"><img alt="<?php echo $setting['shop_name'] ?>" src="<?php echo base_url('images/'.$setting['shop_logo']) ?>" /></a></div>
				</div>

				<div class="center">
					<ul class="main-menu menu">
						<li><a href="/"> <span>Trang chủ</span></a></li>
						<?php foreach ($category->getCategories(array('parent_id' => 0, 'status' => 1)) as $parent) { 
							echo '<li class="menu-item-has-children dropdown"><a href="'. base_url('categories/'. $parent['category_id'] .'-'.$parent['keyword']) .'">'. $parent['name'] .'</a>';
							$ul = $category->getCategories(array('parent_id' => $parent['category_id'], 'status' => 1));
							if ($ul) {
								echo '<ul class="sub-menu">';
								foreach ($ul as $child) { 
									echo '<li><a href="'. base_url('categories/'. $child['category_id'] .'-'. $child['keyword']) .'">'. $child['name'] .'</a></li>';
								}
								echo '</ul>';
							}
							echo '</li>';
						} ?>
						<?php foreach ($setting['menu'] as $menu) {
							echo '<li><a href="'. $menu['link'] .'">'. $menu['name'] .'</a></li>';
						} ?>
					</ul>
				</div>

				<div class="right">
					<div class="menu-toggle"></div>

					<div class="ps-cart"><a class="ps-cart__toggle" href="/account/carts"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span><i><?php echo $cart['total_items'] ?></i></span></a>
						<?php if ($cart['total_items'] == 0) { ?>
						<div class="ps-cart__listing ps-cart__listingempty">
		              		<div class="ps-cart__content">
				          		<p class="ps-cart__conten__tempty">Không có sản phẩm nào trong giỏ hàng !</p>
				          	</div>
			        	</div>
						<?php } else { ?>
						<div class="ps-cart__listing">
							<div class="ps-cart__content">
								<?php foreach ($cart['products'] as $key => $product) {
									$price = ($product['discount'] != $product['price'])?$product['discount']:$product['price'];
									?>
									<div class="ps-cart-item">
										<a href="<?php echo base_url('account/carts/delete/'.$product['product_option_id']) ?>" class="ps-cart-item__close remove" title="Xóa sản phẩm"></a>
										<div class="ps-cart-item__thumbnail"><img alt="<?php echo $product['name'] ?>" src="<?php echo base_url('images/'.$product['image']) ?>" /></div>

										<div class="ps-cart-item__content"><a class="ps-cart-item__title" href="<?php echo base_url('products/'.$product['product_id'].'-'.$product['keyword']) ?>" title="<?php echo $product['name'] ?>"><?php echo $product['name'] ?></a>

											<p><span>Số lượng:<i><?php echo $product['quantity'] ?></i></span><span>Tổng:<i><?php echo number_format($price*$product['quantity'],0,'','.') ?></i></span></p>
										</div>
									</div>
									<?php
								}
								?>
							</div>

							<div class="ps-cart__total">
								<p>Tổng tiền:<span><?php echo number_format($cart['total_money'],0,'','.') ?> VND</span></p>
							</div>

							<div class="ps-cart__footer"><a class="ps-btn" href="/account/checkout">Thanh toán <i class="ps-icon-arrow-left"></i></a></div>
						</div>
					<?php } ?>
					</div>

					<form action="/search" class="ps-form--search" method="get">
						<input class="form-control" placeholder="Nhập từ khóa cần tìm" name="name" type="text" />
						<button type="submit"><i class="ps-icon-search"></i></button>
					</form>
				</div>
			</div>
		</nav>
	</header>