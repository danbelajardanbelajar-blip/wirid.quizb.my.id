<?php
header('Content-Type: application/json');

// Handle JSON input or form POST
$input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
$action = $input['action'] ?? ($_GET['action'] ?? 'read');
$type = $input['type'] ?? ($_GET['type'] ?? 'usulan');

$file_map = [
    'usulan' => 'usulan.json',
    'request' => 'request.json',
    'kirim_file' => 'kirim_file.json'
];

if (!array_key_exists($type, $file_map)) {
    echo json_encode(['ok' => false, 'error' => 'Invalid type']);
    exit;
}

$file = $file_map[$type];

function readData($f) {
    if (!file_exists($f)) return [];
    return json_decode(file_get_contents($f), true) ?: [];
}

function writeData($f, $d) {
    file_put_contents($f, json_encode($d, JSON_PRETTY_PRINT));
}

if ($action === 'read') {
    $data = readData($file);
    // Sort descending by tanggal
    usort($data, function($a, $b) {
        $ta = strtotime($a['tanggal'] ?? 0);
        $tb = strtotime($b['tanggal'] ?? 0);
        return $tb - $ta;
    });
    echo json_encode(['ok' => true, 'data' => $data]);
    exit;
}

if ($action === 'delete') {
    $id = $input['id'] ?? '';
    if (!$id) {
        echo json_encode(['ok' => false, 'error' => 'ID required']);
        exit;
    }
    
    $data = readData($file);
    $data = array_filter($data, function($e) use ($id) { return ($e['id'] ?? '') !== $id; });
    writeData($file, array_values($data));
    
    echo json_encode(['ok' => true]);
    exit;
}

if ($action === 'reply') {
    $id = $input['id'] ?? '';
    $messageHTML = $input['message'] ?? '';
    if (!$id || !$messageHTML) {
        echo json_encode(['ok' => false, 'error' => 'ID and message required']);
        exit;
    }
    
    $data = readData($file);
    $entryIndex = -1;
    $targetEmail = '';
    foreach ($data as $i => $e) {
        if (($e['id'] ?? '') === $id) {
            $entryIndex = $i;
            $targetEmail = $e['email'] ?? '';
            break;
        }
    }
    
    if ($entryIndex === -1) {
        echo json_encode(['ok' => false, 'error' => 'Entry not found']);
        exit;
    }
    if (!$targetEmail) {
        echo json_encode(['ok' => false, 'error' => 'User did not provide an email address']);
        exit;
    }

    // Load PHPMailer
    $possiblePaths = [
        dirname(__DIR__, 1) . '/vendor/phpmailer/phpmailer/src/',
        dirname(__DIR__, 2) . '/vendor/phpmailer/phpmailer/src/',
        $_SERVER['DOCUMENT_ROOT'] . '/vendor/phpmailer/phpmailer/src/',
        '/home/quic1934/public_html/vendor/phpmailer/phpmailer/src/'
    ];
    $mailerFound = false;
    foreach ($possiblePaths as $path) {
        if (file_exists($path . 'PHPMailer.php')) {
            require_once $path . 'Exception.php';
            require_once $path . 'PHPMailer.php';
            require_once $path . 'SMTP.php';
            $mailerFound = true;
            break;
        }
    }

    if (!$mailerFound) {
        echo json_encode(['ok' => false, 'error' => 'PHPMailer library not found on server']);
        exit;
    }

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'maktabah.quizb.my.id'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'admin@maktabah.quizb.my.id'; 
        $mail->Password   = 'i3SPCi7r5998@kH'; 
        $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port       = 465; 
        
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('admin@maktabah.quizb.my.id', 'Admin Mafatihul Akhyar');
        $mail->addAddress($targetEmail);
        $mail->isHTML(true);
        $mail->Subject = 'Balasan dari Tim Mafatihul Akhyar';
        
        $body = "<html><body style='font-family:sans-serif;line-height:1.6;color:#333;padding:20px;max-width:600px;'>" . 
                "<h3 style='color:#22c55e;'>Halo " . htmlspecialchars($data[$entryIndex]['nama'] ?? '') . ",</h3>" . 
                "<div style='margin-bottom:30px;'>" . nl2br(htmlspecialchars($messageHTML)) . "</div>" .
                "<hr style='border:none;border-top:1px solid #ddd;'>" .
                "<div style='font-size:12px;color:#888;margin-top:15px;'>" .
                "<strong>Pesan Anda sebelumnya:</strong><br><br>" . 
                "<em>\"" . htmlspecialchars($data[$entryIndex]['pesan'] ?? $data[$entryIndex]['request'] ?? '') . "\"</em>" .
                "</div>" .
                "</body></html>";
                
        $mail->Body = $body;
        $mail->send();

        // Mark as replied
        $data[$entryIndex]['status'] = 'replied';
        writeData($file, $data);

        echo json_encode(['ok' => true]);
    } catch (Exception $e) {
        echo json_encode(['ok' => false, 'error' => $mail->ErrorInfo]);
    }
    exit;
}

echo json_encode(['ok' => false, 'error' => 'Invalid action']);
