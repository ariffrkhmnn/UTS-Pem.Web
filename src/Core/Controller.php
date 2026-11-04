<?php
declare(strict_types=1);

namespace UMM\Pemweb\Core;

abstract class Controller
{
    /** Tampilkan view dengan data sebagai variabel. */
    protected function view(string $nama, array $data = [], int $status = 200): void
    {
        http_response_code($status);
        extract($data);
        require BASE_PATH . '/views/' . $nama . '.php';
    }

    /** Redirect (pola PRG) + pesan flash opsional. */
    protected function redirect(string $url, ?string $pesan = null, string $tipe = 'sukses'): never
    {
        if ($pesan !== null) {
            $_SESSION['flash'] = ['pesan' => $pesan, 'tipe' => $tipe];
        }
        header('Location: ' . $url);
        exit;
    }

    protected function input(string $kunci): string
    {
        return trim((string) ($_POST[$kunci] ?? ''));
    }
}
