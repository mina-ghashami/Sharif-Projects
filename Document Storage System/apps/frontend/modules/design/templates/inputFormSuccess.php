<?php $edit = $sf_flash->get('edit'); $source = $sf_user->getAttribute('source'); ?>
<b><?php echo "نوع سند جاری: ".$docTypeName ?></b>
<br><br>

<br/>
<?php if($edit == 'no'): ?>
<?php include_partial('design/addField',array('typeId'=>$typeId)) ?>
<?php endif; ?>

<?php if($edit == 'yes'): ?>
<?php include_partial('design/editForm',array('docTypeName'=>$docTypeName,'res'=>$res,'typeId'=>$typeId)) ?>
<?php endif; ?>