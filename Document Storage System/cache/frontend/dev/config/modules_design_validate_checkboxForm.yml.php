<?php
// auto-generated by sfValidatorConfigHandler
// date: 2009/09/15 07:49:12

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
  $validators = array();
  $context->getRequest()->setAttribute('fillin', array (
  'enabled' => true,
), 'symfony/filter');
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $validators = array();
  $validators['sfStringValidator_name'] = new sfStringValidator();
  $validators['sfStringValidator_name']->initialize($context, array (
  'min' => 2,
  'min_error' => 'نام وارد شده کوتاه است (حداقل 2 کاراکتر باید باشد)',
  'max' => 100,
  'max_error' => 'نام وارد شده طولانی است (حداکثر 100 کاراکتر می تواند باشد)',
));
  $validators['sfNumberValidator_rank'] = new sfNumberValidator();
  $validators['sfNumberValidator_rank']->initialize($context, array (
  'nan_error' => 'لطفا یک عدد وارد کنید.',
  'min' => 1,
  'min_error' => 'عددی که وارد میکنید باید بیشتر از 1 باشد.',
  'max' => 100,
  'max_error' => 'عددی که وارد میکنید باید کمتر از 100 باشد.',
));
  $validatorManager->registerName('name', 1, 'فیلد نام باید پر شود.', null, null, false);
  $validatorManager->registerValidator('name', $validators['sfStringValidator_name'], null);
  $validatorManager->registerName('rank', 1, 'فیلد ترتیب باید پر شود.', null, null, false);
  $validatorManager->registerValidator('rank', $validators['sfNumberValidator_rank'], null);
  $validatorManager->registerName('values', 1, 'فیلد مقادیر باید پر شود.', null, null, false);
  $context->getRequest()->setAttribute('fillin', array (
  'enabled' => true,
), 'symfony/filter');
}
