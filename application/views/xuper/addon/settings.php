<div class="control-group">
<label class="control-label">Small Slider :</label>
<div class="controls">
  <table class="table table-bordered text-center" id="small-slider">
    <thead>
      <tr>
        <th>Image</th>
        <th>Link</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $row_small_slider = 0;
      if (isset($settings['xuper_small_slider'])) {
        foreach ($settings['xuper_small_slider'] as $value) {
    ?>
      <tr id="small-slider-row<?php echo $row_small_slider ?>">
        <td>
          <input type="text" class="span10" name="settings[xuper_small_slider][<?php echo $row_small_slider ?>][image]" id="small-slider-image<?php echo $row_small_slider ?>" placeholder="Slider Image" value="<?php echo $settings['xuper_small_slider'][$row_small_slider]['image']; ?>" required="" />
          <a href="<?php echo base_url('filemanager/dialog.php?type=1&field_id=small-slider-image'. $row_small_sliderr .'&relative_url=1&akey=matrix') ?>" class="btn iframe-btn" type="button">Select</a>
        </td>
        <td><input type="text" class="span11" name="settings[xuper_small_slider][<?php echo $row_small_slider ?>][link]" placeholder="Link" value="<?php echo $settings['xuper_small_slider'][$row_small_slider]['link']; ?>" required=""/></td>
        <td><button type="button" onclick="$('#small-slider-row<?php echo $row_slider ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="icon-trash"></i></button></td>
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
        <td><button type="button" onclick="addSmallSlider();" data-toggle="tooltip" title="Add Slider Image" class="btn btn-primary"><i class="icon-plus"></i></button></td>
      </tr>
    </tfoot>
  </table>        
</div>
</div>  

<script type="text/javascript">
var small_slider_row = <?php echo $row_small_slider ?>;
// Option
function addSmallSlider() {
  html  = '<tr id="small-slider-row' + small_slider_row + '">'; 
    html += '  <td><input type="text" class="span10" name="settings[xuper_small_slider][' + small_slider_row + '][image]" id="small-slider-image' + small_slider_row + '" placeholder="Slider Image" value="" />';
  html += '      <a href="<?php echo base_url('filemanager/dialog.php?type=1&field_id=small-slider-image') ?>' + small_slider_row + '&relative_url=1&akey=matrix" class="btn iframe-btn" type="button">Select</a>';
    html += '  </td>';
  html += '  <td><input type="text" class="span11" name="settings[xuper_small_slider][' + small_slider_row + '][link]" placeholder="Link" value="" required=""/></td>'
  html += '  <td><button type="button" onclick="$(\'#small-slider-row' + small_slider_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="icon-trash"></i></button></td>';
  html += '</tr>';  
  
  $('#small-slider tbody').append(html);
  
  small_slider_row++; 

  $('.iframe-btn').each(function() {
    $(this).fancybox({ 
      'width'   : 900,
      'height'  : 600,
      'type'    : 'iframe',
      'autoScale'     : false
    })    
  });  
}
</script>