<?php
declare(strict_types=1);

namespace UMM\Pemweb\Repository;

use PDO;
use UMM\Pemweb\Model\Mahasiswa;

class MahasiswaRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function all(): array
    {
        return $this->pdo->query('SELECT * FROM mahasiswa ORDER BY id DESC')->fetchAll();
    }

    public function find(int $id): ?array
    {
        $st = $this->pdo->prepare('SELECT * FROM mahasiswa WHERE id = :id');
        $st->execute(['id' => $id]);
        return $st->fetch() ?: null;
    }

    public function save(Mahasiswa $m): void
    {
        $st = $this->pdo->prepare('INSERT INTO mahasiswa (nim, nama, prodi) VALUES (:nim, :nama, :prodi)');
        $st->execute(['nim' => $m->nim(), 'nama' => $m->nama(), 'prodi' => $m->prodi()]);
    }

    public function update(Mahasiswa $m): void
    {
        $st = $this->pdo->prepare('UPDATE mahasiswa SET nim = :nim, nama = :nama, prodi = :prodi WHERE id = :id');
        $st->execute(['nim' => $m->nim(), 'nama' => $m->nama(), 'prodi' => $m->prodi(), 'id' => $m->id()]);
    }

    public function delete(int $id): void
    {
        $st = $this->pdo->prepare('DELETE FROM mahasiswa WHERE id = :id');
        $st->execute(['id' => $id]);
    }
}
