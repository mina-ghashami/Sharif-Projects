<?php
// auto-generated by sfDatabaseConfigHandler
// date: 2009/09/15 05:51:34

$database = new sfPropelDatabase();
$database->initialize(array (
  'dsn' => 'mysql://root@localhost/new',
  'encoding' => 'utf8',
), 'propel');
$this->databases['propel'] = $database;