<section class="main-container col1-layout">
    <div class="main container">
      <div class="account-login">
        <div class="page-title">
          <h2>Đăng nhập hoặc Đăng ký tài khoản</h2>
        </div>     
        <fieldset class="col2-set">
          <legend>>Đăng nhập hoặc Đăng ký tài khoản</legend>
          <div class="col-1 new-users"><strong>Khách hàng đã đăng ký</strong>
            <div class="content">
              <form method="POST">
                <p>Nếu bạn đã có một tài khoản, hãy đăng nhập.</p>
                <ul class="form-list">
                  <li>
                    <label for="email">Email <span class="required">*</span></label>
                    <br>
                    <input type="text" title="Email Address" class="input-text required-entry" id="email" value="" name="email">
                  </li>
                  <li>
                    <label for="pass">Mật khẩu <span class="required">*</span></label>
                    <br>
                    <input type="password" title="Password" id="pass" class="input-text required-entry validate-password" name="password">
                  </li>
                </ul>
                <div class="buttons-set">
                  <button id="login" name="login" value="login" type="submit" class="button login"><span>Đăng nhập</span></button>
                  hoặc
                  <button onclick="location.href='/account/register'" type="button" class="button create-account"><span>Đăng ký</span></button>
                </div>
                <div id="account-signup-divider" class="shared-divider">
                  <div class="shared-divider-label">
                    <span>hoặc Đăng nhập bằng</span>
                  </div>
                </div>
                <div id="connect-with-buttons">
                  <div class="col-sm-6">
                    <a class="btn btn-block btn-social btn-facebook" href="<?php echo $facebook_login ?>">
                      <span class="fa fa-facebook"></span> Facebook
                    </a>
                  </div>
                  <div class="col-sm-6">
                    <a class="btn btn-block btn-social btn-google" href="<?php echo $facebook_login ?>">
                      <span class="fa fa-google"></span> Google+
                    </a>
                  </div>
                </div>         
              </form>
            </div>
          </div>
          <div class="col-2 registered-users"><strong>Lấy lại mật khẩu</strong>
            <div class="content">
              <form method="POST" action="<?php echo base_url('account/login/recover') ?>">            
                <p>Bạn đã có một tài khoản nhưng bạn quên mật khẩu nên không thể đăng nhập vào hệ thống. Hãy điền Email vào ô bên dưới và nhận hỗ trợ lấy lại mật khẩu qua Email.</p>
                <ul class="form-list">
                  <li>
                    <label for="email">Email <span class="required">*</span></label>
                    <br>
                    <input type="text" title="Email Address" class="input-text required-entry" id="email" value="" name="email">
                  </li>
                </ul>
                <div class="buttons-set">
                  <button id="recover" name="recover" value="recover" type="submit" class="button login"><span>Lấy lại mật khẩu</span></button>
                </div>
            </form>
          </div>
        </fieldset>
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>
  </section>