<!doctype html>
<html lang="id" dir="auto">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mafatihul Akhyar SPA</title>
  <link rel="icon" href="logo.png" type="image/png" />
  <link rel="stylesheet" href="/assets/css/app.css?v=3" />
  <style>
    .template-container { display: none; }
    body { display: flex; justify-content: center; }
    body > #app { max-width: 860px; width: 100%; min-height: 100vh; position: relative; margin: 0 auto; }
  </style>
</head>
<body>
  <div id="app">Memuat...</div>

  <div class="template-container">

<template id="tpl-home">

  <div id="app">
    <header class="sticky top-0 z-[60] bg-white/80 dark:bg-[#0a1128]/80 backdrop-blur-xl border-b border-gray-200 dark:border-white/10 px-3 py-3 transition-colors duration-300">
      <div class="max-w-[860px] mx-auto flex items-center justify-between relative gap-4">
        
        <!-- Kiri: Logo & Judul -->
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 shrink-0">
            <img src="logo.png" alt="Logo" class="w-full h-full object-contain rounded-xl shadow-md shadow-brand/20">
          </div>
          <div class="font-extrabold text-lg sm:text-2xl tracking-tight text-gray-900 dark:text-white hidden sm:block">
            Mafatihul Akhyar
          </div>
        </div>

        <!-- Tengah: Pencarian -->
        <div class="flex-1 max-w-sm relative group">
          <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 21l-4.3-4.3" stroke-linecap="round"/><circle cx="11" cy="11" r="7"/></svg>
          </div>
          <input id="q" placeholder="Cari doa..." class="w-full bg-gray-100 dark:bg-white/5 border border-transparent dark:border-white/10 rounded-full py-2 pl-10 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-brand/50 focus:bg-white dark:focus:bg-[#0a1128] transition-all text-gray-900 dark:text-white placeholder-gray-500" />
          <button id="clearBtn" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200" hidden>✕</button>
        </div>

        <!-- Kanan: Menu & Tema -->
        <div class="flex items-center gap-2 shrink-0">
          <div id="loader" hidden><div class="w-5 h-5 border-2 border-gray-300 border-l-brand rounded-full animate-spin"></div></div>
          
          <!-- Desktop Nav -->
          <div class="hidden md:flex items-center gap-4 mr-2 text-sm font-semibold text-gray-600 dark:text-gray-300">
            <a href="/" data-link class="hover:text-brand transition-colors">Beranda</a>
            <a href="/saran" data-link class="hover:text-brand transition-colors">Saran</a>
            <a href="/tentang" data-link class="hover:text-brand transition-colors">Tentang</a>
            <a href="/admin" data-link class="hover:text-brand transition-colors">Admin</a>
            <a href="/privasi" data-link class="hover:text-brand transition-colors">Privasi</a>
          </div>

          <button id="toggleThemeTop" class="w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-gray-200 dark:hover:bg-white/10 transition-colors active:scale-95" title="Tema">
            🌓
          </button>
          <button id="hamburger" class="md:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-gray-200 dark:hover:bg-white/10 transition-colors active:scale-95" title="Menu">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
          </button>
        </div>
      </div>

      <!-- Kategori + Bookmark bar -->
      <div class="mt-3 max-w-[860px] mx-auto overflow-x-auto no-scrollbar flex items-center gap-2 pb-1" id="tabs"></div>
      <div class="max-w-[860px] mx-auto overflow-x-auto no-scrollbar flex items-center gap-2 mb-1" id="bmList"></div>
    </header>

    <main class="wrap">
      <section id="list" class="grid" style="grid-template-columns:1fr;"></section>
    </main>

    <footer class="wrap">© <span id="year"></span> Mafatihul Akhyar</footer>
  </div>

  <!-- Drawer -->
  <div class="fixed inset-0 bg-black/60 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300 z-[70]" id="shade"></div>
  <nav class="fixed top-0 right-0 h-full w-[340px] max-w-[90vw] bg-white dark:bg-[#0a1128] border-l border-gray-200 dark:border-white/10 translate-x-full transition-transform duration-300 z-[80] flex flex-col" id="drawer">
    <header class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-white/10">
      <div class="font-bold text-gray-900 dark:text-white">Menu Navigasi</div>
      <button class="w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-gray-200 dark:hover:bg-white/10 transition-colors active:scale-95 text-gray-600 dark:text-gray-300" id="closeDrawer" aria-label="Tutup">✕</button>
    </header>

    <div class="flex-1 overflow-auto p-4">
      <div class="grid gap-2">
        <a class="flex items-center gap-3 p-3 rounded-xl bg-gradient-to-br from-brand/10 to-blue-500/10 border border-brand/30 hover:border-brand/50 text-brand font-semibold transition-all" href="/download" data-link>📲 Download Aplikasi</a>
        <a class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-brand/5 hover:border-brand/30 transition-all font-medium text-gray-800 dark:text-gray-200" href="/admin" data-link>🛡️ Halaman Admin</a>
        <a class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-brand/5 hover:border-brand/30 transition-all font-medium text-gray-800 dark:text-gray-200" href="/saran" data-link>💡 Saran & Usulan</a>
        <a class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-brand/5 hover:border-brand/30 transition-all font-medium text-gray-800 dark:text-gray-200" href="/tentang" data-link>ℹ️ Tentang Aplikasi</a>
        <a class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-brand/5 hover:border-brand/30 transition-all font-medium text-gray-800 dark:text-gray-200" href="/kontak" data-link>✉️ Kontak Kami</a>
        <a class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-brand/5 hover:border-brand/30 transition-all font-medium text-gray-800 dark:text-gray-200" href="/privasi" data-link>📜 Kebijakan Privasi</a>
        
        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-white/10">
          <div class="flex items-center gap-3 p-3 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-500/20 cursor-pointer font-medium transition-all" id="clearAllPos">🧽 Bersihkan semua posisi</div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Template item doa -->
  <template id="tpl-doa">
    <details class="doa group bg-white dark:bg-[#0a1128] border border-gray-200 dark:border-white/10 rounded-2xl overflow-hidden hover:border-brand/40 dark:hover:border-brand/30 hover:shadow-lg hover:shadow-brand/5 transition-all duration-300 mb-3">
      <summary class="list-none p-4 cursor-pointer flex items-center justify-between gap-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
        <div class="ttl flex-1 font-semibold text-[15px] text-gray-800 dark:text-gray-100 leading-tight"></div>
        <span class="resume-badge hidden text-[11px] px-3 py-1 rounded-full border border-brand text-brand bg-brand/10 font-semibold whitespace-nowrap">Lanjutkan</span>
        <div class="actions flex flex-wrap gap-2 justify-end">
          <button class="icon bookmark w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-brand/10 hover:border-brand/30 hover:text-brand transition-colors active:scale-95" title="Simpan penanda">🔖</button>
          <button class="icon share w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-brand/10 hover:border-brand/30 hover:text-brand transition-colors active:scale-95" title="Bagikan">📤</button>
          <button class="icon copy w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-brand/10 hover:border-brand/30 hover:text-brand transition-colors active:scale-95" title="Salin teks">📋</button>
        </div>
      </summary>
      <div class="body p-4 bg-gray-50/50 dark:bg-black/20 border-t border-gray-100 dark:border-white/5">
        <div class="arabic txt-ar font-['Noto_Naskh_Arabic','Amiri',serif] text-right text-gray-900 dark:text-gray-100" style="direction: rtl;"></div>
      </div>
    </details>
  </template>

  <!-- MODAL -->
  <div class="modalShade fixed inset-0 bg-black/60 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300 z-[100]" id="modalShade" aria-hidden="true"></div>
  <div class="modal fixed inset-0 flex flex-col bg-white dark:bg-[#0a1128] translate-y-4 opacity-0 transition-all duration-300 z-[110] pointer-events-none" id="modal" aria-hidden="true">
    <header class="p-4 border-b border-gray-200 dark:border-white/10 bg-white dark:bg-[#0a1128]">
      <div class="titleWrap flex items-center justify-center">
        <div class="ttl font-extrabold text-lg text-gray-900 dark:text-white text-center max-w-[90vw] truncate tracking-tight" id="modalTitle">Judul Doa</div>
      </div>
    </header>
    <div class="toolsRow flex items-center justify-center gap-2 p-3 border-b border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-[#0a1128] flex-wrap">
      <button class="iconbtn px-4 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors active:scale-95 shadow-sm" id="markPos" title="Simpan posisi terakhir (baris terakhir dibaca)">📌 Simpan</button>
      <button class="iconbtn px-4 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors active:scale-95 shadow-sm" id="clearPos" title="Hapus posisi terakhir (penanda Lanjutkan)">🧹 Hapus</button>
      <div class="w-px h-6 bg-gray-300 dark:bg-white/10 mx-1 hidden sm:block"></div>
      <button class="iconbtn w-10 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors active:scale-95 shadow-sm font-bold" id="fontMinus" title="Perkecil">A−</button>
      <button class="iconbtn w-10 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors active:scale-95 shadow-sm font-bold" id="fontPlus" title="Perbesar">A+</button>
      <div class="w-px h-6 bg-gray-300 dark:bg-white/10 mx-1 hidden sm:block"></div>
      <button class="iconbtn w-10 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors active:scale-95 shadow-sm" id="toggleThemeModal" title="Mode gelap/terang">🌓</button>
      <button class="iconbtn w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-500/20 transition-colors active:scale-95 shadow-sm" id="closeModal" title="Tutup">✕</button>
    </div>
    <div class="resumeBar hidden items-center justify-center gap-2 p-3 border-b border-dashed border-gray-300 dark:border-white/20 text-sm text-gray-500 dark:text-gray-400 flex-wrap" id="resumeBar">
      Ada posisi terakhir tersimpan. 
      <button class="btn px-4 py-1.5 rounded-lg border border-brand text-brand bg-brand/10 hover:bg-brand/20 transition-colors font-semibold" id="resumeBtn">Lanjutkan Membaca</button>
    </div>
    <div class="body flex-1 overflow-auto p-4 sm:p-6 bg-white dark:bg-black/20" id="modalBody">
      <div class="arabic-modal font-['Noto_Naskh_Arabic','Amiri',serif] text-right text-gray-900 dark:text-gray-100" style="direction: rtl;" id="modalArabic"></div>
    </div>
  </div>

  <!-- TOAST -->
  <div class="toast" id="toast" role="status" aria-live="polite"></div>

  <script>
