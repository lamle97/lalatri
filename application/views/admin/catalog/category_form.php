<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
     <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Categories</a> </div>
    <h1>Categories</h1>
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
        <a class="btn btn-danger tip-top" data-original-title="Cancel" href="<?php echo ($action=="edit")?"../../categories":"../categories"; ?>"><i class="icon-reply"></i></a>
        <div class="widget-box">
          <div class="widget-title">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#general">General</a></li>
              <li><a data-toggle="tab" href="#data">Data</a></li>
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="general" class="tab-pane active">
              <div class="control-group">
                <label class="control-label">Category Name :</label>
                <div class="controls">
                  <input type="text" class="span11" name="name" placeholder="Category Name" value="<?php echo ($action=="edit")?$category['name']:""; ?>" required=""/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description :</label>
                <div class="controls">
                  <textarea class="textarea_editor span12" rows="6" name="description"><?php echo ($action=="edit")?$category['description']:""; ?></textarea>
                </div>
              </div>              
              <div class="control-group">
                <label class="control-label">Meta Tag Title :</label>
                <div class="controls">
                  <input type="text" class="span11" name="meta_title" placeholder="Meta Tag Title" value="<?php echo ($action=="edit")?$category['meta_title']:""; ?>" required="" />
                </div>
              </div>             
            </div>
            <div id="data" class="tab-pane">
              <div class="control-group">
                <label class="control-label">Parent</label>
                <div class="controls">
                  <input type="text" class="span11" name="parent" placeholder="Parent" value="<?php echo ($action=="edit")?$category['parent']:""; ?>" />
                  <input type="hidden" name="parent_id" value="<?php echo ($action=="edit")?$category['parent_id']:"0"; ?>" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Manufacturers :</label>
                <div class="controls">
                  <input type="text" class="span11" name="manufacturers" value="" placeholder="Manufacturer Name"/>
                  <div id="category-manufacturer" class="well span11" style="margin-left:0px; height: 150px; overflow: auto;">
                    <?php
                      if ($action == "edit") {
                        foreach ($manufacturers as $value) {
                          echo '<div id="category-manufacturer'. $value['manufacturer_id'] .'"><i class="icon-trash"></i> '. $value['name'] .'<input type="hidden" name="manufacturer_id[]" value="'. $value['manufacturer_id'] .'" /></div>';
                        }
                      }
                    ?>
                  </div>
                </div>
              </div>               
              <div class="control-group">
                <label class="control-label">Icon :</label>
                <div class="controls">
                  <input type="text" class="span11" name="image" placeholder="fa fa-check-circle" value="<?php echo ($action=="edit")?$category['image']:""; ?>" />
                </div>
              </div>               
              <div class="control-group">
                <label class="control-label">URL :</label>
                <div class="controls">
                  <input type="text" class="span11" name="keyword" placeholder="Rewrite URL" value="<?php echo ($action=="edit")?$category['keyword']:""; ?>"/>
                </div>
              </div> 
              <div class="control-group">
                <label class="control-label">Sort Order :</label>
                <div class="controls">
                  <input type="text" class="span11" name="sort" value="<?php echo ($action=="edit")?$category['sort_order']:"0"; ?>" required=""/>
                </div>
              </div> 
              <div class="control-group">
                <label class="control-label">Status :</label>
                <div class="controls">
                  <select name="status" >
                    <option value="1">Enable</option>
                    <option value="0" <?php echo ($action=="edit" && $category['status']== 0)?'selected="selected"':""; ?>>Disable</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
// Parent Category
$('input[name=\'parent\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url('admin/catalog/categories/autocomplete?filter_name=') ?>' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        json.unshift({
          manufacturer_id: 0,
          name: ' --- None --- '
        });

        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['category_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'parent\']').val(item['label']);
    $('input[name=\'parent_id\']').val(item['value']);
  }
});

$('input[name=\'manufacturers\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url('admin/catalog/manufacturers/autocomplete?filter_name=') ?>' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['manufacturer_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'manufacturers\']').val('');

    $('#category-manufacturer' + item['value']).remove();

    $('#category-manufacturer').append('<div id="category-manufacturer' + item['value'] + '"><i class="icon-trash"></i> ' + item['label'] + '<input type="hidden" name="manufacturer_id[]" value="' + item['value'] + '" /></div>');
  }
});

$('#category-manufacturer').delegate('.icon-trash', 'click', function() {
  $(this).parent().remove();
});
</script>
<!--end-main-container-part-->