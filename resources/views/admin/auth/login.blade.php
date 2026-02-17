<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Pet Zone</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --cream: #FAF7F2;
            --ink: #2E2E2C;
            --accent: #E8521A;
            --sage: #4A6741;
            --card-bg: #FEFCF9;
            --border: #E8E4E0;
            --light-sage: #EEF3EB;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
        }

        body {
            background: linear-gradient(135deg, var(--ink) 0%, #1a1a18 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem;
        }

        .card-bg {
            background: var(--card-bg);
        }

        .admin-login-container {
            width: 100%;
            /* max-width: 900px; */
        }

        .admin-login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(232,82,26,0.4);
        }

        .admin-login-btn:active {
            transform: translateY(0);
        }

        /* Mobile Responsive Styles */
        @media (max-width: 991px) {
            body {
                padding: 0.75rem;
            }

            .h1-mobile {
                font-size: 2rem !important;
                letter-spacing: 1px !important;
            }

            .security-title {
                font-size: 0.9rem !important;
            }

            .security-desc {
                font-size: 0.8rem !important;
            }

            .login-form-card {
                padding: 2rem !important;
            }

            .login-form-card .form-label {
                font-size: 0.85rem !important;
            }

            .login-form-card input[type="email"],
            .login-form-card input[type="password"] {
                padding: 0.75rem !important;
                font-size: 0.95rem !important;
            }

            .admin-login-btn {
                font-size: 1rem !important;
                padding: 0.9rem !important;
            }

            .security-features {
                gap: 1rem !important;
            }

            .security-item {
                gap: 0.75rem !important;
            }

            .security-item-text h3 {
                font-size: 0.85rem !important;
                margin-bottom: 0.2rem !important;
            }

            .security-item-text p {
                font-size: 0.75rem !important;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 0.5rem;
                align-items: flex-start;
                padding-top: 1rem;
                justify-content: center;
            }

            .container-fluid {
                padding: 0;
            }

            .h1-mobile {
                font-size: 1.5rem !important;
                margin-bottom: 0.5rem !important;
            }

            .login-form-card {
                padding: 1.5rem !important;
                border-radius: 1rem !important;
            }

            .admin-login-btn {
                font-size: 0.95rem !important;
                padding: 0.8rem !important;
                letter-spacing: 0px !important;
            }

            .login-form-card .form-label {
                font-size: 0.8rem !important;
                margin-bottom: 0.4rem !important;
            }

            .login-form-card input[type="email"],
            .login-form-card input[type="password"] {
                padding: 0.7rem !important;
                font-size: 0.9rem !important;
                border-radius: 0.4rem !important;
            }

            .security-item-icon {
                width: 32px !important;
                height: 32px !important;
            }

            .security-item-icon i {
                font-size: 1.1rem !important;
            }

            .divider-text {
                font-size: 0.8rem !important;
            }

            .back-to-store-link {
                font-size: 0.85rem !important;
            }

            .security-notice {
                font-size: 0.75rem !important;
                padding: 0.6rem !important;
                margin-top: 1rem !important;
            }

            .error-message {
                font-size: 0.8rem !important;
                padding: 0.75rem !important;
                margin-bottom: 1rem !important;
            }

            .error-message p {
                font-size: 0.8rem !important;
                margin: 0.2rem 0 !important;
            }
        }
    </style>