(() => {
    const APP_TITLE = "Mafatihul Akhyar";
    const DATA_URL = "./data.json";

    let DOA = [];
    let KAT = ["Semua"];
    const state = { q:"", kat:"Semua", bookmarks:new Set(JSON.parse(localStorage.getItem('bm')||'[]')) };
    let currentDoa = null;

    const list = document.getElementById('list');
    const tpl = document.getElementById('tpl-doa');
    const tabs = document.getElementById('tabs');
    const bmList = document.getElementById('bmList');
    const toastEl = document.getElementById('toast');
    const loader = document.getElementById('loader');

    const modalShade = document.getElementById('modalShade');
    const modal = document.getElementById('modal');
    const modalTitle = document.getElementById('modalTitle');
    const modalArabic = document.getElementById('modalArabic');
    const modalBody = document.getElementById('modalBody');
    const closeModalBtn = document.getElementById('closeModal');
    const toggleThemeModal = document.getElementById('toggleThemeModal');
    const fontPlus = document.getElementById('fontPlus');
    const fontMinus = document.getElementById('fontMinus');
    const markPosBtn = document.getElementById('markPos');
    const clearPosBtn = document.getElementById('clearPos');
    const resumeBar = document.getElementById('resumeBar');
    const resumeBtn = document.getElementById('resumeBtn');

    let toastTimer;
    function toast(msg){
      toastEl.textContent = msg;
      toastEl.classList.add('show');
      clearTimeout(toastTimer);
      toastTimer = setTimeout(()=>toastEl.classList.remove('show'), 2000);
    }

    function setTheme(t){
      const theme = (t === 'light') ? 'light' : 'dark';
      document.documentElement.setAttribute('data-theme', theme);
      const meta = document.querySelector('meta[name="theme-color"]');
      if (meta) meta.setAttribute('content', theme==='light' ? '#ffffff' : '#0f172a');
      try{ localStorage.setItem('theme', theme); }catch{}
    }
    setTheme(localStorage.getItem('theme') || 'dark');
    document.getElementById('toggleThemeTop')?.addEventListener('click', () => {
      const cur = document.documentElement.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
      setTheme(cur);
    });

    function showLoader(show){ if(loader) loader.hidden = !show; }
    function readCachedData(maxAgeMs = Infinity){
      try{
        const cached = JSON.parse(localStorage.getItem('doa_cache') || 'null');
        if(!cached || !Array.isArray(cached.data)) return [];
        const age = Date.now() - Number(cached.ts || 0);
        if(age > maxAgeMs) return [];
        return cached.data.filter(d=>String(d?.aktif ?? 'TRUE').toUpperCase()!=='FALSE');
      }catch{
        return [];
      }
    }
    function parseCats(raw){ if(!raw) return []; return String(raw).split(',').map(s=>s.trim()).filter(Boolean); }
    function makeLink(id){ return `${location.origin}${location.pathname}?id=${encodeURIComponent(id)}`; }
    function copyFullText(text){
      return new Promise((resolve,reject)=>{
        try{
          if(navigator.clipboard?.writeText){ navigator.clipboard.writeText(text).then(resolve,reject); }
          else{
            const ta=document.createElement('textarea'); ta.value=text; ta.style.position='fixed'; ta.style.left='-9999px';
            document.body.appendChild(ta); ta.focus(); ta.select(); const ok=document.execCommand('copy');
            document.body.removeChild(ta); ok?resolve():reject(new Error('execCommand failed'));
          }
        }catch(e){ reject(e); }
      });
    }
    function getParam(name){ return new URL(location.href).searchParams.get(name); }
    function pushModalURL(id){ const u=new URL(location.href); u.searchParams.set('id', id); history.pushState({modal:true,id}, '', u.toString()); }
    function replaceWithoutId(){ const u=new URL(location.href); u.searchParams.delete('id'); history.replaceState(null,'',u.toString()); }
    function getFsModal(){ return parseFloat(localStorage.getItem('fs_modal') || getComputedStyle(document.documentElement).getPropertyValue('--fsModal')) || 1.1; }
    function setFsModal(v){ document.documentElement.style.setProperty('--fsModal', v); localStorage.setItem('fs_modal', v); }
    function formatArabicEveryLine(raw){
      const text = String(raw||'').replace(/\r\n?/g,'\n');
      const container = document.createElement('div');
      text.split('\n').forEach(l=>{
        const seg = document.createElement('div'); seg.className = 'seg';
        seg.textContent = l || '\u00A0'; container.appendChild(seg);
      });
      return container.innerHTML;
    }

    function saveBM(){ localStorage.setItem('bm', JSON.stringify([...state.bookmarks])); drawBM(); }
    function drawBM(){
      bmList.innerHTML = '';
      if(!state.bookmarks.size){
        bmList.innerHTML = '<span class="empty">Belum ada penanda.</span>';
        return;
      }
      state.bookmarks.forEach(id=>{
        const d = DOA.find(x=>x.id===id); if(!d) return;
        const b = document.createElement('button');
        b.className = 'bm';
        b.textContent = '🔖 ' + (d.judul||'Tanpa judul');
        b.onclick = ()=> openDoaFull(d);
        bmList.appendChild(b);
      });
    }

    async function fetchData(force=false){
      showLoader(true);
      try{
        if(!force){
          const cachedData = readCachedData(60_000); // cache 1 menit
          if(cachedData.length){
            DOA = cachedData;
            rebuildTabs(); render(); openFromQuery();
            return;
          }
        }

        const r = await fetch(DATA_URL);
        if(!r.ok) throw new Error('Gagal memuat data.json');
        const json = await r.json();
        const arr = Array.isArray(json?.data) ? json.data
                  : Array.isArray(json) ? json : [];
        DOA = arr.filter(d=>String(d?.aktif ?? 'TRUE').toUpperCase()!=='FALSE');
        localStorage.setItem('doa_cache', JSON.stringify({ts:Date.now(), data:DOA}));
        rebuildTabs(); render(); openFromQuery();
      }catch(e){
        console.error(e);

        const staleData = readCachedData();
        if(staleData.length){
          DOA = staleData;
          rebuildTabs(); render(); openFromQuery();
          toast('Gagal memuat data terbaru. Menampilkan data tersimpan.');
          return;
        }

        list.innerHTML = '';
        const err = document.createElement('div');
        err.className='card';
        err.innerHTML = 'Tidak dapat memuat data. <button class="btn" id="retry">Coba lagi</button>';
        list.appendChild(err);
        document.getElementById('retry').onclick = ()=> { fetchData(true); };
      } finally {
        showLoader(false);
      }
    }

    function rebuildTabs(){
      tabs.innerHTML='';
      const set = new Set();
      DOA.forEach(d => parseCats(d.kategori).forEach(k => set.add(k)));
      KAT = ["Semua", ...Array.from(set)];
      KAT.forEach(k=>{
        const b = document.createElement('button');
        b.className='chip'; b.textContent=k || 'Tanpa Kategori';
        b.onclick=()=>{ state.kat=k; [...tabs.children].forEach(x=>x.classList.remove('active')); b.classList.add('active'); render(); };
        if(k===state.kat) b.classList.add('active');
        tabs.appendChild(b);
      });
      drawBM();
    }

    function render(){
      list.innerHTML = '';
      const q = state.q.trim().toLowerCase();
      const data = DOA.filter(d => {
        const cats = parseCats(d.kategori);
        const inCat = (state.kat==='Semua') || cats.includes(state.kat);
        const inText = !q || String(d.judul||'').toLowerCase().includes(q) || String(d.arab||'').includes(q);
        return inCat && inText;
      }).sort((a, b) => String(a.judul || '').localeCompare(String(b.judul || '')));

      data.forEach(d=>{
        const node = tpl.content.cloneNode(true);
        const summary = node.querySelector('summary');
        const badge = node.querySelector('.resume-badge');
        const container = node.querySelector('details.doa');
        container.dataset.id = d.id;

        const saved = parseInt(localStorage.getItem('pos_'+d.id)||'0', 10);
        if(saved>0){ badge.hidden = false; }

        summary.addEventListener('click', (ev)=>{
          if(ev.target.closest('.actions')) return;
          ev.preventDefault(); ev.stopPropagation();
          openDoaFull(d);
        }, {passive:false});

        node.querySelector('.ttl').textContent = d.judul || '(Tanpa judul)';
        node.querySelector('.txt-ar').innerHTML = formatArabicEveryLine(d.arab||'');

        node.querySelector('.bookmark').onclick = (e)=>{ 
          e.stopPropagation(); 
          state.bookmarks.has(d.id)?state.bookmarks.delete(d.id):state.bookmarks.add(d.id); 
          saveBM(); 
          toast(state.bookmarks.has(d.id)?'Ditambahkan ke penanda.':'Dihapus dari penanda.');
        };
        node.querySelector('.copy').onclick = async (e)=>{ 
          e.stopPropagation(); 
          const full = `${d.judul||''}\n${String(d.arab||'').replace(/\r\n?/g,'\n')}\n\n${makeLink(d.id)}`;
          try{ await copyFullText(full); toast('Teks doa lengkap tersalin ✔️'); }
          catch(err){ console.error(err); toast('Gagal menyalin. Tahan-tekan lalu salin manual.'); }
        };
        node.querySelector('.share').onclick = async (e)=>{ 
          e.stopPropagation(); 
          const link = makeLink(d.id);
          try{
            await copyFullText(`${d.judul||''}\n${String(d.arab||'').replace(/\r\n?/g,'\n')}\n\n${link}`);
            if(navigator.share){
              try{ await navigator.share({ title: d.judul || 'Doa', text: d.judul || 'Doa', url: link }); toast('Link dibagikan. Teks lengkap sudah disalin ✔️'); }
              catch{ toast('Teks lengkap disalin. Jika share dibatalkan, tempel manual di aplikasi.'); }
            }else{
              toast('Teks lengkap disalin. Bagikan link ini: ' + link);
            }
          }catch(err){
            console.error(err);
            if(navigator.share){ try{ await navigator.share({ title: d.judul || 'Doa', text: d.judul || 'Doa', url: link }); }catch{} }
            toast('Share link dikirim. (Salin teks manual bila perlu)');
          }
        };

        list.appendChild(node);
      });

      if(!data.length){
        const empty=document.createElement('div');
        empty.className='card';
        empty.textContent='Tidak ada hasil.';
        list.appendChild(empty);
      }
    }

    /* Drawer */
    const drawer=document.getElementById('drawer'), shade=document.getElementById('shade');
    document.getElementById('hamburger').onclick=()=>{drawer.classList.add('open');shade.classList.add('show');};
    document.getElementById('closeDrawer').onclick=()=>{drawer.classList.remove('open');shade.classList.remove('show');};
    shade.onclick=()=>{drawer.classList.remove('open');shade.classList.remove('show');};
    document.getElementById('clearAllPos')?.addEventListener('click', () => {
      drawer.classList.remove('open');
      shade.classList.remove('show');
      Object.keys(localStorage).forEach(k => { if (k.startsWith('pos_')) localStorage.removeItem(k); });
      document.querySelectorAll('.resume-badge').forEach(b => b.setAttribute('hidden',''));
      toast('Semua posisi terakhir dihapus 🧽');
    });

    function openDoaFull(d){
      currentDoa = d;
      modalTitle.textContent = d.judul || 'Doa';
      modalArabic.innerHTML = formatArabicEveryLine(d.arab||'');
      modalShade.classList.add('show');
      modal.classList.add('show');
      modal.setAttribute('aria-hidden','false');
      setFsModal(getFsModal());
      pushModalURL(d.id);

      const saved = parseInt(localStorage.getItem('pos_'+d.id)||'0', 10);
      if(saved>0){
        resumeBar.classList.add('show');
        resumeBtn.onclick = () => {
          modalBody.scrollTop = saved;
          toast('Dilanjutkan ke posisi terakhir.');
          const badgeSel = document.querySelector(`details.doa[data-id="${d.id}"] .resume-badge`);
          if (badgeSel) { badgeSel.setAttribute('hidden',''); }
        };
      }else{
        resumeBar.classList.remove('show');
        resumeBtn.onclick = null;
      }
    }
    function hideModalUI(){
      modalShade.classList.remove('show');
      modal.classList.remove('show');
      modal.setAttribute('aria-hidden','true');
      currentDoa = null;
      resumeBar.classList.remove('show');
      resumeBtn.onclick = null;
    }
    function closeDoaFull(){
      if(history.state && history.state.modal){ history.back(); }
      else{ hideModalUI(); replaceWithoutId(); }
    }

    modalShade?.addEventListener('click', closeDoaFull);
    closeModalBtn?.addEventListener('click', closeDoaFull);
    toggleThemeModal?.addEventListener('click', () => {
      const cur = document.documentElement.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
      setTheme(cur);
    });
    fontPlus?.addEventListener('click', () => { setFsModal(Math.min(1.8, getFsModal() + 0.06)); });
    fontMinus?.addEventListener('click', () => { setFsModal(Math.max(0.8, getFsModal() - 0.06)); });

    markPosBtn.onclick = () => {
      if(!currentDoa) return;
      const key = 'pos_' + currentDoa.id;
      localStorage.setItem(key, String(modalBody.scrollTop));
      toast('Posisi terakhir disimpan 📌');
      resumeBar.classList.add('show');
      resumeBtn.onclick = () => { modalBody.scrollTop = parseInt(localStorage.getItem(key)||'0',10); toast('Dilanjutkan ke posisi terakhir.'); };
      const badgeSel = document.querySelector(`details.doa[data-id="${currentDoa.id}"] .resume-badge`);
      if (badgeSel) { badgeSel.removeAttribute('hidden'); }
    };
    clearPosBtn.onclick = () => {
      if (!currentDoa) return;
      const key = 'pos_' + currentDoa.id;
      localStorage.removeItem(key);
      toast('Posisi terakhir dihapus 🧹');
      resumeBar.classList.remove('show');
      resumeBtn.onclick = null;
      const badgeSel = document.querySelector(`details.doa[data-id="${currentDoa.id}"] .resume-badge`);
      if (badgeSel) { badgeSel.setAttribute('hidden',''); }
    };

    window.addEventListener('keydown', (e)=>{ if(e.key === 'Escape' && modal.classList.contains('show')){ e.preventDefault(); closeDoaFull(); } });
    window.addEventListener('popstate', ()=>{ if(modal.classList.contains('show')) hideModalUI(); });

    function openFromQuery(){
      const id = getParam('id'); if(!id) return;
      const d = DOA.find(x=>String(x.id)===String(id)); if(!d) return;
      replaceWithoutId(); openDoaFull(d);
    }

    /* SEARCH */
    const searchInput = document.getElementById('q');
    const clearBtn = document.getElementById('clearBtn');
    if (searchInput){
      searchInput.addEventListener('input',(e)=>{
        state.q = e.target.value;
        if (clearBtn) clearBtn.hidden = !state.q;
        render();
      });
    }
    clearBtn?.addEventListener('click', ()=>{
      if (!searchInput) return;
      searchInput.value = '';
      state.q = '';
      clearBtn.hidden = true;
      render();
    });

    const titleEl = document.querySelector('.title');
    if (titleEl) titleEl.textContent = APP_TITLE;
    
    const yearEl = document.getElementById('year');
    if (yearEl) yearEl.textContent = new Date().getFullYear();
    
    fetchData();


})();
  </script>

  <!-- Floating Download Button -->
  <a class="dl-float" href="download.html" title="Download Aplikasi Android">
    <svg viewBox="0 0 24 24" fill="none"><path d="M12 2v13m0 0l-4-4m4 4l4-4M4 17v2a2 2 0 002 2h12a2 2 0 002-2v-2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    Download App
  </a>

  <script>
    if ('serviceWorker' in navigator && location.protocol.startsWith('http')) {
      window.addEventListener('load', () => {
        navigator.serviceWorker.register('./sw.js?v=13', { scope: './' })
          .catch(console.error);
      });
    }
  </script>

