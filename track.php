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
        
        // [REALTIME NOTIFIKASI] Tembak sinyal ke Tahajjud API secara asinkron
        $actionName = $payload['action'] ?? 'baru';
        $titleName = $payload['item_title'] ?? '';
        $queryName = $payload['keyword'] ?? '';
        
        $msgText = "Aktivitas " . $actionName;
        if ($titleName) $msgText .= " " . $titleName;
        if ($queryName) $msgText .= " " . $queryName;

        $notifyUrl = 'https://tahajjud.quizb.my.id/api_notify.php';
        $postData = http_build_query([
            'secret' => 'QUIZB_NOTIFY_SECRET_99',
            'message' => $msgText
        ]);
        
        $ch = curl_init($notifyUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
        
        echo json_encode(['status' => 'success']);
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid payload']);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
}
