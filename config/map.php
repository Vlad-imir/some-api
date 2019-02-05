<?php
return [
    \App\MysqlPDOConnection::class => function () {
        return \App\MysqlPDOConnection::getInstance();
    },
    Model\Repository\PostRepositoryInterface::class => Model\Repository\PostRepository::class,
    Model\Repository\CategoryRepositoryInterface::class => Model\Repository\CategoryRepository::class,
];