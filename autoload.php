<?php
spl_autoload_register(function ($className) {
    $dir = __DIR__;
    $relFilePath = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $filePath = $dir . DIRECTORY_SEPARATOR . $relFilePath . '.php';
    require $filePath;
});

