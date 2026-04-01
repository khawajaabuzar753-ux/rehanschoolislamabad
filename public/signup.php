<?php
require_once __DIR__ . '/../src/helpers.php';
require_once __DIR__ . '/../src/auth.php';

startSession();

// Check if already logged in
if (!empty($_SESSION['user_id'])) {
    redirect('dashboard.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($name === '') {
        $errors[] = 'Name is required.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email is required.';
    }

    if (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    }

    if (!$errors) {
        $created = signUpUser($name, $email, $password);
        if ($created) {
            // Auto-login after signup
            if (attemptUserLogin($email, $password)) {
                $_SESSION['last_activity'] = time();
                setFlash('success', 'Account created successfully! Welcome to Rehan School.');
                redirect('dashboard.php');
            } else {
                setFlash('success', 'Account created successfully. Please log in.');
                redirect('login.php');
            }
        } else {
            $errors[] = 'Email is already registered.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Rehan School</title>
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
        
        .signup-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 100px 0 50px;
        }
        
        .animated-bg-signup {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        
        .animated-bg-signup::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
        }
        
        .animated-bg-signup::after {
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
        
        .signup-card {
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
        
        .signup-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .signup-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }
        
        .signup-header p {
            color: #64748b;
            font-size: 1.1rem;
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
        
        .btn-signup {
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
        
        .btn-signup:hover {
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
        
        .floating-shapes-signup {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        
        .shape-signup {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: floatShape 8s ease-in-out infinite;
        }
        
        .shape-signup-1 {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape-signup-2 {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }
        
        .shape-signup-3 {
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
        
        .form-hint {
            font-size: 0.9rem;
            color: #64748b;
            margin-top: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .signup-card {
                padding: 2rem 1.5rem;
            }
            
            .signup-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <section class="signup-section">
        <div class="animated-bg-signup"></div>
        <div class="floating-shapes-signup">
            <div class="shape-signup shape-signup-1"></div>
            <div class="shape-signup shape-signup-2"></div>
            <div class="shape-signup shape-signup-3"></div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="signup-card">
                        <div class="signup-header">
                            <h1>Create Account</h1>
                            <p>Join Rehan School today</p>
                        </div>

                        <?php if ($errors): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <ul class="mb-0 mt-2">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= sanitize($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="signup.php" id="signup-form">
                            <div class="form-group input-group-icon">
                                <label class="form-label">Full Name</label>
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" class="form-control" 
                                       value="<?= sanitize($_POST['name'] ?? '') ?>" required>
                            </div>
                            <div class="form-group input-group-icon">
                                <label class="form-label">Email Address</label>
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" class="form-control" 
                                       value="<?= sanitize($_POST['email'] ?? '') ?>" required>
                            </div>
                            <div class="form-group input-group-icon">
                                <label class="form-label">Password</label>
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" class="form-control" required minlength="6">
                                <small class="form-hint">Minimum 6 characters required</small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-signup">
                                    <i class="fas fa-user-plus me-2"></i>Create Account
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4 pt-3 border-top">
                            <p class="mb-0">
                                <span style="color: #64748b;">Already have an account? </span>
                                <a href="login.php" class="link-text">Log in here</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

        // Form validation and animation
        const form = document.getElementById('signup-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const inputs = form.querySelectorAll('input[required]');
                let isValid = true;
                
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.style.borderColor = '#ef4444';
                        setTimeout(() => {
                            input.style.borderColor = '#e2e8f0';
                        }, 2000);
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                }
            });
        }

        // Add floating animation to shapes
        document.querySelectorAll('.shape-signup').forEach((shape, index) => {
            shape.style.animationDelay = `${index * 2}s`;
        });

        // Input focus animations
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                this.parentElement.style.transition = 'transform 0.3s ease';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>
