{{-- resources/views/student/layout.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Student Dashboard')</title>

    <base href="{{ asset('assets') }}/" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min2167.css?v=3.2.0">

      <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">

    <link rel="stylesheet" href="dist/css/adminlte.min2167.css?v=3.2.0">

    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    @section('customCss')
        <link rel="stylesheet" href="{{ asset('assets/css/school-theme.css') }}">
    @endsection
    @yield('customCss')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{-- Top Navbar --}}
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('student.dashboard') }}" class="nav-link">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button"><i
                            class="fas fa-expand-arrows-alt"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#"><i class="far fa-user-circle"></i>
                        <span class="ml-1">{{ Auth::user()->name ?? 'Student' }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('student.dashboard') }}" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('student.logout') }}" method="POST" class="px-3 py-2 m-0">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger btn-block">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        {{-- Sidebar --}}
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
           <a href="index3.html" class="brand-link">
                <img src="{{ asset('assets/images/school-logo.png') }}" alt="AdminLTE Logo" class="brand-image rounded"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Student Pannel</span>
            </a>

            <div class="sidebar">
                {{-- User --}}
                <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-bottom:1px solid #1e293b;">
                    <div class="image">
                        @php
                            $u = Auth::user();
                            $avatarPath = $u->photo ?? $u->avatar ?? null;
                            $avatarUrl = $avatarPath ? (Str::startsWith($avatarPath, ['http', '/'])
                                ? $avatarPath
                                : asset($avatarPath)) : asset('assets/dist/img/user2-160x160.jpg');
                          @endphp
                        <img src="{{ $avatarUrl }}" class="img-circle elevation-2" alt="User">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ $u->name ?? 'Student' }}</a>
                    </div>
                </div>

                {{-- Menu --}}
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('student.dashboard') }}"
                                class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('student.timetable') }}"
                                class="nav-link {{ request()->routeIs('student.timetable') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clock"></i>
                                <p>Timetable</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('student.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-left" style="width:100%;">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>Logout</p>
                                </button>
                            </form>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        {{-- Content --}}
        <div class="content-wrapper">
            @hasSection('page_header')
                <section class="content-header">
                    <div class="container-fluid">@yield('page_header')</div>
                </section>
            @endif
            <section class="content">
                <div class="container-fluid">@yield('content')</div>
            </section>
        </div>

        {{-- Footer --}}
        <footer class="main-footer">
            <small>&copy; {{ date('Y') }} School Management.</small>
        </footer>

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="plugins/chart.js/Chart.min.js"></script>

    <script src="plugins/sparklines/sparkline.js"></script>

    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>

    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>

    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="plugins/summernote/summernote-bs4.min.js"></script>

    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <script src="dist/js/adminlte2167.js?v=3.2.0"></script>

    <script src="dist/js/demo.js"></script>

    <script src="dist/js/pages/dashboard.js"></script>
    @section('customJs')
        <script src="{{ asset('assets/js/school-theme.js') }}"></script>
    @endsection
    @yield('customJs')


<!-- 
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>$.widget.bridge('uibutton', $.ui.button)</script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="dist/js/adminlte2167.js?v=3.2.0"></script>
    @yield('customJs')
    @stack('scripts') -->
</body>

</html>