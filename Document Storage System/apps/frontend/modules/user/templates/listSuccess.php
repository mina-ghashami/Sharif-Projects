<?php use_helper('I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>


<div id="sf_admin_container">
<table style="width: 100% ;direction: rtl;">

<?php //echo __('فهرست کاربران', array()) ?></td>



</tr></table>
<div id="sf_admin_header">
<?php include_partial('user/list_header', array('pager' => $pager)) ?>
<?php include_partial('user/list_messages', array('pager' => $pager)) ?>
</div>

<div id="sf_admin_bar">
</div>

<div id="sf_admin_content">
<?php if (!$pager->getNbResults()): ?>
<?php echo __('0 نتیجه') ?>
<?php else: ?>
<?php include_partial('user/list', array('pager' => $pager)) ?>
<?php endif; ?>
<?php include_partial('list_actions') ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('user/list_footer', array('pager' => $pager)) ?>
</div>

</div>
 