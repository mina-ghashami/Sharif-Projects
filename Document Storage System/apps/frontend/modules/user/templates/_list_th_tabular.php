<?php
// auto-generated by sfPropelAdmin
// date: 2009/09/11 09:27:19
?>
  <th id="sf_admin_list_th_first_name">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/user/sort') == 'first_name'): ?>
      <?php echo link_to(__('نام'), 'user/list?sort=first_name&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __(($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort')) == 'asc' ? 'صعودی' : 'نزولی') ?>)
      <?php else: ?>
      <?php echo link_to(__('نام'), 'user/list?sort=first_name&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_last_name">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/user/sort') == 'last_name'): ?>
      <?php echo link_to(__('نام خانوادگی'), 'user/list?sort=last_name&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort') == 'asc' ? 'desc' : 'asc')) ?>
     (<?php echo __(($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort')) == 'asc' ? 'صعودی' : 'نزولی') ?>)
      <?php else: ?>
      <?php echo link_to(__('نام خانوادگی'), 'user/list?sort=last_name&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_email">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/user/sort') == 'email'): ?>
      <?php echo link_to(__('پست الکترونیکی'), 'user/list?sort=email&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __(($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort')) == 'asc' ? 'صعودی' : 'نزولی') ?>)
      <?php else: ?>
      <?php echo link_to(__('پست الکترونیکی'), 'user/list?sort=email&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_major">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/user/sort') == 'major'): ?>
      <?php echo link_to(__('رشته تحصیلی'), 'user/list?sort=major&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __(($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort')) == 'asc' ? 'صعودی' : 'نزولی') ?>)
      <?php else: ?>
      <?php echo link_to(__('رشته تحصیلی'), 'user/list?sort=major&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_level">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/user/sort') == 'level'): ?>
      <?php echo link_to(__('مقطع تحصیلی'), 'user/list?sort=level&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __(($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort')) == 'asc' ? 'صعودی' : 'نزولی') ?>)
      <?php else: ?>
      <?php echo link_to(__('مقطع تحصیلی'), 'user/list?sort=level&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_phone">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/user/sort') == 'phone'): ?>
      <?php echo link_to(__('شماره تلفن'), 'user/list?sort=phone&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __(($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort')) == 'asc' ? 'صعودی' : 'نزولی') ?>)
      <?php else: ?>
      <?php echo link_to(__('شماره تلفن'), 'user/list?sort=phone&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_credential">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/user/sort') == 'credential'): ?>
      <?php echo link_to(__('حق دسترسی'), 'user/list?sort=credential&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __(($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort')) == 'asc' ? 'صعودی' : 'نزولی') ?>)
      <?php else: ?>
      <?php echo link_to(__('حق دسترسی'), 'user/list?sort=credential&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_note">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/user/sort') == 'note'): ?>
      <?php echo link_to(__('پیغام'), 'user/list?sort=note&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __(($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort')) == 'asc' ? 'صعودی' : 'نزولی') ?>)
      <?php else: ?>
      <?php echo link_to(__('پیغام'), 'user/list?sort=note&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_created_at">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/user/sort') == 'created_at'): ?>
      <?php echo link_to(__('زمان ثبت در سامانه'), 'user/list?sort=created_at&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __(($sf_user->getAttribute('type', 'asc', 'sf_admin/user/sort')) == 'asc' ? 'صعودی' : 'نزولی') ?>)
      <?php else: ?>
      <?php echo link_to(__('زمان ثبت در سامانه'), 'user/list?sort=created_at&type=asc') ?>
      <?php endif; ?>
          </th>