</template>

<template id="tpl-admin">

<div class="max-w-[860px] mx-auto p-4 sm:p-6 pb-12 pt-6">

  <!-- Hero Section -->
  <section class="mb-8 p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-brand/10 to-blue-500/10 border border-brand/20 relative overflow-hidden flex flex-col sm:flex-row items-center gap-6 sm:justify-between text-center sm:text-left">
    <div class="flex flex-col sm:flex-row items-center gap-6">
      <div class="w-16 h-16 sm:w-20 sm:h-20 shrink-0">
        <img src="logo.png" alt="Logo" class="w-full h-full object-contain rounded-2xl shadow-lg shadow-brand/20">
      </div>
      <div>
        <div class="text-sm font-bold tracking-widest text-brand uppercase mb-1">Panel Pengelola</div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white mb-2">Admin Doa &amp; Wirid</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">Tambah, lihat, dan hapus bacaan. Data disimpan di <code>data.json</code>.</p>
      </div>
    </div>
    <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-2">
      <a href="/admin-saran" data-link class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white dark:bg-white/10 border border-gray-200 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-white/20 transition-all font-semibold text-sm text-gray-700 dark:text-gray-200 shadow-sm whitespace-nowrap">
        ✉️ Kelola Saran &amp; Request &rarr;
      </a>
      <a href="/kalender" data-link class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white dark:bg-white/10 border border-gray-200 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-white/20 transition-all font-semibold text-sm text-brand shadow-sm whitespace-nowrap border-brand/20">
        📅 Kelola Kalender &rarr;
      </a>
      <a href="/" data-link class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white dark:bg-white/10 border border-gray-200 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-white/20 transition-all font-semibold text-sm text-gray-700 dark:text-gray-200 shadow-sm whitespace-nowrap">
        &larr; Home
      </a>
    </div>
  </section>

  <!-- Add Form Card -->
  <div class="bg-white dark:bg-[#0a1128] border border-gray-200 dark:border-white/10 rounded-2xl p-6 sm:p-8 mb-8 shadow-sm">
    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
      <span class="text-brand text-2xl leading-none">+</span> Tambah Bacaan Baru
    </h2>
    <form id="addForm" class="grid gap-5">
      <div>
        <label for="fId" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">ID Unik <span class="text-gray-500 font-normal text-xs">(huruf, angka, strip. Cth: doa-pagi)</span></label>
        <input id="fId" name="id" placeholder="doa-pagi" autocomplete="off" required class="w-full bg-gray-50 dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand/50 transition-all">
      </div>
      <div>
        <label for="fJudul" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Judul Bacaan</label>
        <input id="fJudul" name="judul" placeholder="Doa Pagi" required class="w-full bg-gray-50 dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand/50 transition-all">
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Kategori</label>
        <div class="bg-gray-50 dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-xl p-3 focus-within:ring-2 focus-within:ring-brand/50 transition-all">
          <div class="flex flex-wrap gap-2 mb-2 empty:hidden" id="fKatChips"></div>
          <input id="fKat" name="kategori" placeholder="Ketik kategori, pisahkan dengan koma..." autocomplete="off" class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm text-gray-900 dark:text-white placeholder-gray-500">
        </div>
        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Klik chip di atas atau ketik baru. Contoh: Doa Harian, Wirid</p>
      </div>
      <div>
        <label for="fArab" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Teks Arab / Bacaan</label>
        <textarea id="fArab" name="arab" placeholder="اكتب النص هنا..." required class="w-full min-h-[120px] bg-gray-50 dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-xl px-4 py-3 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand/50 transition-all font-['Noto_Naskh_Arabic','Amiri',serif] text-xl sm:text-2xl text-right resize-y leading-relaxed" style="direction: rtl;"></textarea>
      </div>
      <button type="submit" class="mt-2 w-full sm:w-auto bg-brand hover:bg-emerald-600 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg shadow-brand/30 active:scale-95 flex items-center justify-center gap-2">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
        Simpan ke JSON
      </button>
      <div id="addMsg" aria-live="polite" class="text-sm font-medium empty:hidden mt-2"></div>
    </form>
  </div>

  <!-- List Card -->
  <div class="bg-white dark:bg-[#0a1128] border border-gray-200 dark:border-white/10 rounded-2xl p-6 sm:p-8 shadow-sm">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
      <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
        <span class="text-2xl leading-none">📋</span> Semua Entri
      </h2>
      <span id="countBadge" class="bg-brand/10 text-brand border border-brand/20 font-semibold px-3 py-1.5 rounded-xl text-sm whitespace-nowrap w-max">0 entri</span>
    </div>
    
    <div class="relative mb-6">
      <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 21l-4.3-4.3" stroke-linecap="round"/><circle cx="11" cy="11" r="7"/></svg>
      </div>
      <input id="searchInput" placeholder="Cari judul atau ID..." autocomplete="off" class="w-full bg-gray-50 dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-xl py-3 pl-12 pr-4 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand/50 transition-all placeholder-gray-500">
    </div>

    <div id="entryList" class="grid gap-3">
      <div class="flex justify-center p-8"><div class="w-8 h-8 border-4 border-gray-200 border-l-brand rounded-full animate-spin"></div></div>
    </div>
  </div>

