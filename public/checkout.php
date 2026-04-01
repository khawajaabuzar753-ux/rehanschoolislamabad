<?php

require_once __DIR__ . '/../src/helpers.php';
require_once __DIR__ . '/../src/auth.php';

requireUser();

$pdo = getPDO();
$user = currentUser();

if (!$user || empty($user['start_time']) || empty($user['end_time'])) {
    setFlash('danger', 'Please set your internship timing before checking out.');
    redirect('dashboard.php');
}

$now = new DateTimeImmutable('now');
$date = $now->format('Y-m-d');
$checkOutTime = $now->format('Y-m-d H:i:s');

$message = sprintf(
    "Assalam u Alaikum!\nChecked out at: %s\nName: %s\nDate: %s\nLocation: Remote\nShift: %s - %s\n\n+923232147444",
    $now->format('h:i A'),
    $user['name'],
    $now->format('d M Y'),
    date('h:i A', strtotime($user['start_time'])),
    date('h:i A', strtotime($user['end_time']))
);

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare('SELECT id FROM attendance WHERE user_id = :user_id AND date = :date');
    $stmt->execute(['user_id' => $user['id'], 'date' => $date]);
    $existing = $stmt->fetch();

    if ($existing) {
        $update = $pdo->prepare('UPDATE attendance SET check_out_time = :check_out, message = :message WHERE id = :id');
        $update->execute([
            'check_out' => $checkOutTime,
            'message' => $message,
            'id' => $existing['id'],
        ]);
    } else {
        $insert = $pdo->prepare(
            'INSERT INTO attendance (user_id, date, check_out_time, message) VALUES (:user_id, :date, :check_out, :message)'
        );
        $insert->execute([
            'user_id' => $user['id'],
            'date' => $date,
            'check_out' => $checkOutTime,
            'message' => $message,
        ]);
    }

    $pdo->commit();

    setFlash('success', 'Check-out recorded successfully.', $message);
} catch (Throwable $exception) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    setFlash('danger', 'Unable to record check-out. Please try again.');
}

redirect('dashboard.php');


