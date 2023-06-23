<?php

namespace app;

use app\Config\Application;

require_once 'config.php';
require_once 'db/Contracts/IDatabase.php';
require_once 'db/MySQLDatabase.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/helpers/redirect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Config/Application.php';

$application = new Application();
$application::run();
