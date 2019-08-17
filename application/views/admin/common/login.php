<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Lava Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../application/views/admin/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../application/views/admin/assets/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="../application/views/admin/assets/css/matrix-login.css" />
        <link href="../application/views/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox">     
             <?php
                if (isset($success))
                  echo '<div class="alert alert-success"><strong>Success!</strong> '. $success .'<button type="button" class="close" data-dismiss="alert">×</button></div>';
                if (isset($error))
                  echo '<div class="alert alert-error"><strong>Error!</strong> '. $error .'<button type="button" class="close" data-dismiss="alert">×</button></div>';    
              ?>           
            <form id="loginform" class="form-vertical" method="POST">
                <div class="control-group normal_text"> <h3><img width="178px" height="24px" src="<?php echo base_url('images/'. $setting['shop_logo']) ?>" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" placeholder="Username" name="username" id="username"/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="Password" name="password" id="password"/>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-success" value="Login" name="loginform"/></span>
                </div>
            </form>
            <form id="recoverform" action="<?php echo base_url('admin/login/recover') ?>" class="form-vertical" method="POST">
				<p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" name="email"/>
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><button class="btn btn-info" type="submit" />Recover</button></span>
                </div>
            </form>
        </div>
        
        <script src="../application/views/admin/assets/js/jquery.min.js "></script>  
        <script src="../application/views/admin/assets/js/matrix.login.js "></script> 
        <script src="../application/views/admin/assets/js/bootstrap.min.js "></script> 
    </body>

</html>
