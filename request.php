<?php
$file = 'request.json';
$ok = false;
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $request_text = trim($_POST['request_text'] ?? '');
    
    if ($nama !== '' && $request_text !== '') {
        $entry = [
            'id' => uniqid('req_'),
            'tanggal' => date('Y-m-d H:i:s'),
            'nama' => $nama,
            'email' => $email,
            'request' => $request_text,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
            'status' => 'pending'
        ];
        
        $data = [];
        if (file_exists($file)) {
            $json = file_get_contents($file);
            $data = json_decode($json, true) ?: [];
        }
        $data[] = $entry;
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
        $ok = true;
    } else {
        $err = "Nama dan Request wajib diisi.";
    }
}
?>
<!doctype html>
<html lang="id" dir="auto">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Request Kitab / Fitur</title>
  <meta name="theme-color" content="#0f172a" />
  <style>
    :root{
      --bg:#0f172a;
      --text:#e2e8f0;
      --muted:#94a3b8;
      --card:#111827;
      --line:#ffffff22;
      --accent:#22c55e;
      --accent-soft:#22c55e33;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      background:radial-gradient(circle at top,#17315c 0%,transparent 28%),var(--bg);
      color:var(--text);
      font:16px/1.68 system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,"Noto Sans",sans-serif;
    }
    .wrap{max-width:760px;margin:0 auto;padding:12px}
    .card{
      background:rgba(17,24,39,.96);
      border:1px solid var(--line);
      border-radius:18px;
      padding:16px;
      box-shadow:0 8px 24px #00000028;
    }
    h1{margin:0 0 10px;font-size:clamp(22px,5.4vw,30px);line-height:1.2}
    p.small{font-size:14px;color:var(--muted);margin:8px 0 12px}
    form.form{display:grid;gap:12px;margin-top:10px}
    .row{display:grid;gap:12px}
    @media(min-width:640px){ .row{grid-template-columns:1fr 1fr} }
    label{display:grid;gap:6px;font-size:13px;color:var(--muted)}
    .input, textarea{
      width:100%;
      background:var(--bg);
      border:1px solid var(--line);
      color:var(--text);
      border-radius:12px;
      padding:12px 13px;
      outline:none;
    }
    .input:focus, textarea:focus{ box-shadow:0 0 0 3px var(--accent-soft); border-color:var(--accent-soft); }
    textarea{ min-height:160px; resize:vertical; }
    .actions{display:flex;gap:10px;justify-content:flex-end;flex-wrap:wrap}
    .btn{
      cursor:pointer;
      border:1px solid var(--line);
      background:#ffffff10;
      color:var(--text);
      padding:10px 14px;
      border-radius:12px;
      font-weight:700;
      min-height:44px;
    }
    .btn.primary{ border-color:var(--accent-soft); background:#16a34a33; }
    .btn:disabled{ opacity:.6; cursor:not-allowed }
    .alert{
      margin-bottom:12px;padding:10px 12px;border-radius:12px;border:1px solid var(--line);
      background:#ffffff08;
    }
    .alert.ok{ border-color:var(--accent-soft); background:#16a34a22; }
    .alert.err{ border-color:#ef444422; background:#ef444411; }
    .footer-note{margin-top:10px;text-align:center;font-size:12px;color:var(--muted)}
    .brand{color:var(--accent);font-weight:700}
    @media (max-width:560px){
      .wrap{padding:10px}
      .card{padding:14px}
      .actions .btn{width:100%}
    }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card">
      <h1>Request Kitab</h1>
      <p class="small">Apakah Anda ingin menambahkan Kitab atau Fitur tertentu ke dalam <span class="brand">Mafatihul Akhyar</span>?</p>

      <?php if ($ok): ?>
        <div class="alert ok">Terima kasih! Request Anda telah berhasil disimpan.</div>
      <?php elseif ($err): ?>
        <div class="alert err"><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></div>
      <?php endif; ?>

      <?php if (!$ok): ?>
      <form class="form" method="post" action="">
        <div class="row">
          <div>
            <label for="nama">Nama <span class="brand">*</span></label>
            <input class="input" id="nama" name="nama" placeholder="Nama Anda" required />
          </div>
          <div>
            <label for="email">Email</label>
            <input class="input" id="email" name="email" type="email" placeholder="opsional" />
          </div>
        </div>
        <div>
          <label for="request_text">Request Kitab/Fitur <span class="brand">*</span></label>
          <textarea class="input" id="request_text" name="request_text" placeholder="Sebutkan judul kitab, pengarang, atau fitur yang diinginkan..." required></textarea>
        </div>
        <div class="actions">
          <button type="submit" class="btn primary">Kirim Request</button>
        </div>
      </form>
      <?php endif; ?>

      <p class="footer-note">Request Anda akan kami tampung untuk pertimbangan update berikutnya.</p>
    </div>
  </div>
</body>
</html>
