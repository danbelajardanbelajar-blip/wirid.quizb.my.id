<?php
// Untuk PHP Built-in Server: layani file statis (seperti CSS/JS/Gambar) secara langsung
if (php_sapi_name() === 'cli-server') {
    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    if ($path !== '/' && file_exists(__DIR__ . $path)) {
        return false;
    }
}

// Tampilkan error saat development (ubah ke 0 saat production)
ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/app/Core/Router.php';
require_once __DIR__ . '/app/Core/Controller.php';

// Autoload sederhana atau require manual
require_once __DIR__ . '/app/Controllers/PageController.php';
require_once __DIR__ . '/app/Controllers/ApiDataController.php';
require_once __DIR__ . '/app/Controllers/ApiSaranController.php';
require_once __DIR__ . '/app/Controllers/ApiEventController.php';

use App\Core\Router;

$router = new Router();

// API Routes untuk Wirid (data.json)
$router->add('GET', '/api/data', 'ApiDataController', 'index');
$router->add('POST', '/api/data/add', 'ApiDataController', 'add');
$router->add('POST', '/api/data/update', 'ApiDataController', 'update');
$router->add('POST', '/api/data/delete', 'ApiDataController', 'delete');

// API Routes untuk Saran (saran.json)
$router->add('GET', '/api/saran', 'ApiSaranController', 'index');
$router->add('POST', '/api/saran/submit', 'ApiSaranController', 'submit');
$router->add('POST', '/api/saran/delete', 'ApiSaranController', 'delete');

// API Routes untuk Events Kalender (events.json)
$router->add('GET', '/api/events', 'ApiEventController', 'index');
$router->add('POST', '/api/events/add', 'ApiEventController', 'add');
$router->add('POST', '/api/events/update', 'ApiEventController', 'update');
$router->add('POST', '/api/events/delete', 'ApiEventController', 'delete');
$router->add('POST', '/api/events/add_exception', 'ApiEventController', 'addException');

// Dapatkan method dan URI
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Backward compatibility redirects untuk Aplikasi Android lama
$redirects = [
    '/usulan.php' => '/saran#usulan',
    '/request.php' => '/saran#request',
    '/kirim_file.php' => '/saran#kirim_file'
];
$pathOnly = parse_url($uri, PHP_URL_PATH);
if (isset($redirects[$pathOnly])) {
    header("Location: " . $redirects[$pathOnly], true, 301);
    exit;
}

// Dispatch ke controller yang sesuai
$router->dispatch($method, $uri);
