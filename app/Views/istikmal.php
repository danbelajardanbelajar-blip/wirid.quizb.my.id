<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Istikmal - Mafatihul Akhyar</title>
    <link rel="icon" href="/logo.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
      }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        body { display: flex; justify-content: center; font-family: 'Outfit', sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); min-height: 100vh; }
        .min-h-screen { max-width: 860px; width: 100%; margin: 0 auto; box-shadow: 0 0 40px rgba(0,0,0,0.05); background: white; }
        .dark body { background: linear-gradient(135deg, #070b14 0%, #0f172a 100%); }
        .dark .min-h-screen { background: #0a1128; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .dark .glass-card { background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.05); }
        
        .month-item { transition: all 0.2s ease; }
        .month-item:hover { transform: translateY(-2px); }
        
        /* Custom Checkbox */
        .checkbox-wrapper-31:hover .check { stroke-dashoffset: 0; }
        .checkbox-wrapper-31 { position: relative; display: inline-block; width: 40px; height: 40px; }
        .checkbox-wrapper-31 .background { fill: #ccc; transition: ease all 0.6s; -webkit-transition: ease all 0.6s; }
        .checkbox-wrapper-31 .stroke { fill: none; stroke: #fff; stroke-miterlimit: 10; stroke-width: 2px; stroke-dashoffset: 100; stroke-dasharray: 100; transition: ease all 0.6s; -webkit-transition: ease all 0.6s; }
        .checkbox-wrapper-31 .check { fill: none; stroke: #fff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px; stroke-dashoffset: 22; stroke-dasharray: 22; transition: ease all 0.6s; -webkit-transition: ease all 0.6s; }
        .checkbox-wrapper-31 input[type=checkbox] { position: absolute; width: 100%; height: 100%; left: 0; top: 0; margin: 0; opacity: 0; cursor: pointer; }
        .checkbox-wrapper-31 input[type=checkbox]:hover + svg .background { fill: #0077ff; }
        .checkbox-wrapper-31 input[type=checkbox]:checked + svg .background { fill: #0077ff; }
        .checkbox-wrapper-31 input[type=checkbox]:checked + svg .stroke { stroke-dashoffset: 0; }
        .checkbox-wrapper-31 input[type=checkbox]:checked + svg .check { stroke-dashoffset: 0; }
    </style>
</head>
<body class="text-slate-800 dark:text-slate-200">
    <div class="min-h-screen flex flex-col relative">
        <header class="sticky top-0 z-[60] bg-white/80 dark:bg-[#0a1128]/80 backdrop-blur-xl border-b border-gray-200 dark:border-white/20 shadow-sm px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="/" class="p-2 -ml-2 rounded-xl hover:bg-slate-100 dark:hover:bg-white/5 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Pengaturan Istikmal</h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Panel Admin Kalender Hijriyah</p>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-6">
            <div class="glass-card rounded-2xl p-6 mb-8 shadow-sm">
                <div class="flex flex-col gap-2 mb-6">
                    <h2 class="text-lg font-semibold flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        Informasi
                    </h2>
                    <p class="text-sm text-slate-600 dark:text-slate-300">
                        Centang bulan di bawah ini jika hasil sidang isbat Kemenag menetapkan bulan tersebut berbeda (membutuhkan Istikmal / mundur 1 hari) dari kalender standar.
                    </p>
                </div>
                
                <div id="loading" class="text-center py-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto mb-4"></div>
                    <p class="text-slate-500">Memuat data...</p>
                </div>
                
                <div id="months-container" class="grid gap-3 hidden">
                    <!-- Data will be populated by JS -->
                </div>

                <div class="mt-8 flex justify-end hidden" id="save-container">
                    <button id="btn-save" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-xl shadow-lg shadow-blue-500/30 transition-all flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </main>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-6 right-6 translate-y-[150%] transition-transform duration-300 z-[100]">
        <div class="bg-slate-800 text-white px-6 py-3 rounded-xl shadow-2xl flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span id="toast-msg">Berhasil disimpan</span>
        </div>
    </div>

    <script>
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        let currentData = {};

        function showToast(msg) {
            $('#toast-msg').text(msg);
            $('#toast').removeClass('translate-y-[150%]');
            setTimeout(() => $('#toast').addClass('translate-y-[150%]'), 3000);
        }

        $(document).ready(function() {
            // Load data
            $.get('/api/istikmal', function(res) {
                if(res.ok) {
                    currentData = res.data.offsets || {};
                    renderMonths();
                }
            });

            function renderMonths() {
                $('#loading').hide();
                const container = $('#months-container');
                container.empty();
                
                const now = new Date();
                let year = now.getFullYear();
                let month = now.getMonth() + 1; // 1-based
                
                // Show current month and next 11 months
                for(let i = 0; i < 12; i++) {
                    const key = `${year}-${month}`;
                    const isChecked = currentData[key] === -1;
                    
                    const html = `
                        <div class="month-item flex items-center justify-between p-4 rounded-xl border border-slate-200 dark:border-white/10 bg-slate-50/50 dark:bg-slate-800/50">
                            <div class="flex flex-col">
                                <span class="font-bold text-lg">${monthNames[month-1]} ${year}</span>
                                <span class="text-xs text-slate-500 font-mono">Key: ${key}</span>
                            </div>
                            <div class="checkbox-wrapper-31">
                              <input type="checkbox" class="istikmal-cb" data-key="${key}" ${isChecked ? 'checked' : ''}/>
                              <svg viewBox="0 0 35.6 35.6">
                                <circle class="background" cx="17.8" cy="17.8" r="17.8"></circle>
                                <circle class="stroke" cx="17.8" cy="17.8" r="14.37"></circle>
                                <polyline class="check" points="11.78 18.12 15.55 22.23 25.17 12.87"></polyline>
                              </svg>
                            </div>
                        </div>
                    `;
                    container.append(html);
                    
                    month++;
                    if(month > 12) {
                        month = 1;
                        year++;
                    }
                }
                
                container.removeClass('hidden');
                $('#save-container').removeClass('hidden');
            }

            $('#btn-save').click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div> Menyimpan...');
                btn.prop('disabled', true);

                const newOffsets = {};
                $('.istikmal-cb').each(function() {
                    const key = $(this).data('key');
                    if($(this).is(':checked')) {
                        newOffsets[key] = -1;
                    }
                });

                $.ajax({
                    url: '/api/istikmal/update',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ offsets: newOffsets }),
                    success: function(res) {
                        if(res.ok) {
                            showToast("Pengaturan Istikmal berhasil disimpan!");
                        }
                    },
                    complete: function() {
                        btn.html(originalText);
                        btn.prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>
