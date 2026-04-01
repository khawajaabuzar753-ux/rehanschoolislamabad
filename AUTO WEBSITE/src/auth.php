<?php

declare(strict_types=1);

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/helpers.php';

const ADMIN_EMAIL = 'admin@manahil.com';
const ADMIN_PASSWORD = 'Admin@123';

function signUpUser(string $name, string $email, string $password): bool
{
    $pdo = getPDO();

    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);

    if ($stmt->fetch()) {
        return false;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $insert = $pdo->prepare(
        'INSERT INTO users (name, email, password, created_at) VALUES (:name, :email, :password, NOW())'
    );

    return $insert->execute([
        'name' => $name,
        'email' => $email,
        'password' => $hashedPassword,
    ]);
}

function attemptUserLogin(string $email, string $password): bool
{
    $pdo = getPDO();

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password'])) {
        return false;
    }

    startSession();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['last_activity'] = time(); // Set last activity time

    return true;
}

function attemptAdminLogin(string $email, string $password): bool
{
    if ($email === ADMIN_EMAIL && $password === ADMIN_PASSWORD) {
        startSession();
        $_SESSION['is_admin'] = true;
        $_SESSION['last_activity'] = time(); // Set last activity time
        return true;
    }

    return false;
}

function logoutUser(): void
{
    startSession();
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}

function requireUser(): void
{
    startSession();
    
    // Check session timeout (2 days = 172800 seconds)
    if (!empty($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 172800)) {
        logoutUser();
        setFlash('info', 'Your session has expired. Please login again.');
        redirect('login.php');
    }
    
    // Update last activity time
    $_SESSION['last_activity'] = time();
    
    if (empty($_SESSION['user_id'])) {
        redirect('login.php');
    }
}

function requireAdmin(): void
{
    startSession();
    
    // Check session timeout (2 days = 172800 seconds)
    if (!empty($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 172800)) {
        logoutUser();
        setFlash('info', 'Your session has expired. Please login again.');
        redirect('login.php');
    }
    
    // Update last activity time
    $_SESSION['last_activity'] = time();
    
    if (empty($_SESSION['is_admin'])) {
        redirect('login.php');
    }
}

function currentUser(): ?array
{
    startSession();
    
    // Check session timeout (2 days = 172800 seconds)
    if (!empty($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 172800)) {
        logoutUser();
        return null;
    }
    
    // Update last activity time
    if (!empty($_SESSION['user_id'])) {
        $_SESSION['last_activity'] = time();
    }
    
    if (empty($_SESSION['user_id'])) {
        return null;
    }

    $pdo = getPDO();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $stmt->execute(['id' => $_SESSION['user_id']]);

    return $stmt->fetch() ?: null;
}


