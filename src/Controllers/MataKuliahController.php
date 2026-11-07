<?php
declare(strict_types=1);

namespace UMM\Pemweb\Controllers;

use PDOException;
use UMM\Pemweb\Core\Controller;
use UMM\Pemweb\Model\MataKuliah;
use UMM\Pemweb\Repository\MataKuliahRepository;

class MataKuliahController extends Controller
{
    private MataKuliahRepository $repo;

    public function __construct()
    {
        $this->repo = new MataKuliahRepository(require BASE_PATH . '/src/config/koneksi.php');
    }

    public function index(): void
    {
        $this->view('matakuliah/index', ['judul' => 'Daftar Mata Kuliah', 'daftar' => $this->repo->all()]);
    }

    public function tambah(): void
    {
        $this->tampilForm(['kode' => '', 'nama' => '', 'sks' => ''], [], '/mata-kuliah/simpan', 'Tambah Mata Kuliah');
    }

    public function simpan(): void
    {
        $data = $this->ambilInput();
        $errors = $this->validasi($data);

        if ($errors === []) {
            try {
                $this->repo->save(new MataKuliah($data['kode'], $data['nama'], (int) $data['sks']));
                $this->redirect('/mata-kuliah', 'Mata kuliah berhasil ditambahkan.');
            } catch (PDOException $ex) {
                if ($ex->getCode() !== '23000') {
                    throw $ex;
                }
                $errors['kode'] = 'Kode sudah terdaftar.';
            }
        }
        $this->tampilForm($data, $errors, '/mata-kuliah/simpan', 'Tambah Mata Kuliah', 422);
    }

    public function edit(): void
    {
        $row = $this->repo->find((int) ($_GET['id'] ?? 0));
        if ($row === null) {
            $this->redirect('/mata-kuliah', 'Data tidak ditemukan.', 'gagal');
        }
        $this->tampilForm($row, [], '/mata-kuliah/update', 'Edit Mata Kuliah');
    }

    public function update(): void
    {
        $id = (int) $this->input('id');
        $data = $this->ambilInput();
        $errors = $this->validasi($data);

        if ($errors === []) {
            try {
                $this->repo->update(new MataKuliah($data['kode'], $data['nama'], (int) $data['sks'], $id));
                $this->redirect('/mata-kuliah', 'Mata kuliah berhasil diperbarui.');
            } catch (PDOException $ex) {
                if ($ex->getCode() !== '23000') {
                    throw $ex;
                }
                $errors['kode'] = 'Kode sudah dipakai mata kuliah lain.';
            }
        }
        $data['id'] = $id;
        $this->tampilForm($data, $errors, '/mata-kuliah/update', 'Edit Mata Kuliah', 422);
    }

    public function hapus(): void
    {
        $this->repo->delete((int) $this->input('id'));
        $this->redirect('/mata-kuliah', 'Mata kuliah berhasil dihapus.');
    }

    // ---- helper privat ----
    private function ambilInput(): array
    {
        return [
            'kode' => strtoupper($this->input('kode')),
            'nama' => $this->input('nama'),
            'sks'  => $this->input('sks'),
        ];
    }

    private function validasi(array $d): array
    {
        $e = [];
        if (!preg_match('/^[A-Z0-9]{3,10}$/', $d['kode'])) {
            $e['kode'] = 'Kode wajib 3-10 karakter huruf/angka.';
        }
        if (mb_strlen($d['nama']) < 3 || mb_strlen($d['nama']) > 100) {
            $e['nama'] = 'Nama wajib 3-100 karakter.';
        }
        if (!ctype_digit($d['sks']) || (int) $d['sks'] < 1 || (int) $d['sks'] > 6) {
            $e['sks'] = 'SKS wajib angka 1-6.';
        }
        return $e;
    }

    private function tampilForm(array $data, array $errors, string $aksi, string $judul, int $status = 200): void
    {
        $this->view('matakuliah/form', compact('data', 'errors', 'aksi', 'judul'), $status);
    }
}
