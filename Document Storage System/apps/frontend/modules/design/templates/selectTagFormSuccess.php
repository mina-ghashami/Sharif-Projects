<?php $source = $sf_user->getAttribute('source'); $edit = $sf_flash->get('edit'); ?>
<b><?php echo "نوع سند جاری: ".$docTypeName ?></b>

<br/>

<?php if($edit == 'no'): ?>
<?php include_partial('design/addField',array('typeId'=>$typeId)) ?>
<?php endif; ?>

<?php if($edit == 'yes'): ?>
<?php include_partial('design/editForm',array('docTypeName'=>$docTypeName ,'res'=>$res,'typeId'=>$typeId)) ?>
<?php endif; ?>