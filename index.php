<?php
namespace app;

use app\Config\Application;

require_once 'config.php';
require_once 'db/Contracts/IDatabase.php';
require_once 'db/MySQLDatabase.php';
require_once __DIR__ . '/app/helpers/redirect.php';
require_once __DIR__ . '/app/Config/Application.php';

$application = new Application();
$application::run();
