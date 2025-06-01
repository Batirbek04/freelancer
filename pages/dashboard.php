<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_name = $_SESSION['user_name'];
$user_role = $_SESSION['user_role'];
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Freelancer Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #ffffff);
            min-height: 100vh;
            margin: 0;
        }

        .dashboard {
            max-width: 700px;
            margin: 80px auto;
            background: white;
            padding: 50px 30px;
            border-radius: 25px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.3s ease;
        }

        .dashboard:hover {
            transform: scale(1.01);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        h2 {
            font-weight: 600;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        p.text-muted {
            font-size: 16px;
            margin-bottom: 30px;
        }

        .btn-group .btn {
            margin: 10px;
            width: 200px;
            transition: all 0.3s ease;
            border-radius: 12px;
            font-weight: 500;
        }

        .btn-group .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }

        .btn-outline-success:hover {
            background-color: #28a745;
            color: #fff;
        }

        .btn-outline-warning:hover {
            background-color: #ffc107;
            color: #000;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="dashboard">
    <h2>Sálem, <?= htmlspecialchars($user_name) ?>!</h2>
    <p class="text-muted">Sizdiń rólińiz: <strong><?= htmlspecialchars($user_role) ?></strong></p>

    <div class="btn-group flex-wrap mt-4 d-flex justify-content-center">
        <?php if ($user_role === 'freelancer'): ?>
            <a href="jobs.php" class="btn btn-outline-primary">Jumıslardı kóriw</a>
            <a href="profile.php" class="btn btn-outline-secondary">Profilim</a>
        <?php elseif ($user_role === 'employer'): ?>
            <a href="post-job.php" class="btn btn-outline-success">Jumıs jaylastırıw</a>
            <a href="my-posts.php" class="btn btn-outline-warning">Jaylastırılǵan jumıslar</a>
        <?php endif; ?>
        <a href="logout.php" class="btn btn-danger">Shıǵıw</a>
    </div>
</div>

</body>
</html>
