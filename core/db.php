<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$settings = [
    'driver'   => getenv('DB_DRIVER'),
    'dbname'   => getenv('DB_NAME'),
    'user'     => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
];

if (getenv('DB_DRIVER') === 'pdo_sqlite') {
    unset($settings['dbname']);
    $settings['path'] = __DIR__.'/../'.getenv('DB_NAME');
}

return EntityManager::create(
    $settings,
    Setup::createAnnotationMetadataConfiguration([__DIR__.'/../app/Models'], true)
);