<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        :root {
            --primary-dark: #0a192f;
            --secondary-dark: #112240;
            --accent-blue: #64ffda;
            --accent-light-blue: #52d7f3;
            --text-primary: #e6f1ff;
            --text-secondary: #8892b0;
            --card-bg: #112240;
            --card-border: #233554;
            --gradient-blue: linear-gradient(135deg, #0ea5e9, #2563eb);
            --gradient-dark: linear-gradient(to bottom right, #0f172a, #1e293b);
            --shadow-light: rgba(100, 255, 218, 0.1);
            --shadow-medium: rgba(2, 12, 27, 0.7);
        }

        body {
            background: var(--gradient-dark);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(37, 99, 235, 0.15) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(100, 255, 218, 0.1) 0%, transparent 20%);
            z-index: -1;
        }

        /* MAIN CONTAINER */
        .app-main {
            padding: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* HEADER SECTION */
        .app-content-header {
            margin-bottom: 30px;
            padding: 20px 0;
            border-bottom: 1px solid rgba(100, 255, 218, 0.1);
        }

        .app-content-header h3 {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(90deg, var(--accent-blue), var(--accent-light-blue));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.5px;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: flex-end;
        }

        .breadcrumb-item {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .breadcrumb-item a {
            color: var(--accent-blue);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .breadcrumb-item a:hover {
            color: white;
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: var(--text-primary);
        }

        /* STATS GRID */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(17, 34, 64, 0.8);
            border-radius: 16px;
            border: 1px solid rgba(100, 255, 218, 0.15);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 160px;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border-color: rgba(100, 255, 218, 0.3);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient-blue);
            transition: height 0.3s ease;
        }

        .stat-card:hover::before {
            height: 6px;
        }

        /* Warna khusus untuk setiap stat card */
        .stat-card-primary::before { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
        .stat-card-success::before { background: linear-gradient(90deg, #10b981, #34d399); }
        .stat-card-info::before { background: linear-gradient(90deg, #0ea5e9, #38bdf8); }
        .stat-card-warning::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
        .stat-card-danger::before { background: linear-gradient(90deg, #ef4444, #f87171); }

        .stat-content {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
            color: white;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-secondary);
            font-weight: 500;
            flex: 1;
        }

        .stat-footer {
            padding: 15px 20px;
            background: rgba(30, 41, 59, 0.5);
            border-top: 1px solid rgba(100, 255, 218, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-link {
            color: var(--accent-blue);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .stat-link:hover {
            color: white;
            gap: 8px;
        }

        /* CHART SECTION */
        .chart-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-top: 40px;
        }

        @media (max-width: 992px) {
            .chart-section {
                grid-template-columns: 1fr;
            }
        }

        .chart-card {
            background: rgba(17, 34, 64, 0.8);
            border-radius: 16px;
            border: 1px solid rgba(100, 255, 218, 0.15);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            overflow: hidden;
        }

        .chart-header {
            padding: 20px 25px;
            border-bottom: 1px solid rgba(100, 255, 218, 0.1);
            background: rgba(30, 41, 59, 0.4);
        }

        .chart-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--accent-blue);
            letter-spacing: -0.3px;
        }

        .chart-body {
            padding: 25px;
            height: 300px;
            position: relative;
        }

        /* INFO CARD */
        .info-card {
            background: rgba(17, 34, 64, 0.8);
            border-radius: 16px;
            border: 1px solid rgba(100, 255, 218, 0.15);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .info-header {
            padding: 20px 25px;
            border-bottom: 1px solid rgba(100, 255, 218, 0.1);
            background: rgba(30, 41, 59, 0.4);
        }

        .info-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--accent-blue);
            letter-spacing: -0.3px;
        }

        .info-body {
            flex: 1;
            padding: 25px;
        }

        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-list li {
            padding: 12px 0;
            border-bottom: 1px solid rgba(100, 255, 218, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info-list li:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
        }

        .info-value {
            color: white;
            font-size: 15px;
            font-weight: 600;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .app-main {
                padding: 15px;
            }
            
            .app-content-header h3 {
                font-size: 24px;
            }
            
            .breadcrumb {
                justify-content: flex-start;
                margin-top: 10px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .stat-card {
                height: 140px;
            }
            
            .stat-value {
                font-size: 28px;
            }
            
            .chart-body {
                padding: 15px;
                height: 250px;
            }
            
            .info-body {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .app-content-header h3 {
                font-size: 22px;
            }
            
            .breadcrumb {
                flex-wrap: wrap;
            }
            
            .stat-card {
                height: 130px;
            }
            
            .stat-value {
                font-size: 24px;
            }
            
            .chart-body {
                height: 200px;
            }
        }
    </style>
</head>

<body>
    <main class="app-main">

        <!-- HEADER -->
        <div class="app-content-header">
            <div class="header-content">
                <h3>Dashboard</h3>
                <nav class="breadcrumb">
                    <span class="breadcrumb-item"><a href="#">Home</a></span>
                    <span class="breadcrumb-item active">Dashboard</span>
                </nav>
            </div>
        </div>

        <!-- STATS GRID -->
        <div class="stats-grid">
            <!-- Total Barang -->
            <div class="stat-card stat-card-primary">
                <div class="stat-content">
                    <div class="stat-value">{{ $totalBarang }}</div>
                    <div class="stat-label">Total Barang</div>
                </div>
                <div class="stat-footer">
                    <a href="{{ url('/barangs') }}" class="stat-link">
                        Lihat Data <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Kategori -->
            <div class="stat-card stat-card-success">
                <div class="stat-content">
                    <div class="stat-value">{{ $totalKategori }}</div>
                    <div class="stat-label">Total Kategori</div>
                </div>
                <div class="stat-footer">
                    <a href="{{ url('/kategoris') }}" class="stat-link">
                        Lihat Data <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Supplier -->
            <div class="stat-card stat-card-info">
                <div class="stat-content">
                    <div class="stat-value">{{ $totalSupplier }}</div>
                    <div class="stat-label">Total Supplier</div>
                </div>
                <div class="stat-footer">
                    <a href="{{ url('/suppliers') }}" class="stat-link">
                        Lihat Data <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Stok Barang -->
            <div class="stat-card stat-card-warning">
                <div class="stat-content">
                    <div class="stat-value">{{ $totalStok }}</div>
                    <div class="stat-label">Total Stok Barang</div>
                </div>
                <div class="stat-footer">
                    <a href="{{ url('/barangs') }}" class="stat-link">
                        Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Nilai Barang -->
            <div class="stat-card stat-card-danger">
                <div class="stat-content">
                    <div class="stat-value">Rp {{ number_format($totalNilai,0,',','.') }}</div>
                    <div class="stat-label">Total Nilai Barang</div>
                </div>
                <div class="stat-footer">
                    <a href="#" class="stat-link">
                        Info <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Barang Masuk Hari Ini -->
            <div class="stat-card stat-card-success">
                <div class="stat-content">
                    <div class="stat-value">{{ $masukHariIni }}</div>
                    <div class="stat-label">Barang Masuk Hari Ini</div>
                </div>
                <div class="stat-footer">
                    <a href="{{ url('/barang-masuk') }}" class="stat-link">
                        Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Barang Keluar Hari Ini -->
            <div class="stat-card stat-card-danger">
                <div class="stat-content">
                    <div class="stat-value">{{ $keluarHariIni }}</div>
                    <div class="stat-label">Barang Keluar Hari Ini</div>
                </div>
                <div class="stat-footer">
                    <a href="{{ url('/barang-keluar') }}" class="stat-link">
                        Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- CHART & INFO SECTION -->
        <div class="chart-section">
            <!-- Grafik -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3>Grafik Barang per Kategori</h3>
                </div>
                <div class="chart-body">
                    <canvas id="kategoriChart"></canvas>
                </div>
            </div>

            <!-- Info Sistem -->
            <div class="info-card">
                <div class="info-header">
                    <h3>Info Sistem</h3>
                </div>
                <div class="info-body">
                    <ul class="info-list">
                        <li>
                            <span class="info-label">Total Barang:</span>
                            <span class="info-value">{{ $totalBarang }}</span>
                        </li>
                        <li>
                            <span class="info-label">Total Supplier:</span>
                            <span class="info-value">{{ $totalSupplier }}</span>
                        </li>
                        <li>
                            <span class="info-label">Total Stok:</span>
                            <span class="info-value">{{ $totalStok }}</span>
                        </li>
                        <li>
                            <span class="info-label">Barang Masuk Hari Ini:</span>
                            <span class="info-value">{{ $masukHariIni }}</span>
                        </li>
                        <li>
                            <span class="info-label">Barang Keluar Hari Ini:</span>
                            <span class="info-value">{{ $keluarHariIni }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </main>

    <!-- CHART SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const labels = @json($grafikKategori->pluck('NamaKategori'));
            const data   = @json($grafikKategori->pluck('total'));
            
            const ctx = document.getElementById('kategoriChart').getContext('2d');
            
            // Gradient untuk chart
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(100, 255, 218, 0.8)');
            gradient.addColorStop(1, 'rgba(37, 99, 235, 0.3)');
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Barang',
                        data: data,
                        backgroundColor: gradient,
                        borderColor: 'rgba(100, 255, 218, 1)',
                        borderWidth: 1,
                        borderRadius: 8,
                        hoverBackgroundColor: 'rgba(100, 255, 218, 0.9)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: '#e6f1ff',
                                font: {
                                    size: 13
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(136, 146, 176, 0.1)'
                            },
                            ticks: {
                                color: '#8892b0'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(136, 146, 176, 0.1)'
                            },
                            ticks: {
                                color: '#8892b0'
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>