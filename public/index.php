<?php

    require_once __DIR__ . '/../vendor/autoload.php';
    use app\core\Application;
    use app\controllers\SiteController;
    use app\controllers\AuthController;

    $app = new Application(dirname(__DIR__));

    $app->router->get('/', [SiteController::class, 'home']);
    $app->router->get('/about', [SiteController::class, 'about']);
    $app->router->get('/contact', [SiteController::class, 'contact']);
    $app->router->get('/register', [AuthController::class, 'register']);

    $app->router->post('/storecontact', [SiteController::class, 'storeContact']);
    $app->router->post('/login', [AuthController::class, 'login']);

    $app->run();