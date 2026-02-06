<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Supplier; // 🔥 TAMBAH
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 🔥 BUAT USER + ROLE SUPPLIER
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'supplier', // otomatis supplier
        ]);

        // 🔥 OTOMATIS BUAT DATA SUPPLIER
        Supplier::create([
            'NamaSupplier' => $user->name,
            'Email' => $user->email,
        ]);

        // ================= EMAIL =================
        Mail::send([], [], function ($message) use ($user) {

            $html = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <title>Welcome</title>
            </head>
            <body style="margin:0; padding:0; background:#0f172a; font-family:Segoe UI, Arial, sans-serif;">

                <div style="max-width:680px; margin:50px auto; padding:0 15px;">
                    <div style="background:linear-gradient(135deg, #1e293b, #020617); border-radius:18px; overflow:hidden; box-shadow:0 20px 50px rgba(0,0,0,0.4);">

                        <div style="height:6px; background:linear-gradient(90deg, #38bdf8, #6366f1, #a855f7);"></div>

                        <div style="padding:35px 30px 25px; color:#ffffff;">
                            <p style="margin:0; font-size:13px; letter-spacing:2px; color:#94a3b8;">INVENTORY SYSTEM</p>
                            <h1 style="margin:10px 0 0; font-size:26px; font-weight:700;">Selamat Datang 👋</h1>
                            <p style="margin:8px 0 0; font-size:14px; color:#cbd5f5;">Akun kamu berhasil dibuat</p>
                        </div>

                        <div style="padding:30px; background:rgba(255,255,255,0.03);">

                            <div style="padding:22px; border-radius:14px; background:linear-gradient(135deg, rgba(56,189,248,0.15), rgba(99,102,241,0.15)); border:1px solid rgba(255,255,255,0.08); margin-bottom:25px;">
                                <p style="margin:0; color:#e0e7ff; font-size:14px; line-height:1.7;">
                                    Halo <strong style="color:#ffffff;">'.$user->name.'</strong>,  
                                    akun kamu telah <strong style="color:#ffffff;">berhasil terdaftar</strong> di sistem inventory kami.
                                </p>
                            </div>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:separate; border-spacing:0 14px;">
                                <tr>
                                    <td style="color:#94a3b8; font-size:14px; width:35%;">Nama</td>
                                    <td style="color:#ffffff; font-weight:600;">'.$user->name.'</td>
                                </tr>
                                <tr>
                                    <td style="color:#94a3b8; font-size:14px;">Email</td>
                                    <td style="color:#38bdf8; font-weight:600;">'.$user->email.'</td>
                                </tr>
                                <tr>
                                    <td style="color:#94a3b8; font-size:14px;">Role</td>
                                    <td style="color:#22c55e; font-weight:700;">Supplier</td>
                                </tr>
                            </table>

                            <div style="margin-top:35px; text-align:center;">
                                <a href="'.url('/login').'" 
                                   style="display:inline-block; padding:14px 32px; background:linear-gradient(135deg, #38bdf8, #6366f1); color:#ffffff; text-decoration:none; border-radius:999px; font-size:14px; font-weight:700;">
                                    LOGIN SEKARANG
                                </a>
                            </div>

                        </div>

                        <div style="padding:22px; text-align:center; background:#020617; color:#64748b; font-size:12px;">
                            <p style="margin:0;">&copy; '.date('Y').' Inventory Management System</p>
                        </div>

                    </div>
                </div>

            </body>
            </html>
            ';

            $message->to($user->email)
                    ->subject('Selamat Datang di Inventory System')
                    ->setBody($html, 'text/html');
        });

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
