<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
     <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Payments</a> </div>
    <h1>Payments</h1>
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
        <a class="btn btn-danger tip-top" data-original-title="Cancel" href="<?php echo ($action=="edit")?"../../payments":"../payments"; ?>"><i class="icon-reply"></i></a>
        <div class="widget-box">
          <div class="widget-content">
            <div class="control-group">
              <label class="control-label">Payment Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="name" placeholder="Payment Name" value="<?php echo ($action=="edit")?$payment['name']:""; ?>" required=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Method :</label>
              <div class="controls">
                <textarea class="span11" rows="6" name="method" placeholder="Method"><?php echo ($action=="edit")?$payment['method']:""; ?></textarea>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Status :</label>
              <div class="controls">
                <select name="status" >
                  <option value="1">Enable</option>
                  <option value="0" <?php echo ($action=="edit" && $payment['status']== 0)?'selected="selected"':""; ?>>Disable</option>
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