</div>

<!-- Modal Edit -->
<div id="editShade" class="fixed inset-0 bg-black/60 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300 z-[100] flex items-center justify-center p-4 sm:p-6">
  <div id="editModalBox" class="w-full max-w-2xl max-h-full bg-white dark:bg-[#0a1128] rounded-2xl flex flex-col opacity-0 scale-95 transition-all duration-300 shadow-2xl overflow-hidden" onclick="event.stopPropagation()">
    <div class="flex flex-col h-full">
    <div class="modal-head flex items-center justify-between p-4 sm:p-5 border-b border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/5">
      <h3 class="font-bold text-lg text-gray-900 dark:text-white flex items-center gap-2">
        <span class="text-xl">✏️</span> Edit Entri
      </h3>
      <button id="editClose" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-red-50 hover:text-red-500 hover:border-red-200 dark:hover:bg-red-500/10 dark:hover:border-red-500/30 transition-colors active:scale-95 text-gray-500 dark:text-gray-400">✕</button>
    </div>
    
    <div class="modal-body flex-1 overflow-auto p-4 sm:p-6 grid gap-5">
      <div>
        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">ID <span class="text-brand font-normal">(tidak bisa diubah)</span></label>
        <input id="eId" readonly class="w-full bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-2.5 text-gray-500 dark:text-gray-400 cursor-not-allowed">
      </div>
      <div>
        <label for="eJudul" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Judul Bacaan</label>
        <input id="eJudul" placeholder="Judul" required class="w-full bg-gray-50 dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand/50 transition-all">
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Kategori</label>
        <div class="bg-gray-50 dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-xl p-3 focus-within:ring-2 focus-within:ring-brand/50 transition-all">
          <div class="flex flex-wrap gap-2 mb-2 empty:hidden" id="eKatChips"></div>
          <input id="eKat" placeholder="Ketik kategori, pisahkan dengan koma..." autocomplete="off" class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm text-gray-900 dark:text-white placeholder-gray-500">
        </div>
        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Klik chip di atas atau ketik baru. Contoh: Doa Harian, Wirid</p>
      </div>
      <div>
        <label for="eArab" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Teks Arab / Bacaan</label>
        <textarea id="eArab" required class="w-full min-h-[220px] bg-gray-50 dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-xl px-4 py-3 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand/50 transition-all font-['Noto_Naskh_Arabic','Amiri',serif] text-xl sm:text-2xl text-right resize-y leading-relaxed" style="direction: rtl;"></textarea>
      </div>
      <div id="editMsg" aria-live="polite" class="text-sm font-medium empty:hidden"></div>
    </div>
    
    <div class="modal-foot p-4 border-t border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/5 flex gap-3 justify-end">
      <button id="editCancel" class="px-5 py-2.5 rounded-xl border border-gray-300 dark:border-white/20 bg-white dark:bg-transparent hover:bg-gray-100 dark:hover:bg-white/10 text-gray-700 dark:text-gray-300 font-semibold transition-all active:scale-95">Batal</button>
      <button id="editSave" class="px-6 py-2.5 rounded-xl bg-brand hover:bg-emerald-600 text-white font-bold transition-all shadow-lg shadow-brand/30 active:scale-95">Simpan Perubahan</button>
    </div>
  </div>
</div>

<div class="toast" id="toast"></div>

