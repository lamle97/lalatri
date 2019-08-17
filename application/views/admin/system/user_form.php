<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
     <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Users</a> </div>
    <h1>Users</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <?php
    if (isset($success))
      echo '<div class="alert alert-success"><strong>Success!</strong> '. $success .'<button type="button" class="close" data-dismiss="alert">×</button></div>';
    if (isset($error))
      echo '<div class="alert alert-error"><strong>Error!</strong> '. $error .'<button type="button" class="close" data-dismiss="alert">×</button></div>';    
    ?> 
    <div class="row-fluid">
      <div class="span12">
      <form method="post" class="form-horizontal">
        <button type="submit" class="btn btn-info tip-top" data-original-title="Save"><i class="icon-save"></i></button>
        <a class="btn btn-danger tip-top" data-original-title="Cancel" href="<?php echo ($action=="edit")?"../../users":"../users"; ?>"><i class="icon-reply"></i></a>
        <div class="widget-box">
          <div class="widget-content">
            <div class="control-group">
              <label class="control-label">Username :</label>
              <div class="controls">
                <input type="text" class="span11" name="username" placeholder="Username" value="<?php echo ($action=="edit")?$user['username']:""; ?>" required=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">User Group</label>
              <div class="controls">
                <select name="user_group">
                  <?php
                  foreach ($user_groups as $user_group) {
                    if ($action == "edit" && $user['user_group_id'] == $user_group['user_group_id'])
                      echo '<option value="'. $user_group['user_group_id'] .'" selected="selected">'. $user_group['name'] .'</option>';
                    else
                      echo '<option value="'. $user_group['user_group_id'] .'">'. $user_group['name'] .'</option>';
                  }
                  ?>
                </select>
              </div>
            </div>            
            <div class="control-group">
              <label class="control-label">First Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="firstname" placeholder="First Name" value="<?php echo ($action=="edit")?$user['firstname']:""; ?>" required=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Last Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="lastname" placeholder="Last Name" value="<?php echo ($action=="edit")?$user['lastname']:""; ?>" required=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Email :</label>
              <div class="controls">
                <input type="text" class="span11" name="email" placeholder="Email" value="<?php echo ($action=="edit")?$user['email']:""; ?>" required=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Password :</label>
              <div class="controls">
                <input type="password" class="span11" name="password" placeholder="Password" <?php echo ($action=="edit")?"":'required=""'; ?>/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Status :</label>
              <div class="controls">
                <select name="status" >
                  <option value="1">Enable</option>
                  <option value="0" <?php echo ($action=="edit" && $user['status']== 0)?'selected="selected"':""; ?>>Disable</option>
                </select>
              </div>
            </div>            
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

<!--end-main-container-part-->