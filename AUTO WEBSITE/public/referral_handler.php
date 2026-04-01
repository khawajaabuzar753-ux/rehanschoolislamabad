<?php
require_once __DIR__ . '/../src/database.php';
require_once __DIR__ . '/../src/helpers.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'get_referral_code') {
        $email = $_POST['email'] ?? '';
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Please provide a valid email address.']);
            exit;
        }
        
        try {
            $pdo = getPDO();
            
            // Check if user already has a referral code
            $stmt = $pdo->prepare("SELECT referral_code FROM referral_codes WHERE user_email = ?");
            $stmt->execute([$email]);
            $existing = $stmt->fetch();
            
            if ($existing) {
                echo json_encode([
                    'success' => true,
                    'referral_code' => $existing['referral_code'],
                    'message' => 'Your referral code retrieved successfully!'
                ]);
            } else {
                // Generate new referral code
                $referralCode = 'REHAN' . strtoupper(substr(md5($email . time()), 0, 8));
                
                $stmt = $pdo->prepare("INSERT INTO referral_codes (user_email, referral_code) VALUES (?, ?)");
                $stmt->execute([$email, $referralCode]);
                
                echo json_encode([
                    'success' => true,
                    'referral_code' => $referralCode,
                    'message' => 'Your referral code generated successfully!'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error generating referral code. Please try again.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}