<script>
(() => {
  const API = '/api/data';
  let allEntries = [];
  let toastTimer;

  /* ─── Kategori helpers ───────────────────────────────────────────────── */
  function getUniqueCats() {
    const set = new Set();
    allEntries.forEach(d => {
      (d.kategori || '').split(',').map(s => s.trim()).filter(Boolean).forEach(c => set.add(c));
    });
    return [...set].sort((a, b) => a.localeCompare(b, 'id'));
  }

  function buildKatPicker(chipsId, inputId) {
    const chipsEl = document.getElementById(chipsId);
    const inputEl = document.getElementById(inputId);
    if (!chipsEl || !inputEl) return;

    const allCats = getUniqueCats();

    function getSelected() {
      return inputEl.value.split(',').map(s => s.trim()).filter(Boolean);
    }

    function render() {
      const sel = getSelected();
      chipsEl.innerHTML = '';
      allCats.forEach(cat => {
        const chip = document.createElement('span');
        chip.className = 'kat-chip' + (sel.includes(cat) ? ' on' : '');
        chip.textContent = cat;
        chip.onclick = () => {
          let cur = getSelected();
          if (cur.includes(cat)) {
            cur = cur.filter(c => c !== cat);
          } else {
            cur.push(cat);
          }
          inputEl.value = cur.join(', ');
          render();
        };
        chipsEl.appendChild(chip);
      });
    }

    render();
    // Sync chip highlight saat user mengetik manual
    inputEl.addEventListener('input', render);
  }

  function toast(msg) {
    const el = document.getElementById('toast');
    el.textContent = msg;
    el.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => el.classList.remove('show'), 2800);
  }

  function esc(str) {
    return String(str ?? '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

  function renderList(entries) {
    const container = document.getElementById('entryList');
    document.getElementById('countBadge').textContent = allEntries.length + ' entri';
    if (!entries.length) {
      container.innerHTML = '<div class="empty-state">Tidak ada entri.</div>';
      return;
    }
    container.innerHTML = '';
    const grid = document.createElement('div');
    grid.className = 'entry-list';
    entries.forEach(d => {
      const row = document.createElement('div');
      row.className = 'entry';
      const cats = (d.kategori || '').split(',').map(s => s.trim()).filter(Boolean);
      const catHtml = cats.map(c => '<span class="cat">' + esc(c) + '</span>').join('');
      row.innerHTML =
        '<div class="entry-info">' +
          '<div class="entry-title">' + esc(d.judul || '(Tanpa judul)') + '</div>' +
          '<div class="entry-meta">ID: <code>' + esc(d.id) + '</code>' +
            (catHtml ? '<br>' + catHtml : '') +
          '</div>' +
        '</div>' +
        '<div class="entry-actions">' +
          '<button class="btn-edit">&#x270F; Edit</button>' +
          '<button class="btn-del">&#x1F5D1; Hapus</button>' +
        '</div>';
      row.querySelector('.btn-edit').onclick = () => openEditModal(d);
      row.querySelector('.btn-del').onclick = () => deleteEntry(d.id, row);
      grid.appendChild(row);
    });
    container.appendChild(grid);
  }

  function filterAndRender() {
    const q = document.getElementById('searchInput').value.trim().toLowerCase();
    const filtered = q
      ? allEntries.filter(d => String(d.judul || '').toLowerCase().includes(q) || String(d.id || '').toLowerCase().includes(q))
      : allEntries;
    renderList(filtered);
  }

  async function loadEntries() {
    try {
      const r = await fetch(API);
      if (!r.ok) throw new Error('HTTP ' + r.status);
      const j = await r.json();
      allEntries = Array.isArray(j.data) ? j.data : [];
      filterAndRender();
      buildKatPicker('fKatChips', 'fKat');
      buildKatPicker('eKatChips', 'eKat');
    } catch (e) {
      document.getElementById('entryList').innerHTML =
        '<div class="empty-state">Gagal memuat data. Pastikan /api/data tersedia di server.</div>';
    }
  }

  document.getElementById('addForm').onsubmit = async (e) => {
    e.preventDefault();
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    const msg = document.getElementById('addMsg');
    const fd = new FormData(form);
    const payload = Object.assign({ action: 'add' }, Object.fromEntries(fd.entries()));
    msg.className = '';
    msg.textContent = 'Menyimpan...';
    btn.disabled = true;
    try {
      const r = await fetch(API + '/add', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      });
      const j = await r.json();
      if (!j.ok) throw new Error(j.error || 'Gagal');
      msg.className = 'ok';
      msg.textContent = 'Berhasil ditambah!';
      form.reset();
      await loadEntries();
      buildKatPicker('fKatChips', 'fKat');
      toast('Entri baru berhasil ditambah');
    } catch (err) {
      msg.className = 'err';
      msg.textContent = 'Gagal: ' + (err.message || 'Terjadi kesalahan');
    } finally {
      btn.disabled = false;
    }
  };

  async function deleteEntry(id, rowEl) {
    if (!confirm('Hapus entri "' + id + '"?\nTindakan ini tidak dapat dibatalkan.')) return;
    const btn = rowEl.querySelector('.btn-del');
    btn.disabled = true;
    btn.textContent = '...';
    try {
      const r = await fetch(API + '/delete', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id })
      });
      const j = await r.json();
      if (!j.ok) throw new Error(j.error || 'Gagal');
      allEntries = allEntries.filter(d => d.id !== id);
      filterAndRender();
      toast('Entri "' + id + '" berhasil dihapus.');
    } catch (err) {
      btn.disabled = false;
      btn.textContent = 'Hapus';
      toast('Gagal menghapus: ' + err.message);
    }
  }

  /* ─── Modal Edit ──────────────────────────────────────────────────────── */
  const editShade  = document.getElementById('editShade');
  const editBox    = document.getElementById('editModalBox');
  const editClose  = document.getElementById('editClose');
  const editCancel = document.getElementById('editCancel');
  const editSave   = document.getElementById('editSave');
  const editMsg    = document.getElementById('editMsg');
  let editingId    = null;

  function openEditModal(d) {
    editingId = d.id;
    document.getElementById('eId').value    = d.id;
    document.getElementById('eJudul').value = d.judul || '';
    document.getElementById('eKat').value   = d.kategori || '';
    document.getElementById('eArab').value  = d.arab || '';
    editMsg.textContent = '';
    editMsg.className = '';
    buildKatPicker('eKatChips', 'eKat');
    
    editShade.classList.remove('opacity-0', 'pointer-events-none');
    editShade.classList.add('opacity-100', 'pointer-events-auto');
    editBox.classList.remove('opacity-0', 'scale-95');
    editBox.classList.add('opacity-100', 'scale-100');
  }

  function closeEditModal() {
    editShade.classList.remove('opacity-100', 'pointer-events-auto');
    editShade.classList.add('opacity-0', 'pointer-events-none');
    editBox.classList.remove('opacity-100', 'scale-100');
    editBox.classList.add('opacity-0', 'scale-95');
    editingId = null;
  }

  editClose.onclick = closeEditModal;
  editCancel.onclick = closeEditModal;
  editShade.addEventListener('click', (e) => { if (e.target === editShade) closeEditModal(); });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeEditModal(); });

  editSave.onclick = async () => {
    const judul    = document.getElementById('eJudul').value.trim();
    const kategori = document.getElementById('eKat').value.trim();
    const arab     = document.getElementById('eArab').value.trim();

    if (!judul || !arab) {
      editMsg.className = 'err';
      editMsg.textContent = 'Judul dan teks doa tidak boleh kosong.';
      return;
    }

    editMsg.className = '';
    editMsg.textContent = 'Menyimpan...';
    editSave.disabled = true;

    try {
      const r = await fetch(API + '/update', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: editingId, judul, kategori, arab })
      });
      const j = await r.json();
      if (!j.ok) throw new Error(j.error || 'Gagal');

      // update lokal tanpa reload
      const idx = allEntries.findIndex(d => d.id === editingId);
      if (idx !== -1) {
        allEntries[idx] = { ...allEntries[idx], judul, kategori, arab };
      }
      filterAndRender();
      buildKatPicker('fKatChips', 'fKat');
      toast('Entri "' + editingId + '" berhasil diupdate.');
      closeEditModal();
    } catch (err) {
      editMsg.className = 'err';
      editMsg.textContent = 'Gagal: ' + err.message;
    } finally {
      editSave.disabled = false;
    }
  };

  document.getElementById('searchInput').addEventListener('input', filterAndRender);
  loadEntries();
})();
</script>

</template>

<template id="tpl-admin-saran">

<div class="max-w-[860px] mx-auto p-4 sm:p-6 pb-12 pt-6">

  <!-- Hero Section -->
  <section class="mb-8 p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-brand/10 to-blue-500/10 border border-brand/20 relative overflow-hidden flex flex-col sm:flex-row items-center gap-6 sm:justify-between text-center sm:text-left">
    <div class="flex flex-col sm:flex-row items-center gap-6">
      <div class="w-16 h-16 sm:w-20 sm:h-20 shrink-0">
        <img src="logo.png" alt="Logo" class="w-full h-full object-contain rounded-2xl shadow-lg shadow-brand/20">
      </div>
      <div>
        <div class="text-sm font-bold tracking-widest text-brand uppercase mb-1">Panel Pengelola</div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white mb-2">Feedback &amp; Usulan</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">Baca dan kelola masukan dari pengguna (Saran & Usulan).</p>
      </div>
    </div>
    <div class="mt-4 sm:mt-0 flex gap-2">
      <a href="/admin" data-link class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white dark:bg-white/10 border border-gray-200 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-white/20 transition-all font-semibold text-sm text-gray-700 dark:text-gray-200 shadow-sm whitespace-nowrap">
        &larr; Kelola Doa
      </a>
    </div>
  </section>

  <!-- Tabs -->
  <div class="flex flex-wrap gap-2 mb-6" id="saranTabs">
    <button class="tab-btn px-5 py-2.5 rounded-xl font-semibold transition-all active:scale-95 bg-brand text-white shadow-lg shadow-brand/30" onclick="switchTab('usulan', this)">💬 Usulan</button>
    <button class="tab-btn px-5 py-2.5 rounded-xl font-semibold transition-all active:scale-95 bg-white dark:bg-[#0a1128] text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-white/5" onclick="switchTab('request', this)">📖 Request Kitab</button>
    <button class="tab-btn px-5 py-2.5 rounded-xl font-semibold transition-all active:scale-95 bg-white dark:bg-[#0a1128] text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-white/5" onclick="switchTab('kirim_file', this)">📁 Kiriman File</button>
  </div>

  <!-- List Card -->
  <div class="bg-white dark:bg-[#0a1128] border border-gray-200 dark:border-white/10 rounded-2xl p-6 sm:p-8 shadow-sm">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
      <h2 id="tabTitle" class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
        <span class="text-2xl leading-none">💬</span> Data Usulan
      </h2>
      <span id="countBadge" class="bg-brand/10 text-brand border border-brand/20 font-semibold px-3 py-1.5 rounded-xl text-sm whitespace-nowrap w-max">0 entri</span>
    </div>

    <div id="entryList" class="grid gap-4">
      <div class="flex justify-center p-8"><div class="w-8 h-8 border-4 border-gray-200 border-l-brand rounded-full animate-spin"></div></div>
    </div>
  </div>

</div>

<!-- Modal Balas -->
<div id="replyShade" class="modal-shade fixed inset-0 bg-black/60 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300 z-[100]"></div>
<div class="modal-box fixed inset-0 sm:inset-auto sm:top-1/2 sm:left-1/2 sm:-translate-x-1/2 sm:-translate-y-1/2 sm:w-[90vw] sm:max-w-lg sm:max-h-[90vh] bg-white dark:bg-[#0a1128] sm:rounded-2xl flex flex-col opacity-0 translate-y-4 sm:translate-y-8 transition-all duration-300 z-[110] pointer-events-none shadow-2xl overflow-hidden">
  <div class="modal-inner flex flex-col h-full">
    <div class="modal-head flex items-center justify-between p-4 sm:p-5 border-b border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/5">
      <h3 class="font-bold text-lg text-gray-900 dark:text-white flex items-center gap-2">
        <span class="text-xl">✉️</span> Balas ke User
      </h3>
      <button id="replyClose" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-red-50 hover:text-red-500 hover:border-red-200 dark:hover:bg-red-500/10 dark:hover:border-red-500/30 transition-colors active:scale-95 text-gray-500 dark:text-gray-400">✕</button>
    </div>
    
    <div class="modal-body flex-1 overflow-auto p-4 sm:p-6 grid gap-5">
      <div>
        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Kirim Balasan Kepada:</label>
        <div id="replyToInfo" class="bg-gray-100 dark:bg-white/5 rounded-xl px-4 py-2.5 text-gray-900 dark:text-white font-bold border border-gray-200 dark:border-white/10"></div>
      </div>
      <div>
        <label for="rMessage" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Isi Pesan Balasan</label>
        <textarea id="rMessage" placeholder="Tuliskan pesan balasan Anda di sini..." class="w-full min-h-[160px] bg-gray-50 dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-xl px-4 py-3 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand/50 transition-all resize-y leading-relaxed"></textarea>
      </div>
      <div id="replyMsg" aria-live="polite" class="text-sm font-medium empty:hidden"></div>
    </div>
    
    <div class="modal-foot p-4 border-t border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/5 flex gap-3 justify-end">
      <button id="replyCancel" class="px-5 py-2.5 rounded-xl border border-gray-300 dark:border-white/20 bg-white dark:bg-transparent hover:bg-gray-100 dark:hover:bg-white/10 text-gray-700 dark:text-gray-300 font-semibold transition-all active:scale-95">Batal</button>
      <button id="replySave" class="px-6 py-2.5 rounded-xl bg-brand hover:bg-emerald-600 text-white font-bold transition-all shadow-lg shadow-brand/30 active:scale-95 flex items-center gap-2">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
        Kirim Email
      </button>
    </div>
  </div>
