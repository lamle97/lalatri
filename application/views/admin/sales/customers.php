<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
     <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Customers</a> </div>
    <h1>Customers</h1>
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
      <form action="customers/delete" method="post">
      	<a class="btn btn-info tip-top" data-original-title="Add new" href="customers/add"><i class="icon-plus"></i></a>
      	<button class="btn btn-danger tip-top" data-original-title="Delete" type="submit"><i class="icon-trash"></i></button>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>List Customers</h5>
          </div>
          <div class="widget-content">
            <div class="widget-box">
              <div class="widget-content">
                <div class="control-group span4">
                  <label class="control-label">Customer Name :</label>
                  <div class="controls">
                    <input type="text" class="span11" name="name" id="name" placeholder="Name" />
                  </div>
                </div>  
                <div class="control-group span4">
                  <label class="control-label">Email :</label>
                  <div class="controls">
                    <input type="text" class="span11" name="email" id="email" placeholder="Email" />
                  </div>
                </div>      
                <div class="control-group span4">
                  <label class="control-label">Status :</label>
                  <div class="controls">
                    <select name="status" id="status">
                      <option value="1">Enable</option>
                      <option value="0">Disable</option>
                    </select>
                  </div>
                </div>   
                <a class="btn btn-info" onclick="filter()"><i class="icon-search"></i> Filter</a>
              </div>
            </div>          
            <table class="table table-bordered table-striped with-check text-center">
              <thead>
                <tr>
                  <th><input onclick="$('input[name*=\'item\']').prop('checked', this.checked);" type="checkbox"></th>
                  <th>Customer Name</th>
                  <th>Email</th>
                  <th>Telephone</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach ($customers as $value) {
                  echo '<tr>';
                  echo '<td><input type="checkbox" name="item[]" value="'. $value['customer_id'] .'"/></td>';
                  echo '<td>'. $value['firstname'].' '.$value['lastname'] .'</td>';
                  echo '<td>'. $value['email'] .'</td>';
                  echo '<td>'. $value['telephone'] .'</td>';
                  echo '<td>'. (($value['status']==1)?'Enable':'Disable') .'</td>';
                  echo '<td><a class="btn btn-info" href="customers/edit/'. $value['customer_id'] .'"><i class="icon-edit"></i> Edit</a></td>';
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
    var currentLocation = '<?php echo base_url('admin/sales/customers') ?>';
    var filter_name = document.getElementById("name").value;
    var filter_email = document.getElementById("email").value;
    var filter_status = (document.getElementById("status").selectedIndex+1)%2;

    var url = "?status=" + filter_status;

    if (filter_name != "")
      url += '&name=' + filter_name;
    if (filter_email != "")
      url += '&email=' + filter_email;         

    window.location.href = currentLocation + url;
  }
</script>
<!--end-main-container-part-->