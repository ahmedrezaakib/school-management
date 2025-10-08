<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <base href="{{asset('assets')}}/" />
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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('customCss')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <h2 style="font-weight:700;color:#2563eb;letter-spacing:1px;">School Management</h2>
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/images/school-logo.png') }}" alt="School Logo"
                 class="brand-image rounded" style="opacity: .9; background:#fff;">
            <span class="brand-text font-weight-bold text-light">Admin Panel</span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{route('admin.dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Academic Year -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-calendar-check"></i>
                            <p>Academic Year<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="{{ route('academic-year.create') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> Add Academic Year</a></li>
                            <li class="nav-item"><a href="{{ route('academic-year.read') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> View Academic Year</a></li>
                        </ul>
                    </li>

                    <!-- Classes -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-school"></i>
                            <p>Classes<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="{{ route('class.create') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> Add Classes</a></li>
                            <li class="nav-item"><a href="{{ route('class.read') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> View Classes</a></li>
                        </ul>
                    </li>

                    <!-- Fees -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class='nav-icon fas fa-money-check'></i>
                            <p>Fees<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="{{ route('fee-head.create') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> Add Fees</a></li>
                            <li class="nav-item"><a href="{{ route('fee-head.read') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> View Fees</a></li>
                        </ul>
                    </li>

                    <!-- Fees Structure -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fab fa-elementor"></i>
                            <p>Fees Structure<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="{{ route('fee-structure.create') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> Add Fees Structure</a></li>
                            <li class="nav-item"><a href="{{ route('fee-structure.read') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> View Fees Structure</a></li>
                        </ul>
                    </li>

                    <!-- Student -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-grin"></i>
                            <p>Students Info<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="{{ route('student.create') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> Add New Student</a></li>
                            <li class="nav-item"><a href="{{ route('student.read') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> View Students</a></li>
                        </ul>
                    </li>

                    <!-- Notice -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-bell"></i>
                            <p>Notice<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="{{ route('announcement.create') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> Add Notice</a></li>
                            <li class="nav-item"><a href="{{ route('announcement.read') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> View Notices</a></li>
                        </ul>
                    </li>

                    <!-- Subject -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Subject<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="{{ route('subject.create') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> Add Subject</a></li>
                            <li class="nav-item"><a href="{{ route('subject.read') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> View Subject</a></li>
                        </ul>
                    </li>

                    <!-- Assign Subject -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>Assign Subject<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="{{ route('assign-subject.create') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> Add Assign</a></li>
                            <li class="nav-item"><a href="{{ route('assign-subject.read') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> View Assign</a></li>
                        </ul>
                    </li>

                    <!-- Teacher -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>Teacher<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="{{ route('teacher.create') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> Add Teacher</a></li>
                            <li class="nav-item"><a href="{{ route('teacher.read') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> View Teacher</a></li>
                        </ul>
                    </li>

                    <!-- Teacher Assign -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Teacher Assign<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="{{ route('assign-teacher.create') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> Assign Teacher</a></li>
                            <li class="nav-item"><a href="{{ route('assign-teacher.read') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> View Assign</a></li>
                        </ul>
                    </li>

                    <!-- ✅ Time Table -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-clock"></i>
                            <p>Time Table<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="{{ route('timetable.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> View Timetable</a></li>
                            <li class="nav-item"><a href="{{ route('timetable.create') }}" class="nav-link"><i class="far fa-circle nav-icon"></i> Add Period</a></li>
                        </ul>
                    </li>
                    <!-- ✅ End Time Table -->

                </ul>
            </nav>
        </div>
    </aside>

    @yield('content')

    <footer class="main-footer text-center text-sm">
        <strong>Copyright &copy; {{ date('Y') }} School Management System.</strong> All rights reserved.
    </footer>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.min2167.js?v=3.2.0"></script>
@yield('customJs')
</body>
</html>