</div>

<div class="toast" id="toast"></div>

<script>
(() => {
  const API = '/api/saran';
  let currentType = 'usulan';
  let allEntries = [];
  let toastTimer;

  function toast(msg) {
    const el = document.getElementById('toast');
    el.textContent = msg;
    el.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => el.classList.remove('show'), 2800);
  }

  function esc(str) {
    return String(str ?? '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

  function renderList(entries) {
    const container = document.getElementById('entryList');
    document.getElementById('countBadge').textContent = entries.length + ' entri';
    
    if (!entries.length) {
      container.innerHTML = '<div class="empty-state">Tidak ada entri.</div>';
      return;
    }
    
    container.innerHTML = '';
    const grid = document.createElement('div');
    grid.className = 'entry-list';
    
    entries.forEach(d => {
      const row = document.createElement('div');
      row.className = 'entry';
      
      const emailText = d.email ? ` | ${esc(d.email)}` : ' | (Tidak ada email)';
      const statusHtml = (d.status === 'replied') 
        ? '<span class="status-badge status-replied">&#10004; Dibalas</span>' 
        : '<span class="status-badge status-pending">Menunggu</span>';
        
      const content = esc(d.pesan || d.request || '');
      
      let fileHtml = '';
      if (currentType === 'kirim_file' && d.file_name) {
        fileHtml = `<a href="uploads/${esc(d.file_name)}" class="entry-file" target="_blank">&#128190; Download: ${esc(d.file_name)}</a>`;
      }
      
      row.innerHTML = `
        <div class="entry-head">
          <div>
            <div class="entry-title">${esc(d.nama)} ${statusHtml}</div>
            <div class="entry-meta">${esc(d.tanggal || d.waktu || '')}${emailText}</div>
          </div>
        </div>
        <div class="entry-body">${content}</div>
        ${fileHtml}
        <div class="entry-actions">
          <button class="btn-reply" ${!d.email ? 'disabled title="Email tidak tersedia"' : ''}>&#x2709; Balas Email</button>
          <button class="btn-del">&#x1F5D1; Hapus</button>
        </div>
      `;
      
      const btnReply = row.querySelector('.btn-reply');
      if(d.email) {
          btnReply.onclick = () => openReplyModal(d);
      }
      row.querySelector('.btn-del').onclick = () => deleteEntry(d.id, row);
      
      grid.appendChild(row);
    });
    container.appendChild(grid);
  }

  async function loadEntries() {
    const container = document.getElementById('entryList');
    container.innerHTML = '<div class="spinner-wrap"><div class="spinner"></div></div>';
    
    try {
      const r = await fetch(`${API}?action=read&type=${currentType}`);
      if (!r.ok) throw new Error('HTTP ' + r.status);
      const j = await r.json();
      allEntries = Array.isArray(j.data) ? j.data : [];
      renderList(allEntries);
    } catch (e) {
      container.innerHTML = '<div class="empty-state">Gagal memuat data.</div>';
    }
  }

  function switchTab(type, btn) {
    document.querySelectorAll('.tab').forEach(el => el.classList.remove('active'));
    btn.classList.add('active');
    currentType = type;
    
    const titles = {
        'usulan': '&#128172; Data Usulan',
        'request': '&#128214; Data Request Kitab',
        'kirim_file': '&#128193; Data Kiriman File'
    };
    document.getElementById('tabTitle').innerHTML = titles[type];
    
    loadEntries();
  }
  
  window.switchTab = switchTab; // Expose to global for inline onclick handler

  async function deleteEntry(id, rowEl) {
    if (!confirm('Hapus entri ini secara permanen?')) return;
    const btn = rowEl.querySelector('.btn-del');
    btn.disabled = true;
    btn.textContent = '...';
    try {
      const r = await fetch(API + '/delete', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'delete', type: currentType, id: id })
      });
      const j = await r.json();
      if (!j.ok) throw new Error(j.error || 'Gagal');
      allEntries = allEntries.filter(d => d.id !== id);
      renderList(allEntries);
      toast('Entri berhasil dihapus.');
    } catch (err) {
      btn.disabled = false;
      btn.textContent = 'Hapus';
      toast('Gagal menghapus: ' + err.message);
    }
  }

  /* ─── Modal Balas ──────────────────────────────────────────────────────── */
  const replyShade  = document.getElementById('replyShade');
  const replyClose  = document.getElementById('replyClose');
  const replyCancel = document.getElementById('replyCancel');
  const replySave   = document.getElementById('replySave');
  const replyMsg    = document.getElementById('replyMsg');
  let replyingId    = null;

  function openReplyModal(d) {
    replyingId = d.id;
    document.getElementById('replyToInfo').textContent = `${d.nama} (${d.email})`;
    document.getElementById('rMessage').value = '';
    replyMsg.textContent = '';
    replyMsg.className = '';
    replyShade.classList.add('show');
  }

  function closeReplyModal() {
    replyShade.classList.remove('show');
    replyingId = null;
  }

  replyClose.onclick = closeReplyModal;
  replyCancel.onclick = closeReplyModal;
  replyShade.addEventListener('click', (e) => { if (e.target === replyShade) closeReplyModal(); });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeReplyModal(); });

  replySave.onclick = async () => {
    const message = document.getElementById('rMessage').value.trim();
    if (!message) {
      replyMsg.className = 'err';
      replyMsg.textContent = 'Pesan balasan tidak boleh kosong.';
      return;
    }

    replyMsg.className = '';
    replyMsg.textContent = 'Mengirim email...';
    replySave.disabled = true;

    try {
      const r = await fetch(API, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'reply', type: currentType, id: replyingId, message: message })
      });
      const j = await r.json();
      if (!j.ok) throw new Error(j.error || 'Gagal mengirim email');

      const idx = allEntries.findIndex(d => d.id === replyingId);
      if (idx !== -1) {
        allEntries[idx].status = 'replied';
      }
      renderList(allEntries);
      toast('Balasan berhasil dikirim.');
      closeReplyModal();
    } catch (err) {
      replyMsg.className = 'err';
      replyMsg.textContent = 'Gagal: ' + err.message;
    } finally {
      replySave.disabled = false;
    }
  };

  // Initial load
  loadEntries();
})();
</script>

</template>

<template id="tpl-kontak">

  <div class="max-w-[860px] mx-auto p-4 sm:p-6 pb-12 pt-6">
    <!-- Hero Section -->
    <section class="mb-8 p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-brand/10 to-blue-500/10 border border-brand/20 relative overflow-hidden flex flex-col sm:flex-row items-center gap-6 sm:justify-between text-center sm:text-left">
      <div class="flex flex-col sm:flex-row items-center gap-6">
        <div class="w-16 h-16 sm:w-20 sm:h-20 shrink-0">
          <img src="logo.png" alt="Logo" class="w-full h-full object-contain rounded-2xl shadow-lg shadow-brand/20">
        </div>
        <div>
          <div class="text-sm font-bold tracking-widest text-brand uppercase mb-1">Mafatihul Akhyar</div>
          <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white mb-2">Kontak Kami</h1>
          <p class="text-sm text-gray-600 dark:text-gray-400">Silakan hubungi kami melalui saluran resmi berikut.</p>
        </div>
      </div>
    </section>

    <!-- Content -->
    <div class="bg-white dark:bg-[#0a1128] border border-gray-200 dark:border-white/10 rounded-3xl p-6 sm:p-8 shadow-sm">
      <div class="grid sm:grid-cols-3 gap-6 mb-8">
        
        <!-- Email -->
        <a href="mailto:zenhkm@gmail.com" class="group flex flex-col items-center text-center p-6 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:border-brand/40 hover:shadow-lg hover:shadow-brand/5 transition-all">
          <div class="w-14 h-14 bg-brand/10 text-brand rounded-full flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
            📧
          </div>
          <strong class="text-gray-900 dark:text-white font-bold mb-1">Email</strong>
          <span class="text-sm text-gray-600 dark:text-gray-400 group-hover:text-brand transition-colors">zenhkm@gmail.com</span>
        </a>

        <!-- Telepon -->
        <a href="tel:085743399595" class="group flex flex-col items-center text-center p-6 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:border-brand/40 hover:shadow-lg hover:shadow-brand/5 transition-all">
          <div class="w-14 h-14 bg-brand/10 text-brand rounded-full flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
            📞
          </div>
          <strong class="text-gray-900 dark:text-white font-bold mb-1">Telepon</strong>
          <span class="text-sm text-gray-600 dark:text-gray-400 group-hover:text-brand transition-colors">085743399595</span>
        </a>

        <!-- WhatsApp -->
        <a href="https://wa.me/6285743399595" target="_blank" rel="noopener" class="group flex flex-col items-center text-center p-6 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:border-brand/40 hover:shadow-lg hover:shadow-brand/5 transition-all">
          <div class="w-14 h-14 bg-green-500/10 text-green-500 rounded-full flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
            💬
          </div>
          <strong class="text-gray-900 dark:text-white font-bold mb-1">WhatsApp</strong>
          <span class="text-sm text-gray-600 dark:text-gray-400 group-hover:text-green-500 transition-colors">Chat Sekarang</span>
        </a>
      </div>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-6 border-t border-gray-200 dark:border-white/10">
        <a class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-brand/10 hover:border-brand/30 hover:text-brand font-semibold text-gray-700 dark:text-gray-300 transition-all text-center" href="/saran" data-link>💡 Beri Saran</a>
        <a class="w-full sm:w-auto px-6 py-3 rounded-xl bg-brand hover:bg-emerald-600 text-white font-bold transition-all shadow-lg shadow-brand/30 active:scale-95 text-center" href="/download" data-link>📲 Download Aplikasi</a>
      </div>
    </div>
  </div>

