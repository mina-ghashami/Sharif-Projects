<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>
<center>
<?php echo image_tag('banner.jpg',array('id'=>'banner')) ?>
<br />
<div id="page_design">
<table id="design_tabs">
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
<br /><br />
<?php echo $sf_data->getRaw('sf_content') ?>
</div>
</center>
</body>
</html>
