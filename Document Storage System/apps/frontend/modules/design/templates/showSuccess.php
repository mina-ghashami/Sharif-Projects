
<?php
	echo form_tag('design/new');
?>
نام نوع سند
<?php		
	echo input_tag('docTypeName');
?>
&nbsp;&nbsp;
<?php 	
	echo submit_tag('ارسال');
	echo button_to('انصراف','design/new');
?>
<br /><br />
<span style="color: red; font-weight: bold;">
<?php if($valid == 'no'): ?>
<?php echo "نام وارد شده معتبر نمی باشد، لطفا نام دیگری انتخاب نمایید ." ?>
<?php endif; ?>

<?php if($valid == 'yes'): ?>
<?php echo " نوع سند ".$docTypeName." وجود دارد ، لطفا نام دیگری انتخاب نمایید. " ?>
<?php endif; ?>
</span>	