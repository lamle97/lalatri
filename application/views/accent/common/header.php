<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="robots" content="noodp,index,follow" />
		<meta name="keywords" content="dkt, bizweb, theme, accent theme">
		<meta name='revisit-after' content='1 days' />			
		<title><?php echo (isset($title))?$title." | ".$setting['shop_name']:$setting['shop_name'] ?></title>

		
		<meta name="description" content="<?php echo $setting['shop_description'] ?>">
		
		<link rel="canonical" href="<?php echo base_url() ?>">
		<link rel="icon" href="<?php echo base_url('images/'.$setting['shop_icon']) ?>" type="image/x-icon" />

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- CSS Style -->
		<link href='<?php echo $base_template.'css/bootstrap.min.css' ?>' rel='stylesheet' type='text/css' />
		<link href='<?php echo $base_template.'fonts/fontawesome/font-awesome.css' ?>' rel='stylesheet' type='text/css' />
		<link href='<?php echo $base_template.'css/owl.carousel.css' ?>' rel='stylesheet' type='text/css' />
		<link href='<?php echo $base_template.'css/owl.theme.css' ?>' rel='stylesheet' type='text/css' />
		<link href='<?php echo $base_template.'css/revslider.css' ?>' rel='stylesheet' type='text/css' />
		<link href='<?php echo $base_template.'css/styles.css' ?>' rel='stylesheet' type='text/css' />
		<link href='<?php echo $base_template.'css/flexslider.css' ?>' rel='stylesheet' type='text/css' />
		<link href='<?php echo $base_template.'css/bootstrap-social.css' ?>' rel='stylesheet' type='text/css' />
		<link href='<?php echo $base_template.'css/normalize.css' ?>' rel='stylesheet' type='text/css' />
		<link href='<?php echo $base_template.'css/ion.rangeSlider.css' ?>' rel='stylesheet' type='text/css' />
		<link href='<?php echo $base_template.'css/ion.rangeSlider.skinModern.css' ?>' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,300,700,800,400,600' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=vietnamese' rel='stylesheet' type='text/css' />

		<!-- JavaScript -->
		<script src="<?php echo $base_template.'js/jquery-1.11.2.js' ?>" type='text/javascript'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.1/owl.carousel.min.js' type='text/javascript'></script>		
		<script src='<?php echo $base_template.'js/bootstrap.min.js' ?>' type='text/javascript'></script>
		<script src='<?php echo $base_template.'js/parallax.js' ?>' type='text/javascript'></script>
		<script src='<?php echo $base_template.'js/common.js' ?>' type='text/javascript'></script>
		<script src='<?php echo $base_template.'js/revslider.js' ?>' type='text/javascript'></script>
		<script src='<?php echo $base_template.'js/ion.rangeSlider.js' ?>' type='text/javascript'></script>
		<script src='<?php echo $base_template.'js/jquery.flexslider.js' ?>' type='text/javascript'></script>
		<script src='<?php echo $base_template.'js/main.js' ?>' type='text/javascript'></script>

</head>

<body class="cms-index-index">
		<div class="page">
			<!-- Header -->
