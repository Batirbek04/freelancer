<?php
session_start();
require_once '../config.php';

// Faqat freelancer kirishi kerak
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'freelancer') {
    header("Location: login.php");
    exit;
}

$freelancer_id = $_SESSION['user_id'];

// Freelancer ariza topshirgan ishlarni olish
$stmt = $pdo->prepare("
    SELECT j.*, u.name AS employer_name, a.applied_at
    FROM applications a
    JOIN jobs j ON a.job_id = j.id
    JOIN users u ON j.employer_id = u.id
    WHERE a.freelancer_id = ?
    ORDER BY a.applied_at DESC
");
$stmt->execute([$freelancer_id]);
$applications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Meniń arzalarım | Freelancer Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f4f6fb;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            margin-top: 60px;
        }
        .job-card {
            background: white;
            border-radius: 14px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeIn 0.6s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.08);
        }
        .job-title {
            font-weight: 600;
            font-size: 1.2rem;
            color: #333;
        }
        .job-meta {
            font-size: 0.9rem;
            color: #666;
        }
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h3 class="mb-4 text-center">Meniń arza tapsırǵan jumıslarım</h3>

    <?php if (empty($applications)): ?>
        <p class="text-center text-muted">Siz ele hesh qanday jumısqa arza tapsırǵanınız joq..</p>
    <?php else: ?>
        <?php foreach ($applications as $job): ?>
            <div class="job-card">
                <div class="job-title"><?= htmlspecialchars($job['title']) ?></div>
                <p><?= nl2br(htmlspecialchars($job['description'])) ?></p>
                <div class="job-meta">
                    <strong>Budjet:</strong> $<?= number_format($job['budget'], 2) ?> |
                    <strong>Ish beruvchi:</strong> <?= htmlspecialchars($job['employer_name']) ?> |
                    <strong>Topshirildi:</strong> <?= date('d.m.Y H:i', strtotime($job['applied_at'])) ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>
