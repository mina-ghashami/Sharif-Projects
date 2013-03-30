
<?php if($newName == '' || $newName == ' '): ?>
	<span style="color: red"><?php echo "نام وارد شده معتبر نمی باشد، لطفا نام دیگری وارد نمایید." ?></span>
<?php endif; ?>

<?php if($newName != $preName && ($newName!= '' && $newName != ' ')): ?>
	<?php echo " نام نوع سند از ".$preName." به  ".$newName." تغییر کرد " ?>
<?php endif; ?>

<?php if($newName == $preName): ?>
	<?php echo " هم اکنون نام نوع سند ".$preName." است  " ?>
<?php endif; ?>
	