<?php
  session_start();
  
  require_once 'config/constants.php';

  require_once 'core/App.php';
  require_once 'config/database.php';
  require_once  'public/helpers/functions.php';

  require_once 'core/BaseController.php';
  require_once 'core/BaseModel.php';
  
  $App = new \Core\App();
  
?>