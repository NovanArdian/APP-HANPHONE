<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Novan Cell</title>

    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Asset : memanggil file yg ada di folder public biasanya untuk css,js atau gambar/file tambahan -->
    <link rel="icon" href="{{ asset('images/logo.jpg') }}">

    @stack('style')

    <style>
        /* Sidebar Styles */
        body {
            font-family: 'Arial', sans-serif;
            overflow-x: hidden;
            background-color: #f4f6f9;
        }
    
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(to right, #0d81ed, #192277);
            padding-top: 20px;
            transition: all 0.3s ease;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
    
        .sidebar a {
            padding: 16px 20px;
            text-decoration: none;
            font-size: 18px;
            color: #f8f9fa;
            display: block;
            transition: background-color 0.3s ease, color 0.3s ease;
            border-radius: 5px;
        }
    
        .sidebar a:hover {
            background-color: #2e3882; /* Perubahan warna background saat di hover */
            color: white; /* Perubahan warna teks saat di hover */
        }
    
        .sidebar .active {
            background-color: #007bff;
        }
    
        .sidebar i {
            margin-right: 15px;
        }
    
        .sidebar .navbar-brand {
            color: white;
            font-size: 24px;
            font-weight: bold;
            padding: 20px 0;
            text-align: center;
        }
    
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s ease;
        }
    
        /* Toggler for mobile view */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
    
            .content {
                margin-left: 0;
            }
        }
    
        /* Active link color */
        .navbar-nav .nav-link.active {
            color: #fff;
            background-color: #22328d;
        }
    </style>
    
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-mobile-alt"></i> Novan Cell</a>
            @if(Auth::check())
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('landing_page') ? 'active' : '' }}" href="{{ route('landing_page') }}">
                        <i class="fas fa-home"></i> Landing
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('data_hpt') ? 'active' : '' }}" href="{{ route('data_hp.data') }}">
                        <i class="fas fa-mobile-alt"></i> Data Handphone
                    </a>                    
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('kelola-akun') ? 'active' : '' }}" href="{{ route('kelola_akun.data') }}">
                        <i class="fas fa-users-cog"></i> Kelola Akun
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('order') ? 'active' : '' }}" href="{{ route('order.data') }}">
                        <i class="fas fa-cart-plus"></i> Pembelian
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kasir.order') }}">
                        <i class="fas fa-cart-arrow-down"></i> Pembelian
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
            @endif
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="content">
        {{-- yield : mengisi bagian content dinamis/bagian yg akan berubah-ubah di tiap halamannya --}}
        @yield('content-dinamis')

        <footer></footer>
    </div>

    <!-- CDN Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    {{-- stack : tidak wajib diisi oleh view yg extends nya (optional), kalau yield wajib diisi oleh view extends nya --}}
    @stack('script')
</body>

</html>
