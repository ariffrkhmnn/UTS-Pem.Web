# Proyek UTS Pemrograman Web - PHP MVC

Aplikasi CRUD **Mahasiswa** dan **Mata Kuliah** (PHP 8.1+, MySQL, PDO prepared statement).

## Menjalankan
1. Import `database/schema.sql` ke MySQL.
2. Sesuaikan `src/config/koneksi.php` (atau env `DB_HOST DB_NAME DB_USER DB_PASS`).
3. (Opsional) `composer dump-autoload` — tanpa composer pun autoloader cadangan jalan.
4. `php -S localhost:8000 -t public public/index.php`
5. Buka http://localhost:8000

## Rute
| Method | Path | Fungsi |
|---|---|---|
| GET | /mahasiswa, /mahasiswa/tambah, /mahasiswa/edit?id= | list, form tambah, form edit |
| POST | /mahasiswa/simpan, /update, /hapus | create, update, delete |
| GET | /mata-kuliah, /mata-kuliah/tambah, /mata-kuliah/edit?id= | idem |
| POST | /mata-kuliah/simpan, /update, /hapus | idem |

## Pembagian tugas
| Anggota | Branch | Tanggung jawab |
|---|---|---|
| Arif | `feature/core` | Front controller, Router, base Controller, koneksi, layout, CSS, schema SQL |
| Adi | `feature/mahasiswa` | Model, Repository, Controller, rute, view Mahasiswa |
| Idris | `feature/mata-kuliah` | Model, Repository, Controller, rute, view Mata Kuliah |

## Alur Git
1. Arif push inti ke `main` (atau merge PR `feature/core`) lebih dulu.
2. Adi & Idris: `git pull`, `git checkout -b feature/<nama>`, salin file bagian masing-masing, commit, push, buka Pull Request.
3. Saling review PR (minimal 1 approve) lalu merge ke `main`.
