<!DOCTYPE html>
<html lang="en">
<head>
<title>Lava Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" href="<?php echo base_url('images/'.$setting['shop_icon']) ?>" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo $base_template.'css/bootstrap.min.css' ?>" />
<link rel="stylesheet" href="<?php echo $base_template.'css/bootstrap-responsive.min.css' ?>" />
<link rel="stylesheet" href="<?php echo $base_template.'css/fullcalendar.css' ?>" />
<link rel="stylesheet" href="<?php echo $base_template.'css/matrix-style.css' ?>" />
<link rel="stylesheet" href="<?php echo $base_template.'css/matrix-media.css' ?>" />
<link rel="stylesheet" href="<?php echo $base_template.'css/uniform.css' ?>" />
<link rel="stylesheet" href="<?php echo $base_template.'css/select2.css' ?>" />
<link rel="stylesheet" href="<?php echo $base_template.'css/datepicker.css' ?>" />
<link rel="stylesheet" href="<?php echo $base_template.'css/bootstrap-wysihtml5.css' ?>" />
<link rel="stylesheet" href="<?php echo $base_template.'css/jquery.fancybox.min.css' ?>" />
<link href="<?php echo $base_template.'font-awesome/css/font-awesome.css' ?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo $base_template.'css/jquery.gritter.css' ?>" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<script src="<?php echo $base_template.'js/excanvas.min.js' ?>"></script> 
<script src="<?php echo $base_template.'js/jquery.min.js' ?>"></script> 
<script src="<?php echo $base_template.'js/jquery.ui.custom.js' ?>"></script> 
<script src="<?php echo $base_template.'js/bootstrap.min.js' ?>"></script>
<script src="<?php echo $base_template.'js/bootstrap-datepicker.js' ?>"></script>
<script src="<?php echo $base_template.'js/jquery.flot.min.js' ?>"></script> 
<script src="<?php echo $base_template.'js/jquery.flot.resize.min.js' ?>"></script> 
<script src="<?php echo $base_template.'js/jquery.peity.min.js' ?>"></script> 
<script src="<?php echo $base_template.'js/fullcalendar.min.js' ?>"></script> 
<script src="<?php echo $base_template.'js/matrix.js' ?>"></script> 
<script src="<?php echo $base_template.'js/matrix.dashboard.js' ?>"></script> 
<script src="<?php echo $base_template.'js/jquery.gritter.min.js' ?>"></script> 
<script src="<?php echo $base_template.'js/matrix.interface.js' ?>"></script> 
<script src="<?php echo $base_template.'js/matrix.chat.js' ?>"></script> 
<script src="<?php echo $base_template.'js/jquery.validate.js' ?>"></script> 
<script src="<?php echo $base_template.'js/matrix.form_validation.js' ?>"></script> 
<script src="<?php echo $base_template.'js/jquery.wizard.js' ?>"></script> 
<script src="<?php echo $base_template.'js/jquery.uniform.js' ?>"></script> 
<script src="<?php echo $base_template.'js/select2.min.js' ?>"></script> 
<script src="<?php echo $base_template.'js/matrix.popover.js' ?>"></script> 
<script src="<?php echo $base_template.'js/jquery.dataTables.min.js' ?>"></script> 
<script src="<?php echo $base_template.'js/matrix.tables.js' ?>"></script> 
<script src="<?php echo $base_template.'js/wysihtml5-0.3.0.js' ?>"></script> 
<script src="<?php echo $base_template.'js/bootstrap-wysihtml5.js' ?>"></script> 
<script src="<?php echo $base_template.'js/jquery.fancybox.min.js' ?>"></script> 

<script type="text/javascript">
$(document).ready(function() {
  $('.datepicker').datepicker({format: 'dd/mm/yyyy'});
  //------------- Datepicker -------------//
  if($('#datepicker').length) {
    $("#datepicker").datepicker({
      showOtherMonths:true
    });
  }
  if($('#datepicker-inline').length) {
    $('#datepicker-inline').datepicker({
      inline: true,
      showOtherMonths:true
    });
  }  
});
</script>
</head>
<body>

<!--Header-part-->
<div id="header">
  <img width="178px" height="24px" src="<?php echo base_url('images/'. $setting['shop_logo']) ?>" alt="Logo" />
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li id="profile-messages" ><a href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome <?php echo $current_user['firstname']." ".$current_user['lastname']; ?></span></a> </li>
    <li class=""><a target="_blank" href="<?php echo base_url(); ?>"><i class="icon icon-home"></i> <span class="text">Your Store</span></a></li>
    <li class=""><a href="<?php echo base_url("admin/logout"); ?>"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->