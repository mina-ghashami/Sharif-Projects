<?php use_helper('javascript','I18N') ?>
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