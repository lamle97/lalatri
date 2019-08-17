<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
     <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Informations</a> </div>
    <h1>Informations</h1>
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
        <a class="btn btn-danger tip-top" data-original-title="Cancel" href="<?php echo ($action=="edit")?"../../informations":"../informations"; ?>"><i class="icon-reply"></i></a>
        <div class="widget-box">
          <div class="widget-content">
            <div class="control-group">
              <label class="control-label">Title :</label>
              <div class="controls">
                <input type="text" class="span11" name="title" placeholder="Title" value="<?php echo ($action=="edit")?$information['title']:""; ?>" required=""/>
              </div>
            </div>       
            <div class="control-group">
              <label class="control-label">Content :</label>
              <div class="controls">
                <textarea class="textarea_editor span12" rows="6" name="content"><?php echo ($action=="edit")?$information['content']:""; ?></textarea>
              </div>
            </div>     
            <div class="control-group">
              <label class="control-label">Meta Tag Title :</label>
              <div class="controls">
                <input type="text" class="span11" name="meta_title" placeholder="Meta Tag Title" value="<?php echo ($action=="edit")?$information['meta_title']:""; ?>" required=""/>
              </div>
            </div>   
            <div class="control-group">
              <label class="control-label">URL :</label>
              <div class="controls">
                <input type="text" class="span11" name="keyword" placeholder="Rewrite URL" value="<?php echo ($action=="edit")?$information['keyword']:""; ?>"/>
              </div>
            </div>        
            <div class="control-group">
              <label class="control-label">Status :</label>
              <div class="controls">
                <select name="status">
                  <option value="1">Enable</option>
                  <option value="0" <?php echo ($action=="edit" && $information['status']== 0)?'selected="selected"':""; ?>>Disable</option>
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