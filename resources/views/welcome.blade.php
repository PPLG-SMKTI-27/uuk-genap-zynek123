<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>POS System - Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
                overflow: hidden;
            }

            .landing-container {
                display: flex;
                min-height: 100vh;
            }

            .landing-left {
                flex: 1;
                background: #ffffff;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 60px 40px;
            }

            .landing-right {
                flex: 1;
                background: linear-gradient(135deg, #0052cc 0%, #003d99 50%, #004499 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                overflow: hidden;
            }

            .landing-right::before {
                content: '';
                position: absolute;
                width: 400px;
                height: 400px;
                background: rgba(255, 255, 255, 0.05);
                border-radius: 50%;
                top: -100px;
                right: -100px;
            }

            .landing-right::after {
                content: '';
                position: absolute;
                width: 300px;
                height: 300px;
                background: rgba(255, 255, 255, 0.03);
                border-radius: 50%;
                bottom: -50px;
                left: -50px;
            }

            .logo-section {
                text-align: center;
                margin-bottom: 40px;
            }

            .logo-icon {
                width: 80px;
                height: 80px;
                background: linear-gradient(135deg, #0052cc 0%, #003d99 100%);
                border-radius: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
                font-size: 40px;
            }

            .logo-text {
                font-size: 24px;
                font-weight: 700;
                color: #0052cc;
                margin-bottom: 8px;
            }

            .logo-subtitle {
                font-size: 14px;
                color: #666;
                font-weight: 500;
            }

            .login-form {
                width: 100%;
                max-width: 380px;
                position: relative;
                z-index: 1;
            }

            .login-form h2 {
                color: #ffffff;
                font-size: 28px;
                font-weight: 700;
                margin-bottom: 8px;
            }

            .login-form p {
                color: rgba(255, 255, 255, 0.8);
                margin-bottom: 30px;
                font-size: 14px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                color: rgba(255, 255, 255, 0.9);
                font-weight: 500;
                font-size: 13px;
                margin-bottom: 8px;
                display: block;
            }

            .form-group input[type="email"],
            .form-group input[type="password"] {
                width: 100%;
                padding: 12px 15px;
                border: none;
                border-radius: 8px;
                background: rgba(255, 255, 255, 0.95);
                color: #333;
                font-size: 14px;
                transition: all 0.3s ease;
            }

            .form-group input[type="email"]:focus,
            .form-group input[type="password"]:focus {
                outline: none;
                box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
                background: #ffffff;
            }

            .form-group input::placeholder {
                color: #999;
            }

            .remember-forgot {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 25px;
                font-size: 13px;
            }

            .remember-forgot label {
                color: rgba(255, 255, 255, 0.8);
                margin-bottom: 0;
                display: flex;
                align-items: center;
                cursor: pointer;
            }

            .remember-forgot input[type="checkbox"] {
                margin-right: 6px;
                cursor: pointer;
                width: 16px;
                height: 16px;
            }

            .remember-forgot a {
                color: rgba(255, 255, 255, 0.8);
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .remember-forgot a:hover {
                color: #ffffff;
            }

            .btn-signin {
                width: 100%;
                padding: 12px;
                background: linear-gradient(135deg, #5b7bff 0%, #4563e8 100%);
                color: white;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                font-size: 14px;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(91, 123, 255, 0.3);
            }

            .btn-signin:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(91, 123, 255, 0.4);
            }

            .btn-signin:active {
                transform: translateY(0);
            }

            .signup-link {
                text-align: center;
                margin-top: 20px;
                font-size: 13px;
                color: rgba(255, 255, 255, 0.8);
            }

            .signup-link a {
                color: #ffffff;
                font-weight: 600;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .signup-link a:hover {
                color: #5b7bff;
            }

            .error-message {
                background: rgba(255, 59, 48, 0.1);
                border: 1px solid rgba(255, 59, 48, 0.3);
                color: #ff3b30;
                padding: 10px 12px;
                border-radius: 6px;
                font-size: 13px;
                margin-bottom: 20px;
            }

            .error-message ul {
                margin: 0;
                padding-left: 20px;
            }

            .error-message li {
                margin: 5px 0;
            }

            @media (max-width: 768px) {
                .landing-container {
                    flex-direction: column;
                }

                .landing-left, .landing-right {
                    min-height: 50vh;
                }

                .logo-section {
                    margin-bottom: 20px;
                }

                .login-form h2 {
                    font-size: 22px;
                }

                .login-form p {
                    font-size: 13px;
                }
            }
        </style>
    </head>
    <body>
        <div class="landing-container">
            <!-- Left Side -->
            <div class="landing-left">
                <div class="logo-section">
                    <div class="logo-icon">🏢</div>
                    <div class="logo-text">POS DASHBOARD</div>
                    <div class="logo-subtitle">Mengelola Produk Dan Transaksi</div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="landing-right">
                <div class="login-form">
                    <h2>Sign In</h2>
                    <p>Welcome back! Please sign in to your account</p>

                    @if($errors->any())
                        <div class="error-message">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Your email</label>
                            <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Enter your password" required>
                        </div>

                        <div class="remember-forgot">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                Remember me
                            </label>
                            <a href="#">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn-signin">SIGN IN</button>

                        <div class="signup-link">
                            Don't have an account? <a href="{{ route('register') }}">Sign up here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
