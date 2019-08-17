<div class="row clearfix f-space10"></div>
<!-- Page title -->
<div class="container">
  <!-- row -->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12"> 
      <?php if (isset($error)) { ?>
      <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i><?php echo $error;?><button type="button" class="close" data-dismiss="alert">×</button>
      </div>      
      <?php } ?>
      <div class="box-content">
        <div class="panel-group"> 
                  
          <!-- Login -->
          <div class="col-md-6 col-xs-12">
            <div class="box-content login-box">
              <h4>Customers with a registered account.</h4>
              <form method="post">
                <input type="text" name="email" value="" placeholder="Email" class="input4">
                <input type="password" name="password" value="" placeholder="Password" class="input4">
                <button class="btn medium color2 pull-right" type="submit" name="login" value="login">Sign in</button>
                <div id="account-signup-divider" class="shared-divider">
                  <div class="shared-divider-label">
                    <span>Or Login With</span>
                  </div>
                </div>
                <div id="connect-with-buttons" style="height: 50px">
                  <div class="col-sm-6">
                    <a class="btn medium color1" href="<?php echo $facebook_login ?>">
                      <span class="fa fa-facebook"></span> Facebook
                    </a>
                  </div>
                  <div class="col-sm-6">
                    <a class="btn medium color2" href="<?php echo $google_login ?>">
                      <span class="fa fa-google"></span> Google+
                    </a>
                  </div>
                </div>                 
              </form>
            </div>
          </div>
          <!-- end: Login --> 
          <!-- Register -->
          
          <div class="col-md-6 col-xs-12">
            <div class="box-content register-box">
              <h4>Not registered yet?</h4>
              <p>Register with us for future convenience:</p>
              <ul>
                <li><i class="fa fa-check fa-fw"></i> Fast and easy check out.</li>
                <li><i class="fa fa-check fa-fw"></i> Easy access to your order history and status.</li>
                <li><i class="fa fa-check fa-fw"></i> Earn Shopping points while you shop using your account. </li>
                <li><i class="fa fa-check fa-fw"></i> Save card Information and Addresses. Never fill a form again.</li>
              </ul>
              <form>
                <a href="<?php echo base_url('account/register') ?>" class="btn medium color2 pull-right">Register</a>
              </form>
            </div>
          </div>
          
          <!-- end: Register --> 
                  
        </div>
      </div>
    </div>
  </div>
</div>