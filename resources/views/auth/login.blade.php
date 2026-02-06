<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Inventory System</title>
</head>

<body style="margin:0; padding:0; background:#0f172a; font-family:Inter, Segoe UI, Arial, sans-serif;">

<div style="max-width:420px; margin:70px auto; padding:0 15px;">
    <div style="background:linear-gradient(135deg,#1e293b,#020617);
                border-radius:18px;
                box-shadow:0 25px 60px rgba(0,0,0,.45);
                overflow:hidden;">

        <!-- STRIPE -->
        <div style="height:6px; background:linear-gradient(90deg,#38bdf8,#6366f1,#a855f7);"></div>

        <!-- HEADER -->
        <div style="padding:32px; color:white; text-align:center;">
            <h2 style="margin:0; font-size:24px;">Inventory System</h2>
            <p style="margin-top:8px; color:#94a3b8; font-size:14px;">
                Login ke dashboard admin
            </p>
        </div>

        <!-- BODY -->
        <div style="padding:28px; background:rgba(255,255,255,0.03);">

            {{-- ERROR --}}
            @if ($errors->any())
                <div style="background:#7f1d1d; padding:12px; border-radius:10px; color:#fecaca; font-size:13px; margin-bottom:15px;">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- GOOGLE --}}
            <a href="{{ url('/auth/google') }}"
               style="display:block; text-align:center; padding:12px;
                      background:white; color:#111827; border-radius:10px;
                      text-decoration:none; font-weight:600; margin-bottom:18px;">
                <img src="https://developers.google.com/identity/images/g-logo.png"
                     style="width:18px; vertical-align:middle; margin-right:8px;">
                Login dengan Google
            </a>

            <div style="text-align:center; color:#64748b; font-size:13px; margin-bottom:18px;">
                — atau —
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- EMAIL -->
                <input type="email" name="email" required
                       placeholder="Email"
                       style="width:100%; padding:12px; border-radius:10px;
                              border:none; margin-bottom:12px;
                              background:#020617; color:white;">

                <!-- PASSWORD -->
                <input type="password" name="password" required
                       placeholder="Password"
                       style="width:100%; padding:12px; border-radius:10px;
                              border:none; margin-bottom:12px;
                              background:#020617; color:white;">

                <!-- CAPTCHA -->
                <div style="margin-bottom:10px;">
                    <div id="captcha-image">{!! captcha_img() !!}</div>
                    <a href="javascript:void(0)"
                       onclick="refreshCaptcha()"
                       style="font-size:12px; color:#38bdf8;">Refresh captcha</a>
                </div>

                <input type="text" name="captcha" required
                       placeholder="Masukkan kode captcha"
                       style="width:100%; padding:12px; border-radius:10px;
                              border:none; margin-bottom:18px;
                              background:#020617; color:white;">

                <!-- BUTTON -->
                <button type="submit"
                        style="width:100%; padding:14px;
                               background:linear-gradient(135deg,#38bdf8,#6366f1);
                               border:none; border-radius:999px;
                               color:white; font-weight:700;
                               cursor:pointer;">
                    LOGIN
                </button>
            </form>

            <div style="margin-top:16px; text-align:center;">
                <a href="{{ route('password.request') }}"
                   style="font-size:12px; color:#94a3b8;">
                    Lupa password?
                </a>
            </div>

        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function refreshCaptcha(){
    $.get("{{ route('refresh.captcha') }}", function(data){
        $('#captcha-image').html(data.captcha);
    });
}
</script>

</body>
</html>
