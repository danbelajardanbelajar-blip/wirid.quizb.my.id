<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\SaranModel;

class ApiSaranController extends Controller {

    public function __construct() {
        require_once __DIR__ . '/../Models/BaseModel.php';
        require_once __DIR__ . '/../Models/SaranModel.php';
    }

    private function getModel($type) {
        $allowed = ['usulan', 'request', 'kirim_file'];
        if (!in_array($type, $allowed)) {
            $type = 'usulan';
        }
        return new SaranModel($type);
    }

    public function index() {
        $type = $_GET['type'] ?? 'usulan';
        $model = $this->getModel($type);
        $data = $model->getAll();
        usort($data, fn($a, $b) => strtotime($b['tanggal'] ?? $b['waktu'] ?? '1970-01-01') - strtotime($a['tanggal'] ?? $a['waktu'] ?? '1970-01-01'));
        $this->json(['ok' => true, 'data' => $data]);
    }

    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_POST['type'] ?? 'usulan';
            $nama = trim($_POST['nama'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $pesan = trim($_POST['pesan'] ?? '');

            // Fallback for JSON body
            if (empty($nama) && empty($pesan)) {
                $body = $this->getJsonBody();
                $type = $body['type'] ?? 'usulan';
                $nama = trim($body['nama'] ?? '');
                $email = trim($body['email'] ?? '');
                $pesan = trim($body['pesan'] ?? '');
            }

            if ($nama === '' || $pesan === '') {
                $this->json(['ok' => false, 'error' => 'Nama dan pesan/isian wajib diisi.'], 400);
            }

            if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->json(['ok' => false, 'error' => 'Format email tidak valid.'], 400);
            }

            $data_entry = [
                'nama' => $nama,
                'email' => $email,
                'pesan' => $pesan,
                'ip' => $_SERVER['REMOTE_ADDR'] ?? 'Unknown'
            ];

            // Handle file upload if type is kirim_file
            if ($type === 'kirim_file') {
                if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/../../uploads/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $fileName = time() . '_' . basename($_FILES['file']['name']);
                    $fileName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $fileName); // Sanitize
                    $dest = $uploadDir . $fileName;
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
                        $data_entry['file_name'] = $fileName;
                    } else {
                        $this->json(['ok' => false, 'error' => 'Gagal mengunggah file.'], 500);
                    }
                }
            }

            $model = $this->getModel($type);
            $result = $model->add($data_entry);
            
            if ($result['success']) {
                $this->json(['ok' => true, 'message' => 'Terkirim! Terima kasih.']);
            } else {
                $this->json(['ok' => false, 'error' => 'Gagal menyimpan data.'], 500);
            }
        }
    }

    public function delete() {
        $body = $this->getJsonBody();
        $id = trim($body['id'] ?? '');
        $type = trim($body['type'] ?? 'usulan');

        if ($id === '') {
            $this->json(['ok' => false, 'error' => 'ID wajib diisi'], 400);
        }

        $model = $this->getModel($type);
        $result = $model->delete($id);
        
        if ($result['success']) {
            $this->json(['ok' => true, 'message' => 'Berhasil dihapus']);
        } else {
            $this->json(['ok' => false, 'error' => $result['error'] ?? 'Gagal menghapus'], 404);
        }
    }
}
