<?php

    require_once __DIR__ . '/../vendor/autoload.php';
    use app\core\Application;
    use app\controllers\SiteController;

    $app = new Application(dirname(__DIR__));

    $app->router->get('/', [SiteController::class, 'home']);
    $app->router->get('/about', [SiteController::class, 'about']);
    $app->router->get('/contact', [SiteController::class, 'contact']);

    $app->router->post('/storecontact', [SiteController::class, 'storeContact']);

    $app->run();