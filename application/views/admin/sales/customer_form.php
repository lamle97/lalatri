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
      <form method="post" class="form-horizontal">
        <button type="submit" class="btn btn-info tip-top" data-original-title="Save"><i class="icon-save"></i></button>
        <a class="btn btn-danger tip-top" data-original-title="Cancel" href="<?php echo ($action=="edit")?"../../customers":"../customers"; ?>"><i class="icon-reply"></i></a>
        <div class="widget-box">
          <div class="widget-content">
            <div class="control-group">
              <label class="control-label">Email :</label>
              <div class="controls">
                <input type="text" class="span11" name="email" placeholder="Email" value="<?php echo ($action=="edit")?$customer['email']:""; ?>" required=""/>
              </div>
            </div>           
            <div class="control-group">
              <label class="control-label">First Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="firstname" placeholder="First Name" value="<?php echo ($action=="edit")?$customer['firstname']:""; ?>" required=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Last Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="lastname" placeholder="Last Name" value="<?php echo ($action=="edit")?$customer['lastname']:""; ?>" required=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Telephone :</label>
              <div class="controls">
                <input type="text" class="span11" name="telephone" placeholder="Telephone" value="<?php echo ($action=="edit")?$customer['telephone']:""; ?>" required=""/>
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label">Fax :</label>
              <div class="controls">
                <input type="text" class="span11" name="fax" placeholder="Fax" value="<?php echo ($action=="edit")?$customer['fax']:""; ?>"/>
              </div>
            </div>                        
            <div class="control-group">
              <label class="control-label">Address 1:</label>
              <div class="controls">
                <input type="text" class="span11" name="address_1" placeholder="Address 1" value="<?php echo ($action=="edit")?$customer['address_1']:""; ?>" required=""/>
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label">Address 2:</label>
              <div class="controls">
                <input type="text" class="span11" name="address_2" placeholder="Address 2" value="<?php echo ($action=="edit")?$customer['address_2']:""; ?>"/>
              </div>
            </div>   
            <div class="control-group">
              <label class="control-label">City:</label>
              <div class="controls">
                <select id="city_id" name="city_id" class="form-control">
                <option value=''>--- Choose City ---</option> 
                <?php
                  foreach ($citys as $city) {
                    if ($city['city_id'] == (($action=="edit")?$customer['city_id']:""))
                      echo '<option value="'. $city['city_id'] .'" selected="selected">'. $city['name'] .'</option>';
                    else
                      echo '<option value="'. $city['city_id'] .'">'. $city['name'] .'</option>';
                  }
                ?>
                </select>                
              </div>
            </div>   
            <div class="control-group">
              <label class="control-label">Zone:</label>
              <div class="controls">
                <select id="zone_id" name="zone_id" class="form-control"></select>
              </div>
            </div>                                  
            <div class="control-group">
              <label class="control-label">Password :</label>
              <div class="controls">
                <input type="password" class="span11" name="password" placeholder="Password" <?php echo ($action=="edit")?"":'required=""'; ?>/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Newsletter :</label>
              <div class="controls">
                <select name="newsletter" >
                  <option value="1">Enable</option>
                  <option value="0" <?php echo ($action=="edit" && $customer['newsletter']== 0)?'selected="selected"':""; ?>>Disable</option>
                </select>
              </div>
            </div>             
            <div class="control-group">
              <label class="control-label">Status :</label>
              <div class="controls">
                <select name="status" >
                  <option value="1">Enable</option>
                  <option value="0" <?php echo ($action=="edit" && $customer['status']== 0)?'selected="selected"':""; ?>>Disable</option>
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
<script type="text/javascript"><!--
function zone() {
  $.ajax({
    url: '<?php echo base_url('common/Zones/autocomplete?filter_city_id=') ?>' + $( "select#city_id option:checked" ).val(),
    dataType: 'json',
    beforeSend: function() {
      $('select[name=\'city_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('.fa-spin').remove();
    },
    success: function(json) {
      html = '';

      for (var i = 0; i < json.length; i++) {
        if (json[i]['zone_id'] == <?php echo (($action=="edit")?$customer['zone_id']:"0") ?>)
          html += '<option value="' + json[i]['zone_id'] + '" selected="selected">' + json[i]['name'] +'</option>';
        else
          html += '<option value="' + json[i]['zone_id'] + '">' + json[i]['name'] +'</option>';
      }

      $('select[name=\'zone_id\']').html(html);
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  }); 
}
$( "#city_id" ).change(function() {
  zone();
});
zone();
//--></script>
<!--end-main-container-part-->