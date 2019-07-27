<?php

$settings = [];

// Slim settings
$settings['displayErrorDetails'] = true;
$settings['determineRouteBeforeAppMiddleware'] = true;

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';

// View settings
$settings['twig'] = [
    'path' => $settings['root'] . '/templates',
    'cache_enabled' => false,
    'cache_path' =>  $settings['temp'] . '/twig-cache'
];

// Logger settings
$settings['logger'] = [
    'name' => 'app',
    'file' => $settings['temp'] . '/logs/app.log',
    'level' => \Monolog\Logger::ERROR,
];

return $settings;