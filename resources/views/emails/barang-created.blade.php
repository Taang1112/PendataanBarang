<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Barang Baru Ditambahkan</title>
</head>
<body style="margin:0; padding:0; background:#0f172a; font-family: 'Inter', 'Segoe UI', Arial, sans-serif;">

    <div style="max-width:680px; margin:50px auto; padding:0 15px;">
        <div style="background:linear-gradient(135deg, #1e293b, #020617); border-radius:18px; overflow:hidden; box-shadow:0 20px 50px rgba(0,0,0,0.4);">

            <!-- TOP STRIPE -->
            <div style="height:6px; background:linear-gradient(90deg, #38bdf8, #6366f1, #a855f7);"></div>

            <!-- HEADER -->
            <div style="padding:35px 30px 25px; color:#ffffff;">
                <p style="margin:0; font-size:13px; letter-spacing:2px; color:#94a3b8;">
                    INVENTORY SYSTEM
                </p>
                <h1 style="margin:10px 0 0; font-size:26px; font-weight:700;">
                    Barang Baru Ditambahkan
                </h1>
                <p style="margin:8px 0 0; font-size:14px; color:#cbd5f5;">
                    Notifikasi otomatis dari sistem manajemen inventory
                </p>
            </div>

            <!-- BODY -->
            <div style="padding:30px; background:rgba(255,255,255,0.03); backdrop-filter: blur(10px);">

                <!-- HIGHLIGHT CARD -->
                <div style="padding:22px; border-radius:14px; background:linear-gradient(135deg, rgba(56,189,248,0.15), rgba(99,102,241,0.15)); border:1px solid rgba(255,255,255,0.08); margin-bottom:25px;">
                    <p style="margin:0; color:#e0e7ff; font-size:14px; line-height:1.7;">
                        Sebuah barang baru telah berhasil <strong style="color:#ffffff;">disimpan ke dalam sistem</strong>.
                        Silakan review detailnya di bawah ini.
                    </p>
                </div>

                <!-- DATA TABLE -->
                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:separate; border-spacing:0 14px;">
                    <tr>
                        <td style="color:#94a3b8; font-size:14px; width:35%;">Kategori</td>
                        <td style="color:#ffffff; font-weight:600;">{{ $barang->kategori->NamaKategori ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="color:#94a3b8; font-size:14px;">Nama Barang</td>
                        <td style="color:#f8fafc; font-weight:700; font-size:16px;">{{ $barang->NamaBarang }}</td>
                    </tr>
                    <tr>
                        <td style="color:#94a3b8; font-size:14px;">Stok</td>
                        <td style="color:#22c55e; font-weight:800;">{{ $barang->Stock }}</td>
                    </tr>
                    <tr>
                        <td style="color:#94a3b8; font-size:14px;">Harga</td>
                        <td style="color:#38bdf8; font-weight:800; font-size:15px;">
                            Rp {{ number_format($barang->Harga, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#94a3b8; font-size:14px; vertical-align:top;">Foto</td>
                        <td>
                            @if($barang->Foto)
                                <img src="{{ asset('foto_barang/'.$barang->Foto) }}" 
                                     style="max-width:180px; border-radius:14px; border:1px solid rgba(255,255,255,0.15); padding:8px; background:rgba(255,255,255,0.05); box-shadow:0 10px 25px rgba(0,0,0,0.4);">
                            @else
                                <span style="color:#64748b;">-</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <!-- CTA BUTTON -->
                <div style="margin-top:35px; text-align:center;">
                    <a href="{{ url('/dashboard') }}" 
                       style="display:inline-block; padding:14px 32px; background:linear-gradient(135deg, #38bdf8, #6366f1); color:#ffffff; text-decoration:none; border-radius:999px; font-size:14px; font-weight:700; letter-spacing:0.5px; box-shadow:0 10px 30px rgba(56,189,248,0.4);">
                        VIEW IN DASHBOARD
                    </a>
                </div>

            </div>

            <!-- FOOTER -->
            <div style="padding:22px; text-align:center; background:#020617; color:#64748b; font-size:12px;">
                <p style="margin:0;">
                    &copy; {{ date('Y') }} Inventory Management System
                </p>
                <p style="margin:6px 0 0; font-size:11px;">
                    Email ini dikirim otomatis, mohon tidak membalas email ini.
                </p>
            </div>

        </div>
    </div>

</body>
</html>
