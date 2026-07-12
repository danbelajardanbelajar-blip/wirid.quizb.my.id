document.addEventListener("DOMContentLoaded", () => {
    const app = document.getElementById("app");
    
    function navigateTo(url) {
        history.pushState(null, null, url);
        router();
    }
    
    // Konfigurasi route mapping
    function router() {
        let path = location.pathname;
        let tplId = "tpl-home";
        
        if (path === "/admin" || path === "/admin-saran" || path === "/dashboard" || path === "/istikmal" || path === "/kalender") {
            if (sessionStorage.getItem('admin_logged') !== '1') {
                const pass = prompt("Masukkan password Admin:");
                if (pass === "123") {
                    sessionStorage.setItem('admin_logged', '1');
                } else {
                    alert("Password salah!");
                    history.replaceState(null, null, "/");
                    path = "/";
                }
            }
        }
        
        if (path === "/admin") tplId = "tpl-admin";
        else if (path === "/admin-saran") tplId = "tpl-admin-saran";
        else if (path === "/saran") tplId = "tpl-saran";
        else if (path === "/tentang") tplId = "tpl-tentang";
        else if (path === "/kontak") tplId = "tpl-kontak";
        else if (path === "/download") tplId = "tpl-download";
        else if (path === "/privasi") tplId = "tpl-privasi";
        else if (path === "/kalender") tplId = "tpl-kalender";
        else if (path === "/dashboard") tplId = "tpl-dashboard";
        else if (path === "/istikmal") tplId = "tpl-istikmal";
        
        const tpl = document.getElementById(tplId);
        if (tpl) {
            app.innerHTML = tpl.innerHTML;
            executeScripts(app);
        } else {
            app.innerHTML = "<div style='padding:40px;text-align:center;'><h1>404 Not Found</h1><p>Halaman tidak ditemukan.</p><a href='/' data-link>Kembali ke Home</a></div>";
        }
    }
    
    // Fungsi untuk mengeksekusi tag <script> secara berurutan agar dependensi eksternal (spt jQuery) selesai dimuat lebih dulu
    async function executeScripts(element) {
        const scripts = Array.from(element.querySelectorAll("script"));
        for (const oldScript of scripts) {
            await new Promise((resolve) => {
                const newScript = document.createElement("script");
                Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
                newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                
                if (newScript.src) {
                    newScript.onload = resolve;
                    newScript.onerror = resolve; // Lanjut jika gagal
                }
                
                oldScript.parentNode.replaceChild(newScript, oldScript);
                
                if (!newScript.src) {
                    resolve();
                }
            });
        }
    }

    // Intercept semua klik pada link internal
    document.body.addEventListener("click", e => {
        let node = e.target;
        while(node && node !== document.body) {
            // Jika itu adalah link (a tag) ke origin yang sama, dan bukan target blank
            if (node.tagName === 'A' && node.href.startsWith(window.location.origin) && node.target !== '_blank' && node.hasAttribute('data-link')) {
                e.preventDefault();
                navigateTo(node.href);
                break;
            }
            node = node.parentNode;
        }
    });

    window.addEventListener("popstate", router);
    
    // Render awal
    router();
});