<header class="header-container">
	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<!-- Header Top Links -->
					<div class="toplinks">
						<div class="links">
						<?php if ($customer) { ?>
							<div class="myaccount">
								<a title="Tài khoản" onclick="$('.accounts').slideToggle()"><i class="fa fa-user"></i> <span>Tài khoản</span></a>
								<ul class="accounts" style="display:none;">
									<li><a href="/account">Thông tin tài khoản</a></li>
									<li><a href="/account/logout">Đăng xuất</a></li>
								</ul>
							</div>
						<?php } ?>	
							<div class="check">
								<a title="Yêu thích" href="/account/wishlists">
									<i class="fa fa-heart"></i> <span>Danh sách yêu thích</span>
								</a>
							</div>
							<div class="check">
								<a title="Thanh toán" href="/account/checkout">
									<i class="fa fa-shopping-cart"></i> <span>Thanh toán</span>
								</a>
							</div>
						</div>
					</div>
					<!-- End Header Top Links -->
				</div>
			</div>
		</div>
	</div>
	<div class="header container">
		<div class="row">
			<div class="col-lg-2 col-sm-3 col-md-2 col-xs-12">
				
				<!-- Header Logo -->
				<a class="logo" title="<?php echo $setting['shop_name'] ?>" href="/"><img width="120px" height="40px" alt="<?php echo $setting['shop_name'] ?>" src="<?php echo base_url('images/'.$setting['shop_logo']) ?>"></a>
				<!-- End Header Logo -->
					

			</div>
			<div class="col-lg-6 col-sm-5 col-md-6 col-xs-12">
				<!-- Search-col -->
				<div class="search-box">
					<form action="/catalog/search" method="get" id="search_mini_form">
						<input type="text" placeholder="Nhập từ khóa cần tìm" value="" maxlength="70" class="" name="name" id="search">
						<button id="submit-button" class="search-btn-bg" type="submit"><span>Tìm kiếm</span></button>
					</form>
				</div>
				<!-- End Search-col -->
			</div>
			<!-- Top Cart -->
			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<?php
				if (!$customer) {
			?>		
				<div class="signup"><a title="Đăng ký" href="/account/register"><span>Đăng ký</span></a></div>
				<span class="or hidden-xs hidden-sm"> hoặc </span>
				<div class="login"><a title="Đăng nhập" href="/account/login"><span>Đăng nhập</span></a></div>
			<?php
				}
			?>	
				
			</div>
			<!-- End Top Cart -->
		</div>
	</div>
