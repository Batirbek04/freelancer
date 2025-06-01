<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'employer') {
    header("Location: login.php");
    exit;
}

$employer_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM jobs WHERE employer_id = ? ORDER BY created_at DESC");
$stmt->execute([$employer_id]);
$jobs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Meniń jumıslarım | Freelancer Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f3f7fb, #e8f0fe);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
        }

        h3 {
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
            animation: fadeDown 0.5s ease-in-out;
            color: #333;
        }

        .job-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-in-out;
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        }

        .job-title {
            font-weight: 600;
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .job-card p {
            margin: 0 0 10px;
            color: #555;
        }

        .text-muted {
            color: #888 !important;
        }

        .text-muted small {
            font-size: 0.9rem;
        }

        .btn-view-applications {
            margin-top: 15px;
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .empty-msg {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 50px 0;
            animation: fadeInUp 0.5s ease-in-out;
        }
    </style>
</head>
<body>

<div class="container">
    <h3>Meniń jaylastırǵan jumıslarım</h3>

    <?php foreach ($jobs as $job): ?>
        <div class="job-card">
            <div class="job-title"><?= htmlspecialchars($job['title']) ?></div>
            <p><?= nl2br(htmlspecialchars($job['description'])) ?></p>
            <div><strong>Budjet:</strong> $<?= number_format($job['budget'], 2) ?></div>
            <div class="text-muted mt-2"><small>Reklama qılınǵan: <?= date('d.m.Y H:i', strtotime($job['created_at'])) ?></small></div>

            <!-- ✅ Arzalardı kóriw túymesi -->
            <a href="view-applications.php?job_id=<?= $job['id'] ?>" class="btn btn-outline-info btn-view-applications">
                Arzalardı kóriw
            </a>
        </div>
    <?php endforeach; ?>

    <?php if (empty($jobs)): ?>
        <div class="empty-msg">Siz ele hesh qanday jumıs ornalastırmaǵansız.</div>
    <?php endif; ?>
</div>

</body>
</html>
