<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
     <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Reviews</a> </div>
    <h1>Reviews</h1>
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
        <a class="btn btn-danger tip-top" data-original-title="Cancel" href="<?php echo ($action=="edit")?"../../reviews":"../reviews"; ?>"><i class="icon-reply"></i></a>
        <div class="widget-box">
          <div class="widget-content">
            <div class="control-group">
              <label class="control-label">Customer ID :</label>
              <div class="controls">
                <input type="text" class="span11" name="customer_id" placeholder="Customer ID" value="<?php echo ($action=="edit")?$review['customer_id']:""; ?>" required=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Product</label>
              <div class="controls">
                <input type="text" class="span11" name="product" value="<?php echo ($action=="edit")?$review['product']:""; ?>" placeholder="Parent"  required=""/>
                <input type="hidden" name="product_id" value="<?php echo ($action=="edit")?$review['product_id']:"0"; ?>" />
              </div>
            </div>       
            <div class="control-group">
              <label class="control-label">Text :</label>
              <div class="controls">
                <textarea class="span12" rows="6" name="text"><?php echo ($action=="edit")?$review['text']:""; ?></textarea>
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label">Rating :</label>
              <div class="controls">
                  <select name="rating">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                      if ($action == "edit" && $review['rating'] == $i)
                        echo '<option class="icon-star" value="'. $i .'" selected="selected">'. $i .'</option>';
                      else
                        echo '<option class="icon-star" value="'. $i .'">'. $i .'</option>';
                    }
                    ?>
                  </select>
              </div>
            </div>           
            <div class="control-group">
              <label class="control-label">Status :</label>
              <div class="controls">
                <select name="status">
                  <option value="1">Enable</option>
                  <option value="0" <?php echo ($action=="edit" && $review['status']== 0)?'selected="selected"':""; ?>>Disable</option>
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
<script type="text/javascript">
// Product
$('input[name=\'product\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url('admin/catalog/products/autocomplete?filter_name=') ?>' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['product_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'product\']').val(item['label']);
    $('input[name=\'product_id\']').val(item['value']);
  }
});
</script>
<!--end-main-container-part-->