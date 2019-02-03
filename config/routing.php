<?php
return [
    [
        'path' => 'post',
        'params' => [],
        'controller' => [\Controller\PostController::class, 'index'],
        'method' => 'GET'
    ],
    [
        'path' => 'post/{id}/view',
        'params' => ['{id}' => '\d+'],
        'controller' => [\Controller\PostController::class, 'view'],
        'method' => 'GET'
    ],
    [
        'path' => 'post/create',
        'params' => [],
        'controller' => [\Controller\PostController::class, 'create'],
        'method' => 'POST'
    ],
    [
        'path' => 'post/{id}/update',
        'params' => ['{id}' => '\d+'],
        'controller' => [\Controller\PostController::class, 'update'],
        'method' => 'PUT'
    ],
    [
        'path' => 'post/{id}/delete',
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
        'path' => 'category/{id}/view',
        'params' => ['{id}' => '\d+'],
        'controller' => [\Controller\CategoryController::class, 'view'],
        'method' => 'GET'
    ],
    [
        'path' => 'category/create',
        'params' => [],
        'controller' => [\Controller\CategoryController::class, 'create'],
        'method' => 'POST'
    ],
    [
        'path' => 'category/{id}/update',
        'params' => ['{id}' => '\d+'],
        'controller' => [\Controller\CategoryController::class, 'update'],
        'method' => 'PUT'
    ],
    [
        'path' => 'category/{id}/delete',
        'params' => ['{id}' => '\d+'],
        'controller' => [\Controller\CategoryController::class, 'delete'],
        'method' => 'DELETE'
    ],
];