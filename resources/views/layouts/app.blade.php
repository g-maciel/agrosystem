<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroSystem - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            min-height: 100vh;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar a {
            color: #000;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #e9ecef;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }
        .card-custom {
            transition: transform 0.2s;
        }
        .card-custom:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">Menu</h4>
        <a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="{{ route('despesas') }}"><i class="fas fa-money-bill-wave"></i> Despesas</a>
        <a href="{{ route('contratados') }}"><i class="fas fa-users"></i> Contratados</a>
        <a href="{{ route('fazenda') }}"><i class="fas fa-tractor"></i> Fazenda</a>
    </div>
    <div class="content">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>