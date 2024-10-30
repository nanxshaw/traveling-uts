<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Traveling</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #4976e7; 
        }
        .navbar-brand {
            color: #FFF;
            font-weight: bold;
            font-size: 24px;
        }
        .navbar-nav .nav-link {
            color: white; 
            margin-left: 20px; 
            transition: background-color 0.3s, color 0.3s;
            font-size: 16px;
        }
        .navbar-nav .nav-link:hover {
            background-color: #004085;
        }
        .nav-item {
            border-radius: 10px;
        }
        footer {
            position: relative; 
            bottom: 0; 
            width: 100%; 
            padding: 10px 0; 
            background-color: #f8f9fa;
        }
        footer .text-muted {
            margin: 10px 0;
        }
        .container {
            margin-top: 20px; 
        }
        table.dataTable thead th {
            background-color: #f8f9fa;
        }
        table.dataTable thead th, table.dataTable thead td {
            border-bottom: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="{{ route('home') }}">Traveling</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tourists.index') }}">Wisata</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('accommodations.index') }}">Penginapan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('accommodation-orders.index') }}">Pemesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tourist-orders.index') }}">Order Wisata</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="text-center text-lg-start mt-4">
        <div class="text-center p-3">
            <span class="text-muted">Created By Nanang Tri Nur Wicaksono - 231011700253</span>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
