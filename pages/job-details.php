<?php 
session_start();
require_once '../config.php';

// Ish ID tekshiruvi
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Qáte: Jumıs ID qáte berilgen.");
}

$job_id = $_GET['id'];

// Ishni olish
$stmt = $pdo->prepare("SELECT j.*, u.name AS employer_name, u.id AS employer_id FROM jobs j JOIN users u ON j.employer_id = u.id WHERE j.id = ?");
$stmt->execute([$job_id]);
$job = $stmt->fetch();

if (!$job) {
    die("Jumıs tawılmadı.");
}

// Ariza topshirish logikasi (faqat freelancerlar uchun)
$success = $error = '';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'freelancer') {
    $freelancer_id = $_SESSION['user_id'];
    $message = trim($_POST['message']);

    if ($message) {
        $stmt = $pdo->prepare("INSERT INTO applications (job_id, freelancer_id, message) VALUES (?, ?, ?)");
        $stmt->execute([$job_id, $freelancer_id, $message]);
        $success = "Arzańız jiberdi!";
    } else {
        $error = "Arza teksti bos bolmawı kerek.";
    }
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($job['title']) ?> | Freelancer Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f1f5f9;
            font-family: 'Poppins', sans-serif;
        }
        .job-details-box {
            max-width: 800px;
            margin: 70px auto;
            background: #fff;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 12px 28px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeIn 0.6s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        .job-details-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 32px rgba(0,0,0,0.1);
        }
        .badge {
            font-size: 0.9rem;
            padding: 0.5em 0.75em;
            border-radius: 50px;
        }
        .btn-outline-primary {
            transition: all 0.25s ease;
        }
        .btn-outline-primary:hover {
            transform: scale(1.05);
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

<div class="job-details-box">
    <h2><?= htmlspecialchars($job['title']) ?></h2>
    <span class="badge bg-secondary"><?= htmlspecialchars($job['category']) ?></span>
    <p class="mt-3"><?= nl2br(htmlspecialchars($job['description'])) ?></p>
    <p><strong>Budjet:</strong> $<?= number_format($job['budget'], 2) ?></p>
    <p><strong>Ish beruvchi:</strong> <?= htmlspecialchars($job['employer_name']) ?></p>

    <a href="jobs.php" class="btn btn-outline-primary mt-4">← Artqa qaytıw</a>

    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'freelancer'): ?>
        <hr class="my-4">
        <h5>Ariza topshirish</h5>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="message" class="form-label">Xabarıńız</label>
                <textarea name="message" id="message" rows="4" class="form-control" placeholder="Ne ushın bul jumıs sizge say dep oylaysız?" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Arza jiberiw</button>
        </form>

        <!-- Chat tugmasi -->
        <a href="chat.php?to=<?= $job['employer_id'] ?>" class="btn btn-outline-secondary mt-3">Jumıs beriwshi menen chat</a>
    <?php endif; ?>
</div>

</body>
</html>
