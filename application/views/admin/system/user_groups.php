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
      <form action="user_groups/delete" method="post">
      	<a class="btn btn-info tip-top" data-original-title="Add new" href="user_groups/add"><i class="icon-plus"></i></a>
      	<button class="btn btn-danger tip-top" data-original-title="Delete" type="submit"><i class="icon-trash"></i></button>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>List User Groups</h5>
          </div>
          <div class="widget-content">
            <table class="table table-bordered table-striped with-check text-center">
              <thead>
                <tr>
                  <th><input onclick="$('input[name*=\'item\']').prop('checked', this.checked);" type="checkbox"></th>
                  <th>User Group Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach ($user_groups as $value) {
                  echo '<tr>';
                  echo '<td><input type="checkbox" name="item[]" value="'. $value['user_group_id'] .'"/></td>';
                  echo '<td>'. $value['name'] .'</td>';
                  echo '<td><a class="btn btn-info" href="user_groups/edit/'. $value['user_group_id'] .'"><i class="icon-edit"></i> Edit</a></td>';
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

<!--end-main-container-part-->