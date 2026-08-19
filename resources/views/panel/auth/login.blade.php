<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Elmullim - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 50%, #00d4aa 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements */
        .background-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape1 {
            width: 100px;
            height: 100px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape2 {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape3 {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 2;
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            background: linear-gradient(135deg, #1e3a5f, #00d4aa);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            animation: pulse 2s infinite;
            overflow: hidden;
        }

        .logo-svg {
            width: 50px;
            height: 50px;
            fill: white;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome-text h1 {
            color: #1e3a5f;
            font-size: 28px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .welcome-text p {
            color: #666;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #1e3a5f;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-group input:focus {
            outline: none;
            border-color: #00d4aa;
            box-shadow: 0 0 0 3px rgba(0, 212, 170, 0.1);
            transform: translateY(-2px);
        }

        .form-group input::placeholder {
            color: #a0aec0;
        }

        .login-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #00d4aa, #1e3a5f);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
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
            transition: left 0.5s;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 212, 170, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .forgot-password {
            text-align: center;
            margin-bottom: 20px;
        }

        .forgot-password a {
            color: #00d4aa;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #1e3a5f;
            text-decoration: underline;
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
            color: #666;
            font-size: 14px;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e1e8ed;
            z-index: 1;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            position: relative;
            z-index: 2;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
        }

        .signup-link p {
            color: #666;
            font-size: 14px;
        }

        .signup-link a {
            color: #00d4aa;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: #1e3a5f;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
            accent-color: #00d4aa;
        }

        .checkbox-group label {
            margin-bottom: 0;
            font-size: 14px;
            color: #666;
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 20px;
                padding: 30px 25px;
            }

            .welcome-text h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="background-shapes">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
    </div>

    <div class="login-container">
        <div class="logo-container">
            <div class="logo">
                <svg class="logo-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <!-- Graduation cap -->
                    <path d="M50 10 L85 25 L50 40 L15 25 Z" fill="currentColor" />
                    <path d="M75 30 L75 45 L50 55 L25 45 L25 30" fill="none" stroke="currentColor"
                        stroke-width="2" />
                    <circle cx="85" cy="25" r="3" fill="currentColor" />

                    <!-- Letter shapes inspired by the logo -->
                    <!-- Left vertical bars -->
                    <rect x="20" y="40" width="4" height="35" fill="currentColor" />
                    <rect x="28" y="45" width="4" height="30" fill="currentColor" />

                    <!-- Center design -->
                    <rect x="40" y="50" width="4" height="25" fill="currentColor" />
                    <rect x="40" y="60" width="15" height="4" fill="currentColor" />
                    <rect x="51" y="50" width="4" height="15" fill="currentColor" />

                    <!-- Right vertical bars -->
                    <rect x="68" y="45" width="4" height="30" fill="currentColor" />
                    <rect x="76" y="40" width="4" height="35" fill="currentColor" />

                    <!-- Bottom horizontal bar -->
                    <rect x="20" y="80" width="60" height="4" fill="currentColor" />
                </svg>
            </div>
        </div>

        <div class="welcome-text">
            <h1>Welcome Back!</h1>
            <p>Sign in to your account to continue</p>
        </div>

        <form id="loginForm">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" class="login-btn">Sign In</button>
        </form>

        <div class="forgot-password">
            <a href="#" onclick="showForgotPassword()">Forgot your password?</a>
        </div>

        <div class="divider">
            <span>or</span>
        </div>

        <div class="signup-link">
            <p>Don't have an account? <a href="#" onclick="showSignup()">Sign up here</a></p>
        </div>
    </div>

    <script>
        // Form submission handler
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Simple validation
            if (!email || !password) {
                alert('Please fill in all fields');
                return;
            }

            // Simulate login process
            const loginBtn = document.querySelector('.login-btn');
            loginBtn.innerHTML = 'Signing In...';
            loginBtn.disabled = true;

            setTimeout(() => {
                alert('Login successful! Welcome back!');
                loginBtn.innerHTML = 'Sign In';
                loginBtn.disabled = false;
                // In a real app, you would redirect to dashboard
            }, 2000);
        });

        // Interactive animations
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Placeholder functions for demo
        function showForgotPassword() {
            alert('Forgot password functionality would be implemented here');
        }

        function showSignup() {
            alert('Sign up page would be shown here');
        }

        // Add some interactive particles
        function createParticle() {
            const particle = document.createElement('div');
            particle.style.position = 'absolute';
            particle.style.width = '4px';
            particle.style.height = '4px';
            particle.style.background = 'rgba(0, 212, 170, 0.6)';
            particle.style.borderRadius = '50%';
            particle.style.pointerEvents = 'none';
            particle.style.zIndex = '1';

            const x = Math.random() * window.innerWidth;
            const y = Math.random() * window.innerHeight;

            particle.style.left = x + 'px';
            particle.style.top = y + 'px';

            document.body.appendChild(particle);

            const duration = Math.random() * 3000 + 2000;
            const endY = y - Math.random() * 100 - 50;

            particle.animate([{
                    transform: 'translateY(0px)',
                    opacity: 1
                },
                {
                    transform: `translateY(${endY - y}px)`,
                    opacity: 0
                }
            ], {
                duration: duration,
                easing: 'ease-out'
            }).onfinish = () => {
                particle.remove();
            };
        }

        // Create particles periodically
        setInterval(createParticle, 800);
    </script>
</body>

</html>
