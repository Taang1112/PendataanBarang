<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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

        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 60px;
            background-color: rgba(10, 25, 47, 0.85);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(100, 255, 218, 0.1);
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .logo-icon {
            width: 36px;
            height: 36px;
            background: var(--gradient-blue);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 18px;
        }
        
        .navbar h1 {
            font-size: 22px;
            font-weight: 800;
            background: linear-gradient(90deg, var(--accent-blue), var(--accent-light-blue));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.5px;
        }
        
        .nav-links {
            display: flex;
            gap: 32px;
        }
        
        .navbar a {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            position: relative;
            padding: 8px 0;
            transition: all 0.3s ease;
        }
        
        .navbar a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-blue);
            transition: width 0.3s ease;
        }
        
        .navbar a:hover {
            color: var(--accent-blue);
        }
        
        .navbar a:hover::after {
            width: 100%;
        }

        /* HERO SECTION */
        .hero {
            padding: 100px 60px 60px;
            text-align: center;
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto 60px;
        }
        
        .hero h2 {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
            background: linear-gradient(90deg, #ffffff, var(--accent-light-blue));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .hero p {
            margin-top: 15px;
            color: var(--text-secondary);
            font-size: 18px;
            line-height: 1.7;
        }
        
        .hero-buttons {
            margin-top: 40px;
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 16px 36px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: none;
            cursor: pointer;
            letter-spacing: 0.5px;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s ease;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn-primary {
            background: var(--gradient-blue);
            color: white;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(37, 99, 235, 0.4);
        }
        
        .btn-outline {
            background: transparent;
            color: var(--accent-blue);
            border: 2px solid var(--accent-blue);
        }
        
        .btn-outline:hover {
            background: rgba(100, 255, 218, 0.1);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px var(--shadow-light);
        }
        
        /* HERO GRAPHICS - LAYOUT RAPIH */
        .hero-graphics {
            position: relative;
            min-height: 450px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 40px;
        }
        
        .graphics-container {
            position: relative;
            width: 100%;
            height: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .background-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        
        .circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.4;
        }
        
        .circle-1 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.25) 0%, transparent 70%);
            top: 10%;
            left: 5%;
            animation: float 20s infinite linear;
        }
        
        .circle-2 {
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(100, 255, 218, 0.15) 0%, transparent 70%);
            bottom: 15%;
            right: 5%;
            animation: float 15s infinite linear reverse;
        }
        
        .dashboard-overview {
            position: relative;
            width: 100%;
            display: flex;
            gap: 25px;
            align-items: stretch;
            justify-content: center;
            z-index: 2;
        }
        
        .dashboard-card {
            background: rgba(17, 34, 64, 0.85);
            border-radius: 18px;
            border: 1px solid rgba(100, 255, 218, 0.15);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(12px);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }
        
        .main-dashboard {
            flex: 2;
            min-width: 0;
            max-width: 750px;
            height: 380px;
        }
        
        .stats-sidebar {
            flex: 1;
            min-width: 280px;
            max-width: 320px;
            height: 380px;
            display: flex;
            flex-direction: column;
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 28px;
            border-bottom: 1px solid rgba(100, 255, 218, 0.1);
            background: rgba(30, 41, 59, 0.4);
        }
        
        .dashboard-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--accent-blue);
            letter-spacing: -0.3px;
        }
        
        .dashboard-actions {
            display: flex;
            gap: 8px;
        }
        
        .action-btn {
            padding: 6px 14px;
            background: rgba(100, 255, 218, 0.08);
            border: 1px solid rgba(100, 255, 218, 0.2);
            border-radius: 6px;
            color: var(--accent-blue);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        
        .action-btn:hover {
            background: rgba(100, 255, 218, 0.15);
            border-color: rgba(100, 255, 218, 0.3);
        }
        
        .dashboard-content {
            display: flex;
            height: calc(100% - 72px);
        }
        
        .categories-sidebar {
            width: 160px;
            padding: 20px 0;
            border-right: 1px solid rgba(100, 255, 218, 0.08);
            flex-shrink: 0;
            overflow-y: auto;
        }
        
        .category-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            font-size: 13px;
        }
        
        .category-item.active {
            background: rgba(100, 255, 218, 0.08);
            color: var(--accent-blue);
            border-left-color: var(--accent-blue);
        }
        
        .category-item:hover:not(.active) {
            background: rgba(100, 255, 218, 0.03);
            color: var(--text-primary);
        }
        
        .category-icon {
            font-size: 14px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }
        
        .inventory-grid {
            flex: 1;
            padding: 22px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            overflow-y: auto;
            align-content: start;
        }
        
        .inventory-item {
            background: rgba(30, 41, 59, 0.5);
            border-radius: 12px;
            padding: 18px;
            border: 1px solid rgba(100, 255, 218, 0.05);
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
            min-height: 120px;
        }
        
        .inventory-item:hover {
            border-color: rgba(100, 255, 218, 0.2);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            background: rgba(30, 41, 59, 0.6);
        }
        
        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
            gap: 10px;
        }
        
        .item-info {
            flex: 1;
            min-width: 0;
        }
        
        .item-name {
            font-size: 14px;
            font-weight: 700;
            color: white;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .item-id {
            font-size: 11px;
            color: var(--text-secondary);
            font-weight: 500;
        }
        
        .stock-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            min-width: 50px;
            text-align: center;
            flex-shrink: 0;
            height: fit-content;
        }
        
        .stock-high {
            background: rgba(34, 197, 94, 0.12);
            color: #4ade80;
        }
        
        .stock-medium {
            background: rgba(245, 158, 11, 0.12);
            color: #fbbf24;
        }
        
        .stock-low {
            background: rgba(239, 68, 68, 0.12);
            color: #f87171;
        }
        
        .item-details {
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px solid rgba(100, 255, 218, 0.08);
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            font-size: 11px;
        }
        
        .detail-label {
            color: var(--text-secondary);
        }
        
        .detail-value {
            color: white;
            font-weight: 600;
            text-align: right;
            max-width: 60%;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        /* Stats Sidebar dengan Scroll */
        .stats-header {
            padding: 22px 28px;
            border-bottom: 1px solid rgba(100, 255, 218, 0.1);
            flex-shrink: 0;
        }
        
        .stats-title {
            font-size: 16px;
            font-weight: 700;
            color: white;
            margin-bottom: 4px;
            letter-spacing: -0.3px;
        }
        
        .stats-subtitle {
            font-size: 12px;
            color: var(--text-secondary);
        }
        
        .stats-content {
            flex: 1;
            padding: 22px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            overflow-y: auto;
            max-height: calc(100% - 140px); /* Memberikan ruang untuk header dan footer */
        }
        
        /* Custom Scrollbar untuk Stats Content */
        .stats-content::-webkit-scrollbar {
            width: 6px;
        }
        
        .stats-content::-webkit-scrollbar-track {
            background: rgba(30, 41, 59, 0.3);
            border-radius: 3px;
        }
        
        .stats-content::-webkit-scrollbar-thumb {
            background: rgba(100, 255, 218, 0.3);
            border-radius: 3px;
            transition: background 0.3s ease;
        }
        
        .stats-content::-webkit-scrollbar-thumb:hover {
            background: rgba(100, 255, 218, 0.5);
        }
        
        /* Tambahkan stat card tambahan untuk demo scroll */
        .stat-card {
            background: rgba(30, 41, 59, 0.5);
            border-radius: 12px;
            padding: 18px;
            text-align: center;
            transition: all 0.25s ease;
            flex-shrink: 0;
        }
        
        .stat-card:hover {
            background: rgba(30, 41, 59, 0.7);
            transform: translateY(-3px);
        }
        
        .stat-icon {
            font-size: 24px;
            color: var(--accent-blue);
            margin-bottom: 12px;
        }
        
        .stat-value-large {
            font-size: 28px;
            font-weight: 800;
            color: white;
            margin-bottom: 4px;
            line-height: 1.2;
        }
        
        .stat-label {
            font-size: 13px;
            color: var(--text-secondary);
        }
        
        .stats-footer {
            padding: 18px 28px;
            border-top: 1px solid rgba(100, 255, 218, 0.1);
            text-align: center;
            flex-shrink: 0;
        }
        
        .view-all-btn {
            padding: 9px 18px;
            background: transparent;
            border: 1px solid var(--accent-blue);
            border-radius: 8px;
            color: var(--accent-blue);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            width: 100%;
        }
        
        .view-all-btn:hover {
            background: rgba(100, 255, 218, 0.1);
        }
        
        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            33% {
                transform: translate(5px, -5px) rotate(120deg);
            }
            66% {
                transform: translate(-5px, 5px) rotate(240deg);
            }
            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }
        
        /* FEATURES SECTION */
        .features {
            padding: 80px 60px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .section-title h3 {
            font-size: 36px;
            font-weight: 800;
            color: white;
            margin-bottom: 16px;
        }
        
        .section-title p {
            color: var(--text-secondary);
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }
        
        .card {
            background: var(--card-bg);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px var(--shadow-medium);
            transition: all 0.4s ease;
            border: 1px solid var(--card-border);
            position: relative;
            overflow: hidden;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--gradient-blue);
            transition: width 0.4s ease;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px var(--shadow-medium);
        }
        
        .card:hover::before {
            width: 8px;
        }
        
        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            font-size: 24px;
            background: rgba(100, 255, 218, 0.1);
            color: var(--accent-blue);
        }
        
        .card h3 {
            color: white;
            margin-bottom: 16px;
            font-size: 22px;
            font-weight: 700;
        }
        
        .card p {
            color: var(--text-secondary);
            font-size: 15px;
            line-height: 1.7;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            padding: 60px 40px 40px;
            color: var(--text-secondary);
            font-size: 14px;
            border-top: 1px solid rgba(100, 255, 218, 0.1);
            margin-top: 40px;
            background-color: rgba(10, 25, 47, 0.5);
        }
        
        .footer-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .footer p {
            margin-top: 20px;
            line-height: 1.8;
        }
        
        .app-name {
            color: var(--accent-blue);
            font-weight: 700;
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 1100px) {
            .dashboard-overview {
                flex-direction: column;
                gap: 25px;
                align-items: center;
            }
            
            .main-dashboard, .stats-sidebar {
                width: 100%;
                max-width: 800px;
            }
            
            .main-dashboard {
                height: 380px;
            }
            
            .stats-sidebar {
                height: auto;
                min-height: 250px;
                max-height: 400px;
            }
            
            .stats-content {
                flex-direction: row;
                flex-wrap: wrap;
                max-height: none;
                overflow-y: visible;
            }
            
            .stat-card {
                flex: 1;
                min-width: 180px;
            }
        }
        
        @media (max-width: 900px) {
            .hero h2 {
                font-size: 42px;
            }
            
            .hero-graphics {
                min-height: 750px;
            }
            
            .inventory-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .categories-sidebar {
                width: 140px;
            }
        }
        
        @media (max-width: 768px) {
            .hero h2 {
                font-size: 36px;
            }
            
            .section-title h3 {
                font-size: 32px;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 300px;
            }
            
            .navbar {
                flex-direction: column;
                gap: 20px;
            }
            
            .nav-links {
                gap: 20px;
            }
            
            .hero {
                padding: 80px 30px 40px;
            }
            
            .dashboard-content {
                flex-direction: column;
            }
            
            .categories-sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid rgba(100, 255, 218, 0.1);
                padding: 15px 0;
                display: flex;
                overflow-x: auto;
                height: auto;
                flex-shrink: 0;
            }
            
            .category-item {
                flex-shrink: 0;
                padding: 10px 20px;
                border-left: none;
                border-bottom: 3px solid transparent;
                font-size: 12px;
            }
            
            .category-item.active {
                border-left-color: transparent;
                border-bottom-color: var(--accent-blue);
            }
            
            .inventory-grid {
                grid-template-columns: 1fr;
                padding: 20px;
            }
            
            .main-dashboard {
                height: 500px;
            }
            
            .stat-card {
                min-width: calc(50% - 8px);
            }
        }
        
        @media (max-width: 576px) {
            .hero h2 {
                font-size: 30px;
            }
            
            .section-title h3 {
                font-size: 28px;
            }
            
            .navbar {
                padding: 20px;
            }
            
            .features {
                padding-left: 20px;
                    padding-right: 20px;
            }
            
            .hero-graphics {
                min-height: 850px;
            }
            
            .dashboard-header {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
                padding: 18px 20px;
            }
            
            .dashboard-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .action-btn {
                flex: 1;
                text-align: center;
                padding: 6px 10px;
                font-size: 11px;
            }
            
            .stat-card {
                min-width: 100%;
            }
            
            .stat-value-large {
                font-size: 24px;
            }
            
            .stats-content {
                padding: 16px;
            }
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo">
            <div class="logo-icon">I</div>
            <h1>{{ config('app.name') }}</h1>
        </div>
        <div class="nav-links">
            <a href="#features">Fitur</a>
            <a href="#">Tentang</a>
         
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-content">
            <h2>Sistem Manajemen Inventaris Barang</h2>
            <p>Mengelola stok, supplier, barang masuk & keluar dengan sistem yang cepat, aman, dan modern. Solusi terpadu untuk kebutuhan manajemen inventaris bisnis Anda.</p>
            
            <div class="hero-buttons">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Masuk ke Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Mulai Sekarang</a>
                    <a href="{{ route('register') }}" class="btn btn-outline">Buat Akun</a>
                @endauth
            </div>
        </div>
        
        <!-- HERO GRAPHICS - LAYOUT RAPIH -->
        <div class="hero-graphics">
            <div class="graphics-container">
                <div class="background-elements">
                    <div class="circle circle-1"></div>
                    <div class="circle circle-2"></div>
                </div>
                
                <div class="dashboard-overview">
                    <!-- Main Dashboard -->
                    <div class="dashboard-card main-dashboard">
                        <div class="dashboard-header">
                            <div class="dashboard-title">Dashboard Inventaris</div>
                            <div class="dashboard-actions">
                                <button class="action-btn">Barang</button>
                                <button class="action-btn">Masuk</button>
                                <button class="action-btn">Kelola</button>
                            </div>
                        </div>
                        
                        <div class="dashboard-content">
                            <!-- KATEGORI DINAMIS -->
                            <div class="categories-sidebar">
                                @foreach($kategoris as $index => $kat)
                                <div class="category-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="category-icon"><i class="fas fa-box"></i></div>
                                    <span>{{ $kat->NamaKategori }}</span>
                                </div>
                                @endforeach
                            </div>
                            
                            <!-- BARANG DINAMIS -->
                            <div class="inventory-grid">
                                @foreach($barangs as $item)
                                <div class="inventory-item">
                                    <div class="item-header">
                                        <div class="item-info">
                                            <div class="item-name">{{ $item->NamaBarang }}</div>
                                            <div class="item-id">ID: {{ $item->id }}</div>
                                        </div>
                                        <div class="stock-badge 
                                            @if($item->Stock > 20) stock-high
                                            @elseif($item->Stock > 5) stock-medium
                                            @else stock-low
                                            @endif">
                                            {{ $item->Stock }}
                                        </div>
                                    </div>
                                    <div class="item-details">
                                        <div class="detail-row">
                                            <span class="detail-label">Kategori:</span>
                                            <span class="detail-value">{{ $item->kategori->NamaKategori ?? '-' }}</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Harga:</span>
                                            <span class="detail-value">Rp {{ number_format($item->Harga,0,',','.') }}</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Update:</span>
                                            <span class="detail-value">{{ $item->updated_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stats Sidebar dengan Scroll -->
                    <div class="dashboard-card stats-sidebar">
                        <div class="stats-header">
                            <div class="stats-title">Statistik Sistem</div>
                            <div class="stats-subtitle">Update real-time</div>
                        </div>
                        
                        <div class="stats-content">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-boxes"></i>
                                </div>
                                <div class="stat-value-large">{{ $totalBarang }}</div>
                                <div class="stat-label">Total Barang</div>
                            </div>
                            
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="stat-value-large">{{ $totalSupplier }}</div>
                                <div class="stat-label">Supplier Aktif</div>
                            </div>
                            
                            <!-- Tambahkan statistik tambahan untuk demo scroll -->
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                                <div class="stat-value-large">{{ $totalStok ?? '4,892' }}</div>
                                <div class="stat-label">Total Stok</div>
                            </div>
                            
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-sign-in-alt"></i>
                                </div>
                                <div class="stat-value-large">{{ $masukHariIni ?? '24' }}</div>
                                <div class="stat-label">Barang Masuk Hari Ini</div>
                            </div>
                            
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-sign-out-alt"></i>
                                </div>
                                <div class="stat-value-large">{{ $keluarHariIni ?? '18' }}</div>
                                <div class="stat-label">Barang Keluar Hari Ini</div>
                            </div>
                            
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="stat-value-large">99%</div>
                                <div class="stat-label">Stok Aman</div>
                            </div>
                        </div>
                        
                        <div class="stats-footer">
                            <button class="view-all-btn">Lihat Semua Statistik</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section class="features" id="features">
        <div class="section-title">
            <h3>Fitur Unggulan Sistem</h3>
            <p>Dilengkapi dengan berbagai fitur canggih untuk mendukung kebutuhan manajemen inventaris Anda</p>
        </div>
        
        <div class="features-grid">
            <div class="card">
                <div class="card-icon">📦</div>
                <h3>Manajemen Barang</h3>
                <p>Kelola data barang, stok, dan kategori dengan sistem database yang terstruktur dan mudah diakses kapan saja.</p>
            </div>

            <div class="card">
                <div class="card-icon">🚚</div>
                <h3>Supplier Terintegrasi</h3>
                <p>Catat supplier dan riwayat barang masuk secara otomatis untuk efisiensi proses pengadaan barang.</p>
            </div>

            <div class="card">
                <div class="card-icon">📊</div>
                <h3>Monitoring Stok</h3>
                <p>Pantau stok barang masuk dan keluar secara real-time dengan notifikasi untuk stok menipis.</p>
            </div>

            <div class="card">
                <div class="card-icon">📄</div>
                <h3>Laporan Otomatis</h3>
                <p>Export laporan barang masuk & keluar ke PDF dan Excel dengan format yang rapi dan profesional.</p>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-content">
            <p>© {{ date('Y') }} <span class="app-name">{{ config('app.name') }}</span> — Sistem Inventaris Berbasis Laravel</p>
            <p>Solusi terpadu untuk manajemen inventaris yang efisien dan modern</p>
        </div>
    </footer>
</body>
</html>