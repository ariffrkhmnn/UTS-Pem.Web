<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($judul ?? 'Pemweb MVC') ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<nav>
    <strong>Pemweb MVC</strong>
    <a href="/mahasiswa">Mahasiswa</a>
    <a href="/mata-kuliah">Mata Kuliah</a>
</nav>
<main>
<?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert <?= e($_SESSION['flash']['tipe']) ?>"><?= e($_SESSION['flash']['pesan']) ?></div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
