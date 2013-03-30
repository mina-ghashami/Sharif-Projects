<?php use_helper('Validation'); ?>
<?php use_helper('Javascript'); ?>


<br><br>
<div id="welcome">به سامانه ی انباره ی مستندات خوش آمدید.</div>
<?php echo form_tag('service/login') ?><br>
<?php echo form_error('nouser') ?><br>
<?php echo form_error('username') ?><br>

پست الکترونیکی 
<?php echo input_tag('username',null,array("size"=>'26')) ?><br><br>
<?php echo form_error('password') ?><br>
کلمه عبور
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo input_password_tag('password',null,array("size"=>'26')) ?><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo submit_tag(' ورود ',array("class"=>'button'))?>
</form>
<br><br>
<?php echo link_to('رمز خود را فراموش کرده ام!','service/forgetpass',array('class'=>'link')) ?>
<?php echo form_error('sent') ?>
<br><br>

<?php echo link_to('درباره ی سامانه','service/about',array('class'=>'link')) ?>
<br><br>

