<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beta Artpractica | Dashboard</title>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div id="app" class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('adminlte/dist/img/img.png')}}" alt="Logo" height="60" width="60">
        </div>

        <!-- Navbar -->
        @include('adminlte.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link" style="height: 60px">
                <img src="{{asset('adminlte/dist/img/img.png')}}" alt="Logo" class="brand-image"
                     style="opacity: .8;">
            </a>

            <!-- Sidebar -->
            @include('adminlte.sidebar')
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('content')

        <!-- /.content-wrapper -->
        @include('adminlte.footer')
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>

@stack('scripts')
</body>
</html>

