<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'QR Generator') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #ffffff;
            font-family: Arial, sans-serif;
            color: #111111;
        }
        .navbar-custom {
            background-color: #111111;
            border-bottom: 2px solid #333;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
            color: #ffffff !important;
        }
        .nav-link {
            color: #cccccc !important;
        }
        .nav-link:hover, .nav-link.active {
            color: #ffffff !important;
        }
        .page-header {
            background-color: #f5f5f5;
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
            margin-bottom: 25px;
        }
        .page-title {
            font-size: 1.4rem;
            font-weight: bold;
            color: #111;
            margin: 0;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        .btn-primary {
            background-color: #111;
            border-color: #111;
        }
        .btn-primary:hover {
            background-color: #333;
            border-color: #333;
        }
        .btn-success {
            background-color: #111;
            border-color: #111;
        }
        .btn-success:hover {
            background-color: #333;
            border-color: #333;
        }
        .btn-outline-success {
            color: #111;
            border-color: #111;
        }
        .btn-outline-success:hover {
            background-color: #111;
            color: #fff;
        }
        .text-success { color: #111 !important; }
        .bg-success   { background-color: #111 !important; }
        .alert-info   { background-color: #f5f5f5; border-color: #ddd; color: #333; }
        .alert-warning{ background-color: #f9f9f9; border-color: #ccc; color: #333; }
        .badge.bg-success { background-color: #111 !important; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-qr-code me-2"></i>QR Generator
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
                    style="border-color:#555">
                <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') || request()->routeIs('qr_codes.create') ? 'active fw-bold' : '' }}"
                           href="{{ route('qr_codes.create') }}">
                            <i class="bi bi-plus-circle me-1"></i>Buat QR
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('qr_codes.index') ? 'active fw-bold' : '' }}"
                           href="{{ route('qr_codes.index') }}">
                            <i class="bi bi-clock-history me-1"></i>History
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    @isset($header)
    <div class="page-header">
        <div class="container">
            {{ $header }}
        </div>
    </div>
    @endisset

    <!-- Main Content -->
    <main class="py-3">
        <div class="container">
            {{ $slot }}
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
