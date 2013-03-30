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
<span style="	margin-top: 0px;	height: 100px;	width: 900px;"> 
<?php echo image_tag('banner.jpg',array('id'=>'banner')) ?>
</span>
<div id="content_user">
<table id="user_tabs" >
<tr>
<td><?php echo link_to('خانه','service/login') ?>
	<?php echo link_to(image_tag('/images/home.png',array('title'=>'خانه')),'service/login')?></td>
	
<td><?php echo link_to('فهرست کاربران','user/list') ?>
	<?php echo link_to(image_tag('/images/users.png',array('title'=>'فهرست کاربران')),'user/list')?></td>

<td><?php echo link_to('افزودن کاربر','user/create') ?>
	<?php echo link_to(image_tag('/images/user_add.png',array('title'=>'افزودن کاربر')),'user/create')?></td>

<td><?php echo link_to('جستجوی کاربر','search/user') ?>
	<?php echo link_to(image_tag('/images/search_user_icon.jpg',array('title'=>'جستجوی کاربر','size'=>'30x30')),'search/user')?></td>

</tr>
</table>
<?php echo $sf_data->getRaw('sf_content') ?>
</div>
</center>
</body>
</html>


