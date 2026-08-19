<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - ELMULLIM</title>
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

        .forgot-password-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            padding: 50px 40px;
            width: 100%;
            max-width: 500px;
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 100px;
            height: 100px;
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

        .logo-icon {
            font-size: 48px;
            color: white;
            position: relative;
            z-index: 2;
            animation: iconFloat 2s ease-in-out infinite;
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

        @keyframes iconFloat {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-3px) rotate(5deg);
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

        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: #1e3a5f;
            margin-bottom: 15px;
            text-align: center;
        }

        .page-description {
            font-size: 14px;
            color: #64748b;
            text-align: center;
            margin-bottom: 30px;
            line-height: 1.6;
            background: rgba(0, 184, 148, 0.05);
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #00b894;
        }

        @keyframes textGlow {
            0% {
                text-shadow: 0 0 5px rgba(30, 58, 95, 0.3);
            }

            100% {
                text-shadow: 0 0 20px rgba(30, 58, 95, 0.6), 0 0 30px rgba(0, 184, 148, 0.3);
            }
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #1e3a5f;
            font-weight: 600;
            font-size: 14px;
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

        .form-actions {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 30px;
        }

        .submit-btn {
            padding: 15px 24px;
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

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 184, 148, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .back-to-login {
            text-align: center;
            margin-top: 20px;
        }

        .back-to-login a {
            color: #00b894;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .back-to-login a:hover {
            color: #1e3a5f;
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
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
            text-align: center;
        }

        .session-status {
            background: #dbeafe;
            color: #1e40af;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
            text-align: center;
        }

        @media (max-width: 480px) {
            .forgot-password-container {
                margin: 20px;
                padding: 30px 25px;
                max-width: 100%;
            }

            .brand-name {
                font-size: 24px;
            }

            .page-title {
                font-size: 20px;
            }

            .logo {
                width: 80px;
                height: 80px;
            }

            .logo-icon {
                font-size: 36px;
            }

            .submit-btn {
                padding: 15px;
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

    <div class="forgot-password-container">
        <div class="logo-container">
            <div class="logo">
                <div class="logo-icon">🔐</div>
            </div>
            <div class="brand-name">ELMULLIM</div>
        </div>

        <div class="page-title">Forgot Password?</div>
        <div class="page-description">
            No problem! Just enter your email address and we'll send you a password reset link that will allow you to
            choose a new one.
        </div>

        <!-- Session Status -->
        <div class="session-status" id="sessionStatus">
            <!-- Session status messages will appear here -->
        </div>

        <div class="success-message" id="successMessage">
            Password reset link sent successfully! Check your email.
        </div>

        <form method="POST" id="forgotPasswordForm" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                {{-- <label for="email">Email Address</label> --}}
                {{-- <input type="email" id="email" name="email" required autofocus
                       placeholder="Enter your email address" value="{{ old('email') }}"> --}}
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                <div class="error-message" id="emailError"></div>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn" id="submitBtn">
                    Email Password Reset Link
                </button>
            </div>
        </form>

        <div class="back-to-login">
            <a href="{{ route('login') }}">
                ← Back to Login
            </a>
        </div>
    </div>

    {{-- <script>
        // Forgot password form submission
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;

            // Clear previous errors
            clearErrors();

            // Validate email
            if (!email || !isValidEmail(email)) {
                showError('emailError', 'Please enter a valid email address');
                return;
            }

            // Show loading state
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Sending...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Show success message
                showSuccess('Password reset link sent successfully! Check your email.');

                // Reset form
                document.getElementById('forgotPasswordForm').reset();

                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;

                // In real implementation, you would submit the form normally
                // this.submit();
            }, 2000);
        });

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

            // Hide after 5 seconds
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);
        }

        // Validate email format
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Add interactive effects
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Logo hover effect
        document.querySelector('.logo').addEventListener('mouseenter', function() {
            this.style.animationDuration = '1s';
        });

        document.querySelector('.logo').addEventListener('mouseleave', function() {
            this.style.animationDuration = '3s';
        });

        // Simulate session status (if needed)
        function showSessionStatus(message) {
            const sessionStatus = document.getElementById('sessionStatus');
            sessionStatus.textContent = message;
            sessionStatus.style.display = 'block';
        }
    </script> --}}
</body>

</html>
