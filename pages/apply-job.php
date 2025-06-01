<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$success = $error = '';
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_title    = trim($_POST['job_title']);
    $cover_letter = trim($_POST['cover_letter']);

    if ($job_title && $cover_letter) {
        $stmt = $pdo->prepare("INSERT INTO applications (user_id, job_title, cover_letter) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $job_title, $cover_letter]);
        $success = "Arza tabıslı jiberildi!";
    } else {
        $error = "Iltimas, barlıq maydanlardı toltırıń.";
    }
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Jumısqa arza tapsırıw</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #eef2f7;
        }
        .apply-box {
            max-width: 600px;
            margin: 80px auto;
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="apply-box">
    <h3 class="text-center mb-4">Freelancer arzası</h3>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Jumıs atı</label>
            <input type="text" name="job_title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Múrájat xatı</label>
            <textarea name="cover_letter" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Arza jiberiw</button>
        <p class="mt-3 text-center"><a href="dashboard.php">⬅ Artqa qaytıw</a></p>
    </form>
</div>

</body>
</html>
