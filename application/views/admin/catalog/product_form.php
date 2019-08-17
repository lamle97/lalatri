<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
     <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Products</a> </div>
    <h1>Products</h1>
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
        <a class="btn btn-danger tip-top" data-original-title="Cancel" href="<?php echo ($action=="edit")?"../../products":"../products"; ?>"><i class="icon-reply"></i></a>
        <div class="widget-box">
          <div class="widget-title">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#general">General</a></li>
              <li><a data-toggle="tab" href="#data">Data</a></li>
              <li><a data-toggle="tab" href="#images">Images</a></li>
              <li><a data-toggle="tab" href="#options">Options</a></li>
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="general" class="tab-pane active">
              <div class="control-group">
                <label class="control-label">Product Name :</label>
                <div class="controls">
                  <input type="text" class="span11" name="name" placeholder="Product Name" value="<?php echo ($action=="edit")?$product['name']:""; ?>" required=""/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description Short:</label>
                <div class="controls">
                  <textarea class="textarea_editor span12" rows="6" name="description_short"><?php echo ($action=="edit")?$product['description_short']:""; ?></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description Technical:</label>
                <div class="controls">
                  <textarea class="textarea_editor span12" rows="6" name="description_technical"><?php echo ($action=="edit")?$product['description_technical']:""; ?></textarea>
                </div>
              </div>                              
              <div class="control-group">
                <label class="control-label">Description :</label>
                <div class="controls">
                  <textarea class="textarea_editor span12" rows="6" name="description"><?php echo ($action=="edit")?$product['description']:""; ?></textarea>
                </div>
              </div>                       
              <div class="control-group">
                <label class="control-label">Meta Tag Title :</label>
                <div class="controls">
                  <input type="text" class="span11" name="meta_title" placeholder="Meta Tag Title" value="<?php echo ($action=="edit")?$product['meta_title']:""; ?>" required="" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Tag :</label>
                <div class="controls">
                  <input type="text" class="span11" name="tag" placeholder="Tag" value="<?php echo ($action=="edit")?$product['tag']:""; ?>" />
                </div>
              </div>                            
            </div>
            <div id="data" class="tab-pane">
              <div class="control-group">
                <label class="control-label">Manufacturer :</label>
                <div class="controls">
                  <input type="text" class="span11" name="manufacturer" placeholder="Manufacturer" value="<?php echo ($action=="edit")?$product['manufacturer']:""; ?>" />
                  <input type="hidden" name="manufacturer_id" value="<?php echo ($action=="edit")?$product['manufacturer_id']:"0"; ?>" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Category :</label>
                <div class="controls">
                  <input type="text" class="span11" name="category" placeholder="Category" value="<?php echo ($action=="edit")?$product['category']:""; ?>" required="" />
                  <input type="hidden" name="category_id" value="<?php echo ($action=="edit")?$product['category_id']:"0"; ?>" />
                </div>
              </div>                               
              <div class="control-group">
                <label class="control-label">URL :</label>
                <div class="controls">
                  <input type="text" class="span11" name="keyword" placeholder="Rewrite URL" value="<?php echo ($action=="edit")?$product['keyword']:""; ?>"/>
                </div>
              </div> 
              <div class="control-group">
                <label class="control-label">Sort Order :</label>
                <div class="controls">
                  <input type="text" class="span11" name="sort" value="<?php echo ($action=="edit")?(int)$product['product_sort']:"0"; ?>" required=""/>
                </div>
              </div> 
              <div class="control-group">
                <label class="control-label">Status :</label>
                <div class="controls">
                  <select name="status">
                    <option value="1">Enable</option>
                    <option value="0" <?php echo ($action=="edit" && $product['status']== 0)?'selected="selected"':""; ?>>Disable</option>
                  </select>
                </div>
              </div>
            </div>
            <div id="images" class="tab-pane">
              <table class="table table-bordered text-center" id="images">
                <thead>
                  <tr>
                    <th>Images</th>  
                    <th>Sort Order</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="images">
                <?php
                  $row_image = 0;
                  if ($action == "edit") {
                    foreach ($product['images'] as $value) {
                ?>
                  <tr id="images-row<?php echo $row_image ?>">
                    <td><input type="text" class="span5" id="<?php echo $row_image ?>" name="images[<?php echo $row_image ?>][image]" value="<?php echo $value['image'] ?>" placeholder="Image" required=""/> <a href="<?php echo base_url() ?>filemanager/dialog.php?type=1&field_id=<?php echo $row_image ?>&relative_url=1&akey=matrix" class="btn iframe-btn" type="button">Select</a></td>    
                    <td><input type="text" class="span11" name="images[<?php echo $row_image ?>][sort_order]" value="<?php echo $value['sort_order'] ?>" required=""/></td>
                    <td><button type="button" onclick="$('#images-row<?php echo $row_image ?>').remove()" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="icon-trash"></i></button></td>
                  </tr>
                <?php    
                      $row_image++;  
                    }
                  }
                ?>              
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2"></td>
                    <td><button type="button" onclick="addImageValue();" data-toggle="tooltip" title="Add Image Value" class="btn btn-primary"><i class="icon-plus"></i></button></td>
                  </tr>
                </tfoot>
              </table>              
            </div>            
            <div id="options" class="tab-pane">
              <table class="table table-bordered text-center" id="options">
                <thead>
                  <tr>
                    <th>Option Name</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Quantity</th>      
                    <th>Sort Order</th>               
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="options">
                <?php
                  $row_option = 0;
                  if ($action == "edit") {
                    foreach ($product['options'] as $value) {
                ?>
                  <tr id="options-row<?php echo $row_option ?>">
                    <td>
                      <input type="hidden" name="options[<?php echo $row_option ?>][product_option_id]" value="<?php echo $value['product_option_id'] ?>" />
                      <input type="text" class="span11" name="options[<?php echo $row_option ?>][option_name]" value="<?php echo $value['option_name'] ?>" placeholder="Option Value Name" required=""/>
                    </td>
                    <td><input type="text" class="span11" name="options[<?php echo $row_option ?>][model]" value="<?php echo $value['model'] ?>" placeholder="Model" required=""/></td>    
                    <td><input type="text" class="span11" name="options[<?php echo $row_option ?>][price]" value="<?php echo $value['price'] ?>" placeholder="Price" required=""/></td>
                    <td><input type="text" class="span11" name="options[<?php echo $row_option ?>][discount]" value="<?php echo $value['discount'] ?>" placeholder="Discount" /></td>                   
                    <td><input type="text" class="span11" name="options[<?php echo $row_option ?>][quantity]" value="<?php echo $value['quantity'] ?>" placeholder="Quantity" required=""/></td>  
                    <td><input type="text" class="span11" name="options[<?php echo $row_option ?>][sort_order]" value="<?php echo $value['sort_order'] ?>" required=""/></td>  
                    <td><select name="options[<?php echo $row_option ?>][status]"><option value="1">Enable</option><option value="0" <?php echo ($value['status']==0)?'selected="selected"':""; ?>>Disable</option></select></td>
                    <td><button type="button" onclick="$('#options-row<?php echo $row_option ?>').remove()" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="icon-trash"></i></button></td>
                  </tr>
                <?php    
                      $row_option++;  
                    }
                  }
                ?>              
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="7"></td>
                    <td><button type="button" onclick="addOptionValue();" data-toggle="tooltip" title="Add Option Value" class="btn btn-primary"><i class="icon-plus"></i></button></td>
                  </tr>
                </tfoot>
              </table>              
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
// Manufacturer
$('input[name=\'manufacturer\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url('admin/catalog/manufacturers/autocomplete?filter_name=') ?>' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        json.unshift({
          manufacturer_id: 0,
          name: ' --- None --- '
        });

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
    $('input[name=\'manufacturer\']').val(item['label']);
    $('input[name=\'manufacturer_id\']').val(item['value']);
  }
});

