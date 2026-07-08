<?php
namespace App\Models;

class SaranModel extends BaseModel {
    private $type;

    public function __construct($type = 'usulan') {
        $this->type = $type;
        // Gunakan $type untuk menentukan file (contoh: usulan.json)
        parent::__construct(__DIR__ . '/../../' . $type . '.json');
    }

    public function add($data_entry) {
        $data = $this->readData();
        
        $entry = [
            'id' => uniqid($this->type . '_'),
            'tanggal' => date('Y-m-d H:i:s'),
            'nama' => $data_entry['nama'] ?? '',
            'email' => $data_entry['email'] ?? '',
            'ip' => $data_entry['ip'] ?? '',
            'status' => 'pending'
        ];

        if ($this->type === 'usulan') {
            $entry['pesan'] = $data_entry['pesan'] ?? '';
        } elseif ($this->type === 'request') {
            $entry['request'] = $data_entry['pesan'] ?? '';
        } elseif ($this->type === 'kirim_file') {
            $entry['pesan'] = $data_entry['pesan'] ?? '';
            if (isset($data_entry['file_name'])) {
                $entry['file_name'] = $data_entry['file_name'];
            }
        }
        
        $data[] = $entry;
        
        if ($this->writeData($data)) {
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Gagal menyimpan entri'];
    }

    public function delete($id) {
        $data = $this->readData();
        $filtered = array_values(array_filter($data, fn($item) => (string)($item['id'] ?? '') !== (string)$id));
        
        if (count($filtered) === count($data)) return ['success' => false, 'error' => 'ID entri tidak ditemukan'];
        
        // Coba hapus file lampiran jika ini kirim_file dan ada file_name
        $deletedItem = current(array_filter($data, fn($item) => (string)($item['id'] ?? '') === (string)$id));
        if ($this->type === 'kirim_file' && isset($deletedItem['file_name'])) {
            $filePath = __DIR__ . '/../../uploads/' . $deletedItem['file_name'];
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }

        if ($this->writeData($filtered)) {
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Gagal menghapus entri'];
    }
}
