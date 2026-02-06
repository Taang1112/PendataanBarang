<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name') }}</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
*{box-sizing:border-box;margin:0;padding:0;font-family:'Inter',sans-serif}

body{
    background:#0f172a;
    color:#e2e8f0;
    line-height:1.6;
}

/* NAVBAR */
.navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 60px;
}
.navbar h1{font-size:20px;font-weight:800;color:white}
.navbar a{
    color:#94a3b8;
    text-decoration:none;
    margin-left:20px;
    font-weight:600;
}
.navbar a:hover{color:#38bdf8}

/* HERO */
.hero{
    padding:80px 60px 40px;
    text-align:center;
}
.hero h2{
    font-size:42px;
    font-weight:800;
    color:white;
}
.hero p{
    margin-top:15px;
    color:#94a3b8;
    font-size:16px;
}
.btn{
    display:inline-block;
    margin-top:25px;
    padding:14px 28px;
    border-radius:999px;
    font-weight:700;
    text-decoration:none;
}
.btn-primary{
    background:linear-gradient(135deg,#38bdf8,#6366f1);
    color:white;
}
.btn-outline{
    border:2px solid #38bdf8;
    color:#38bdf8;
    margin-left:12px;
}
.btn-outline:hover{background:#38bdf8;color:#0f172a}

/* FEATURES */
.features{
    padding:70px 60px;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:30px;
}
.card{
    background:#1e293b;
    padding:30px;
    border-radius:16px;
    box-shadow:0 10px 30px rgba(0,0,0,.3);
}
.card h3{color:white;margin-bottom:10px}
.card p{color:#94a3b8;font-size:14px}

/* FOOTER */
.footer{
    text-align:center;
    padding:40px;
    color:#64748b;
    font-size:13px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <h1>{{ config('app.name') }}</h1>
    <div>
        @if (Route::has('login'))
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        @endif
    </div>
</div>

<!-- HERO -->
<section class="hero">
    <h2>Sistem Manajemen Inventaris Barang</h2>
    <p>Mengelola stok, supplier, barang masuk & keluar dengan sistem yang cepat, aman, dan modern.</p>

    @auth
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Masuk ke Dashboard</a>
    @else
        <a href="{{ route('login') }}" class="btn btn-primary">Mulai Sekarang</a>
        <a href="{{ route('register') }}" class="btn btn-outline">Buat Akun</a>
    @endauth
</section>

<!-- FEATURES -->
<section class="features">
    <div class="card">
        <h3>📦 Manajemen Barang</h3>
        <p>Kelola data barang, stok, dan kategori dengan sistem database yang terstruktur.</p>
    </div>

    <div class="card">
        <h3>🚚 Supplier Terintegrasi</h3>
        <p>Catat supplier dan riwayat barang masuk secara otomatis.</p>
    </div>

    <div class="card">
        <h3>📊 Monitoring Stok</h3>
        <p>Pantau stok barang masuk dan keluar secara real-time.</p>
    </div>

    <div class="card">
        <h3>📄 Laporan Otomatis</h3>
        <p>Export laporan barang masuk & keluar ke PDF dan Excel.</p>
    </div>
</section>

<div class="footer">
    © {{ date('Y') }} {{ config('app.name') }} — Sistem Inventaris Berbasis Laravel
</div>

</body>
</html>
