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
      <form action="products/delete" method="post">
      	<a class="btn btn-info tip-top" data-original-title="Add new" href="products/add"><i class="icon-plus"></i></a>
      	<button class="btn btn-danger tip-top" data-original-title="Delete" type="submit"><i class="icon-trash"></i></button>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>List Products</h5>
          </div>
          <div class="widget-content">
            <div class="span4">
              <div class="control-group">
                <label class="control-label">Product Name :</label>
                <div class="controls">
                  <input type="text" class="span11" name="name" id="name" placeholder="Name / Model" />
                </div>
              </div>  
            </div>
            <div class="span4">
              <div class="control-group">
                <label class="control-label">Quantity :</label>
                <div class="controls">
                  <input type="number" class="span11" name="quantity" id="quantity" placeholder="Quantity" />
                </div>
              </div>  
            </div>  
            <div class="span4">    
              <div class="control-group">
                <label class="control-label">Status :</label>
                <div class="controls">
                  <select name="status" id="status">
                    <option value="1">Enable</option>
                    <option value="0">Disable</option>
                  </select>
                </div>
              </div>  
              <div class="control-group"> 
                <a class="btn btn-info" onclick="filter()"><i class="icon-search"></i> Filter</a>               
              </div>             
            </div>     
            <table class="table table-bordered table-striped with-check text-center">
              <thead>
                <tr>
                  <th><input onclick="$('input[name*=\'item\']').prop('checked', this.checked);" type="checkbox"></th>
                  <th>Image</th>
                  <th>Product Name</th>
                  <th>Model</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach ($products as $value) {
                  echo '<tr>';
                  echo '<td><input type="checkbox" name="item[]" value="'. $value['product_id'] .'"/></td>';
                  echo '<td><img width="80" height="80" src="'. (($value['image'])?base_url('images/'.$value['image']):base_url('images/no-images.jpg')) .'"/></td>';
                  echo '<td>'. $value['name'] .'</td>';
                  echo '<td>'. $value['model'] .'</td>';
                  echo '<td>'. (($value['discount'] != $value['price'])?'<span style="text-decoration: line-through;">'. $value['price'] .'</span><br/>'. $value['discount']:$value['price']) .'</td>';
                  echo '<td>'. $value['quantity'] .'</td>';
                  echo '<td>'. (($value['status']==1)?'Enable':'Disable') .'</td>';
                  echo '<td><a class="btn btn-info" href="products/edit/'. $value['product_id'] .'"><i class="icon-edit"></i> Edit</a></td>';
                  echo '</tr>';
                }
              ?>
              </tbody>
            </table>
            <?php echo $pagination ?>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function filter() {
    var currentLocation = '<?php echo base_url('admin/catalog/products') ?>';
    var filter_name = $("#name").val();
    var filter_quantity = $("#quantity").val();
    var filter_status = $("#status").val();

    var url = "?status=" + filter_status;

    if (filter_name != "")
      url += '&name=' + filter_name;
    if (filter_quantity != "")
      url += '&quantity=' + filter_quantity;         

    window.location.href = currentLocation + url;
  }
</script>
<!--end-main-container-part-->