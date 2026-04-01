<?php

require_once __DIR__ . '/../src/helpers.php';
require_once __DIR__ . '/../src/auth.php';

requireUser();

$pdo = getPDO();
$user = currentUser();

if (!$user) {
    redirect('login.php');
}

$success = null;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start = trim($_POST['start_time'] ?? '');
    $end = trim($_POST['end_time'] ?? '');

    if ($start === '' || $end === '') {
        $errors[] = 'Both start and end time are required.';
    } elseif (strtotime($end) <= strtotime($start)) {
        $errors[] = 'End time must be later than start time.';
    }

    if (!$errors) {
        $stmt = $pdo->prepare('UPDATE users SET start_time = :start, end_time = :end WHERE id = :id');
        $stmt->execute([
            'start' => $start,
            'end' => $end,
            'id' => $user['id'],
        ]);
        setFlash('success', 'Internship timing saved successfully.');
        redirect('dashboard.php');
    }
}

$flash = getFlash();

$stmt = $pdo->prepare('SELECT * FROM attendance WHERE user_id = :id ORDER BY date DESC, id DESC LIMIT 10');
$stmt->execute(['id' => $user['id']]);
$recentAttendance = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Manahil Interns</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Manahil Interns</a>
        <div class="d-flex">
            <span class="text-white me-3"><?= sanitize($user['name']) ?></span>
            <a href="logout.php" class="btn btn-outline-light btn-sm rounded-pill">Logout</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card mb-4">
                <div class="card-body p-4 p-md-5">
                    <h1 class="hero-title mb-3 text-center">Welcome to Manahil Interns Check-In / Check-Out Timing</h1>
                    <p class="subheading text-center mb-4">Please set your internship timing to activate your smart attendance experience.</p>

                    <?php if ($flash): ?>
                        <div class="alert alert-<?= sanitize($flash['type']) ?> rounded-4">
                            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                                <span><?= sanitize($flash['message']) ?></span>
                                <?php if (!empty($flash['whatsapp'])): ?>
                                    <button type="button" class="btn whatsapp-btn" data-whatsapp-message="<?= sanitize($flash['whatsapp']) ?>">
                                        Send to Manahil on WhatsApp
                                    </button>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($flash['whatsapp'])): ?>
                                <pre class="mt-3 mb-0 bg-light rounded-4 p-3 text-wrap"><?= sanitize($flash['whatsapp']) ?></pre>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($errors): ?>
                        <div class="alert alert-danger rounded-4">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= sanitize($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <h2 class="h4 fw-bold mb-3">Please set your internship timing</h2>
                    <form method="post" class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Start Time</label>
                            <input type="time" name="start_time" class="form-control form-control-lg rounded-4" value="<?= sanitize(timeForInput($user['start_time'])) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">End Time</label>
                            <input type="time" name="end_time" class="form-control form-control-lg rounded-4" value="<?= sanitize(timeForInput($user['end_time'])) ?>" required>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary btn-lg" type="submit">Save Timing</button>
                        </div>
                    </form>

                    <?php if (!empty($user['start_time']) && !empty($user['end_time'])): ?>
                        <div class="alert alert-info rounded-4 mt-4">
                            <strong>This is your internship timing now:</strong>
                            <span class="badge badge-timing ms-2">
                                <?= formatTime($user['start_time']) ?> - <?= formatTime($user['end_time']) ?>
                            </span>
                        </div>
                        <div class="d-flex flex-column flex-md-row gap-3 mt-4">
                            <a href="checkin.php" class="btn btn-success btn-lg flex-fill">
                                ✅ Check In
                            </a>
                            <a href="checkout.php" class="btn btn-danger btn-lg flex-fill">
                                ✅ Check Out
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                        <h2 class="h4 fw-bold mb-0">Recent Attendance</h2>
                        <span class="filter-chip">Auto synced with your WhatsApp updates</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Internship Timing</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (!$recentAttendance): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Your attendance will appear here after you check in.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($recentAttendance as $entry): ?>
                                    <tr>
                                        <td><?= formatDate($entry['date']) ?></td>
                                        <td><?= $entry['check_in_time'] ? date('h:i A', strtotime($entry['check_in_time'])) : '-' ?></td>
                                        <td><?= $entry['check_out_time'] ? date('h:i A', strtotime($entry['check_out_time'])) : '-' ?></td>
                                        <td><?= formatTime($user['start_time']) ?> - <?= formatTime($user['end_time']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/app.js"></script>
</body>
</html>


