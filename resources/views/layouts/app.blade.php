<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'QR Generator') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
        }
        .page-header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 0;
            margin-bottom: 25px;
        }
        .page-title {
            font-size: 1.4rem;
            font-weight: bold;
            color: #333;
            margin: 0;
        }
        .card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }
        footer {
            background-color: #fff;
            border-top: 1px solid #dee2e6;
            padding: 15px 0;
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-qr-code me-2"></i>QR Generator
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}"
                           href="{{ route('dashboard') }}">
                            <i class="bi bi-house me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('qr_codes.create') ? 'active fw-bold' : '' }}"
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

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i>Profil
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
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
