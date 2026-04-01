<?php

require_once __DIR__ . '/../src/helpers.php';
require_once __DIR__ . '/../src/auth.php';

requireAdmin();

$pdo = getPDO();

$searchUser = trim($_GET['user'] ?? '');
$searchDate = trim($_GET['date'] ?? '');
$sort = $_GET['sort'] ?? 'date_desc';

$sortOptions = [
    'date_desc' => 'a.date DESC, a.check_in_time DESC',
    'date_asc' => 'a.date ASC, a.check_in_time ASC',
    'name_asc' => 'u.name ASC',
    'name_desc' => 'u.name DESC',
    'checkin_asc' => 'a.check_in_time ASC',
    'checkin_desc' => 'a.check_in_time DESC',
    'checkout_asc' => 'a.check_out_time ASC',
    'checkout_desc' => 'a.check_out_time DESC',
];

$orderClause = $sortOptions[$sort] ?? $sortOptions['date_desc'];

$query = 'SELECT a.*, u.name, u.start_time, u.end_time 
          FROM attendance a 
          INNER JOIN users u ON a.user_id = u.id 
          WHERE 1=1';
$params = [];

if ($searchUser !== '') {
    $query .= ' AND u.name LIKE :user';
    $params['user'] = '%' . $searchUser . '%';
}

if ($searchDate !== '') {
    $query .= ' AND a.date = :date';
    $params['date'] = $searchDate;
}

$query .= " ORDER BY {$orderClause}";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$records = $stmt->fetchAll();

$userStmt = $pdo->query('SELECT DISTINCT name FROM users ORDER BY name');
$userNames = $userStmt->fetchAll(PDO::FETCH_COLUMN);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Ledger | Manahil Interns</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Manahil Interns Admin</a>
        <div class="d-flex">
            <a href="logout.php" class="btn btn-outline-light btn-sm rounded-pill">Logout</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="card mb-4">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                <div>
                    <h1 class="hero-title mb-2">Attendance Ledger</h1>
                    <p class="subheading mb-0">Monitor every intern&apos;s check-ins, check-outs, and shift adherence in real time.</p>
                </div>
                <span class="filter-chip mt-3 mt-md-0">Total Records: <?= count($records) ?></span>
            </div>

            <form class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Search by User</label>
                    <input list="userOptions" name="user" class="form-control form-control-lg rounded-4"
                           value="<?= sanitize($searchUser) ?>" placeholder="Type a name">
                    <datalist id="userOptions">
                        <?php foreach ($userNames as $name): ?>
                            <option value="<?= sanitize($name) ?>"></option>
                        <?php endforeach; ?>
                    </datalist>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Date</label>
                    <input type="date" name="date" class="form-control form-control-lg rounded-4"
                           value="<?= sanitize($searchDate) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Sort</label>
                    <select name="sort" class="form-select form-select-lg rounded-4">
                        <option value="date_desc" <?= $sort === 'date_desc' ? 'selected' : '' ?>>Date ↓</option>
                        <option value="date_asc" <?= $sort === 'date_asc' ? 'selected' : '' ?>>Date ↑</option>
                        <option value="name_asc" <?= $sort === 'name_asc' ? 'selected' : '' ?>>Name A-Z</option>
                        <option value="name_desc" <?= $sort === 'name_desc' ? 'selected' : '' ?>>Name Z-A</option>
                        <option value="checkin_asc" <?= $sort === 'checkin_asc' ? 'selected' : '' ?>>Check In ↑</option>
                        <option value="checkin_desc" <?= $sort === 'checkin_desc' ? 'selected' : '' ?>>Check In ↓</option>
                        <option value="checkout_asc" <?= $sort === 'checkout_asc' ? 'selected' : '' ?>>Check Out ↑</option>
                        <option value="checkout_desc" <?= $sort === 'checkout_desc' ? 'selected' : '' ?>>Check Out ↓</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button class="btn btn-primary btn-lg w-100" type="submit">Apply</button>
                    <a href="admin.php" class="btn btn-outline-secondary btn-lg rounded-pill">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Date</th>
                            <th>Check In Time</th>
                            <th>Check Out Time</th>
                            <th>Internship Timing</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!$records): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No attendance records found for the selected filters.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($records as $record): ?>
                            <tr>
                                <td class="fw-semibold text-dark"><?= sanitize($record['name']) ?></td>
                                <td><?= formatDate($record['date']) ?></td>
                                <td><?= $record['check_in_time'] ? date('h:i A', strtotime($record['check_in_time'])) : '-' ?></td>
                                <td><?= $record['check_out_time'] ? date('h:i A', strtotime($record['check_out_time'])) : '-' ?></td>
                                <td><?= formatTime($record['start_time']) ?> - <?= formatTime($record['end_time']) ?></td>
                                <td>
                                    <?php if (!empty($record['message'])): ?>
                                        <button type="button" class="btn btn-sm whatsapp-btn mb-2" data-whatsapp-message="<?= sanitize($record['message']) ?>">
                                            Send to WhatsApp
                                        </button>
                                        <pre class="mb-0 bg-light p-2 rounded-4"><?= sanitize($record['message']) ?></pre>
                                    <?php else: ?>
                                        <span class="text-muted">No message recorded</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/app.js"></script>
</body>
</html>


