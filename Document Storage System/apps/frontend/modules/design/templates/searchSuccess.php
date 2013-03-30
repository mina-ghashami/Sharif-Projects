<?php use_helper('Javascript');?>

<?php echo form_remote_tag(array('update'=>'result','url'=>'design/showResult')) ?>
نام نوع سند : 
<?php echo input_tag('name') ?>
<br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
	  شامل 
	<?php echo radiobutton_tag('radio','contains',true) ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  همه لغت
	<?php echo radiobutton_tag('radio','wholeWord',false) ?>
	&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;
<?php echo submit_tag('جستجو') ?>
</form>
<br /><br />
<div id="result"></div>
<br><br><br><br><br><br><br>