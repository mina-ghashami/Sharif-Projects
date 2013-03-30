<?php use_helper('Validation'); ?>

<?php echo form_tag('service/mail') ?>

<br>
پست الکترونیکی خود را وارد نمایید تا کلمه عبور به شما میل زده شود.
<br><br>
<?php echo form_error('email') ?>
<br>
پست الکترونیکی  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo input_tag('email','') ?>
<br><br>

<?php echo input_hidden_tag('captcha',$captchaVal) ?>
<?php echo image_tag($image) ?>

<!-- 
<img src='http://localhost/new repository/web/images/captcha.jpg' alt="mehran"/><br><br>
 -->
 
<br><br>
<?php echo form_error('captcha') ?>
کلمه موجود در عکس 
<?php echo input_tag('value') ?>
<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo submit_tag(' ارسال ',array('class'=>'button')) ?>

</form>
<br><br><br><br><br><br><br><br>