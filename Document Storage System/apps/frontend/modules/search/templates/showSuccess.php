<?php if($visible): ?>	
<table id="search_tabs">
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
<?php endif; ?>

<?php if(!$visible): ?>
<table id="table">
<tr>
<td><?php echo link_to('مشاهده ی پروفایل','service/profile?uid='.$uid) ?>
	<?php echo link_to(image_tag('/images/user.png',array('title'=>'مشاهده پروفایل')),'service/profile?uid='.$uid)?></td>
	
<td><?php echo link_to('مدیریت سند','document/index') ?>
	<?php echo link_to(image_tag('/images/archive.png',array('title'=>'مدیریت سند')),'document/index')?></td>

<td><?php echo link_to('جستجوی کاربر','search/user') ?>
	<?php echo link_to(image_tag('/images/search_user_icon.jpg',array('title'=>'جستجوی کاربر','size'=>'30x30')),'search/user')?></td>
	
<td><?php echo link_to('جستجوی سند','document/search') ?>
	<?php echo link_to(image_tag('/images/search_page.png',array('title'=>'جستجوی سند')),'document/search')?></td>

<td><?php echo link_to('خروج ','service/logout') ?>
	<?php echo link_to(image_tag('/images/exit.png',array('title'=>'خروج','size'=>'26x26')),'service/logout')?></td>


</tr>
</table>
<?php endif; ?>


<br/><br/><br/>
<table id ="table">
	<tr>
		<th class = "th">نام</th>
		<th class = "th">نام خانوادگی</th>
		<th class = "th">پست الکترونیکی</th>
		<th class = "th">رشته تحصیلی</th>
		<th class = "th">مقطع تحصیلی</th>
	</tr>
	<?php foreach ($res as $r): ?>
		<tr>
			<td class="td_show" ><?php echo $r->getFirstName() ?></td>
			<td class="td_show"><?php echo $r->getLastName() ?></td>
			<td class="td_show"><?php echo $r->getEmail() ?></td>
			<td class="td_show"><?php echo $r->getMajor() ?></td>
			<td class="td_show"><?php echo $r->getLevel() ?></td>
		</tr>
	<?php endforeach; ?>
	<tr>
		<td></td>
		<td></td>
		<td id="footer"><center><?php echo $size."  نتیجه " ?></center></td>
		<td></td>
		<td></td>
	</tr>
</table>