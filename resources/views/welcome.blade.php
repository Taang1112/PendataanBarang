<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Sistem Manajemen Inventaris Premium</title>
    
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Clash+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-dark: #030712;
            --secondary-dark: #0f172a;
            --accent-1: #38bdf8;
            --accent-2: #818cf8;
            --accent-3: #c084fc;
            --accent-4: #64ffda;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --card-bg: rgba(17, 34, 64, 0.7);
            --gradient-1: linear-gradient(135deg, #38bdf8, #818cf8, #c084fc, #64ffda);
            --gradient-2: linear-gradient(135deg, #0f172a, #1e293b, #0f172a);
            --gradient-3: linear-gradient(45deg, #38bdf8, #818cf8);
            --shadow-1: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            --shadow-2: 0 30px 60px -15px rgba(56, 189, 248, 0.3);
            --shadow-3: 0 50px 100px -20px rgba(0, 0, 0, 0.6);
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            background: var(--primary-dark);
            color: var(--text-primary);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        
        .cursor {
            width: 30px;
            height: 30px;
            border: 2px solid var(--accent-1);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: difference;
            transition: all 0.1s ease;
            opacity: 0;
        }

        .cursor-follower {
            width: 50px;
            height: 50px;
            background: rgba(56, 189, 248, 0.1);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9998;
            transition: all 0.3s ease;
            backdrop-filter: blur(4px);
            opacity: 0;
        }

        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        @keyframes float-reverse {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(20px) rotate(-2deg); }
        }

        @keyframes pulse-glow {
            0%, 100% { opacity: 0.3; filter: blur(40px); }
            50% { opacity: 0.6; filter: blur(60px); }
        }

        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .animate-float { animation: float 8s ease-in-out infinite; }
        .animate-float-reverse { animation: float-reverse 10s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 6s ease-in-out infinite; }
        .animate-spin-slow { animation: spin-slow 20s linear infinite; }
        .animate-gradient { background-size: 200% 200%; animation: gradient-shift 8s ease infinite; }
        .animate-shimmer { background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent); background-size: 200% 100%; animation: shimmer 3s infinite; }

        
        .glass-premium {
            background: rgba(10, 25, 47, 0.6);
            backdrop-filter: blur(16px) saturate(200%);
            -webkit-backdrop-filter: blur(16px) saturate(200%);
            border: 1px solid rgba(56, 189, 248, 0.15);
            box-shadow: var(--shadow-1);
        }

        .glass-premium-light {
            background: rgba(30, 41, 59, 0.5);
            backdrop-filter: blur(12px) saturate(200%);
            -webkit-backdrop-filter: blur(12px) saturate(200%);
            border: 1px solid rgba(56, 189, 248, 0.1);
        }

        
        .card-premium {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(56, 189, 248, 0.1);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .card-premium::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #38bdf8, #818cf8, #c084fc, #64ffda);
            border-radius: inherit;
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: -1;
        }

        .card-premium:hover::before {
            opacity: 0.3;
        }

        .card-premium:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-2), var(--shadow-3);
            border-color: rgba(56, 189, 248, 0.3);
        }

        
        .btn-premium {
            position: relative;
            padding: 16px 36px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.5s ease;
            overflow: hidden;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-premium-primary {
            background: linear-gradient(135deg, #38bdf8, #818cf8, #c084fc);
            background-size: 200% 200%;
            animation: gradient-shift 8s ease infinite;
            color: white;
            box-shadow: 0 15px 30px -10px rgba(56, 189, 248, 0.4);
        }

        .btn-premium-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.7s ease;
            z-index: -1;
        }

        .btn-premium-primary:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 25px 40px -10px rgba(56, 189, 248, 0.6);
        }

        .btn-premium-primary:hover::before {
            left: 100%;
        }

        .btn-premium-outline {
            background: transparent;
            color: #38bdf8;
            border: 2px solid rgba(56, 189, 248, 0.5);
            position: relative;
        }

        .btn-premium-outline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.1), rgba(129, 140, 248, 0.1));
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.5s ease;
            z-index: -1;
        }

        .btn-premium-outline:hover {
            color: white;
            border-color: #38bdf8;
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 30px -10px rgba(56, 189, 248, 0.3);
        }

        .btn-premium-outline:hover::before {
            transform: scaleX(1);
            transform-origin: left;
        }

        
        .text-gradient-premium {
            background: linear-gradient(135deg, #ffffff, #38bdf8, #818cf8, #c084fc, #64ffda);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            background-size: 300% 300%;
            animation: gradient-shift 8s ease infinite;
        }

        .text-gradient-blue {
            background: linear-gradient(135deg, #38bdf8, #818cf8);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        
        .navbar-premium {
            background: rgba(3, 7, 18, 0.8);
            backdrop-filter: blur(16px) saturate(200%);
            -webkit-backdrop-filter: blur(16px) saturate(200%);
            border-bottom: 1px solid rgba(56, 189, 248, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        
        .nav-link {
            position: relative;
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #38bdf8, #818cf8, #c084fc);
            transition: width 0.4s ease;
        }

        .nav-link:hover {
            color: white;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        
        .badge-premium {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(56, 189, 248, 0.1);
            border: 1px solid rgba(56, 189, 248, 0.2);
            border-radius: 50px;
            backdrop-filter: blur(4px);
            font-size: 12px;
            font-weight: 600;
            color: #38bdf8;
            letter-spacing: 0.5px;
        }

        
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #030712;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #38bdf8, #818cf8);
            border-radius: 10px;
            border: 2px solid #030712;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #64ffda, #38bdf8);
        }

        
        .background-container {
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.5;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle at center, rgba(56, 189, 248, 0.3) 0%, transparent 70%);
            top: -200px;
            left: -200px;
            animation: float 15s ease-in-out infinite;
        }

        .orb-2 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle at center, rgba(129, 140, 248, 0.2) 0%, transparent 70%);
            bottom: -300px;
            right: -300px;
            animation: float-reverse 20s ease-in-out infinite;
        }

        .orb-3 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle at center, rgba(100, 255, 218, 0.2) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: pulse-glow 8s ease-in-out infinite;
        }

        .grid-pattern {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(56, 189, 248, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(56, 189, 248, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .noise {
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.05'/%3E%3C/svg%3E");
        }

        
        .line-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, #38bdf8, transparent);
            animation: shimmer 3s infinite;
        }

        .line-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, #818cf8, transparent);
            animation: shimmer 3s infinite;
            animation-delay: 1s;
        }

        
        .ring-container {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .ring-top-right {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 160px;
            height: 160px;
            animation: spin-slow 20s linear infinite;
        }

        .ring-bottom-left {
            position: absolute;
            bottom: 20px;
            left: 20px;
            width: 200px;
            height: 200px;
            animation: spin-slow 20s linear infinite reverse;
        }

        
        .content-wrapper {
            position: relative;
            z-index: 10;
        }

        
        @media (max-width: 768px) {
            .orb-1, .orb-2, .orb-3 {
                opacity: 0.2;
            }
            
            .btn-premium {
                padding: 14px 28px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    
    <div class="cursor" id="cursor"></div>
    <div class="cursor-follower" id="cursorFollower"></div>

    
    <div class="background-container">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="grid-pattern"></div>
        <div class="noise"></div>
        
        
        <div class="line-top"></div>
        <div class="line-bottom"></div>
        
        
        <div class="ring-container">
            <svg class="ring-top-right" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="40" fill="none" stroke="rgba(56, 189, 248, 0.1)" stroke-width="1"/>
                <circle cx="50" cy="50" r="30" fill="none" stroke="rgba(129, 140, 248, 0.1)" stroke-width="1"/>
                <circle cx="50" cy="50" r="20" fill="none" stroke="rgba(100, 255, 218, 0.1)" stroke-width="1"/>
            </svg>
            
            <svg class="ring-bottom-left" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="40" fill="none" stroke="rgba(56, 189, 248, 0.1)" stroke-width="1"/>
                <circle cx="50" cy="50" r="30" fill="none" stroke="rgba(129, 140, 248, 0.1)" stroke-width="1"/>
                <circle cx="50" cy="50" r="20" fill="none" stroke="rgba(100, 255, 218, 0.1)" stroke-width="1"/>
            </svg>
        </div>
    </div>

    
    <div class="content-wrapper">
        
        <nav class="navbar-premium sticky top-0 z-50 px-6 lg:px-20 py-5">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center gap-4 group" data-aos="fade-right" data-aos-duration="1000">
                    <div class="relative">
                        <div class="w-14 h-14 bg-gradient-to-br from-sky-400 via-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center text-white font-extrabold text-2xl shadow-2xl group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            I
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-br from-sky-400 to-indigo-500 rounded-2xl blur-xl opacity-50 group-hover:opacity-80 transition-opacity"></div>
                    </div>
                    <h1 class="text-3xl font-bold text-gradient-premium tracking-tight">{{ config('app.name') }}</h1>
                </div>
                
                <div class="flex items-center gap-12">
                    <a href="#features" class="nav-link" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="100">Fitur</a>
                    <a href="#" class="nav-link" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">Tentang</a>
                </div>
            </div>
        </nav>

        
        <section class="relative px-6 lg:px-20 py-20 max-w-7xl mx-auto">
            
            <div class="text-center max-w-4xl mx-auto mb-24">
                <div class="badge-premium mx-auto mb-8 animate-slide-up" data-aos="fade-up" data-aos-duration="1000">
                    <span class="w-2 h-2 rounded-full bg-sky-400 animate-pulse"></span>
                    <span>INVENTORY MANAGEMENT SYSTEM v2.0</span>
                </div>

                <h2 class="text-6xl md:text-8xl font-bold leading-[1.1] mb-8" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <span class="text-gradient-premium">Sistem Manajemen</span><br>
                    <span class="text-white">Inventaris Barang</span>
                </h2>
                
                <p class="text-[#94a3b8] text-xl md:text-2xl leading-relaxed max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    Mengelola stok, supplier, barang masuk & keluar dengan sistem yang cepat, aman, dan modern. Solusi terpadu untuk kebutuhan manajemen inventaris bisnis Anda.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-6 justify-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-premium btn-premium-primary">
                            <i class="fas fa-arrow-right"></i>
                            Masuk ke Dashboard
                        </a>
                        <a href="{{ route('register') }}" class="btn-premium btn-premium-outline">
                            <i class="fas fa-user-plus"></i>
                            Buat Akun
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-premium btn-premium-primary">
                            <i class="fas fa-rocket"></i>
                            Mulai Sekarang
                        </a>
                        <a href="{{ route('register') }}" class="btn-premium btn-premium-outline">
                            <i class="fas fa-user-plus"></i>
                            Buat Akun
                        </a>
                    @endauth
                </div>
            </div>
            
            
            <div class="relative mt-20">
                
                
                
                
                <div class="flex flex-col lg:flex-row gap-8 justify-center items-stretch">
                    
                    <div class="flex-1 max-w-4xl card-premium rounded-3xl shadow-2xl overflow-hidden border border-sky-500/20" data-aos="fade-up" data-aos-duration="1500">
                        <div class="flex flex-wrap items-center justify-between gap-4 p-8 border-b border-sky-500/10 bg-gradient-to-r from-[#0a192f]/50 to-[#112240]/50">
                            <div class="flex items-center gap-4">
                                <div class="w-1.5 h-12 bg-gradient-to-b from-sky-400 via-indigo-500 to-purple-500 rounded-full"></div>
                                <span class="font-bold text-2xl text-gradient-blue">Dashboard Inventaris</span>
                            </div>
                            <div class="flex gap-3">
                                <button class="px-5 py-2.5 text-sm font-semibold text-sky-400 bg-sky-400/10 rounded-xl border border-sky-400/20 hover:bg-sky-400/20 hover:border-sky-400/30 transition-all">
                                    <i class="fas fa-box mr-2"></i>Barang
                                </button>
                                <button class="px-5 py-2.5 text-sm font-semibold text-sky-400 bg-sky-400/10 rounded-xl border border-sky-400/20 hover:bg-sky-400/20 hover:border-sky-400/30 transition-all">
                                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                                </button>
                                <button class="px-5 py-2.5 text-sm font-semibold text-sky-400 bg-sky-400/10 rounded-xl border border-sky-400/20 hover:bg-sky-400/20 hover:border-sky-400/30 transition-all">
                                    <i class="fas fa-cog mr-2"></i>Kelola
                                </button>
                            </div>
                        </div>
                        
                        <div class="flex flex-col md:flex-row h-[500px]">
                            
                            <div class="w-full md:w-52 border-b md:border-b-0 md:border-r border-sky-500/10 overflow-y-auto custom-scrollbar bg-gradient-to-b from-[#0a192f]/30 to-[#112240]/30">
                                @foreach($kategoris as $index => $kat)
                                <div class="flex items-center gap-3 px-5 py-4 {{ $index == 0 ? 'bg-gradient-to-r from-sky-400/20 to-indigo-500/20 border-l-4 border-sky-400' : 'hover:bg-sky-400/5' }} transition-all cursor-pointer group">
                                    <i class="fas fa-box text-sm {{ $index == 0 ? 'text-sky-400' : 'text-[#94a3b8] group-hover:text-sky-400' }}"></i>
                                    <span class="text-sm {{ $index == 0 ? 'text-white font-medium' : 'text-[#94a3b8] group-hover:text-white' }}">{{ $kat->NamaKategori }}</span>
                                    @if($index == 0)
                                    <div class="ml-auto w-2 h-2 rounded-full bg-sky-400 animate-pulse"></div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            
                            
                            <div class="flex-1 p-6 overflow-y-auto custom-scrollbar">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                                    @foreach($barangs as $item)
                                    <div class="glass-premium-light rounded-xl p-5 hover:bg-sky-400/5 transition-all border border-sky-500/5 hover:border-sky-500/20 group">
                                        <div class="flex justify-between items-start mb-4">
                                            <div class="flex items-start gap-3">
                                                <div class="w-12 h-12 bg-gradient-to-br from-sky-400/20 to-indigo-500/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                                    <i class="fas fa-cube text-sky-400 text-lg"></i>
                                                </div>
                                                <div>
                                                    <div class="font-bold text-white text-base">{{ $item->NamaBarang }}</div>
                                                    <div class="text-xs text-[#94a3b8]">ID: {{ $item->id }}</div>
                                                </div>
                                            </div>
                                            <div class="px-3 py-1.5 rounded-full text-xs font-bold
                                                @if($item->Stock > 20) bg-green-500/20 text-green-400 border border-green-500/30
                                                @elseif($item->Stock > 5) bg-yellow-500/20 text-yellow-400 border border-yellow-500/30
                                                @else bg-red-500/20 text-red-400 border border-red-500/30
                                                @endif">
                                                <i class="fas fa-box mr-1"></i>{{ $item->Stock }}
                                            </div>
                                        </div>
                                        <div class="space-y-2.5 pt-4 border-t border-sky-500/10">
                                            <div class="flex justify-between text-sm">
                                                <span class="text-[#94a3b8]">Kategori:</span>
                                                <span class="text-white font-medium">{{ $item->kategori->NamaKategori ?? '-' }}</span>
                                            </div>
                                            <div class="flex justify-between text-sm">
                                                <span class="text-[#94a3b8]">Harga:</span>
                                                <span class="text-white font-medium">Rp {{ number_format($item->Harga,0,',','.') }}</span>
                                            </div>
                                            <div class="flex justify-between text-sm">
                                                <span class="text-[#94a3b8]">Update:</span>
                                                <span class="text-white font-medium">{{ $item->updated_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="w-full lg:w-96 card-premium rounded-3xl shadow-2xl overflow-hidden border border-sky-500/20 flex flex-col" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="200">
                        <div class="p-8 border-b border-sky-500/10 bg-gradient-to-r from-[#0a192f]/50 to-[#112240]/50">
                            <div class="flex items-center gap-4 mb-3">
                                <div class="w-1.5 h-12 bg-gradient-to-b from-indigo-400 via-purple-500 to-pink-500 rounded-full"></div>
                                <span class="font-bold text-2xl text-gradient-blue">Statistik Sistem</span>
                            </div>
                            <div class="text-sm text-[#94a3b8] flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                                Update real-time
                            </div>
                        </div>
                        
                        <div class="flex-1 p-6 overflow-y-auto custom-scrollbar space-y-4">
                            
                            <div class="glass-premium-light rounded-xl p-5 hover:bg-sky-400/5 transition-all group">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-gradient-to-br from-sky-400 to-indigo-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-boxes text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-extrabold text-white">{{ $totalBarang }}</div>
                                        <div class="text-sm text-[#94a3b8]">Total Barang</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="glass-premium-light rounded-xl p-5 hover:bg-sky-400/5 transition-all group">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-truck text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-extrabold text-white">{{ $totalSupplier }}</div>
                                        <div class="text-sm text-[#94a3b8]">Supplier Aktif</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="glass-premium-light rounded-xl p-5 hover:bg-sky-400/5 transition-all group">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-gradient-to-br from-purple-400 to-pink-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-layer-group text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-extrabold text-white">{{ $totalStok ?? '4,892' }}</div>
                                        <div class="text-sm text-[#94a3b8]">Total Stok</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="glass-premium-light rounded-xl p-5 hover:bg-sky-400/5 transition-all group">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-sign-in-alt text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-extrabold text-white">{{ $masukHariIni ?? '24' }}</div>
                                        <div class="text-sm text-[#94a3b8]">Barang Masuk Hari Ini</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="glass-premium-light rounded-xl p-5 hover:bg-sky-400/5 transition-all group">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-sign-out-alt text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-extrabold text-white">{{ $keluarHariIni ?? '18' }}</div>
                                        <div class="text-sm text-[#94a3b8]">Barang Keluar Hari Ini</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="glass-premium-light rounded-xl p-5 hover:bg-sky-400/5 transition-all group">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-gradient-to-br from-rose-400 to-red-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-chart-line text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-extrabold text-white">99%</div>
                                        <div class="text-sm text-[#94a3b8]">Stok Aman</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6 border-t border-sky-500/10 bg-gradient-to-r from-[#0a192f]/50 to-[#112240]/50">
                            <button class="w-full py-4 text-sm font-semibold text-sky-400 border-2 border-sky-400/30 rounded-xl hover:bg-sky-400/10 hover:border-sky-400/50 transition-all group flex items-center justify-center gap-2">
                                <span>Lihat Semua Statistik</span>
                                <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <section class="relative px-6 lg:px-20 py-24 max-w-7xl mx-auto" id="features">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <div class="badge-premium mx-auto mb-6" data-aos="fade-up" data-aos-duration="1000">
                    <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                    <span>PREMIUM FEATURES</span>
                </div>
                <h3 class="text-5xl md:text-6xl font-bold text-gradient-premium mb-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">Fitur Unggulan Sistem</h3>
                <p class="text-[#94a3b8] text-xl leading-relaxed" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">Dilengkapi dengan berbagai fitur canggih untuk mendukung kebutuhan manajemen inventaris Anda</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                
                <div class="card-premium rounded-2xl p-8 border border-sky-500/10 relative overflow-hidden group" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <div class="absolute inset-0 bg-gradient-to-br from-sky-500/10 to-indigo-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-sky-400 to-indigo-500 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            📦
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3 group-hover:text-sky-400 transition-colors">Manajemen Barang</h4>
                        <p class="text-[#94a3b8] text-sm leading-relaxed">Kelola data barang, stok, dan kategori dengan sistem database yang terstruktur dan mudah diakses kapan saja.</p>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-sky-400 to-indigo-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                </div>
                
                
                <div class="card-premium rounded-2xl p-8 border border-sky-500/10 relative overflow-hidden group" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            🚚
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3 group-hover:text-indigo-400 transition-colors">Supplier Terintegrasi</h4>
                        <p class="text-[#94a3b8] text-sm leading-relaxed">Catat supplier dan riwayat barang masuk secara otomatis untuk efisiensi proses pengadaan barang.</p>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-400 to-purple-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                </div>
                
                
                <div class="card-premium rounded-2xl p-8 border border-sky-500/10 relative overflow-hidden group" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-teal-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            📊
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3 group-hover:text-emerald-400 transition-colors">Monitoring Stok</h4>
                        <p class="text-[#94a3b8] text-sm leading-relaxed">Pantau stok barang masuk dan keluar secara real-time dengan notifikasi untuk stok menipis.</p>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-teal-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                </div>
                
                
                <div class="card-premium rounded-2xl p-8 border border-sky-500/10 relative overflow-hidden group" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-orange-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            📄
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3 group-hover:text-amber-400 transition-colors">Laporan Otomatis</h4>
                        <p class="text-[#94a3b8] text-sm leading-relaxed">Export laporan barang masuk & keluar ke PDF dan Excel dengan format yang rapi dan profesional.</p>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-amber-400 to-orange-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                </div>
            </div>
        </section>

        
        <footer class="relative mt-20 border-t border-sky-500/10">
            <div class="absolute inset-0 bg-gradient-to-t from-sky-500/5 to-transparent"></div>
            <div class="max-w-7xl mx-auto px-6 lg:px-20 py-16 relative z-10">
                <div class="text-center">
                    <div class="flex items-center justify-center gap-3 mb-8 group">
                        <div class="relative">
                            <div class="w-14 h-14 bg-gradient-to-br from-sky-400 via-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center text-white font-extrabold text-2xl group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                I
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-br from-sky-400 to-indigo-500 rounded-2xl blur-xl opacity-50 group-hover:opacity-80 transition-opacity"></div>
                        </div>
                        <span class="text-4xl font-bold text-gradient-premium">{{ config('app.name') }}</span>
                    </div>
                    <p class="text-[#94a3b8] text-lg">© {{ date('Y') }} <span class="text-sky-400 font-semibold hover:text-sky-300 transition-colors">{{ config('app.name') }}</span> — Sistem Inventaris Berbasis Laravel</p>
                    <p class="text-[#94a3b8] text-base mt-4">Solusi terpadu untuk manajemen inventaris yang efisien dan modern</p>
                    
                    
                    <div class="flex justify-center gap-3 mt-8">
                        <div class="w-2 h-2 rounded-full bg-sky-400 animate-pulse"></div>
                        <div class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse" style="animation-delay: 0.2s;"></div>
                        <div class="w-2 h-2 rounded-full bg-purple-400 animate-pulse" style="animation-delay: 0.4s;"></div>
                        <div class="w-2 h-2 rounded-full bg-pink-400 animate-pulse" style="animation-delay: 0.6s;"></div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    
    <script>
        
        AOS.init({
            once: true,
            duration: 1000,
            easing: 'ease-out-cubic'
        });

        
        const cursor = document.querySelector('.cursor');
        const cursorFollower = document.querySelector('.cursor-follower');

        document.addEventListener('mousemove', (e) => {
            cursor.style.transform = `translate(${e.clientX - 15}px, ${e.clientY - 15}px)`;
            cursorFollower.style.transform = `translate(${e.clientX - 25}px, ${e.clientY - 25}px)`;
            
            cursor.style.opacity = '1';
            cursorFollower.style.opacity = '1';
        });

        document.addEventListener('mouseleave', () => {
            cursor.style.opacity = '0';
            cursorFollower.style.opacity = '0';
        });

        
        const interactiveElements = document.querySelectorAll('a, button, .card-premium, .btn-premium');
        
        interactiveElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursor.style.transform = 'scale(1.5)';
                cursorFollower.style.transform = 'scale(1.5)';
            });
            
            el.addEventListener('mouseleave', () => {
                cursor.style.transform = 'scale(1)';
                cursorFollower.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>