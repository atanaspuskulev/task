<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Lib\{
    Config,
    ControllerDispatcher,
    Router,
    Container,
    View
};

Config::load(__DIR__ . '/../');

$container = new Container();

$container->set(View::class, fn() => new View([
    'viewsPath' => Config::get('VIEW_RESOURCE_DIR')
]));

require_once __DIR__ . '/../routes/web.php';

$routerResult = Router::resolve();

if (isset($routerResult['routeAction']) && $routerResult['routeAction']) {
    $dispatcher = new ControllerDispatcher($container);
    $response = $dispatcher->dispatch($routerResult['routeAction'], $routerResult['routeParams']);
    echo $response;
}