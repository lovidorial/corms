<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORMS | Campus Student Organization Narrative Accomplishment and Summary Reports</title>

    {{-- Google Fonts: Poppins, Raleway, Oswald, Source Sans 3 --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Raleway:wght@600;700;800&family=Oswald:wght@400;600;700&family=Source+Sans+3:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome 6 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/welcomeblade.css') }}">
</head>
<body>

    {{-- ========================================================
         NAVBAR  —  matches screenshot: brand left, links, auth right
    ======================================================== --}}
    <nav class="site-navbar">
        <div class="navbar-inner">

            <div class="navbar-brand-wrap">
                <a href="{{ url('/') }}" class="nav-brand">CORMS</a>
            </div>

            <div class="nav-auth">
                @auth
                    <div class="nav-user" id="userDropdownWrap">
                        <button class="user-btn" id="userBtn">
                            <i class="fas fa-user-circle"></i>
                            <span>{{ Auth::user()->username ?? Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down caret"></i>
                        </button>
                        <div class="user-dropdown" id="userDropdownMenu">
                            <a href="{{ url('/dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                            <a href="{{ route('user.activities') }}"><i class="fas fa-calendar"></i> My Activities</a>
                            <hr>
                            <a href="{{ route('logout') }}" class="danger"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="nav-auth-link">Login</a>
                @endauth
            </div>

            <button class="hamburger" id="hamburgerBtn" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    {{-- ========================================================
         HERO — solid deep navy, large Oswald heading, two CTA buttons
    ======================================================== --}}
    <section class="hero hero-with-bg" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="hero-container">
            <h1 class="hero-heading">
                CAMPUS STUDENT<br>
                ORGANIZATION NARRATIVE ACCOMPLISHMENT AND SUMMARY REPORTS<br>
                SYSTEM
            </h1>
            <p class="hero-sub">
               CORMS an online platform for submitting and managing GPOA activity reports. It enables users to upload or encode reports and allows administrators to review and monitor all submissions.
            </p>
            <div class="hero-btns">
                @auth
                    <a href="{{ route('user.submit') }}" class="btn-primary-cta">
                        <i class="fas fa-plus-circle"></i> Submit Activity
                    </a>
                    <a href="{{ route('user.activities') }}" class="btn-outline-cta">
                        <i class="fas fa-calendar"></i> My Activities
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-outline-cta">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- Flash messages --}}
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    {{-- ========================================================
         UPCOMING ACTIVITIES
    ======================================================== --}}
    <section class="section-block">
        <div class="container">
            <h2 class="section-title">Recent Activities</h2>

            <div class="row">
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Sign in to view and submit activities.
                    </p>
                    @guest
                        <a href="{{ route('login') }}" class="btn-primary-cta d-inline-block mt-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Login to Continue
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================================
         FEATURE / STATS SECTION
    ======================================================== --}}
    <section class="section-block section-light">
        <div class="container">
            <h2 class="section-title">How It Works</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feat-card">
                        <div class="feat-icon fi-blue">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h5 class="feat-title">Browse Activities</h5>
                        <p class="feat-desc">
                            Discover various activities organized by student organizations on campus.
                        </p>
                        @guest
                            <a href="{{ route('login') }}" class="btn-feat btn-feat-blue">Get Started</a>
                        @endguest
                        @auth
                            <a href="{{ route('user.activities') }}" class="btn-feat btn-feat-blue">My Activities</a>
                        @endauth
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feat-card">
                        <div class="feat-icon fi-teal">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <h5 class="feat-title">Submit Reports</h5>
                        <p class="feat-desc">
                            Submit activity reports including documentation and communication letters.
                        </p>
                        @guest
                            <a href="{{ route('register') }}" class="btn-feat btn-feat-teal">Register Now</a>
                        @endguest
                        @auth
                            <a href="{{ route('user.submit') }}" class="btn-feat btn-feat-teal">Submit Report</a>
                        @endauth
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feat-card">
                        <div class="feat-icon fi-amber">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h5 class="feat-title">Track Status</h5>
                        <p class="feat-desc">
                            Monitor the approval status of your submitted activities in real-time.
                        </p>
                        @guest
                            <a href="{{ route('login') }}" class="btn-feat btn-feat-amber">Sign In</a>
                        @endguest
                        @auth
                            <a href="{{ route('user.activities') }}" class="btn-feat btn-feat-amber">View Status</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================================
         FOOTER
    ======================================================== --}}
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="footer-brand"><i class="fas fa-university me-2"></i>CSOATS</div>
                    <p class="footer-desc">
                        Campus Student Organization Activities Tracking System.<br>
                        A comprehensive platform for monitoring and managing student organization activities.
                    </p>
                </div>
                <div class="col-md-6 text-md-end mb-3">
                    <p class="footer-contact-title">Contact Us</p>
                    <p class="mb-1"><i class="fas fa-envelope me-2"></i>
                        <a href="mailto:activities@campus.edu" class="footer-link">activities@campus.edu</a>
                    </p>
                    <p class="mb-0"><i class="fas fa-phone me-2"></i>+1234567890</p>
                </div>
            </div>
            <hr class="footer-hr">
            <p class="footer-copy">
                &copy; {{ date('Y') }} Campus Student Organization Activities Tracking System. All Rights Reserved.
            </p>
        </div>
    </footer>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/auth.js') }}"></script>

</body>
</html>