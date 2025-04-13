<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EnergySmart')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .auth-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 2rem;
        }
        .auth-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .auth-header {
            background-color: #0d6efd;
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        .auth-footer {
            text-align: center;
            margin-top: 1rem;
            color: #6c757d;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="auth-logo">
            <h2><i class="bi bi-lightning-charge"></i> EnergySmart</h2>
        </div>
        
        <div class="auth-container">
            <div class="card auth-card">
                <div class="card-header auth-header">
                    <h4 class="mb-0">@yield('auth-title')</h4>
                </div>
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
            
            <div class="auth-footer">
                @yield('auth-footer')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>