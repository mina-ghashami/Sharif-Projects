<?php use_helper('javascript') ?>
<?php use_helper('validation') ?>

<?php $source = $sf_user->getAttribute('source'); ?>
<?php $typeId = $sf_request->getParameter('typeId');
$c = new Criteria();
$c->add(TypePeer::ID , $typeId);
$type = TypePeer::doSelectOne($c);
$docTypeName = $type->getName(); 
?>
<b><?php echo "نوع سند جاری: ".$docTypeName ?></b>


<table>
<tr>
<td>
<?php echo link_to_remote(image_tag('/images/textarea.jpg'),array('update'=>'body','url'=>'design/textarea?typeId='.$sf_request->getParameter('typeId')))?>

</td>
<td>
<?php echo link_to_remote(image_tag('/images/input.jpg'),array('update'=>'body','url'=>'design/input?typeId='.$sf_request->getParameter('typeId')))?>
</td>
<td>
<?php echo link_to_remote(image_tag('/images/checkbox.jpg'),array('update'=>'body','url'=>'design/checkbox?typeId='.$sf_request->getParameter('typeId')))?>
</td>
<td>
<?php echo link_to_remote(image_tag('/images/radio.jpg'),array('update'=>'body','url'=>'design/radio?typeId='.$sf_request->getParameter('typeId')))?>
</td>
<td>
<?php echo link_to_remote(image_tag('/images/selectTag.jpg'),array('update'=>'body','url'=>'design/selectTag?typeId='.$sf_request->getParameter('typeId')))?>
</td>
<td>
<?php echo link_to_remote(image_tag('/images/date1.jpg'),array('update'=>'body','url'=>'design/date?typeId='.$sf_request->getParameter('typeId')))?>
</td>
</tr>
</table>
  <div id="body" style="background-color: rgb(228,223,228);width: 1000px;">
  		<?php include_partial('design/selectTag',array('typeId'=>$sf_request->getParameter('typeId'))); ?>
  </div> 