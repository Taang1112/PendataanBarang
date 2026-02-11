<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
        <!-- Tema Dark Blue -->
        <style>
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
            }
            
            body {
                background: var(--gradient-dark) !important;
                color: var(--text-primary) !important;
                font-family: 'Inter', 'Nunito', sans-serif !important;
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }
            
            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: 
                    radial-gradient(circle at 10% 20%, rgba(37, 99, 235, 0.15) 0%, transparent 20%),
                    radial-gradient(circle at 90% 80%, rgba(100, 255, 218, 0.1) 0%, transparent 20%);
                z-index: -1;
            }
            
            /* Header Styling */
            header.bg-white.shadow {
                background: rgba(10, 25, 47, 0.85) !important;
                backdrop-filter: blur(10px) !important;
                border-bottom: 1px solid rgba(100, 255, 218, 0.1) !important;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3) !important;
            }
            
            /* Content Styling */
            main {
                padding: 20px;
                max-width: 1400px;
                margin: 0 auto;
            }
            
            /* Container Styling */
            .max-w-7xl {
                max-width: 1400px !important;
            }
            
            .mx-auto {
                margin-left: auto !important;
                margin-right: auto !important;
            }
            
            .py-6 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }
            
            .px-4 {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
            
            /* Text Styling */
            h1, h2, h3, h4, h5, h6 {
                color: var(--text-primary) !important;
            }
            
            /* Utility Classes */
            .bg-gray-100 {
                background: transparent !important;
            }
            
            /* Button Styling */
            .btn-primary {
                background: var(--gradient-blue) !important;
                border: none !important;
                color: white !important;
                padding: 10px 20px !important;
                border-radius: 8px !important;
                font-weight: 600 !important;
                transition: all 0.3s ease !important;
            }
            
            .btn-primary:hover {
                transform: translateY(-2px) !important;
                box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3) !important;
            }
            
            /* Card Styling */
            .card {
                background: rgba(17, 34, 64, 0.8) !important;
                border: 1px solid rgba(100, 255, 218, 0.15) !important;
                border-radius: 12px !important;
                backdrop-filter: blur(10px) !important;
                color: var(--text-primary) !important;
            }
            
            .card-header {
                background: rgba(30, 41, 59, 0.4) !important;
                border-bottom: 1px solid rgba(100, 255, 218, 0.1) !important;
                color: var(--accent-blue) !important;
                padding: 15px 20px !important;
            }
            
            /* Form Styling */
            input, select, textarea {
                background: rgba(17, 34, 64, 0.6) !important;
                border: 1px solid rgba(100, 255, 218, 0.1) !important;
                color: var(--text-primary) !important;
                border-radius: 8px !important;
                padding: 10px 15px !important;
            }
            
            input:focus, select:focus, textarea:focus {
                border-color: var(--accent-blue) !important;
                box-shadow: 0 0 0 3px rgba(100, 255, 218, 0.1) !important;
                outline: none !important;
            }
            
            /* Table Styling */
            table {
                color: var(--text-primary) !important;
                background: rgba(17, 34, 64, 0.6) !important;
                border-radius: 8px !important;
                overflow: hidden !important;
            }
            
            table thead {
                background: rgba(30, 41, 59, 0.8) !important;
            }
            
            table th {
                border-bottom: 1px solid rgba(100, 255, 218, 0.1) !important;
                color: var(--text-secondary) !important;
                padding: 15px !important;
            }
            
            table td {
                border-color: rgba(100, 255, 218, 0.05) !important;
                padding: 12px 15px !important;
            }
            
            /* Scrollbar Styling */
            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }
            
            ::-webkit-scrollbar-track {
                background: rgba(10, 25, 47, 0.5);
            }
            
            ::-webkit-scrollbar-thumb {
                background: rgba(100, 255, 218, 0.3);
                border-radius: 4px;
            }
            
            ::-webkit-scrollbar-thumb:hover {
                background: rgba(100, 255, 218, 0.5);
            }
        </style>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>