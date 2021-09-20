<?php 
ini_set('display_errors', 1);
define('APP_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('LIB_DIR', dirname(APP_DIR) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR);

include_once(LIB_DIR . 'app.php');
$app = \Learning\App::getInstance();

?>