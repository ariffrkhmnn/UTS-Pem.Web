<?php require BASE_PATH . '/views/layout/header.php'; ?>
<h1><?= e($judul) ?></h1>
<form method="post" action="<?= e($aksi) ?>">
    <?php if (isset($data['id'])): ?><input type="hidden" name="id" value="<?= (int) $data['id'] ?>"><?php endif; ?>

    <label>Kode
        <input name="kode" value="<?= e($data['kode'] ?? '') ?>">
        <?php if (isset($errors['kode'])): ?><span class="error"><?= e($errors['kode']) ?></span><?php endif; ?>
    </label>
    <label>Nama
        <input name="nama" value="<?= e($data['nama'] ?? '') ?>">
        <?php if (isset($errors['nama'])): ?><span class="error"><?= e($errors['nama']) ?></span><?php endif; ?>
    </label>
    <label>SKS
        <input name="sks" type="number" min="1" max="6" value="<?= e($data['sks'] ?? '') ?>">
        <?php if (isset($errors['sks'])): ?><span class="error"><?= e($errors['sks']) ?></span><?php endif; ?>
    </label>
    <p><button class="btn" type="submit">Simpan</button> <a class="btn abu" href="/mata-kuliah">Batal</a></p>
</form>
<?php require BASE_PATH . '/views/layout/footer.php'; ?>
