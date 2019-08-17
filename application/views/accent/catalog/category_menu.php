<?php
function getList($category, $category_id) {
  $parent = $category->getCategories(array('parent_id' => $category_id, 'status' => 1));

  if (count($category) == 0)
    return null;

  $html = '';
  foreach ($parent as $value) {
    $list = getList($category, $value['category_id']);
    $html .= ($list)?'<li class="open">':'<li>';
    $html .= '<span class="magicat-cat"><a href="'. base_url('catalog/categories/'. $value['category_id']) .'"><span>'. $value['name'] .'</span></a></span>';
    if ($list) {
      $html .= '<ul>'.$list.'</ul>';
    }
    $html .= '</li>';
  }
  return $html;
}
?>

<div class="side-nav-categories">
  <div class="block-title"> Danh mục sản phẩm </div>
  <div class="box-content box-category">
    <ul id="magicat">
    <?php
      echo getList($this->category, 0);
    ?>
    </ul>
  </div>
</div>