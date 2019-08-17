<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7 lte9 lte8 lte7" lang="en-US"><![endif]-->
<!--[if IE 8]><html class="ie ie8 lte9 lte8" lang="en-US">	<![endif]-->
<!--[if IE 9]><html class="ie ie9 lte9" lang="en-US"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="noIE" lang="en-US">
<!--<![endif]-->

<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
<meta content="<?php echo $setting['shop_description'] ?>" name="description">
<link href="<?php echo $base_template.'images/'.$setting['shop_icon'] ?>" rel="shortcut icon">
<title><?php echo (isset($title))?$title." | ".$setting['shop_name']:$setting['shop_name'] ?></title>

<!-- Reset CSS -->
<link href="<?php echo $base_template.'css/normalize.css' ?>" rel="stylesheet" type="text/css"/>

<!-- Bootstrap core CSS -->
<link href="<?php echo $base_template.'css/bootstrap.css' ?>" rel="stylesheet">

<!-- Bootstrap Social CSS -->
<link href="<?php echo $base_template.'css/bootstrap-social.css' ?>" rel="stylesheet">

<!-- Iview Slider CSS -->
<link href="<?php echo $base_template.'css/iview.css' ?>" rel="stylesheet">

<!--	Responsive 3D Menu	-->
<link href="<?php echo $base_template.'css/menu3d.css' ?>" rel="stylesheet"/>

<!-- Animations -->
<link href="<?php echo $base_template.'css/animate.css' ?>" rel="stylesheet" type="text/css"/>

<!-- Custom styles for this template -->
<link href="<?php echo $base_template.'css/custom.css' ?>" rel="stylesheet" type="text/css" />

<!-- Style Switcher -->
<link href="<?php echo $base_template.'css/style-switch.css' ?>" rel="stylesheet" type="text/css"/>

<!-- Color -->
<link href="<?php echo $base_template.'css/skin/color.css' ?>" id="colorstyle" rel="stylesheet">

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]> <script src="<?php echo $base_template.'js/html5shiv.js' ?>"></script> <script src="<?php echo $base_template.'js/respond.min.js' ?>"></script> <![endif]-->

<!-- Bootstrap core JavaScript -->
<script src="<?php echo $base_template.'js/jquery-1.10.2.min.js' ?>"></script>
<script src="<?php echo $base_template.'js/bootstrap.min.js' ?>"></script>
<script src="<?php echo $base_template.'js/bootstrap-select.js' ?>"></script>

<!-- Custom Scripts -->
<script src="<?php echo $base_template.'js/scripts.js' ?>"></script>

<!-- MegaMenu -->
<script src="<?php echo $base_template.'js/menu3d.js' ?>" type="text/javascript"></script>

<!-- iView Slider -->
<script src="<?php echo $base_template.'js/raphael-min.js' ?>" type="text/javascript"></script>
<script src="<?php echo $base_template.'js/jquery.easing.js' ?>" type="text/javascript"></script>
<script src="<?php echo $base_template.'js/iview.js' ?>" type="text/javascript"></script>
<script src="<?php echo $base_template.'js/retina-1.1.0.min.js' ?>" type="text/javascript"></script>

<!-- Elevate Zoom -->
<script src="<?php echo $base_template.'js/jquery.elevatezoom.js' ?>" type="text/javascript"></script>

<!--[if IE 8]>
    <script type="text/javascript" src="<?php echo $base_template.'js/selectivizr.js' ?>"></script>
    <![endif]-->

</head>

