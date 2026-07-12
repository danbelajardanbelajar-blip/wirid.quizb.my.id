<?php
namespace App\Controllers;

use App\Core\Controller;

class PageController extends Controller {
    public function index() {
        // Tampilkan halaman utama SPA
        $this->view('main_spa');
    }

    public function kalender() {
        // Karena ini SPA, render main_spa.php. 
        // Router JS di client-side (app.js) akan menangani pembukaan tab/panel kalender
        require_once __DIR__ . '/../Views/main_spa.php';
    }
}
