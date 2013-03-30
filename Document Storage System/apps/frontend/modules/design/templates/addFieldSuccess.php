<b><?php echo "نوع سند جاری: ".$docTypeName ?></b>
<br><br>

<?php //$source = $sf_user->getAttribute('source'); ?>

<?php //if($source == 'editform' || $source == 'editAtr'): ?>
	<?php //echo button_to('خاتمه','design/editForm?docTypeName='.$docTypeName); ?>
<?php //endif; ?>

<?php //if($source != 'editform' && $source != 'editAtr'): ?>
	<?php //echo button_to('خاتمه','design/index'); ?>
<?php //endif; ?>	

 
<?php include_partial('design/addField',array('typeId'=>$typeId)) ?>
