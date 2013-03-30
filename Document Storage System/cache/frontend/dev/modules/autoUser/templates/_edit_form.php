<?php
// auto-generated by sfPropelAdmin
// date: 2009/09/15 06:00:26
?>
<?php echo form_tag('user/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($user, 'getId') ?>

<fieldset id="sf_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('user[student_id]', __($labels['user{student_id}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{student_id}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{student_id}')): ?>
    <?php echo form_error('user{student_id}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getStudentId', array (
  'size' => 20,
  'control_name' => 'user[student_id]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[first_name]', __($labels['user{first_name}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{first_name}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{first_name}')): ?>
    <?php echo form_error('user{first_name}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getFirstName', array (
  'size' => 80,
  'control_name' => 'user[first_name]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[last_name]', __($labels['user{last_name}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{last_name}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{last_name}')): ?>
    <?php echo form_error('user{last_name}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getLastName', array (
  'size' => 80,
  'control_name' => 'user[last_name]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[email]', __($labels['user{email}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('user{email}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{email}')): ?>
    <?php echo form_error('user{email}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getEmail', array (
  'size' => 80,
  'control_name' => 'user[email]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[password]', __($labels['user{password}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('user{password}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{password}')): ?>
    <?php echo form_error('user{password}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getPassword', array (
  'size' => 80,
  'control_name' => 'user[password]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[major]', __($labels['user{major}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{major}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{major}')): ?>
    <?php echo form_error('user{major}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getMajor', array (
  'size' => 80,
  'control_name' => 'user[major]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[level]', __($labels['user{level}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{level}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{level}')): ?>
    <?php echo form_error('user{level}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getLevel', array (
  'size' => 20,
  'control_name' => 'user[level]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_admin_edit_help"><?php echo __('مقادیر مجاز  bs ، ms و phd هستند') ?></div>  </div>
</div>

<div class="form-row">
  <?php echo label_for('user[phone]', __($labels['user{phone}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{phone}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{phone}')): ?>
    <?php echo form_error('user{phone}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getPhone', array (
  'size' => 20,
  'control_name' => 'user[phone]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[credential]', __($labels['user{credential}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('user{credential}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{credential}')): ?>
    <?php echo form_error('user{credential}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($user, 'getCredential', array (
  'size' => 80,
  'control_name' => 'user[credential]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_admin_edit_help"><?php echo __('مقادیر مجاز  user ، admin و designer هستند') ?></div>  </div>
</div>

<div class="form-row">
  <?php echo label_for('user[note]', __($labels['user{note}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('user{note}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{note}')): ?>
    <?php echo form_error('user{note}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($user, 'getNote', array (
  'size' => '30x3',
  'control_name' => 'user[note]',
  'rich' => true,
  'tinymce_options' => 'width:427,height:300',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('user[created_at]', __($labels['user{created_at}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('user{created_at}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('user{created_at}')): ?>
    <?php echo form_error('user{created_at}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_date_tag($user, 'getCreatedAt', array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/sf/sf_admin/images/date.png',
  'control_name' => 'user[created_at]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('user' => $user)) ?>

</form>

<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($user->getId()): ?>
<?php echo button_to(__('delete'), 'user/delete?id='.$user->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>