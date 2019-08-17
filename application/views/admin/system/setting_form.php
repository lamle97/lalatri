<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
     <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Settings</a> </div>
    <h1>Settings</h1>
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
        <a class="btn btn-danger tip-top" data-original-title="Cancel" href="<?php echo base_url('admin') ?>"><i class="icon-reply"></i></a>
        <div class="widget-box">
          <div class="widget-title">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#general">General</a></li>
              <li><a data-toggle="tab" href="#option">Option</a></li>
              <li><a data-toggle="tab" href="#image">Image</a></li>
              <li><a data-toggle="tab" href="#mail">Mail</a></li>
	            <?php
	            	if (isset($setting_template)) {
	            		echo '<li><a data-toggle="tab" href="#setting_template">Template Settings</a></li>';
	            	}
	            ?>
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="general" class="tab-pane active">
              <div class="control-group">
                <label class="control-label">Shop Name :</label>
                <div class="controls">
                  <input type="text" class="span11" name="settings[shop_name]" placeholder="Shop Name" value="<?php echo (isset($settings['shop_name']))?$settings['shop_name']:""; ?>" required=""/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Shop Description :</label>
                <div class="controls">
                  <textarea class="span11" rows="6" name="settings[shop_description]"><?php echo (isset($settings['shop_description']))?$settings['shop_description']:""; ?></textarea>
                </div>
              </div>          
              <div class="control-group">
                <label class="control-label">Shop Keywords :</label>
                <div class="controls">
                  <input type="text" class="span11" name="settings[shop_keywords]" placeholder="Shop Keywords" value="<?php echo (isset($settings['shop_keywords']))?$settings['shop_keywords']:""; ?>"/>
                </div>
              </div>              
              <div class="control-group">
                <label class="control-label">Shop Address :</label>
                <div class="controls">
                  <input type="text" class="span11" name="settings[shop_address]" placeholder="Shop Address" value="<?php echo (isset($settings['shop_address']))?$settings['shop_address']:""; ?>" required=""/>
                </div>
              </div>   
              <div class="control-group">
                <label class="control-label">Shop Email :</label>
                <div class="controls">
                  <input type="text" class="span11" name="settings[shop_email]" placeholder="Shop Email" value="<?php echo (isset($settings['shop_email']))?$settings['shop_email']:""; ?>" required=""/>
                </div>
              </div> 
              <div class="control-group">
                <label class="control-label">Shop Telephone :</label>
                <div class="controls">
                  <input type="text" class="span11" name="settings[shop_telephone]" placeholder="Shop Telephone" value="<?php echo (isset($settings['shop_telephone']))?$settings['shop_telephone']:""; ?>" required=""/>
                </div>
              </div>  
              <div class="control-group">
                <label class="control-label">Geocode :</label>
                <div class="controls">
                  <input type="text" class="span11" name="settings[shop_geocode]" placeholder="Geocode" value="<?php echo (isset($settings['shop_geocode']))?$settings['shop_geocode']:""; ?>"/>
                </div>
              </div>                            
              <div class="control-group">
                <label class="control-label">Template :</label>
                <div class="controls">
                  <input type="text" class="span11" name="settings[shop_template]" placeholder="Shop Template" value="<?php echo (isset($settings['shop_template']))?$settings['shop_template']:""; ?>" required=""/>
                </div>
              </div>                       
            </div>
            <div id="option" class="tab-pane">
              <fieldset>
                <legend>Products</legend>
                <div class="control-group">
                  <label class="control-label">Default Items Per Page :</label>
                  <div class="controls">
                    <input type="text" class="span11" name="settings[admin_item_page]" placeholder="Default Items Per Page" value="<?php echo (isset($settings['admin_item_page']))?$settings['admin_item_page']:""; ?>" required=""/>
                  </div>
                </div>   
              <div class="control-group">
                <label class="control-label">Menu :</label>
                <div class="controls">
                  <table class="table table-bordered text-center" id="menu">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Link</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $row_menu = 0;
                      if (isset($settings['menu'])) {
                        foreach ($settings['menu'] as $value) {
                    ?>
                      <tr id="menu-row<?php echo $row_menu ?>">
                        <td><input type="text" class="span11" name="settings[menu][<?php echo $row_menu ?>][name]" id="menu-name<?php echo $row_menu ?>" placeholder="Menu Name" value="<?php echo $settings['menu'][$row_menu]['name']; ?>" required="" /></td>
                        <td><input type="text" class="span11" name="settings[menu][<?php echo $row_menu ?>][link]" placeholder="Link" value="<?php echo $settings['menu'][$row_menu]['link']; ?>" required=""/></td>
                        <td><button type="button" onclick="$('#menu-row<?php echo $row_menu ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="icon-trash"></i></button></td>
                      </tr>  
                    <?php    
                          $row_menu++;
                        }
                      }
                    ?>              
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="2"></td>
                        <td><button type="button" onclick="addMenu();" data-toggle="tooltip" title="Add Menu" class="btn btn-primary"><i class="icon-plus"></i></button></td>
                      </tr>
                    </tfoot>
                  </table>        
                </div>
              </div>                               
              </fieldset>
            </div>
            <div id="image" class="tab-pane">
              <div class="control-group">
                <label class="control-label">Logo :</label>
                <div class="controls">
                  <input type="text" class="span2" name="settings[shop_logo]" id="logo" placeholder="Shop Logo" value="<?php echo (isset($settings['shop_logo']))?$settings['shop_logo']:""; ?>" required=""/>
                  <a href="<?php echo base_url('filemanager/dialog.php?type=1&field_id=logo&relative_url=1&akey=matrix') ?>" class="btn iframe-btn" type="button">Select</a>
                </div>
              </div>     
              <div class="control-group">
                <label class="control-label">Icon :</label>
                <div class="controls">
                  <input type="text" class="span2" name="settings[shop_icon]" id="icon" placeholder="Shop Icon" value="<?php echo (isset($settings['shop_icon']))?$settings['shop_icon']:""; ?>" required=""/>
                  <a href="<?php echo base_url('filemanager/dialog.php?type=1&field_id=icon&relative_url=1&akey=matrix') ?>" class="btn iframe-btn" type="button">Select</a>
                </div>
              </div>   
              <div class="control-group">
                <label class="control-label">Slider :</label>
                <div class="controls">
                  <table class="table table-bordered text-center" id="slider">
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>Link</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $row_slider = 0;
                      if (isset($settings['slider'])) {
                        foreach ($settings['slider'] as $value) {
                    ?>
                      <tr id="slider-row<?php echo $row_slider ?>">
                        <td>
                          <input type="text" class="span10" name="settings[slider][<?php echo $row_slider ?>][image]" id="slider-image<?php echo $row_slider ?>" placeholder="Slider Image" value="<?php echo $settings['slider'][$row_slider]['image']; ?>" required="" />
                          <a href="<?php echo base_url('filemanager/dialog.php?type=1&field_id=slider-image'. $row_slider .'&relative_url=1&akey=matrix') ?>" class="btn iframe-btn" type="button">Select</a>
                        </td>
                        <td><input type="text" class="span11" name="settings[slider][<?php echo $row_slider ?>][link]" placeholder="Link" value="<?php echo $settings['slider'][$row_slider]['link']; ?>" required=""/></td>
                        <td><button type="button" onclick="$('#slider-row<?php echo $row_slider ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="icon-trash"></i></button></td>
                      </tr>  
                    <?php    
                          $row_slider++;
                        }
                      }
                    ?>              
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="2"></td>
                        <td><button type="button" onclick="addSlider();" data-toggle="tooltip" title="Add Slider Image" class="btn btn-primary"><i class="icon-plus"></i></button></td>
                      </tr>
                    </tfoot>
                  </table>        
                </div>
              </div>                                      
            </div>  
            <div id="mail" class="tab-pane">
            <fieldset>
              <legend>General</legend>
              <div class="control-group">
                <label class="control-label">Mail Protocol :</label>
                <div class="controls">
                  <input type="text" class="span11" name="settings[shop_mail_config][protocol]" placeholder="smtp" value="<?php echo (isset($settings['shop_mail_config']['protocol']))?$settings['shop_mail_config']['protocol']:"smtp"; ?>"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">SMTP Hostname :</label>
                <div class="controls">
                  <input type="text" class="span11" name="settings[shop_mail_config][smtp_host]" placeholder="SMTP Hostname" value="<?php echo (isset($settings['shop_mail_config']['smtp_host']))?$settings['shop_mail_config']['smtp_host']:""; ?>"/>
                </div>
              </div>   
              <div class="control-group">
                <label class="control-label">SMTP Username :</label>
                <div class="controls">
                  <input type="text" class="span11" name="settings[shop_mail_config][smtp_user]" placeholder="SMTP Username" value="<?php echo (isset($settings['shop_mail_config']['smtp_user']))?$settings['shop_mail_config']['smtp_user']:""; ?>"/>
                </div>
              </div>   
              <div class="control-group">
                <label class="control-label">SMTP Password :</label>
                <div class="controls">
                  <input type="password" class="span11" name="settings[shop_mail_config][smtp_pass]" placeholder="SMTP Password" value="<?php echo (isset($settings['shop_mail_config']['smtp_pass']))?$settings['shop_mail_config']['smtp_pass']:""; ?>"/>
                </div>
              </div>  
              <div class="control-group">
                <label class="control-label">SMTP Port :</label>
                <div class="controls">
                  <input type="hidden" name="settings[shop_mail_config][mailtype]" value="html">
                  <input type="text" class="span11" name="settings[shop_mail_config][smtp_port]" placeholder="SMTP Port" value="<?php echo (isset($settings['shop_mail_config']['smtp_port']))?$settings['shop_mail_config']['smtp_port']:"25"; ?>"/>
                </div>
              </div> 
            </fieldset>      
            <fieldset>
              <legend>Mail Recover</legend>
              <div class="control-group">
                <label class="control-label">Subject :</label>
                <div class="controls">
                  <input type="text" class="span11" name="settings[shop_mail_recover][subject]" placeholder="Subject" value="<?php echo (isset($settings['shop_mail_recover']['subject']))?$settings['shop_mail_recover']['subject']:""; ?>"/>
                </div>
              </div> 
              <div class="control-group">
                <label class="control-label">Content :</label>
                <div class="controls">
                  <textarea class="textarea_editor span12" rows="6" name="settings[shop_mail_recover][content]"><?php echo (isset($settings['shop_mail_recover']['content']))?$settings['shop_mail_recover']['content']:""; ?></textarea>
                </div>
              </div>                            
            </fieldset>    
            <fieldset>
              <legend>Mail Order</legend>
              <div class="control-group">
                <label class="control-label">Subject :</label>
                <div class="controls">
                  <input type="text" class="span11" name="settings[shop_mail_order][subject]" placeholder="Subject" value="<?php echo (isset($settings['shop_mail_order']['subject']))?$settings['shop_mail_order']['subject']:""; ?>"/>
                </div>
              </div> 
              <div class="control-group">
                <label class="control-label">Content :</label>
                <div class="controls">
                  <textarea class="textarea_editor span12" rows="6" name="settings[shop_mail_order][content]"><?php echo (isset($settings['shop_mail_order']['content']))?$settings['shop_mail_order']['content']:""; ?></textarea>
                </div>
              </div>                            
            </fieldset>                                       
            </div>  
            <?php
            	if (isset($setting_template)) {
            		echo '<div id="setting_template" class="tab-pane">'. $setting_template .'</div>';
            	}
            ?>        
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
var slider_row = <?php echo $row_slider ?>;
var menu_row = <?php echo $row_menu ?>;
// Option
function addSlider() {
  html  = '<tr id="slider-row' + slider_row + '">'; 
    html += '  <td><input type="text" class="span10" name="settings[slider][' + slider_row + '][image]" id="slider-image' + slider_row + '" placeholder="Slider Image" value="" />';
  html += '      <a href="<?php echo base_url('filemanager/dialog.php?type=1&field_id=slider-image') ?>' + slider_row + '&relative_url=1&akey=matrix" class="btn iframe-btn" type="button">Select</a>';
    html += '  </td>';
  html += '  <td><input type="text" class="span11" name="settings[slider][' + slider_row + '][link]" placeholder="Link" value="" required=""/></td>'
  html += '  <td><button type="button" onclick="$(\'#slider-row' + slider_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="icon-trash"></i></button></td>';
  html += '</tr>';  
  
  $('#slider tbody').append(html);
  
  slider_row++; 

  $('.iframe-btn').each(function() {
    $(this).fancybox({ 
      'width'   : 900,
      'height'  : 600,
      'type'    : 'iframe',
      'autoScale'     : false
    })    
  });
}

function addMenu() {
  html  = '<tr id="menu-row' + menu_row + '">'; 
  html += '  <td><input type="text" class="span11" name="settings[menu][' + menu_row + '][name]" id="menu-name' + menu_row + '" placeholder="Menu Name" value="" /></td>';
  html += '  <td><input type="text" class="span11" name="settings[menu][' + menu_row + '][link]" placeholder="Link" value="" required=""/></td>'
  html += '  <td><button type="button" onclick="$(\'#menu-row' + menu_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="icon-trash"></i></button></td>';
  html += '</tr>';  
  
  $('#menu tbody').append(html);
  
  menu_row++;
}
</script>
<!--end-main-container-part-->