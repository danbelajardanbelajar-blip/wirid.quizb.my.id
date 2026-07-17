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
    public function exportWord() {
        $data = $this->model->getAll();
        
        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">';
        $html .= '<head><meta charset="utf-8"><title>Export Doa & Wirid</title>';
        $html .= '<style>';
        $html .= 'body { font-family: "Amiri", "Traditional Arabic", Arial, sans-serif; }';
        $html .= '.item { margin-bottom: 30px; border-bottom: 1px solid #ccc; padding-bottom: 15px; }';
        $html .= 'h2 { color: #10b981; font-size: 18pt; text-align: center; margin-bottom: 5px; }';
        $html .= '.kategori { text-align: center; color: #666; font-size: 12pt; font-style: italic; margin-bottom: 15px; }';
        $html .= '.arab { font-size: 24pt; line-height: 2.5; text-align: right; direction: rtl; }';
        $html .= '</style></head><body>';
        
        $html .= '<h1 style="text-align: center; color: #333;">Data Doa & Wirid (Mafatihul Akhyar)</h1>';
        $html .= '<hr style="margin-bottom: 30px;">';
        
        foreach ($data as $item) {
            $html .= '<div class="item">';
            $html .= '<h2>' . htmlspecialchars($item['judul']) . '</h2>';
            $html .= '<div class="kategori">Kategori: ' . htmlspecialchars($item['kategori']) . '</div>';
            
            // Format arab text: replace newlines with <br>
            $arab = nl2br(htmlspecialchars($item['arab']));
            $html .= '<div class="arab" dir="rtl">' . $arab . '</div>';
            $html .= '</div>';
        }
        
        $html .= '</body></html>';
        
        header("Content-Type: application/vnd.ms-word; charset=utf-8");
        header("Content-Disposition: attachment; filename=Data_Doa_Wirid.doc");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        
        echo $html;
        exit;
    }
}
