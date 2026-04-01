<?php
require_once __DIR__ . '/../src/helpers.php';
require_once __DIR__ . '/../src/auth.php';

startSession();

// Check if user is already logged in
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    redirect('dashboard.php');
}

if (isset($_SESSION['is_admin']) && !empty($_SESSION['is_admin'])) {
    redirect('admin.php');
}

// Check session timeout only if session exists and has last_activity
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 172800)) {
    logoutUser();
    setFlash('info', 'Your session has expired. Please login again.');
}

$flash = getFlash();
$error = null;
$activeForm = $_POST['login_type'] ?? 'user';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $loginType = $_POST['login_type'] ?? 'user';
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
            $error = 'Valid email and password are required.';
        } else {
            if ($loginType === 'admin') {
                if (attemptAdminLogin($email, $password)) {
                    redirect('admin.php');
                }
                $error = 'Invalid admin credentials.';
            } else {
                if (attemptUserLogin($email, $password)) {
                    redirect('dashboard.php');
                }
                $error = 'Invalid email or password.';
            }
        }
    } catch (Exception $e) {
        error_log('Login error: ' . $e->getMessage());
        $error = 'An error occurred. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Rehan School</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'Inter', 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .login-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 100px 0 50px;
        }
        
        .animated-bg-login {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        
        .animated-bg-login::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
        }
        
        .animated-bg-login::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 2px, transparent 2px);
            background-size: 100px 100px;
            animation: moveBackgroundReverse 25s linear infinite;
        }
        
        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }
        
        @keyframes moveBackgroundReverse {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-50px, -50px); }
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            padding: 3rem;
            position: relative;
            z-index: 2;
            animation: fadeInUp 0.8s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .login-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }
        
        .login-header p {
            color: #64748b;
            font-size: 1.1rem;
        }
        
        .toggle-links {
            background: rgba(102, 126, 234, 0.1);
            border-radius: 50px;
            padding: 0.4rem;
            display: inline-flex;
            gap: 0.25rem;
            margin-bottom: 2rem;
        }
        
        .toggle-links a {
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            color: #667eea;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .toggle-links a.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        
        .toggle-links a:hover {
            transform: translateY(-2px);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border-radius: 15px;
            padding: 0.85rem 1.2rem;
            border: 2px solid #e2e8f0;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .input-group-icon {
            position: relative;
        }
        
        .input-group-icon i {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
            z-index: 10;
        }
        
        .input-group-icon .form-control {
            padding-left: 3rem;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 1rem 2.5rem;
            font-weight: 700;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .alert {
            border-radius: 15px;
            border: none;
            animation: slideDown 0.3s ease-out;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .auth-form {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .link-text {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .link-text:hover {
            color: #764ba2;
            transform: translateX(5px);
        }
        
        .floating-shapes-login {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        
        .shape-login {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: floatShape 8s ease-in-out infinite;
        }
        
        .shape-login-1 {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape-login-2 {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }
        
        .shape-login-3 {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
        
        @keyframes floatShape {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }
        
        @media (max-width: 768px) {
            .login-card {
                padding: 2rem 1.5rem;
            }
            
            .login-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <section class="login-section">
        <div class="animated-bg-login"></div>
        <div class="floating-shapes-login">
            <div class="shape-login shape-login-1"></div>
            <div class="shape-login shape-login-2"></div>
            <div class="shape-login shape-login-3"></div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="login-card">
                        <div class="login-header">
                            <h1>Welcome Back!</h1>
                            <p>Sign in to continue your journey</p>
                        </div>
                        
                        <div class="text-center mb-4">
                            <div class="toggle-links">
                                <a href="#" class="<?= $activeForm === 'user' ? 'active' : '' ?>" data-toggle-target="user-login">
                                    <i class="fas fa-user me-2"></i>User
                                </a>
                                <a href="#" class="<?= $activeForm === 'admin' ? 'active' : '' ?>" data-toggle-target="admin-login">
                                    <i class="fas fa-shield-halved me-2"></i>Admin
                                </a>
                            </div>
                        </div>

                        <?php if ($flash): ?>
                            <div class="alert alert-<?= sanitize($flash['type']) === 'success' ? 'success' : 'info' ?>">
                                <i class="fas fa-<?= sanitize($flash['type']) === 'success' ? 'check-circle' : 'info-circle' ?> me-2"></i>
                                <?= sanitize($flash['message']) ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($error): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <?= sanitize($error) ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="login.php" class="auth-form <?= $activeForm === 'admin' ? 'd-none' : '' ?>" id="user-login">
                            <input type="hidden" name="login_type" value="user">
                            <div class="form-group input-group-icon">
                                <label class="form-label">Email Address</label>
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" class="form-control" 
                                       value="<?= sanitize($_POST['email'] ?? '') ?>" required>
                            </div>
                            <div class="form-group input-group-icon">
                                <label class="form-label">Password</label>
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-login">
                                    <i class="fas fa-sign-in-alt me-2"></i>Log In
                                </button>
                            </div>
                            <div class="text-center mt-3">
                                <a href="#" class="link-text">Forgot password?</a>
                            </div>
                        </form>

                        <form method="post" action="login.php" class="auth-form <?= $activeForm === 'admin' ? '' : 'd-none' ?>" id="admin-login">
                            <input type="hidden" name="login_type" value="admin">
                            <div class="form-group input-group-icon">
                                <label class="form-label">Admin Email</label>
                                <i class="fas fa-user-shield"></i>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group input-group-icon">
                                <label class="form-label">Admin Password</label>
                                <i class="fas fa-key"></i>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-login">
                                    <i class="fas fa-shield-halved me-2"></i>Log In as Admin
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4 pt-3 border-top">
                            <p class="mb-0">
                                <span style="color: #64748b;">Don't have an account? </span>
                                <a href="signup.php" class="link-text">Sign up now</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Toggle between user and admin forms
        document.querySelectorAll('[data-toggle-target]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-toggle-target');
                
                // Hide all forms
                document.querySelectorAll('.auth-form').forEach(form => {
                    form.classList.add('d-none');
                });
                
                // Show target form
                document.getElementById(targetId)?.classList.remove('d-none');
                
                // Update active state
                document.querySelectorAll('.toggle-links a').forEach(a => {
                    a.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

        // Add floating animation to shapes
        document.querySelectorAll('.shape-login').forEach((shape, index) => {
            shape.style.animationDelay = `${index * 2}s`;
        });
    </script>
</body>
</html>
