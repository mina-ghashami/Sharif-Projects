<?php //use_helper('object') ?>

<?php if($sf_params -> has('error')): 
	echo 'فایلی برای بارگذاری انتخاب نشد!'.'<br/><br/>';
endif;?>

<?php echo form_tag('document/upload','multipart= true') ?>
نوع سند مورد نظر را انتخاب کنید:

<?php echo select_tag('type',objects_for_select($types,'getId','getName',4)) ?>
<br><br>&nbsp;&nbsp;
<?php echo input_file_tag('file') ?>
<?php echo submit_tag('ثبت و ادامه') ?>
</form>

<br><br><br><br><br>
<br><br><br><br><br>
<br><br><br><br>
