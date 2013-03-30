<?php echo form_remote_tag(array('update' => 'save','url'=> 'document/change')) ?>
<div id="save">
<?php echo $info1 ?>
<?php echo $info2 ?>
<?php echo $code['name'] ?>:
<br>
<?php echo $code['code'] ?>
<?php echo submit_tag('ذخیره') ?>    
</div>
</form>