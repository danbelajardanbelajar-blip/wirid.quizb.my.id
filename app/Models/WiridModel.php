<?php
namespace App\Models;

class WiridModel extends BaseModel {
    public function __construct() {
        parent::__construct(__DIR__ . '/../../data.json');
    }

    public function add($id, $judul, $kategori, $arab) {
        $data = $this->readData();
        
        // Cek duplikasi
        foreach ($data as $item) {
            if ((string)($item['id'] ?? '') === (string)$id) return ['success' => false, 'error' => 'ID sudah ada, gunakan ID lain'];
        }

        // Simpan sebagai integer jika memungkinkan, atau string
        $numericId = is_numeric($id) ? (int)$id : $id;

        $data[] = [
            'id' => $numericId,
            'judul' => $judul,
            'kategori' => $kategori,
            'arab' => $arab,
            'aktif' => true
        ];
        
        if ($this->writeData($data)) {
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Gagal menyimpan data'];
    }

    public function update($id, $judul, $kategori, $arab) {
        $data = $this->readData();
        $found = false;
        foreach ($data as &$item) {
            if ((string)($item['id'] ?? '') === (string)$id) {
                $item['judul'] = $judul;
                $item['kategori'] = $kategori;
                $item['arab'] = $arab;
                $found = true;
                break;
            }
        }
        
        if (!$found) return ['success' => false, 'error' => 'ID tidak ditemukan'];
        
        if ($this->writeData($data)) {
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Gagal menyimpan data'];
    }

    public function delete($id) {
        $data = $this->readData();
        $filtered = array_values(array_filter($data, fn($item) => (string)($item['id'] ?? '') !== (string)$id));
        
        if (count($filtered) === count($data)) return ['success' => false, 'error' => 'ID tidak ditemukan'];
        
        if ($this->writeData($filtered)) {
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Gagal menyimpan data'];
    }
}
