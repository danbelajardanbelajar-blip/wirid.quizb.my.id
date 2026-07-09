<?php
namespace App\Models;

class EventModel extends BaseModel {
    protected $dataFile;

    public function __construct() {
        $this->dataFile = __DIR__ . '/../../events.json';
        if (!file_exists($this->dataFile)) {
            file_put_contents($this->dataFile, '[]');
        }
    }

    public function getAll() {
        $json = file_get_contents($this->dataFile);
        $data = json_decode($json, true);
        return is_array($data) ? $data : [];
    }

    private function saveAll($data) {
        return file_put_contents($this->dataFile, json_encode($data, JSON_PRETTY_PRINT)) !== false;
    }

    public function add($id, $label, $type, $startYear, $startMonth, $startDay, $startHijriDay) {
        $data = $this->getAll();
        foreach ($data as $item) {
            if ($item['id'] === $id) {
                return ['success' => false, 'error' => 'ID sudah ada'];
            }
        }
        $data[] = [
            'id' => $id,
            'label' => $label,
            'type' => $type,
            'startYear' => (int)$startYear,
            'startMonth' => (int)$startMonth,
            'startDay' => (int)$startDay,
            'startHijriDay' => (int)$startHijriDay
        ];
        if ($this->saveAll($data)) {
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Gagal menyimpan ke events.json'];
    }

    public function delete($id) {
        $data = $this->getAll();
        $newData = [];
        $found = false;
        foreach ($data as $item) {
            if ($item['id'] === $id) {
                $found = true;
            } else {
                $newData[] = $item;
            }
        }
        if (!$found) return ['success' => false, 'error' => 'ID tidak ditemukan'];
        if ($this->saveAll($newData)) {
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Gagal menghapus'];
    }
}
