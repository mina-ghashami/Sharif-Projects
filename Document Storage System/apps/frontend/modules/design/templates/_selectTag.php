<?php use_helper('validation'); ?>

<?php echo form_tag('design/selectTagForm?typeId='.$typeId) ?> 
<br /> 
<?php echo form_error('name') ?>
نام: 
<?php echo input_tag('name') ?>
<br /><br />
آیا این فیلد الزامی است ؟
بله
<?php echo radiobutton_tag('required','yes',false) ?>
خیر
<?php echo radiobutton_tag('required','no',true) ?>

<br /><br />

<?php echo form_error('values') ?>
مقادیر مختلف لیست را وارد کنید ، لطفا مقادیر را با - از هم جدا کنید
<br>
<?php echo textarea_tag('values') ?>
<br/><br/>

<?php echo form_error('rank') ?>
ترتیب در نمایش
<?php echo input_tag('rank','','size=3') ?> 
<br /><br />
در گزارش گیری ظاهر شود؟
بله
<?php echo radiobutton_tag('inReport','yes',true) ?>
خیر
<?php echo radiobutton_tag('inReport','no',false) ?>
<br><br />
در نتایج جستجو ظاهر شود؟
بله
<?php echo radiobutton_tag('inSearch','yes',true) ?>
خیر
<?php echo radiobutton_tag('inSearch','no',false) ?>
<br><br>

<?php echo submit_tag('ثبت') ?>
<br><br >
</form>