</header>
<!-- end header -->
<!-- Navbar -->
<nav>
	<div class="container">
		<div class="nav-inner">
			<!-- mobile-menu -->
			<div class="hidden-desktop" id="mobile-menu">
				<ul class="navmenu">
					<li>
						<div class="menutop">
							<div class="toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div>
							<h2>Menu</h2>
						</div>
						<ul style="display:none;" class="submenu">
							<li>
								<ul class="topnav">
									
									
									<li class="level0 level-top parent">
										<a href="/" class="level-top"> <span>Trang chủ</span> </a>
									</li>
									

									<li class="level0 level-top parent">
										<a href="#"> <span>Sản phẩm</span> </a>
										<ul class="level0">
											<?php foreach ($category->getCategories(array('parent_id' => 0, 'status' => 1)) as $parent) { 
												echo '<li class="level1"><a href="'. base_url('catalog/categories/'. $parent['category_id']) .'"><span>'. $parent['name'] .'</span></a>';
												$ul = $category->getCategories(array('parent_id' => $parent['category_id'], 'status' => 1));
												if ($ul) {
													echo '<ul class="level1">';
													foreach ($ul as $child) { 
														echo '<li class="level2"><a href="'. base_url('catalog/categories/'. $child['category_id']) .'"><span>'. $child['name'] .'</span></a></li>';
													}
													echo '</ul>';
												}
												echo '</li>';
											} ?>
										</ul>
									</li>


									<?php foreach ($setting['menu'] as $menu) {
										echo '<li class="level0 level-top parent">
										<a href="'. $menu['link'] .'" class="level-top"> <span>'. $menu['name'] .'</span> </a>
									</li>';
									} ?>
									
									
								</ul>
							</li>
						</ul>
					</li>
				</ul>
				<!--navmenu-->
			</div>
			<!--End mobile-menu -->

			
			<!-- Header Logo -->
			<a class="logo-small" title="<?php echo $setting['shop_name'] ?>" href="/"><img width="120px" height="40px" alt="<?php echo $setting['shop_name'] ?>" src="<?php echo base_url('images/'.$setting['shop_logo']) ?>"></a>
			<!-- End Header Logo -->
				

			<ul id="nav" class="hidden-xs">
				
				
				<li class="level0"><a href="/"><span>Trang chủ</span> </a></li>
				
				<li class="level0 drop-menu">
					<a href="#"> <span>Sản phẩm</span> </a>
					<ul class="level1">
						<?php foreach ($category->getCategories(array('parent_id' => 0, 'status' => 1)) as $parent) { 
							echo '<li class="level1"><a href="'. base_url('catalog/categories/'. $parent['category_id']) .'"><span>'. $parent['name'] .'</span></a>';
							$ul = $category->getCategories(array('parent_id' => $parent['category_id'], 'status' => 1));
							if ($ul) {
								echo '<ul class="level1">';
								foreach ($ul as $child) { 
									echo '<li class="level2"><a href="'. base_url('catalog/categories/'. $child['category_id']) .'"><span>'. $child['name'] .'</span></a></li>';
								}
								echo '</ul>';
							}
							echo '</li>';
						} ?>
					</ul>
				</li>

				<?php foreach ($setting['menu'] as $menu) {
					echo '<li class="level0">
					<a href="'. $menu['link'] .'"> <span>'. $menu['name'] .'</span> </a>
				</li>';
				} ?>			
				

			</ul>
			<div class="top-cart-contain">
				<div class="mini-cart">
					<div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle">
						<a href="#">
							<div class="cart-box"><span id="cart-total"><strong><?php echo $cart['total_items'] ?></strong> <span class="hidden-xs">sản phẩm</span> </span></div>
						</a>
					</div>
					<div >
						<div class="top-cart-content arrow_box hidden-xs hidden-sm">
							<div class="block-subtitle">Các sản phẩm đã được mua</div>
							<ul id="cart-sidebar" class="mini-products-list">
							<?php foreach ($cart['products'] as $key => $product) {
								$price = ($product['discount'] != $product['price'])?$product['discount']:$product['price'];
							?>
							<li><a class="product-image" href="<?php echo base_url('catalog/products/'.$product['product_id']) ?>" title="<?php echo $product['name'] ?>"><img alt="<?php echo $product['name'] ?>" src="<?php echo base_url('images/'.$product['image']) ?>" width="60"></a>
			                    <div class="detail-item">
			                      <div class="product-details"> <a href="<?php echo base_url('account/carts/delete/'.$product['product_option_id']) ?>" title="Xóa" onClick="" class="glyphicon glyphicon-remove">&nbsp;</a>
			                        <p class="product-name"> <a href="<?php echo base_url('catalog/products/'.$product['product_id']) ?>" title="<?php echo $product['name'] ?>"><?php echo $product['name'] ?></a> </p>
			                      </div>
			                      <div class="product-details-bottom"> <span class="title-desc">Số lượng:</span> <strong><?php echo $product['quantity'] ?></strong> <span class="price"><?php echo number_format($price*$product['quantity'],0,'','.') ?></span>  </div>
			                    </div>
			                </li>
							<?php
								}
							?>
							</ul>
							<div class="top-subtotal">Tổng tiền: <span class="price"><?php echo number_format($cart['total_money'],0,'','.') ?></span></div>
							<div class="actions">
								<a class="btn-checkout" href="/account/checkout"><span>Thanh toán</span></a>
								<a class="view-cart" href="/account/carts"><span>Giỏ hàng</span></a>
							</div>
						</div>
					</div>
				</div>
				<div id="ajaxconfig_info">
					<a href="#/"></a>
					<input value="" type="hidden">
					<input id="enable_module" value="1" type="hidden">
					<input class="effect_to_cart" value="1" type="hidden">
					<input class="title_shopping_cart" value="Go to shopping cart" type="hidden">
				</div>
			</div>
		</div>
	</div>
</nav>

<!-- end nav -->
<div id="add_succes" style="display:none"></div>
			
<h1 style="display:none">Công nghệ số Accent</h1>