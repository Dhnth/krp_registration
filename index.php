<?php
// Define base path
define('BASE_PATH', __DIR__);

// Load Composer autoload
require_once 'vendor/autoload.php';

// Include config
require_once 'config/config.php';

// Include core files
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Model.php';
require_once 'core/Database.php';
require_once 'core/View.php';

// Init app
$app = new App();