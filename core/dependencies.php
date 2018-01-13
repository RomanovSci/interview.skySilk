<?php 

$injector = new \Auryn\Injector();

/** Request */
$injector->share('\Symfony\Component\HttpFoundation\Request');
$injector->define('\Symfony\Component\HttpFoundation\Request', [
    ':query' => $_GET,
    ':request' => $_POST,
    ':attributes' => [],
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);

/** Response */
$injector->share('\Symfony\Component\HttpFoundation\Response');

/** Template */
$injector->share('Twig_Environment');
$injector->define('Twig_Environment', [
    ':loader' => new Twig_Loader_Filesystem(__DIR__.'/../app/Views')
]);

/** Database */
$entityManager = require __DIR__.'/db.php';
$injector->share($entityManager);

/** MailService */
$injector->share('App\Services\MailService');

return $injector;