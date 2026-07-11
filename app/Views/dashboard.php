<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard - Mafatihul Akhyar</title>
    <link rel="icon" href="/logo.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.tailwindcss.min.js"></script>
    <link rel="stylesheet" href="/assets/css/app.css?v=3">
    <style>
        body { display: flex; justify-content: center; }
        .min-h-screen { max-width: 860px; width: 100%; margin: 0 auto; box-shadow: 0 0 40px rgba(0,0,0,0.05); }
        body {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            min-height: 100vh;
        }
        .dark body {
            background: linear-gradient(135deg, #0a1128 0%, #1e293b 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .dark .glass-card {
            background: rgba(15, 23, 50, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
        }
        .dark .dataTables_wrapper .dataTables_length select,
        .dark .dataTables_wrapper .dataTables_filter input {
            background: rgba(15, 23, 50, 0.8);
            border-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 0.5rem;
            margin: 0 0.25rem;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #10b981 !important;
            color: white !important;
            border: none;
        }
    </style>
</head>
<body class="dark">
    <div class="min-h-screen p-4 md:p-8">
        <!-- Header -->
        <header class="mb-8">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <img src="/logo.png" alt="Logo" class="w-12 h-12 rounded-xl shadow-lg">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Analytics Dashboard</h1>
                        <p class="text-gray-600 dark:text-gray-400">Mafatihul Akhyar - Real-time Analytics</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button onclick="refreshData()" class="px-4 py-2 bg-brand text-white rounded-lg hover:bg-emerald-600 transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Refresh
                    </button>
                    <button onclick="toggleTheme()" class="w-10 h-10 rounded-lg glass-card flex items-center justify-center hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                        <span id="themeIcon">🌓</span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="statsCards">
                <div class="stat-card glass-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Visits</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2" id="totalVisits">-</p>
                        </div>
                        <div class="w-12 h-12 bg-brand/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="stat-card glass-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Unique Pages</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2" id="uniquePages">-</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="stat-card glass-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Actions</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2" id="totalActions">-</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="stat-card glass-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Today's Visits</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2" id="todayVisits">-</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Daily Visits Chart -->
                <div class="glass-card rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Daily Visits</h3>
                    <div class="h-64">
                        <canvas id="dailyChart"></canvas>
                    </div>
                </div>
                <!-- Hourly Visits Chart -->
                <div class="glass-card rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Hourly Distribution</h3>
                    <div class="h-64">
                        <canvas id="hourlyChart"></canvas>
                    </div>
                </div>
                <!-- Pages Chart -->
                <div class="glass-card rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Top Pages</h3>
                    <div class="h-64">
                        <canvas id="pagesChart"></canvas>
                    </div>
                </div>
                <!-- Actions Chart -->
                <div class="glass-card rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">User Actions</h3>
                    <div class="h-64">
                        <canvas id="actionsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="max-w-7xl mx-auto">
            <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Activity</h3>
                    <button onclick="clearAnalytics()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-sm">
                        Clear All Data
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table id="analyticsTable" class="w-full">
                        <thead>
                            <tr>
                                <th>Timestamp</th>
                                <th>Page</th>
                                <th>Action</th>
                                <th>IP Address</th>
                                <th>User Agent</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td colspan="5" class="text-center py-8 text-gray-500">Loading data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        let dailyChart, hourlyChart, pagesChart, actionsChart;
        let dataTable;

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            initCharts();
            loadStats();
            loadTableData();
            
            // Check for saved theme
            if (localStorage.getItem('theme') === 'light') {
                document.body.classList.remove('dark');
            }
        });

        function initCharts() {
            const chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.7)'
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.7)'
                        }
                    }
                }
            };

            // Daily Chart
            dailyChart = new Chart(document.getElementById('dailyChart'), {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Visits',
                        data: [],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: chartOptions
            });

            // Hourly Chart
            hourlyChart = new Chart(document.getElementById('hourlyChart'), {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Visits',
                        data: [],
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                        borderRadius: 8
                    }]
                },
                options: chartOptions
            });

            // Pages Chart
            pagesChart = new Chart(document.getElementById('pagesChart'), {
                type: 'doughnut',
                data: {
                    labels: [],
                    datasets: [{
                        data: [],
                        backgroundColor: [
                            '#10b981', '#3b82f6', '#8b5cf6', '#f59e0b', '#ef4444',
                            '#06b6d4', '#ec4899', '#84cc16'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right',
                            labels: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            }
                        }
                    }
                }
            });

            // Actions Chart
            actionsChart = new Chart(document.getElementById('actionsChart'), {
                type: 'pie',
                data: {
                    labels: [],
                    datasets: [{
                        data: [],
                        backgroundColor: [
                            '#10b981', '#3b82f6', '#8b5cf6', '#f59e0b', '#ef4444'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right',
                            labels: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            }
                        }
                    }
                }
            });
        }

        async function loadStats() {
            try {
                const response = await fetch('/api/dashboard/stats');
                const result = await response.json();
                
                if (result.ok) {
                    const stats = result.data;
                    
                    // Update stat cards
                    document.getElementById('totalVisits').textContent = stats.total_visits.toLocaleString();
                    document.getElementById('uniquePages').textContent = Object.keys(stats.unique_pages).length;
                    document.getElementById('totalActions').textContent = Object.values(stats.actions).reduce((a, b) => a + b, 0).toLocaleString();
                    
                    // Today's visits
                    const today = new Date().toISOString().split('T')[0];
                    document.getElementById('todayVisits').textContent = (stats.daily_visits[today] || 0).toLocaleString();
                    
                    // Update daily chart
                    updateChart(dailyChart, Object.keys(stats.daily_visits), Object.values(stats.daily_visits));
                    
                    // Update hourly chart
                    updateChart(hourlyChart, Object.keys(stats.hourly_visits), Object.values(stats.hourly_visits));
                    
                    // Update pages chart
                    const sortedPages = Object.entries(stats.unique_pages).sort((a, b) => b[1] - a[1]).slice(0, 8);
                    pagesChart.data.labels = sortedPages.map(p => p[0]);
                    pagesChart.data.datasets[0].data = sortedPages.map(p => p[1]);
                    pagesChart.update();
                    
                    // Update actions chart
                    actionsChart.data.labels = Object.keys(stats.actions);
                    actionsChart.data.datasets[0].data = Object.values(stats.actions);
                    actionsChart.update();
                }
            } catch (error) {
                console.error('Error loading stats:', error);
            }
        }

        function updateChart(chart, labels, data) {
            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.update();
        }

        async function loadTableData() {
            try {
                const response = await fetch('/api/dashboard/data?page=1&per_page=50');
                const result = await response.json();
                
                if (result.ok) {
                    const data = result.data.data;
                    
                    if (dataTable) {
                        dataTable.destroy();
                    }
                    
                    const tableBody = document.getElementById('tableBody');
                    tableBody.innerHTML = '';
                    
                    data.forEach(row => {
                        const tr = document.createElement('tr');
                        tr.className = 'border-b border-gray-200 dark:border-white/10';
                        tr.innerHTML = `
                            <td class="py-3 px-4 text-sm text-gray-900 dark:text-white">${row.timestamp || '-'}</td>
                            <td class="py-3 px-4 text-sm text-gray-900 dark:text-white">${row.page || row.item_title || row.type || '-'}</td>
                            <td class="py-3 px-4 text-sm">
                                <span class="px-2 py-1 bg-brand/20 text-brand rounded-full text-xs">${row.action || 'view'}</span>
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600 dark:text-gray-400">${row.ip || '-'}</td>
                            <td class="py-3 px-4 text-sm text-gray-600 dark:text-gray-400 max-w-xs truncate">${row.user_agent || row.keyword || '-'}</td>
                        `;
                        tableBody.appendChild(tr);
                    });
                    
                    // Initialize DataTables
                    dataTable = $('#analyticsTable').DataTable({
                        pageLength: 10,
                        lengthMenu: [10, 25, 50, 100],
                        order: [[0, 'desc']],
                        language: {
                            search: "Cari:",
                            lengthMenu: "Tampilkan _MENU_ data",
                            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                            paginate: {
                                first: "Pertama",
                                last: "Terakhir",
                                next: "Selanjutnya",
                                previous: "Sebelumnya"
                            }
                        }
                    });
                }
            } catch (error) {
                console.error('Error loading table data:', error);
            }
        }

        async function refreshData() {
            await loadStats();
            await loadTableData();
        }

        async function clearAnalytics() {
            if (confirm('Are you sure you want to clear all analytics data? This action cannot be undone.')) {
                try {
                    const response = await fetch('/api/dashboard/clear', {
                        method: 'POST'
                    });
                    const result = await response.json();
                    
                    if (result.ok) {
                        alert('Analytics data cleared successfully');
                        refreshData();
                    } else {
                        alert('Failed to clear analytics data');
                    }
                } catch (error) {
                    console.error('Error clearing analytics:', error);
                    alert('Error clearing analytics data');
                }
            }
        }

        function toggleTheme() {
            document.body.classList.toggle('dark');
            const isDark = document.body.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }
    </script>
</body>
</html>
