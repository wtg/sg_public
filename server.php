<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$publicDir = __DIR__ . '/public';
$uri = urldecode($uri);

if($uri == '' || $uri == '/') {
    $uri = '/index.php';
} else if($uri[0] != '/') {
    $uri = '/' . $uri;
} else if(explode('/', $uri)[1] == 'people') {
    print_r(explode('/', $uri));
    $uri = '/people/index.php';
}

$requested = $publicDir . $uri;

if ($uri !== '/' && file_exists($requested)) {
    return false;
}

require_once $requested;
