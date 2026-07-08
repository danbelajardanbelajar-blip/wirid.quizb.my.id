<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\WiridModel;

class ApiDataController extends Controller {
    private $model;

    public function __construct() {
        require_once __DIR__ . '/../Models/BaseModel.php';
        require_once __DIR__ . '/../Models/WiridModel.php';
        $this->model = new WiridModel();
    }

    public function index() {
        // GET /api/data -> Ambil semua
        $data = $this->model->getAll();
        $this->json(['ok' => true, 'data' => $data]);
    }

    public function add() {
        // POST /api/data/add
        $body = $this->getJsonBody();
        $id = trim($body['id'] ?? '');
        $judul = trim($body['judul'] ?? '');
        $kategori = trim($body['kategori'] ?? '');
        $arab = trim($body['arab'] ?? '');

        if ($id === '' || $judul === '' || $arab === '') {
            $this->json(['ok' => false, 'error' => 'ID, judul, dan teks doa wajib diisi'], 400);
        }

        $result = $this->model->add($id, $judul, $kategori, $arab);
        if ($result['success']) {
            $this->json(['ok' => true, 'message' => 'Berhasil ditambah']);
        } else {
            $this->json(['ok' => false, 'error' => $result['error'] ?? 'Gagal menambah'], 400);
        }
    }

    public function update() {
        // POST /api/data/update
        $body = $this->getJsonBody();
        $id = trim($body['id'] ?? '');
        $judul = trim($body['judul'] ?? '');
        $kategori = trim($body['kategori'] ?? '');
        $arab = trim($body['arab'] ?? '');

        if ($id === '' || $judul === '' || $arab === '') {
            $this->json(['ok' => false, 'error' => 'ID, judul, dan teks doa wajib diisi'], 400);
        }

        $result = $this->model->update($id, $judul, $kategori, $arab);
        if ($result['success']) {
            $this->json(['ok' => true, 'message' => 'Berhasil diupdate']);
        } else {
            $this->json(['ok' => false, 'error' => $result['error'] ?? 'Gagal mengupdate'], 404);
        }
    }

    public function delete() {
        // POST /api/data/delete
        $body = $this->getJsonBody();
        $id = trim($body['id'] ?? '');

        if ($id === '') {
            $this->json(['ok' => false, 'error' => 'ID wajib diisi'], 400);
        }

        $result = $this->model->delete($id);
        if ($result['success']) {
            $this->json(['ok' => true, 'message' => 'Berhasil dihapus']);
        } else {
            $this->json(['ok' => false, 'error' => $result['error'] ?? 'Gagal menghapus'], 404);
        }
    }
}
