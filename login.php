<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PPDB - SMK Igasar Pindad</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="academic-year">TA 2025/2026</div>
        
        <div class="school-header">
            <div class="logo-container">
                <div class="logo">
                    <img src="igasar.png" alt="Logo SMK Igasar Pindad" onerror="this.style.display='none';">
                </div>
            </div>
            <h1 class="school-name">SMK Igasar Pindad</h1>
            <p class="school-subtitle">Sekolah Menengah Kejuruan</p>

        </div>



        <h2 class="form-title">Masuk</h2>

        <form action="login_process.php" method="POST" id="loginForm">
            <div class="form-group">
                <label for="user" class="form-label">Email atau Username</label>
                <input type="text" 
                       id="user" 
                       name="user" 
                       class="form-input" 
                       placeholder="Masukkan email atau username" 
                       required
                       autocomplete="username">
            </div>

            <div class="form-group">
                <label for="pass" class="form-label">Password</label>
                <input type="password" 
                       id="pass" 
                       name="pass" 
                       class="form-input" 
                       placeholder="Masukkan password" 
                       required
                       autocomplete="current-password">
            </div>
            <div> <a href="#" class="forgot-link">Lupa Password?</a></div>

            <button type="submit" class="login-button" id="loginBtn">
                Masuk ke Portal PPDB
            </button>
        </form>

        <div class="form-footer">
            <div class="footer-links">
                <a href="#" class="register-link">Daftar Akun</a>
            </div>
        </div>
    </div>

     <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #1a202c;
        }

        .login-container {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 48px;
            width: 100%;
            max-width: 440px;
            position: relative;
        }

        .school-header {
            text-align: center;
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 1px solid #f1f5f9;
        }

        .logo-container {
            margin-bottom: 24px;
        }

        .logo {
            width: 72px;
            height: 72px;
            background: #3A5C96;
            border-radius: 12px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .logo img {
            width: 56px;
            height: 56px;
            object-fit: contain;
            border-radius: 8px;
        }

        .logo::before {
            content: '🏫';
            font-size: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo img[src] {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .school-name {
            color: #1a202c;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 4px;
            letter-spacing: -0.025em;
        }

        .school-subtitle {
            color: #64748b;
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .ppdb-badge {
            display: inline-block;
            background: #3A5C96;
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-title {
            color: #1a202c;
            font-size: 28px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 24px;
            letter-spacing: -0.025em;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            color: #374151;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            letter-spacing: 0.025em;
        }

        .form-input {
            width: 100%;
            padding: 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            background: #ffffff;
            transition: all 0.2s ease;
            outline: none;
            font-family: inherit;
        }

        .form-input:focus {
            border-color: #3A5C96;
            box-shadow: 0 0 0 3px rgba(58, 92, 150, 0.1);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .login-button {
            width: 100%;
            background: #3A5C96;
            color: white;
            border: none;
            padding: 16px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 8px;
            font-family: inherit;
        }

        .login-button:hover {
            background: #2d4a7d;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(58, 92, 150, 0.3);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .form-footer {
            text-align: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #f1f5f9;
        }

        .help-text {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .footer-links {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .separator {
            color: #d1d5db;
            font-size: 12px;
        }

        .forgot-link,
        .register-link {
            color: #3A5C96;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .forgot-link:hover,
        .register-link:hover {
            color: #2d4a7d;
        }

        .academic-year {
            position: absolute;
            top: 16px;
            right: 20px;
            background: #f8fafc;
            color: #64748b;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .form-info {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .form-info-title {
            color: #374151;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-info-text {
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 32px 24px;
                margin: 16px;
                max-width: none;
            }
            
            .school-name {
                font-size: 22px;
            }
            
            .form-title {
                font-size: 24px;
            }
            
            .academic-year {
                position: static;
                display: block;
                text-align: center;
                margin-bottom: 16px;
            }
        }

        /* Loading state */
        .login-button.loading {
            position: relative;
            color: transparent;
        }

        .login-button.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Focus styles for accessibility */
        .form-input:focus,
        .login-button:focus,
        .forgot-link:focus,
        .register-link:focus {
            outline: 2px solid #3A5C96;
            outline-offset: 2px;
        }
    </style>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
            btn.disabled = true;
        });

        // Simple fade-in animation
        window.addEventListener('load', function() {
            const container = document.querySelector('.login-container');
            container.style.opacity = '0';
            container.style.transform = 'translateY(10px)';
            container.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            
            requestAnimationFrame(() => {
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>