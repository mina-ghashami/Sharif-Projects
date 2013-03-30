<div style="font-size:14px">
<?php echo $sf_flash->get('required') ?>
<br/>
</div>

<?php echo form_tag('document/save?docid='.$docid) ?>
<div style="font-size:14px">
<div style="color:red;">پر کردن فیلد هایی که *** دارند الزامی است.</div>
<br><br>
</div>
<?php foreach ($fields as $field) : ?>

<?php  echo $field['name']; ?>  : <br> <?php echo $field['tag'] ?>
<br><br>

<?php endforeach; ?>

<?php echo submit_tag('ذخیره') ?>
<br><br><br>