<body>
<!-- Header -->
<header> 
  <!-- Top Heading Bar -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="topheadrow">
          <ul class="nav nav-pills pull-right">
            <li> <a href="<?php echo base_url('account/carts') ?>"> <i class="fa fa-shopping-cart fa-fw"></i> <span class="hidden-xs">My Cart</span></a> </li>
            <li> <a href="<?php echo base_url('account/wishlists') ?>"> <i class="fa fa-heart fa-fw"></i> <span class="hidden-xs">Wishlist</span></a> </li>
            <?php if ($customer) { ?>
            <li class="dropdown"> <a class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" href="#a"> <i class="fa fa-user fa-fw"></i> <span class="hidden-xs"> Customer</span></a>
              <ul class="accounts dropdown-menu" style="display:none;">
                  <li><a href="/account">Dashboard</a></li>
                  <li><a href="/account/logout">Logout</a></li>
              </ul>
            </li>
            <?php } else {?>            
            <li> <a href="<?php echo base_url('account/login') ?>"> <i class="fa fa-user fa-fw"></i> <span class="hidden-xs">Login</span></a> </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- end: Top Heading Bar -->
  
  <div class="f-space20"></div>
  <!-- Logo and Search -->
  <div class="container">
    <div class="row clearfix">
      <div class="col-lg-3 col-xs-12">
        <div class="logo"> <a href="<?php echo base_url() ?>" title="Flatro Shop"><!-- <img alt="Flatro - Responsive Metro Inspired Flat ECommerce theme" src="images/logo2.png"> -->
          <div class="logoimage"><i class="fa fa-shopping-cart fa-fw"></i></div>
          <div class="logotext"><img alt="<?php echo $setting['shop_name'] ?>" src="<?php echo base_url('images/'.$setting['shop_logo']) ?>"></div>
          </a> </div>
      </div>
      <!-- end: logo -->
      <div class="visible-xs f-space20"></div>
      <!-- search -->
      <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12 pull-right">
        <div class="searchbar">
          <form action="/catalog/search" method="get">
            <ul class="pull-left">
              <li class="input-prepend dropdown" data-select="true"> <a class="add-on dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" href="#a"> <span class="dropdown-display">All
                Categories</span> <i class="fa fa-sort fa-fw"></i> </a> 
                <!-- this hidden field is used to contain the selected option from the dropdown -->
                <input class="dropdown-field" type="hidden" value="All Categories"/>
              </li>
            </ul>
            <div class="searchbox pull-left">
              <input class="searchinput" name="name" id="search" placeholder="Search..." type="search">
              <button class="fa fa-search fa-fw" type="submit"></button>
            </div>
          </form>
        </div>
      </div>
      <!-- end: search --> 
      
    </div>
  </div>
  <!-- end: Logo and Search -->
  <div class="f-space20"></div>
 <!-- Menu -->
  <div class="container">
    <div class="row clearfix">
      <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 menu-col">
        <div class="menu-heading menuHeadingdropdown"> <span> <i class="fa fa-bars"></i> Categories <i class="fa fa-angle-down"></i></span> </div>
        <!-- Mega Menu -->
        <div class="menu3dmega vertical menuMegasub" id="menuMega">
          <ul>
          <?php
            $echo = "";
            foreach ($category->getCategories(array("parent_id" => 0)) as $value) {
              $echo .= '<li><a href="'. base_url('catalog/categories/'.$value['category_id']) .'" > <i class="'. (($value['image'])?$value['image']:'fa fa-check-circle') .'"></i> <span>'. $value['name'] .'</span></a>';
              if (count($chilren = $category->getCategories(array("parent_id" => $value['category_id']))) > 0) {
                $echo .= '<div class="dropdown-menu flyout-menu"><ul>';
                foreach ($chilren as $chil) {
                  $echo .= '<li><a href="'. base_url('catalog/categories/'.$chil['category_id']) .'"><span>'. $chil['name'] .'</span></a></li>';
                }
                $echo .= '</ul></div>';
              }
              $echo .= '</li>';
            }
            echo $echo;
          ?>
          </ul>
        </div>
        <!-- end: Mega Menu --> 
      </div>
      <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 menu-col-2"> 
        <!-- Navigation Buttons/Quick Cart for Tablets and Desktop Only -->
        <div class="menu-links hidden-xs">
          <ul class="nav nav-pills nav-justified">
            <li> <a href="<?php echo base_url() ?>"> <i class="fa fa-home fa-fw"></i> <span class="hidden-sm">Home</span></a> </li>
            <li> <a href="#"> <i class="fa fa-info-circle fa-fw"></i> <span class="hidden-sm">About</span></a> </li>
            <li> <a href="#"> <i class="fa fa-bullhorn fa-fw"></i> <span class="hidden-sm">Blog</span></a> </li>
            <li> <a href="#"> <i class="fa fa-pencil-square-o fa-fw"></i> <span class="hidden-sm ">Contact</span></a> </li>
            <li class="dropdown"> <a href="<?php echo base_url('account/carts') ?>"> <i class="fa fa-shopping-cart fa-fw"></i> <span class="hidden-sm"> My Cart (<?php echo $cart['total_items'] ?>)</span></a> 
              <!-- Quick Cart -->
              <div class="dropdown-menu quick-cart">
                <div class="qc-row qc-row-heading"> <span class="qc-col-qty">QTY.</span> <span class="qc-col-name">Items: <?php echo $cart['total_items'] ?></span> <span class="qc-col-price"><?php echo $cart['total_money'] ?></span> </div>
                <?php
                foreach ($cart['products'] as $product) {
                	echo '<div class="qc-row qc-row-item"> <span class="qc-col-qty">'. $product['quantity'] .'</span> <span class="qc-col-name"><a href="' .base_url('catalog/products/'.$product['product_id']).'">'. $product['name'] .'</a></span> <span class="qc-col-price">'. ($product['discount']?$product['discount']:$product['price']) .'</span> <span class="qc-col-remove"><a href="'.base_url('account/carts/delete/'.$product['product_option_id']).'"> <i class="fa fa-times fa-fw"></i> </a></span> </div>';
                }
                ?>
                <div class="qc-row-bottom"><a class="btn qc-btn-viewcart" href="<?php echo base_url('account/carts') ?>">view
                  cart</a><a class="btn qc-btn-checkout" href="<?php echo base_url('account/checkout') ?>">check
                  out</a></div>
              </div>
              <!-- end: Quick Cart --> 
            </li>
          </ul>
        </div>
        <!-- end: Navigation Buttons/Quick Cart Tablets and large screens Only --> 
        
      </div>
    </div>
  </div>
</header>
<!-- end: Header -->

<div class="row clearfix"></div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="breadcrumb"> <a href="<?php echo base_url() ?>"> <i class="fa fa-home fa-fw"></i> Home </a></div>
      
      <!-- Quick Help for tablets and large screens -->
      <div class="quick-message hidden-xs">
        <div class="quick-box">
          <div class="quick-slide"> <span class="title">Help</span>
            <div class="quickbox slide" id="quickbox">
              <div class="carousel-inner">
                <div class="item active"> <a href="#"> <i class="fa fa-envelope fa-fw"></i> <?php echo $setting['shop_email'] ?></a> </div>
                <div class="item"> <a href="#"><?php echo $setting['shop_address'] ?></a> </div>
                <div class="item"> <a href="#"> <i class="fa fa-phone fa-fw"></i> <?php echo $setting['shop_telephone'] ?></a> </div>
              </div>
            </div>
            <a class="left carousel-control" data-slide="prev" href="#quickbox"> <i class="fa fa-angle-left fa-fw"></i> </a> <a class="right carousel-control" data-slide="next" href="#quickbox"> <i class="fa fa-angle-right fa-fw"></i> </a> </div>
        </div>
      </div>
      <!-- end: Quick Help --> 
      </div>
    </div>
  </div>
</header>
<div class="row clearfix f-space10"></div>
<!-- end: Header --> 