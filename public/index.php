<?php
// Front controller: SATU pintu untuk semua request.
declare(strict_types=1);

// Mode `php -S`: biarkan file statis (css/js) dilayani langsung.
if (PHP_SAPI === 'cli-server') {
    $file = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($file)) {
        return false;
    }
}

define('BASE_PATH', dirname(__DIR__));

if (is_file(BASE_PATH . '/vendor/autoload.php')) {
    require BASE_PATH . '/vendor/autoload.php';
} else { // cadangan bila composer belum dijalankan
    spl_autoload_register(function (string $kelas): void {
        $prefix = 'UMM\\Pemweb\\';
        if (str_starts_with($kelas, $prefix)) {
            $file = BASE_PATH . '/src/' . str_replace('\\', '/', substr($kelas, strlen($prefix))) . '.php';
            if (is_file($file)) {
                require $file;
            }
        }
    });
}

require BASE_PATH . '/src/Core/helpers.php';

use UMM\Pemweb\Core\Router;

session_start();

$router = new Router();
// Setiap anggota punya berkas rute sendiri -> tidak bentrok saat merge.
foreach (glob(BASE_PATH . '/src/Routes/*.php') as $berkasRute) {
    require $berkasRute;
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($_SERVER['REQUEST_METHOD'], $uri);
