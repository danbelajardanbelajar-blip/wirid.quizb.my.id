<?php
namespace App\Core;

class Controller {
    protected function json($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

    protected function getJsonBody() {
        $raw = file_get_contents("php://input");
        $decoded = json_decode($raw, true);
        return is_array($decoded) ? $decoded : [];
    }

    protected function view($viewName, $data = []) {
        extract($data);
        $file = __DIR__ . "/../Views/{$viewName}.php";
        if (file_exists($file)) {
            require $file;
        } else {
            echo "View {$viewName} tidak ditemukan.";
        }
    }
}
