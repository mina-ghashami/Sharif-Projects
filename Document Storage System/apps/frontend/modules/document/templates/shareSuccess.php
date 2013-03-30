<?php echo form_remote_tag(array('url'=> 'document/findUser?docid='.$docid,'update'=>'selecteduser')) ?>
<?php echo input_tag('username') ?>
<?php echo submit_tag('جستجوی کاربر') ?>
</form>


<div id="selecteduser">
<?php echo form_tag('document/share?docid='.$docid) ?>
<?php foreach ($users as $user): ?>
<?php echo checkbox_tag($user->getId(),$user->getFullName()) ?> <?php echo $user -> getFullName() ?><br>
<?php endforeach; ?>
<br/>
<?php echo submit_tag('ثبت اشتراک') ?>
</form>
</div>
<br><br><br><br><br><br>