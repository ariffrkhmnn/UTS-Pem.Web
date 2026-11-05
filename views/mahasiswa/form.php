<?php require BASE_PATH . '/views/layout/header.php'; ?>
<h1><?= e($judul) ?></h1>
<form method="post" action="<?= e($aksi) ?>">
    <?php if (isset($data['id'])): ?><input type="hidden" name="id" value="<?= (int) $data['id'] ?>"><?php endif; ?>

    <label>NIM
        <input name="nim" value="<?= e($data['nim'] ?? '') ?>">
        <?php if (isset($errors['nim'])): ?><span class="error"><?= e($errors['nim']) ?></span><?php endif; ?>
    </label>
    <label>Nama
        <input name="nama" value="<?= e($data['nama'] ?? '') ?>">
        <?php if (isset($errors['nama'])): ?><span class="error"><?= e($errors['nama']) ?></span><?php endif; ?>
    </label>
    <label>Prodi
        <input name="prodi" value="<?= e($data['prodi'] ?? '') ?>">
        <?php if (isset($errors['prodi'])): ?><span class="error"><?= e($errors['prodi']) ?></span><?php endif; ?>
    </label>
    <p><button class="btn" type="submit">Simpan</button> <a class="btn abu" href="/mahasiswa">Batal</a></p>
</form>
<?php require BASE_PATH . '/views/layout/footer.php'; ?>
