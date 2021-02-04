<?php

require '../vendor/autoload.php';
require 'db_config.php';

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'Top@index');
    $r->addRoute('GET', '/registration/top', 'Registration@top');
    $r->addRoute('POST', '/registration/confirm', 'Registration@confirm');
    $r->addRoute('POST', '/registration/complete', 'Registration@complete');
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

session_start();

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
        $targets = explode('@', $handler);
        $prefix = '\\App\\Controller\\';
        $suffix = 'Controller';
        $controllerName = $prefix . $targets[0] . $suffix;
        $args = $routeInfo[2];

        $class_instance = new $controllerName();
        echo call_user_func_array([$class_instance, $targets[1]], $args);
        break;
}
