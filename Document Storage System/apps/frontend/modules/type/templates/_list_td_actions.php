<?php
// auto-generated by sfPropelAdmin
// date: 2009/09/11 08:51:24
?>
<td>
<ul class="sf_admin_td_actions">
  <li><?php echo link_to(image_tag('/sf/sf_admin/images/edit_icon.png', array('alt' => __('ویرایش'), 'title' => __('ویرایش'))), 'design/editForm?id='.$type->getId()) ?></li>
  <li><?php echo link_to(image_tag('/sf/sf_admin/images/delete_icon.png', array('alt' => __('حذف'), 'title' => __('حذف'))), 
				'type/delete?id='.$type->getId(), array (
  'post' => true,
  'confirm' => __('آیا مطمئن هستید ؟'),
)) ?></li>
  
</ul>
</td>