</head>
<body>

    <!-- ══════════ ADMIN LOGIN CONTAINER ══════════ -->
    <div style=" min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem; padding-top: 2rem;">
        <div class="admin-login-container">
            <div class="row justify-content-center align-items-center g-4">
                <!-- Left Panel: Security Info (Hidden on Mobile) -->
                <div class="col-lg-5 d-none d-lg-flex" style="flex-direction: column; justify-content: center; gap: 2rem; color: rgba(250,247,242,0.9);">
                    <div>
                        <h1 class="h1-mobile" style="font-family: 'Bebas Neue', sans-serif; color: white; margin-bottom: 1rem;">
                            Admin <span style="color: var(--accent);">Portal</span>
                        </h1>
                        <p style="font-size: 1.1rem; line-height: 1.6; margin-bottom: 2rem;">Secure access to your store management dashboard</p>
                    </div>

                    <!-- Security Features -->
                    <div class="security-features" style="display: flex; gap: 1.5rem; flex-direction: column;">
                        <div class="security-item" style="display: flex; gap: 1rem; align-items: flex-start;">
                            <div class="security-item-icon" style="width: 40px; height: 40px; background: rgba(232,82,26,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-shield-check" style="color: var(--accent); font-size: 1.3rem;"></i>
                            </div>
                            <div class="security-item-text">
                                <h3 style="color: white; font-weight: 600; margin-bottom: 0.3rem; font-size: 1rem;">Secure Authentication</h3>
                                <p style="color: rgba(250,247,242,0.7); font-size: 0.9rem; margin: 0;">Your account is protected with industry-standard security</p>
                            </div>
                        </div>

                        <div class="security-item" style="display: flex; gap: 1rem; align-items: flex-start;">
                            <div class="security-item-icon" style="width: 40px; height: 40px; background: rgba(232,82,26,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-graph-up" style="color: var(--accent); font-size: 1.3rem;"></i>
                            </div>
                            <div class="security-item-text">
                                <h3 style="color: white; font-weight: 600; margin-bottom: 0.3rem; font-size: 1rem;">Manage Everything</h3>
                                <p style="color: rgba(250,247,242,0.7); font-size: 0.9rem; margin: 0;">Products, categories, orders, and more in one place</p>
                            </div>
                        </div>

                        <div class="security-item" style="display: flex; gap: 1rem; align-items: flex-start;">
                            <div class="security-item-icon" style="width: 40px; height: 40px; background: rgba(232,82,26,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-lightning-fill" style="color: var(--accent); font-size: 1.3rem;"></i>
                            </div>
                            <div class="security-item-text">
                                <h3 style="color: white; font-weight: 600; margin-bottom: 0.3rem; font-size: 1rem;">Real-time Updates</h3>
                                <p style="color: rgba(250,247,242,0.7); font-size: 0.9rem; margin: 0;">See live data about your store performance instantly</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Panel: Login Form -->
                <div class="col-12 col-lg-5">
                    <div class="login-form-card card-bg rounded-3 p-5" style="border: 2px solid var(--accent); box-shadow: 0 20px 60px rgba(232,82,26,0.2);">
                        <!-- Logo -->
                        <div style="text-align: center; margin-bottom: 2rem;">
                            <div style="width: 60px; height: 60px; background: rgba(232,82,26,0.1); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-shield-lock" style="font-size: 2rem; color: var(--accent);"></i>
                            </div>
                            <div style="font-family: 'Bebas Neue', sans-serif; font-size: 1.8rem; color: var(--ink); letter-spacing: 1px;">
                                Admin <span style="color: var(--accent);">Login</span>
                            </div>
                            <p style="color: #999; font-size: 0.85rem; margin-top: 0.5rem;">Authorized Personnel Only</p>
                        </div>

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="error-message" style="background: rgba(232,82,26,0.1); border: 1px solid rgba(232,82,26,0.3); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.5rem;">
                                <p style="color: var(--accent); font-size: 0.9rem; margin: 0; font-weight: 600; margin-bottom: 0.5rem;">
                                    <i class="bi bi-exclamation-triangle me-2"></i> Login Failed
                                </p>
                                @foreach ($errors->all() as $error)
                                    <p style="color: var(--accent); font-size: 0.85rem; margin: 0.3rem 0;">
                                        • {{ $error }}
                                    </p>
                                @endforeach
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('admin.login.store') }}">
                            @csrf

                            <!-- Email -->
                            <div class="mb-4">
                                <label class="form-label" style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">
                                    <i class="bi bi-envelope-fill me-2" style="color: var(--accent);"></i> Email Address
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}" required autofocus style="width: 100%; padding: 0.85rem; border: 2px solid @error('email') rgba(232,82,26,0.5) @else rgba(232,82,26,0.2) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif; background: rgba(232,82,26,0.05); transition: all 0.3s; font-size: 1rem;" onfocus="this.style.borderColor='var(--accent)';" onblur="this.style.borderColor='rgba(232,82,26,0.2)';">
                                @error('email')
                                    <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">
                                        <i class="bi bi-dash-circle-fill me-1"></i> {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-2">
                                <label class="form-label" style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">
                                    <i class="bi bi-lock-fill me-2" style="color: var(--accent);"></i> Password
                                </label>
                                <input type="password" name="password" required style="width: 100%; padding: 0.85rem; border: 2px solid @error('password') rgba(232,82,26,0.5) @else rgba(232,82,26,0.2) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif; background: rgba(232,82,26,0.05); transition: all 0.3s; font-size: 1rem;" onfocus="this.style.borderColor='var(--accent)';" onblur="this.style.borderColor='rgba(232,82,26,0.2)';">
                                @error('password')
                                    <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">
                                        <i class="bi bi-dash-circle-fill me-1"></i> {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-4" style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" id="remember" name="remember" value="1" style="width: 18px; height: 18px; cursor: pointer; accent-color: var(--accent);">
                                <label for="remember" style="margin: 0; color: #666; font-size: 0.9rem; cursor: pointer;">Remember this device</label>
                            </div>

                            <!-- Login Button -->
                            <button type="submit" class="admin-login-btn" style="width: 100%; padding: 1rem; background: linear-gradient(135deg, var(--accent) 0%, #d96b1a 100%); color: white; border: none; border-radius: 0.5rem; font-weight: 700; font-family: 'Bebas Neue', sans-serif; cursor: pointer; font-size: 1.1rem; letter-spacing: 1px; transition: all 0.3s; box-shadow: 0 4px 15px rgba(232,82,26,0.3);">
                                <i class="bi bi-arrow-right me-2"></i> Access Admin Panel
                            </button>
                        </form>

                        <!-- Divider -->
                        <div style="display: flex; align-items: center; gap: 1rem; margin: 2rem 0; opacity: 0.3;">
                            <hr style="flex: 1; border: none; border-top: 1px solid var(--ink);">
                            <span class="divider-text" style="color: var(--ink);">or</span>
                            <hr style="flex: 1; border: none; border-top: 1px solid var(--ink);">
                        </div>

                        <!-- Back to Client Area -->
                        <div style="text-align: center;">
                            <p style="color: #666; font-size: 0.9rem; margin-bottom: 0.5rem;">Not an admin?</p>
                            <a href="{{ route('index') }}" class="back-to-store-link" style="color: var(--accent); text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s;">
                                <i class="bi bi-house-fill"></i> Back to Store
                            </a>
                        </div>

                        <!-- Security Notice -->
                        <div class="security-notice" style="background: rgba(74,103,65,0.08); border: 1px solid rgba(74,103,65,0.2); border-radius: 0.5rem; padding: 0.75rem; margin-top: 1.5rem; text-align: center;">
                            <p style="color: var(--sage); font-size: 0.8rem; margin: 0; font-weight: 500;">
                                <i class="bi bi-info-circle me-1"></i> Admin credentials: admin@petzone.com / admin@123
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>