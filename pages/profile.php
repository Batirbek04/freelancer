<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT name, email, role FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "Paydalanıwshı tawılmadı.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Profil | Freelancer Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f4f8;
        }
        .profile-box {
            max-width: 500px;
            margin: 100px auto;
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .profile-box h4 {
            color: #333;
        }
    </style>
</head>
<body>

<div class="profile-box">
    <h3 class="text-center mb-4">Shaxsiy Profil</h3>

    <p><strong>Ism:</strong> <?= htmlspecialchars($user['name']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Rol:</strong> <?= htmlspecialchars(ucfirst($user['role'])) ?></p>

    <div class="text-center mt-4">
        <a href="edit-profile.php" class="btn btn-warning">Profildi ózgertiw</a>
        <a href="dashboard.php" class="btn btn-secondary ms-2">Artqa</a>
    </div>
</div>

</body>
</html>
