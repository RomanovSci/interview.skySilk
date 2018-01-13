<?php

require_once __DIR__.'/../core/setup_env.php';
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$entityManager = require __DIR__.'/../core/db.php';

return ConsoleRunner::createHelperSet($entityManager);
