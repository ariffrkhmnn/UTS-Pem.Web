<?php
/** @var \UMM\Pemweb\Core\Router $router */
use UMM\Pemweb\Controllers\MahasiswaController;

$router->get('/mahasiswa', [MahasiswaController::class, 'index']);
$router->get('/mahasiswa/tambah', [MahasiswaController::class, 'tambah']);
$router->get('/mahasiswa/edit', [MahasiswaController::class, 'edit']);
$router->post('/mahasiswa/simpan', [MahasiswaController::class, 'simpan']);
$router->post('/mahasiswa/update', [MahasiswaController::class, 'update']);
$router->post('/mahasiswa/hapus', [MahasiswaController::class, 'hapus']);