</template>

<template id="tpl-saran">

  <div class="max-w-[860px] mx-auto p-4 sm:p-6 pb-12 pt-6">
    <!-- Hero Section -->
    <section class="mb-8 p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-brand/10 to-blue-500/10 border border-brand/20 relative overflow-hidden flex flex-col sm:flex-row items-center gap-6 sm:justify-between text-center sm:text-left">
      <div class="flex flex-col sm:flex-row items-center gap-6">
        <div class="w-16 h-16 sm:w-20 sm:h-20 shrink-0">
          <img src="logo.png" alt="Logo" class="w-full h-full object-contain rounded-2xl shadow-lg shadow-brand/20">
        </div>
        <div>
          <div class="text-sm font-bold tracking-widest text-brand uppercase mb-1">Mafatihul Akhyar</div>
          <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white mb-2">Bantuan & Dukungan</h1>
          <p class="text-sm text-gray-600 dark:text-gray-400">Pilih layanan yang Anda butuhkan di bawah ini.</p>
        </div>
      </div>
    </section>

    <!-- Tabs -->
    <div class="flex flex-wrap gap-2 mb-6" id="userFormTabs">
      <button class="user-tab-btn px-5 py-2.5 rounded-xl font-semibold transition-all active:scale-95 bg-brand text-white shadow-lg shadow-brand/30" onclick="switchUserTab('usulan', this)">💬 Usulan</button>
      <button class="user-tab-btn px-5 py-2.5 rounded-xl font-semibold transition-all active:scale-95 bg-white dark:bg-[#0a1128] text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-white/5" onclick="switchUserTab('request', this)">📖 Request Kitab</button>
      <button class="user-tab-btn px-5 py-2.5 rounded-xl font-semibold transition-all active:scale-95 bg-white dark:bg-[#0a1128] text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-white/5" onclick="switchUserTab('kirim_file', this)">📁 Kirim File</button>
    </div>

    <!-- Content -->
    <div class="bg-white dark:bg-[#0a1128] border border-gray-200 dark:border-white/10 rounded-3xl p-6 sm:p-8 shadow-sm">
      <div id="userFormAlert" class="hidden mb-6 px-4 py-3 rounded-xl font-medium border text-sm"></div>

      <form id="userSubmitForm" onsubmit="handleUserSubmit(event)" enctype="multipart/form-data">
        <input type="hidden" name="type" id="formType" value="usulan">

        <div class="grid sm:grid-cols-2 gap-5 mb-5">
          <div>
            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama <span class="text-brand">*</span></label>
            <input type="text" name="nama" required placeholder="Nama Anda" class="w-full bg-gray-50 dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand/50 transition-all">
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Email (Opsional)</label>
            <input type="email" name="email" placeholder="Email Anda" class="w-full bg-gray-50 dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand/50 transition-all">
          </div>
        </div>

        <div class="mb-5">
          <label id="pesanLabel" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Isi Usulan <span class="text-brand">*</span></label>
          <textarea name="pesan" id="pesanInput" required placeholder="Tuliskan usulan Anda..." class="w-full min-h-[160px] bg-gray-50 dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-xl px-4 py-3 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand/50 transition-all resize-y leading-relaxed"></textarea>
        </div>

        <div id="fileUploadContainer" class="mb-5 hidden">
          <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Unggah File (Max 5MB) <span class="text-brand">*</span></label>
          <input type="file" name="file" id="fileInput" class="w-full bg-gray-50 dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-xl px-4 py-2.5 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand/50 transition-all cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand/10 file:text-brand hover:file:bg-brand/20">
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-100 dark:border-white/5">
          <button type="submit" id="btnSubmitForm" class="px-6 py-3 rounded-xl bg-brand hover:bg-emerald-600 text-white font-bold transition-all shadow-lg shadow-brand/30 active:scale-95 flex items-center gap-2">
            Kirim Sekarang
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function switchUserTab(type, btn) {
      document.querySelectorAll('.user-tab-btn').forEach(b => {
        b.className = 'user-tab-btn px-5 py-2.5 rounded-xl font-semibold transition-all active:scale-95 bg-white dark:bg-[#0a1128] text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-white/5';
      });
      btn.className = 'user-tab-btn px-5 py-2.5 rounded-xl font-semibold transition-all active:scale-95 bg-brand text-white shadow-lg shadow-brand/30';
      
      document.getElementById('formType').value = type;
      
      const fileContainer = document.getElementById('fileUploadContainer');
      const fileInput = document.getElementById('fileInput');
      const pesanLabel = document.getElementById('pesanLabel');
      const pesanInput = document.getElementById('pesanInput');
      const alertBox = document.getElementById('userFormAlert');

      alertBox.classList.add('hidden');

      if (type === 'kirim_file') {
        fileContainer.classList.remove('hidden');
        fileInput.required = true;
        pesanLabel.innerHTML = 'Keterangan Tambahan <span class="text-brand">*</span>';
        pesanInput.placeholder = 'Tuliskan deskripsi file yang Anda kirim...';
      } else {
        fileContainer.classList.add('hidden');
        fileInput.required = false;
        if (type === 'request') {
          pesanLabel.innerHTML = 'Kitab yang Direquest <span class="text-brand">*</span>';
          pesanInput.placeholder = 'Sebutkan judul kitab, pengarang, atau detail lainnya...';
        } else {
          pesanLabel.innerHTML = 'Isi Usulan <span class="text-brand">*</span>';
          pesanInput.placeholder = 'Tuliskan usulan Anda...';
        }
      }
    }

    async function handleUserSubmit(e) {
      e.preventDefault();
      const form = e.target;
      const btn = document.getElementById('btnSubmitForm');
      const alertBox = document.getElementById('userFormAlert');
      
      btn.disabled = true;
      btn.innerHTML = '<div class="w-5 h-5 border-2 border-white/30 border-l-white rounded-full animate-spin"></div> Mengirim...';
      alertBox.className = 'hidden mb-6 px-4 py-3 rounded-xl font-medium border text-sm';
      
      try {
        const formData = new FormData(form);
        const res = await fetch('/api/saran/submit', {
          method: 'POST',
          body: formData
        });
        
        const data = await res.json();
        
        if (data.ok) {
          alertBox.textContent = data.message || 'Data berhasil dikirim!';
          alertBox.classList.add('bg-green-50', 'text-green-700', 'border-green-200', 'dark:bg-green-500/10', 'dark:border-green-500/20', 'dark:text-green-400');
          form.reset();
        } else {
          throw new Error(data.error || 'Terjadi kesalahan.');
        }
      } catch (err) {
        alertBox.textContent = err.message;
        alertBox.classList.add('bg-red-50', 'text-red-700', 'border-red-200', 'dark:bg-red-500/10', 'dark:border-red-500/20', 'dark:text-red-400');
      } finally {
        alertBox.classList.remove('hidden');
        btn.disabled = false;
        btn.innerHTML = 'Kirim Sekarang';
      }
    }

    // Auto-select tab based on hash
    const hash = window.location.hash.substring(1);
    if (hash === 'request' || hash === 'kirim_file' || hash === 'usulan') {
        const btn = document.querySelector(`.user-tab-btn[onclick*="${hash}"]`);
        if (btn) {
            switchUserTab(hash, btn);
        }
    }
  </script>

</template>

<template id="tpl-tentang">

  <div class="max-w-[860px] mx-auto p-4 sm:p-6 pb-12 pt-6">
    <!-- Hero Section -->
    <section class="mb-8 p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-brand/10 to-blue-500/10 border border-brand/20 relative overflow-hidden flex flex-col sm:flex-row items-center gap-6 sm:justify-between text-center sm:text-left">
      <div class="flex flex-col sm:flex-row items-center gap-6">
        <div class="w-16 h-16 sm:w-20 sm:h-20 shrink-0">
          <img src="logo.png" alt="Logo" class="w-full h-full object-contain rounded-2xl shadow-lg shadow-brand/20">
        </div>
        <div>
          <div class="text-sm font-bold tracking-widest text-brand uppercase mb-1">Mafatihul Akhyar</div>
          <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white mb-2">Tentang Aplikasi</h1>
          <p class="text-sm text-gray-600 dark:text-gray-400">Dirancang ringkas, cepat, dan nyaman digunakan di perangkat mobile.</p>
        </div>
      </div>
    </section>

    <div class="bg-white dark:bg-[#0a1128] border border-gray-200 dark:border-white/10 rounded-3xl p-6 sm:p-8 shadow-sm">
      <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">✨ Fitur Utama</h2>
      
      <div class="grid sm:grid-cols-2 gap-4 mb-8">
        <!-- Feature 1 -->
        <div class="flex items-start gap-4 p-5 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10">
          <div class="w-12 h-12 bg-brand/10 text-brand rounded-xl flex items-center justify-center text-xl shrink-0">🔍</div>
          <div>
            <h3 class="font-bold text-gray-900 dark:text-white mb-1">Pencarian Cepat</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Cari judul dan isi doa secara instan tanpa perlu memuat ulang.</p>
          </div>
        </div>
        <!-- Feature 2 -->
        <div class="flex items-start gap-4 p-5 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10">
          <div class="w-12 h-12 bg-brand/10 text-brand rounded-xl flex items-center justify-center text-xl shrink-0">📂</div>
          <div>
            <h3 class="font-bold text-gray-900 dark:text-white mb-1">Kategori & Bookmark</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Kelompokkan dan simpan bacaan favorit Anda di satu tempat.</p>
          </div>
        </div>
        <!-- Feature 3 -->
        <div class="flex items-start gap-4 p-5 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10">
          <div class="w-12 h-12 bg-brand/10 text-brand rounded-xl flex items-center justify-center text-xl shrink-0">📌</div>
          <div>
            <h3 class="font-bold text-gray-900 dark:text-white mb-1">Lanjutkan Bacaan</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Posisi baris terakhir membaca tersimpan otomatis, lanjutkan kapan saja.</p>
          </div>
        </div>
        <!-- Feature 4 -->
        <div class="flex items-start gap-4 p-5 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10">
          <div class="w-12 h-12 bg-brand/10 text-brand rounded-xl flex items-center justify-center text-xl shrink-0">📱</div>
          <div>
            <h3 class="font-bold text-gray-900 dark:text-white mb-1">Mobile & Offline</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Tampilan didesain untuk HP, aplikasi dapat diinstal dan dipakai tanpa internet.</p>
          </div>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-6 border-t border-gray-200 dark:border-white/10">
        <a class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-brand/10 hover:border-brand/30 hover:text-brand font-semibold text-gray-700 dark:text-gray-300 transition-all text-center" href="/" data-link>📖 Mulai Membaca</a>
        <a class="w-full sm:w-auto px-6 py-3 rounded-xl bg-brand hover:bg-emerald-600 text-white font-bold transition-all shadow-lg shadow-brand/30 active:scale-95 text-center" href="/download" data-link>📲 Download Aplikasi</a>
      </div>
    </div>
  </div>
  <footer class="text-center py-6 text-sm text-gray-500">© Mafatihul Akhyar</footer>

