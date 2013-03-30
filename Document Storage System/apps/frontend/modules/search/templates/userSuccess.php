<?php use_helper('javascript'); ?>

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



<br /><br />

<?php echo form_tag('search/show') ?>
<?php echo submit_image_tag('/images/search_user_icon.jpg',array('title'=>'بگرد','id'=>'search_button'))?>

<b>معیار جستجو را انتخاب نمایید:</b><br /><br />
<span style = "color: gray; font-size: 13px;"> * در صورت انتخاب بیش از یک معیار ، اشتراک نتایج را ملاحظه خواهید کرد. </span>
<br>
<table id="right_div">

<tr id = "first_name" > </tr>

<tr id = "last_name"> </tr>

<tr id = "email"> </tr>

<tr id = "major"> </tr>

<tr id = "level"> </tr>

</table>
</form>
<br>
<table id="table">
	
		<tr><td id="td"><?php echo link_to_remote('نام ',array('update'=>'first_name','url'=>'search/addElem?case=first_name')) ?></td></tr>
		<tr><td id="td"><?php echo link_to_remote('نام خانوادگی',array('update'=>'last_name','url'=>'search/addElem?case=last_name')) ?></td></tr>
		<tr><td id="td"><?php echo link_to_remote('پست الکترونیکی',array('update'=>'email','url'=>'search/addElem?case=email')) ?></td></tr>
		<tr><td id="td"><?php echo link_to_remote('رشته تحصیلی',array('update'=>'major','url'=>'search/addElem?case=major')) ?></td></tr>
		<tr><td id="td"><?php echo link_to_remote('مقطع تحصیلی',array('update'=>'level','url'=>'search/addElem?case=level')) ?></td></tr>
	
	
</table>

