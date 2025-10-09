<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to EverGreen International School</title>

    <!-- Bootstrap / FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }

        .navbar {
            background: linear-gradient(180deg, #0b1220 0%, #00216eff 100%);
        }

        .navbar-brand {
            font-weight: 600;
            color: #fff !important;
        }

        .nav-link,
        .btn-login {
            color: #fff !important;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-login:hover {
            color: #007bff !important;
            background-color: #fff !important;
        }

        .hero {
            background: url('{{ asset('assets/images/image.png') }}') center/cover no-repeat;
            height: 85vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .section {
            padding: 60px 0;
        }

        footer {
            background: linear-gradient(180deg, #0b1220 0%, #00216eff 100%);
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .stats {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .05);
        }

        .hero>.content {
            position: relative;
            z-index: 2;
            max-width: 900px;
            padding: 0 1rem;
        }

        .hero h1 {
            font-weight: 800;
            letter-spacing: .3px;
        }

        .hero p.lead {
            opacity: .95
        }

        .feature-card {
            border: 0;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
            transition: .25s;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .08);
        }

        .badge-soft {
            background: rgba(255, 255, 255, .2);
            border: 1px solid rgba(255, 255, 255, .35);
            color: #fff;
        }

        .program {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .06);
        }

        .program img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .notice {
            border-left: 4px solid var(--brand);
            background: #fff;
        }

        .notice small {
            color: #64748b
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark py-3 shadow">
        <div class="container">
            <a class="brand-link">
                <img src="{{ asset('assets/images/school-logo.png') }}" alt="School Logo" class="brand-image rounded"
                    style="opacity: .9; background:#fff; height:40px; height:45px; margin-right:10px;">
            </a>
            <a class="navbar-brand" href="#">EverGreen International School</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item">
                        <a href="{{ route('admin.login') }}" class="btn btn-outline-light btn-login">
                            <i class="fas fa-user-shield"></i> Admin Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.login') }}" class="btn btn-outline-light btn-login">
                            <i class="fas fa-chalkboard-teacher"></i> Teacher Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.login') }}" class="btn btn-outline-light btn-login">
                            <i class="fas fa-user-graduate"></i> Student Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-content text-white">
            <h1>EverGreen International School</h1>
            <p>Empowering Students for a Brighter Tomorrow</p>
        </div>
    </section>

    <section id="programs" class="py-5">
        <div class="container">
            <div class="text-center mb-4" data-aos="fade-up">
                <h2 class="fw-bold">Academic Programs</h2>
                <p class="text-muted">Engaging pathways for every learner.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="zoom-in">
                    <div class="program bg-white">
                        <img src="https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?q=80&w=1200&auto=format&fit=crop"
                            alt="">
                        <div class="p-3">
                            <h5>Early Years (Play–KG)</h5>
                            <p class="text-muted mb-0">Exploration, play-based learning, social-emotional growth.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="program bg-white">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1200&auto=format&fit=crop"
                            alt="">
                        <div class="p-3">
                            <h5>Primary (Grades 1–5)</h5>
                            <p class="text-muted mb-0">Literacy, numeracy, curiosity and confidence building.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="program bg-white">
                        <img src="https://images.unsplash.com/photo-1513258496099-48168024aec0?q=80&w=1200&auto=format&fit=crop"
                            alt="">
                        <div class="p-3">
                            <h5>Middle & Secondary (6–12)</h5>
                            <p class="text-muted mb-0">Advanced STEM, humanities, counseling, career guidance.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="stats mt-5 p-4 p-lg-5 text-center" data-aos="fade-up">
                <div class="row g-4">
                    <div class="col-6 col-lg-3">
                        <h2 class="fw-bold mb-0">1,200+</h2>
                        <div class="text-muted">Students</div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <h2 class="fw-bold mb-0">75+</h2>
                        <div class="text-muted">Expert Teachers</div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <h2 class="fw-bold mb-0">30+</h2>
                        <div class="text-muted">Clubs & Teams</div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <h2 class="fw-bold mb-0">100%</h2>
                        <div class="text-muted">Board Pass Rate</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NOTICES -->
    <section id="notices" class="py-5">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-3" data-aos="fade-up">
                <h2 class="fw-bold mb-0">Latest Notices</h2>
            </div>

            @if(isset($announcements) && $announcements->count())
                <div class="list-group shadow-sm rounded-2xl">
                    @foreach($announcements as $n)
                        <div class="list-group-item notice p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">{{ $n->notice }}</h6>
                                    @if(!empty($n->type))
                                        <span class="badge bg-primary text-light mt-1">{{ ucfirst($n->type) }}</span>
                                    @endif
                                </div>
                                <small class="text-muted">
                                    {{ $n->created_at ? \Carbon\Carbon::parse($n->created_at)->format('d M Y') : '' }}
                                </small>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-light border">No notices published yet. Please check back soon.</div>
            @endif
        </div>
    </section>


    <!-- About Section -->
    <section id="about" class="section bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">About Our School</h2>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                EverGreen International School is committed to academic excellence, innovation, and nurturing every
                student's
                potential.
                We believe in creating a safe, inclusive, and stimulating environment for holistic growth.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>© {{ date('Y') }} Green Valley School — All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>