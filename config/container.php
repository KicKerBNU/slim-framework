<?php

use Monolog\Logger;
use Slim\Container;
use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use App\Controler\AuthController;
use Monolog\Handler\RotatingFileHandler;


/** @var \Slim\App $app */
$container = $app->getContainer();

// Activating routes in a subfolder
$container['environment'] = function () {
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $_SERVER['SCRIPT_NAME'] = dirname(dirname($scriptName)) . '/' . basename($scriptName);
    return new Slim\Http\Environment($_SERVER);
};

// Register Twig View helper
$container[Twig::class] = function (Container $container) {
    $settings = $container->get('settings');
    $viewPath = $settings['twig']['path'];

    $mustache = new Twig($viewPath, [
        'cache' => $settings['twig']['cache_enabled'] ? $settings['twig']['cache_path'] : false
    ]);

    /** @var Twig_Loader_Filesystem $loader */
    $loader = $twig->getLoader();
    $loader->addPath($settings['public'], 'public');

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment($container->get('environment'));
    $twig->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $twig;
};

$container[LoggerInterface::class] = function (Container $container) {
    $settings = $container->get('settings')['logger'];
    $level = isset($settings['level']) ?: Logger::ERROR;
    $logFile = $settings['file'];

    $logger = new Logger($settings['name']);
    $handler = new RotatingFileHandler($logFile, 0, $level, true, 0775);
    $logger->pushHandler($handler);

    return $logger;
};

$container[\App\Action\HomeIndexAction::class] = function (Container $container) {
    $twig = $container->get(\Slim\Views\Twig::class);
    return new \App\Action\HomeIndexAction($twig);
};

$container[\App\Action\Customers::class] = function (Container $container) {
    $twig = $container->get(\Slim\Views\Twig::class);
    return new \App\Action\Customers($twig);
};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Mustache();
    
    return $view;
};







