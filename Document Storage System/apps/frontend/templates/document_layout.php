<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<link rel="stylesheet" type="text/css" media="screen" href="/repository/web/css/service.css" />
<link rel="shortcut icon" href="/favicon.ico" />
</head>

<body dir="rtl">
	<center>
	<?php echo image_tag('banner.jpg',array('id'=>'banner')) ?>
	<div id="page_document">
	<table id="document_tabs" >
		
		<tr>
			<td><?php echo link_to('خانه','service/login') ?>
				<?php echo link_to(image_tag('/images/home.png',array('title'=>'خانه')),'service/login') ?></td>
			<td><?php echo link_to('نمایش سند','document/selectUser') ?>
				<?php echo link_to(image_tag('/images/full_page.png',array('title'=>' نمایش سند ')),'document/selectUser') ?></td>
			<td><?php echo link_to('ایجاد سند','document/create') ?>
			    <?php echo link_to(image_tag('/images/add_page.png',array('title'=>'ایجاد سند')),'document/create') ?></td> 
			<td><?php echo link_to('جستجوی سند','document/search') ?>
				 <?php echo link_to(image_tag('/images/search_page.png',array('title'=>'جستجوی سند')),'document/search') ?></td>
			
		</tr>
		
	</table>
	<br/><br/>
	
	<div id="document_content">
	<?php echo $sf_data->getRaw('sf_content') ?>
	</div>
	</div>
	</center>
	
</body>

</html>
