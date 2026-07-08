<?php
namespace App\Models;

class BaseModel {
    protected $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
        if (!file_exists($this->filePath)) {
            // Jika file tidak ada, buat file json kosong
            file_put_contents($this->filePath, json_encode(['data' => []]));
        }
    }

    protected function readData() {
        $json = file_get_contents($this->filePath);
        $data = json_decode($json, true);
        return $data['data'] ?? [];
    }

    protected function writeData($data) {
        $json = json_encode(['data' => $data], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return file_put_contents($this->filePath, $json) !== false;
    }

    public function getAll() {
        return $this->readData();
    }
}
