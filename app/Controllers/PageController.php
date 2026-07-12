<?php
namespace App\Controllers;

use App\Core\Controller;

class PageController extends Controller {
    public function index() {
        // Tampilkan halaman utama SPA
        $this->view('main_spa');
    }

    public function dashboard() {
        // Tampilkan halaman dashboard analytics
        $this->view('dashboard');
    }

    public function istikmal() {
        // Tampilkan halaman pengaturan istikmal
        $this->view('istikmal');
    }
}
