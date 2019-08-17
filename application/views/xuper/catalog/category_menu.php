<?php
function getList($category, $category_id, $now) {
  $parent = $category->getCategories(array('parent_id' => $category_id, 'status' => 1));

  if (count($parent) == 0)
    return null;

  $html = '';
  foreach ($parent as $value) {
    $html .= ($now == $value['category_id'])?'<li class="current">':'<li>';
    $html .= '<span><a href="'. base_url('categories/'. $value['category_id'].'-'.$value['keyword']) .'"><span>'. $value['name'] .'</span></a></span>';
    $html .= '</li>';
    $html .= getList($category, $value['category_id'], $now);
  }
  return $html;
}
?>
<div id="xuper_theme_helpers_widget_categories-3" class="ps-widget--sidebar ps-widget--category">
  <div class="ps-widget__header"><h3> Danh mục sản phẩm </h3></div>     
  <ul class="ps-list--checked">
    <?php
      echo getList($this->category, 0, $category_id_now);
    ?>
  </ul>
</div>