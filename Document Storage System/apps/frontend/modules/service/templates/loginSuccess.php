<table id="service_tabs">
<tr>
<td><?php echo link_to('مشاهده ی پروفایل','service/profile?uid='.$uid) ?>
	<?php echo link_to(image_tag('/images/user.png',array('title'=>'مشاهده پروفایل')),'service/profile?uid='.$uid)?></td>
	
<td><?php echo link_to('مدیریت سند','document/index') ?>
	<?php echo link_to(image_tag('/images/archive.png',array('title'=>'مدیریت سند')),'document/index')?></td>



<?php if($sf_user->hasCredential('admin')): ?>
<td><?php echo link_to('مدیریت کاربر','user/index') ?>
	<?php echo link_to(image_tag('/images/users.png',array('title'=>'مدیریت کاربر')),'user/index')?></td>
<?php  endif; ?>

<?php if($sf_user->hasCredential('designer')): ?>
<td><?php echo link_to('مدیریت نوع سند','design/index') ?>
	<?php echo link_to(image_tag('/images/paint.ico',array('title'=>'مدیریت نوع سند','size'=>'23x24')),'design/index')?></td>
<?php  endif; ?>

<td><?php echo link_to('جستجوی کاربر','search/user') ?>
	<?php echo link_to(image_tag('/images/search.png',array('title'=>'جستجوی کاربر')),'search/user')?></td>
	
<td><?php echo link_to('جستجوی سند','document/search') ?>
	<?php echo link_to(image_tag('/images/search_page.png',array('title'=>'جستجوی سند')),'document/search')?></td>

<td><?php echo link_to('خروج ','service/logout') ?>
	<?php echo link_to(image_tag('/images/exit.png',array('title'=>'خروج','size'=>'26x26')),'service/logout')?></td>


</tr>
</table>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>