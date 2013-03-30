<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<table >
<tr>
	<td  > <?php echo link_to(' خانه ','service/login') ?>
			<?php echo  link_to(image_tag('/images/home.png',array('title'=>'خانه')),'service/login')?></td>
			
	<td  > <?php echo link_to(' فهرست نوع مستندات','design/all') ?>
			<?php echo link_to(image_tag('/images/notes_edit.png',array('title'=>'فهرست نوع مستندات','size'=>'26x26')),'design/all')?></td>
					
	<td  > <?php echo link_to(' طراحی نوع سند','design/new') ?>
			<?php echo link_to(image_tag('/images/note_add.png',array('title'=>'طراحی نوع سند','size'=>'26x26')),'design/new')?></td>
	<td  > <?php echo link_to(' ویرایش نوع سند','design/edit') ?>
			<?php echo link_to(image_tag('/images/note_edit.png',array('title'=>'ویرایش نوع سند')),'design/edit')?></td>
	<td  > <?php echo link_to(' حذف نوع سند','design/delete') ?>
			<?php echo link_to(image_tag('/images/note_remove.png',array('title'=>'حذف نوع سند')),'design/delete')?></td>
	<td  > <?php echo link_to(' جستجو نوع سند','design/search') ?>
			<?php echo link_to(image_tag('/images/search.png',array('title'=>'جستجو نوع سند')),'design/search')?></td>
	
</tr>
</table>

<div id="sf_admin_container">

<div id="sf_admin_header">
<?php include_partial('type/edit_header', array('type' => $type)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('type/edit_messages', array('type' => $type, 'labels' => $labels)) ?>
<?php include_partial('type/edit_form', array('type' => $type, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('type/edit_footer', array('type' => $type)) ?>
</div>

</div>
