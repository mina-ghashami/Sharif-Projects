<?php use_helper(  'javascript' , 'I18N' ) ?>


<?php echo form_tag('design/deleteAssure') ?>
لطفا نام نوع سندی که مایل به حذف آن هستید را وارد کنید
<?php		
	echo input_tag('docTypeName'); ?>
	<br><br />
<?php 	
	
	echo submit_tag(' حذف ', array ('confirm' => __('آیا مطمئن هستید ؟')));
	
	echo button_to(' انصراف ','design/index');
?> 

<br>
<br>
<br>
<br>

<br>
<br>
<br>
<br>

<br>
<br><br>
<br>