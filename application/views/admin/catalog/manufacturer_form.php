<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
     <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manufacturers</a> </div>
    <h1>Manufacturers</h1>
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
        <a class="btn btn-danger tip-top" data-original-title="Cancel" href="<?php echo ($action=="edit")?"../../manufacturers":"../manufacturers"; ?>"><i class="icon-reply"></i></a>
        <div class="widget-box">
          <div class="control-group">
            <label class="control-label">Manufacturer Name :</label>
            <div class="controls">
              <input type="text" class="span11" name="name" placeholder="Manufacturer Name" value="<?php echo ($action=="edit")?$manufacturer['name']:""; ?>" required=""/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Image</label>
            <div class="controls">
              <input type="text" class="span2" id="image" name="image" placeholder="Image" value="<?php echo ($action=="edit")?$manufacturer['image']:""; ?>"  required="" />
              <a href="<?php echo base_url('filemanager/dialog.php?type=1&field_id=image&relative_url=1&akey=matrix') ?>" class="btn iframe-btn" type="button">Select</a>
            </div>
          </div>          
          <div class="control-group">
            <label class="control-label">URL :</label>
            <div class="controls">
              <input type="text" class="span11" name="keyword" placeholder="Rewrite URL" value="<?php echo ($action=="edit")?$manufacturer['keyword']:""; ?>"/>
            </div>
          </div> 
          <div class="control-group">
            <label class="control-label">Sort Order :</label>
            <div class="controls">
              <input type="text" class="span11" name="sort" value="<?php echo ($action=="edit")?$manufacturer['sort_order']:"0"; ?>" required=""/>
            </div>
          </div>                            
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

<!--end-main-container-part-->