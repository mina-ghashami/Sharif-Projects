<?php use_helper('validation'); ?>

<b><?php echo "نوع سند جاری: ".$docTypeName ?></b>
<br><br>

<?php if($tag == "input"): ?>
	
	<?php echo form_tag('design/inputForm?id='.$id) ?> 
	<br /> 
	<?php echo form_error('name') ?>
	نام: 
	<?php echo input_tag('name',$name) ?>
	<br /><br />
	آیا این فیلد الزامی است ؟
	بله
	<?php if($required == 1): ?>
		<?php echo radiobutton_tag('required','yes',true) ?>
		خیر
		<?php echo radiobutton_tag('required','no') ?>
	<?php endif; ?>
	<?php if($required == 0):  ?>
		<?php echo radiobutton_tag('required','yes') ?>
		خیر
		<?php echo radiobutton_tag('required','no',true) ?>
	<?php endif; ?>	
	
	<br /><br />
	محتویات فیلد:
	&nbsp;&nbsp;
	 فقط رقم
	<?php if($content == 'digit'): ?>
		<?php echo radiobutton_tag('content','digit',true) ?>
	<?php endif; ?>
	
	<?php if($content != 'digit'): ?>
		<?php echo radiobutton_tag('content','digit',false) ?>
	<?php endif; ?>
		
	<div id="range" >
	<?php echo form_error('from') ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	از
	<?php echo input_tag('from',$from,'size=3') ?>
	<br>
	<?php echo form_error('to') ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	تا
	<?php echo input_tag('to',$to,'size=3') ?>
	<br>
	</div>
	<br />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
	فقط حرف
	<?php if($content == 'letter'): ?>
		<?php echo radiobutton_tag('content','letter',true) ?>
	<?php endif; ?>
	<?php if($content != 'letter'): ?>
		<?php echo radiobutton_tag('content','letter',false) ?>
	<?php endif; ?>	
	<br>
	<br />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
	همه چیز
	
	<?php if($content == 'all'): ?>
		<?php echo radiobutton_tag('content','all',true) ?>
	<?php endif; ?>
	<?php if($content != 'all'): ?>
		<?php echo radiobutton_tag('content','all',false) ?>
	<?php endif; ?>	
	
	
	<br /><br />
	<?php echo form_error('length') ?>
	حداکثر طول فیلد
	<?php  echo input_tag('length',$length ,'size=3')?>
	
	(حداکثر 255 کاراکترمی تواند باشد)
	
	<br /><br />
	
	<?php echo form_error('rank') ?>
	ترتیب در نمایش
	<?php echo input_tag('rank',$rank,'size=3') ?> 
	<br /><br />
	در گزارش گیری ظاهر شود؟
	بله
	<?php if($inReport == 1): ?>
		<?php echo radiobutton_tag('inReport','yes',true) ?>
		خیر
		<?php echo radiobutton_tag('inReport','no',false) ?>
	<?php endif; ?>
	<?php if($inReport == 0): ?>
		<?php echo radiobutton_tag('inReport','yes',false) ?>
		خیر
		<?php echo radiobutton_tag('inReport','no',true) ?>
	<?php endif; ?>	
		
	<br><br />
	در نتایج جستجو ظاهر شود؟
	بله
	<?php if($inSearch == 1): ?>
		<?php echo radiobutton_tag('inSearch','yes',true) ?>
		خیر
		<?php echo radiobutton_tag('inSearch','no',false) ?>
	<?php endif; ?>	
	
	<?php if($inSearch == 0): ?>
		<?php echo radiobutton_tag('inSearch','yes',false) ?>
		خیر
		<?php echo radiobutton_tag('inSearch','no',true) ?>
	<?php endif; ?>	
	
	<br><br>
	
	<?php echo submit_tag(' ثبت و ادامه') ?>
	<br><br >
	</form>

<?php endif; ?>

<?php ///////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<?php if($tag == 'checkbox' || $tag == 'radio' || $tag == 'selectTag' || $tag == 'textarea' || $tag == 'date'): ?>
	<?php echo form_tag('design/'.$tag.'Form?id='.$id) ?> 
	<br /> 
	<?php echo form_error('name') ?>
	نام: 
	<?php echo input_tag('name',$name) ?>
	<br /><br />
	
	<?php if($tag == 'checkbox' || $tag == 'radio' || $tag == 'selectTag'): ?>
		<?php echo form_error('values') ?>
		<?php if($tag == 'checkbox'): ?>
		مقادیر مختلف چک باکس را وارد کنید ، لطفا مقادیر مختلف را با - از هم جدا کنید
		<?php endif; ?>
		<?php if($tag == 'radio'): ?>
		مقادیر مختلف ریدیو را وارد کنید ، لطفا مقادیر مختلف را با - از هم جدا کنید
		<?php endif; ?>
		<?php if($tag == 'selectTag'): ?>
		مقادیر مختلف لیست را وارد کنید ، لطفا مقادیر را با - از هم جدا کنید
		<?php endif; ?>
		<br>
		<?php echo textarea_tag('values',$values) ?>
		<br/><br/>
	<?php endif; ?>
	
	<?php if($tag == 'textarea' || $tag == 'date'): ?>
		آیا این فیلد الزامی است ؟
		بله
		<?php if($required == 0): ?>
			<?php echo radiobutton_tag('required','yes',false) ?>
			خیر
			<?php echo radiobutton_tag('required','no',true) ?>
		<?php endif; ?>
		<?php if($required == 1): ?>
			<?php echo radiobutton_tag('required','yes',true) ?>
			خیر
			<?php echo radiobutton_tag('required','no',false) ?>
		<?php endif; ?>		
		<br />	
	<?php endif; ?>
	
	
	<?php echo form_error('rank') ?>
	ترتیب در نمایش
	<?php echo input_tag('rank',$rank,'size=3') ?> 
	<br /><br />
	در گزارش گیری ظاهر شود؟
	بله
	<?php if($inReport == 1): ?>
		<?php echo radiobutton_tag('inReport','yes',true) ?>
		خیر
		<?php echo radiobutton_tag('inReport','no',false) ?>
	<?php endif; ?>
	<?php if($inReport == 0): ?>
		<?php echo radiobutton_tag('inReport','yes',false) ?>
		خیر
		<?php echo radiobutton_tag('inReport','no',true) ?>
	<?php endif; ?>
	<br><br />
	در نتایج جستجو ظاهر شود؟
	بله
	<?php if($inSearch == 1): ?>
		<?php echo radiobutton_tag('inSearch','yes',true) ?>
		خیر
		<?php echo radiobutton_tag('inSearch','no',false) ?>
	<?php endif; ?>	
	<?php if($inSearch == 0): ?>
		<?php echo radiobutton_tag('inSearch','yes',false) ?>
		خیر
		<?php echo radiobutton_tag('inSearch','no',true) ?>
	<?php endif; ?>
	<br><br>
	
	<?php echo submit_tag('ثبت و ادامه') ?>
	<br><br >
	</form>
<?php endif; ?>	
<?php ///////////////////////////////////////////////////////////////////////////////////////////////////// ?>
