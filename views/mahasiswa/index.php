<?php require BASE_PATH . '/views/layout/header.php'; ?>
<h1>Daftar Mahasiswa</h1>
<a class="btn" href="/mahasiswa/tambah">+ Tambah</a>
<table>
    <tr><th>NIM</th><th>Nama</th><th>Prodi</th><th>Aksi</th></tr>
    <?php foreach ($daftar as $m): ?>
    <tr>
        <td><?= e($m['nim']) ?></td>
        <td><?= e($m['nama']) ?></td>
        <td><?= e($m['prodi']) ?></td>
        <td>
            <a class="btn abu" href="/mahasiswa/edit?id=<?= (int) $m['id'] ?>">Edit</a>
            <form class="inline" method="post" action="/mahasiswa/hapus" onsubmit="return confirm('Hapus data ini?')">
                <input type="hidden" name="id" value="<?= (int) $m['id'] ?>">
                <button class="btn merah" type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php if ($daftar === []): ?><tr><td colspan="4">Belum ada data.</td></tr><?php endif; ?>
</table>
<?php require BASE_PATH . '/views/layout/footer.php'; ?>
