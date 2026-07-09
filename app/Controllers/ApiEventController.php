<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\EventModel;

class ApiEventController extends Controller {
    private $model;

    public function __construct() {
        require_once __DIR__ . '/../Models/BaseModel.php';
        require_once __DIR__ . '/../Models/EventModel.php';
        $this->model = new EventModel();
    }

    public function index() {
        $data = $this->model->getAll();
        $this->json(['ok' => true, 'data' => $data]);
    }

    public function add() {
        $body = $this->getJsonBody();
        $id = trim($body['id'] ?? uniqid('ev_'));
        $label = trim($body['label'] ?? '');
        $type = trim($body['type'] ?? 'NONE');
        $startYear = $body['startYear'] ?? 0;
        $startMonth = $body['startMonth'] ?? 0;
        $startDay = $body['startDay'] ?? 0;
        $startHijriDay = $body['startHijriDay'] ?? -1;
        $startHijriMonth = $body['startHijriMonth'] ?? 0;

        if ($label === '') {
            $this->json(['ok' => false, 'error' => 'Nama event wajib diisi'], 400);
        }

        $result = $this->model->add($id, $label, $type, $startYear, $startMonth, $startDay, $startHijriDay, $startHijriMonth);
        if ($result['success']) {
            $this->json(['ok' => true, 'message' => 'Berhasil ditambah']);
        } else {
            $this->json(['ok' => false, 'error' => $result['error'] ?? 'Gagal menambah'], 400);
        }
    }

    public function update() {
        $body = $this->getJsonBody();
        $id = trim($body['id'] ?? '');
        $label = trim($body['label'] ?? '');
        $type = trim($body['type'] ?? 'NONE');
        $startYear = $body['startYear'] ?? 0;
        $startMonth = $body['startMonth'] ?? 0;
        $startDay = $body['startDay'] ?? 0;
        $startHijriDay = $body['startHijriDay'] ?? -1;
        $startHijriMonth = $body['startHijriMonth'] ?? 0;

        if ($id === '') {
            $this->json(['ok' => false, 'error' => 'ID wajib diisi'], 400);
        }
        if ($label === '') {
            $this->json(['ok' => false, 'error' => 'Nama event wajib diisi'], 400);
        }

        $result = $this->model->update($id, $label, $type, $startYear, $startMonth, $startDay, $startHijriDay, $startHijriMonth);
        if ($result['success']) {
            $this->json(['ok' => true, 'message' => 'Berhasil diperbarui']);
        } else {
            $this->json(['ok' => false, 'error' => $result['error'] ?? 'Gagal memperbarui'], 400);
        }
    }

    public function delete() {
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
