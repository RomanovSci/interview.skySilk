<?php

$environment = getenv('ENV');
$whoops = new \Whoops\Run();

if ($environment !== 'production') {
    $whoops->pushHandler(
        new \Whoops\Handler\PrettyPageHandler()
    );
} else {
    $whoops->pushHandler(function ($e) {
        echo 'Whoops...Something went wrong';
    });
}

$whoops->register();