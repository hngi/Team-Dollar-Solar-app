<?php
  //Configuration
  if(is_file('config.php')){
    require_once ('config.php');
  }

  //Install
  if (!defined('DIR_APPLICATION')){
    header('Location: install/index.php');
    exit;
  }

  require_once(DIR_SYSTEM. 'startup.php');
  $application_
?>
