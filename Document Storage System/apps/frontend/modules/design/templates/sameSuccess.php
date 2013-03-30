<?php use_helper('javascript') ?>
<?php use_helper('validation') ?>
<?php $source = $sf_user->getAttribute('source'); ?>

<b><?php echo "نوع سند جاری: ".$docTypeName ?></b>

<table>
<tr>
<td>
<?php echo link_to_remote(image_tag('/images/textarea.jpg',array('title'=>'textarea')),array('update'=>'body','url'=>'design/textarea?typeId='.$sf_request->getParameter('typeId')))?>

</td>
<td>
<?php echo link_to_remote(image_tag('/images/input.jpg',array('title'=>'input')),array('update'=>'body','url'=>'design/input?typeId='.$sf_request->getParameter('typeId')))?>
</td>
<td>
<?php echo link_to_remote(image_tag('/images/checkbox.jpg',array('title'=>'checkbox')),array('update'=>'body','url'=>'design/checkbox?typeId='.$sf_request->getParameter('typeId')))?>
</td>
<td>
<?php echo link_to_remote(image_tag('/images/radio.jpg',array('title'=>'radio button')),array('update'=>'body','url'=>'design/radio?typeId='.$sf_request->getParameter('typeId')))?>
</td>
<td>
<?php echo link_to_remote(image_tag('/images/selectTag.jpg',array('title'=>'drop down list')),array('update'=>'body','url'=>'design/selectTag?typeId='.$sf_request->getParameter('typeId')))?>
</td>
<td>
<?php echo link_to_remote(image_tag('/images/date1.jpg',array('title'=>'date')),array('update'=>'body','url'=>'design/date?typeId='.$sf_request->getParameter('typeId')))?>
</td>
</tr>
</table>
  <div id="body" style="background-color: rgb(228,223,228);width: 1000px;">
  		<?php $tag = $sf_flash->get('tag');?>
  		<span style="font-size: 16px;color: red">نام انتخابی تکراری است ، لطفا نامی دیگر انتخاب نمایید</span>
  		<?php include_partial('design/'.$tag ,array('typeId'=>$sf_request->getParameter('typeId'))); ?>
  </div> 