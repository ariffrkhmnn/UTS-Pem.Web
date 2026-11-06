<?php require BASE_PATH . '/views/layout/header.php'; ?>
<h1>Daftar Mata Kuliah</h1>
<a class="btn" href="/mata-kuliah/tambah">+ Tambah</a>
<table>
    <tr><th>Kode</th><th>Nama</th><th>SKS</th><th>Aksi</th></tr>
    <?php foreach ($daftar as $mk): ?>
    <tr>
        <td><?= e($mk['kode']) ?></td>
        <td><?= e($mk['nama']) ?></td>
        <td><?= (int) $mk['sks'] ?></td>
        <td>
            <a class="btn abu" href="/mata-kuliah/edit?id=<?= (int) $mk['id'] ?>">Edit</a>
            <form class="inline" method="post" action="/mata-kuliah/hapus" onsubmit="return confirm('Hapus data ini?')">
                <input type="hidden" name="id" value="<?= (int) $mk['id'] ?>">
                <button class="btn merah" type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php if ($daftar === []): ?><tr><td colspan="4">Belum ada data.</td></tr><?php endif; ?>
</table>
<?php require BASE_PATH . '/views/layout/footer.php'; ?>
