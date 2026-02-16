<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Inventory System</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    
    
    
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .glass-morphism {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(51, 65, 85, 0.5);
        }
        
        .animate-pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 flex relative overflow-x-hidden overflow-y-auto">


    
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-sky-500/10 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-purple-500/5 rounded-full blur-3xl"></div>
    </div>

    
    <div class="hidden lg:flex w-1/2 items-center justify-center relative">
        <div class="absolute inset-0 bg-gradient-to-br from-sky-500/10 via-indigo-500/10 to-purple-500/10"></div>
        
        <div class="text-center px-12 relative z-10">
            
            <div class="inline-block mb-8">
                <lottie-player
    src="https://assets10.lottiefiles.com/packages/lf20_jcikwtux.json"
    background="transparent"
    speed="1"
    style="width: 200px; height: 200px; margin: 0 auto;"
    loop
    autoplay>
</lottie-player>

            </div>
            
            <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 mb-4 tracking-tight">
                Inventory System
            </h1>

            <div class="h-1 w-24 bg-gradient-to-r from-sky-500 to-indigo-500 mx-auto mb-6 rounded-full"></div>

            <p class="text-slate-400 leading-relaxed text-lg max-w-md mx-auto">
                Buat akun dan mulai kelola inventaris 
                <span class="text-indigo-400 font-semibold">lebih mudah</span>.
            </p>

            <div class="mt-12 flex items-center justify-center gap-4">
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-sky-400 to-indigo-400 border-2 border-slate-800"></div>
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-indigo-400 to-purple-400 border-2 border-slate-800"></div>
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-purple-400 to-pink-400 border-2 border-slate-800"></div>
                </div>
                <span class="text-slate-400 text-sm">+500 users bergabung</span>
            </div>
        </div>
    </div>

    
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6 relative z-10">
        <div class="w-full max-w-md transform transition-all duration-300 hover:scale-[1.02]">
            
            <div class="glass-morphism rounded-3xl p-8 shadow-2xl">
                
                
                <div class="flex items-center gap-2 mb-8">
                    <div class="h-8 w-1 bg-gradient-to-b from-sky-500 via-indigo-500 to-purple-500 rounded-full"></div>
                    <div>
                        <h2 class="text-3xl font-bold text-white tracking-tight">
                            Register
                        </h2>
                        <p class="text-slate-400 text-sm mt-1">
                            Buat akun baru untuk memulai
                        </p>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="bg-red-950/50 border border-red-800/50 text-red-300 p-4 rounded-xl mb-6 text-sm backdrop-blur-sm">
                        @foreach ($errors->all() as $error)
                            <div class="flex items-start gap-2 mb-1 last:mb-0">
                                <svg class="w-4 h-4 text-red-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $error }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2 ml-1">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" placeholder="Masukkan nama lengkap"
                            class="w-full bg-slate-900/50 border border-slate-700 rounded-xl p-3.5 text-white placeholder-slate-500 focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 transition-all duration-200">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2 ml-1">
                            Email
                        </label>
                        <input type="email" name="email" placeholder="contoh@email.com"
                            class="w-full bg-slate-900/50 border border-slate-700 rounded-xl p-3.5 text-white placeholder-slate-500 focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 transition-all duration-200">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2 ml-1">
                            Password
                        </label>
                        <input type="password" name="password" placeholder="Buat password"
                            class="w-full bg-slate-900/50 border border-slate-700 rounded-xl p-3.5 text-white placeholder-slate-500 focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 transition-all duration-200">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2 ml-1">
                            Konfirmasi Password
                        </label>
                        <input type="password" name="password_confirmation"
                            placeholder="Ulangi password"
                            class="w-full bg-slate-900/50 border border-slate-700 rounded-xl p-3.5 text-white placeholder-slate-500 focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 transition-all duration-200">
                    </div>

                    <button
                        class="w-full bg-gradient-to-r from-sky-500 via-indigo-500 to-purple-500 hover:from-sky-600 hover:via-indigo-600 hover:to-purple-600 py-3.5 rounded-xl font-bold text-white shadow-lg shadow-indigo-500/25 hover:shadow-xl hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-0.5 mt-6">
                        REGISTER
                    </button>

                    
                <a href="{{ url('/auth/google') }}"
                   class="w-full flex items-center justify-center gap-3 bg-white hover:bg-slate-100 text-slate-800 py-3.5 rounded-xl font-semibold mb-6 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 group">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    <span>Daftar dengan Google</span>
                </a>

                </form>

                <p class="text-sm text-slate-400 mt-8 text-center">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-sky-400 font-semibold hover:text-sky-300 hover:underline transition-all">
                        Login
                    </a>
                </p>

            </div>
            
            
            <p class="text-center text-slate-600 text-xs mt-6">
                © 2024 Inventory System. All rights reserved.
            </p>
        </div>
    </div>
<script src="https://unpkg.com/@lottiefiles/lottie-player@1.5.7/dist/lottie-player.js"></script>
</body>
</html>