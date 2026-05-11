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
        .auth-card {
            max-width: 420px;
            margin: 60px auto;
        }
        .brand-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .brand-header i {
            font-size: 2.5rem;
            color: #198754;
        }
        .brand-header h4 {
            color: #198754;
            font-weight: bold;
            margin-top: 8px;
        }
        .brand-header p {
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="auth-card">
            <!-- Logo -->
            <div class="brand-header">
                <i class="bi bi-qr-code-scan"></i>
                <h4>QR Generator</h4>
                <p>Generate QR Code untuk semua kebutuhan</p>
            </div>

            <!-- Card -->
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
