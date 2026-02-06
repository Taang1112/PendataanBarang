<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register - {{ config('app.name') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *{
            box-sizing:border-box;
            margin:0;
            padding:0;
            font-family:'Inter',sans-serif;
        }

        body{
            min-height:100vh;
            background:#0f172a;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#e5e7eb;
        }

        .wrapper{
            max-width:460px;
            width:100%;
            padding:0 16px;
        }

        .card{
            background:linear-gradient(135deg,#1e293b,#020617);
            border-radius:20px;
            box-shadow:0 30px 70px rgba(0,0,0,.55);
            overflow:hidden;
        }

        .stripe{
            height:6px;
            background:linear-gradient(90deg,#38bdf8,#6366f1,#a855f7);
        }

        .content{
            padding:38px 32px 34px;
            text-align:center;
        }

        .logo{
            font-size:28px;
            font-weight:800;
            color:#ffffff;
            letter-spacing:.5px;
        }

        .subtitle{
            margin-top:10px;
            font-size:14px;
            color:#94a3b8;
            line-height:1.6;
        }

        .form{
            margin-top:28px;
            text-align:left;
        }

        label{
            font-size:13px;
            font-weight:600;
            color:#cbd5f5;
        }

        input{
            width:100%;
            margin-top:6px;
            margin-bottom:16px;
            padding:14px 16px;
            border-radius:12px;
            border:1px solid #334155;
            background:#020617;
            color:#e5e7eb;
            outline:none;
        }

        input:focus{
            border-color:#38bdf8;
        }

        .btn{
            display:block;
            width:100%;
            padding:14px;
            border-radius:999px;
            font-weight:700;
            text-decoration:none;
            margin-top:10px;
            transition:.25s ease;
            border:none;
            cursor:pointer;
        }

        .btn-primary{
            background:linear-gradient(135deg,#38bdf8,#6366f1);
            color:#ffffff;
            box-shadow:0 10px 30px rgba(56,189,248,.4);
        }

        .btn-primary:hover{
            transform:translateY(-2px);
            opacity:.95;
        }

        .link{
            margin-top:18px;
            font-size:13px;
            text-align:center;
        }

        .link a{
            color:#38bdf8;
            text-decoration:none;
            font-weight:600;
        }

        .error{
            background:#7f1d1d;
            color:#fecaca;
            padding:12px;
            border-radius:12px;
            font-size:13px;
            margin-bottom:16px;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="card">
        <div class="stripe"></div>

        <div class="content">
            <div class="logo">{{ config('app.name') }}</div>

            <div class="subtitle">
                Buat akun baru untuk mengakses<br>
                sistem secara aman dan profesional
            </div>

            <div class="form">

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="error">
                        @foreach ($errors->all() as $error)
                            • {{ $error }} <br>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <label>Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required>

                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>

                    <label>Password</label>
                    <input type="password" name="password" required>

                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required>

                    <button class="btn btn-primary">
                        Register
                    </button>
                </form>

                <div class="link">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">Login</a>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>