// Category
$('input[name=\'category\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url('admin/catalog/categories/autocomplete?filter_name=') ?>' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
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
    $('input[name=\'category\']').val(item['label']);
    $('input[name=\'category_id\']').val(item['value']);
  }
});

//Option
var options_row = <?php echo $row_option ?>;
var images_row = <?php echo $row_image ?>;
// Option
function addOptionValue() {
  html  = '<tr id="options-row' + options_row + '">'; 
    html += '  <td><input type="hidden" name="option_value[' + options_row + '][option_value_id]" value="" />';
  html += '      <input type="text" class="span11" name="options[' + options_row + '][option_name]" value="" placeholder="Option Name" required=""/>';
    html += '  </td>';
  html += '  <td><input type="text" class="span11" name="options[' + options_row + '][model]" placeholder="Model" required=""/></td>';      
  html += '  <td><input type="text" class="span11" name="options[' + options_row + '][price]" value="" placeholder="Price" required=""/></td>';
  html += '  <td><input type="text" class="span11" name="options[' + options_row + '][discount]" value="" placeholder="Discount" /></td>'; 
  html += '  <td><input type="text" class="span11" name="options[' + options_row + '][quantity]" value="1" placeholder="Quantity" required=""/></td>';   
  html += '  <td><input type="text" class="span11" name="options[' + options_row + '][sort_order]" value="0" placeholder="Sort Order" required=""/></td>';   
  html += '  <td><select name="options[' + options_row + '][status]"><option value="1">Enable</option><option value="0">Disable</option></select></td>';    
  html += '  <td><button type="button" onclick="$(\'#options-row' + options_row + '\').remove()" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="icon-trash"></i></button></td>';
  html += '</tr>';

  $('table#options tbody#options').append(html);
  $('select').select2();
  
  options_row++;
}
function addImageValue() {
  html  = '<tr id="images-row' + images_row + '">';  
  html += '  <td><input type="text" class="span5" id="image-' + images_row + '" name="images[' + images_row + '][image]" value="" placeholder="Image" required=""/> <a href="<?php echo base_url() ?>filemanager/dialog.php?type=1&field_id=image-' + images_row + '&relative_url=1&akey=matrix" class="btn iframe-btn" type="button">Select</a></td>';    
  html += '  <td><input type="text" class="span11" name="images[' + images_row + '][sort_order]" value="0" required=""/></td>';
  html += '  <td><button type="button" onclick="$(\'#images-row' + images_row + '\').remove()" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="icon-trash"></i></button></td>';
  html += '</tr>';

  $('table#images tbody#images').append(html);
  $('select').select2();
  
  images_row++;
}

$("table#images").on("focusin", function(){
    $('.iframe-btn').each(function() {
      $(this).fancybox({ 
        'width'   : 900,
        'height'  : 600,
        'type'    : 'iframe',
        'autoScale'     : false
      })    
    });
});

</script>
<!--end-main-container-part-->