<?php use_helper('Javascript'); ?>

<table id="service_tabs">
<tr>
<td><?php echo link_to('مشاهده ی پروفایل','service/profile?uid='.$user->getId()) ?>
	<?php echo link_to(image_tag('/images/user.png',array('title'=>'مشاهده پروفایل')),'service/profile?uid='.$user->getId())?></td>
	
<td><?php echo link_to('مدیریت سند','document/index') ?>
	<?php echo link_to(image_tag('/images/archive.png',array('title'=>'مدیریت سند')),'document/index')?></td>

<?php if($sf_user->hasCredential('admin')): ?>
<td><?php echo link_to('مدیریت کاربر','user/index') ?>
	<?php echo link_to(image_tag('/images/users.png',array('title'=>'مدیریت کاربر')),'user/index')?></td>
<?php  endif; ?>

<?php if($sf_user->hasCredential('designer')): ?>
<td><?php echo link_to('طراحی نوع سند','design/index') ?>
	<?php echo link_to(image_tag('/images/paint.ico',array('title'=>'طراحی نوع سند','size'=>'23x24')),'design/index')?></td>
<?php  endif; ?>

<td><?php echo link_to('جستجوی سند','document/search') ?>
	<?php echo link_to(image_tag('/images/search_page.png',array('title'=>'جستجوی سند')),'document/search')?></td>

<td><?php echo link_to('خروج ','service/logout') ?>
	<?php echo link_to(image_tag('/images/exit.png',array('title'=>'خروج','size'=>'26x26')),'service/logout')?></td>

</tr>
</table>

<table id="profile_table">

<tr>
<td><?php echo label_for('FirstName','نام') ?></td><td>
	<div id="FirstName"> 
	<?php if($user -> getFirstName() == '' || $user -> getFirstName() == ' '): ?>&nbsp;<?php endif; ?>
	<?php echo $user -> getFirstName() ?> 
	</div>
	<?php if ($canEdit): ?>
	<?php echo input_in_place_editor_tag('FirstName','service/editProfile?attribute=FirstName',array('save_text'=>'ذخیره','cancel_text'=>'لغو')) ?>
	<?php endif; ?>
	</td></tr>

<tr>
	<td>
	<?php echo label_for('LastName','نام خانوادگی') ?>
	</td><td>
	<div id="LastName"> 
	<?php if( $user -> getLastName() == '' || $user -> getLastName() == ' '): ?>&nbsp;<?php endif; ?>
	<?php echo $user -> getLastName() ?> 
	</div>
	<?php if ($canEdit): ?>
	<?php echo input_in_place_editor_tag('LastName','service/editProfile?attribute=LastName',array('save_text'=>'ذخیره','cancel_text'=>'لغو')) ?>
	<?php endif; ?>
	</td></tr>

<tr>
	<td>
	<?php echo label_for('StudentId','شماره دانشجویی') ?>
	</td><td>
	<div id="StudentId"> 
	<?php if($user -> getStudentId() == '' || $user -> getStudentId() == ' '): ?>&nbsp;<?php endif; ?> 
	<?php echo $user -> getStudentId() ?>
	</div>
	
	<?php if ($canEdit): ?>
	<?php echo input_in_place_editor_tag('StudentId','service/editProfile?attribute=StudentId',array('save_text'=>'ذخیره','cancel_text'=>'لغو')) ?>
	<?php endif; ?>
	</td></tr>

<tr>
	<td>
	<?php echo label_for('email','پست الکترونیکی') ?>
	</td><td>
	<div id="email"> <?php echo $user -> getEmail() ?> </div>
	<?php if ($canEdit): ?>
	<?php echo input_in_place_editor_tag('email','service/editProfile?attribute=Email',array('save_text'=>'ذخیره','cancel_text'=>'لغو')) ?>
	<?php endif; ?>
	</td></tr>


<tr>
	<td>
	<?php echo label_for('major','رشته تحصیلی') ?>
	</td><td>
	<div id="major"> 
	<?php if ($user -> getMajor() == '' || $user -> getMajor() == ' '): ?>&nbsp;<?php endif; ?>	
	<?php echo $user -> getMajor() ?>
	</div>
	<?php if ($canEdit): ?>
	<?php echo input_in_place_editor_tag('major','service/editProfile?attribute=Major',array('save_text'=>'ذخیره','cancel_text'=>'لغو')) ?>
	<?php endif; ?>
	</td></tr>


<tr>
	<td>
	<?php echo label_for('level','مقطع تحصیلی') ?>
	</td><td>
	<div id="level"> 
	<?php if($user -> getLevel() == '' || $user -> getLevel() == ' '): ?>&nbsp;<?php endif; ?> 
	<?php echo $user -> getLevel()  ?>
	</div>
	<?php if ($canEdit): ?>
	<?php echo input_in_place_editor_tag('level','service/editProfile?attribute=Level',array('save_text'=>'ذخیره','cancel_text'=>'لغو')) ?>
	<?php endif; ?>
	</td></tr>

<tr>
	<td>
	<?php echo label_for('phone','شماره تلفن') ?>
	</td><td>
	<div id="phone"> 
	<?php if($user -> getPhone() == '' || $user -> getPhone() == ' '): ?>&nbsp;<?php endif; ?> 
	<?php echo $user -> getPhone()  ?>
	</div>
	<?php if ($canEdit): ?>
	<?php echo input_in_place_editor_tag('phone','service/editProfile?attribute=Phone',array('save_text'=>'ذخیره','cancel_text'=>'لغو')) ?>
	<?php endif; ?>
	</td></tr>

<tr>
	<td>
	<?php echo label_for('note','یادداشت') ?>
	</td><td>
	<div id="note"> 
	<?php if ($user -> getNote() == '' || $user -> getNote() == ' ' || $user -> getNote() == "\n"): ?>&nbsp;<?php endif; ?>	 
	<?php echo $user -> getNote()  ?> 
	</div>
	<?php if ($canEdit): ?>
	<?php echo input_in_place_editor_tag('note','service/editProfile?attribute=Note',array('cols'=>30,'rows'=>10,'save_text'=>'ذخیره','cancel_text'=>'لغو')) ?>
	<?php endif; ?>
	</td></tr>

<?php if($canEdit): ?>
<tr>
	<td>
	<?php echo label_for('password','رمز عبور') ?>
	</td><td>
	<div id="password"><?php echo $user->getPassword() ?></div>
	<?php  if($canEdit): ?>
	<?php echo input_in_place_editor_tag('password','service/editProfile?attribute=Password',array('save_text'=>'ذخیره','cancel_text'=>'لغو')) ?>
	<?php endif; ?>
	</td></tr> 
	<?php endif; ?>

</table>

<?php  if($canEdit): ?>
<span style="color: red; background-color: white; padding:3px;">* در صورت ویرایش رمز عبور باید بیشتر از 5 کاراکتر و کمتر از 256 کاراکتر وارد نمایید.</span>
<?php endif; ?>
<br><br>