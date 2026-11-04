<?php
declare(strict_types=1);

namespace UMM\Pemweb\Core;

class Router
{
    private array $rute = [];

    public function get(string $path, array|callable $aksi): void
    {
        $this->rute['GET'][$path] = $aksi;
    }

    public function post(string $path, array|callable $aksi): void
    {
        $this->rute['POST'][$path] = $aksi;
    }

    public function dispatch(string $method, string $path): void
    {
        $path = $path === '/' ? '/' : rtrim($path, '/');
        $aksi = $this->rute[$method][$path] ?? null;

        if ($aksi === null) {
            http_response_code(404);
            exit('404 - Rute tidak ditemukan.');
        }

        if (is_callable($aksi)) {
            $aksi();
            return;
        }

        [$kelas, $fungsi] = $aksi;
        (new $kelas())->$fungsi();
    }
}
