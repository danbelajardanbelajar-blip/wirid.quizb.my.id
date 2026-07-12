<?php
namespace App\Controllers;

use App\Core\Controller;

class ApiIstikmalController extends Controller {
    private $file = __DIR__ . "/../../istikmal.json";

    public function index() {
        if (file_exists($this->file)) {
            $data = json_decode(file_get_contents($this->file), true);
            if (!$data) $data = ['offsets' => []];
            $this->json(['ok' => true, 'data' => $data]);
        } else {
            $this->json(['ok' => true, 'data' => ['offsets' => []]]);
        }
    }

    public function update() {
        $body = $this->getJsonBody();
        if (isset($body['offsets'])) {
            file_put_contents($this->file, json_encode(['offsets' => $body['offsets']], JSON_PRETTY_PRINT));
            $this->json(['ok' => true, 'message' => 'Tersimpan']);
        } else {
            $this->json(['ok' => false, 'error' => 'Data tidak valid'], 400);
        }
    }
}
