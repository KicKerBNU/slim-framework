<?php

require_once __DIR__ . '/../vendor/autoload.php';


// Instantiate the app
$app = new \Slim\App(['settings' => require __DIR__ . '/../config/settings.php']);


// Set up dependencies
require  __DIR__ . '/container.php';

// Register db
require __DIR__ . '/db.php';

// Register middleware
require __DIR__ . '/middleware.php';

// Register routes
require __DIR__ . '/routes.php';

// Register mustache
require __DIR__ . '/Mustache.php';

return $app;

