<?php use_helper('javascript') ?>
<table>
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
<tr>
<td style="border: 2px solid gray;padding: 4px; ">
<table>
<tr>
<td style="padding: 7px;">
<?php //echo label_for('label','ویرایش صفات') ?>
ویرایش صفات
</td>
<td>
<?php echo button_to('افزودن صفت ','design/addField?typeId='.$typeId) ?>
</td>
</tr>
<?php $c = 1 ; foreach ($res as $atr): ?>
<tr>
<td style="padding: 3px;"><?php  echo $c." . "; echo link_to($atr->getName(),'design/editAtr?id='.$atr->getId());  $c++;?></td>
<td style="padding: 3px;"><center><?php  echo link_to(image_tag('/images/delete.png',array('title'=>'حذف')),'design/delAttr'); ?></center></td>
</tr>
<?php endforeach; ?>
</table>
</td>
</tr>
</table>