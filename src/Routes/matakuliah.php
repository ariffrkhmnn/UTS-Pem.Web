<?php
/** @var \UMM\Pemweb\Core\Router $router */
use UMM\Pemweb\Controllers\MataKuliahController;

$router->get('/mata-kuliah', [MataKuliahController::class, 'index']);
$router->get('/mata-kuliah/tambah', [MataKuliahController::class, 'tambah']);
$router->get('/mata-kuliah/edit', [MataKuliahController::class, 'edit']);
$router->post('/mata-kuliah/simpan', [MataKuliahController::class, 'simpan']);
$router->post('/mata-kuliah/update', [MataKuliahController::class, 'update']);
$router->post('/mata-kuliah/hapus', [MataKuliahController::class, 'hapus']);
