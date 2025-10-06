<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Login</title>
    <base href="{{asset('assets')}}/" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min2167.css?v=3.2.0">
    <style>
        .teacher-theme {
            background: linear-gradient(135deg, #00ffd5ff 0%, #764ba2 100%);
        }
        .teacher-card {
            border-color: #4a6572;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .teacher-header {
            background: linear-gradient(45deg, #3498db, #2980b9) !important;
            color: white;
            
        }
        .teacher-btn {
            background: linear-gradient(45deg, #3498db, #2980b9);
            border: none;
            transition: all 0.3s ease;
            color: #ffffffff;
        }
        .teacher-btn:hover {
            background: linear-gradient(45deg, #ffffffff, #ffffffff);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(54, 54, 54, 0.3);
            color: #2980b9;
        }
        .teacher-icon {
            color: #3498db;
        }
        .remember-check:checked {
            background-color: #3498db;
            border-color: #3498db;
        }
        .login-logo {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        .teacher-subtitle {
            color: #ffffffff;
            font-size: 1.1rem;
            margin-bottom: 0;
        }
    </style>
</head>

<body class="hold-transition login-page teacher-theme">
<div class="login-box">

<div class="card card-outline teacher-card">
<div class="card-header text-center teacher-header">
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-2"></i>
        {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        {{ Session::get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    
    <div class="login-logo">
        <i class="fas fa-chalkboard-teacher"></i>
    </div>
    <h3><b>Teacher</b> Portal</h3>
    <p class="teacher-subtitle">Access your teaching dashboard</p>
</div>

<div class="card-body">
<p class="login-box-msg">
    <i class="fas fa-sign-in-alt teacher-icon mr-2"></i>
    Sign in to your teacher account
</p>

<form action="{{route('teacher.authenticate')}}" method="post">
    @csrf
    
    <!-- Email Field -->
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Teacher Email" value="{{ old('email') }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope teacher-icon"></span>
            </div>
        </div>
    </div>
    @error('email')
    <div class="alert alert-warning py-1 px-3 mb-2">
        <small><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</small>
    </div>
    @enderror
    
    <!-- Password Field -->
    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock teacher-icon"></span>
            </div>
        </div>
    </div>
    @error('password')
    <div class="alert alert-warning py-1 px-3 mb-2">
        <small><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</small>
    </div>
    @enderror
    
    <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" id="remember" class="remember-check">
                <label for="remember" class="text-dark">
                    <small>Remember Me</small>
                </label>
            </div>
        </div>

        <div class="col-4">
            <button type="submit" class="btn teacher-btn btn-block">
                <i class="fas fa-sign-in-alt mr-1"></i> Sign In
            </button>
        </div>
    </div>
</form>

<!-- Additional Teacher Links -->
<div class="mt-4">
    <div class="text-center mb-2">
        <a href="#" class="text-dark">
            <small><i class="fas fa-key mr-1"></i>Forgot Password?</small>
        </a>
    </div>
    <div class="text-center">
        <small class="text-muted">
            <i class="fas fa-info-circle mr-1"></i>
            Contact administrator for account issues
        </small>
    </div>
</div>

</div>

<!-- Card Footer -->
<div class="card-footer text-center py-3">
    <small class="text-muted">
        <i class="fas fa-school mr-1"></i>
        School Management System &copy; {{ date('Y') }}
    </small>
</div>

</div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min2167.js?v=3.2.0"></script>

<script>
    $(document).ready(function() {
        // Add focus effects
        $('input[type="email"], input[type="password"]').focus(function() {
            $(this).parent().parent().css('border-color', '#3498db');
        }).blur(function() {
            $(this).parent().parent().css('border-color', '#ced4da');
        });
        
        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    });
</script>

</body>
</html>