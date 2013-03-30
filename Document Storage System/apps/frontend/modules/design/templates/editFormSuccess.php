<?php use_helper('javascript','I18N') ?>
<b>
<?php if($sf_flash->has('docTypeName')): ?>
<?php echo " نوع سند جاری:  ".$sf_flash->get('docTypeName') ?>
<?php endif; ?>
<?php if(! $sf_flash->has('docTypeName')): ?>
<?php echo " نوع سند جاری:  ".$docTypeName ?>
<?php endif; ?>
</b>
<br /><br />
<table style="float: right;">
<tr>
<td style="border: 2px solid gray;padding: 4px;">
<?php echo form_remote_tag(array(
	'url'=>'design/save?typeId='.$typeId,
	'update'=>'body')) 
?>
ویرایش نام
<br><br>
نام جدید
<?php echo input_tag('newName','') ?>
<br><br>
<span style="direction: ltr; float: left;">
<?php 	echo submit_tag(' ثبت  '); ?>
</span>
</td>
</tr>
</form>
<tr>
<td style="border: 2px solid gray;padding: 4px; ">
<table id = "delAtr">
<tr>
	<td style="padding: 7px;">ویرایش صفات</td>
	<td ><?php echo button_to('افزودن صفت ','design/addField?typeId='.$typeId) ?></td>
</tr>
<?php $c = 1 ; foreach ($res as $atr): ?>
<tr >
	<td style="padding: 3px;"><?php  echo $c." . "; echo link_to($atr->getName(),'design/editAtr?id='.$atr->getId());  $c++;?></td>
	<td style="padding: 3px;"><center><?php  echo link_to_remote(image_tag('/images/delete.png',array('title'=>'حذف')),array('update'=>'delAtr','url'=>'design/delAtr?atrid='.$atr->getId(),'confirm' => __('آیا مطمئن هستید ؟'))); ?></center></td>
</tr>
<?php endforeach; ?>
</table>
</td>
</tr>
</table>
<div id="body" style="padding-right: 200px;margin: 50px;"></div>

