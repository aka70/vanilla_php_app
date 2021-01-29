<?php

require '../vendor/autoload.php';
require 'db_config.php';

use eftec\bladeone\BladeOne;

$views = __DIR__ . '/../Views/src';
$cache = __DIR__ . '/../Views/cache';

$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'Top');
    $r->addRoute('GET', '/users', 'get_all_users_handler');
    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "not found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo  "405 Method Not Allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $args = $routeInfo[2];

        $prefix = '\\App\\Controller\\';
        $suffix = 'Controller';
        $controllerName = $prefix . $handler . $suffix;

        $c = new $controllerName();
        $c->index($blade, $args);
        break;
}
