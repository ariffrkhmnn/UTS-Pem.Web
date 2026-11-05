<?php
declare(strict_types=1);

namespace UMM\Pemweb\Controllers;

use PDOException;
use UMM\Pemweb\Core\Controller;
use UMM\Pemweb\Model\Mahasiswa;
use UMM\Pemweb\Repository\MahasiswaRepository;

class MahasiswaController extends Controller
{
    private MahasiswaRepository $repo;

    public function __construct()
    {
        $this->repo = new MahasiswaRepository(require BASE_PATH . '/src/config/koneksi.php');
    }

    public function index(): void
    {
        $this->view('mahasiswa/index', ['judul' => 'Daftar Mahasiswa', 'daftar' => $this->repo->all()]);
    }

    public function tambah(): void
    {
        $this->tampilForm(['nim' => '', 'nama' => '', 'prodi' => ''], [], '/mahasiswa/simpan', 'Tambah Mahasiswa');
    }

    public function simpan(): void
    {
        $data = $this->ambilInput();
        $errors = $this->validasi($data);

        if ($errors === []) {
            try {
                $this->repo->save(new Mahasiswa($data['nim'], $data['nama'], $data['prodi']));
                $this->redirect('/mahasiswa', 'Mahasiswa berhasil ditambahkan.');
            } catch (PDOException $ex) {
                if ($ex->getCode() !== '23000') {
                    throw $ex;
                }
                $errors['nim'] = 'NIM sudah terdaftar.';
            }
        }
        $this->tampilForm($data, $errors, '/mahasiswa/simpan', 'Tambah Mahasiswa', 422);
    }

    public function edit(): void
    {
        $row = $this->repo->find((int) ($_GET['id'] ?? 0));
        if ($row === null) {
            $this->redirect('/mahasiswa', 'Data tidak ditemukan.', 'gagal');
        }
        $this->tampilForm($row, [], '/mahasiswa/update', 'Edit Mahasiswa');
    }

    public function update(): void
    {
        $id = (int) $this->input('id');
        $data = $this->ambilInput();
        $errors = $this->validasi($data);

        if ($errors === []) {
            try {
                $this->repo->update(new Mahasiswa($data['nim'], $data['nama'], $data['prodi'], $id));
                $this->redirect('/mahasiswa', 'Mahasiswa berhasil diperbarui.');
            } catch (PDOException $ex) {
                if ($ex->getCode() !== '23000') {
                    throw $ex;
                }
                $errors['nim'] = 'NIM sudah dipakai mahasiswa lain.';
            }
        }
        $data['id'] = $id;
        $this->tampilForm($data, $errors, '/mahasiswa/update', 'Edit Mahasiswa', 422);
    }

    public function hapus(): void
    {
        $this->repo->delete((int) $this->input('id'));
        $this->redirect('/mahasiswa', 'Mahasiswa berhasil dihapus.');
    }

    // ---- helper privat ----
    private function ambilInput(): array
    {
        return ['nim' => $this->input('nim'), 'nama' => $this->input('nama'), 'prodi' => $this->input('prodi')];
    }

    private function validasi(array $d): array
    {
        $e = [];
        if (!preg_match('/^\d{8,20}$/', $d['nim'])) {
            $e['nim'] = 'NIM wajib angka 8-20 digit.';
        }
        if (mb_strlen($d['nama']) < 3 || mb_strlen($d['nama']) > 100) {
            $e['nama'] = 'Nama wajib 3-100 karakter.';
        }
        if ($d['prodi'] === '' || mb_strlen($d['prodi']) > 100) {
            $e['prodi'] = 'Prodi wajib diisi (maks. 100 karakter).';
        }
        return $e;
    }

    private function tampilForm(array $data, array $errors, string $aksi, string $judul, int $status = 200): void
    {
        $this->view('mahasiswa/form', compact('data', 'errors', 'aksi', 'judul'), $status);
    }
}
