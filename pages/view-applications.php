<?php
session_start();
require_once '../config.php';

// Faqat employer kirishi mumkin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'employer') {
    header("Location: login.php");
    exit;
}

$employer_id = $_SESSION['user_id'];

// Ariza topshirilgan ishlar va arizalarni olish
$stmt = $pdo->prepare("
    SELECT a.id AS application_id, a.created_at AS applied_at, 
           u.id AS freelancer_id, u.name AS freelancer_name, u.email, 
           j.title AS job_title, j.id AS job_id
    FROM applications a
    JOIN users u ON a.freelancer_id = u.id
    JOIN jobs j ON a.job_id = j.id
    WHERE j.employer_id = ?
    ORDER BY a.created_at DESC
");
$stmt->execute([$employer_id]);
$applications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Arzalar | Freelancer Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f9fbfc;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            max-width: 900px;
            margin-top: 60px;
        }
        .card {
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: scale(1.01);
        }
        .badge-job {
            background-color: #0d6efd;
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 12px;
        }
        .freelancer-email {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="container">
    <h3 class="mb-4 text-center">Sizge jiberilgen arzalar</h3>

    <?php if ($applications): ?>
        <?php foreach ($applications as $app): ?>
            <div class="card p-4 mb-3">
                <h5><?= htmlspecialchars($app['freelancer_name']) ?></h5>
                <div class="freelancer-email text-muted"><?= htmlspecialchars($app['email']) ?></div>
                <p class="mt-2 mb-1">
                    <span class="badge-job"><?= htmlspecialchars($app['job_title']) ?></span>
                </p>
                <p class="text-muted"><small>Ariza yuborilgan: <?= date('d.m.Y H:i', strtotime($app['applied_at'])) ?></small></p>
                <a href="job-details.php?id=<?= $app['job_id'] ?>" class="btn btn-outline-primary btn-sm">Jumıs maǵlıwmatların kóriw</a>
                <a href="chat.php?to=<?= $app['freelancer_id'] ?>" class="btn btn-outline-secondary btn-sm ms-2">Chat</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center text-muted">Sizge házirshe hesh qanday arza jiberilmegen.</p>
    <?php endif; ?>
</div>

</body>
</html>
