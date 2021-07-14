<?php
  session_start();
  require 'vendor/autoload.php';
  
  require_once 'config/constants.php';
  require_once 'config/database.php';
  require_once  'public/helpers/utilities.php';
  require_once  'public/helpers/functions.php';

  $App = new \Core\App();
  
?>