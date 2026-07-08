<?php
namespace App\Controllers;

use App\Core\Controller;

class PageController extends Controller {
    public function index() {
        // Tampilkan halaman utama SPA
        $this->view('main_spa');
    }
}
