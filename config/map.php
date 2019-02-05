<?php
return [
    \App\MysqlPDOConnection::class => function () {
        return \App\MysqlPDOConnection::getInstance();
    },
];