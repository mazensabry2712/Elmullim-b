<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ELMULLIM</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 50%, #00b894 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            animation: float 20s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 80%, rgba(0, 184, 148, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(30, 58, 95, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(44, 82, 130, 0.08) 0%, transparent 50%);
            animation: backgroundPulse 8s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes backgroundPulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.7;
                transform: scale(1.1);
            }
        }

        .animated-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: particleFloat 15s infinite linear;
        }

        .particle:nth-child(1) {
            left: 10%;
            animation-delay: 0s;
            animation-duration: 20s;
        }

        .particle:nth-child(2) {
            left: 20%;
            animation-delay: 2s;
            animation-duration: 25s;
        }

        .particle:nth-child(3) {
            left: 30%;
            animation-delay: 4s;
            animation-duration: 18s;
        }

        .particle:nth-child(4) {
            left: 40%;
            animation-delay: 6s;
            animation-duration: 22s;
        }

        .particle:nth-child(5) {
            left: 50%;
            animation-delay: 8s;
            animation-duration: 27s;
        }

        .particle:nth-child(6) {
            left: 60%;
            animation-delay: 10s;
            animation-duration: 19s;
        }

        .particle:nth-child(7) {
            left: 70%;
            animation-delay: 12s;
            animation-duration: 24s;
        }

        .particle:nth-child(8) {
            left: 80%;
            animation-delay: 14s;
            animation-duration: 21s;
        }

        .particle:nth-child(9) {
            left: 90%;
            animation-delay: 16s;
            animation-duration: 26s;
        }

        .particle:nth-child(10) {
            left: 15%;
            animation-delay: 1s;
            animation-duration: 23s;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 0.8;
            }

            90% {
                opacity: 0.8;
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        .wave-animation {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(0deg, rgba(0, 184, 148, 0.1) 0%, transparent 100%);
            animation: wave 10s ease-in-out infinite;
        }

        .wave-animation::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 200%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="rgba(0, 184, 148, 0.05)"/></svg>');
            animation: waveMove 15s ease-in-out infinite;
        }

        @keyframes wave {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes waveMove {
            0% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(-25%);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            padding: 50px 40px;
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #1e3a5f 0%, #00b894 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            animation: logoFloat 3s ease-in-out infinite;
            overflow: hidden;
        }

        .logo::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            animation: shimmer 2s infinite;
        }

        .logo-image {
            width: 80px;
            height: 80px;
            object-fit: contain;
            position: relative;
            z-index: 2;
            animation: logoSpin 8s linear infinite;
            filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
        }

        @keyframes logoFloat {

            0%,
            100% {
                transform: translateY(0px) scale(1);
                box-shadow: 0 10px 30px rgba(0, 184, 148, 0.3);
            }

            50% {
                transform: translateY(-8px) scale(1.05);
                box-shadow: 0 20px 40px rgba(0, 184, 148, 0.4);
            }
        }

        @keyframes logoSpin {
            0% {
                transform: rotate(0deg);
                filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3)) hue-rotate(0deg);
            }

            25% {
                filter: drop-shadow(0 2px 8px rgba(0, 184, 148, 0.5)) hue-rotate(90deg);
            }

            50% {
                transform: rotate(180deg);
                filter: drop-shadow(0 2px 8px rgba(30, 58, 95, 0.5)) hue-rotate(180deg);
            }

            75% {
                filter: drop-shadow(0 2px 8px rgba(0, 184, 148, 0.5)) hue-rotate(270deg);
            }

            100% {
                transform: rotate(360deg);
                filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3)) hue-rotate(360deg);
            }
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) rotate(45deg);
            }
        }

        .brand-name {
            font-size: 28px;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 10px;
            letter-spacing: 2px;
            animation: textGlow 2s ease-in-out infinite alternate;
        }

        .brand-subtitle {
            font-size: 14px;
            color: #00b894;
            margin-bottom: 30px;
            font-weight: 500;
            animation: subtitleFade 3s ease-in-out infinite;
        }

        @keyframes textGlow {
            0% {
                text-shadow: 0 0 5px rgba(30, 58, 95, 0.3);
            }

            100% {
                text-shadow: 0 0 20px rgba(30, 58, 95, 0.6), 0 0 30px rgba(0, 184, 148, 0.3);
            }
        }

        @keyframes subtitleFade {

            0%,
            100% {
                opacity: 0.8;
                transform: translateY(0);
            }

            50% {
                opacity: 1;
                transform: translateY(-2px);
            }
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group.mt-4 {
            margin-top: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #1e3a5f;
            font-weight: 600;
            font-size: 14px;
        }

        .password-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .password-toggle {
            cursor: pointer;
            color: #64748b;
            font-size: 18px;
            transition: color 0.3s ease;
            user-select: none;
        }

        .password-toggle:hover {
            color: #00b894;
        }

        .form-group input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            outline: none;
        }

        .form-group input:focus {
            border-color: #00b894;
            box-shadow: 0 0 0 3px rgba(0, 184, 148, 0.1);
            transform: translateY(-2px);
        }

        .form-group input:hover {
            border-color: #00b894;
        }

        .form-group .input-icon {
            position: absolute;
            left: 15px;
            top: 45px;
            color: #00b894;
            font-size: 18px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin: 25px 0;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
            accent-color: #00b894;
        }

        .checkbox-group label {
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            margin-bottom: 0;
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 25px;
        }


        .forgot-password a {
            color: #00b894;
            text-decoration: underline;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #1e3a5f;
        }

        .login-btn {
            padding: 12px 24px;
            background: linear-gradient(135deg, #1e3a5f 0%, #00b894 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 184, 148, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .shape {
            position: absolute;
            opacity: 0.15;
            animation: float-shape 15s infinite ease-in-out;
        }

        .shape:nth-child(1) {
            top: 10%;
            left: 20%;
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #00b894, #1e3a5f);
            border-radius: 50%;
            animation: float-shape 15s infinite ease-in-out, colorShift 8s infinite;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            top: 70%;
            right: 20%;
            width: 40px;
            height: 40px;
            background: linear-gradient(45deg, #1e3a5f, #00b894);
            border-radius: 50%;
            animation: float-shape 18s infinite ease-in-out, colorShift 10s infinite;
            animation-delay: 5s;
        }

        .shape:nth-child(3) {
            bottom: 20%;
            left: 10%;
            width: 80px;
            height: 20px;
            background: linear-gradient(45deg, #00b894, #2c5282);
            border-radius: 10px;
            animation: float-shape 20s infinite ease-in-out, colorShift 12s infinite;
            animation-delay: 10s;
        }

        .shape:nth-child(4) {
            top: 30%;
            right: 10%;
            width: 30px;
            height: 30px;
            background: linear-gradient(45deg, #2c5282, #00b894);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation: float-shape 22s infinite ease-in-out, morphShape 6s infinite;
            animation-delay: 3s;
        }

        .shape:nth-child(5) {
            bottom: 40%;
            right: 40%;
            width: 50px;
            height: 50px;
            background: linear-gradient(45deg, #1e3a5f, #2c5282);
            border-radius: 50%;
            animation: float-shape 16s infinite ease-in-out, pulse 4s infinite;
            animation-delay: 7s;
        }

        @keyframes colorShift {

            0%,
            100% {
                filter: hue-rotate(0deg) brightness(1);
            }

            25% {
                filter: hue-rotate(90deg) brightness(1.2);
            }

            50% {
                filter: hue-rotate(180deg) brightness(0.8);
            }

            75% {
                filter: hue-rotate(270deg) brightness(1.1);
            }
        }

        @keyframes morphShape {

            0%,
            100% {
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            }

            25% {
                border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
            }

            50% {
                border-radius: 50% 50% 50% 50% / 50% 50% 50% 50%;
            }

            75% {
                border-radius: 30% 70% 30% 70% / 70% 30% 70% 30%;
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.15;
            }

            50% {
                transform: scale(1.3);
                opacity: 0.25;
            }
        }

        @keyframes float-shape {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-20px) rotate(120deg);
            }

            66% {
                transform: translateY(20px) rotate(240deg);
            }
        }

        .error-message {
            background: #fee2e2;
            color: #dc2626;
            padding: 8px 12px;
            border-radius: 8px;
            margin-top: 8px;
            font-size: 14px;
            display: none;
        }

        .success-message {
            background: #dcfce7;
            color: #16a34a;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
        }

        .session-status {
            background: #dbeafe;
            color: #1e40af;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 20px;
                padding: 30px 25px;
            }

            .brand-name {
                font-size: 24px;
            }

            .logo {
                width: 100px;
                height: 100px;
            }

            .logo-image {
                width: 70px;
                height: 70px;
            }

            .form-actions {
                flex-direction: column;
                gap: 15px;
            }

            .login-btn {
                width: 100%;
            }
        }
    </style>
    
</head>

<body>
    <div class="animated-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="wave-animation"></div>

    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="login-container">
        <div class="logo-container">
            <div class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo.webp') }}" alt="ELMULLIM Logo" class="logo-image">


            </div>
            <div class="brand-name">ELMULLIM</div>
            <div class="brand-subtitle">Learning Platform</div>
        </div>

        <!-- Session Status -->
        <div class="session-status" id="sessionStatus">
            <!-- Session status messages will appear here -->
        </div>

        <div class="success-message" id="successMessage">
            Login successful! Welcome to ELMULLIM
        </div>

        {{-- <form  method="POST"> --}}
        <form method="POST" id="loginForm" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div class="form-group">
                {{-- <label for="email">Email</label> --}}

                {{-- <input type="email" id="email" name="email" required autofocus autocomplete="username"
                    placeholder="Enter your email"> --}}

                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <div class="error-message" id="emailError"></div>
            </div>

            <!-- Password -->
            <div class="form-group mt-4">
                <div class="password-label">
                    {{-- <label for="password">Password</label> --}}
                </div>

                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
                <span class="password-toggle" onclick="togglePassword()">👁️</span>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <div class="error-message" id="passwordError"></div>
            </div>

            <!-- Remember Me -->

            <div class="checkbox-group">
                {{-- <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Remember me</label> --}}
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="form-actions">
                {{-- <div class="forgot-password">
                    <a href="#" onclick="forgotPassword()">Forgot your password?</a>
                </div> --}}
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <button type="submit" class="login-btn">Log in</button>
            </div>
        </form>
    </div>

    <script>
        // Login form submission
        // document.getElementById('loginForm').addEventListener('submit', function(e) {
        //     e.preventDefault();

        //     // const email = document.getElementById('email').value;
        //     // const password = document.getElementById('password').value;
        //     const remember = document.getElementById('remember_me').checked;

        //     // Clear previous errors
        //     clearErrors();

        //     // Validate inputs
        //     let hasErrors = false;

        //     if (!email || !isValidEmail(email)) {
        //         showError('emailError', 'Please enter a valid email address');
        //         hasErrors = true;
        //     }

        //     if (!password || password.length < 6) {
        //         showError('passwordError', 'Password must be at least 6 characters long');
        //         hasErrors = true;
        //     }

        //     if (hasErrors) {
        //         return;
        //     }

        //     // Simulate login process
        //     const loginBtn = document.querySelector('.login-btn');
        //     loginBtn.innerHTML = 'Logging in...';
        //     loginBtn.disabled = true;

        //     setTimeout(() => {
        //         // Simulate server response
        //         if (email === 'admin@elmullim.com' && password === '12345678') {
        //             showSuccess('Login successful! Welcome to ELMULLIM');

        //             // Store remember me preference
        //             if (remember) {
        //                 console.log('Remember me checked - user preference saved');
        //             }

        //             setTimeout(() => {
        //                 console.log('Redirecting to dashboard...');
        //                 // In real implementation: window.location.href = '/dashboard';
        //             }, 1500);
        //         } else {
        //             showError('passwordError', 'These credentials do not match our records');
        //         }

        //         loginBtn.innerHTML = 'Log in';
        //         loginBtn.disabled = false;
        //     }, 2000);
        // });

        // Show error message
        function showError(elementId, message) {
            const errorElement = document.getElementById(elementId);
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }

        // Clear all error messages
        function clearErrors() {
            const errorElements = document.querySelectorAll('.error-message');
            errorElements.forEach(element => {
                element.style.display = 'none';
                element.textContent = '';
            });
        }

        // Show success message
        function showSuccess(message) {
            const successMessage = document.getElementById('successMessage');
            successMessage.textContent = message;
            successMessage.style.display = 'block';
        }

        // Validate email format
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '👁️';
            }
        }

        // Forgot password function
        // function forgotPassword() {
        //     alert('Password reset link will be sent to your email');
        // }

        // Add interactive effects
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Simulate session status (if needed)
        function showSessionStatus(message) {
            const sessionStatus = document.getElementById('sessionStatus');
            sessionStatus.textContent = message;
            sessionStatus.style.display = 'block';
        }

        // Logo hover effect
        document.querySelector('.logo').addEventListener('mouseenter', function() {
            this.style.animationDuration = '1s';
        });

        document.querySelector('.logo').addEventListener('mouseleave', function() {
            this.style.animationDuration = '3s';
        });
    </script>
</body>

</html>
