<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $payload = json_decode($input, true);
    
    if ($payload && isset($payload['action'])) {
        $file = 'analytics.json';
        $entry = [
            'id' => uniqid('trk_'),
            'timestamp' => date('Y-m-d H:i:s'),
            'action' => $payload['action'],
            'type' => $payload['type'] ?? 'unknown',
            'item_id' => $payload['item_id'] ?? '',
            'item_title' => $payload['item_title'] ?? '',
            'keyword' => $payload['keyword'] ?? '',
            'ip' => $_SERVER['REMOTE_ADDR'] ?? ''
        ];
        
        $data = [];
        if (file_exists($file)) {
            $json = file_get_contents($file);
            $data = json_decode($json, true) ?: [];
        }
        $data[] = $entry;
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
        
        echo json_encode(['status' => 'success']);
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid payload']);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
}
