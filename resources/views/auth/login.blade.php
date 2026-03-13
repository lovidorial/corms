<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Login CSS -->
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>
    <body>
        <div class="login-container">
            <!-- Left Panel - OSDW Info -->
            <div class="login-left-panel">
                <div class="login-logo">
                    <img src="{{ asset('images/osdw.logo.jpg') }}" alt="OSDW Logo" onerror="this.style.display='none'">
                </div>

                <h1 class="login-title">OSDW</h1>
                <h2 class="login-subtitle">Cagayan State University</h2>

                <div class="login-badge">OFFICE OF STUDENT DEVELOPMENT AND WELFARE</div>

                <p class="login-description">
                    Campus Student Organization Activities<br>
                    Tracking System — manage, monitor,<br>
                    and celebrate student activities
                </p>

                <div class="login-indicators">
                    <div class="indicator-dot active"></div>
                    <div class="indicator-dot"></div>
                    <div class="indicator-dot"></div>
                </div>
            </div>

            <!-- Right Panel - Login Form -->
            <div class="login-right-panel">
                <a href="{{ route('welcome') }}" class="login-back-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back
                </a>

                <div class="login-header">
                    <h1 class="login-heading">Welcome Back</h1>
                    <p class="login-subtext">Please log in to your account.</p>
                </div>

                <!-- Session Status -->
                @if ($errors->any())
                    <div class="session-status">
                        Please check the errors below.
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Email Address"
                            class="form-input"
                        />
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Password"
                            class="form-input"
                        />
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="form-actions">
                        <label class="form-checkbox">
                            <input
                                id="remember_me"
                                type="checkbox"
                                name="remember"
                                class="checkbox-input"
                            >
                            <span class="checkbox-label">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-password-link">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="login-button">Login</button>
                </form>

                <!-- Sign Up Link -->
                <div class="signup-section">
                    <span>Don't have an account?</span>
                    <a href="{{ route('register') }}" class="signup-link">Sign Up here</a>
                </div>
            </div>
        </div>
    </body>
</html>
