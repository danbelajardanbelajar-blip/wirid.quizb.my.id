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

    public function add($id, $label, $type, $startYear, $startMonth, $startDay, $startHijriDay, $startHijriMonth = 0) {
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
            'startHijriDay' => (int)$startHijriDay,
            'startHijriMonth' => (int)$startHijriMonth,
            'exceptions' => []
        ];
        if ($this->saveAll($data)) {
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Gagal menyimpan ke events.json'];
    }

    public function update($id, $label, $type, $startYear, $startMonth, $startDay, $startHijriDay, $startHijriMonth = 0) {
        $data = $this->getAll();
        $found = false;
        foreach ($data as &$item) {
            if ($item['id'] === $id) {
                $item['label'] = $label;
                $item['type'] = $type;
                $item['startYear'] = (int)$startYear;
                $item['startMonth'] = (int)$startMonth;
                $item['startDay'] = (int)$startDay;
                $item['startHijriDay'] = (int)$startHijriDay;
                $item['startHijriMonth'] = (int)$startHijriMonth;
                $found = true;
                break;
            }
        }
        if (!$found) return ['success' => false, 'error' => 'ID tidak ditemukan'];
        if ($this->saveAll($data)) {
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Gagal menyimpan ke events.json'];
    }

    public function addException($id, $dateString) {
        $data = $this->getAll();
        $found = false;
        foreach ($data as &$item) {
            if ($item['id'] === $id) {
                if (!isset($item['exceptions'])) {
                    $item['exceptions'] = [];
                }
                if (!in_array($dateString, $item['exceptions'])) {
                    $item['exceptions'][] = $dateString;
                }
                $found = true;
                break;
            }
        }
        if (!$found) return ['success' => false, 'error' => 'ID tidak ditemukan'];
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
