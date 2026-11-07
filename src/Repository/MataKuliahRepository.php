<?php
declare(strict_types=1);

namespace UMM\Pemweb\Repository;

use PDO;
use UMM\Pemweb\Model\MataKuliah;

class MataKuliahRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function all(): array
    {
        return $this->pdo->query('SELECT * FROM mata_kuliah ORDER BY id DESC')->fetchAll();
    }

    public function find(int $id): ?array
    {
        $st = $this->pdo->prepare('SELECT * FROM mata_kuliah WHERE id = :id');
        $st->execute(['id' => $id]);
        return $st->fetch() ?: null;
    }

    public function save(MataKuliah $mk): void
    {
        $st = $this->pdo->prepare('INSERT INTO mata_kuliah (kode, nama, sks) VALUES (:kode, :nama, :sks)');
        $st->execute(['kode' => $mk->kode(), 'nama' => $mk->nama(), 'sks' => $mk->sks()]);
    }

    public function update(MataKuliah $mk): void
    {
        $st = $this->pdo->prepare('UPDATE mata_kuliah SET kode = :kode, nama = :nama, sks = :sks WHERE id = :id');
        $st->execute(['kode' => $mk->kode(), 'nama' => $mk->nama(), 'sks' => $mk->sks(), 'id' => $mk->id()]);
    }

    public function delete(int $id): void
    {
        $st = $this->pdo->prepare('DELETE FROM mata_kuliah WHERE id = :id');
        $st->execute(['id' => $id]);
    }
}
