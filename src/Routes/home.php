<?php
/** @var \UMM\Pemweb\Core\Router $router */
$router->get('/', function (): void {
    header('Location: /mahasiswa');
    exit;
});
