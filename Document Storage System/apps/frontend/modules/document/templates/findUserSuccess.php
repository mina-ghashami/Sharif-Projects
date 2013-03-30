<?php echo  form_tag('document/share?docid='.$docid) ?>

<?php foreach ($users as $user): ?>
<?php echo checkbox_tag($user->getId(),$user->getFullName()) ?> <?php echo $user -> getFullName() ?><br>
<?php endforeach; ?>
<br/>
<?php echo submit_tag('ثبت اشتراک') ?>
</form>