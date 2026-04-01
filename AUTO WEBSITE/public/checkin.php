<?php

require_once __DIR__ . '/../src/helpers.php';
require_once __DIR__ . '/../src/auth.php';

requireUser();

$pdo = getPDO();
$user = currentUser();

if (!$user || empty($user['start_time']) || empty($user['end_time'])) {
    setFlash('danger', 'Please set your internship timing before checking in.');
    redirect('dashboard.php');
}

$now = new DateTimeImmutable('now');
$date = $now->format('Y-m-d');
$checkInTime = $now->format('Y-m-d H:i:s');

$shiftStart = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $date . ' ' . $user['start_time']);
if (!$shiftStart) {
    $shiftStart = DateTimeImmutable::createFromFormat('Y-m-d H:i', $date . ' ' . $user['start_time']);
}
$status = $shiftStart && $now <= $shiftStart->modify('+5 minutes') ? 'On Time' : 'Late';

$message = sprintf(
    "Assalam u Alaikum!\nChecked in at: %s\nName: %s\nDate: %s\nLocation: Remote\nShift: %s - %s\nStatus: %s\n\n+923232147444",
    $now->format('h:i A'),
    $user['name'],
    $now->format('d M Y'),
    date('h:i A', strtotime($user['start_time'])),
    date('h:i A', strtotime($user['end_time'])),
    $status
);

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare('SELECT id FROM attendance WHERE user_id = :user_id AND date = :date');
    $stmt->execute(['user_id' => $user['id'], 'date' => $date]);
    $existing = $stmt->fetch();

    if ($existing) {
        $update = $pdo->prepare('UPDATE attendance SET check_in_time = :check_in, message = :message WHERE id = :id');
        $update->execute([
            'check_in' => $checkInTime,
            'message' => $message,
            'id' => $existing['id'],
        ]);
    } else {
        $insert = $pdo->prepare(
            'INSERT INTO attendance (user_id, date, check_in_time, message) VALUES (:user_id, :date, :check_in, :message)'
        );
        $insert->execute([
            'user_id' => $user['id'],
            'date' => $date,
            'check_in' => $checkInTime,
            'message' => $message,
        ]);
    }

    $pdo->commit();

    setFlash('success', 'Check-in recorded successfully.', $message);
} catch (Throwable $exception) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    setFlash('danger', 'Unable to record check-in. Please try again.');
}

redirect('dashboard.php');


