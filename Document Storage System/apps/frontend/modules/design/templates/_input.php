<?php use_helper('validation'); ?>
<?php echo form_tag('design/inputForm?typeId='.$typeId) ?> 
<br /> 
<?php echo form_error('name') ?>
نام: 
<?php echo input_tag('name') ?>
<br /><br />
آیا این فیلد الزامی است ؟
بله
<?php echo radiobutton_tag('required','yes') ?>
خیر
<?php echo radiobutton_tag('required','no',true) ?>
<br /><br />
محتویات فیلد:
&nbsp;&nbsp;
 فقط رقم

<?php echo radiobutton_tag('content','digit') ?>
<div id="range" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo form_error('from') ?>
از
<?php echo input_tag('from','','size=3') ?>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo form_error('to') ?>
تا
<?php echo input_tag('to','','size=3') ?>
<br>
</div>
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
فقط حرف

<?php echo radiobutton_tag('content','letter') ?>
<br>
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
همه چیز

<?php echo radiobutton_tag('content','all',true) ?>


<br /><br />
<?php echo form_error('length') ?>
حداکثر طول فیلد
<?php  echo input_tag('length','','size=3')?>

(حداکثر 255 کاراکترمی تواند باشد)

<br /><br />

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
