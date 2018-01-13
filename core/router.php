<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$injector = require __DIR__.'/dependencies.php';

/** @var Request $request */
$request = $injector->make('\Symfony\Component\HttpFoundation\Request');

/** @var Response $response */
$response = $injector->make('\Symfony\Component\HttpFoundation\Response');

$dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
    $routes = require __DIR__.'/../app/routes.php';
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
});
$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());

switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        break;
    case \FastRoute\Dispatcher::FOUND:
        $handlerInfo = explode('@',$routeInfo[1]);

        $className = $handlerInfo[0];
        $method = $handlerInfo[1];
        $vars = $routeInfo[2];

        $controller = $injector->make($className);
        $response->setContent($controller->$method($vars));
        break;
}

echo $response->getContent();

return $injector;