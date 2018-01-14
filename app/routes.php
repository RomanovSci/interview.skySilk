<?php

return [
    ['GET', '/', 'App\Controllers\SiteController@index'],

    /** User */
    ['POST', '/api/login', 'App\Controllers\UserController@login'],
    ['POST', '/api/register', 'App\Controllers\UserController@register'],
    ['GET', '/api/check-token', 'App\Controllers\UserController@check'],
    ['GET', '/activation', 'App\Controllers\UserController@activateAccount'],
    ['POST', '/api/password', 'App\Controllers\UserController@changePassword'],
];