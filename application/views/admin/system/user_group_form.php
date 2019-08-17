<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
     <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">User Groups</a> </div>
    <h1>User Groups</h1>
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
        <a class="btn btn-danger tip-top" data-original-title="Cancel" href="<?php echo ($action=="edit")?"../../user_groups":"../user_groups"; ?>"><i class="icon-reply"></i></a>
        <div class="widget-box">
          <div class="widget-content">
            <div class="control-group">
              <label class="control-label">User Group Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="name" placeholder="User Group Name" value="<?php echo ($action=="edit")?$user_group['name']:""; ?>" required=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Access Permission :</label>
              <div class="controls">
                <select multiple name="access[]">
                <?php
                foreach($permissions as $permission)
                {  
                    if ($action == "edit" && in_array($permission,$user_group['permission']['access']))
                      echo '<option value="'. $permission .'" selected="selected">'. $permission .'</option>';
                    else
                      echo '<option value="'. $permission .'">'. $permission .'</option>';
                }               
                ?>
                </select>
                <br/>
                <a onclick="$('select[name*=\'access\'] option').prop('selected', true).trigger('change');">Select All</a> / <a onclick="$('select[name*=\'access\'] option').prop('selected', false).trigger('change');">Unselect All</a>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Modify Permission :</label>
              <div class="controls">
                <select multiple name="modify[]">
                <?php
                foreach($permissions as $permission)
                {  
                    if ($action == "edit" && in_array($permission,$user_group['permission']['modify']))
                      echo '<option value="'. $permission .'" selected="selected">'. $permission .'</option>';
                    else
                      echo '<option value="'. $permission .'">'. $permission .'</option>';
                }               
                ?>
                </select>
                <br/>
                <a onclick="$('select[name*=\'modify\'] option').prop('selected', true).trigger('change');">Select All</a> / <a onclick="$('select[name*=\'modify\'] option').prop('selected', false).trigger('change');">Unselect All</a>
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