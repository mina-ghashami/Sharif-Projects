<?php use_helper(   'I18N' ) ?>
<?php

	$typeExist= $sf_flash->get('typeExist');
	//$action = $sf_flash->get('action');
	
?>	
<?php if($typeExist == "no"): ?>
		<?php echo form_tag('design/deleteAssure') ?>
		لطفا نام نوع سندی که مایل به حذف آن هستید را وارد کنید
		<?php		
			echo input_tag('docTypeName'); ?>
			<br><br />
		<?php 	
			
			echo submit_tag(' حذف ', array ('confirm' => __('آیا مطمئن هستید ؟')));
			
			echo button_to(' انصراف ','design/index');
		?> 
	<br /><br />	

<span style="color:red;font-weight: bold;">	  <?php echo " نوع سند ".$docTypeName."   یافت نشد  " ?>
	  <?php if(sizeof($nearest) != 0): ?>
			 <?php echo " نزدیکترین نوع سند های موجود به   ".$docTypeName." نوع مستندات  زیر هستند:  " ?>
			 <br /><br />
			  <?php echo select_tag('nearest',$nearest); ?>
			  <br /><br />
			  
				  *  در صورتیکه مایل به حذف یکی از آنها هستید ، نام نوع سند 
				 را در فیلد بالا وارد کنید
			
	  <?php endif; ?>  
</span>	 
<?php endif; ?>


<?php if($typeExist == "yes"): ?>

		<?php echo " نوع سند ".$docTypeName." با موفقیت حذف شد. " ?>
	
<?php endif; ?>
