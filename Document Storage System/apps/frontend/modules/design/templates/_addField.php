<?php use_helper('javascript') ?>
<table>
<tr>
<td>
<?php echo link_to_remote(image_tag('/images/textarea.jpg',array('title'=>'textarea')),array('update'=>'body','url'=>'design/textarea?typeId='.$typeId))?>
</td>
<td>
<?php echo link_to_remote(image_tag('/images/input.jpg',array('title'=>'input')),array('update'=>'body','url'=>'design/input?typeId='.$typeId))?>
</td>
<td>
<?php echo link_to_remote(image_tag('/images/checkbox.jpg',array('title'=>'checkbox')),array('update'=>'body','url'=>'design/checkbox?typeId='.$typeId))?>
</td>
<td>
<?php echo link_to_remote(image_tag('/images/radio.jpg',array('title'=>'radio button')),array('update'=>'body','url'=>'design/radio?typeId='.$typeId))?>
</td>
<td>
<?php echo link_to_remote(image_tag('/images/selectTag.jpg',array('title'=>'drop down list')),array('update'=>'body','url'=>'design/selectTag?typeId='.$typeId))?>
</td>
<td>
<?php echo link_to_remote(image_tag('/images/date1.jpg',array('title'=>'date')),array('update'=>'body','url'=>'design/date?typeId='.$typeId))?>
</td>
</tr>
</table>
  <div id="body" style="background-color: rgb(228,223,228);width: 1000px;"></div> 