</template>

<template id="tpl-download">

  <div class="max-w-[860px] mx-auto p-4 sm:p-6 pb-12 pt-6">
    <!-- Hero -->
    <section class="mb-12 text-center flex flex-col items-center">
      <img src="logo.png" alt="Logo Mafatihul Akhyar" class="w-24 h-24 sm:w-32 sm:h-32 object-contain rounded-3xl shadow-xl shadow-brand/20 mb-6">
      <div class="text-sm font-bold tracking-widest text-brand uppercase mb-2">Aplikasi Android</div>
      <h1 class="text-3xl sm:text-5xl font-extrabold text-gray-900 dark:text-white mb-4 tracking-tight">Download <span class="text-brand">Buku Wirid</span></h1>
      <p class="text-gray-600 dark:text-gray-400 max-w-lg mb-8 text-lg">Baca wirid, doa, dan dzikir langsung dari HP Anda. Gratis, ringan, dan bekerja 100% offline.</p>
      
      <a href="https://play.google.com/store/apps/details?id=id.quizb.bukuwirid" target="_blank" rel="noopener" class="group relative inline-flex items-center justify-center gap-3 bg-gray-900 hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-100 dark:text-gray-900 text-white px-8 py-4 rounded-2xl transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1 active:scale-95">
        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor"><path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 01-.61-.92V2.734a1 1 0 01.609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.199-3.199l2.302 2.302c.6.348.6 1.032 0 1.38l-2.302 2.302-2.533-2.993 2.533-2.991zM5.864 2.658L16.8 9.283l-2.302 2.302L5.864 2.658z"/></svg>
        <div class="text-left">
          <div class="text-[10px] uppercase font-bold opacity-70 leading-none mb-1">Download Di</div>
          <div class="text-xl font-extrabold leading-none">Google Play</div>
        </div>
      </a>
    </section>

    <!-- Steps -->
    <div class="bg-white dark:bg-[#0a1128] border border-gray-200 dark:border-white/10 rounded-3xl p-6 sm:p-10 shadow-sm mb-12">
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white text-center mb-8">Cara Menginstal</h2>
      <div class="grid sm:grid-cols-3 gap-6 relative">
        <div class="hidden sm:block absolute top-6 left-10 right-10 h-0.5 bg-gray-200 dark:bg-white/10 z-0"></div>
        
        <div class="relative z-10 flex flex-col items-center text-center">
          <div class="w-12 h-12 rounded-full bg-brand text-white font-bold text-xl flex items-center justify-center mb-4 shadow-lg shadow-brand/30 border-4 border-white dark:border-[#0a1128]">1</div>
          <h3 class="font-bold text-gray-900 dark:text-white mb-2">Buka Google Play Store</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400">Tekan tombol di atas atau buka aplikasi Play Store di HP Anda.</p>
        </div>
        
        <div class="relative z-10 flex flex-col items-center text-center">
          <div class="w-12 h-12 rounded-full bg-brand text-white font-bold text-xl flex items-center justify-center mb-4 shadow-lg shadow-brand/30 border-4 border-white dark:border-[#0a1128]">2</div>
          <h3 class="font-bold text-gray-900 dark:text-white mb-2">Cari "Buku Wirid"</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400">Ketik "Buku Wirid" atau "Mafatihul Akhyar" di pencarian.</p>
        </div>
        
        <div class="relative z-10 flex flex-col items-center text-center">
          <div class="w-12 h-12 rounded-full bg-brand text-white font-bold text-xl flex items-center justify-center mb-4 shadow-lg shadow-brand/30 border-4 border-white dark:border-[#0a1128]">3</div>
          <h3 class="font-bold text-gray-900 dark:text-white mb-2">Instal & Buka</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400">Tekan "Instal", tunggu selesai, lalu aplikasi siap digunakan kapan saja.</p>
        </div>
      </div>
    </div>
  </div>

  <footer class="text-center py-6 text-sm text-gray-500">© Mafatihul Akhyar · <a href="/privasi" data-link class="text-brand hover:underline">Kebijakan Privasi</a></footer>

</template>

<template id="tpl-privasi">

  <div class="max-w-[860px] mx-auto p-4 sm:p-6 pb-12 pt-6">
    <!-- Hero Section -->
    <section class="mb-8 p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-brand/10 to-blue-500/10 border border-brand/20 relative overflow-hidden flex flex-col sm:flex-row items-center gap-6 sm:justify-between text-center sm:text-left">
      <div class="flex flex-col sm:flex-row items-center gap-6">
        <div class="w-16 h-16 sm:w-20 sm:h-20 shrink-0">
          <img src="logo.png" alt="Logo" class="w-full h-full object-contain rounded-2xl shadow-lg shadow-brand/20">
        </div>
        <div>
          <div class="text-sm font-bold tracking-widest text-brand uppercase mb-1">Mafatihul Akhyar</div>
          <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white mb-2">Kebijakan Privasi</h1>
          <p class="text-sm text-gray-600 dark:text-gray-400">Transparansi mengenai pengelolaan data dan privasi pengguna.</p>
        </div>
      </div>
    </section>

    <!-- Content -->
    <div class="bg-white dark:bg-[#0a1128] border border-gray-200 dark:border-white/10 rounded-3xl p-6 sm:p-8 shadow-sm">
      
      <div class="flex items-start gap-4 p-5 rounded-2xl bg-brand/5 border border-brand/20 mb-8">
        <div class="text-3xl">🔒</div>
        <div>
          <h2 class="font-bold text-gray-900 dark:text-white text-lg mb-2">Privasi Sangat Terjaga</h2>
          <ul class="list-disc pl-5 text-gray-700 dark:text-gray-300 space-y-2 leading-relaxed">
            <li>Tema, bookmark, dan posisi bacaan terakhir disimpan secara <strong class="text-brand">lokal</strong> di perangkat Anda (di dalam peramban / LocalStorage).</li>
            <li>Aplikasi kami <strong class="text-brand">tidak melacak</strong>, tidak ada iklan, dan tidak menyematkan analitik pihak ketiga.</li>
            <li>Seluruh konten aplikasi dibaca 100% offline dari sumber data aplikasi itu sendiri.</li>
          </ul>
        </div>
      </div>

      <div class="mb-8">
        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Penggunaan Data Lokal</h2>
        <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-4">
          Data preferensi Anda (mode gelap, riwayat posisi baca) <b>tidak pernah</b> dikirimkan ke server kami, murni dipakai hanya agar pengalaman membaca Anda menjadi lebih mulus saat membuka kembali aplikasi.
        </p>
        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Pencatatan Analitik (analytics.json)</h2>
        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
          Untuk keperluan pengembangan dan peningkatan aplikasi (khususnya versi Android), kami mengumpulkan data analitik anonim yang disimpan ke dalam file <code>analytics.json</code> di server kami. Data yang dicatat sebatas interaksi dasar seperti <b>halaman/doa yang dibuka (item_title), jenis aktivitas (action), dan alamat IP sementara</b>, tanpa mengumpulkan data pribadi yang bisa mengidentifikasi Anda secara spesifik. Data ini semata-mata digunakan oleh admin untuk memahami fitur apa yang paling sering digunakan oleh pengguna.
        </p>
      </div>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-6 border-t border-gray-200 dark:border-white/10">
        <a class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-brand/10 hover:border-brand/30 hover:text-brand font-semibold text-gray-700 dark:text-gray-300 transition-all text-center" href="/" data-link>📖 Buka Aplikasi</a>
        <a class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-brand/10 hover:border-brand/30 hover:text-brand font-semibold text-gray-700 dark:text-gray-300 transition-all text-center" href="/kontak" data-link>✉️ Hubungi Kami</a>
        <a class="w-full sm:w-auto px-6 py-3 rounded-xl bg-brand hover:bg-emerald-600 text-white font-bold transition-all shadow-lg shadow-brand/30 active:scale-95 text-center" href="/download" data-link>📲 Download Aplikasi</a>
      </div>
    </div>
  </div>
  <footer class="text-center py-6 text-sm text-gray-500">© Mafatihul Akhyar</footer>

</template>

  <?php include __DIR__ . '/kalender.html'; ?>

  </div>
  <script src="/assets/js/app.js?v=1.2"></script>
</body>
</html>
