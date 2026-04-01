<?php
require_once __DIR__ . '/../src/database.php';
require_once __DIR__ . '/../src/helpers.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $feedbackType = trim($_POST['feedback_type'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Validation
    if (empty($fullName) || empty($email) || empty($feedbackType) || empty($subject) || empty($message)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all fields.']);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Please provide a valid email address.']);
        exit;
    }
    
    try {
        $pdo = getPDO();
        
        $stmt = $pdo->prepare("INSERT INTO feedback (full_name, email, feedback_type, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$fullName, $email, $feedbackType, $subject, $message]);
        
        echo json_encode([
            'success' => true,
            'message' => 'Thank you for your feedback! We appreciate your input and will review it soon.'
        ]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error submitting feedback. Please try again.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}


