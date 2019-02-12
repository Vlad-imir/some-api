<?php
return [
    [
        'path' => 'post',
        'params' => [],
        'controller' => [\Controller\PostController::class, 'index'],
        'method' => 'GET'
    ],
    [
        'path' => 'post/{id}',
        'params' => ['{id}' => '\d+'],
        'controller' => [\Controller\PostController::class, 'view'],
        'method' => 'GET'
    ],
    [
        'path' => 'post',
        'params' => [],
        'controller' => [\Controller\PostController::class, 'create'],
        'method' => 'POST'
    ],
    [
        'path' => 'post/{id}',
        'params' => ['{id}' => '\d+'],
        'controller' => [\Controller\PostController::class, 'update'],
        'method' => 'PATCH'
    ],
    [
        'path' => 'post/{id}',
        'params' => ['{id}' => '\d+'],
        'controller' => [\Controller\PostController::class, 'delete'],
        'method' => 'DELETE'
    ],

    [
        'path' => 'category',
        'params' => [],
        'controller' => [\Controller\CategoryController::class, 'index'],
        'method' => 'GET'
    ],
    [
        'path' => 'category/{id}',
        'params' => ['{id}' => '\d+'],
        'controller' => [\Controller\CategoryController::class, 'view'],
        'method' => 'GET'
    ],
    [
        'path' => 'category',
        'params' => [],
        'controller' => [\Controller\CategoryController::class, 'create'],
        'method' => 'POST'
    ],
    [
        'path' => 'category/{id}',
        'params' => ['{id}' => '\d+'],
        'controller' => [\Controller\CategoryController::class, 'update'],
        'method' => 'PATCH'
    ],
    [
        'path' => 'category/{id}',
        'params' => ['{id}' => '\d+'],
        'controller' => [\Controller\CategoryController::class, 'delete'],
        'method' => 'DELETE'
    ],
];