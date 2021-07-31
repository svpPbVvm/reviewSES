<?php

use app\Application;

ini_set('display_errors', false);
error_reporting(E_ERROR);

spl_autoload_register(function ($className) {
    $path = str_replace('\\', '/', $className.'.php');
    if (file_exists($path)) {
        require $path;
    }
});
session_start();

try {
    (new Application())->start();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'application error'
    ]);
}
