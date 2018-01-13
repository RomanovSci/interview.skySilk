<?php

$env_variables = require_once __DIR__ . '/../config/env-local.php';

foreach ($env_variables as $variable => $value) {
    putenv("$variable=$value");
}