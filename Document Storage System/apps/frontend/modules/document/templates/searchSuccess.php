<?php if($pageNum == 1 ): ?>
 <?php echo form_tag('document/search?page=2') ?>
 نام صاحب سند: <br>
 <?php echo input_tag('owner') ?>
 <br><br>
 نوع سند: <br>
 <?php echo select_tag('doctype',$options) ?>
 <br><br>
 <?php echo submit_tag('ادامه ...') ?>
 </form>
<?php endif; ?>


<?php if($pageNum == 2 ): ?>
<?php echo $owner ?>
<?php echo $doctype ?>
<br><br>
<?php echo form_tag('document/result') ?>
<?php echo input_hidden_tag('doctype',$doctype) ?>
<?php echo input_hidden_tag('owner',$owner) ?>

<?php foreach ($fields as $field) : ?>
<?php  echo $field['name']; ?>  : <br> <?php echo $field['tag'] ?>
<br><br>
<?php endforeach; ?>

<?php echo submit_tag('جست و جو ') ?>


</form>
<?php endif; ?>

<br><br><br><br><br><br><br>